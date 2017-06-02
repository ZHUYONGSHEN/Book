$(document).ready(function() {
    $('.navbar-toggle').click(function(e) {
        e.preventDefault();
        $('.nav-sm').html($('.navbar-collapse').html());
        $('.sidebar-nav').toggleClass('active');
        $(this).toggleClass('active');
    });
    var $sidebarNav = $('.sidebar-nav');
    // Hide responsive navbar on clicking outside
    $(document).mouseup(function(e) {
        if (!$sidebarNav.is(e.target) // if the target of the click isn't the container...
            && $sidebarNav.has(e.target).length === 0 && !$('.navbar-toggle').is(e.target) && $('.navbar-toggle').has(e.target).length === 0 && $sidebarNav.hasClass('active')) // ... nor a descendant of the container
        {
            e.stopPropagation();
            $('.navbar-toggle').click();
        }
    });
    //编辑H5楼盘页面，编辑楼盘价格页面，加号按钮所用
    $('.click_copy_btn i').on('click', function() {
        var _cophtml = $(this).closest(".click_copy_btn").siblings('.copy_html'),
            _clon = _cophtml.last().clone(),
            _len = _cophtml.length;
        _clon.find('input[name^=area]').each(function() {
            n = $(this).data('n') + 1;
            $(this).attr('data-n', n);
            $(this).attr('name', 'area[' + n + '][' + $(this).data('k') + ']');
            $(this).val('');
        });
        _clon.find('input[name^=views]').each(function() {
            n = $(this).data('n') + 1;
            $(this).attr('data-n', n);
            $(this).attr('name', 'views[' + n + '][' + $(this).data('k') + ']');
            $(this).val('');
        });
        _cophtml.eq(_len - 1).after(_clon);
    });
    $('.tag_name label').on('click', function() {
        var _inde = $(this).index();
        $(this).parent().next('div').children('div.form-group').eq(_inde).show().siblings('div.form-group').hide();
    });
    $('.type_tag label').on('click', function() {
        var _inde = $(this).index();
        $(this).parent().parent().next('div').children('div.type_tag_box').eq(_inde).show().siblings('div.type_tag_box').hide();
    });
    $('.no-off label').on('click', function() {
        var _fainde = $(this).closest('div.h5loupan-show-list').index() - 2,
            _inde = $(this).index();
        if (_inde == 0) $('.h5loupan').children('div.div_half').eq(_fainde).find('div.list-item').attr('style', 'visibility: visible');
        else $('.h5loupan').children('div.div_half').eq(_fainde).find('div.list-item').attr('style', 'visibility: hidden');
    });
    $('.is_tx').click(function() {
        $(".not-go").hide();
        $('#tengxun-box label').html('腾讯街景url');
        $('.hongbao-url').html('添加红包腾讯地址:');
        $('.tengxun-box').show();
        $('.box-720').hide()
    });
    $('.is_720').click(function() {
        $(".not-go").show();
        $('#tengxun-box label').html('720全景url');
        $('.hongbao-url').html('添加720红包全景地址：');
        $('.tengxun-box').hide();
        $('.box-720').show();
    });
    //highlight current / active link
    $('ul.main-menu li a').each(function() {
        if ($($(this))[0].href == String(window.location)) $(this).parent().addClass('active');
    });
    $('.accordion > a').click(function(e) {
        e.preventDefault();
        var $ul = $(this).siblings('ul');
        var $li = $(this).parent();
        if ($ul.is(':visible')) $li.removeClass('active');
        else $li.addClass('active');
        $ul.slideToggle();
    });
    $('.accordion li.active:first').parents('ul').slideDown();
    //other things to do on document ready, separated for ajax calls
    docReady();
});

function docReady() {
    $('a[href="#"][data-top!=true]').click(function(e) {
        e.preventDefault();
    });
}