/* 声明市区联动方法 */
var fnGetCity = function(selector, selectedData, siblingSelector, callback) {
    $.ajax({
        type: 'GET',
        url: cityUrl,
        data: { adcode: $(selector).val()},
        success: function(data) {
            var dataz = data.data;
            var str = '<option value="">请选择城市</option>'
            if (data.status == 1) {
                for(var i in dataz) {
                    str += '<option value="' + dataz[i]['adcode'] + '">' + dataz[i]['name'] + '</option>';
                }
            }
            if (data.status == 2) {
                str += '<option value="' + dataz['adcode'] + '">' + dataz['name'] + '</option>';
            }
            $(siblingSelector).html(str);
            $(siblingSelector + ' option[value="' + selectedData + '"]').attr("selected","selected");// 选中 城市
            $(siblingSelector).trigger("chosen:updated");
            fnGetCountry(siblingSelector, s_adcode, selector_country);
        },
        complete: callback
    })
}
var fnGetCountry = function(selector, selectedData, siblingSelector, callback) {
    $.ajax({
        type: 'GET',
        url: countryUrl,
        data: { adcode: $(selector).val()},
        success: function(data) {
            var dataz = data.data;
            if(dataz == "" && $(selector).val() != "") {
                $(siblingSelector + "_chosen").hide();
                return;
            }
            $(siblingSelector + "_chosen").show();
            var str = '<option value="">请选择区域</option>'
            if (data.status == 1) {
                for(var i in dataz) {
                    str += '<option value="' + dataz[i]['adcode'] + '">' + dataz[i]['name'] + '</option>';
                }
            }
            $(siblingSelector).html(str);
            $(siblingSelector + ' option[value="' + selectedData + '"]').attr("selected","selected");// 选中 县区
            $(siblingSelector).trigger("chosen:updated");
        },
        complete: callback
    })
}
/* 分页跳转所用 */
function ajaxJump(datas) {
    $.ajax({
        url: ajaxUrl,
        data: datas,
        dataType: "JSON",
        beforeSend: function(response) {
            $(".table").after("<div id='loading'><div class='center pos_loading'></div></div>").attr("style", "opacity: 0.7");
        },
        success: function(response) {
            $(".table").attr("style", "opacity: 1").next("div#loading").remove();
            var linestr = "";
            var first_tr = $(".table").find("tr:eq(0)");// 获取表格表头一行
            sessionStorage.obj = JSON.stringify(response);// H5 sessionStorage 用于存储当前页码的筛选数据
            // console.log(response);// for debug
            if(response != null) {
                for(var i = 0; i < response.length; i++) {// 数据总行数 外层行循环
                    linestr += "<tr>";
                    // console.log(response[i]);// for debug
                    for(var j = 0; j < first_tr.find("th").length; j++) {// 每行 内层列循环
                        current_col = first_tr.find("th:eq(" + j + ")").attr("data-column");
                        if(current_col == "acturl") {// 渲染操作按钮
                            linestr += "<td class='text-center'>";
                            for(var k in response[i]["acturl"]) {// n个按钮
                                var a_href = response[i]["acturl"][k]["btn_url"], data_url = "";
                                if(typeof response[i]["acturl"][k]["is_ajax"] != "undefined") {// 非传统跳转交互
                                    a_href = "javascript:;";
                                    data_url = " data-url='" + response[i]["acturl"][k]["btn_url"] + "' ";
                                }
                                var ajax_load = response[i]["acturl"][k]["is_ajax"] == 1 ? " ajax-load " : "";// 约定值为1时交互为ajax弹窗页
                                var class_add = typeof response[i]["acturl"][k]["addClass"] != "undefined" ? response[i]["acturl"][k]["addClass"] : "";// 用于ajax交互，添加class样式来绑定监听所需事件，比如删除等
                                var imgurl = response[i]["acturl"][k]['imgurl']
                                // linestr += "<a href='" + a_href + "' class='btn btn-default " + ajax_load + class_add + "' " + data_url + ">" + response[i]["acturl"][k]["btn_word"] + "</a> ";
                                linestr += "<a href='" + a_href + "' class='" + ajax_load + class_add + "' " + data_url + "><img src='" + imgurl + "'></a> ";
                            }
                            linestr += "</td>";
                        } else {
                            current_func = first_tr.find("th:eq(" + j + ")").attr("data-func");// 执行字段渲染函数
                            if(typeof current_func != "undefined") {
                                f = eval(current_func);
                                response[i][current_col] = f(response[i]);// 调用函数，返回相关值
                            }
                            linestr += "<td class='text-center'>" + (response[i][current_col] != null ? response[i][current_col] : "") + "</td>";
                        }
                    }
                    linestr += "</tr>";
                }
            }
            $(".table tbody").html(linestr);
        }
    });
}
// 公共弹窗方法
function promptBoxHidden(val){
  $('.promptBox').fadeIn();
  $('.promptBox p').text(val);
  var clearTime = setTimeout(function(){
    $('.promptBox').fadeOut();
    clearTimeout(clearTime);
  },1000);
}
/* 声明并默认初始化调用函数 */
$.extend({
    jqSubmit: function(formId, other_check, callback) {
        var current_btn_submit = $(formId).find('button[type="submit"], input[type="submit"]');
        return $(formId).validate({
            submitHandler: function (o, a) {
                if(typeof other_check == 'function' && other_check() == false) {
                    $(formId).submit(function(e) { e.preventDefault(); });// 若有声明检查函数则执行该函数，阻止表单提交
                } else {
                    current_btn_submit.attr('data-loading-text', '数据提交中...');
                    current_btn_submit.button('loading').delay(1000);
                    $.post($(o).attr("action"), $(o).serialize(), function (response, textStatus, jqXHR) {
                        // console.log($(o).serialize());
                        console.log(response);// TODO
                        var data = response.data;
                        if(response.status == 0 && response.info != '表单不能重复提交') {
                            if(typeof response.hash_name != 'undefined' && typeof response.hash_value != 'undefined') {
                                $('input[name='+ response.hash_name + ']').val(response.hash_value);
                            }
                        }
                        if (response.info && response.info.length) {
                            layer.msg(response.info);
                        }
                        if ($.isFunction(callback)) callback(response);// 回调函数处理其他业务
                        current_btn_submit.button('reset');
                        /* 约定php返回的json中提示跳转url的键名为locate或url */
                        if (response.locate || response.url) {
                            _u = response.locate || response.url;
                            setTimeout(function() {
                                if(typeof data != 'undefined' && data.pos == 'self') {
                                    self.location.href = _u;
                                } else {
                                    parent.location.href = _u;
                                }
                            }, 1200);
                        }
                    });
                }
            }
        });
    },
    layerOpen: function(url, opt) {// layer弹窗函数
        return layer.open($.extend({
            type: 2,
            title: false,
            shadeClose: false,
            content: url,
            area: '860px',
            fix: false,
            offset: [($(window).height() - 500)/2+'px', ''],
            success: function(layero, index) {
                layer.iframeAuto(index);// 自适应iframe内部高度
            }
        }, opt));
    },
    layerClose: function() {// layer闭窗函数
        var index = parent.layer.getFrameIndex(window.name);
        parent.layer.close(index);
    },
    layerConfirm: function(confirm_msg, url, opt, callback) {
        option = $.extend({btn: ['确定', '取消']}, opt);
        layer.confirm(confirm_msg, option, function() {
          $.getJSON(url, function(response) {
            layer.msg(response.info);
            if ($.isFunction(callback)) callback(response);
            if (response.locate || response.url) {
              _u = response.locate || response.url;
              setTimeout(function() { parent.location.href = _u; }, 1200);
            }
          });
        });
    },
    zUpload: function(selector, zurl, callback, progress) {// fileupload文件上传函数
        var btn_upload = $(selector).siblings('button.btn-fileupload');
        var input_file_id = btn_upload.siblings('input[type="file"]').attr('id');
        $(selector).fileupload({
            url: zurl,
            dataType: 'json',
            sequentiaUploads: true,
            add: function(e, data) {
                btn_upload.attr('data-loading-text', '上传中');
                btn_upload.button('loading').delay(1000);
                btn_upload.click();
                data.submit();
            },
            done: function(e, response) {
                // console.log(response.result);
                if (response.result.info && response.result.info.length) {
                    layer.msg(response.result.info);
                }
                if(response.result.status == 0) {
                    $("#" + input_file_id + "_picture_progress").parent('div.progress').remove();
                    btn_upload.button('reset');
                    return;
                }
                var url = response.result.url;
                var img = $(selector).parent().parent().find('.updata_img_show img');
                if(img.length == 1) {
                    img.attr({src: UPLOAD_DIR + url});
                    img.siblings('input[type=hidden]').val(url);
                }
                var audio = $(selector).parent().parent().find('audio');
                if(audio.length == 1) {
                    audio.attr({src: UPLOAD_DIR + url});
                    audio.siblings('input[type=hidden]').val(url);
                }
                btn_upload.button('reset');
                if($.isFunction(callback)) return callback(e, response);
            },
            progressall: function(e, response) {
                var progress = parseInt(response.loaded / response.total * 100, 10);
                var str = '<div aria-valuemax="100" aria-valuemin="10" aria-valuenow="0" class="progress progress-striped active" role="progressbar" style="width: 100%; margin-bottom: 0; position: absolute; bottom: 0; opacity: 0.8;"><div class="progress-bar progress-bar-success" id="' + input_file_id + '_picture_progress" style="width:0%;"></div></div>';
                var prev_img = btn_upload.closest('.upfile').find('img');
                if(prev_img.length == 1) {
                    prev_img.next('div.progress').remove();
                    prev_img.after(str);
                    if($("#" + input_file_id + "_picture_progress").length > 0) {
                        $("#" + input_file_id + "_picture_progress").css('width', progress + '%');
                        $("#" + input_file_id + "_picture_progress").html(progress + '%');
                        $("#" + input_file_id + "_picture_progress").parent('div.progress').delay(3000).fadeOut();
                        if($.isFunction(progress)) return progress(e, response);
                    }
                }
            }
        }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');
    },
    ajaxLoad: function(selector, url, opt) {// 弹窗事件
        $(document).delegate(selector, 'click', function() {
            if(typeof url == 'undefined' || $.trim(url) == '') {
                var url = $(this).attr('data-url');
            }
            $.layerOpen(url, $.extend({title: $(this).text()}, opt));
        });
    }
});
// 闭包匿名
;(function() {
    //模拟下拉菜单
    $.fn.selectMenu = function(options) {
        var defaults = {
            menuselv: '#menuselv',
            option_v: 'li',
            option_d: 'data-id',
            sact: 'icon-sortup'
        }
        var settings = $.extend({}, defaults, options);
        _option_v = settings.option_v;
        _sact = settings.sact;
        _menuselv = settings.menuselv;
        _option_d = settings.option_d;
        _this = this;
        this.click(function(event) {
            event.stopPropagation();
            $(this).children().eq(1).toggle();
            $(this).children().eq(0).children().eq(0).toggleClass(_sact);
        }).find(_option_v).click(function(event) {
            event.stopPropagation();
            $(this).parent().prev().children().eq(1).text($(this).text()).prev().removeClass(_sact);
            $(this).parent().hide();
            $(_menuselv).val($(this).attr(_option_d));
            if ($(_menuselv).val()) {
                $(_menuselv).next().hide().removeClass('error').end().parent().closest('li').removeClass('error');
            }
        });
        $(document).click(function() {
            $(_this).children().eq(1).hide();
        });
    }
    //鼠标滑过，内容显示或隐藏
    //sAct代表选中状态
    $.fn.mousehover = function(sAct) {
        if (!sAct) var sAct = "act";
        this.hover(function() {
            $(this).addClass(sAct);
        }, function() {
            $(this).removeClass(sAct);
        });
    };
    /**
     * 选项卡切换
     * 参数1：tabCon 选项卡内页
     * 参数2：tabAct 选中状态
     * 参数3：effect 事件的名称
     */
    $.fn.ontab = function(options) {
        var defaults = {
            tabCon: '#tabcon div',
            tabAct: 'act',
            effect: 'click'
        }
        var settings = $.extend({}, defaults, options);
        this[settings.effect](function() {
            _tabAct = settings.tabAct;
            _tabCon = settings.tabCon;
            $(this).addClass(_tabAct).siblings().removeClass(_tabAct);
            if (_tabCon) {
                $(_tabCon).siblings().hide().eq($(this).index()).show();
            }
        });
    }
})();