/**
 * Created by dw on 2017/6/18.
 */
eg={};
eg.tophdPadding=$(".top-hd");
eg.mainContent=$(".main-cont");
eg.sideNav=$(".side-nav");
eg.fullScreen=function () {
    eg.tophdPadding.css({paddingLeft:0 });
    eg.mainContent.css({paddingLeft:0 });
    eg.sideNav.css({display:"none"});
};
eg.noFullScreen=function () {
    eg.tophdPadding.css({paddingLeft:250 });
    eg.mainContent.css({paddingLeft:235});
    eg.sideNav.css({display:"block"});
};
$(function () {
    $(".hd-lt").click(function () {
        if (eg.sideNav.css("display")==="block"){
                $(this).text("缩小显示");
                eg.fullScreen();}
        else {eg.noFullScreen();
            $(this).text("全屏显示");
            console.log("suo");
        }
    });//是否全屏显示
    $("dt").toggle(function(){//如果点击，全部子目录隐藏，当前子目录显示。
        $(this).siblings().hide();
        console.log("dddd");
    },function (){
        $("dt").siblings().hide();
        $(this).siblings().show();
    });//是否隐藏子目录*/
    $("h2").click(function () {
        $("dt").siblings().hide();
    });
});

