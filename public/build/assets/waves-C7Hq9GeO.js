import{g as D,c as E}from"./_commonjsHelpers-Cpj98o6Y.js";function P(m,w){for(var l=0;l<w.length;l++){const d=w[l];if(typeof d!="string"&&!Array.isArray(d)){for(const v in d)if(v!=="default"&&!(v in m)){const g=Object.getOwnPropertyDescriptor(d,v);g&&Object.defineProperty(m,v,g.get?g:{enumerable:!0,get:()=>d[v]})}}}return Object.freeze(Object.defineProperty(m,Symbol.toStringTag,{value:"Module"}))}var N={exports:{}};/*!
 * Waves v0.7.6
 * http://fian.my.id/Waves
 *
 * Copyright 2014-2018 Alfiana E. Sibuea and other contributors
 * Released under the MIT license
 * https://github.com/fians/Waves/blob/master/LICENSE
 */(function(m,w){(function(l,d){m.exports=d.call(l)})(typeof E=="object"?E:E,function(){var l=l||{},d=document.querySelectorAll.bind(document),v=Object.prototype.toString,g="ontouchstart"in window;function O(t){return t!==null&&t===t.window}function S(t){return O(t)?t:t.nodeType===9&&t.defaultView}function L(t){var e=typeof t;return e==="function"||e==="object"&&!!t}function W(t){return L(t)&&t.nodeType>0}function y(t){var e=v.call(t);return e==="[object String]"?d(t):L(t)&&/^\[object (Array|HTMLCollection|NodeList|Object)\]$/.test(e)&&t.hasOwnProperty("length")?t:W(t)?[t]:[]}function x(t){var e,a,r={top:0,left:0},n=t&&t.ownerDocument;return e=n.documentElement,typeof t.getBoundingClientRect<"u"&&(r=t.getBoundingClientRect()),a=S(n),{top:r.top+a.pageYOffset-e.clientTop,left:r.left+a.pageXOffset-e.clientLeft}}function b(t){var e="";for(var a in t)t.hasOwnProperty(a)&&(e+=a+":"+t[a]+";");return e}var o={duration:750,delay:200,show:function(t,e,a){if(t.button===2)return!1;e=e||this;var r=document.createElement("div");r.className="waves-ripple waves-rippling",e.appendChild(r);var n=x(e),i=0,s=0;"touches"in t&&t.touches.length?(i=t.touches[0].pageY-n.top,s=t.touches[0].pageX-n.left):(i=t.pageY-n.top,s=t.pageX-n.left),s=s>=0?s:0,i=i>=0?i:0;var c="scale("+e.clientWidth/100*3+")",f="translate(0,0)";a&&(f="translate("+a.x+"px, "+a.y+"px)"),r.setAttribute("data-hold",Date.now()),r.setAttribute("data-x",s),r.setAttribute("data-y",i),r.setAttribute("data-scale",c),r.setAttribute("data-translate",f);var u={top:i+"px",left:s+"px"};r.classList.add("waves-notransition"),r.setAttribute("style",b(u)),r.classList.remove("waves-notransition"),u["-webkit-transform"]=c+" "+f,u["-moz-transform"]=c+" "+f,u["-ms-transform"]=c+" "+f,u["-o-transform"]=c+" "+f,u.transform=c+" "+f,u.opacity="1";var h=t.type==="mousemove"?2500:o.duration;u["-webkit-transition-duration"]=h+"ms",u["-moz-transition-duration"]=h+"ms",u["-o-transition-duration"]=h+"ms",u["transition-duration"]=h+"ms",r.setAttribute("style",b(u))},hide:function(t,e){e=e||this;for(var a=e.getElementsByClassName("waves-rippling"),r=0,n=a.length;r<n;r++)k(t,e,a[r]);g&&(e.removeEventListener("touchend",o.hide),e.removeEventListener("touchcancel",o.hide)),e.removeEventListener("mouseup",o.hide),e.removeEventListener("mouseleave",o.hide)}},j={input:function(t){var e=t.parentNode;if(!(e.tagName.toLowerCase()==="i"&&e.classList.contains("waves-effect"))){var a=document.createElement("i");a.className=t.className+" waves-input-wrapper",t.className="waves-button-input",e.replaceChild(a,t),a.appendChild(t);var r=window.getComputedStyle(t,null),n=r.color,i=r.backgroundColor;a.setAttribute("style","color:"+n+";background:"+i),t.setAttribute("style","background-color:rgba(0,0,0,0);")}},img:function(t){var e=t.parentNode;if(!(e.tagName.toLowerCase()==="i"&&e.classList.contains("waves-effect"))){var a=document.createElement("i");e.replaceChild(a,t),a.appendChild(t)}}};function k(t,e,a){if(a){a.classList.remove("waves-rippling");var r=a.getAttribute("data-x"),n=a.getAttribute("data-y"),i=a.getAttribute("data-scale"),s=a.getAttribute("data-translate"),c=Date.now()-Number(a.getAttribute("data-hold")),f=350-c;f<0&&(f=0),t.type==="mousemove"&&(f=150);var u=t.type==="mousemove"?2500:o.duration;setTimeout(function(){var h={top:n+"px",left:r+"px",opacity:"0","-webkit-transition-duration":u+"ms","-moz-transition-duration":u+"ms","-o-transition-duration":u+"ms","transition-duration":u+"ms","-webkit-transform":i+" "+s,"-moz-transform":i+" "+s,"-ms-transform":i+" "+s,"-o-transform":i+" "+s,transform:i+" "+s};a.setAttribute("style",b(h)),setTimeout(function(){try{e.removeChild(a)}catch{return!1}},u)},f)}}var p={touches:0,allowEvent:function(t){var e=!0;return/^(mousedown|mousemove)$/.test(t.type)&&p.touches&&(e=!1),e},registerEvent:function(t){var e=t.type;e==="touchstart"?p.touches+=1:/^(touchend|touchcancel)$/.test(e)&&setTimeout(function(){p.touches&&(p.touches-=1)},500)}};function $(t){if(p.allowEvent(t)===!1)return null;for(var e=null,a=t.target||t.srcElement;a.parentElement;){if(!(a instanceof SVGElement)&&a.classList.contains("waves-effect")){e=a;break}a=a.parentElement}return e}function A(t){var e=$(t);if(e!==null){if(e.disabled||e.getAttribute("disabled")||e.classList.contains("disabled"))return;if(p.registerEvent(t),t.type==="touchstart"&&o.delay){var a=!1,r=setTimeout(function(){r=null,o.show(t,e)},o.delay),n=function(c){r&&(clearTimeout(r),r=null,o.show(t,e)),a||(a=!0,o.hide(c,e)),s()},i=function(c){r&&(clearTimeout(r),r=null),n(c),s()};e.addEventListener("touchmove",i,!1),e.addEventListener("touchend",n,!1),e.addEventListener("touchcancel",n,!1);var s=function(){e.removeEventListener("touchmove",i),e.removeEventListener("touchend",n),e.removeEventListener("touchcancel",n)}}else o.show(t,e),g&&(e.addEventListener("touchend",o.hide,!1),e.addEventListener("touchcancel",o.hide,!1)),e.addEventListener("mouseup",o.hide,!1),e.addEventListener("mouseleave",o.hide,!1)}}return l.init=function(t){var e=document.body;t=t||{},"duration"in t&&(o.duration=t.duration),"delay"in t&&(o.delay=t.delay),g&&(e.addEventListener("touchstart",A,!1),e.addEventListener("touchcancel",p.registerEvent,!1),e.addEventListener("touchend",p.registerEvent,!1)),e.addEventListener("mousedown",A,!1)},l.attach=function(t,e){t=y(t),v.call(e)==="[object Array]"&&(e=e.join(" ")),e=e?" "+e:"";for(var a,r,n=0,i=t.length;n<i;n++)a=t[n],r=a.tagName.toLowerCase(),["input","img"].indexOf(r)!==-1&&(j[r](a),a=a.parentElement),a.className.indexOf("waves-effect")===-1&&(a.className+=" waves-effect"+e)},l.ripple=function(t,e){t=y(t);var a=t.length;if(e=e||{},e.wait=e.wait||0,e.position=e.position||null,a){for(var r,n,i,s={},c=0,f={type:"mousedown",button:1},u=function(C,z){return function(){o.hide(C,z)}};c<a;c++)if(r=t[c],n=e.position||{x:r.clientWidth/2,y:r.clientHeight/2},i=x(r),s.x=i.left+n.x,s.y=i.top+n.y,f.pageX=s.x,f.pageY=s.y,o.show(f,r),e.wait>=0&&e.wait!==null){var h={type:"mouseup",button:1};setTimeout(u(h,r),e.wait)}}},l.calm=function(t){t=y(t);for(var e={type:"mouseup",button:1},a=0,r=t.length;a<r;a++)o.hide(e,t[a])},l.displayEffect=function(t){console.error("Waves.displayEffect() has been deprecated and will be removed in future version. Please use Waves.init() to initialize Waves effect"),l.init(t)},l})})(N);var T=N.exports;const X=D(T),_=P({__proto__:null,default:X},[T]);export{_ as w};
