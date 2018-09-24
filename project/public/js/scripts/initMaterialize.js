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
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 40);
/******/ })
/************************************************************************/
/******/ ({

/***/ 40:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(41);


/***/ }),

/***/ 41:
/***/ (function(module, exports) {

eval("var listenAndScroll = function listenAndScroll() {\n\t$('html, body').animate({\n\t\tscrollTop: $('#pin').offset().top\n\t}, 800, 'swing');\n\twindow.removeEventListener('scroll', listenAndScroll);\n\treturn 0;\n};\nvar checkScreenAndLoadBackground = function checkScreenAndLoadBackground() {\n\tvar hw = 'w=' + $(window).width() + '&h=' + $(window).height() + '&';\n\treturn 0;\n};\n\n// let size = 'h=1000&';\n// // if ($(window).width() < 1000)\n// // \tsize = `h=${$(window).width()}&w=${$(window).height()}&`;\n\n// $('#header').css(\n// \t'background-image',\n// \t`url('https://images.unsplash.com/photo-1503264116251-35a269479413?h=1000&crop=bottom&q=100&fm=jpg')`\n// );\n// Materialize components initialization\n$('#sidenav li, #nav-mobile li').each(function () {\n\tif ($(this).find('a').attr('href') === location.pathname) {\n\t\t$(this).addClass('active');\n\t}\n});\n$('.sidenav').sidenav();\n$('#pin').pushpin({ top: $('#pin').offset().top });\n$('.tabs').tabs();\n$('.tooltipped').tooltip();\n// Listen to click and scroll, has the callback say...\n$('#scroll-down').click(listenAndScroll);\nif (!new URLSearchParams(window.location.search).has('page') && $('body').scrollTop() === 0) window.addEventListener('scroll', listenAndScroll);//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvYXNzZXRzL2pzL3NjcmlwdHMvaW5pdE1hdGVyaWFsaXplLmpzP2M5ZjMiXSwibmFtZXMiOlsibGlzdGVuQW5kU2Nyb2xsIiwiJCIsImFuaW1hdGUiLCJzY3JvbGxUb3AiLCJvZmZzZXQiLCJ0b3AiLCJ3aW5kb3ciLCJyZW1vdmVFdmVudExpc3RlbmVyIiwiY2hlY2tTY3JlZW5BbmRMb2FkQmFja2dyb3VuZCIsImh3Iiwid2lkdGgiLCJoZWlnaHQiLCJlYWNoIiwiZmluZCIsImF0dHIiLCJsb2NhdGlvbiIsInBhdGhuYW1lIiwiYWRkQ2xhc3MiLCJzaWRlbmF2IiwicHVzaHBpbiIsInRhYnMiLCJ0b29sdGlwIiwiY2xpY2siLCJVUkxTZWFyY2hQYXJhbXMiLCJzZWFyY2giLCJoYXMiLCJhZGRFdmVudExpc3RlbmVyIl0sIm1hcHBpbmdzIjoiQUFBQSxJQUFNQSxrQkFBa0IsU0FBbEJBLGVBQWtCLEdBQU07QUFDN0JDLEdBQUUsWUFBRixFQUFnQkMsT0FBaEIsQ0FBd0I7QUFDdkJDLGFBQVdGLEVBQUUsTUFBRixFQUFVRyxNQUFWLEdBQW1CQztBQURQLEVBQXhCLEVBRUcsR0FGSCxFQUVRLE9BRlI7QUFHQUMsUUFBT0MsbUJBQVAsQ0FBMkIsUUFBM0IsRUFBcUNQLGVBQXJDO0FBQ0EsUUFBTyxDQUFQO0FBQ0EsQ0FORDtBQU9BLElBQU1RLCtCQUErQixTQUEvQkEsNEJBQStCLEdBQU07QUFDMUMsS0FBTUMsWUFBVVIsRUFBRUssTUFBRixFQUFVSSxLQUFWLEVBQVYsV0FBaUNULEVBQUVLLE1BQUYsRUFBVUssTUFBVixFQUFqQyxNQUFOO0FBQ0EsUUFBTyxDQUFQO0FBQ0EsQ0FIRDs7QUFLQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBVixFQUFFLDZCQUFGLEVBQWlDVyxJQUFqQyxDQUFzQyxZQUFXO0FBQ2hELEtBQUlYLEVBQUUsSUFBRixFQUFRWSxJQUFSLENBQWEsR0FBYixFQUFrQkMsSUFBbEIsQ0FBdUIsTUFBdkIsTUFBbUNDLFNBQVNDLFFBQWhELEVBQTBEO0FBQ3pEZixJQUFFLElBQUYsRUFBUWdCLFFBQVIsQ0FBaUIsUUFBakI7QUFDQTtBQUNELENBSkQ7QUFLQWhCLEVBQUUsVUFBRixFQUFjaUIsT0FBZDtBQUNBakIsRUFBRSxNQUFGLEVBQVVrQixPQUFWLENBQWtCLEVBQUVkLEtBQUtKLEVBQUUsTUFBRixFQUFVRyxNQUFWLEdBQW1CQyxHQUExQixFQUFsQjtBQUNBSixFQUFFLE9BQUYsRUFBV21CLElBQVg7QUFDQW5CLEVBQUUsYUFBRixFQUFpQm9CLE9BQWpCO0FBQ0E7QUFDQXBCLEVBQUUsY0FBRixFQUFrQnFCLEtBQWxCLENBQXdCdEIsZUFBeEI7QUFDQSxJQUNFLENBQUUsSUFBSXVCLGVBQUosQ0FBb0JqQixPQUFPUyxRQUFQLENBQWdCUyxNQUFwQyxDQUFELENBQThDQyxHQUE5QyxDQUFrRCxNQUFsRCxDQUFELElBRUF4QixFQUFFLE1BQUYsRUFBVUUsU0FBVixPQUEwQixDQUg1QixFQUtDRyxPQUFPb0IsZ0JBQVAsQ0FBd0IsUUFBeEIsRUFBa0MxQixlQUFsQyIsImZpbGUiOiI0MS5qcyIsInNvdXJjZXNDb250ZW50IjpbImNvbnN0IGxpc3RlbkFuZFNjcm9sbCA9ICgpID0+IHtcblx0JCgnaHRtbCwgYm9keScpLmFuaW1hdGUoe1xuXHRcdHNjcm9sbFRvcDogJCgnI3BpbicpLm9mZnNldCgpLnRvcFxuXHR9LCA4MDAsICdzd2luZycpO1xuXHR3aW5kb3cucmVtb3ZlRXZlbnRMaXN0ZW5lcignc2Nyb2xsJywgbGlzdGVuQW5kU2Nyb2xsKTtcblx0cmV0dXJuIDA7XG59O1xuY29uc3QgY2hlY2tTY3JlZW5BbmRMb2FkQmFja2dyb3VuZCA9ICgpID0+IHtcblx0Y29uc3QgaHcgPSBgdz0keyQod2luZG93KS53aWR0aCgpfSZoPSR7JCh3aW5kb3cpLmhlaWdodCgpfSZgO1xuXHRyZXR1cm4gMDtcbn1cblxuLy8gbGV0IHNpemUgPSAnaD0xMDAwJic7XG4vLyAvLyBpZiAoJCh3aW5kb3cpLndpZHRoKCkgPCAxMDAwKVxuLy8gLy8gXHRzaXplID0gYGg9JHskKHdpbmRvdykud2lkdGgoKX0mdz0keyQod2luZG93KS5oZWlnaHQoKX0mYDtcblxuLy8gJCgnI2hlYWRlcicpLmNzcyhcbi8vIFx0J2JhY2tncm91bmQtaW1hZ2UnLFxuLy8gXHRgdXJsKCdodHRwczovL2ltYWdlcy51bnNwbGFzaC5jb20vcGhvdG8tMTUwMzI2NDExNjI1MS0zNWEyNjk0Nzk0MTM/aD0xMDAwJmNyb3A9Ym90dG9tJnE9MTAwJmZtPWpwZycpYFxuLy8gKTtcbi8vIE1hdGVyaWFsaXplIGNvbXBvbmVudHMgaW5pdGlhbGl6YXRpb25cbiQoJyNzaWRlbmF2IGxpLCAjbmF2LW1vYmlsZSBsaScpLmVhY2goZnVuY3Rpb24oKSB7XG5cdGlmICgkKHRoaXMpLmZpbmQoJ2EnKS5hdHRyKCdocmVmJykgPT09IGxvY2F0aW9uLnBhdGhuYW1lKSB7XG5cdFx0JCh0aGlzKS5hZGRDbGFzcygnYWN0aXZlJyk7XG5cdH1cbn0pO1xuJCgnLnNpZGVuYXYnKS5zaWRlbmF2KCk7XG4kKCcjcGluJykucHVzaHBpbih7IHRvcDogJCgnI3BpbicpLm9mZnNldCgpLnRvcCB9KTtcbiQoJy50YWJzJykudGFicygpO1xuJCgnLnRvb2x0aXBwZWQnKS50b29sdGlwKCk7XG4vLyBMaXN0ZW4gdG8gY2xpY2sgYW5kIHNjcm9sbCwgaGFzIHRoZSBjYWxsYmFjayBzYXkuLi5cbiQoJyNzY3JvbGwtZG93bicpLmNsaWNrKGxpc3RlbkFuZFNjcm9sbCk7XG5pZiBcdChcblx0XHQhKG5ldyBVUkxTZWFyY2hQYXJhbXMod2luZG93LmxvY2F0aW9uLnNlYXJjaCkpLmhhcygncGFnZScpXG5cdCYmXG5cdFx0JCgnYm9keScpLnNjcm9sbFRvcCgpID09PSAwXG5cdClcblx0d2luZG93LmFkZEV2ZW50TGlzdGVuZXIoJ3Njcm9sbCcsIGxpc3RlbkFuZFNjcm9sbCk7XG5cblxuLy8gV0VCUEFDSyBGT09URVIgLy9cbi8vIC4vcmVzb3VyY2VzL2Fzc2V0cy9qcy9zY3JpcHRzL2luaXRNYXRlcmlhbGl6ZS5qcyJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///41\n");

/***/ })

/******/ });