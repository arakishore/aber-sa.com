$(document).ready(function(){
    $('a.slide-to').on('click',function(event){  
        event.preventDefault();
        var target = $(this).attr("href");
        var  scrollHeight = $(target).offset().top-75;
        $('html,body').animate({
        scrollTop: scrollHeight
        },	2000);
    });  
    /*  Animation */ 
    wow = new WOW({
        animateClass: 'animated',
        offset:       100,
        callback:     function(box) {
        console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
        }
    });
    wow.init();   
    
    var doc_width = $(document).width();
    if( doc_width < 992 ){
        // $(".trans-cate-section-col").addClass("swiper-slide").removeClass("col-sm-2 col-md-2 col-lg-2");
        // $(".trans-cate-section-row").addClass("swiper-wrapper").removeClass("row");
        // $(".trans-cate-section-respo").addClass("swiper-container trans-cate-respo-slider");

        $(".trans-counter-section-col").addClass("swiper-slide").removeClass("col-sm-4 col-md-4 col-lg-4");
        $(".trans-counter-section-row").addClass("swiper-wrapper").removeClass("row");
        $(".trans-counter-section-respo").addClass("swiper-container trans-counter-respo-slider");
    }

    $(".trans-footer-menu-head").on("click", function(){
        $(this).siblings("ul").slideToggle("slow");
    });

    var swiper = new Swiper('.trans-cate-respo-slider', {
        slidesPerView: 5,
        spaceBetween: 10,
        loop: true,        
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        breakpoints: {
            767: {
              slidesPerView: 3,
              spaceBetween: 10,
            },
            430: {
              slidesPerView: 2,
              spaceBetween: 10,
            },
            
          }      
      });
      var swiper = new Swiper('.trans-counter-respo-slider', {
        slidesPerView: 2,
        spaceBetween: 10,
        loop: true,        
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        breakpoints: {
            767: {
              slidesPerView: 1,
              spaceBetween: 10,
            },            
            
          }          
      });
});