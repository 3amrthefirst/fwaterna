var screenW = "-" + $(window).width(),
    HeaderW = $(window).width() * 3,
    headerH = $(window).height(),
    topnav = $(".top-nav").outerHeight() + 32,
    bottomnav = $(".bottom-nav").outerHeight() + 32,
    calcs = HeaderW / 3,
    navs = topnav + bottomnav,
    lastslide = "-" + $(window).width() * 2,
    mr = "marginRight",
    x = 1,
    y = 1,
    maincontent = headerH,
    services = headerH - navs;



$('.owl-carousel').owlCarousel({
    loop: true,
    margin: 10,
    rtl:true,
    autoplay: true,
    autoplayTimeout: 2000,
    autoplayHoverPause: true,
    responsiveClass: true,
    responsive: {
        0: {
            items: 1,
            nav: true
        },
        600: {
            items: 3,
            nav: true
        },
        1000: {
            items: 5,
            nav: true,
            loop: true
        }
    }
})



$(".center-box ").width(HeaderW);
$(".main-content").width(calcs);
$(document).ready(function () {
    $(".center-box ").css(mr, screenW + "px");
});
$(".navv li").click(function () {
    $(this).addClass('active').siblings().removeClass('active');
    if ($(this).is(".zozoz")) {
        console.log("dd");
    } else {
        $(".center-box").removeClass("mt");
    };
});
$(".navv li:nth-child(2) ").click(function (e) {
    e.preventDefault();
    $(".center-box").css(mr, "0px");

});
$(".navv li:nth-child(3) ").click(function (e) {
    e.preventDefault();
    $(".center-box").css("marginRight", screenW + "px")
});
$(".navv li:nth-child(4) ").click(function (e) {
    e.preventDefault();
    $(".center-box").css(mr, lastslide + "px");
});



$('.bg1').on('click', function () {
    var click = $(this).data('clicks');
    $(this).toggleClass("animrou");
    if (x / 2 == 1) {
        $(".center-box").css("marginRight", screenW + "px");
        $(".navv li:nth-child(3)").addClass('active').siblings().removeClass('active');
        $(".loxe").addClass("min-imgboxan1").removeClass('min-imgboxan2');
        x = x - 1;
    } else {
        $(".center-box").css(mr, "0px");
        $(".navv li:nth-child(2)").addClass('active').siblings().removeClass('active');
        $(".loxe").removeClass('min-imgboxan1').addClass("min-imgboxan2");
        x = x + 1;
    };
    $(this).data('clicks', click + 1);
});

$('.bg3').on('click', function () {
    var click = $(this).data('clicks');
    $(this).toggleClass("animrou");
    if (y / 2 == 1) {
        $(".center-box").css("marginRight", screenW + "px");
        $(".navv li:nth-child(3) ").addClass('active').siblings().removeClass('active');
        $(".loxe").removeClass('min-imgboxan1').addClass("min-imgboxan2");
        y = x - 1;
    } else {
        $(".center-box").css(mr, lastslide + "px");
        $(".navv li:nth-child(4) ").addClass('active').siblings().removeClass('active');
        $(".loxe").removeClass('min-imgboxan2').addClass("min-imgboxan1");
        y = x + 1;
    };
    $(this).data('clicks', click + 1);
});










$("#services").click(function () {
    $(".center-box").addClass("mt");
    $(".services").css("display", "block");
    $(".bottom-nav").css("display", "none");
    $(".to-top").fadeIn();
    $(".services").animate({
        opacity: 1,
    }, 1500, function () {
        // Animation complete.
    });
});
$("#team").click(function () {
    $(".center-box").addClass("mt");
    $(".services , .bottom-nav").css("display", "none");
    $(".team").css("display", "block");
    $(".to-top").fadeIn();
    $(".team").animate({
        opacity: 1,
    }, 1500, function () {
        // Animation complete.
    });
});

$("#contact").click(function () {
    $(".center-box").addClass("mt");
    $(".team , .bottom-nav , .services").css("display", "none");
    $(".contact").css("display", "block");
    $(".to-top").fadeIn();
    $(".contact").animate({
        opacity: 1,
    }, 1500, function () {
        // Animation complete.
    });
});
$("#clients").click(function () {
    $(".center-box").addClass("mt");
    $(".team , .bottom-nav ,.services,.contact").css("display", "none");
    $(".clients").css("display", "block");
    $(".to-top").fadeIn();
    $(".clients").animate({
        opacity: 1,
    }, 1500, function () {
        // Animation complete.
    });
});
$("#faq").click(function () {
    $(".center-box").addClass("mt");
    $(".team , .bottom-nav ,.services,.contact , .clients").css("display", "none");
    $(".faq").css("display", "block");
    $(".to-top").fadeIn();
    $(".faq").animate({
        opacity: 1,
    }, 1500, function () {
        // Animation complete.
    });
});
$("#roro").click(function () {
    $(".center-box").addClass("mt");
    $(".services").css("display", "none");
    $(".team , .bottom-nav , .clients , .services, .contact ,.faq").css("display", "none");
    $(".syn").css("display", "block");
    $(".to-top").fadeIn();
    $(".syn").animate({
        opacity: 1,
    }, 1500, function () {
        // Animation complete.
    });
});

$(".zozoz").click(function () {
    $(".consoul").toggleClass("open-con");
    $(".to-top").fadeIn();
});
$(".to-top").click(function () {
    $(".center-box").removeClass("mt");
    $(".bottom-nav").css("display", "flex");
    $(".to-top").fadeOut();
    $(".consoul").removeClass("open-con");

});



$(".addqu").click(function(){
    $(".faq .consoul").toggleClass("open-con");
});


$("#nono ").click(function () {
    $("section").toggleClass("open-sec");
});
$(".tota").click(function () {
    $(".small-nav").removeClass("open-snv");
});




$(".ques").click(function () {
    $(this).toggleClass("os").siblings().removeClass("os");
    $(".an").slideUp();
    $(".os .an").slideDown();
    
});