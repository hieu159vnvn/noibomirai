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
/******/ 	return __webpack_require__(__webpack_require__.s = 25);
/******/ })
/************************************************************************/
/******/ ({

/***/ 25:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(26);


/***/ }),

/***/ 26:
/***/ (function(module, exports) {

//$(document).ready(function() {
$('#data-table').DataTable({
	"scrollY": $(window).height() - 170,
	"order": [],
	"fixedColumns": true,
	"paging": false,
	"language": datatable_language
});

var html = '<a href="/admin-dashboard/products/add"><button id="addtag" style="margin: -8px 0 0 20px" class="ui labeled icon button green"><i class="plus circle icon"></i>Thêm Sản Phẩm</button></a>';
$('#data-table_filter').after(html);

$('.btn-delete').click(function (event) {
	$(".del-modal").modal('show');
	var header = '<p>Có phải bạn có muốn xóa sản phẩm: ' + $(this).attr('data-post-title') + '?</p>';
	$(".del-modal .content").html(header);
	$(".del-modal .positive").attr('data-post-id', $(this).attr('data-post-id'));
});
$('.positive').click(function (event) {
	window.location.href = 'products/' + $(this).attr('data-post-id') + '/delete';
});

$('.product-status').click(function (event) {
	var _token = $('meta[name="csrf-token"]').attr('content');
	$.ajax({
		url: '/admin-dashboard/products/changestatus',
		type: 'POST',
		data: { _token: _token, id: $(this).attr('data-id'), status: $(this).prop('checked') },
		success: function success(data) {
			if (data == 'OK') {
				$('.ajax-messenger').html('Cập nhật hiển thị thành công!');
				$('.ajax-messenger').addClass('alert-success').css('display', 'block').delay(3000).slideUp();
			}
		}
	});
});

$('.product-noibat').click(function (event) {
	var _token = $('meta[name="csrf-token"]').attr('content');
	$.ajax({
		url: '/admin-dashboard/products/changenoibat',
		type: 'POST',
		data: { _token: _token, id: $(this).attr('data-id'), noibat: $(this).prop('checked') },
		success: function success(data) {
			if (data == 'OK') {
				$('.ajax-messenger').html('Cập nhật thành công!');
				$('.ajax-messenger').addClass('alert-success').css('display', 'block').delay(3000).slideUp();
			}
		}
	});
});

$('.product-banchay').click(function (event) {
	var _token = $('meta[name="csrf-token"]').attr('content');
	$.ajax({
		url: '/admin-dashboard/products/changebanchay',
		type: 'POST',
		data: { _token: _token, id: $(this).attr('data-id'), banchay: $(this).prop('checked') },
		success: function success(data) {
			if (data == 'OK') {
				$('.ajax-messenger').html('Cập nhật thành công!');
				$('.ajax-messenger').addClass('alert-success').css('display', 'block').delay(3000).slideUp();
			}
		}
	});
});

$('.product-stt').change(function (event) {
	var _token = $('meta[name="csrf-token"]').attr('content');
	$.ajax({
		url: '/admin-dashboard/products/changestt',
		type: 'POST',
		data: { _token: _token, id: $(this).attr('data-id'), stt: $(this).val() },
		success: function success(data) {
			if (data == 'OK') {
				$('.ajax-messenger').html('Cập nhật số thứ tự thành công!');
				$('.ajax-messenger').addClass('alert-success').css('display', 'block').delay(3000).slideUp();
			}
		}
	});
});
//});

/***/ })

/******/ });