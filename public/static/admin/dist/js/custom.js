/**
 * AdminLTE Demo Menu
 * ------------------
 * You should not use this file in production.
 * This file is for demo purposes only.
 */
$(function () {


    //Flat red color scheme for iCheck(复选框和单选框样式)
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass   : 'iradio_flat-blue'
    })

    // To make Pace works on Ajax calls（ajax加载动作条）
    // $(document).ajaxStart(function () {
    //     Pace.restart()
    // })

    //自动展开高亮导航栏
    $(function () {
        var nav_id = $.cookie('nav_id');
        if(nav_id){
            $("#" + nav_id).addClass('active');
            $("#" + nav_id).parents('li').addClass('active');
        }
    })

    //导航栏点击事件
    $('.left-nav-li').click(function () {
        var nav_id = $(this).attr('id');
        $.cookie('nav_id',nav_id,{ path: "/"});
    })
})

/********************************  公共方法  *********************************/

/**
 * button 按钮跳转事件
 */
$('button').click(function(){
    var href = $(this).attr('href');
    if(href){
        window.location.href=href;
    }
})

/**
 * sweet版确认框
 *
 * @param message
 * @param callback
 */
function sweetConfirm(message,callback) {

    if(typeof(message) == 'string'){
        var swal_title = message;
    }else if(typeof(message) == 'object'){
        var swal_title = message.title;
        var swal_text = message.text;
        var swal_type = message.type;
    }else if(typeof(message) == 'function'){
        callback = message;
    }

    swal({
        title: swal_title ? swal_title : '警告',
        text: swal_text ? swal_text : '',
        type: swal_type ? swal_type :"warning",
        showCancelButton: true,
        showLoaderOnConfirm: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "确定",
        cancelButtonText: "取消",
        closeOnConfirm: false,
        closeOnCancel: true
    },callback);
}