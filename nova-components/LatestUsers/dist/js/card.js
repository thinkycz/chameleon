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
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(1);
module.exports = __webpack_require__(6);


/***/ }),
/* 1 */
/***/ (function(module, exports, __webpack_require__) {

Nova.booting(function (Vue, router) {
    Vue.component('latest-users', __webpack_require__(2));
});

/***/ }),
/* 2 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(3)
/* script */
var __vue_script__ = __webpack_require__(4)
/* template */
var __vue_template__ = __webpack_require__(5)
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
Component.options.__file = "resources/js/components/Card.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-b9bc2c0a", Component.options)
  } else {
    hotAPI.reload("data-v-b9bc2c0a", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 3 */
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
/* 4 */
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
//
//
//
//
//
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
    props: {
        card: {
            required: true
        }
    },

    data: function data() {
        return {
            users: [],
            loading: true
        };
    },

    mounted: function mounted() {
        var _this = this;

        Nova.request().get('/nova-vendor/latest-users/latest').then(function (_ref) {
            var data = _ref.data;

            _this.users = data.data;
            _this.loading = false;
        });
    }
});

/***/ }),
/* 5 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _c("h1", { staticClass: "mb-6 text-90 font-normal text-2xl" }, [
        _vm._v(_vm._s(_vm.__("latest_users")))
      ]),
      _vm._v(" "),
      _c(
        "loading-card",
        {
          ref: "card",
          staticClass:
            "card relative border border-lg border-50 overflow-hidden px-0 py-0",
          attrs: { loading: _vm.loading }
        },
        [
          _vm.loading
            ? _c("div", { staticStyle: { height: "100px" } })
            : _vm._e(),
          _vm._v(" "),
          _c(
            "div",
            { staticClass: "overflow-hidden overflow-x-auto relative" },
            [
              _c(
                "table",
                {
                  staticClass: "table w-full",
                  attrs: {
                    cellpadding: "0",
                    cellspacing: "0",
                    "data-testid": "resource-table"
                  }
                },
                [
                  _c("thead", [
                    _c("tr", [
                      _c("th", { staticClass: "text-left" }, [
                        _c("span", [_vm._v(_vm._s(_vm.__("user_id")))])
                      ]),
                      _vm._v(" "),
                      _c("th", { staticClass: "text-left" }, [
                        _c("span", [_vm._v(" ")])
                      ]),
                      _vm._v(" "),
                      _c("th", { staticClass: "text-left" }, [
                        _c("span", [_vm._v(_vm._s(_vm.__("user_name")))])
                      ]),
                      _vm._v(" "),
                      _c("th", { staticClass: "text-left" }, [
                        _c("span", [_vm._v(_vm._s(_vm.__("order_email")))])
                      ]),
                      _vm._v(" "),
                      _c("th", { staticClass: "text-left" }, [
                        _c("span", [_vm._v(_vm._s(_vm.__("order_phone")))])
                      ]),
                      _vm._v(" "),
                      _c("th", { staticClass: "text-left" }, [
                        _c("span", [_vm._v(_vm._s(_vm.__("user_price_level")))])
                      ]),
                      _vm._v(" "),
                      _c("th", { staticClass: "text-left" }, [
                        _c("span", [_vm._v(_vm._s(_vm.__("user_is_active")))])
                      ])
                    ])
                  ]),
                  _vm._v(" "),
                  _c(
                    "tbody",
                    _vm._l(_vm.users, function(user, index) {
                      return _c("tr", { key: "users-" + index }, [
                        _c("td", [
                          _c(
                            "span",
                            { staticClass: "whitespace-no-wrap text-left" },
                            [_vm._v(_vm._s(user.id))]
                          )
                        ]),
                        _vm._v(" "),
                        _c("td", [
                          _c("p", { staticClass: "text-center" }, [
                            _c("img", {
                              staticClass: "rounded-full w-8 h-8",
                              staticStyle: { "object-fit": "cover" },
                              attrs: { src: user.image }
                            })
                          ])
                        ]),
                        _vm._v(" "),
                        _c("td", [
                          _c(
                            "span",
                            { staticClass: "whitespace-no-wrap text-left" },
                            [_vm._v(_vm._s(user.name))]
                          )
                        ]),
                        _vm._v(" "),
                        _c("td", [
                          _c(
                            "div",
                            { staticClass: "whitespace-no-wrap text-left" },
                            [_c("span", [_vm._v(_vm._s(user.email))])]
                          )
                        ]),
                        _vm._v(" "),
                        _c("td", [
                          _c(
                            "a",
                            {
                              staticClass:
                                "no-underline text-primary text-left",
                              attrs: { href: "tel:+" + user.phone }
                            },
                            [_vm._v(_vm._s(user.phone))]
                          )
                        ]),
                        _vm._v(" "),
                        _c("td", [
                          user.price_level
                            ? _c(
                                "span",
                                { staticClass: "whitespace-no-wrap text-left" },
                                [
                                  _vm._v(
                                    "\n                                " +
                                      _vm._s(user.price_level.name) +
                                      "\n                            "
                                  )
                                ]
                              )
                            : _vm._e()
                        ]),
                        _vm._v(" "),
                        _c("td", [
                          _c("div", { staticClass: "text-center" }, [
                            _c("span", {
                              staticClass: "inline-block rounded-full w-2 h-2",
                              class: {
                                "bg-success": user.is_active,
                                "bg-danger": !user.is_active
                              }
                            })
                          ])
                        ])
                      ])
                    }),
                    0
                  )
                ]
              )
            ]
          )
        ]
      )
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
    require("vue-hot-reload-api")      .rerender("data-v-b9bc2c0a", module.exports)
  }
}

/***/ }),
/* 6 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })
/******/ ]);