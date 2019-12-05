/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./js/vaibekum.js":
/*!************************!*\
  !*** ./js/vaibekum.js ***!
  \************************/
/*! no static exports found */
/***/ (function(module, exports) {

/* HỖ TRỢ ONLINE */
jQuery(document).ready(function ($) {
  var hover = true;
  $(".vbk-support").hover(function () {
    if (hover === true) {
      $('.contact-show-info').addClass('open-show-support-online');
      hover = false;
    } else {
      $('.contact-show-info').removeClass('open-show-support-online');
      hover = true;
    }
  });
  $(".owl-carousel").owlCarousel({
    loop: true,
    responsiveClass: true,
    margin: 0,
    dots: false,
    nav: true,
    navText: ['<svg class="flickity-button-icon" viewBox="0 0 100 100"><path d="M 10,50 L 60,100 L 70,90 L 30,50  L 70,10 L 60,0 Z" class="arrow"></path></svg>', '<svg class="flickity-button-icon" viewBox="0 0 100 100"><path d="M 10,50 L 60,100 L 70,90 L 30,50  L 70,10 L 60,0 Z" class="arrow" transform="translate(100, 100) rotate(180) "></path></svg>'],
    responsive: {
      0: {
        items: 2
      },
      550: {
        items: 3
      },
      850: {
        items: 5
      }
    }
  });
  $('button.owl-prev').addClass('flickity-button flickity-prev-next-button previous');
  $('button.owl-next').addClass('flickity-button flickity-prev-next-button next');
  $('.menu li.menu-item-has-children>a').append('<i class="fas fa-angle-right"></i>');

  if ($(window).width() <= 992) {
    $('.menu li').click(function (e) {
      if ($(this).hasClass('has-child')) {
        e.preventDefault();
        $(this).find('ul').toggle();
        return false;
      }
    });
  }

  $('.wrap_add_cart a.ajax_add_to_cart').click(function () {
    $(document.body).on('added_to_cart', function () {
      $('.wrap_add_cart>a.added_to_cart').html('<i class="far fa-eye"></i>');
    });
  });
});
/* MOBILE */

$(document).ready(function () {
  if ($(window).width() < 768) {
    var showMobile = true;
    $('#mega_menu li > .toggle').on('click', function (e) {
      if (showMobile == true) {
        $('.sub-menu').addClass('show-mobile');
        showMobile = false;
      } else {
        $('.sub-menu').removeClass('show-mobile');
        showMobile = true;
      }
    });
  }
});
$(document).ready(function () {
  if ($(window).width() < 320) {
    var showMobile = true;
    $('#mega_menu li > .toggle').on('click', function (e) {
      if (showMobile == true) {
        $('.sub-menu').addClass('show-mobile');
        showMobile = false;
      } else {
        $('.sub-menu').removeClass('show-mobile');
        showMobile = true;
      }
    });
  }
});
$(document).ready(function () {
  if ($(window).width() < 1024) {
    var showMobile = true;
    $('#mega_menu li > .toggle').on('click', function (e) {
      if (showMobile == true) {
        $('.sub-menu').addClass('show-mobile');
        showMobile = false;
      } else {
        $('.sub-menu').removeClass('show-mobile');
        showMobile = true;
      }
    });
  }
});
var hover = true;
$(".vbk-support").hover(function () {
  if (hover === true) {
    $('.contact-show-info').addClass('open-show-support-online');
    hover = false;
  } else {
    $('.contact-show-info').removeClass('open-show-support-online');
    hover = true;
  }
});

/***/ }),

/***/ "./source/app.scss":
/*!*************************!*\
  !*** ./source/app.scss ***!
  \*************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!************************************************!*\
  !*** multi ./js/vaibekum.js ./source/app.scss ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! C:\xampp\htdocs\vaibekum\wp-content\themes\flatsome-child\js\vaibekum.js */"./js/vaibekum.js");
module.exports = __webpack_require__(/*! C:\xampp\htdocs\vaibekum\wp-content\themes\flatsome-child\source\app.scss */"./source/app.scss");


/***/ })

/******/ });
//# sourceMappingURL=main.js.map