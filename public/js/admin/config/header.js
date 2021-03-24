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
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
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
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 43);
/******/ })
/************************************************************************/
/******/ ({

/***/ 43:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(44);


/***/ }),

/***/ 44:
/***/ (function(module, exports) {


$('.btn-feature-image').click(function (event) {
	$(".image-modal").modal('show');
});
$('.remove-feature-image').click(function (event) {
	$('#feature-image').val('');
	$('#show-feature-image').attr('src', '');
	$('.remove-feature-image').css('display', 'none');
});

$('.btn-favicon-image').click(function (event) {
	$(".favicon-modal").modal('show');
});
$('.remove-favicon-image').click(function (event) {
	$('#favicon-image').val('');
	$('#show-favicon-image').attr('src', '');
	$('.remove-favicon-image').css('display', 'none');
});

$('.btn-quangcao-image').click(function (event) {
	$(".quangcao-modal").modal('show');
});
$('.remove-quangcao-image').click(function (event) {
	$('#quangcao-image').val('');
	$('#show-quangcao-image').attr('src', '');
	$('.remove-quangcao-image').css('display', 'none');
});

$('.btn-pic1-image').click(function (event) {
	$(".pic1-modal").modal('show');
});
$('.remove-pic1-image').click(function (event) {
	$('#pic1-image').val('');
	$('#show-pic1-image').attr('src', '');
	$('.remove-pic1-image').css('display', 'none');
});

$('.btn-pic2-image').click(function (event) {
	$(".pic2-modal").modal('show');
});
$('.remove-pic2-image').click(function (event) {
	$('#pic2-image').val('');
	$('#show-pic2-image').attr('src', '');
	$('.remove-pic2-image').css('display', 'none');
});

$('.btn-pic3-image').click(function (event) {
	$(".pic3-modal").modal('show');
});
$('.remove-pic3-image').click(function (event) {
	$('#pic3-image').val('');
	$('#show-pic3-image').attr('src', '');
	$('.remove-pic3-image').css('display', 'none');
});
$('.btn-pic4-image').click(function (event) {
	$(".pic4-modal").modal('show');
});
$('.remove-pic4-image').click(function (event) {
	$('#pic4-image').val('');
	$('#show-pic4-image').attr('src', '');
	$('.remove-pic4-image').css('display', 'none');
});

$('.btn-pic5-image').click(function (event) {
	$(".pic5-modal").modal('show');
});
$('.remove-pic5-image').click(function (event) {
	$('#pic5-image').val('');
	$('#show-pic5-image').attr('src', '');
	$('.remove-pic5-image').css('display', 'none');
});
$('.btn-pic6-image').click(function (event) {
	$(".pic6-modal").modal('show');
});
$('.remove-pic6-image').click(function (event) {
	$('#pic6-image').val('');
	$('#show-pic6-image').attr('src', '');
	$('.remove-pic6-image').css('display', 'none');
});
$('.btn-pic7-image').click(function (event) {
	$(".pic7-modal").modal('show');
});
$('.remove-pic7-image').click(function (event) {
	$('#pic7-image').val('');
	$('#show-pic7-image').attr('src', '');
	$('.remove-pic7-image').css('display', 'none');
});
$('.btn-pic8-image').click(function (event) {
	$(".pic8-modal").modal('show');
});
$('.remove-pic8-image').click(function (event) {
	$('#pic8-image').val('');
	$('#show-pic8-image').attr('src', '');
	$('.remove-pic8-image').css('display', 'none');
});

/***/ })

/******/ });