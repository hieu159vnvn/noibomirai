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
/******/ 	return __webpack_require__(__webpack_require__.s = 5);
/******/ })
/************************************************************************/
/******/ ({

/***/ 5:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(6);


/***/ }),

/***/ 6:
/***/ (function(module, exports) {

$(document).on('keyup', '#password, #repassword', function (event) {
	event.preventDefault();

	if ($('#password').val() !== $('#repassword').val()) {
		$('#error-password').css('display', 'block');
	} else {
		$('#error-password').css('display', 'none');
	}
});

$('#username').blur(function (event) {
	var _token = $('meta[name="csrf-token"]').attr('content');
	$.ajax({
		url: '/admin-dashboard/users/checkuniqueusername',
		type: 'POST',
		data: { _token: _token, username: $('#username').val(), action: 'add', oldValue: "" },
		success: function success(data) {
			if (data == true) $('#error-username').css('display', 'block');else $('#error-username').css('display', 'none');
		}
	});
});

$('#email').blur(function (event) {
	var _token = $('meta[name="csrf-token"]').attr('content');
	$.ajax({
		url: '/admin-dashboard/users/checkuniqueemail',
		type: 'POST',
		data: { _token: _token, email: $('#email').val(), action: 'add', oldValue: "" },
		success: function success(data) {
			if (data == true) $('#error-email').css('display', 'block');else $('#error-email').css('display', 'none');
		}
	});
});

/***/ })

/******/ });