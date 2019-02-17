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
module.exports = __webpack_require__(9);


/***/ }),
/* 2 */
/***/ (function(module, exports, __webpack_require__) {

Nova.booting(function (Vue, router) {
    router.addRoutes([{
        name: 'jetsoft-shopconnector',
        path: '/jetsoft-shopconnector',
        component: __webpack_require__(3)
    }, {
        name: 'jetsoft-shopconnector-configure',
        path: '/jetsoft-shopconnector/configure',
        component: __webpack_require__(6)
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
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
            status: null,
            run_daily: null
        };
    },

    methods: {
        sync: function sync() {
            var _this = this;

            Nova.request().post('/nova-vendor/jetsoft-shopconnector/sync').then(function () {
                _this.$toasted.success(_this.__('syncing_in_progress'));
                setTimeout(_this.refresh, 2000);
            }).catch(function (err) {
                _this.$toasted.error(_this.__('please_check_config'));
            });
        },
        refresh: function refresh() {
            var _this2 = this;

            Nova.request().get('/nova-vendor/jetsoft-shopconnector/status').then(function (_ref) {
                var data = _ref.data;

                _this2.lastUpdate = data.payload.lastUpdate;
                _this2.duration = data.payload.duration;
                _this2.status = data.payload.status;
                _this2.run_daily = data.payload.run_daily == 'true' ? 'enabled' : 'disabled';
            });
        }
    },

    created: function created() {
        this.refresh();
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
      _c(
        "div",
        { staticClass: "flex" },
        [
          _c("heading", { staticClass: "mb-6 flex-no-shrink" }, [
            _vm._v(_vm._s(_vm.__("jetsoft_shopconnector")))
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
                    attrs: { to: "/jetsoft-shopconnector/configure" }
                  },
                  [_vm._v(_vm._s(_vm.__("configuration")))]
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
            _vm._v(_vm._s(_vm.__("run_daily")))
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "w-3/4" }, [
            _vm._v(_vm._s(_vm.__(_vm.run_daily)))
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
    require("vue-hot-reload-api")      .rerender("data-v-68ff5483", module.exports)
  }
}

/***/ }),
/* 6 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(7)
/* template */
var __vue_template__ = __webpack_require__(8)
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
/* 7 */
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
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
            eshopname: '',
            identifier: 'barcode',
            host: '',
            port: '',
            database: '',
            username: '',
            password: '',
            run_daily: false
        };
    },


    methods: {
        saveConfiguration: function saveConfiguration() {
            var _this = this;

            Nova.request().post('/nova-vendor/jetsoft-shopconnector/save-configuration', this.$data).then(function () {
                _this.$toasted.success(_this.__('configuration_saved'));
                _this.$router.push('/jetsoft-shopconnector');
            });
        }
    },

    mounted: function mounted() {
        var _this2 = this;

        Nova.request().get('/nova-vendor/jetsoft-shopconnector/settings').then(function (_ref) {
            var data = _ref.data;

            _this2.eshopname = data.payload ? data.payload.eshopname : _this2.eshopname;
            _this2.identifier = data.payload ? data.payload.identifier : _this2.identifier;
            _this2.host = data.payload ? data.payload.host : _this2.host;
            _this2.port = data.payload ? data.payload.port : _this2.port;
            _this2.database = data.payload ? data.payload.database : _this2.database;
            _this2.username = data.payload ? data.payload.username : _this2.username;
            _this2.password = data.payload ? data.payload.password : _this2.password;
            _this2.run_daily = data.payload ? data.payload.run_daily : _this2.run_daily;
        });
    }
});

/***/ }),
/* 8 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _c("heading", { staticClass: "mb-6" }, [
        _vm._v(_vm._s(_vm.__("jetsoft_shopconnector_config")))
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
                  attrs: { for: "eshopname" }
                },
                [
                  _vm._v(
                    "\n                        " +
                      _vm._s(_vm.__("eshop_name")) +
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
                    value: _vm.eshopname,
                    expression: "eshopname"
                  }
                ],
                staticClass:
                  "w-full form-control form-input form-input-bordered",
                attrs: {
                  id: "eshopname",
                  type: "text",
                  placeholder: _vm.__(_vm.eshop_name)
                },
                domProps: { value: _vm.eshopname },
                on: {
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.eshopname = $event.target.value
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
                  _c(
                    "option",
                    { attrs: { value: "barcode", selected: "selected" } },
                    [_vm._v(_vm._s(_vm.__("barcode")))]
                  ),
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
                  attrs: { for: "host" }
                },
                [
                  _vm._v(
                    "\n                        " +
                      _vm._s(_vm.__("host")) +
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
                    value: _vm.host,
                    expression: "host"
                  }
                ],
                staticClass:
                  "w-full form-control form-input form-input-bordered",
                attrs: {
                  id: "host",
                  type: "text",
                  placeholder: _vm.__("host")
                },
                domProps: { value: _vm.host },
                on: {
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.host = $event.target.value
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
                  attrs: { for: "port" }
                },
                [
                  _vm._v(
                    "\n                        " +
                      _vm._s(_vm.__("port")) +
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
                    value: _vm.port,
                    expression: "port"
                  }
                ],
                staticClass:
                  "w-full form-control form-input form-input-bordered",
                attrs: {
                  id: "port",
                  type: "text",
                  placeholder: _vm.__("port")
                },
                domProps: { value: _vm.port },
                on: {
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.port = $event.target.value
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
                  attrs: { for: "database" }
                },
                [
                  _vm._v(
                    "\n                        " +
                      _vm._s(_vm.__("database")) +
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
                    value: _vm.database,
                    expression: "database"
                  }
                ],
                staticClass:
                  "w-full form-control form-input form-input-bordered",
                attrs: {
                  id: "database",
                  type: "text",
                  placeholder: _vm.__("database")
                },
                domProps: { value: _vm.database },
                on: {
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.database = $event.target.value
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
                  attrs: { for: "username" }
                },
                [
                  _vm._v(
                    "\n                        " +
                      _vm._s(_vm.__("username")) +
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
                    value: _vm.username,
                    expression: "username"
                  }
                ],
                staticClass:
                  "w-full form-control form-input form-input-bordered",
                attrs: {
                  id: "username",
                  type: "text",
                  placeholder: _vm.__("username")
                },
                domProps: { value: _vm.username },
                on: {
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.username = $event.target.value
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
                  attrs: { for: "password" }
                },
                [
                  _vm._v(
                    "\n                        " +
                      _vm._s(_vm.__("password")) +
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
                    value: _vm.password,
                    expression: "password"
                  }
                ],
                staticClass:
                  "w-full form-control form-input form-input-bordered",
                attrs: {
                  id: "password",
                  type: "text",
                  placeholder: _vm.__("password")
                },
                domProps: { value: _vm.password },
                on: {
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.password = $event.target.value
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
                  attrs: { for: "run_daily" }
                },
                [
                  _vm._v(
                    "\n                        " +
                      _vm._s(_vm.__("run_daily")) +
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
                      value: _vm.run_daily,
                      expression: "run_daily"
                    }
                  ],
                  staticClass: "w-full form-control form-select",
                  attrs: {
                    name: "run_daily",
                    id: "run_daily",
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
                      _vm.run_daily = $event.target.multiple
                        ? $$selectedVal
                        : $$selectedVal[0]
                    }
                  }
                },
                [
                  _c("option", { attrs: { value: "false" } }, [
                    _vm._v(_vm._s(_vm.__("disabled")))
                  ]),
                  _vm._v(" "),
                  _c("option", { attrs: { value: "true" } }, [
                    _vm._v(_vm._s(_vm.__("enabled")))
                  ])
                ]
              )
            ])
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
/* 9 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })
/******/ ]);