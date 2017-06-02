/**
 * Created by TS-034-SZ on 2016/11/24.
 */

var stage ={}
window.location.search.slice(1).split("&").forEach(function(i){
    var key = i.split("=")[0], val = i.split("=")[1];
    if (key) {
        stage[key] = decodeURIComponent(val);
    }
})
function getUrlParam(name) {
	var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
	var r = window.location.search.substr(1).match(reg); //匹配目标参数
	if (r != null)
		return unescape(r[2]);
	return null; //返回参数值
}
// 弹窗插件
;(function(){
    function alertBox(opts){

        this.opt={
            bgclass:'background:#000;opacity:0.5;top:0px;left:0px;position:fixed;z-index:10000;height:100%;width:100%;',
            divclass:'top:50%;left:50%;position:fixed;z-index:10001;max-width:70%;min-width:400px;',
            msgclass:'background:#fff;top:-50%;right:50%;position:relative;z-index:10001;border-radius:5px;color:#000;border: 1px solid #d6dee4;',
            fcallfn:false,
            tcallfn:false,
            tcallfn_no:function(){return true},
            tcallfn_tx:'保存',
            fcallfn_tx:'关闭',
            alerttap:1,
            ishide:false,
            tcallfn_class:'color:#007aff;width:50%;display:inline-block;text-align:center;line-height:32px;cursor: pointer',
            fcallfn_class:'color:#007aff;width:50%;display:inline-block;text-align:center;line-height:32px;',
            ts_class:'border:0px;width:100%;color:#007aff;display:inline-block;text-align:center;line-height:32px;cursor: pointer'
        }
        this.settings(opts)
        this.inits(this.opt)
    }
    alertBox.prototype={
        inits:function(opt){
        	$('.alertboxbg').remove()
            $('.alretboxmian').remove()
            var _this = this
            var txhtml
            if(opt.alerttap == 1){
                txhtml= '<div id="alertboxbg" class="alertboxbg" style="'+opt.bgclass+'"></div><div id="alretboxmian" class="alretboxmian" style="'+opt.divclass+'"><div style="'+opt.msgclass+'"><div style="">'+opt.msg+'</div>'+
                    '<p class="alertbox_button" style="border-top:1px solid #d6dee4;background-color: #f8fafc;padding: 15px 0;"><span style="'+opt.tcallfn_class+'"><span id="alertboxtrue" style="cursor: pointer;width: 120px;display: inline-block;border: 1px solid #009bff;color:#fff;background-color:#009bff;border-radius:120px; ">'+opt.tcallfn_tx+'</span></span>'+
                    '<span style="'+opt.fcallfn_class+'"><span id="alertboxfalse" style="cursor: pointer;width: 120px;display: inline-block;border: 1px solid #d6dee4;color:#859dad;border-radius:120px; ">'+opt.fcallfn_tx+'</span></span></p></div></div>'
            }else{
                txhtml= '<div id="alertboxbg" class="alertboxbg" style="'+opt.bgclass+'"></div><div id="alretboxmian" class="alretboxmian" style="'+opt.divclass+'"><div style="'+opt.msgclass+'"><div style="">'+opt.msg+'</div>'+
                    '<p class="alertbox_button" style="border-top:1px solid #d6dee4;background-color: #f8fafc;padding: 15px 0;">'+
                    '<span style="color:#007aff;width:100%;display:inline-block;text-align:center;line-height:32px;"><span id="alertboxfalse" style="cursor: pointer;width: 120px;display: inline-block;border: 1px solid #d6dee4;color:#859dad;border-radius:120px; ">'+opt.fcallfn_tx+'</span></span></p></div></div>'
            }
            $('body').append(txhtml)
            if(opt.ishide){
            	$("#alertboxbg").hide()
  		        $("#alretboxmian").hide()
            }
            $('#alretboxmian').css('margin-top',-($('#alretboxmian').height()/2)+'px')
            $('#alertboxtrue').unbind().bind('click',function(){
               
                if(_this.opt.tcallfn){
                    _this.opt.tcallfn()
                    if(!_this.opt.tcallfn_no()){
                    	return false;
                    }
                }
                _this.hidealerbox()
            })
            $('#alertboxfalse').unbind().bind('click',function(){
                
                if(_this.opt.fcallfn){
                    _this.opt.fcallfn()
                }
                _this.hidealerbox()
            })
        },
        hidealerbox:function(){
            $('.alertboxbg').remove()
            $('.alretboxmian').remove()
        },
        settings:function(opts){
            for(var i in opts){
                //this.opt
                this.opt[i] = opts[i]
            }
            return this.opt
        }
    }
    window.alertbox = function(options){
        return new alertBox(options)
    }
})(window,document)

function alertmsg(msg){
    alertbox({
        msg:msg,
        alerttap:0
    })
}
$(function(){

	$('body').on('click','.radio_label_click',function(){
		console.log(444)
	    var i_icon = $(this).siblings('.radio_label_click').find('i')
	    if(i_icon.is('.radio_yes')){
	        i_icon.removeClass('radio_yes').addClass('radio_no')
	    }
	    $(this).find('i').addClass('radio_yes').removeClass('radio_no')
	})
})
//上传图片
$(function(){
	$('body').on('change','.input_load_com',function(){
		var allowExtention=".jpg,.jpeg,.bmp,.gif,.png";//允许上传文件的后缀名
		var extention=$(this).val().substring($(this).val().lastIndexOf(".")+1).toLowerCase();
		var browserVersion= window.navigator.userAgent.toUpperCase();
		var url,loadimg= $(this).parent().siblings('.load_img_com');
		if(!(allowExtention.indexOf(extention)>-1)){
			alertbox({msg:'上传正确的图片',alerttap:10,tcallfn_tx:'确定'})
			return false;
		}
		if (navigator.userAgent.indexOf("MSIE")>=1) { // IE
			loadimg.attr('src',$(this).val())
		} else {
			loadimg.attr( 'src',window.URL.createObjectURL($(this)[0].files.item(0)))
		}
	})
	$('body').on('change','.input_load_coms',function(){
		console(this.value);
		var allowExtention=".jpg,.jpeg,.bmp,.gif,.png";//允许上传文件的后缀名
		var extention=$(this).val().substring($(this).val().lastIndexOf(".")+1).toLowerCase();
		var browserVersion= window.navigator.userAgent.toUpperCase();
		var url,loadimg= $(this).siblings('.load_img_com');
		if(!(allowExtention.indexOf(extention)>-1)){
			alertbox({msg:'上传正确的图片',alerttap:10,tcallfn_tx:'确定'})
			return false;
		}
		if (navigator.userAgent.indexOf("MSIE")>=1) { // IE
			loadimg.attr('src',$(this).val())
		} else {
			loadimg.attr( 'src',window.URL.createObjectURL($(this)[0].files.item(0)))
		}
	})

	$('.clickshow').click(function(){
		$('.clickhidediv').show()
	})
	$('.clickhide').click(function(){
		$('.clickhidediv').hide()
	})
	$('.quesi_span').click(function(){
		if($(this).find('img').is(':hidden')){
			$(this).find('img').show()
		}else{
			$(this).find('img').hide()
		}
			
	})
	$('#delforwardiframe').click(function(){
		$('#forwardiframe').attr('src','')
		$('#delforwardiframemian').hide()
	})
})
function isURL(str_url) {// 验证url
	return!!str_url.match(/(^https?:(?:\/\/)?)/g);
}