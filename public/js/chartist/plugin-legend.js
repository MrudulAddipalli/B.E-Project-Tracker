/* chartist-plugin-legend
 * Copyright © CodeYellowBV
 * https://github.com/CodeYellowBV/chartist-plugin-legend
 */
!function(e,t){"function"==typeof define&&define.amd?define(["chartist"],function(a){return e.returnExportsGlobal=t(a)}):"object"==typeof exports?module.exports=t(require("chartist")):e["Chartist.plugins.legend"]=t(e.Chartist)}(this,function(e){"use strict";var t={className:"",classNames:!1,removeAll:!1,legendNames:!1,clickable:!0,onClick:null,position:"top"};return e.plugins=e.plugins||{},e.plugins.legend=function(a){function s(e,t){return e-t}if(a&&a.position&&"top"!==a.position&&"bottom"!==a.position)throw Error("The position you entered is not a valid position");return a=e.extend({},t,a),function(t){var i=t.container.querySelector(".ct-legend");if(i&&i.parentNode.removeChild(i),a.clickable){var n=t.data.series.map(function(a,s){return"object"!=typeof a&&(a={value:a}),a.className=a.className||t.options.classNames.series+"-"+e.alphaNumerate(s),a});t.data.series=n}var l=document.createElement("ul"),r=t instanceof e.Pie;l.className="ct-legend",t instanceof e.Pie&&l.classList.add("ct-legend-inside"),"string"==typeof a.className&&a.className.length>0&&l.classList.add(a.className);var c=[],o=t.data.series.slice(0),d=t.data.series,u=r&&t.data.labels;if(u){var p=t.data.labels.slice(0);d=t.data.labels}d=a.legendNames||d;var f=Array.isArray(a.classNames)&&a.classNames.length===d.length;d.forEach(function(e,t){var s=document.createElement("li");s.className="ct-series-"+t,f&&(s.className+=" "+a.classNames[t]),s.setAttribute("data-legend",t),s.textContent=e.name||e,l.appendChild(s)}),t.on("created",function(e){switch(a.position){case"top":t.container.insertBefore(l,t.container.childNodes[0]);break;case"bottom":t.container.insertBefore(l,null)}}),a.clickable&&l.addEventListener("click",function(e){var i=e.target;if(i.parentNode===l&&i.hasAttribute("data-legend")){e.preventDefault();var n=parseInt(i.getAttribute("data-legend")),r=c.indexOf(n);if(r>-1)c.splice(r,1),i.classList.remove("inactive");else if(a.removeAll)c.push(n),i.classList.add("inactive");else if(t.data.series.length>1)c.push(n),i.classList.add("inactive");else{c=[];var d=Array.prototype.slice.call(l.childNodes);d.forEach(function(e){e.classList.remove("inactive")})}var f=o.slice(0);if(u)var m=p.slice(0);c.sort(s).reverse(),c.forEach(function(e){f.splice(e,1),u&&m.splice(e,1)}),a.onClick&&a.onClick(t,e),t.data.series=f,u&&(t.data.labels=m),t.update()}})}},e.plugins.legend});
