(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[4],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/shop/ShopBox.vue?vue&type=script&lang=js&":
/*!***********************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/shop/ShopBox.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.esm.js");
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }
function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys(Object(source), !0).forEach(function (key) { _defineProperty(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }

/* harmony default export */ __webpack_exports__["default"] = ({
  props: {
    boxStyle: {
      type: String,
      "default": 'one'
    },
    isLoading: {
      type: Boolean,
      required: true,
      "default": true
    },
    shopDetails: {
      type: Object,
      required: true,
      "default": {}
    }
  },
  computed: _objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_0__["mapGetters"])("follow", ["isThisFollowed"])),
  methods: _objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_0__["mapActions"])("follow", ["addNewFollowedShop", "removeFromFollowedShop"]))
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/shop/ShopBox.vue?vue&type=template&id=6700eaf2&":
/*!*********************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib/loaders/templateLoader.js??ref--6!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/shop/ShopBox.vue?vue&type=template&id=6700eaf2& ***!
  \*********************************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function render() {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    "class": [_vm.boxStyle == "two" ? "shop-box-two" : _vm.boxStyle == "three" ? "shop-box-three" : _vm.boxStyle == "four" ? "shop-box-four" : "shop-box-one"]
  }, [_vm.isLoading && _vm.is_empty_obj(_vm.shopDetails) ? _c("div", [_c("v-skeleton-loader", {
    attrs: {
      type: "image",
      height: "310"
    }
  })], 1) : _c("div", {
    staticClass: "border rounded overflow-hidden"
  }, [_c("v-row", {
    attrs: {
      "no-gutters": "",
      align: "center"
    }
  }, [_c("v-col", {
    staticClass: "minw-0 position-relative",
    attrs: {
      sm: _vm.boxStyle == "three" ? "6" : null,
      cols: "12"
    }
  }, [_vm.boxStyle != "three" ? _c("div", {
    staticClass: "lh-0 position-relative"
  }, [_c("router-link", {
    staticClass: "text-reset d-block",
    attrs: {
      to: {
        name: "ShopDetails",
        params: {
          slug: _vm.shopDetails.slug
        }
      }
    }
  }, [_c("img", {
    staticClass: "img-fit h-150px",
    attrs: {
      src: _vm.shopDetails.banner,
      alt: _vm.shopDetails.name
    },
    on: {
      error: function error($event) {
        return _vm.imageFallback($event);
      }
    }
  })]), _vm._v(" "), _vm.boxStyle == "two" ? _c("div", {
    staticClass: "absolute-bottom-left w-100 grey darken-3 white--text d-flex align-center py-2 fs-12 px-3"
  }, [_c("span", {
    staticClass: "me-1 fw-600"
  }, [_vm._v(_vm._s(_vm.shopDetails.rating.toFixed(2)))]), _vm._v(" "), _c("v-rating", {
    staticClass: "lh-1-2",
    attrs: {
      "background-color": "",
      "empty-icon": "las la-star",
      "full-icon": "las la-star active",
      "half-icon": "las la-star half",
      hover: "",
      "half-increments": "",
      readonly: "",
      size: "11",
      length: "5",
      value: _vm.shopDetails.rating
    }
  }), _vm._v(" "), _c("span", {
    staticClass: "ms-3 opacity-50"
  }, [_vm._v("(" + _vm._s(_vm.shopDetails.reviews_count) + " " + _vm._s(_vm.$t("ratings")) + ")")])], 1) : _vm._e()], 1) : _vm._e(), _vm._v(" "), _c("div", {
    "class": ["text-center fs-12", _vm.boxStyle == "three" ? "pa-4" : _vm.boxStyle == "four" ? "absolute-left-center align-center d-flex ms-4" : "pa-5 position-relative"]
  }, [_vm.boxStyle != "two" ? _c("router-link", {
    staticClass: "text-reset",
    attrs: {
      to: {
        name: "ShopDetails",
        params: {
          slug: _vm.shopDetails.slug
        }
      }
    }
  }, [_c("img", {
    "class": ["border rounded-circle shadow-2xl border-2 size-90px", {
      "mt-n15": _vm.boxStyle == "one"
    }, {
      "mb-2": _vm.boxStyle != "four"
    }],
    attrs: {
      src: _vm.shopDetails.logo,
      alt: _vm.shopDetails.name
    },
    on: {
      error: function error($event) {
        return _vm.imageFallback($event);
      }
    }
  })]) : _vm._e(), _vm._v(" "), _c("div", {
    "class": [{
      "ms-3 pt-1 pb-2 px-3 text-start position-relative": _vm.boxStyle == "four"
    }]
  }, [_vm.boxStyle == "four" ? _c("div", {
    staticClass: "white absolute-full opacity-80",
    staticStyle: {
      "z-index": "-1"
    }
  }) : _vm._e(), _vm._v(" "), _c("router-link", {
    staticClass: "text-reset",
    attrs: {
      to: {
        name: "ShopDetails",
        params: {
          slug: _vm.shopDetails.slug
        }
      }
    }
  }, [_c("h4", {
    "class": ["fs-21", _vm.boxStyle == "three" ? "text-truncate-2 lh-1-4 h-60px" : "text-truncate", {
      "mb-2": _vm.boxStyle != "four"
    }]
  }, [_vm._v("\n                                " + _vm._s(_vm.shopDetails.name) + "\n                                "), _vm.shopDetails.isVarified ? _c("span", {
    staticClass: "ml-2"
  }, [_c("svg", {
    attrs: {
      xmlns: "http://www.w3.org/2000/svg",
      width: "17.5",
      height: "17.5",
      viewBox: "0 0 17.5 17.5"
    }
  }, [_c("g", {
    attrs: {
      id: "Group_25616",
      "data-name": "Group 25616",
      transform: "translate(-537.249 -1042.75)"
    }
  }, [_c("path", {
    attrs: {
      id: "Union_5",
      "data-name": "Union 5",
      d: "M0,8.75A8.75,8.75,0,1,1,8.75,17.5,8.75,8.75,0,0,1,0,8.75Zm.876,0A7.875,7.875,0,1,0,8.75.875,7.883,7.883,0,0,0,.876,8.75Zm.875,0a7,7,0,1,1,7,7A7.008,7.008,0,0,1,1.751,8.751Zm3.73-.907a.789.789,0,0,0,0,1.115l2.23,2.23a.788.788,0,0,0,1.115,0l3.717-3.717a.789.789,0,0,0,0-1.115.788.788,0,0,0-1.115,0l-3.16,3.16L6.6,7.844a.788.788,0,0,0-1.115,0Z",
      transform: "translate(537.249 1042.75)",
      fill: "#3490f3"
    }
  })])])]) : _vm._e()])]), _vm._v(" "), _vm.boxStyle == "one" ? _c("div", {
    staticClass: "text-truncate-2 opacity-80 h-40px"
  }, _vm._l(_vm.shopDetails.categories.data, function (category, i) {
    return _c("span", {
      key: i
    }, [_vm._v("\n                                " + _vm._s(category.name)), _vm.shopDetails.categories.data.length - i != 1 ? _c("span", [_vm._v(",")]) : _vm._e()]);
  }), 0) : _vm._e(), _vm._v(" "), _vm.boxStyle != "two" ? _c("div", {
    "class": ["d-flex fs-12", {
      "my-2 justify-center": _vm.boxStyle != "four"
    }]
  }, [_c("span", {
    "class": [_vm.boxStyle == "three" ? "" : "me-2"]
  }, [_vm._v(_vm._s(_vm.shopDetails.rating.toFixed(1)))]), _vm._v(" "), _c("v-rating", {
    staticClass: "lh-1-4",
    attrs: {
      "background-color": "",
      "empty-icon": "las la-star",
      "full-icon": "las la-star active",
      "half-icon": "las la-star half",
      hover: "",
      "half-increments": "",
      readonly: "",
      size: "11",
      length: "5",
      value: _vm.shopDetails.rating
    }
  }), _vm._v(" "), _c("span", {
    staticClass: "opacity-80"
  }, [_vm._v("(" + _vm._s(_vm.shopDetails.reviews_count) + " " + _vm._s(_vm.$t("ratings")) + ")")])], 1) : _vm._e(), _vm._v(" "), _vm.boxStyle == "one" ? _c("div", {
    staticClass: "opacity-80"
  }, [_vm._v(_vm._s(_vm.$t("shop_since") + " " + _vm.shopDetails.since))]) : _vm._e(), _vm._v(" "), _vm.boxStyle == "one" ? _c("div", {
    staticClass: "opacity-80"
  }, [_vm._v(_vm._s(_vm.$t("total_products") + " " + _vm.shopDetails.products_count))]) : _vm._e()], 1), _vm._v(" "), _vm.boxStyle != "four" ? _c("div", {
    "class": [_vm.boxStyle == "two" ? "d-flex flex-column mt-5" : _vm.boxStyle == "three" ? "d-flex flex-column mt-3" : "mt-5"]
  }, [_vm.isThisFollowed(_vm.shopDetails.id) ? [_vm.boxStyle == "one" || _vm.boxStyle == "two" ? _c("v-btn", {
    "class": ["grey", _vm.boxStyle == "one" ? "white--text darken-1" : "lighten-2"],
    attrs: {
      elevation: "0",
      small: _vm.boxStyle == "one" ? false : true
    },
    on: {
      click: function click($event) {
        return _vm.removeFromFollowedShop(_vm.shopDetails.id);
      }
    }
  }, [_vm._v("\n                                " + _vm._s(_vm.$t("unfollow")) + "\n                            ")]) : _vm._e()] : [_vm.boxStyle == "one" || _vm.boxStyle == "two" ? _c("v-btn", {
    "class": [_vm.boxStyle == "one" ? "primary" : "grey lighten-4 border border-gray-300"],
    attrs: {
      elevation: "0",
      small: _vm.boxStyle == "one" ? false : true
    },
    on: {
      click: function click($event) {
        return _vm.addNewFollowedShop(_vm.shopDetails.id);
      }
    }
  }, [_vm._v("\n                                " + _vm._s(_vm.$t("follow")) + "\n                            ")]) : _vm._e()], _vm._v(" "), _c("v-btn", {
    "class": [_vm.boxStyle == "one" ? "ms-4 white--text grey darken-4" : _vm.boxStyle == "two" ? "mt-2 bg-soft-primary border border-primary" : _vm.boxStyle == "three" ? "mt-2 bg-soft-primary border border-primary" : "mt-2 bg-soft-primary border border-primary"],
    attrs: {
      elevation: "0",
      small: _vm.boxStyle == "one" ? false : true,
      to: {
        name: "ShopDetails",
        params: {
          slug: _vm.shopDetails.slug
        }
      }
    }
  }, [_vm._v("\n                            " + _vm._s(_vm.$t("visit_store")) + "\n                        ")])], 2) : _vm._e()], 1)]), _vm._v(" "), _vm.boxStyle == "three" || _vm.boxStyle == "four" ? _c("v-col", {
    staticClass: "minw-0",
    attrs: {
      cols: "12",
      sm: _vm.boxStyle == "three" ? "6" : null
    }
  }, [_c("div", {
    "class": [_vm.boxStyle == "four" ? "pa-4" : ""]
  }, [_vm.$optional("shopDetails.top_3_products?.data").length ? _c("v-row", {
    staticClass: "gutters-10",
    attrs: {
      "no-gutters": _vm.boxStyle == "four" ? false : true
    }
  }, _vm._l(_vm.shopDetails.top_3_products.data, function (product, i) {
    return _c("v-col", {
      key: i,
      attrs: {
        cols: "12",
        sm: _vm.boxStyle == "four" ? "4" : null
      }
    }, [_c("product-box", {
      "class": [_vm.boxStyle == "three" && i == 0 ? "my-4 me-4" : _vm.boxStyle == "three" ? "mb-4 me-4" : ""],
      attrs: {
        "product-details": product,
        "is-loading": _vm.isLoading,
        "box-style": "two"
      }
    })], 1);
  }), 1) : _c("div", {
    staticStyle: {
      height: "73px"
    }
  }), _vm._v(" "), _vm.boxStyle == "four" ? _c("div", {
    staticClass: "text-end mt-3"
  }, [_c("v-btn", {
    staticClass: "primary--text transparent",
    attrs: {
      small: "",
      link: "",
      elevation: "0",
      to: {
        name: "ShopDetails",
        params: {
          slug: _vm.shopDetails.slug
        }
      }
    }
  }, [_c("span", [_vm._v(_vm._s(_vm.$t("visit_store")))]), _vm._v(" "), _c("i", {
    staticClass: "las la-arrow-right"
  })])], 1) : _vm._e()], 1)]) : _vm._e()], 1)], 1)]);
};
var staticRenderFns = [];
render._withStripped = true;


/***/ }),

/***/ "./resources/js/components/shop/ShopBox.vue":
/*!**************************************************!*\
  !*** ./resources/js/components/shop/ShopBox.vue ***!
  \**************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ShopBox_vue_vue_type_template_id_6700eaf2___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ShopBox.vue?vue&type=template&id=6700eaf2& */ "./resources/js/components/shop/ShopBox.vue?vue&type=template&id=6700eaf2&");
/* harmony import */ var _ShopBox_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ShopBox.vue?vue&type=script&lang=js& */ "./resources/js/components/shop/ShopBox.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _ShopBox_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ShopBox_vue_vue_type_template_id_6700eaf2___WEBPACK_IMPORTED_MODULE_0__["render"],
  _ShopBox_vue_vue_type_template_id_6700eaf2___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/shop/ShopBox.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/shop/ShopBox.vue?vue&type=script&lang=js&":
/*!***************************************************************************!*\
  !*** ./resources/js/components/shop/ShopBox.vue?vue&type=script&lang=js& ***!
  \***************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ShopBox_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./ShopBox.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/shop/ShopBox.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ShopBox_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/shop/ShopBox.vue?vue&type=template&id=6700eaf2&":
/*!*********************************************************************************!*\
  !*** ./resources/js/components/shop/ShopBox.vue?vue&type=template&id=6700eaf2& ***!
  \*********************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_ShopBox_vue_vue_type_template_id_6700eaf2___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??ref--6!../../../../node_modules/vue-loader/lib??vue-loader-options!./ShopBox.vue?vue&type=template&id=6700eaf2& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/shop/ShopBox.vue?vue&type=template&id=6700eaf2&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_ShopBox_vue_vue_type_template_id_6700eaf2___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_ShopBox_vue_vue_type_template_id_6700eaf2___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);