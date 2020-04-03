!function(a,e,n){"use strict";var o={"theme-primary":"linear-gradient(118deg, #7367f0, rgba(115, 103, 240, 0.7))","theme-success":"linear-gradient(118deg, #28c76f, rgba(40, 199, 111, 0.7))","theme-danger":"linear-gradient(118deg, #ea5455, rgba(234, 84, 85, 0.7))","theme-info":"linear-gradient(118deg, #00cfe8, rgba(0, 207, 232, 0.7))","theme-warning":"linear-gradient(118deg, #ff9f43, rgba(255, 159, 67, 0.7))","theme-dark":"linear-gradient(118deg, #1e1e1e, rgba(30, 30, 30, 0.7))"},s={"theme-primary":"0 0 10px 1px rgba(115, 103, 240, 0.7)","theme-success":"0 0 10px 1px rgba(40, 199, 111, 0.7)","theme-danger":"0 0 10px 1px rgba(234, 84, 85, 0.7)","theme-info":"0 0 10px 1px rgba(0, 207, 232, 0.7)","theme-warning":"0 0 10px 1px rgba(255, 159, 67, 0.7)","theme-dark":"0 0 10px 1px rgba(30, 30, 30, 0.7)"},r={"theme-default":"#fff","theme-primary":"#7367f0","theme-success":"#28c76f","theme-danger":"#ea5455","theme-info":"#00cfe8","theme-warning":"#ff9f43","theme-dark":"#adb5bd"},t={"theme-primary":"-65px -54px","theme-success":"-120px -10px","theme-danger":"-10px -10px","theme-info":"-10px -54px","theme-warning":"-120px -54px","theme-dark":"-65px -10px"},d=n("body"),i=(n(".app-content"),n(".main-menu")),l=(n(".menu-content"),n(".footer")),c=n(".header-navbar"),b=n(".horizontal-menu-wrapper .header-navbar"),v=n(".header-navbar-shadow"),m=n(".toggle-icon"),f=n("#collapse-sidebar-switch"),g=n(".customizer"),h=n(".brand-logo");if(n(".customizer-toggle").on("click",function(a){a.preventDefault(),n(g).toggleClass("open")}),n(".customizer-close").on("click",function(){n(g).removeClass("open")}),n(".customizer-content").length>0)new PerfectScrollbar(".customizer-content");n(e).on("click","#customizer-theme-colors .color-box",function(){var a=n(this);a.siblings().removeClass("selected"),a.addClass("selected");var e=n(this).data("color"),l=o[e],c=s[e],v=r[e],f=t[e];"horizontal-menu"==d.data("menu")?b.find("li.sidebar-group-active:not(.dropdown-submenu)").length&&(b.find("li.sidebar-group-active:not(.dropdown-submenu)  > a").css({background:l,"box-shadow":c,"border-color":v}),b.find("li.sidebar-group-active:not(.dropdown-submenu)  > ul li.active > a").css({color:v})):i.find("li.active").length?i.find("li.active >a").css({background:l,"box-shadow":c}):n(".main-menu-content").find("li.sidebar-group-active").length?n(".main-menu-content").find("li.sidebar-group-active > a").css({background:l,"box-shadow":c}):i.find(".nav-item.active a").css({background:l,"box-shadow":c}),n(".brand-text").css("color",v),m.removeClass("primary").css("color",v),h.css("background-position",f)}),n(".layout-name").on("click",function(){var a=n(this).data("layout");d.removeClass("dark-layout semi-dark-layout").addClass(a),""===a?(i.removeClass("menu-dark").addClass("menu-light"),c.removeClass("navbar-dark").addClass("navbar-light")):i.removeClass("menu-light").addClass("menu-dark")});var p=d.data("layout");n(".layout-name[data-layout='"+p+"']").prop("checked",!0),f.on("click",function(){n(".modern-nav-toggle").trigger("click"),i.trigger("mouseleave")}),d.hasClass("menu-collapsed")?f.prop("checked",!0):f.prop("checked",!1),n("#customizer-navbar-colors .color-box").on("click",function(){var a=n(this);a.siblings().removeClass("selected"),a.addClass("selected");var e=a.data("navbar-color");e?n(".app-content > .header-navbar").removeClass("bg-primary bg-success bg-danger bg-info bg-warning bg-dark").addClass(e+" navbar-dark"):n(".app-content > .header-navbar").removeClass("bg-primary bg-success bg-danger bg-info bg-warning bg-dark navbar-dark"),d.hasClass("dark-layout")&&c.addClass("navbar-dark")}),d.hasClass("horizontal-menu")&&(n("#collapse-sidebar").addClass("d-none"),n(".menu_type").removeClass("d-none"),n(".navbar_type").addClass("d-none"),n(".navbar-type #navbar-hidden").closest("fieldset").parent("div").css("display","none"),n(a).scroll(function(){d.hasClass("navbar-static")&&(n(a).scrollTop()>65?(n(".horizontal-menu .header-navbar.navbar-fixed").css({background:"#fff","box-shadow":"0 4px 20px 0 rgba(0,0,0,.05)"}),n(".horizontal-menu .horizontal-menu-wrapper.header-navbar").css("background","#fff")):(n(".horizontal-menu .header-navbar.navbar-fixed").css({background:"#f8f8f8","box-shadow":"none"}),n(".horizontal-menu .horizontal-menu-wrapper.header-navbar").css("background","#fff")))})),n("#navbar-hidden").on("click",function(){c.addClass("d-none"),v.addClass("d-none"),d.removeClass("navbar-static navbar-floating navbar-sticky").addClass("navbar-hidden")}),n("#navbar-static").on("click",function(){d.hasClass("horizontal-menu")?(b.removeClass("d-none floating-nav fixed-top navbar-fixed"),d.removeClass("navbar-hidden navbar-floating navbar-sticky").addClass("navbar-static")):(v.addClass("d-none"),c.removeClass("d-none floating-nav fixed-top").addClass("static-top"),d.removeClass("navbar-hidden navbar-floating navbar-sticky").addClass("navbar-static"))}),n("#navbar-floating").on("click",function(){d.hasClass("horizontal-menu")?(b.removeClass("d-none fixed-top static-top").addClass("floating-nav"),d.removeClass("navbar-static navbar-hidden navbar-sticky").addClass("navbar-floating")):(v.removeClass("d-none"),c.removeClass("d-none static-top fixed-top").addClass("floating-nav"),d.removeClass("navbar-static navbar-hidden navbar-sticky").addClass("navbar-floating"))}),n("#navbar-sticky").on("click",function(){d.hasClass("horizontal-menu")?(b.removeClass("d-none floating-nav static-top navbar-fixed").addClass("fixed-top"),d.removeClass("navbar-static navbar-floating navbar-hidden").addClass("navbar-sticky")):(v.addClass("d-none"),c.removeClass("d-none floating-nav static-top").addClass("fixed-top"),d.removeClass("navbar-static navbar-floating navbar-hidden").addClass("navbar-fixed"))}),n("#footer-hidden").on("click",function(){l.addClass("d-none"),d.removeClass("footer-static fixed-footer").addClass("footer-hidden")}),n("#footer-static").on("click",function(){d.removeClass("fixed-footer"),l.removeClass("d-none").addClass("footer-static"),d.removeClass("footer-hidden fixed-footer").addClass("footer-static")}),n("#footer-sticky").on("click",function(){d.removeClass("footer-static footer-hidden").addClass("fixed-footer"),l.removeClass("d-none footer-static")}),n("#hide-scroll-top-switch").on("click",function(){var a=n(".scroll-top");n(this).prop("checked")?a.addClass("d-none"):a.removeClass("d-none")})}(window,document,jQuery);
