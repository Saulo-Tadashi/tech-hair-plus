(()=>{var e={969:(e,t,r)=>{"use strict";r.r(t),r.d(t,{default:()=>i});var n=r(361),o=r.n(n)()((function(e){return e[1]}));o.push([e.id,"#form-fields-wrapper .jfb-pagination{padding:.8em 0}#form-fields-wrapper .cell--field_type{flex:.3}#form-fields-wrapper .cell--name{flex:.5}#actions-log .cell--created_at{flex:.5}@media print{div#wpadminbar,div#adminmenumain,.wrap>*:not(h1.wp-heading-inline,.jet-form-builder-page #poststuff),.jfb-post-box,.jfb-pagination{display:none}div#wpcontent{margin-left:unset;margin-right:unset}html.wp-toolbar{padding-top:unset}#form-fields-wrapper,#general-values-wrapper{display:block}}",""]);const i=o},876:(e,t,r)=>{"use strict";r.r(t),r.d(t,{default:()=>i});var n=r(361),o=r.n(n)()((function(e){return e[1]}));o.push([e.id,".field-type-template--icon>svg{width:24px;height:24px}",""]);const i=o},799:(e,t,r)=>{"use strict";r.r(t),r.d(t,{default:()=>i});var n=r(361),o=r.n(n)()((function(e){return e[1]}));o.push([e.id,"\n.field-name-template {\r\n\tdisplay: flex;\r\n\tgap: 0.5em;\r\n\tflex-direction: column;\n}\r\n",""]);const i=o},361:e=>{"use strict";e.exports=function(e){var t=[];return t.toString=function(){return this.map((function(t){var r=e(t);return t[2]?"@media ".concat(t[2]," {").concat(r,"}"):r})).join("")},t.i=function(e,r,n){"string"==typeof e&&(e=[[null,e,""]]);var o={};if(n)for(var i=0;i<this.length;i++){var a=this[i][0];null!=a&&(o[a]=!0)}for(var s=0;s<e.length;s++){var l=[].concat(e[s]);n&&o[l[0]]||(r&&(l[2]?l[2]="".concat(r," and ").concat(l[2]):l[2]=r),t.push(l))}},t}},340:(e,t,r)=>{var n=r(969);n.__esModule&&(n=n.default),"string"==typeof n&&(n=[[e.id,n,""]]),n.locals&&(e.exports=n.locals),(0,r(159).Z)("521d2420",n,!1,{})},366:(e,t,r)=>{var n=r(876);n.__esModule&&(n=n.default),"string"==typeof n&&(n=[[e.id,n,""]]),n.locals&&(e.exports=n.locals),(0,r(159).Z)("637499f8",n,!1,{})},548:(e,t,r)=>{var n=r(799);n.__esModule&&(n=n.default),"string"==typeof n&&(n=[[e.id,n,""]]),n.locals&&(e.exports=n.locals),(0,r(159).Z)("31c90b0d",n,!1,{})},159:(e,t,r)=>{"use strict";function n(e,t){for(var r=[],n={},o=0;o<t.length;o++){var i=t[o],a=i[0],s={id:e+":"+o,css:i[1],media:i[2],sourceMap:i[3]};n[a]?n[a].parts.push(s):r.push(n[a]={id:a,parts:[s]})}return r}r.d(t,{Z:()=>m});var o="undefined"!=typeof document;if("undefined"!=typeof DEBUG&&DEBUG&&!o)throw new Error("vue-style-loader cannot be used in a non-browser environment. Use { target: 'node' } in your Webpack config to indicate a server-rendering environment.");var i={},a=o&&(document.head||document.getElementsByTagName("head")[0]),s=null,l=0,u=!1,c=function(){},d=null,p="data-vue-ssr-id",f="undefined"!=typeof navigator&&/msie [6-9]\b/.test(navigator.userAgent.toLowerCase());function m(e,t,r,o){u=r,d=o||{};var a=n(e,t);return v(a),function(t){for(var r=[],o=0;o<a.length;o++){var s=a[o];(l=i[s.id]).refs--,r.push(l)}for(t?v(a=n(e,t)):a=[],o=0;o<r.length;o++){var l;if(0===(l=r[o]).refs){for(var u=0;u<l.parts.length;u++)l.parts[u]();delete i[l.id]}}}}function v(e){for(var t=0;t<e.length;t++){var r=e[t],n=i[r.id];if(n){n.refs++;for(var o=0;o<n.parts.length;o++)n.parts[o](r.parts[o]);for(;o<r.parts.length;o++)n.parts.push(h(r.parts[o]));n.parts.length>r.parts.length&&(n.parts.length=r.parts.length)}else{var a=[];for(o=0;o<r.parts.length;o++)a.push(h(r.parts[o]));i[r.id]={id:r.id,refs:1,parts:a}}}}function g(){var e=document.createElement("style");return e.type="text/css",a.appendChild(e),e}function h(e){var t,r,n=document.querySelector("style["+p+'~="'+e.id+'"]');if(n){if(u)return c;n.parentNode.removeChild(n)}if(f){var o=l++;n=s||(s=g()),t=_.bind(null,n,o,!1),r=_.bind(null,n,o,!0)}else n=g(),t=w.bind(null,n),r=function(){n.parentNode.removeChild(n)};return t(e),function(n){if(n){if(n.css===e.css&&n.media===e.media&&n.sourceMap===e.sourceMap)return;t(e=n)}else r()}}var y,b=(y=[],function(e,t){return y[e]=t,y.filter(Boolean).join("\n")});function _(e,t,r,n){var o=r?"":n.css;if(e.styleSheet)e.styleSheet.cssText=b(t,o);else{var i=document.createTextNode(o),a=e.childNodes;a[t]&&e.removeChild(a[t]),a.length?e.insertBefore(i,a[t]):e.appendChild(i)}}function w(e,t){var r=t.css,n=t.media,o=t.sourceMap;if(n&&e.setAttribute("media",n),d.ssrId&&e.setAttribute(p,t.id),o&&(r+="\n/*# sourceURL="+o.sources[0]+" */",r+="\n/*# sourceMappingURL=data:application/json;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(o))))+" */"),e.styleSheet)e.styleSheet.cssText=r;else{for(;e.firstChild;)e.removeChild(e.firstChild);e.appendChild(document.createTextNode(r))}}}},t={};function r(n){var o=t[n];if(void 0!==o)return o.exports;var i=t[n]={id:n,exports:{}};return e[n](i,i.exports,r),i.exports}r.n=e=>{var t=e&&e.__esModule?()=>e.default:()=>e;return r.d(t,{a:t}),t},r.d=(e,t)=>{for(var n in t)r.o(t,n)&&!r.o(e,n)&&Object.defineProperty(e,n,{enumerable:!0,get:t[n]})},r.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t),r.r=e=>{"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},(()=>{"use strict";var e=function(){var e=this,t=e._self._c;return t("FormBuilderPage",[t("AlertsList"),e._v(" "),t("PostBoxGrid",{scopedSlots:e._u([{key:"after-form-fields",fn:function(){return[t("TablePagination",{attrs:{scope:"form-fields"}})]},proxy:!0}])})],1)};e._withStripped=!0;var t=JetFBComponents,n=t.PostBoxGrid,o=t.TablePagination,i=t.FormBuilderPage,a=t.AlertsList,s=JetFBMixins.PromiseWrapper,l=wp.apiFetch;const u={name:"jfb-records-single",components:{AlertsList:a,PostBoxGrid:n,TablePagination:o,FormBuilderPage:i},mixins:[s],created:function(){var e=this;jfbEventBus.$on("alert-click-update",(function(t){var r=t.button;e.installMigrations(r)}))},methods:{installMigrations:function(e){var t=e.rest;l(t).then((function(e){jfbEventBus.$CXNotice.add({message:e.message,type:"success",duration:4e3}),window.location.reload()})).catch((function(e){jfbEventBus.$CXNotice.add({message:e.message,type:"error",duration:4e3})}))}}};function c(e,t,r,n,o,i,a,s){var l,u="function"==typeof e?e.options:e;if(t&&(u.render=t,u.staticRenderFns=r,u._compiled=!0),n&&(u.functional=!0),i&&(u._scopeId="data-v-"+i),a?(l=function(e){(e=e||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(e=__VUE_SSR_CONTEXT__),o&&o.call(this,e),e&&e._registeredComponents&&e._registeredComponents.add(a)},u._ssrRegister=l):o&&(l=s?function(){o.call(this,(u.functional?this.parent:this).$root.$options.shadowRoot)}:o),l)if(u.functional){u._injectStyles=l;var c=u.render;u.render=function(e,t){return l.call(t),c(e,t)}}else{var d=u.beforeCreate;u.beforeCreate=d?[].concat(d,l):[l]}return{exports:e,options:u}}r(340);const d=c(u,e,[],!1,null,null,null).exports;var p=function(){var e=this,t=e._self._c;return t("span",{staticClass:"field-type-template"},[t("span",{staticClass:"field-type-template--icon",attrs:{title:e.value.title},domProps:{innerHTML:e._s(e.value.icon)}})])};p._withStripped=!0;r(366);const f={item:c({name:"field_type--item",props:["value","full-entry","entry-id"]},p,[],!1,null,null,null).exports};var m=function(){var e=this,t=e._self._c;return t("div",{staticClass:"field-name-template"},[e.value.label?t("span",{staticClass:"field-name-template--label"},[t("b",[e._v(e._s(e.value.label))])]):e._e(),e._v(" "),t("span",{staticClass:"field-name-template--name"},[t("code",[e._v(e._s(e.value.name))])])])};m._withStripped=!0;r(548);const v={item:c({name:"name--item",props:["value","full-entry","entry-id"]},m,[],!1,null,null,null).exports};function g(e){return g="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},g(e)}function h(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,n)}return r}function y(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?h(Object(r),!0).forEach((function(t){b(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):h(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}function b(e,t,r){return(t=function(e){var t=function(e,t){if("object"!==g(e)||null===e)return e;var r=e[Symbol.toPrimitive];if(void 0!==r){var n=r.call(e,"string");if("object"!==g(n))return n;throw new TypeError("@@toPrimitive must return a primitive value.")}return String(e)}(e);return"symbol"===g(t)?t:String(t)}(t))in e?Object.defineProperty(e,t,{value:r,enumerable:!0,configurable:!0,writable:!0}):e[t]=r,e}(0,wp.hooks.addFilter)("jet.fb.admin.table.form-fields","jet-form-builder",(function(e){return e.push(f,v),e}));var _=JetFBStore,w=_.BaseStore,x=_.SingleMetaBoxesPlugin,S=_.NoticesPlugin;(0,window.JetFBActions.renderCurrentPage)(d,{store:new Vuex.Store(y(y({},w),{},{plugins:[x,S]}))})})()})();