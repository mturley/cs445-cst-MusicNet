// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

// Place any jQuery/helper plugins in here.

/**
 * jQuery serializeObject
 * @copyright 2014, macek <paulmacek@gmail.com>
 * @link https://github.com/macek/jquery-serialize-object
 * @license BSD
 * @version 2.2.0
 */
!function(e,r){if("function"==typeof define&&define.amd)define(["jquery","exports"],function(i,t){r(e,t,i)});else if("undefined"!=typeof exports){var i=require("jquery");r(e,exports,i)}else e.FormSerializer=r(e,{},e.jQuery||e.Zepto||e.ender||e.$)}(this,function(e,r,i){var t=r.FormSerializer=function n(e){function r(e,r,i){return e[r]=i,e}function i(e,i){for(var a,s=e.match(n.patterns.key);void 0!==(a=s.pop());)if(n.patterns.push.test(a)){var o=t(e.replace(/\[\]$/,""));i=r([],o,i)}else n.patterns.fixed.test(a)?i=r([],a,i):n.patterns.named.test(a)&&(i=r({},a,i));return i}function t(e){return void 0===d[e]&&(d[e]=0),d[e]++}function a(r){if(!n.patterns.validate.test(r.name))return this;var t=i(r.name,r.value);return u=e.extend(!0,u,t),this}function s(r){if(!e.isArray(r))throw new Error("formSerializer.addPairs expects an Array");for(var i=0,t=r.length;t>i;i++)this.addPair(r[i]);return this}function o(){return u}function f(){return JSON.stringify(o())}var u={},d={};this.addPair=a,this.addPairs=s,this.serialize=o,this.serializeJSON=f};return t.patterns={validate:/^[a-z][a-z0-9_]*(?:\[(?:\d*|[a-z0-9_]+)\])*$/i,key:/[a-z0-9_]+|(?=\[\])/gi,push:/^$/,fixed:/^\d+$/,named:/^[a-z0-9_]+$/i},t.serializeObject=function(){return this.length>1?new Error("jquery-serialize-object can only serialize one form at a time"):new t(i).addPairs(this.serializeArray()).serialize()},t.serializeJSON=function(){return this.length>1?new Error("jquery-serialize-object can only serialize one form at a time"):new t(i).addPairs(this.serializeArray()).serializeJSON()},"undefined"!=typeof i.fn&&(i.fn.serializeObject=t.serializeObject,i.fn.serializeJSON=t.serializeJSON),t});
