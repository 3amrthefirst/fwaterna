var screenW = $(window).width(),
    sectionNum = $('.my-flex section').size(),
    mainW = $(window).width() * sectionNum,
    // headerH = $(window).height(),
    // topnav = $(".top-nav").outerHeight() + 32,
    // bottomnav = $(".bottom-nav").outerHeight() + 32,
    // calcs = HeaderW / 3,
    // navs = topnav + bottomnav,
    // lastslide = "-" + $(window).width() * 2,
    mr = "marginLeft",
    w = "width",
    x = 1,
    y = 1;
// maincontent = headerH,
// services = headerH - navs;


// $(document).ready(function () {
//     $(".my-flex").css(w, mainW);
//     $(".my-flex section , body").css(w, screenW);
//     console.log(mainW);
//     console.log(screenW);
// });
$('.owl-carousel').owlCarousel({
    loop: true,
    margin: 10,
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

$(".navv li").click(function () {
    $(this).addClass('active').siblings().removeClass('active');
});

// $(".center-box ").width(HeaderW);
// $(".main-content").width(calcs);
// $(document).ready(function () {
//     $(".center-box ").css(mr, screenW + "px");
// });




// $('.bg1').on('click', function () {
//     var click = $(this).data('clicks');
//     $(this).toggleClass("animrou");
//     if (x / 2 == 1) {
//         $(".center-box").css("marginLeft", screenW + "px");
//         $(".navv li:nth-child(3)").addClass('active').siblings().removeClass('active');
//         $(".loxe").addClass("min-imgboxan1").removeClass('min-imgboxan2');
//         x = x - 1;
//     } else {
//         $(".center-box").css(mr, "0px");
//         $(".navv li:nth-child(2)").addClass('active').siblings().removeClass('active');
//         $(".loxe").removeClass('min-imgboxan1').addClass("min-imgboxan2");
//         x = x + 1;
//     };
//     $(this).data('clicks', click + 1);
// });

// $('.bg3').on('click', function () {
//     var click = $(this).data('clicks');
//     $(this).toggleClass("animrou");
//     if (y / 2 == 1) {
//         $(".center-box").css("marginLeft", screenW + "px");
//         $(".navv li:nth-child(3) ").addClass('active').siblings().removeClass('active');
//         $(".loxe").removeClass('min-imgboxan1').addClass("min-imgboxan2");
//         y = x - 1;
//     } else {
//         $(".center-box").css(mr, lastslide + "px");
//         $(".navv li:nth-child(4) ").addClass('active').siblings().removeClass('active');
//         $(".loxe").removeClass('min-imgboxan2').addClass("min-imgboxan1");
//         y = x + 1;
//     };
//     $(this).data('clicks', click + 1);
// });










// $("#services").click(function () {
//     $(".center-box").addClass("mt");
//     $(".services").css("display", "block");
//     $(".bottom-nav").css("display", "none");
//     $(".to-top").fadeIn();
//     $(".services").animate({
//         opacity: 1,
//     }, 1500, function () {
//         // Animation complete.
//     });
// });
// $("#team").click(function () {
//     $(".center-box").addClass("mt");
//     $(".services , .bottom-nav").css("display", "none");
//     $(".team").css("display", "block");
//     $(".to-top").fadeIn();
//     $(".team").animate({
//         opacity: 1,
//     }, 1500, function () {
//         // Animation complete.
//     });
// });

// $("#contact").click(function () {
//     $(".center-box").addClass("mt");
//     $(".team , .bottom-nav , .services").css("display", "none");
//     $(".contact").css("display", "block");
//     $(".to-top").fadeIn();
//     $(".contact").animate({
//         opacity: 1,
//     }, 1500, function () {
//         // Animation complete.
//     });
// });
// $("#clients").click(function () {
//     $(".center-box").addClass("mt");
//     $(".team , .bottom-nav ,.services,.contact").css("display", "none");
//     $(".clients").css("display", "block");
//     $(".to-top").fadeIn();
//     $(".clients").animate({
//         opacity: 1,
//     }, 1500, function () {
//         // Animation complete.
//     });
// });
// $("#faq").click(function () {
//     $(".center-box").addClass("mt");
//     $(".team , .bottom-nav ,.services,.contact , .clients").css("display", "none");
//     $(".faq").css("display", "block");
//     $(".to-top").fadeIn();
//     $(".faq").animate({
//         opacity: 1,
//     }, 1500, function () {
//         // Animation complete.
//     });
// });
// $("#roro").click(function () {
//     $(".center-box").addClass("mt");
//     $(".services").css("display", "none");
//     $(".team , .bottom-nav , .clients , .services, .contact ,.faq").css("display", "none");
//     $(".syn").css("display", "block");
//     $(".to-top").fadeIn();
//     $(".syn").animate({
//         opacity: 1,
//     }, 1500, function () {
//         // Animation complete.
//     });
// });

// $(".zozoz").click(function () {
//     $(".consoul").toggleClass("open-con");
//     $(".to-top").fadeIn();
// });
// $(".to-top").click(function () {
//     $(".center-box").removeClass("mt");
//     $(".bottom-nav").css("display", "flex");
//     $(".to-top").fadeOut();
//     $(".consoul").removeClass("open-con");

// });



// $(".addqu").click(function(){
//     $(".faq .consoul").toggleClass("open-con");
// });


$("#nono").click(function () {
    $(".small-nav").addClass("open-snv");
});
$(".tota").click(function () {
    $(".small-nav").removeClass("open-snv");
});



// $(".ques").click(function () {
//     $(this).toggleClass("os").siblings().removeClass("os");
//     $(".an").slideUp();
//     $(".os .an").slideDown();

// });

var sectionNum = $('.my-flex section').size(),
    zc = -100
n = 1,
    r = n * zc;
xe = $(".navv li").length;
//     zc2 = "-200%";
// $(".navv li").click(function () {

//     $(".my-flex").animate({
//         marginLeft: zc,
//     }, 500, function () {
//         // Animation complete.
//     });
// });




var xv = ["mr-1 ", "mr-2 ", "mr-3 ", "mr-4 ", "mr-5 ", "mr-6 ", "mr-7 ", "mr-8 ", "mr-9 "],
    kj = xv.length;
$('.navv li:nth-child(1)').on('click', function () {
    for (i = 0; i < xv.length; i++) {
        $(".my-flex").removeClass(xv[i])
    }
    $(".my-flex").addClass("mr-1");
    console.log("wtf");
});
$('.navv li:nth-child(2)').on('click', function () {
    for (i = 0; i < xv.length; i++) {
        $(".my-flex").removeClass(xv[i])
    }
    $(".my-flex").addClass("mr-2");
});
$('.navv li:nth-child(3)').on('click', function () {
    for (i = 0; i < xv.length; i++) {
        $(".my-flex").removeClass(xv[i])
    }
    $(".my-flex").addClass("mr-3");
});
$('.navv li:nth-child(4)').on('click', function () {
    for (i = 0; i < xv.length; i++) {
        $(".my-flex").removeClass(xv[i])
    }
    $(".my-flex").addClass("mr-4");
});
$('.navv li:nth-child(5)').on('click', function () {
    for (i = 0; i < xv.length; i++) {
        $(".my-flex").removeClass(xv[i])
    }
    $(".my-flex").addClass("mr-5");
});
$('.navv li:nth-child(6)').on('click', function () {
    for (i = 0; i < xv.length; i++) {
        $(".my-flex").removeClass(xv[i])
    }
    $(".my-flex").addClass("mr-6");
});
$('.navv li:nth-child(7)').on('click', function () {
    for (i = 0; i < xv.length; i++) {
        $(".my-flex").removeClass(xv[i])
    }
    $(".my-flex").addClass("mr-7");
});
$('.navv li:nth-child(8)').on('click', function () {
    for (i = 0; i < xv.length; i++) {
        $(".my-flex").removeClass(xv[i])
    }
    $(".my-flex").addClass("mr-8");
});
$('.navv li:nth-child(9)').on('click', function () {
    for (i = 0; i < xv.length; i++) {
        $(".my-flex").removeClass(xv[i])
    }
    $(".my-flex").addClass("mr-9");
});


$(".ques").click(function () {
    $(this).toggleClass("os").siblings().removeClass("os");
    $(".an").slideUp();
    $(".os .an").slideDown();
    $(this).addClass('active').siblings().removeClass('active');
});



