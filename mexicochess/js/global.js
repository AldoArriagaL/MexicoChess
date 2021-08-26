var aa_popup;
var aa_headertitleanarea = 650;
var aa_lazybgs;

jQuery(document).ready(function(){	
	jQuery("body").append("<div id='aa-pop-up' class='aa-pop-cont'><div class='aa-pop-box'><a class='aa-closepop aajs-closepop' href='javascript:;'></a><div class='aa-pop-charge'></div></div></div>");
	
	aa_popup = jQuery("#aa-pop-up");
	
	aaCheckVPAnimations();
	
	var aacopyshareurl = new Clipboard(".aajs-share-clip");
	
	aacopyshareurl.on("success", function(e){
		jQuery(e.trigger).addClass("ttactive");
		setTimeout(function(){
			jQuery(e.trigger).removeClass("ttactive");
		}, 2000);
	});
	
	/*Drop Share*/
	if(jQuery(".aajs-sharedrop").length > 0){
		jQuery(".aajs-sharedrop").each(function(){
			var aashareurl = jQuery(this).attr("href");
			
			jQuery(this).closest(".share").append("<ul class='aa-dropshare aa-clearfix'><li><a href='" + aashareurl + "' class='aajs-share-fb'><i class='fa fa-facebook'></i><span>Compartir en Facebook</span></a></li><li><a href='" + aashareurl + "' class='aajs-share-tw'><i class='fa fa-twitter'></i><span>Compartir en Twitter</span></a></li><li><a class='aajs-share-clip aa-stooltip' href='javascript:;' data-clipboard-text='" + aashareurl + "'><i class='fa fa-link'></i> <span>Copiar Enlace</span></a></li></ul>");
		});
	}
	
	aa_lazybgs = jQuery('.aalazybg').Lazy({
		effect: 'fadeIn',
		effectTime: 500,
		threshold: 0,
		visibleOnly: true,
		chainable: false
	});
});

jQuery(document).on("load, scroll", function(){
	if(jQuery(window).scrollTop() > 0)
		jQuery("html").addClass("aa-pagescrolled");
	else
		jQuery("html").removeClass("aa-pagescrolled");
	
	if(jQuery(window).scrollTop() > 120)
		jQuery("html").addClass("aa-headerprepared");
	else
		jQuery("html").removeClass("aa-headerprepared");
		
	if(jQuery(window).scrollTop() > 170)
		jQuery("html").addClass("aa-headerprepshow");
	else
		jQuery("html").removeClass("aa-headerprepshow");
	
	if(jQuery(window).scrollTop() > 320)
		jQuery("html").addClass("aa-headerfixed");
	else
		jQuery("html").removeClass("aa-headerfixed");
		
	if(jQuery(window).scrollTop() > 1000)
		jQuery("html").addClass("aa-pageshowgoup");
	else
		jQuery("html").removeClass("aa-pageshowgoup");
		
	if((jQuery(window).scrollTop() < aa_headertitleanarea)){
		var aatitleheaderscale = (jQuery(window).scrollTop() / aa_headertitleanarea / 5) + 1;
		var aatitleheaderopacity = 1 - (jQuery(window).scrollTop() / aa_headertitleanarea);
		jQuery(".aa-pagetitle-bg").css("transform", "scale(" + aatitleheaderscale + ")");
		jQuery(".aa-pagetitle-bg, .aa-pagetitle-inner").css("opacity", aatitleheaderopacity);
	}
	
	aaCheckVPAnimations();
});

jQuery(document).on("click", ".aajs-triggerovermenu", function(){
	if(jQuery("body").hasClass("ovmenuopen"))
		jQuery("body").removeClass("ovmenuopen")
	else
		jQuery("body").addClass("ovmenuopen");
});
jQuery(document).on('click', '.aajs-scrollto', function(e){
	if(jQuery(jQuery(this).attr('href')).length > 0){
		e.preventDefault();
		
		var aascrolltopval = jQuery(jQuery(this).attr('href')).offset().top;
		
		if(jQuery(window).outerWidth() > 767)
			aascrolltopval = (aascrolltopval < 320) ? aascrolltopval - 140 : aascrolltopval;
		else
			aascrolltopval = aascrolltopval - 55;
		
		jQuery("html, body").animate({
			"scrollTop" : aascrolltopval
		});
	}
});
jQuery(document).on("click", ".aajs-sharedrop", function(e){
	e.preventDefault();
	
	if(jQuery(this).closest(".share").hasClass("active"))
		jQuery(this).closest(".share").removeClass("active");
	else
		jQuery(this).closest(".share").addClass("active")
})
jQuery(document).on("click", ".aa-dropshare", function(){
	var aadropsharetarget = jQuery(this);
	
	if(jQuery(".aajs-share-clip:hover").length > 0){
		setTimeout(function(){aadropsharetarget.closest(".share").removeClass("active");}, 2000);
	}
	else
		aadropsharetarget.closest(".share").removeClass("active");
});
jQuery(document).on("click", ".aajs-addclasstotarget", function(){
	var aathetarget = jQuery(this).data("target");
	var aatheclass = jQuery(this).data("theclass");
	
	jQuery(aathetarget).addClass(aatheclass);
});
jQuery(document).on("click", ".aajs-removeclasstotarget", function(){
	var aathetarget = jQuery(this).data("target");
	var aatheclass = jQuery(this).data("theclass");
	
	jQuery(aathetarget).removeClass(aatheclass);
});
/*jQuery(document).on("click", ".aajs-is-hometor > a", function(e){
	e.preventDefault();
	fbq('track', 'Home: Todos Los Torneos', {currency: "USD", value: 1.00});
});*/


function aaCheckVPAnimations(){
	jQuery(".aa-bgloadfade:not(.animate), .aaan-slideup:not(.animate), .aaan-addanclass:not(.animate)").each(function(){
		if(jQuery(this).isInViewport()){
			jQuery(this).addClass("animate");
		}
	});
}


/*POPUPS ACTIONS*/
jQuery(document).on("click", ".aa-pop-cont", function(){
	aaHidePopup(jQuery(this));
});
jQuery(document).on("click", ".aajs-closepop", function(){
	aaHidePopup(jQuery(this).closest(".aa-pop-cont"), true);
});
/***************/


/*POPUPS FUNCTIONS*/
function aaLoadPopup(aapoptarget, aapopload, aapopcallback){
	aapoptarget.find(".aa-pop-charge").load(aapopload, function(){
		if(aapopcallback && typeof(aapopcallback) === "function")  
        	aapopcallback();
	});
}
function aaClearPopup(aapoptarget, aapopcontent){
	aapopcontent = (aapopcontent != undefined) ? aapopcontent : "";
	aapoptarget.find(".aa-pop-charge").html(aapopcontent);
}
function aaExpandPopup(aapoptarget, aapopexpand){
	aapoptarget.find(".aa-pop-box").css("max-width", aapopexpand);
}
function aaFadePopup(aapoptarget){
	//aa_poploader.removeClass("visible");

	jQuery("html").addClass("aa-pop-open");
	aapoptarget.addClass("visible");
}
function aaHidePopup(aapoptarget, aapopforceclose){
	aapopforceclose = (aapopforceclose != undefined) ? aapopforceclose : false;

	if((aapopforceclose) || ((aapoptarget != undefined) && (aapoptarget.find(".aa-pop-box").length > 0) && (aapoptarget.find(".aa-pop-box:hover").length < 1))){
		if(aapoptarget.hasClass("clearonclose"))
			aaClearPopup(aapoptarget);
	
		aapoptarget.attr("class", "aa-pop-cont");
		jQuery("html").removeClass("aa-pop-open");
		
		setTimeout(function(){
			aapoptarget.find(".aa-pop-box").css("max-width", "");
		}, 300);
	}
}
/***************/


/**/
function aaDisplayMsg(aamsg, aamsgtitle, aamsgbutton, aamsgpopexpand){
	if(aamsgtitle == undefined)
		aamsgtitle = "Message";
	if(aamsgbutton == undefined)
		aamsgbutton = "OK";
	if(aamsgpopexpand == undefined)
		aamsgpopexpand = 400;
	
	if(aamsgbutton != "hidden")
		var aamsgbutton = "<button class='aajs-closepop aa-btn aa-btn-100 aa-btn-pop'>" + aamsgbutton + "</button>";
	else
		var aamsgbutton = "";
		
	aaExpandPopup(aa_popup, aamsgpopexpand);
	aaClearPopup(aa_popup, "<div class='aa-popheader'><h3>" + aamsgtitle + "</h3></div><div class='aa-popbody aa-clearfix'>" + aamsg + aamsgbutton + "</div>");
	aaFadePopup(aa_popup);
}
/******/


/*Shares*/
jQuery(document).on("click", ".aajs-share-tw", function(e){
	e.preventDefault();
	var aatweettext = encodeURIComponent(jQuery(this).attr("href"));
	window.open('https://twitter.com/intent/tweet?text=' + aatweettext ,'Tweet','toolbar=0, status=0, width=650, height=450');
});
jQuery(document).on("click", ".aajs-share-fb", function(e){
	e.preventDefault();
	var	aashareurl = encodeURIComponent(jQuery(this).attr("href"));
	window.open('https://www.facebook.com/sharer.php?u=' + aashareurl,'Like','toolbar=0, status=0, width=650, height=450');
});

/*Is In Viewport*/
jQuery.fn.isInViewport = function(){
  var elementTop = jQuery(this).offset().top;
  var elementBottom = elementTop + jQuery(this).outerHeight();

  var viewportTop = jQuery(window).scrollTop();
  var viewportBottom = viewportTop + jQuery(window).height();

  return elementBottom > viewportTop && elementTop < viewportBottom;
};



/*!
 * clipboard.js v1.5.12
 * https://zenorocha.github.io/clipboard.js
 *
 * Licensed MIT ï¿½ Zeno Rocha
 */
!function(t){if("object"==typeof exports&&"undefined"!=typeof module)module.exports=t();else if("function"==typeof define&&define.amd)define([],t);else{var e;e="undefined"!=typeof window?window:"undefined"!=typeof global?global:"undefined"!=typeof self?self:this,e.Clipboard=t()}}(function(){var t,e,n;return function t(e,n,o){function i(a,c){if(!n[a]){if(!e[a]){var s="function"==typeof require&&require;if(!c&&s)return s(a,!0);if(r)return r(a,!0);var l=new Error("Cannot find module '"+a+"'");throw l.code="MODULE_NOT_FOUND",l}var u=n[a]={exports:{}};e[a][0].call(u.exports,function(t){var n=e[a][1][t];return i(n?n:t)},u,u.exports,t,e,n,o)}return n[a].exports}for(var r="function"==typeof require&&require,a=0;a<o.length;a++)i(o[a]);return i}({1:[function(t,e,n){var o=t("matches-selector");e.exports=function(t,e,n){for(var i=n?t:t.parentNode;i&&i!==document;){if(o(i,e))return i;i=i.parentNode}}},{"matches-selector":5}],2:[function(t,e,n){function o(t,e,n,o,r){var a=i.apply(this,arguments);return t.addEventListener(n,a,r),{destroy:function(){t.removeEventListener(n,a,r)}}}function i(t,e,n,o){return function(n){n.delegateTarget=r(n.target,e,!0),n.delegateTarget&&o.call(t,n)}}var r=t("closest");e.exports=o},{closest:1}],3:[function(t,e,n){n.node=function(t){return void 0!==t&&t instanceof HTMLElement&&1===t.nodeType},n.nodeList=function(t){var e=Object.prototype.toString.call(t);return void 0!==t&&("[object NodeList]"===e||"[object HTMLCollection]"===e)&&"length"in t&&(0===t.length||n.node(t[0]))},n.string=function(t){return"string"==typeof t||t instanceof String},n.fn=function(t){var e=Object.prototype.toString.call(t);return"[object Function]"===e}},{}],4:[function(t,e,n){function o(t,e,n){if(!t&&!e&&!n)throw new Error("Missing required arguments");if(!c.string(e))throw new TypeError("Second argument must be a String");if(!c.fn(n))throw new TypeError("Third argument must be a Function");if(c.node(t))return i(t,e,n);if(c.nodeList(t))return r(t,e,n);if(c.string(t))return a(t,e,n);throw new TypeError("First argument must be a String, HTMLElement, HTMLCollection, or NodeList")}function i(t,e,n){return t.addEventListener(e,n),{destroy:function(){t.removeEventListener(e,n)}}}function r(t,e,n){return Array.prototype.forEach.call(t,function(t){t.addEventListener(e,n)}),{destroy:function(){Array.prototype.forEach.call(t,function(t){t.removeEventListener(e,n)})}}}function a(t,e,n){return s(document.body,t,e,n)}var c=t("./is"),s=t("delegate");e.exports=o},{"./is":3,delegate:2}],5:[function(t,e,n){function o(t,e){if(r)return r.call(t,e);for(var n=t.parentNode.querySelectorAll(e),o=0;o<n.length;++o)if(n[o]==t)return!0;return!1}var i=Element.prototype,r=i.matchesSelector||i.webkitMatchesSelector||i.mozMatchesSelector||i.msMatchesSelector||i.oMatchesSelector;e.exports=o},{}],6:[function(t,e,n){function o(t){var e;if("INPUT"===t.nodeName||"TEXTAREA"===t.nodeName)t.focus(),t.setSelectionRange(0,t.value.length),e=t.value;else{t.hasAttribute("contenteditable")&&t.focus();var n=window.getSelection(),o=document.createRange();o.selectNodeContents(t),n.removeAllRanges(),n.addRange(o),e=n.toString()}return e}e.exports=o},{}],7:[function(t,e,n){function o(){}o.prototype={on:function(t,e,n){var o=this.e||(this.e={});return(o[t]||(o[t]=[])).push({fn:e,ctx:n}),this},once:function(t,e,n){function o(){i.off(t,o),e.apply(n,arguments)}var i=this;return o._=e,this.on(t,o,n)},emit:function(t){var e=[].slice.call(arguments,1),n=((this.e||(this.e={}))[t]||[]).slice(),o=0,i=n.length;for(o;i>o;o++)n[o].fn.apply(n[o].ctx,e);return this},off:function(t,e){var n=this.e||(this.e={}),o=n[t],i=[];if(o&&e)for(var r=0,a=o.length;a>r;r++)o[r].fn!==e&&o[r].fn._!==e&&i.push(o[r]);return i.length?n[t]=i:delete n[t],this}},e.exports=o},{}],8:[function(e,n,o){!function(i,r){if("function"==typeof t&&t.amd)t(["module","select"],r);else if("undefined"!=typeof o)r(n,e("select"));else{var a={exports:{}};r(a,i.select),i.clipboardAction=a.exports}}(this,function(t,e){"use strict";function n(t){return t&&t.__esModule?t:{"default":t}}function o(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}var i=n(e),r="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol?"symbol":typeof t},a=function(){function t(t,e){for(var n=0;n<e.length;n++){var o=e[n];o.enumerable=o.enumerable||!1,o.configurable=!0,"value"in o&&(o.writable=!0),Object.defineProperty(t,o.key,o)}}return function(e,n,o){return n&&t(e.prototype,n),o&&t(e,o),e}}(),c=function(){function t(e){o(this,t),this.resolveOptions(e),this.initSelection()}return t.prototype.resolveOptions=function t(){var e=arguments.length<=0||void 0===arguments[0]?{}:arguments[0];this.action=e.action,this.emitter=e.emitter,this.target=e.target,this.text=e.text,this.trigger=e.trigger,this.selectedText=""},t.prototype.initSelection=function t(){this.text?this.selectFake():this.target&&this.selectTarget()},t.prototype.selectFake=function t(){var e=this,n="rtl"==document.documentElement.getAttribute("dir");this.removeFake(),this.fakeHandlerCallback=function(){return e.removeFake()},this.fakeHandler=document.body.addEventListener("click",this.fakeHandlerCallback)||!0,this.fakeElem=document.createElement("textarea"),this.fakeElem.style.fontSize="12pt",this.fakeElem.style.border="0",this.fakeElem.style.padding="0",this.fakeElem.style.margin="0",this.fakeElem.style.position="absolute",this.fakeElem.style[n?"right":"left"]="-9999px",this.fakeElem.style.top=(window.pageYOffset||document.documentElement.scrollTop)+"px",this.fakeElem.setAttribute("readonly",""),this.fakeElem.value=this.text,document.body.appendChild(this.fakeElem),this.selectedText=(0,i.default)(this.fakeElem),this.copyText()},t.prototype.removeFake=function t(){this.fakeHandler&&(document.body.removeEventListener("click",this.fakeHandlerCallback),this.fakeHandler=null,this.fakeHandlerCallback=null),this.fakeElem&&(document.body.removeChild(this.fakeElem),this.fakeElem=null)},t.prototype.selectTarget=function t(){this.selectedText=(0,i.default)(this.target),this.copyText()},t.prototype.copyText=function t(){var e=void 0;try{e=document.execCommand(this.action)}catch(n){e=!1}this.handleResult(e)},t.prototype.handleResult=function t(e){e?this.emitter.emit("success",{action:this.action,text:this.selectedText,trigger:this.trigger,clearSelection:this.clearSelection.bind(this)}):this.emitter.emit("error",{action:this.action,trigger:this.trigger,clearSelection:this.clearSelection.bind(this)})},t.prototype.clearSelection=function t(){this.target&&this.target.blur(),window.getSelection().removeAllRanges()},t.prototype.destroy=function t(){this.removeFake()},a(t,[{key:"action",set:function t(){var e=arguments.length<=0||void 0===arguments[0]?"copy":arguments[0];if(this._action=e,"copy"!==this._action&&"cut"!==this._action)throw new Error('Invalid "action" value, use either "copy" or "cut"')},get:function t(){return this._action}},{key:"target",set:function t(e){if(void 0!==e){if(!e||"object"!==("undefined"==typeof e?"undefined":r(e))||1!==e.nodeType)throw new Error('Invalid "target" value, use a valid Element');if("copy"===this.action&&e.hasAttribute("disabled"))throw new Error('Invalid "target" attribute. Please use "readonly" instead of "disabled" attribute');if("cut"===this.action&&(e.hasAttribute("readonly")||e.hasAttribute("disabled")))throw new Error('Invalid "target" attribute. You can\'t cut text from elements with "readonly" or "disabled" attributes');this._target=e}},get:function t(){return this._target}}]),t}();t.exports=c})},{select:6}],9:[function(e,n,o){!function(i,r){if("function"==typeof t&&t.amd)t(["module","./clipboard-action","tiny-emitter","good-listener"],r);else if("undefined"!=typeof o)r(n,e("./clipboard-action"),e("tiny-emitter"),e("good-listener"));else{var a={exports:{}};r(a,i.clipboardAction,i.tinyEmitter,i.goodListener),i.clipboard=a.exports}}(this,function(t,e,n,o){"use strict";function i(t){return t&&t.__esModule?t:{"default":t}}function r(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}function a(t,e){if(!t)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!e||"object"!=typeof e&&"function"!=typeof e?t:e}function c(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function, not "+typeof e);t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,enumerable:!1,writable:!0,configurable:!0}}),e&&(Object.setPrototypeOf?Object.setPrototypeOf(t,e):t.__proto__=e)}function s(t,e){var n="data-clipboard-"+t;if(e.hasAttribute(n))return e.getAttribute(n)}var l=i(e),u=i(n),f=i(o),d=function(t){function e(n,o){r(this,e);var i=a(this,t.call(this));return i.resolveOptions(o),i.listenClick(n),i}return c(e,t),e.prototype.resolveOptions=function t(){var e=arguments.length<=0||void 0===arguments[0]?{}:arguments[0];this.action="function"==typeof e.action?e.action:this.defaultAction,this.target="function"==typeof e.target?e.target:this.defaultTarget,this.text="function"==typeof e.text?e.text:this.defaultText},e.prototype.listenClick=function t(e){var n=this;this.listener=(0,f.default)(e,"click",function(t){return n.onClick(t)})},e.prototype.onClick=function t(e){var n=e.delegateTarget||e.currentTarget;this.clipboardAction&&(this.clipboardAction=null),this.clipboardAction=new l.default({action:this.action(n),target:this.target(n),text:this.text(n),trigger:n,emitter:this})},e.prototype.defaultAction=function t(e){return s("action",e)},e.prototype.defaultTarget=function t(e){var n=s("target",e);return n?document.querySelector(n):void 0},e.prototype.defaultText=function t(e){return s("text",e)},e.prototype.destroy=function t(){this.listener.destroy(),this.clipboardAction&&(this.clipboardAction.destroy(),this.clipboardAction=null)},e}(u.default);t.exports=d})},{"./clipboard-action":8,"good-listener":4,"tiny-emitter":7}]},{},[9])(9)});

/*! jQuery & Zepto Lazy v1.7.10 - http://jquery.eisbehr.de/lazy - MIT&GPL-2.0 license - Copyright 2012-2018 Daniel 'Eisbehr' Kern */
!function(t,e){"use strict";function r(r,a,i,u,l){function f(){L=t.devicePixelRatio>1,i=c(i),a.delay>=0&&setTimeout(function(){s(!0)},a.delay),(a.delay<0||a.combined)&&(u.e=v(a.throttle,function(t){"resize"===t.type&&(w=B=-1),s(t.all)}),u.a=function(t){t=c(t),i.push.apply(i,t)},u.g=function(){return i=n(i).filter(function(){return!n(this).data(a.loadedName)})},u.f=function(t){for(var e=0;e<t.length;e++){var r=i.filter(function(){return this===t[e]});r.length&&s(!1,r)}},s(),n(a.appendScroll).on("scroll."+l+" resize."+l,u.e))}function c(t){var i=a.defaultImage,o=a.placeholder,u=a.imageBase,l=a.srcsetAttribute,f=a.loaderAttribute,c=a._f||{};t=n(t).filter(function(){var t=n(this),r=m(this);return!t.data(a.handledName)&&(t.attr(a.attribute)||t.attr(l)||t.attr(f)||c[r]!==e)}).data("plugin_"+a.name,r);for(var s=0,d=t.length;s<d;s++){var A=n(t[s]),g=m(t[s]),h=A.attr(a.imageBaseAttribute)||u;g===N&&h&&A.attr(l)&&A.attr(l,b(A.attr(l),h)),c[g]===e||A.attr(f)||A.attr(f,c[g]),g===N&&i&&!A.attr(E)?A.attr(E,i):g===N||!o||A.css(O)&&"none"!==A.css(O)||A.css(O,"url('"+o+"')")}return t}function s(t,e){if(!i.length)return void(a.autoDestroy&&r.destroy());for(var o=e||i,u=!1,l=a.imageBase||"",f=a.srcsetAttribute,c=a.handledName,s=0;s<o.length;s++)if(t||e||A(o[s])){var g=n(o[s]),h=m(o[s]),b=g.attr(a.attribute),v=g.attr(a.imageBaseAttribute)||l,p=g.attr(a.loaderAttribute);g.data(c)||a.visibleOnly&&!g.is(":visible")||!((b||g.attr(f))&&(h===N&&(v+b!==g.attr(E)||g.attr(f)!==g.attr(F))||h!==N&&v+b!==g.css(O))||p)||(u=!0,g.data(c,!0),d(g,h,v,p))}u&&(i=n(i).filter(function(){return!n(this).data(c)}))}function d(t,e,r,i){++z;var o=function(){y("onError",t),p(),o=n.noop};y("beforeLoad",t);var u=a.attribute,l=a.srcsetAttribute,f=a.sizesAttribute,c=a.retinaAttribute,s=a.removeAttribute,d=a.loadedName,A=t.attr(c);if(i){var g=function(){s&&t.removeAttr(a.loaderAttribute),t.data(d,!0),y(T,t),setTimeout(p,1),g=n.noop};t.off(I).one(I,o).one(D,g),y(i,t,function(e){e?(t.off(D),g()):(t.off(I),o())})||t.trigger(I)}else{var h=n(new Image);h.one(I,o).one(D,function(){t.hide(),e===N?t.attr(C,h.attr(C)).attr(F,h.attr(F)).attr(E,h.attr(E)):t.css(O,"url('"+h.attr(E)+"')"),t[a.effect](a.effectTime),s&&(t.removeAttr(u+" "+l+" "+c+" "+a.imageBaseAttribute),f!==C&&t.removeAttr(f)),t.data(d,!0),y(T,t),h.remove(),p()});var m=(L&&A?A:t.attr(u))||"";h.attr(C,t.attr(f)).attr(F,t.attr(l)).attr(E,m?r+m:null),h.complete&&h.trigger(D)}}function A(t){var e=t.getBoundingClientRect(),r=a.scrollDirection,n=a.threshold,i=h()+n>e.top&&-n<e.bottom,o=g()+n>e.left&&-n<e.right;return"vertical"===r?i:"horizontal"===r?o:i&&o}function g(){return w>=0?w:w=n(t).width()}function h(){return B>=0?B:B=n(t).height()}function m(t){return t.tagName.toLowerCase()}function b(t,e){if(e){var r=t.split(",");t="";for(var a=0,n=r.length;a<n;a++)t+=e+r[a].trim()+(a!==n-1?",":"")}return t}function v(t,e){var n,i=0;return function(o,u){function l(){i=+new Date,e.call(r,o)}var f=+new Date-i;n&&clearTimeout(n),f>t||!a.enableThrottle||u?l():n=setTimeout(l,t-f)}}function p(){--z,i.length||z||y("onFinishedAll")}function y(t,e,n){return!!(t=a[t])&&(t.apply(r,[].slice.call(arguments,1)),!0)}var z=0,w=-1,B=-1,L=!1,T="afterLoad",D="load",I="error",N="img",E="src",F="srcset",C="sizes",O="background-image";"event"===a.bind||o?f():n(t).on(D+"."+l,f)}function a(a,o){var u=this,l=n.extend({},u.config,o),f={},c=l.name+"-"+ ++i;return u.config=function(t,r){return r===e?l[t]:(l[t]=r,u)},u.addItems=function(t){return f.a&&f.a("string"===n.type(t)?n(t):t),u},u.getItems=function(){return f.g?f.g():{}},u.update=function(t){return f.e&&f.e({},!t),u},u.force=function(t){return f.f&&f.f("string"===n.type(t)?n(t):t),u},u.loadAll=function(){return f.e&&f.e({all:!0},!0),u},u.destroy=function(){return n(l.appendScroll).off("."+c,f.e),n(t).off("."+c),f={},e},r(u,l,a,f,c),l.chainable?a:u}var n=t.jQuery||t.Zepto,i=0,o=!1;n.fn.Lazy=n.fn.lazy=function(t){return new a(this,t)},n.Lazy=n.lazy=function(t,r,i){if(n.isFunction(r)&&(i=r,r=[]),n.isFunction(i)){t=n.isArray(t)?t:[t],r=n.isArray(r)?r:[r];for(var o=a.prototype.config,u=o._f||(o._f={}),l=0,f=t.length;l<f;l++)(o[t[l]]===e||n.isFunction(o[t[l]]))&&(o[t[l]]=i);for(var c=0,s=r.length;c<s;c++)u[r[c]]=t[0]}},a.prototype.config={name:"lazy",chainable:!0,autoDestroy:!0,bind:"load",threshold:500,visibleOnly:!1,appendScroll:t,scrollDirection:"both",imageBase:null,defaultImage:"data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7",placeholder:null,delay:-1,combined:!1,attribute:"data-src",srcsetAttribute:"data-srcset",sizesAttribute:"data-sizes",retinaAttribute:"data-retina",loaderAttribute:"data-loader",imageBaseAttribute:"data-imagebase",removeAttribute:!0,handledName:"handled",loadedName:"loaded",effect:"show",effectTime:0,enableThrottle:!0,throttle:250,beforeLoad:e,afterLoad:e,onError:e,onFinishedAll:e},n(t).on("load",function(){o=!0})}(window);