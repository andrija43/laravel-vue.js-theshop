/*! For license information please see 33.js.LICENSE.txt?id=259b907231f9c0d76c5a */
(window.webpackJsonp=window.webpackJsonp||[]).push([[33],{eRvf:function(t,e,r){"use strict";r.r(e);var o=r("ta7f"),n=r("51uj"),i=r("L2JU");function s(t){return(s="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function a(){a=function(){return t};var t={},e=Object.prototype,r=e.hasOwnProperty,o=Object.defineProperty||function(t,e,r){t[e]=r.value},n="function"==typeof Symbol?Symbol:{},i=n.iterator||"@@iterator",c=n.asyncIterator||"@@asyncIterator",u=n.toStringTag||"@@toStringTag";function l(t,e,r){return Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}),t[e]}try{l({},"")}catch(t){l=function(t,e,r){return t[e]=r}}function f(t,e,r,n){var i=e&&e.prototype instanceof p?e:p,s=Object.create(i.prototype),a=new j(n||[]);return o(s,"_invoke",{value:x(t,r,a)}),s}function d(t,e,r){try{return{type:"normal",arg:t.call(e,r)}}catch(t){return{type:"throw",arg:t}}}t.wrap=f;var h={};function p(){}function m(){}function v(){}var _={};l(_,i,(function(){return this}));var y=Object.getPrototypeOf,w=y&&y(y(E([])));w&&w!==e&&r.call(w,i)&&(_=w);var g=v.prototype=p.prototype=Object.create(_);function b(t){["next","throw","return"].forEach((function(e){l(t,e,(function(t){return this._invoke(e,t)}))}))}function $(t,e){var n;o(this,"_invoke",{value:function(o,i){function a(){return new e((function(n,a){!function o(n,i,a,c){var u=d(t[n],t,i);if("throw"!==u.type){var l=u.arg,f=l.value;return f&&"object"==s(f)&&r.call(f,"__await")?e.resolve(f.__await).then((function(t){o("next",t,a,c)}),(function(t){o("throw",t,a,c)})):e.resolve(f).then((function(t){l.value=t,a(l)}),(function(t){return o("throw",t,a,c)}))}c(u.arg)}(o,i,n,a)}))}return n=n?n.then(a,a):a()}})}function x(t,e,r){var o="suspendedStart";return function(n,i){if("executing"===o)throw new Error("Generator is already running");if("completed"===o){if("throw"===n)throw i;return L()}for(r.method=n,r.arg=i;;){var s=r.delegate;if(s){var a=P(s,r);if(a){if(a===h)continue;return a}}if("next"===r.method)r.sent=r._sent=r.arg;else if("throw"===r.method){if("suspendedStart"===o)throw o="completed",r.arg;r.dispatchException(r.arg)}else"return"===r.method&&r.abrupt("return",r.arg);o="executing";var c=d(t,e,r);if("normal"===c.type){if(o=r.done?"completed":"suspendedYield",c.arg===h)continue;return{value:c.arg,done:r.done}}"throw"===c.type&&(o="completed",r.method="throw",r.arg=c.arg)}}}function P(t,e){var r=e.method,o=t.iterator[r];if(void 0===o)return e.delegate=null,"throw"===r&&t.iterator.return&&(e.method="return",e.arg=void 0,P(t,e),"throw"===e.method)||"return"!==r&&(e.method="throw",e.arg=new TypeError("The iterator does not provide a '"+r+"' method")),h;var n=d(o,t.iterator,e.arg);if("throw"===n.type)return e.method="throw",e.arg=n.arg,e.delegate=null,h;var i=n.arg;return i?i.done?(e[t.resultName]=i.value,e.next=t.nextLoc,"return"!==e.method&&(e.method="next",e.arg=void 0),e.delegate=null,h):i:(e.method="throw",e.arg=new TypeError("iterator result is not an object"),e.delegate=null,h)}function O(t){var e={tryLoc:t[0]};1 in t&&(e.catchLoc=t[1]),2 in t&&(e.finallyLoc=t[2],e.afterLoc=t[3]),this.tryEntries.push(e)}function C(t){var e=t.completion||{};e.type="normal",delete e.arg,t.completion=e}function j(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(O,this),this.reset(!0)}function E(t){if(t){var e=t[i];if(e)return e.call(t);if("function"==typeof t.next)return t;if(!isNaN(t.length)){var o=-1,n=function e(){for(;++o<t.length;)if(r.call(t,o))return e.value=t[o],e.done=!1,e;return e.value=void 0,e.done=!0,e};return n.next=n}}return{next:L}}function L(){return{value:void 0,done:!0}}return m.prototype=v,o(g,"constructor",{value:v,configurable:!0}),o(v,"constructor",{value:m,configurable:!0}),m.displayName=l(v,u,"GeneratorFunction"),t.isGeneratorFunction=function(t){var e="function"==typeof t&&t.constructor;return!!e&&(e===m||"GeneratorFunction"===(e.displayName||e.name))},t.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,v):(t.__proto__=v,l(t,u,"GeneratorFunction")),t.prototype=Object.create(g),t},t.awrap=function(t){return{__await:t}},b($.prototype),l($.prototype,c,(function(){return this})),t.AsyncIterator=$,t.async=function(e,r,o,n,i){void 0===i&&(i=Promise);var s=new $(f(e,r,o,n),i);return t.isGeneratorFunction(r)?s:s.next().then((function(t){return t.done?t.value:s.next()}))},b(g),l(g,u,"Generator"),l(g,i,(function(){return this})),l(g,"toString",(function(){return"[object Generator]"})),t.keys=function(t){var e=Object(t),r=[];for(var o in e)r.push(o);return r.reverse(),function t(){for(;r.length;){var o=r.pop();if(o in e)return t.value=o,t.done=!1,t}return t.done=!0,t}},t.values=E,j.prototype={constructor:j,reset:function(t){if(this.prev=0,this.next=0,this.sent=this._sent=void 0,this.done=!1,this.delegate=null,this.method="next",this.arg=void 0,this.tryEntries.forEach(C),!t)for(var e in this)"t"===e.charAt(0)&&r.call(this,e)&&!isNaN(+e.slice(1))&&(this[e]=void 0)},stop:function(){this.done=!0;var t=this.tryEntries[0].completion;if("throw"===t.type)throw t.arg;return this.rval},dispatchException:function(t){if(this.done)throw t;var e=this;function o(r,o){return s.type="throw",s.arg=t,e.next=r,o&&(e.method="next",e.arg=void 0),!!o}for(var n=this.tryEntries.length-1;n>=0;--n){var i=this.tryEntries[n],s=i.completion;if("root"===i.tryLoc)return o("end");if(i.tryLoc<=this.prev){var a=r.call(i,"catchLoc"),c=r.call(i,"finallyLoc");if(a&&c){if(this.prev<i.catchLoc)return o(i.catchLoc,!0);if(this.prev<i.finallyLoc)return o(i.finallyLoc)}else if(a){if(this.prev<i.catchLoc)return o(i.catchLoc,!0)}else{if(!c)throw new Error("try statement without catch or finally");if(this.prev<i.finallyLoc)return o(i.finallyLoc)}}}},abrupt:function(t,e){for(var o=this.tryEntries.length-1;o>=0;--o){var n=this.tryEntries[o];if(n.tryLoc<=this.prev&&r.call(n,"finallyLoc")&&this.prev<n.finallyLoc){var i=n;break}}i&&("break"===t||"continue"===t)&&i.tryLoc<=e&&e<=i.finallyLoc&&(i=null);var s=i?i.completion:{};return s.type=t,s.arg=e,i?(this.method="next",this.next=i.finallyLoc,h):this.complete(s)},complete:function(t,e){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&e&&(this.next=e),h},finish:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.finallyLoc===t)return this.complete(r.completion,r.afterLoc),C(r),h}},catch:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.tryLoc===t){var o=r.completion;if("throw"===o.type){var n=o.arg;C(r)}return n}}throw new Error("illegal catch attempt")},delegateYield:function(t,e,r){return this.delegate={iterator:E(t),resultName:e,nextLoc:r},"next"===this.method&&(this.arg=void 0),h}},t}function c(t,e,r,o,n,i,s){try{var a=t[i](s),c=a.value}catch(t){return void r(t)}a.done?e(c):Promise.resolve(c).then(o,n)}function u(t,e){var r=Object.keys(t);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(t);e&&(o=o.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),r.push.apply(r,o)}return r}function l(t){for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{};e%2?u(Object(r),!0).forEach((function(e){f(t,e,r[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):u(Object(r)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))}))}return t}function f(t,e,r){return(e=function(t){var e=function(t,e){if("object"!==s(t)||null===t)return t;var r=t[Symbol.toPrimitive];if(void 0!==r){var o=r.call(t,e||"default");if("object"!==s(o))return o;throw new TypeError("@@toPrimitive must return a primitive value.")}return("string"===e?String:Number)(t)}(t,"string");return"symbol"===s(e)?e:String(e)}(e))in t?Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}):t[e]=r,t}var d={data:function(){return{mobileInputProps:{inputOptions:{type:"tel",placeholder:"phone number"},dropdownOptions:{showDialCodeInSelection:!1,showFlags:!0,showDialCodeInList:!0},autoDefaultCountry:!1,validCharactersOnly:!0,mode:"international"},form:{email:"",code:"",password:"",confirmPassword:"",invalidPhone:!0,showInvalidPhone:!1},resetWith:"email",loading:!1}},components:{VueTelInput:n.VueTelInput},validations:{form:{email:{requiredIf:Object(o.requiredIf)((function(){return"email"==this.resetWith})),email:o.email},phone:{requiredIf:Object(o.requiredIf)((function(){return"phone"==this.resetWith}))},code:{required:o.required},password:{required:o.required,minLength:Object(o.minLength)(6)},confirmPassword:{required:o.required,sameAsPassword:Object(o.sameAs)("password")}}},computed:l(l(l({},Object(i.c)("app",["availableCountries"])),Object(i.c)("auth",["authSettings"])),{},{emailErrors:function(){var t=[];return this.$v.form.email.$dirty?(!this.$v.form.email.requiredIf&&t.push(this.$i18n.t("this_field_is_required")),!this.$v.form.email.email&&t.push(this.$i18n.t("this_field_is_required_a_valid_email")),t):t},codeErrors:function(){var t=[];return this.$v.form.code.$dirty?(!this.$v.form.code.required&&t.push(this.$i18n.t("this_field_is_required")),t):t},passwordErrors:function(){var t=[];return this.$v.form.password.$dirty?(!this.$v.form.password.required&&t.push(this.$i18n.t("this_field_is_required")),!this.$v.form.password.minLength&&t.push(this.$i18n.t("password_must_be_minimum_6_characters")),t):t},confirmPasswordErrors:function(){var t=[];return this.$v.form.confirmPassword.$dirty?(!this.$v.form.confirmPassword.required&&t.push(this.$i18n.t("this_field_is_required")),!this.$v.form.confirmPassword.sameAsPassword&&t.push(this.$i18n.t("password_and_confirm_password_should_match")),t):t}}),methods:{phoneValidate:function(t){this.form.invalidPhone=!t.valid,t.valid&&(this.form.showInvalidPhone=!1)},resetPassword:function(){var t,e=this;return(t=a().mark((function t(){var r;return a().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:if(e.$v.form.$touch(),!e.$v.form.$anyError){t.next=3;break}return t.abrupt("return");case 3:if("phone"!=e.resetWith||!e.form.invalidPhone){t.next=6;break}return e.form.showInvalidPhone=!0,t.abrupt("return");case 6:return e.form.code=e.form.code.replace(/\s/g,""),e.loading=!0,t.next=10,e.call_api("post","auth/password/reset",e.form);case 10:(r=t.sent).data.success?(e.$router.push({name:"Login"}),e.snack({message:r.data.message})):e.snack({message:r.data.message,color:"red"}),e.loading=!1;case 13:case"end":return t.stop()}}),t)})),function(){var e=this,r=arguments;return new Promise((function(o,n){var i=t.apply(e,r);function s(t){c(i,o,n,s,a,"next",t)}function a(t){c(i,o,n,s,a,"throw",t)}s(void 0)}))})()}},created:function(){this.$route.params.email&&(this.form.email=this.$route.params.email),this.$route.params.phone?(this.form.phone=this.$route.params.phone,this.resetWith="phone"):("phone"==this.authSettings.customer_login_with||"email_phone"==this.authSettings.customer_login_with&&"phone"==this.authSettings.customer_otp_with)&&(this.resetWith="phone")}},h=r("KHd+"),p=Object(h.a)(d,(function(){var t=this,e=t._self._c;return e("div",[e("v-container",[e("v-row",[e("v-col",{staticClass:"mx-auto",attrs:{cols:"12",lg:"6",md:"8",sm:"10"}},[e("div",{staticClass:"my-5 my-lg-16 rounded-lg pa-5 border overflow-hidden shadow-light"},["email"==t.resetWith?e("div",{staticClass:"info--text mb-3"},[t._v("\n                        "+t._s(t.$t("a_verification_code_has_been_sent_to_your_email"))+"\n                    ")]):e("div",{staticClass:"info--text mb-3"},[t._v("\n                        "+t._s(t.$t("a_verification_code_has_been_sent_to_your_phone_number"))+"\n                    ")]),t._v(" "),e("h1",{staticClass:"text-uppercase lh-1 mb-4"},[e("span",{staticClass:"display-1 primary--text fw-900"},[t._v(t._s(t.$t("reset")))]),t._v(" "),e("span",{staticClass:"d-block display-1 fw-900 grey--text text--darken-3"},[t._v(t._s(t.$t("password")))])]),t._v(" "),"email"==t.resetWith?e("div",{staticClass:"fs-16 fw-500 mb-6"},[t._v(t._s(t.$t("enter_your_email_address_code__new_password")))]):e("div",{staticClass:"fs-16 fw-500 mb-6"},[t._v(t._s(t.$t("enter_your_phone_number_code__new_password")))]),t._v(" "),e("v-form",{ref:"loginForm",attrs:{"lazy-validation":""},on:{submit:function(e){return e.preventDefault(),t.resetPassword()}}},["email"==t.resetWith?e("div",{staticClass:"mb-4"},[e("div",{staticClass:"mb-1 fs-13 fw-500"},[t._v(t._s(t.$t("email")))]),t._v(" "),e("v-text-field",{attrs:{placeholder:t.$t("email_address"),type:"email","error-messages":t.emailErrors,"hide-details":"auto",required:"",outlined:""},model:{value:t.form.email,callback:function(e){t.$set(t.form,"email",e)},expression:"form.email"}})],1):t._e(),t._v(" "),"phone"==t.resetWith?e("div",{staticClass:"mb-4"},[e("div",{staticClass:"mb-1 fs-13 fw-500"},[t._v("\n                                "+t._s(t.$t("phone_number"))+"\n                            ")]),t._v(" "),e("vue-tel-input",t._b({attrs:{"only-countries":t.availableCountries},on:{validate:t.phoneValidate},scopedSlots:t._u([{key:"arrow-icon",fn:function(){return[e("span",{staticClass:"vti__dropdown-arrow"},[t._v(" ▼")])]},proxy:!0}],null,!1,2578343687),model:{value:t.form.phone,callback:function(e){t.$set(t.form,"phone",e)},expression:"form.phone"}},"vue-tel-input",t.mobileInputProps,!1)),t._v(" "),t.$v.form.phone.$error?e("div",{staticClass:"v-text-field__details mt-2 pl-3"},[e("div",{staticClass:"v-messages theme--light error--text",attrs:{role:"alert"}},[e("div",{staticClass:"v-messages__wrapper"},[e("div",{staticClass:"v-messages__message"},[t._v(t._s(t.$t("this_field_is_required")))])])])]):t._e(),t._v(" "),!t.$v.form.phone.$error&&t.form.showInvalidPhone?e("div",{staticClass:"v-text-field__details mt-2 pl-3"},[e("div",{staticClass:"v-messages theme--light error--text",attrs:{role:"alert"}},[e("div",{staticClass:"v-messages__wrapper"},[e("div",{staticClass:"v-messages__message"},[t._v("\n                                            "+t._s(t.$t("phone_number_must_be_valid"))+"\n                                        ")])])])]):t._e()],1):t._e(),t._v(" "),e("div",{staticClass:"mb-4"},[e("div",{staticClass:"mb-1 fs-13 fw-500"},[t._v(t._s(t.$t("code")))]),t._v(" "),e("v-otp-input",{attrs:{length:"6",type:"number","error-messages":t.codeErrors,"hide-details":"auto",disabled:t.loading,required:""},model:{value:t.form.code,callback:function(e){t.$set(t.form,"code",e)},expression:"form.code"}})],1),t._v(" "),e("div",{staticClass:"mb-4"},[e("div",{staticClass:"mb-1 fs-13 fw-500"},[t._v(t._s(t.$t("password")))]),t._v(" "),e("v-text-field",{staticClass:"input-group--focused",attrs:{placeholder:"* * * * * * * *","error-messages":t.passwordErrors,type:"password","hide-details":"auto",required:"",outlined:""},on:{blur:function(e){return t.$v.form.password.$touch()}},model:{value:t.form.password,callback:function(e){t.$set(t.form,"password",e)},expression:"form.password"}})],1),t._v(" "),e("div",{staticClass:"mb-4"},[e("div",{staticClass:"mb-1 fs-13 fw-500"},[t._v(t._s(t.$t("confirm_password")))]),t._v(" "),e("v-text-field",{staticClass:"input-group--focused",attrs:{placeholder:"* * * * * * * *","error-messages":t.confirmPasswordErrors,type:"password","hide-details":"auto",required:"",outlined:""},on:{blur:function(e){return t.$v.form.confirmPassword.$touch()}},model:{value:t.form.confirmPassword,callback:function(e){t.$set(t.form,"confirmPassword",e)},expression:"form.confirmPassword"}})],1),t._v(" "),e("v-btn",{staticClass:"px-12 mb-4",attrs:{"x-large":"",elevation:"0",type:"submit",color:"primary",loading:t.loading,disabled:t.loading},on:{click:t.resetPassword}},[t._v(t._s(t.$t("reset_password")))])],1)],1)])],1)],1)],1)}),[],!1,null,null,null);e.default=p.exports}}]);