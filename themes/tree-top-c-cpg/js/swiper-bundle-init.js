var swiper = new Swiper(".swiper-applications", {
    slidesPerView: 2,
    spaceBetween: 14,
    loop: true,
    speed: 400,
    autoplay: {
        delay: 2000,
      },
    pagination: {
        clickable: true,
      el: ".swiper-pagination",
    },
    breakpoints:  {
        600: {
            slidesPerView: 4,
        },
        1024: {
            slidesPerView: 6,
        }
    }
});

var swiper = new Swiper(".swiper-applications2", {
    slidesPerView: 2,
    spaceBetween: 14,
    //loop: true,
    speed: 400,
	//watchOverflow: true,
    autoplay: {
        delay: 2000,
      },
    pagination: {
        clickable: true,
      el: ".swiper-pagination",
    },
    breakpoints:  {
        600: {
            slidesPerView: 6,
        }
    }
});

var swiper = new Swiper(".swiper-options", {
    slidesPerView: 2,
    spaceBetween: 14,
    watchOverflow: true,
    loop: true,
    speed: 400,
    autoplay: {
        delay: 2000,
      },
    pagination: {
        clickable: true,
      el: ".swiper-pagination",
    },
    breakpoints:  {
        430: {
            slidesPerView: 3,
        },
    }
});

jQuery(".swiper-applications").hover(function() {
    (this).swiper.autoplay.stop();
}, function() {
    (this).swiper.autoplay.start();
});

jQuery(".swiper-options").hover(function() {
    (this).swiper.autoplay.stop();
}, function() {
    (this).swiper.autoplay.start();
});