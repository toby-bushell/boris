var boris = {};

/*
**  Scroll reveal
*/
window.sr = ScrollReveal();
sr.reveal('.c-featured__single', {distance: '60px'} );


/*
**  Typed js for homepage, edits made to script for delays
*/

$(function(){

  var counter = 0;
    $(".js-home-hero").typed({
        strings: ["We Build ^ <br>Experiences.", "We Build <br>Connections.", "^We Just Build Great<br> Websites^."],
        typeSpeed: 30,
        backDelay: 1000,
        showCursor: false,
      	callback: function() {
          $('.c-home-hero').addClass('typed');
        },

    });
});


/*
**  Contact page weather api
*/

boris.weather = {
  init: function() {
    this.getWeather();
  },
  getWeather: function() {
    var url = 'http://api.openweathermap.org/data/2.5/weather?q=London,uk&appid=6350e4b6b96f525e13a6b1a6bafaacf6';
    $.ajax({
      url : url,
      dataType: "jsonp",
      success: function(data){
        boris.weather.renderWeather(data);
      }

    });
  },
  renderWeather: function(data) {
    // Get weather conditions
    var currentWeather = data.weather[0].main;
    var sunset = data.sys.sunset;
    var sunrise = data.sys.sunrise;
    var currentTime = Math.floor(new Date().getTime() / 1000);
    var dayOrNight;
    var currentTemp = Math.round(data.main.temp -273.15);


    if(currentTime < sunset && currentTime > sunrise) {
      dayOrNight = 'day';
    }else {
      dayOrNight = 'night';
    }

    switch(currentWeather) {
      case 'Clouds' :
        var weather_icon = 'icon-clouds';
      break;
    case 'Rain' :
        var weather_icon = 'icon-rain';
      break;
    case 'Clear' :
        var weather_icon = 'icon-sun';
      break;
    case 'Snow' :
        var weather_icon = 'icon-snow-heavy';
      break;
    }

    this.applyClass(currentWeather, weather_icon, currentTemp, currentTime, dayOrNight);

  },

  applyClass: function(weather, weather_icon, temp, time, dayOrNight) {

    $('.c-contact-hero__weather-icon').addClass(weather_icon);
    var temperature = temp + '&deg; C';
    $('.c-contact-hero__temp').html(temperature);
    var getTime = new Date();
    var current_hour = getTime.getHours();
    var current_min  = (getTime.getMinutes() <10?'0':'')+ getTime.getMinutes();
    var current_time = current_hour + ':' + current_min;
    var randomNumber = Math.floor(Math.random() * 2) + 1;


    $('.c-contact-hero__time').html(current_time);

    // Have an image for cloudy during day so trigger that if the moment is right!
    if(dayOrNight === 'day' && weather === 'Clouds') {
      $('.c-contact-hero').addClass('c-contact-hero__'+dayOrNight +'-' + weather);
    }else if (dayOrNight === 'day' && weather === 'Rain') {
      $('.c-contact-hero').addClass('c-contact-hero__'+dayOrNight + '-' + weather);
    }else if (dayOrNight === 'day') {
      $('.c-contact-hero').addClass('c-contact-hero__'+dayOrNight + '-' + randomNumber);
    }else if (dayOrNight === 'night'){
      $('.c-contact-hero').addClass('c-contact-hero__'+dayOrNight + '-' + randomNumber);

    }
  }
};

/*
**  Menu Classes
*/
boris.showMenu = {
  init: function(element) {
    $('html, body').animate({scrollTop: '0px'}, 0);
    $(element).toggleClass('is-active');
    $('body').toggleClass('mobile-menu-open');

  }
};

boris.hideMenu = {
  init: function() {
    if( $('.c-nav__hamburger').hasClass('is-active') ) {
      $('body').removeClass('mobile-menu-open');
      $('.c-nav__hamburger').removeClass('is-active');
    }
  }
};


/*
**  Nav menu hovers
*/

boris.menuHover = {
  enter: function(item) {
    var navLinkText = $(item).text().toLowerCase();

    // Wait .4 s just for a transition to take effect when switching between
    // if($('.c-nav-primary').hasClass('background-transition') ) {
    //   $('.c-nav-primary').removeClass('background-transition');
    //   clearTimeout(animationTimeout);
    // }

  if($('.c-nav-primary__hover-active').length > 0 && !$('.c-nav-primary').hasClass('background-transition') ) {
      $('.c-nav-primary').addClass('background-transition');
      var animationTimeout = setTimeout(function(){
        $('.c-nav-primary').addClass('c-nav-primary--'+navLinkText);
        $('.c-nav-primary').removeClass('background-transition');
      }, 400);
    }else {
        $('.c-nav-primary').addClass('c-nav-primary--'+navLinkText + ' c-nav-primary__hover-active');
    }
  },
  leave: function(item) {
    var navLinkText = $(item).text().toLowerCase();

    // If menu active then switching between, we need to prevent the flash of
    // the actual page when transitioning
    if($('.c-nav-primary__hover-active').length > 0 && !$('.c-nav-primary').hasClass('background-transition') ) {
        setTimeout(function(){
          $('.c-nav-primary').removeClass('c-nav-primary--'+navLinkText);
        }, 400);
      }else {
        $('.c-nav-primary').removeClass('c-nav-primary--'+navLinkText);
      }
  },
  menuLeave: function() {
      $('.c-nav-primary').removeClass('c-nav-primary__hover-active');
  }
};


/*
** Move the feature box slightly on scroll
*/

boris.featuesHover = {
  lastscroll : 0,
  divPosition: 0,
  divHeight : 0,
  windowHeight: 0,

  init: function() {
    this.divPosition = $('.c-article__feature').offset().top;
    this.divHeight = $('.c-article__feature').height();
    this.windowHeight = $(window).height();
    // console.log('position',this.divPosition);
    this.getScroll();
  },

  getScroll : function() {
    var scrolled = $(document).scrollTop();
    if(scrolled > this.lastscroll){
      this.triggerMove(scrolled, "down");
    }else {
      this.triggerMove(scrolled, "up");
    }
    this.lastscroll = scrolled;
    var movement = scrolled / 10;
    // console.log(movement);
  },

  triggerMove : function(scrolled, direction) {
    // 0 is when the div is in the center of the screen
    var mover = (this.windowHeight / 2 - (this.divPosition - scrolled + (this.divHeight / 2)) ) / 10 ;
    this.animateDiv(mover);
  },

  animateDiv : function(mover) {
    console.log(mover);
    $('.c-article__feature').css('transform', 'translate3d(0px,'+ mover + 'px, 0px)');
    console.log('transform', 'translate3d(0,'+ mover + 'px, 0 )');
  }
};

/*
** Various triggers
*/

$(document).ready(function(){
  boris.weather.init();
});

resizeBackground();
var window_width = $(window).width();
$('.o-site-container').on('click',function(){
  console.log($('.o-hero-fullscreen').height());
  console.log("boris");
});
$('.o-hamburger').on('click', function() {
  boris.showMenu.init(this);
});

$(window).resize(function(){
  if( $(window).width() !== window_width ) {
    resizeBackground();
    console.log("boris");
  }

  window_width = $(window).width();

  boris.hideMenu.init();
  // resizeBackground();
});

$(".c-nav-primary__link").on("mouseenter", function () {
  if ($(window).width() > 540) {
    boris.menuHover.enter($(this));
  }
});

$(".c-nav-primary__link").on("mouseleave", function () {
  if ($(window).width() > 540) {
    boris.menuHover.leave($(this));
  }
});

$(".c-nav-primary__menu").on("mouseleave", function () {
  if ($(window).width() > 540) {
    boris.menuHover.menuLeave();
  }
});

function resizeBackground() {
  var windowHeight = $(window).height();
  console.log(windowHeight);
  $('.o-hero-fullscreen').height(windowHeight - 75);
  $('.js-hero').height(windowHeight * .9 - 75);
}

if($('body').hasClass('single-work')) {
  $(window).scroll(function(){
    boris.featuesHover.init();
  });
}
