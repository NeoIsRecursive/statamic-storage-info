function p(s,t,e,i,o,l,c,_){var r=typeof s=="function"?s.options:s;t&&(r.render=t,r.staticRenderFns=e,r._compiled=!0),i&&(r.functional=!0),l&&(r._scopeId="data-v-"+l);var a;if(c?(a=function(n){n=n||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext,!n&&typeof __VUE_SSR_CONTEXT__<"u"&&(n=__VUE_SSR_CONTEXT__),o&&o.call(this,n),n&&n._registeredComponents&&n._registeredComponents.add(c)},r._ssrRegister=a):o&&(a=_?function(){o.call(this,(r.functional?this.parent:this).$root.$options.shadowRoot)}:o),a)if(r.functional){r._injectStyles=a;var u=r.render;r.render=function(m,d){return a.call(d),u(m,d)}}else{var f=r.beforeCreate;r.beforeCreate=f?[].concat(f,a):[a]}return{exports:s,options:r}}const v={props:{assetsRoute:String,containers:String,storageInfoRoute:String},data(){return{containers:[],loading:!1,error:!1}},mounted:()=>{getContainers()},methods:{async getContainers(s,t){const e=new URLSearchParams;for(const i of t.split(","))e.append("containers",i);try{const o=await(await fetch(`${s}?${e.toString()}`)).json();this.loading=!1,this.containers=o}catch(i){this.error=!0,console.error(i)}}}};var h=function(){var t=this,e=t._self._c;return e("div",{staticClass:"card p-0"},[e("div",{staticClass:"flex justify-between items-center p-4 pb-0"},[e("h2",[e("a",{staticClass:"flex items-center",attrs:{href:t.assetsRoute}},[e("div",{staticClass:"h-6 w-6 mr-2 text-gray-800"},[e("svg",{attrs:{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"}},[e("path",{attrs:{fill:"none",stroke:"currentColor","stroke-linecap":"round","stroke-linejoin":"round",d:"m15.543 15.543-2.628-6.571c-.2-.511-.558-.519-.785-.018l-2.087 4.589-1.859-2.231a.667.667 0 0 0-1.155.089l-2.486 4.142"}}),e("rect",{attrs:{width:"17",height:"17",x:"1.543",y:"1.543",fill:"none",stroke:"currentColor","stroke-linecap":"round","stroke-linejoin":"round",rx:"1",ry:"1"}}),e("path",{attrs:{fill:"none",stroke:"currentColor","stroke-linecap":"round","stroke-linejoin":"round",d:"m20.551 7.424 1 .091a1 1 0 0 1 .901 1.085l-1.181 12.948a1 1 0 0 1-1.087.9L6.243 21.18m-4.7-5.637h17"}}),e("circle",{attrs:{cx:"6.043",cy:"6.043",r:"1.5",fill:"none",stroke:"currentColor","stroke-linecap":"round","stroke-linejoin":"round"}})])]),e("span",[t._v("Storage")])])])]),e("div",{staticClass:"card-body p-4 flex flex-col content",attrs:{"v-for":t.containers}},[t._m(0),e("div",{staticClass:"flex justify-between items-center mt-2"},[e("a",{staticClass:"mb-0",attrs:{href:t.container.url}},[e("h4")]),t._m(1)])])])},C=[function(){var s=this,t=s._self._c;return t("div",{staticClass:"flex justify-between items-center mt-2"},[t("p",{staticClass:"mb-0"},[s._v("name")]),t("div",{staticClass:"flex"},[t("p",{staticClass:"mb-0"},[s._v("files")]),t("p",{staticClass:"mb-0 ml-2"},[s._v("size")])])])},function(){var s=this,t=s._self._c;return t("div",{staticClass:"flex"},[t("p",{staticClass:"mb-0"},[s._v("files")]),t("p",{staticClass:"mb-0 ml-2"},[s._v("space used")])])}],g=p(v,h,C,!1,null,null,null,null);const w=g.exports;Statamic.booting(()=>{Statamic.$components.register("storage-info-widget",w)});
