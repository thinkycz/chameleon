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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports) {

/* globals __VUE_SSR_CONTEXT__ */

// IMPORTANT: Do NOT use ES2015 features in this file.
// This module is a runtime utility for cleaner component module output and will
// be included in the final webpack user bundle.

module.exports = function normalizeComponent (
  rawScriptExports,
  compiledTemplate,
  functionalTemplate,
  injectStyles,
  scopeId,
  moduleIdentifier /* server only */
) {
  var esModule
  var scriptExports = rawScriptExports = rawScriptExports || {}

  // ES6 modules interop
  var type = typeof rawScriptExports.default
  if (type === 'object' || type === 'function') {
    esModule = rawScriptExports
    scriptExports = rawScriptExports.default
  }

  // Vue.extend constructor export interop
  var options = typeof scriptExports === 'function'
    ? scriptExports.options
    : scriptExports

  // render functions
  if (compiledTemplate) {
    options.render = compiledTemplate.render
    options.staticRenderFns = compiledTemplate.staticRenderFns
    options._compiled = true
  }

  // functional template
  if (functionalTemplate) {
    options.functional = true
  }

  // scopedId
  if (scopeId) {
    options._scopeId = scopeId
  }

  var hook
  if (moduleIdentifier) { // server build
    hook = function (context) {
      // 2.3 injection
      context =
        context || // cached call
        (this.$vnode && this.$vnode.ssrContext) || // stateful
        (this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext) // functional
      // 2.2 with runInNewContext: true
      if (!context && typeof __VUE_SSR_CONTEXT__ !== 'undefined') {
        context = __VUE_SSR_CONTEXT__
      }
      // inject component styles
      if (injectStyles) {
        injectStyles.call(this, context)
      }
      // register component module identifier for async chunk inferrence
      if (context && context._registeredComponents) {
        context._registeredComponents.add(moduleIdentifier)
      }
    }
    // used by ssr in case component is cached and beforeCreate
    // never gets called
    options._ssrRegister = hook
  } else if (injectStyles) {
    hook = injectStyles
  }

  if (hook) {
    var functional = options.functional
    var existing = functional
      ? options.render
      : options.beforeCreate

    if (!functional) {
      // inject component registration as beforeCreate hook
      options.beforeCreate = existing
        ? [].concat(existing, hook)
        : [hook]
    } else {
      // for template-only hot-reload because in that case the render fn doesn't
      // go through the normalizer
      options._injectStyles = hook
      // register for functioal component in vue file
      options.render = function renderWithStyleInjection (h, context) {
        hook.call(context)
        return existing(h, context)
      }
    }
  }

  return {
    esModule: esModule,
    exports: scriptExports,
    options: options
  }
}


/***/ }),
/* 1 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(2);
module.exports = __webpack_require__(20);


/***/ }),
/* 2 */
/***/ (function(module, exports, __webpack_require__) {

Nova.booting(function (Vue, router) {
    router.addRoutes([{
        name: 'xml-importer',
        path: '/xml-importer',
        component: __webpack_require__(3)
    }, {
        name: 'xml-importer-configure',
        path: '/xml-importer/configure',
        component: __webpack_require__(14)
    }]);
});

/***/ }),
/* 3 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(4)
/* template */
var __vue_template__ = __webpack_require__(13)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/Tool.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-68ff5483", Component.options)
  } else {
    hotAPI.reload("data-v-68ff5483", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 4 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__ManualUpload__ = __webpack_require__(5);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__ManualUpload___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__ManualUpload__);
//
//
//
//



/* harmony default export */ __webpack_exports__["default"] = ({
    components: {
        ManualUpload: __WEBPACK_IMPORTED_MODULE_0__ManualUpload___default.a
    }
});

/***/ }),
/* 5 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(6)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(11)
/* template */
var __vue_template__ = __webpack_require__(12)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/ManualUpload.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-974e445c", Component.options)
  } else {
    hotAPI.reload("data-v-974e445c", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 6 */
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(7);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(9)("122e1bf9", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../node_modules/css-loader/index.js!../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-974e445c\",\"scoped\":false,\"hasInlineConfig\":true}!../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./ManualUpload.vue", function() {
     var newContent = require("!!../../../node_modules/css-loader/index.js!../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-974e445c\",\"scoped\":false,\"hasInlineConfig\":true}!../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./ManualUpload.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),
/* 7 */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(8)(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n/* Scoped Styles */\n", ""]);

// exports


/***/ }),
/* 8 */
/***/ (function(module, exports) {

/*
	MIT License http://www.opensource.org/licenses/mit-license.php
	Author Tobias Koppers @sokra
*/
// css base code, injected by the css-loader
module.exports = function(useSourceMap) {
	var list = [];

	// return the list of modules as css string
	list.toString = function toString() {
		return this.map(function (item) {
			var content = cssWithMappingToString(item, useSourceMap);
			if(item[2]) {
				return "@media " + item[2] + "{" + content + "}";
			} else {
				return content;
			}
		}).join("");
	};

	// import a list of modules into the list
	list.i = function(modules, mediaQuery) {
		if(typeof modules === "string")
			modules = [[null, modules, ""]];
		var alreadyImportedModules = {};
		for(var i = 0; i < this.length; i++) {
			var id = this[i][0];
			if(typeof id === "number")
				alreadyImportedModules[id] = true;
		}
		for(i = 0; i < modules.length; i++) {
			var item = modules[i];
			// skip already imported module
			// this implementation is not 100% perfect for weird media query combinations
			//  when a module is imported multiple times with different media queries.
			//  I hope this will never occur (Hey this way we have smaller bundles)
			if(typeof item[0] !== "number" || !alreadyImportedModules[item[0]]) {
				if(mediaQuery && !item[2]) {
					item[2] = mediaQuery;
				} else if(mediaQuery) {
					item[2] = "(" + item[2] + ") and (" + mediaQuery + ")";
				}
				list.push(item);
			}
		}
	};
	return list;
};

function cssWithMappingToString(item, useSourceMap) {
	var content = item[1] || '';
	var cssMapping = item[3];
	if (!cssMapping) {
		return content;
	}

	if (useSourceMap && typeof btoa === 'function') {
		var sourceMapping = toComment(cssMapping);
		var sourceURLs = cssMapping.sources.map(function (source) {
			return '/*# sourceURL=' + cssMapping.sourceRoot + source + ' */'
		});

		return [content].concat(sourceURLs).concat([sourceMapping]).join('\n');
	}

	return [content].join('\n');
}

// Adapted from convert-source-map (MIT)
function toComment(sourceMap) {
	// eslint-disable-next-line no-undef
	var base64 = btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap))));
	var data = 'sourceMappingURL=data:application/json;charset=utf-8;base64,' + base64;

	return '/*# ' + data + ' */';
}


/***/ }),
/* 9 */
/***/ (function(module, exports, __webpack_require__) {

/*
  MIT License http://www.opensource.org/licenses/mit-license.php
  Author Tobias Koppers @sokra
  Modified by Evan You @yyx990803
*/

var hasDocument = typeof document !== 'undefined'

if (typeof DEBUG !== 'undefined' && DEBUG) {
  if (!hasDocument) {
    throw new Error(
    'vue-style-loader cannot be used in a non-browser environment. ' +
    "Use { target: 'node' } in your Webpack config to indicate a server-rendering environment."
  ) }
}

var listToStyles = __webpack_require__(10)

/*
type StyleObject = {
  id: number;
  parts: Array<StyleObjectPart>
}

type StyleObjectPart = {
  css: string;
  media: string;
  sourceMap: ?string
}
*/

var stylesInDom = {/*
  [id: number]: {
    id: number,
    refs: number,
    parts: Array<(obj?: StyleObjectPart) => void>
  }
*/}

var head = hasDocument && (document.head || document.getElementsByTagName('head')[0])
var singletonElement = null
var singletonCounter = 0
var isProduction = false
var noop = function () {}
var options = null
var ssrIdKey = 'data-vue-ssr-id'

// Force single-tag solution on IE6-9, which has a hard limit on the # of <style>
// tags it will allow on a page
var isOldIE = typeof navigator !== 'undefined' && /msie [6-9]\b/.test(navigator.userAgent.toLowerCase())

module.exports = function (parentId, list, _isProduction, _options) {
  isProduction = _isProduction

  options = _options || {}

  var styles = listToStyles(parentId, list)
  addStylesToDom(styles)

  return function update (newList) {
    var mayRemove = []
    for (var i = 0; i < styles.length; i++) {
      var item = styles[i]
      var domStyle = stylesInDom[item.id]
      domStyle.refs--
      mayRemove.push(domStyle)
    }
    if (newList) {
      styles = listToStyles(parentId, newList)
      addStylesToDom(styles)
    } else {
      styles = []
    }
    for (var i = 0; i < mayRemove.length; i++) {
      var domStyle = mayRemove[i]
      if (domStyle.refs === 0) {
        for (var j = 0; j < domStyle.parts.length; j++) {
          domStyle.parts[j]()
        }
        delete stylesInDom[domStyle.id]
      }
    }
  }
}

function addStylesToDom (styles /* Array<StyleObject> */) {
  for (var i = 0; i < styles.length; i++) {
    var item = styles[i]
    var domStyle = stylesInDom[item.id]
    if (domStyle) {
      domStyle.refs++
      for (var j = 0; j < domStyle.parts.length; j++) {
        domStyle.parts[j](item.parts[j])
      }
      for (; j < item.parts.length; j++) {
        domStyle.parts.push(addStyle(item.parts[j]))
      }
      if (domStyle.parts.length > item.parts.length) {
        domStyle.parts.length = item.parts.length
      }
    } else {
      var parts = []
      for (var j = 0; j < item.parts.length; j++) {
        parts.push(addStyle(item.parts[j]))
      }
      stylesInDom[item.id] = { id: item.id, refs: 1, parts: parts }
    }
  }
}

function createStyleElement () {
  var styleElement = document.createElement('style')
  styleElement.type = 'text/css'
  head.appendChild(styleElement)
  return styleElement
}

function addStyle (obj /* StyleObjectPart */) {
  var update, remove
  var styleElement = document.querySelector('style[' + ssrIdKey + '~="' + obj.id + '"]')

  if (styleElement) {
    if (isProduction) {
      // has SSR styles and in production mode.
      // simply do nothing.
      return noop
    } else {
      // has SSR styles but in dev mode.
      // for some reason Chrome can't handle source map in server-rendered
      // style tags - source maps in <style> only works if the style tag is
      // created and inserted dynamically. So we remove the server rendered
      // styles and inject new ones.
      styleElement.parentNode.removeChild(styleElement)
    }
  }

  if (isOldIE) {
    // use singleton mode for IE9.
    var styleIndex = singletonCounter++
    styleElement = singletonElement || (singletonElement = createStyleElement())
    update = applyToSingletonTag.bind(null, styleElement, styleIndex, false)
    remove = applyToSingletonTag.bind(null, styleElement, styleIndex, true)
  } else {
    // use multi-style-tag mode in all other cases
    styleElement = createStyleElement()
    update = applyToTag.bind(null, styleElement)
    remove = function () {
      styleElement.parentNode.removeChild(styleElement)
    }
  }

  update(obj)

  return function updateStyle (newObj /* StyleObjectPart */) {
    if (newObj) {
      if (newObj.css === obj.css &&
          newObj.media === obj.media &&
          newObj.sourceMap === obj.sourceMap) {
        return
      }
      update(obj = newObj)
    } else {
      remove()
    }
  }
}

var replaceText = (function () {
  var textStore = []

  return function (index, replacement) {
    textStore[index] = replacement
    return textStore.filter(Boolean).join('\n')
  }
})()

function applyToSingletonTag (styleElement, index, remove, obj) {
  var css = remove ? '' : obj.css

  if (styleElement.styleSheet) {
    styleElement.styleSheet.cssText = replaceText(index, css)
  } else {
    var cssNode = document.createTextNode(css)
    var childNodes = styleElement.childNodes
    if (childNodes[index]) styleElement.removeChild(childNodes[index])
    if (childNodes.length) {
      styleElement.insertBefore(cssNode, childNodes[index])
    } else {
      styleElement.appendChild(cssNode)
    }
  }
}

function applyToTag (styleElement, obj) {
  var css = obj.css
  var media = obj.media
  var sourceMap = obj.sourceMap

  if (media) {
    styleElement.setAttribute('media', media)
  }
  if (options.ssrId) {
    styleElement.setAttribute(ssrIdKey, obj.id)
  }

  if (sourceMap) {
    // https://developer.chrome.com/devtools/docs/javascript-debugging
    // this makes source maps inside style tags work properly in Chrome
    css += '\n/*# sourceURL=' + sourceMap.sources[0] + ' */'
    // http://stackoverflow.com/a/26603875
    css += '\n/*# sourceMappingURL=data:application/json;base64,' + btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap)))) + ' */'
  }

  if (styleElement.styleSheet) {
    styleElement.styleSheet.cssText = css
  } else {
    while (styleElement.firstChild) {
      styleElement.removeChild(styleElement.firstChild)
    }
    styleElement.appendChild(document.createTextNode(css))
  }
}


/***/ }),
/* 10 */
/***/ (function(module, exports) {

/**
 * Translates the list format produced by css-loader into something
 * easier to manipulate.
 */
module.exports = function listToStyles (parentId, list) {
  var styles = []
  var newStyles = {}
  for (var i = 0; i < list.length; i++) {
    var item = list[i]
    var id = item[0]
    var css = item[1]
    var media = item[2]
    var sourceMap = item[3]
    var part = {
      id: parentId + ':' + i,
      css: css,
      media: media,
      sourceMap: sourceMap
    }
    if (!newStyles[id]) {
      styles.push(newStyles[id] = { id: id, parts: [part] })
    } else {
      newStyles[id].parts.push(part)
    }
  }
  return styles
}


/***/ }),
/* 11 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
    data: function data() {
        return {
            lastUpdate: null,
            duration: null,
            status: null
        };
    },

    methods: {
        sync: function sync() {
            var _this = this;

            Nova.request().post('/nova-vendor/xml-importer/sync').then(function () {
                _this.$toasted.success(_this.__('syncing_in_progress'));
                setTimeout(_this.refresh, 1000);
            }).catch(function (err) {
                _this.$toasted.success(_this.__('please_check_config'));
            });
        },
        validate: function validate() {
            var formData = new FormData();
            formData.append('xmlfile', this.$refs.file.files[0]);

            Nova.request().post('/nova-vendor/xml-importer/validate-parser', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(function (response) {
                console.log(response);
            });
        },
        refresh: function refresh() {
            var _this2 = this;

            Nova.request().get('/nova-vendor/xml-importer/status').then(function (_ref) {
                var data = _ref.data;

                _this2.lastUpdate = data.payload.lastUpdate;
                _this2.duration = data.payload.duration;
                _this2.status = data.payload.status;
            });
        }
    },
    created: function created() {
        this.refresh();
    }
});

/***/ }),
/* 12 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _c(
        "div",
        { staticClass: "flex" },
        [
          _c("heading", { staticClass: "mb-6 flex-no-shrink" }, [
            _vm._v(_vm._s(_vm.__("xml_importer")))
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "w-full flex items-center mb-6" }, [
            _c("div", {
              staticClass: "flex w-full justify-end items-center mx-3"
            }),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "flex-no-shrink ml-auto" },
              [
                _c(
                  "router-link",
                  {
                    staticClass: "btn btn-default btn-primary",
                    attrs: { to: "/xml-importer/configure" }
                  },
                  [
                    _vm._v(
                      "\n                    " +
                        _vm._s(_vm.__("configuration")) +
                        "\n                "
                    )
                  ]
                )
              ],
              1
            )
          ])
        ],
        1
      ),
      _vm._v(" "),
      _c("card", { staticClass: "flex flex-col p-8" }, [
        _c("div", { staticClass: "flex my-4" }, [
          _c("div", { staticClass: "w-1/4 font-bold" }, [
            _vm._v(_vm._s(_vm.__("last_update")))
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "w-3/4" }, [_vm._v(_vm._s(_vm.lastUpdate))])
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "flex my-4" }, [
          _c("div", { staticClass: "w-1/4 font-bold" }, [
            _vm._v(_vm._s(_vm.__("duration")))
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "w-3/4" }, [_vm._v(_vm._s(_vm.duration))])
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "flex my-4" }, [
          _c("div", { staticClass: "w-1/4 font-bold" }, [
            _vm._v(_vm._s(_vm.__("status")))
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "w-3/4" }, [_vm._v(_vm._s(_vm.status))])
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "flex my-4" }, [
          _c("div", { staticClass: "w-1/4 font-bold" }, [
            _vm._v(_vm._s(_vm.__("manual_upload")))
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "w-3/4" }, [
            _c("input", {
              ref: "file",
              attrs: { type: "file", name: "file", accept: "text/xml" }
            })
          ])
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "flex my-4" }, [
          _c("div", { staticClass: "w-3/4 ml-auto" }, [
            _c(
              "button",
              {
                staticClass: "btn btn-default btn-primary",
                attrs: { type: "button" },
                on: { click: _vm.sync }
              },
              [_vm._v(_vm._s(_vm.__("sync_now")))]
            ),
            _vm._v(" "),
            _c(
              "button",
              {
                staticClass: "btn btn-default btn-primary",
                attrs: { type: "button" },
                on: { click: _vm.validate }
              },
              [_vm._v(_vm._s(_vm.__("validate_parser")))]
            ),
            _vm._v(" "),
            _c(
              "button",
              {
                staticClass: "btn btn-default btn-primary",
                attrs: { type: "button" },
                on: { click: _vm.refresh }
              },
              [_vm._v(_vm._s(_vm.__("refresh_status")))]
            )
          ])
        ])
      ])
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-974e445c", module.exports)
  }
}

/***/ }),
/* 13 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("manual-upload")
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-68ff5483", module.exports)
  }
}

/***/ }),
/* 14 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(15)
/* template */
var __vue_template__ = __webpack_require__(19)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/Configure.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-bdcfabea", Component.options)
  } else {
    hotAPI.reload("data-v-bdcfabea", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 15 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__StaticCheckbox__ = __webpack_require__(16);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__StaticCheckbox___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__StaticCheckbox__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//



/* harmony default export */ __webpack_exports__["default"] = ({
    data: function data() {
        return {
            tag_name: '',
            tag_depth: '',
            identifier: 'barcode',
            price_multiplier: '1',
            name: '',
            description: '',
            details: '',
            catalogue_number: '',
            barcode: '',
            quantity_in_stock: '',
            minimum_order_quantity: '',
            vatrate: '',
            price: '',
            category: '',
            unit: '',
            photo: '',
            name_static: true,
            description_static: true,
            details_static: true,
            catalogue_number_static: true,
            barcode_static: true,
            quantity_in_stock_static: true,
            minimum_order_quantity_static: true,
            vatrate_static: true,
            price_static: true,
            category_static: true,
            unit_static: true,
            photo_static: true
        };
    },


    methods: {
        saveConfiguration: function saveConfiguration() {
            var _this = this;

            Nova.request().post('/nova-vendor/xml-importer/save-configuration', this.$data).then(function () {
                _this.$toasted.success(_this.__('configuration_saved'));
                _this.$router.push('/xml-importer');
            });
        }
    },

    mounted: function mounted() {
        var _this2 = this;

        Nova.request().get('/nova-vendor/xml-importer/settings').then(function (_ref) {
            var data = _ref.data;

            var settings = data.payload.settings;

            _this2.tag_name = settings.tag_name ? settings.tag_name : null;
            _this2.tag_depth = settings.tag_depth ? settings.tag_depth : null;
            _this2.identifier = settings.identifier ? settings.identifier : null;
            _this2.price_multiplier = settings.price_multiplier ? settings.price_multiplier : null;

            var config = data.payload.config;

            _this2.name_static = !_.isObject(config.name);
            _this2.name = _this2.name_static ? config.name : config.name.uses;

            _this2.description_static = !_.isObject(config.description);
            _this2.description = _this2.description_static ? config.description : config.description.uses;

            _this2.details_static = !_.isObject(config.details);
            _this2.details = _this2.details_static ? config.details : config.details.uses;

            _this2.catalogue_number_static = !_.isObject(config.catalogue_number);
            _this2.catalogue_number = _this2.catalogue_number_static ? config.catalogue_number : config.catalogue_number.uses;

            _this2.barcode_static = !_.isObject(config.barcode);
            _this2.barcode = _this2.barcode_static ? config.barcode : config.barcode.uses;

            _this2.quantity_in_stock_static = !_.isObject(config.quantity_in_stock);
            _this2.quantity_in_stock = _this2.quantity_in_stock_static ? config.quantity_in_stock : config.quantity_in_stock.uses;

            _this2.minimum_order_quantity_static = !_.isObject(config.minimum_order_quantity);
            _this2.minimum_order_quantity = _this2.minimum_order_quantity_static ? config.minimum_order_quantity : config.minimum_order_quantity.uses;

            _this2.vatrate_static = !_.isObject(config.vatrate);
            _this2.vatrate = _this2.vatrate_static ? config.vatrate : config.vatrate.uses;

            _this2.price_static = !_.isObject(config.price);
            _this2.price = _this2.price_static ? config.price : config.price.uses;

            _this2.category_static = !_.isObject(config.category);
            _this2.category = _this2.category_static ? config.category : config.category.uses;

            _this2.unit_static = !_.isObject(config.unit);
            _this2.unit = _this2.unit_static ? config.unit : config.unit.uses;

            _this2.photo_static = !_.isObject(config.photo);
            _this2.photo = _this2.photo_static ? config.photo : config.photo.uses;
        });
    },


    components: {
        StaticCheckbox: __WEBPACK_IMPORTED_MODULE_0__StaticCheckbox___default.a
    }
});

/***/ }),
/* 16 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(17)
/* template */
var __vue_template__ = __webpack_require__(18)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/StaticCheckbox.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-8e8a4a08", Component.options)
  } else {
    hotAPI.reload("data-v-8e8a4a08", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 17 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
    props: ['value', 'name'],

    methods: {
        toggle: function toggle() {
            this.$emit('input', !this.value);
        }
    }
});

/***/ }),
/* 18 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "checkbox",
    {
      staticClass: "py-2",
      attrs: { checked: _vm.value, id: _vm.name, name: _vm.name },
      on: { input: _vm.toggle }
    },
    [
      _c(
        "label",
        { staticClass: "text-90 text-sm mx-2", attrs: { for: _vm.name } },
        [_vm._v("Static Text")]
      )
    ]
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-8e8a4a08", module.exports)
  }
}

/***/ }),
/* 19 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _c("heading", { staticClass: "mb-6" }, [
        _vm._v(_vm._s(_vm.__("xml_importer_config")))
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "card overflow-hidden" }, [
        _c("form", { attrs: { autocomplete: "off" } }, [
          _c("div", { staticClass: "flex border-b border-40" }, [
            _c("div", { staticClass: "w-1/5 py-6 px-8" }, [
              _c(
                "label",
                {
                  staticClass: "inline-block text-80 pt-2 leading-tight",
                  attrs: { for: "tag_name" }
                },
                [
                  _vm._v(
                    "\n                        " +
                      _vm._s(_vm.__("tag_name")) +
                      "\n                    "
                  )
                ]
              )
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "py-6 px-8 w-1/2" }, [
              _c("input", {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model",
                    value: _vm.tag_name,
                    expression: "tag_name"
                  }
                ],
                staticClass:
                  "w-full form-control form-input form-input-bordered",
                attrs: {
                  id: "tag_name",
                  type: "text",
                  placeholder: _vm.__("tag_name")
                },
                domProps: { value: _vm.tag_name },
                on: {
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.tag_name = $event.target.value
                  }
                }
              })
            ])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "flex border-b border-40" }, [
            _c("div", { staticClass: "w-1/5 py-6 px-8" }, [
              _c(
                "label",
                {
                  staticClass: "inline-block text-80 pt-2 leading-tight",
                  attrs: { for: "tag_depth" }
                },
                [
                  _vm._v(
                    "\n                        " +
                      _vm._s(_vm.__("tag_depth")) +
                      "\n                    "
                  )
                ]
              )
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "py-6 px-8 w-1/2" }, [
              _c("input", {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model",
                    value: _vm.tag_depth,
                    expression: "tag_depth"
                  }
                ],
                staticClass:
                  "w-full form-control form-input form-input-bordered",
                attrs: {
                  id: "tag_depth",
                  type: "text",
                  placeholder: _vm.__("tag_depth")
                },
                domProps: { value: _vm.tag_depth },
                on: {
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.tag_depth = $event.target.value
                  }
                }
              })
            ])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "flex border-b border-40" }, [
            _c("div", { staticClass: "w-1/5 py-6 px-8" }, [
              _c(
                "label",
                {
                  staticClass: "inline-block text-80 pt-2 leading-tight",
                  attrs: { for: "identifier" }
                },
                [
                  _vm._v(
                    "\n                        " +
                      _vm._s(_vm.__("identifier")) +
                      "\n                    "
                  )
                ]
              )
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "py-6 px-8 w-1/2" }, [
              _c(
                "select",
                {
                  directives: [
                    {
                      name: "model",
                      rawName: "v-model",
                      value: _vm.identifier,
                      expression: "identifier"
                    }
                  ],
                  staticClass: "w-full form-control form-select",
                  attrs: {
                    name: "identifier",
                    id: "identifier",
                    required: "required"
                  },
                  on: {
                    change: function($event) {
                      var $$selectedVal = Array.prototype.filter
                        .call($event.target.options, function(o) {
                          return o.selected
                        })
                        .map(function(o) {
                          var val = "_value" in o ? o._value : o.value
                          return val
                        })
                      _vm.identifier = $event.target.multiple
                        ? $$selectedVal
                        : $$selectedVal[0]
                    }
                  }
                },
                [
                  _c("option", { attrs: { value: "barcode", selected: "" } }, [
                    _vm._v(_vm._s(_vm.__("barcode")))
                  ]),
                  _vm._v(" "),
                  _c("option", { attrs: { value: "catalogueNumber" } }, [
                    _vm._v(_vm._s(_vm.__("catalogue_number")))
                  ])
                ]
              )
            ])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "flex border-b border-40" }, [
            _c("div", { staticClass: "w-1/5 py-6 px-8" }, [
              _c(
                "label",
                {
                  staticClass: "inline-block text-80 pt-2 leading-tight",
                  attrs: { for: "price_multiplier" }
                },
                [
                  _vm._v(
                    "\n                        " +
                      _vm._s(_vm.__("price_multiplier")) +
                      "\n                    "
                  )
                ]
              )
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "py-6 px-8 w-1/2" }, [
              _c("input", {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model",
                    value: _vm.price_multiplier,
                    expression: "price_multiplier"
                  }
                ],
                staticClass:
                  "w-full form-control form-input form-input-bordered",
                attrs: {
                  id: "price_multiplier",
                  type: "text",
                  placeholder: _vm.__("price_multiplier")
                },
                domProps: { value: _vm.price_multiplier },
                on: {
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.price_multiplier = $event.target.value
                  }
                }
              })
            ])
          ])
        ])
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "card overflow-hidden mt-6" }, [
        _c("form", { attrs: { autocomplete: "off" } }, [
          _c("div", { staticClass: "flex border-b border-40" }, [
            _c("div", { staticClass: "w-1/5 py-6 px-8" }, [
              _c(
                "label",
                {
                  staticClass: "inline-block text-80 pt-2 leading-tight",
                  attrs: { for: "name" }
                },
                [
                  _vm._v(
                    "\n                        " +
                      _vm._s(_vm.__("name")) +
                      "\n                    "
                  )
                ]
              )
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "py-6 px-8 w-1/2" }, [
              _c("input", {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model",
                    value: _vm.name,
                    expression: "name"
                  }
                ],
                staticClass:
                  "w-full form-control form-input form-input-bordered",
                attrs: {
                  id: "name",
                  type: "text",
                  placeholder: _vm.__("name")
                },
                domProps: { value: _vm.name },
                on: {
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.name = $event.target.value
                  }
                }
              })
            ]),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "w-1/5 py-6 px-8" },
              [
                _c("static-checkbox", {
                  attrs: { name: "name_static" },
                  model: {
                    value: _vm.name_static,
                    callback: function($$v) {
                      _vm.name_static = $$v
                    },
                    expression: "name_static"
                  }
                })
              ],
              1
            )
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "flex border-b border-40" }, [
            _c("div", { staticClass: "w-1/5 py-6 px-8" }, [
              _c(
                "label",
                {
                  staticClass: "inline-block text-80 pt-2 leading-tight",
                  attrs: { for: "description" }
                },
                [
                  _vm._v(
                    "\n                        " +
                      _vm._s(_vm.__("description")) +
                      "\n                    "
                  )
                ]
              )
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "py-6 px-8 w-1/2" }, [
              _c("input", {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model",
                    value: _vm.description,
                    expression: "description"
                  }
                ],
                staticClass:
                  "w-full form-control form-input form-input-bordered",
                attrs: {
                  id: "description",
                  type: "text",
                  placeholder: _vm.__("description")
                },
                domProps: { value: _vm.description },
                on: {
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.description = $event.target.value
                  }
                }
              })
            ]),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "w-1/5 py-6 px-8" },
              [
                _c("static-checkbox", {
                  attrs: { name: "description_static" },
                  model: {
                    value: _vm.description_static,
                    callback: function($$v) {
                      _vm.description_static = $$v
                    },
                    expression: "description_static"
                  }
                })
              ],
              1
            )
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "flex border-b border-40" }, [
            _c("div", { staticClass: "w-1/5 py-6 px-8" }, [
              _c(
                "label",
                {
                  staticClass: "inline-block text-80 pt-2 leading-tight",
                  attrs: { for: "details" }
                },
                [
                  _vm._v(
                    "\n                        " +
                      _vm._s(_vm.__("details")) +
                      "\n                    "
                  )
                ]
              )
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "py-6 px-8 w-1/2" }, [
              _c("input", {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model",
                    value: _vm.details,
                    expression: "details"
                  }
                ],
                staticClass:
                  "w-full form-control form-input form-input-bordered",
                attrs: {
                  id: "details",
                  type: "text",
                  placeholder: _vm.__("details")
                },
                domProps: { value: _vm.details },
                on: {
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.details = $event.target.value
                  }
                }
              })
            ]),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "w-1/5 py-6 px-8" },
              [
                _c("static-checkbox", {
                  attrs: { name: "details_static" },
                  model: {
                    value: _vm.details_static,
                    callback: function($$v) {
                      _vm.details_static = $$v
                    },
                    expression: "details_static"
                  }
                })
              ],
              1
            )
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "flex border-b border-40" }, [
            _c("div", { staticClass: "w-1/5 py-6 px-8" }, [
              _c(
                "label",
                {
                  staticClass: "inline-block text-80 pt-2 leading-tight",
                  attrs: { for: "catalogue_number" }
                },
                [
                  _vm._v(
                    "\n                        " +
                      _vm._s(_vm.__("catalogue_number")) +
                      "\n                    "
                  )
                ]
              )
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "py-6 px-8 w-1/2" }, [
              _c("input", {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model",
                    value: _vm.catalogue_number,
                    expression: "catalogue_number"
                  }
                ],
                staticClass:
                  "w-full form-control form-input form-input-bordered",
                attrs: {
                  id: "catalogue_number",
                  type: "text",
                  placeholder: _vm.__("catalogue_number")
                },
                domProps: { value: _vm.catalogue_number },
                on: {
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.catalogue_number = $event.target.value
                  }
                }
              })
            ]),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "w-1/5 py-6 px-8" },
              [
                _c("static-checkbox", {
                  attrs: { name: "catalogue_number_static" },
                  model: {
                    value: _vm.catalogue_number_static,
                    callback: function($$v) {
                      _vm.catalogue_number_static = $$v
                    },
                    expression: "catalogue_number_static"
                  }
                })
              ],
              1
            )
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "flex border-b border-40" }, [
            _c("div", { staticClass: "w-1/5 py-6 px-8" }, [
              _c(
                "label",
                {
                  staticClass: "inline-block text-80 pt-2 leading-tight",
                  attrs: { for: "barcode" }
                },
                [
                  _vm._v(
                    "\n                        " +
                      _vm._s(_vm.__("barcode")) +
                      "\n                    "
                  )
                ]
              )
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "py-6 px-8 w-1/2" }, [
              _c("input", {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model",
                    value: _vm.barcode,
                    expression: "barcode"
                  }
                ],
                staticClass:
                  "w-full form-control form-input form-input-bordered",
                attrs: {
                  id: "barcode",
                  type: "text",
                  placeholder: _vm.__("barcode")
                },
                domProps: { value: _vm.barcode },
                on: {
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.barcode = $event.target.value
                  }
                }
              })
            ]),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "w-1/5 py-6 px-8" },
              [
                _c("static-checkbox", {
                  attrs: { name: "barcode_static" },
                  model: {
                    value: _vm.barcode_static,
                    callback: function($$v) {
                      _vm.barcode_static = $$v
                    },
                    expression: "barcode_static"
                  }
                })
              ],
              1
            )
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "flex border-b border-40" }, [
            _c("div", { staticClass: "w-1/5 py-6 px-8" }, [
              _c(
                "label",
                {
                  staticClass: "inline-block text-80 pt-2 leading-tight",
                  attrs: { for: "quantity_in_stock" }
                },
                [
                  _vm._v(
                    "\n                        " +
                      _vm._s(_vm.__("quantity_in_stock")) +
                      "\n                    "
                  )
                ]
              )
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "py-6 px-8 w-1/2" }, [
              _c("input", {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model",
                    value: _vm.quantity_in_stock,
                    expression: "quantity_in_stock"
                  }
                ],
                staticClass:
                  "w-full form-control form-input form-input-bordered",
                attrs: {
                  id: "quantity_in_stock",
                  type: "text",
                  placeholder: _vm.__("quantity_in_stock")
                },
                domProps: { value: _vm.quantity_in_stock },
                on: {
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.quantity_in_stock = $event.target.value
                  }
                }
              })
            ]),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "w-1/5 py-6 px-8" },
              [
                _c("static-checkbox", {
                  attrs: { name: "quantity_in_stock_static" },
                  model: {
                    value: _vm.quantity_in_stock_static,
                    callback: function($$v) {
                      _vm.quantity_in_stock_static = $$v
                    },
                    expression: "quantity_in_stock_static"
                  }
                })
              ],
              1
            )
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "flex border-b border-40" }, [
            _c("div", { staticClass: "w-1/5 py-6 px-8" }, [
              _c(
                "label",
                {
                  staticClass: "inline-block text-80 pt-2 leading-tight",
                  attrs: { for: "minimum_order_quantity" }
                },
                [
                  _vm._v(
                    "\n                        " +
                      _vm._s(_vm.__("minimum_order_quantity")) +
                      "\n                    "
                  )
                ]
              )
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "py-6 px-8 w-1/2" }, [
              _c("input", {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model",
                    value: _vm.minimum_order_quantity,
                    expression: "minimum_order_quantity"
                  }
                ],
                staticClass:
                  "w-full form-control form-input form-input-bordered",
                attrs: {
                  id: "minimum_order_quantity",
                  type: "text",
                  placeholder: _vm.__("minimum_order_quantity")
                },
                domProps: { value: _vm.minimum_order_quantity },
                on: {
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.minimum_order_quantity = $event.target.value
                  }
                }
              })
            ]),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "w-1/5 py-6 px-8" },
              [
                _c("static-checkbox", {
                  attrs: { name: "minimum_order_quantity_static" },
                  model: {
                    value: _vm.minimum_order_quantity_static,
                    callback: function($$v) {
                      _vm.minimum_order_quantity_static = $$v
                    },
                    expression: "minimum_order_quantity_static"
                  }
                })
              ],
              1
            )
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "flex border-b border-40" }, [
            _c("div", { staticClass: "w-1/5 py-6 px-8" }, [
              _c(
                "label",
                {
                  staticClass: "inline-block text-80 pt-2 leading-tight",
                  attrs: { for: "vatrate" }
                },
                [
                  _vm._v(
                    "\n                        " +
                      _vm._s(_vm.__("vatrate")) +
                      "\n                    "
                  )
                ]
              )
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "py-6 px-8 w-1/2" }, [
              _c("input", {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model",
                    value: _vm.vatrate,
                    expression: "vatrate"
                  }
                ],
                staticClass:
                  "w-full form-control form-input form-input-bordered",
                attrs: {
                  id: "vatrate",
                  type: "text",
                  placeholder: _vm.__("vatrate")
                },
                domProps: { value: _vm.vatrate },
                on: {
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.vatrate = $event.target.value
                  }
                }
              })
            ]),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "w-1/5 py-6 px-8" },
              [
                _c("static-checkbox", {
                  attrs: { name: "vatrate_static" },
                  model: {
                    value: _vm.vatrate_static,
                    callback: function($$v) {
                      _vm.vatrate_static = $$v
                    },
                    expression: "vatrate_static"
                  }
                })
              ],
              1
            )
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "flex border-b border-40" }, [
            _c("div", { staticClass: "w-1/5 py-6 px-8" }, [
              _c(
                "label",
                {
                  staticClass: "inline-block text-80 pt-2 leading-tight",
                  attrs: { for: "price" }
                },
                [
                  _vm._v(
                    "\n                        " +
                      _vm._s(_vm.__("price")) +
                      "\n                    "
                  )
                ]
              )
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "py-6 px-8 w-1/2" }, [
              _c("input", {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model",
                    value: _vm.price,
                    expression: "price"
                  }
                ],
                staticClass:
                  "w-full form-control form-input form-input-bordered",
                attrs: {
                  id: "price",
                  type: "text",
                  placeholder: _vm.__("price")
                },
                domProps: { value: _vm.price },
                on: {
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.price = $event.target.value
                  }
                }
              })
            ]),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "w-1/5 py-6 px-8" },
              [
                _c("static-checkbox", {
                  attrs: { name: "price_static" },
                  model: {
                    value: _vm.price_static,
                    callback: function($$v) {
                      _vm.price_static = $$v
                    },
                    expression: "price_static"
                  }
                })
              ],
              1
            )
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "flex border-b border-40" }, [
            _c("div", { staticClass: "w-1/5 py-6 px-8" }, [
              _c(
                "label",
                {
                  staticClass: "inline-block text-80 pt-2 leading-tight",
                  attrs: { for: "category" }
                },
                [
                  _vm._v(
                    "\n                        " +
                      _vm._s(_vm.__("category")) +
                      "\n                    "
                  )
                ]
              )
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "py-6 px-8 w-1/2" }, [
              _c("input", {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model",
                    value: _vm.category,
                    expression: "category"
                  }
                ],
                staticClass:
                  "w-full form-control form-input form-input-bordered",
                attrs: {
                  id: "category",
                  type: "text",
                  placeholder: _vm.__("category")
                },
                domProps: { value: _vm.category },
                on: {
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.category = $event.target.value
                  }
                }
              })
            ]),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "w-1/5 py-6 px-8" },
              [
                _c("static-checkbox", {
                  attrs: { name: "category_static" },
                  model: {
                    value: _vm.category_static,
                    callback: function($$v) {
                      _vm.category_static = $$v
                    },
                    expression: "category_static"
                  }
                })
              ],
              1
            )
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "flex border-b border-40" }, [
            _c("div", { staticClass: "w-1/5 py-6 px-8" }, [
              _c(
                "label",
                {
                  staticClass: "inline-block text-80 pt-2 leading-tight",
                  attrs: { for: "unit" }
                },
                [
                  _vm._v(
                    "\n                        " +
                      _vm._s(_vm.__("unit")) +
                      "\n                    "
                  )
                ]
              )
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "py-6 px-8 w-1/2" }, [
              _c("input", {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model",
                    value: _vm.unit,
                    expression: "unit"
                  }
                ],
                staticClass:
                  "w-full form-control form-input form-input-bordered",
                attrs: {
                  id: "unit",
                  type: "text",
                  placeholder: _vm.__("unit")
                },
                domProps: { value: _vm.unit },
                on: {
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.unit = $event.target.value
                  }
                }
              })
            ]),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "w-1/5 py-6 px-8" },
              [
                _c("static-checkbox", {
                  attrs: { name: "unit_static" },
                  model: {
                    value: _vm.unit_static,
                    callback: function($$v) {
                      _vm.unit_static = $$v
                    },
                    expression: "unit_static"
                  }
                })
              ],
              1
            )
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "flex border-b border-40" }, [
            _c("div", { staticClass: "w-1/5 py-6 px-8" }, [
              _c(
                "label",
                {
                  staticClass: "inline-block text-80 pt-2 leading-tight",
                  attrs: { for: "photo" }
                },
                [
                  _vm._v(
                    "\n                        " +
                      _vm._s(_vm.__("photo")) +
                      "\n                    "
                  )
                ]
              )
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "py-6 px-8 w-1/2" }, [
              _c("input", {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model",
                    value: _vm.photo,
                    expression: "photo"
                  }
                ],
                staticClass:
                  "w-full form-control form-input form-input-bordered",
                attrs: {
                  id: "photo",
                  type: "text",
                  placeholder: _vm.__("photo")
                },
                domProps: { value: _vm.photo },
                on: {
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.photo = $event.target.value
                  }
                }
              })
            ]),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "w-1/5 py-6 px-8" },
              [
                _c("static-checkbox", {
                  attrs: { name: "photo_static" },
                  model: {
                    value: _vm.photo_static,
                    callback: function($$v) {
                      _vm.photo_static = $$v
                    },
                    expression: "photo_static"
                  }
                })
              ],
              1
            )
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "bg-30 flex px-8 py-4" }, [
            _c(
              "button",
              {
                staticClass:
                  "btn btn-default btn-primary inline-flex items-center relative ml-auto mr-3",
                attrs: { type: "button" },
                on: { click: _vm.saveConfiguration }
              },
              [_c("span", {}, [_vm._v(_vm._s(_vm.__("save_config")))])]
            )
          ])
        ])
      ])
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-bdcfabea", module.exports)
  }
}

/***/ }),
/* 20 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })
/******/ ]);