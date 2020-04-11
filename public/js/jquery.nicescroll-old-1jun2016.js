! function(b) {
    var c = !1,
        d = !1,
        e = 5e3,
        f = 2e3,
        g = function() {
            var a = document.getElementsByTagName("script"),
                a = a[a.length - 1].src.split("?")[0];
            return a.split("/").length > 0 ? a.split("/").slice(0, -1).join("/") + "/" : ""
        }(),
        h = window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame || !1,
        i = window.cancelRequestAnimationFrame || window.webkitCancelRequestAnimationFrame || window.mozCancelRequestAnimationFrame || window.oCancelRequestAnimationFrame || window.msCancelRequestAnimationFrame || !1,
        j = !1,
        k = function() {
            if (j) return j;
            var a = document.createElement("DIV"),
                b = {
                    haspointerlock: "pointerLockElement" in document || "mozPointerLockElement" in document || "webkitPointerLockElement" in document
                };
            b.isopera = "opera" in window, b.isopera12 = b.isopera && "getUserMedia" in navigator, b.isie = "all" in document && "attachEvent" in a && !b.isopera, b.isieold = b.isie && !("msInterpolationMode" in a.style), b.isie7 = b.isie && !b.isieold && (!("documentMode" in document) || 7 == document.documentMode), b.isie8 = b.isie && "documentMode" in document && 8 == document.documentMode, b.isie9 = b.isie && "performance" in window && document.documentMode >= 9, b.isie10 = b.isie && "performance" in window && document.documentMode >= 10, b.isie9mobile = /iemobile.9/i.test(navigator.userAgent), b.isie9mobile && (b.isie9 = !1), b.isie7mobile = !b.isie9mobile && b.isie7 && /iemobile/i.test(navigator.userAgent), b.ismozilla = "MozAppearance" in a.style, b.iswebkit = "WebkitAppearance" in a.style, b.ischrome = "chrome" in window, b.ischrome22 = b.ischrome && b.haspointerlock, b.cantouch = "ontouchstart" in document.documentElement, b.hasmstouch = window.navigator.msPointerEnabled || !1, b.ismac = /^mac$/i.test(navigator.platform), b.isios = b.cantouch && /iphone|ipad|ipod/i.test(navigator.platform), b.isios4 = b.isios && !("seal" in Object), b.isandroid = /android/i.test(navigator.userAgent), b.trstyle = !1, b.hastransform = !1, b.hastranslate3d = !1, b.transitionstyle = !1, b.hastransition = !1, b.transitionend = !1;
            for (var c = ["transform", "msTransform", "webkitTransform", "MozTransform", "OTransform"], d = 0; d < c.length; d++)
                if ("undefined" != typeof a.style[c[d]]) {
                    b.trstyle = c[d];
                    break
                }
            b.hastransform = 0 != b.trstyle, b.hastransform && (a.style[b.trstyle] = "translate3d(1px,2px,3px)", b.hastranslate3d = /translate3d/.test(a.style[b.trstyle])), b.transitionstyle = !1, b.prefixstyle = "", b.transitionend = !1;
            for (var c = "transition,webkitTransition,MozTransition,OTransition,OTransition,msTransition,KhtmlTransition".split(","), e = ",-webkit-,-moz-,-o-,-o,-ms-,-khtml-".split(","), f = "transitionend,webkitTransitionEnd,transitionend,otransitionend,oTransitionEnd,msTransitionEnd,KhtmlTransitionEnd".split(","), d = 0; d < c.length; d++)
                if (c[d] in a.style) {
                    b.transitionstyle = c[d], b.prefixstyle = e[d], b.transitionend = f[d];
                    break
                }
            b.hastransition = b.transitionstyle;
            a: {
                for (c = ["-moz-grab", "-webkit-grab", "grab"], (b.ischrome && !b.ischrome22 || b.isie) && (c = []), d = 0; d < c.length; d++)
                    if (e = c[d], a.style.cursor = e, a.style.cursor == e) {
                        c = e;
                        break a
                    }
                c = "url(http://www.google.com/intl/en_ALL/mapfiles/openhand.cur),n-resize"
            }
            return b.cursorgrabvalue = c, b.hasmousecapture = "setCapture" in a, j = b
        },
        l = function(a, j) {
            function l(a, b, c) {
                return b = a.css(b), a = parseFloat(b), isNaN(a) ? (a = s[b] || 0, c = 3 == a ? c ? o.win.outerHeight() - o.win.innerHeight() : o.win.outerWidth() - o.win.innerWidth() : 1, o.isie8 && a && (a += 1), c ? a : 0) : a
            }

            function n(a, b) {
                var c = 0,
                    d = 0;
                if ("wheelDeltaY" in a) c = Math.floor(a.wheelDeltaX / 2), d = Math.floor(a.wheelDeltaY / 2);
                else {
                    var e = a.detail ? -1 * a.detail : a.wheelDelta / 40;
                    e && (b ? c = Math.floor(e * o.opt.mousescrollstep) : d = Math.floor(e * o.opt.mousescrollstep))
                }
                c && (o.scrollmom && o.scrollmom.stop(), o.lastdeltax += c, o.synched("mousewheelx", function() {
                    var a = o.lastdeltax;
                    o.lastdeltax = 0, o.rail.drag || o.doScrollLeftBy(a)
                })), d && (o.scrollmom && o.scrollmom.stop(), o.lastdeltay += d, o.synched("mousewheely", function() {
                    var a = o.lastdeltay;
                    o.lastdeltay = 0, o.rail.drag || o.doScrollBy(a)
                }))
            }
            var o = this;
            if (this.version = "3.0.0", this.name = "nicescroll", this.me = j, this.opt = {
                    doc: b("body"),
                    win: !1,
                    zindex: 9e3,
                    cursoropacitymin: 0,
                    cursoropacitymax: 1,
                    cursorcolor: "#424242",
                    cursorwidth: "5px",
                    cursorborder: "1px solid #fff",
                    cursorborderradius: "5px",
                    scrollspeed: 60,
                    mousescrollstep: 24,
                    touchbehavior: !1,
                    hwacceleration: !0,
                    usetransition: !0,
                    boxzoom: !1,
                    dblclickzoom: !0,
                    gesturezoom: !0,
                    grabcursorenabled: !0,
                    autohidemode: !0,
                    background: "",
                    iframeautoresize: !0,
                    cursorminheight: 32,
                    preservenativescrolling: !0,
                    railoffset: !1,
                    bouncescroll: !0,
                    spacebarenabled: !0,
                    railpadding: {
                        top: 0,
                        right: 0,
                        left: 0,
                        bottom: 0
                    },
                    disableoutline: !0,
                    horizrailenabled: !0,
                    railalign: "right",
                    railvalign: "bottom",
                    enabletranslate3d: !0,
                    enablemousewheel: !0,
                    enablekeyboard: !0,
                    smoothscroll: !0,
                    sensitiverail: !0
                }, this.opt.snapbackspeed = 80, a)
                for (var p in o.opt) "undefined" != typeof a[p] && (o.opt[p] = a[p]);
            this.iddoc = (this.doc = o.opt.doc) && this.doc[0] ? this.doc[0].id || "" : "", this.ispage = /BODY|HTML/.test(o.opt.win ? o.opt.win[0].nodeName : this.doc[0].nodeName), this.haswrapper = o.opt.win !== !1, this.win = o.opt.win || (this.ispage ? b(window) : this.doc), this.docscroll = this.ispage && !this.haswrapper ? b(window) : this.win, this.body = b("body"), this.iframe = this.isfixed = !1, this.isiframe = "IFRAME" == this.doc[0].nodeName && "IFRAME" == this.win[0].nodeName, this.istextarea = "TEXTAREA" == this.win[0].nodeName, this.forcescreen = !1, this.canshowonmouseevent = "scroll" != o.opt.autohidemode, this.page = this.view = this.onzoomout = this.onzoomin = this.onscrollcancel = this.onscrollend = this.onscrollstart = this.onclick = this.ongesturezoom = this.onkeypress = this.onmousewheel = this.onmousemove = this.onmouseup = this.onmousedown = !1, this.scroll = {
                x: 0,
                y: 0
            }, this.scrollratio = {
                x: 0,
                y: 0
            }, this.cursorheight = 20, this.scrollvaluemax = 0, this.observer = this.scrollmom = this.scrollrunning = !1;
            do this.id = "ascrail" + f++; while (document.getElementById(this.id));
            this.hasmousefocus = this.hasfocus = this.zoomactive = this.zoom = this.cursorfreezed = this.cursor = this.rail = !1, this.visibility = !0, this.hidden = this.locked = !1, this.cursoractive = !0, this.nativescrollingarea = !1, this.events = [], this.saved = {}, this.delaylist = {}, this.synclist = {}, this.lastdeltay = this.lastdeltax = 0;
            var q = this.detected = k();
            if (this.ishwscroll = (this.canhwscroll = q.hastransform && o.opt.hwacceleration) && o.haswrapper, this.istouchcapable = !1, q.cantouch && q.ischrome && !q.isios && !q.isandroid && (this.istouchcapable = !0, q.cantouch = !1), q.cantouch && q.ismozilla && !q.isios && (this.istouchcapable = !0, q.cantouch = !1), this.delayed = function(a, b, c, d) {
                    var e = o.delaylist[a],
                        f = (new Date).getTime();
                    return !d && e && e.tt ? !1 : (e && e.tt && clearTimeout(e.tt), void(e && e.last + c > f && !e.tt ? o.delaylist[a] = {
                        last: f + c,
                        tt: setTimeout(function() {
                            o.delaylist[a].tt = 0, b.call()
                        }, c)
                    } : e && e.tt || (o.delaylist[a] = {
                        last: f,
                        tt: 0
                    }, setTimeout(function() {
                        b.call()
                    }, 0))))
                }, this.synched = function(a, b) {
                    return o.synclist[a] = b,
                        function() {
                            o.onsync || (h(function() {
                                o.onsync = !1;
                                for (a in o.synclist) {
                                    var b = o.synclist[a];
                                    b && b.call(o), o.synclist[a] = !1
                                }
                            }), o.onsync = !0)
                        }(), a
                }, this.unsynched = function(a) {
                    o.synclist[a] && (o.synclist[a] = !1)
                }, this.css = function(a, b) {
                    for (var c in b) o.saved.css.push([a, c, a.css(c)]), a.css(c, b[c])
                }, this.scrollTop = function(a) {
                    return "undefined" == typeof a ? o.getScrollTop() : o.setScrollTop(a)
                }, this.scrollLeft = function(a) {
                    return "undefined" == typeof a ? o.getScrollLeft() : o.setScrollLeft(a)
                }, BezierClass = function(a, b, c, d, e, f, g) {
                    this.st = a, this.ed = b, this.spd = c, this.p1 = d || 0, this.p2 = e || 1, this.p3 = f || 0, this.p4 = g || 1, this.ts = (new Date).getTime(), this.df = this.ed - this.st
                }, BezierClass.prototype = {
                    B2: function(a) {
                        return 3 * a * a * (1 - a)
                    },
                    B3: function(a) {
                        return 3 * a * (1 - a) * (1 - a)
                    },
                    B4: function(a) {
                        return (1 - a) * (1 - a) * (1 - a)
                    },
                    getNow: function() {
                        var a = 1 - ((new Date).getTime() - this.ts) / this.spd,
                            b = this.B2(a) + this.B3(a) + this.B4(a);
                        return a < 0 ? this.ed : this.st + Math.round(this.df * b)
                    },
                    update: function(a, b) {
                        return this.st = this.getNow(), this.ed = a, this.spd = b, this.ts = (new Date).getTime(), this.df = this.ed - this.st, this
                    }
                }, this.ishwscroll) {
                this.doc.translate = {
                    x: 0,
                    y: 0,
                    tx: "0px",
                    ty: "0px"
                }, q.hastranslate3d && q.isios && this.doc.css("-webkit-backface-visibility", "hidden");
                var r = function() {
                    var a = o.doc.css(q.trstyle);
                    return a && "matrix" == a.substr(0, 6) ? a.replace(/^.*\((.*)\)$/g, "$1").replace(/px/g, "").split(/, +/) : !1
                };
                this.getScrollTop = function(a) {
                    if (!a) {
                        if (a = r()) return 16 == a.length ? -a[13] : -a[5];
                        if (o.timerscroll && o.timerscroll.bz) return o.timerscroll.bz.getNow()
                    }
                    return o.doc.translate.y
                }, this.getScrollLeft = function(a) {
                    if (!a) {
                        if (a = r()) return 16 == a.length ? -a[12] : -a[4];
                        if (o.timerscroll && o.timerscroll.bh) return o.timerscroll.bh.getNow()
                    }
                    return o.doc.translate.x
                }, this.notifyScrollEvent = document.createEvent ? function(a) {
                    var b = document.createEvent("UIEvents");
                    b.initUIEvent("scroll", !1, !0, window, 1), a.dispatchEvent(b)
                } : document.fireEvent ? function(a) {
                    var b = document.createEventObject();
                    a.fireEvent("onscroll"), b.cancelBubble = !0
                } : function() {}, q.hastranslate3d && o.opt.enabletranslate3d ? (this.setScrollTop = function(a, b) {
                    o.doc.translate.y = a, o.doc.translate.ty = -1 * a + "px", o.doc.css(q.trstyle, "translate3d(" + o.doc.translate.tx + "," + o.doc.translate.ty + ",0px)"), b || o.notifyScrollEvent(o.win[0])
                }, this.setScrollLeft = function(a, b) {
                    o.doc.translate.x = a, o.doc.translate.tx = -1 * a + "px", o.doc.css(q.trstyle, "translate3d(" + o.doc.translate.tx + "," + o.doc.translate.ty + ",0px)"), b || o.notifyScrollEvent(o.win[0])
                }) : (this.setScrollTop = function(a, b) {
                    o.doc.translate.y = a, o.doc.translate.ty = -1 * a + "px", o.doc.css(q.trstyle, "translate(" + o.doc.translate.tx + "," + o.doc.translate.ty + ")"), b || o.notifyScrollEvent(o.win[0])
                }, this.setScrollLeft = function(a, b) {
                    o.doc.translate.x = a, o.doc.translate.tx = -1 * a + "px", o.doc.css(q.trstyle, "translate(" + o.doc.translate.tx + "," + o.doc.translate.ty + ")"), b || o.notifyScrollEvent(o.win[0])
                })
            } else this.getScrollTop = function() {
                return o.docscroll.scrollTop()
            }, this.setScrollTop = function(a) {
                return o.docscroll.scrollTop(a)
            }, this.getScrollLeft = function() {
                return o.docscroll.scrollLeft()
            }, this.setScrollLeft = function(a) {
                return o.docscroll.scrollLeft(a)
            };
            this.getTarget = function(a) {
                return a ? a.target ? a.target : a.srcElement ? a.srcElement : !1 : !1
            }, this.hasParent = function(a, b) {
                if (!a) return !1;
                for (var c = a.target || a.srcElement || a || !1; c && c.id != b;) c = c.parentNode || !1;
                return c !== !1
            };
            var s = {
                thin: 1,
                medium: 3,
                thick: 5
            };
            this.updateScrollBar = function(a) {
                if (o.ishwscroll) o.rail.css({
                    height: o.win.innerHeight()
                }), o.railh && o.railh.css({
                    width: o.win.innerWidth()
                });
                else {
                    var b = o.isfixed ? {
                            top: parseFloat(o.win.css("top")),
                            left: parseFloat(o.win.css("left"))
                        } : o.win.offset(),
                        c = b.top,
                        d = b.left;
                    c += l(o.win, "border-top-width", !0), o.win.outerWidth(), o.win.innerWidth(), d += o.rail.align ? o.win.outerWidth() - l(o.win, "border-right-width") - o.rail.width : l(o.win, "border-left-width");
                    var e = o.opt.railoffset;
                    e && (e.top && (c += e.top), o.rail.align && e.left && (d += e.left)), o.locked || o.rail.css({
                        top: c,
                        left: d,
                        height: a ? a.h : o.win.innerHeight()
                    }), o.zoom && o.zoom.css({
                        top: c + 1,
                        left: 1 == o.rail.align ? d - 20 : d + o.rail.width + 4
                    }), o.railh && !o.locked && (c = b.top, d = b.left, a = o.railh.align ? c + l(o.win, "border-top-width", !0) + o.win.innerHeight() - o.railh.height : c + l(o.win, "border-top-width", !0), d += l(o.win, "border-left-width"), o.railh.css({
                        top: a,
                        left: d,
                        width: o.railh.width
                    }))
                }
            }, this.doRailClick = function(a, b, c) {
                var d;
                !(o.rail.drag && 1 != o.rail.drag.pt) && !o.locked && !o.rail.drag && (o.cancelScroll(), o.cancelEvent(a), b ? (b = c ? o.doScrollLeft : o.doScrollTop, d = c ? (a.pageX - o.railh.offset().left - o.cursorwidth / 2) * o.scrollratio.x : (a.pageY - o.rail.offset().top - o.cursorheight / 2) * o.scrollratio.y, b(d)) : (b = c ? o.doScrollLeftBy : o.doScrollBy, d = c ? o.scroll.x : o.scroll.y, a = c ? a.pageX - o.railh.offset().left : a.pageY - o.rail.offset().top, c = c ? o.view.w : o.view.h, b(d >= a ? c : -c)))
            }, o.hasanimationframe = h, o.hascancelanimationframe = i, o.hasanimationframe ? o.hascancelanimationframe || (i = function() {
                o.cancelAnimationFrame = !0
            }) : (h = function(a) {
                return setTimeout(a, 16)
            }, i = clearInterval), this.init = function() {
                if (o.saved.css = [], q.isie7mobile) return !0;
                if (q.hasmstouch && o.css(o.ispage ? b("html") : o.win, {
                        "-ms-touch-action": "none"
                    }), !o.ispage || !q.cantouch && !q.isieold && !q.isie9mobile) {
                    var a = o.docscroll;
                    o.ispage && (a = o.haswrapper ? o.win : o.doc), q.isie9mobile || o.css(a, {
                        "overflow-y": "hidden"
                    }), o.ispage && q.isie7 && ("BODY" == o.doc[0].nodeName ? o.css(b("html"), {
                        "overflow-y": "hidden"
                    }) : "HTML" == o.doc[0].nodeName && o.css(b("body"), {
                        "overflow-y": "hidden"
                    })), q.isios && !o.ispage && !o.haswrapper && o.css(b("body"), {
                        "-webkit-overflow-scrolling": "touch"
                    });
                    var f = b(document.createElement("div"));
                    f.css({
                        position: "relative",
                        top: 0,
                        "float": "right",
                        width: o.opt.cursorwidth,
                        height: "0px",
                        "background-color": o.opt.cursorcolor,
                        border: o.opt.cursorborder,
                        "background-clip": "padding-box",
                        "-webkit-border-radius": o.opt.cursorborderradius,
                        "-moz-border-radius": o.opt.cursorborderradius,
                        "border-radius": o.opt.cursorborderradius
                    }), f.hborder = parseFloat(f.outerHeight() - f.innerHeight()), o.cursor = f;
                    var h = b(document.createElement("div"));
                    h.attr("id", o.id);
                    var i, j, l, k = ["left", "right"];
                    for (l in k) j = k[l], (i = o.opt.railpadding[j]) ? h.css("padding-" + j, i + "px") : o.opt.railpadding[j] = 0;
                    if (h.append(f), h.width = Math.max(parseFloat(o.opt.cursorwidth), f.outerWidth()) + o.opt.railpadding.left + o.opt.railpadding.right, h.css({
                            width: h.width + "px",
                            zIndex: o.ispage ? o.opt.zindex : o.opt.zindex + 2,
                            background: o.opt.background
                        }), h.visibility = !0, h.scrollable = !0, h.align = "left" == o.opt.railalign ? 0 : 1, o.rail = h, f = o.rail.drag = !1, o.opt.boxzoom && !o.ispage && !q.isieold && (f = document.createElement("div"), o.bind(f, "click", o.doZoom), o.zoom = b(f), o.zoom.css({
                            cursor: "pointer",
                            "z-index": o.opt.zindex,
                            backgroundImage: "url(" + g + "zoomico.png)",
                            height: 18,
                            width: 18,
                            backgroundPosition: "0px 0px"
                        }), o.opt.dblclickzoom && o.bind(o.win, "dblclick", o.doZoom), q.cantouch && o.opt.gesturezoom) && (o.ongesturezoom = function(a) {
                            return a.scale > 1.5 && o.doZoomIn(a), a.scale < .8 && o.doZoomOut(a), o.cancelEvent(a)
                        }, o.bind(o.win, "gestureend", o.ongesturezoom)), o.railh = !1, o.opt.horizrailenabled) {
                        o.css(a, {
                            "overflow-x": "hidden"
                        }), f = b(document.createElement("div")), f.css({
                            position: "relative",
                            top: 0,
                            height: o.opt.cursorwidth,
                            width: "0px",
                            "background-color": o.opt.cursorcolor,
                            border: o.opt.cursorborder,
                            "background-clip": "padding-box",
                            "-webkit-border-radius": o.opt.cursorborderradius,
                            "-moz-border-radius": o.opt.cursorborderradius,
                            "border-radius": o.opt.cursorborderradius
                        }), f.wborder = parseFloat(f.outerWidth() - f.innerWidth()), o.cursorh = f;
                        var n = b(document.createElement("div"));
                        n.attr("id", o.id + "-hr"), n.height = 1 + Math.max(parseFloat(o.opt.cursorwidth), f.outerHeight()), n.css({
                            height: n.height + "px",
                            zIndex: o.ispage ? o.opt.zindex : o.opt.zindex + 2,
                            background: o.opt.background
                        }), n.append(f), n.visibility = !0, n.scrollable = !0, n.align = "top" == o.opt.railvalign ? 0 : 1, o.railh = n, o.railh.drag = !1
                    }
                    if (o.ispage ? (h.css({
                            position: "fixed",
                            top: "0px",
                            height: "100%"
                        }), h.css(h.align ? {
                            right: "0px"
                        } : {
                            left: "0px"
                        }), o.body.append(h), o.railh && (n.css({
                            position: "fixed",
                            left: "0px",
                            width: "100%"
                        }), n.css(n.align ? {
                            bottom: "0px"
                        } : {
                            top: "0px"
                        }), o.body.append(n))) : (o.ishwscroll ? ("static" == o.win.css("position") && o.css(o.win, {
                            position: "relative"
                        }), a = "HTML" == o.win[0].nodeName ? o.body : o.win, o.zoom && (o.zoom.css({
                            position: "absolute",
                            top: 1,
                            right: 0,
                            "margin-right": h.width + 4
                        }), a.append(o.zoom)), h.css({
                            position: "absolute",
                            top: 0
                        }), h.css(h.align ? {
                            right: 0
                        } : {
                            left: 0
                        }), a.append(h), n && (n.css({
                            position: "absolute",
                            left: 0,
                            bottom: 0
                        }), n.css(n.align ? {
                            bottom: 0
                        } : {
                            top: 0
                        }), a.append(n))) : (o.isfixed = "fixed" == o.win.css("position"), a = o.isfixed ? "fixed" : "absolute", h.css({
                            position: a
                        }), o.zoom && o.zoom.css({
                            position: a
                        }), o.updateScrollBar(), o.body.append(h), o.zoom && o.body.append(o.zoom), o.railh && (n.css({
                            position: a
                        }), o.body.append(n))), q.isios && o.css(o.win, {
                            "-webkit-tap-highlight-color": "rgba(0,0,0,0)",
                            "-webkit-touch-callout": "none"
                        }), q.isie && o.opt.disableoutline && o.win.attr("hideFocus", "true"), q.iswebkit && o.opt.disableoutline && o.win.css({
                            outline: "none"
                        })), o.opt.autohidemode === !1 ? o.autohidedom = !1 : o.opt.autohidemode === !0 ? (o.autohidedom = b().add(o.rail), o.railh && (o.autohidedom = o.autohidedom.add(o.railh))) : "scroll" == o.opt.autohidemode ? (o.autohidedom = b().add(o.rail), o.railh && (o.autohidedom = o.autohidedom.add(o.railh))) : "cursor" == o.opt.autohidemode ? (o.autohidedom = b().add(o.cursor), o.railh && (o.autohidedom = o.autohidedom.add(o.railh.cursor))) : "hidden" == o.opt.autohidemode && (o.autohidedom = !1, o.hide(), o.locked = !1), q.isie9mobile) o.scrollmom = new m(o), o.onmangotouch = function() {
                        var a = o.getScrollTop(),
                            b = o.getScrollLeft();
                        if (a == o.scrollmom.lastscrolly && b == o.scrollmom.lastscrollx) return !0;
                        var c = a - o.mangotouch.sy,
                            d = b - o.mangotouch.sx;
                        if (0 != Math.round(Math.sqrt(Math.pow(d, 2) + Math.pow(c, 2)))) {
                            var e = c < 0 ? -1 : 1,
                                f = d < 0 ? -1 : 1,
                                g = +new Date;
                            o.mangotouch.lazy && clearTimeout(o.mangotouch.lazy), g - o.mangotouch.tm > 80 || o.mangotouch.dry != e || o.mangotouch.drx != f ? (o.scrollmom.stop(), o.scrollmom.reset(b, a), o.mangotouch.sy = a, o.mangotouch.ly = a, o.mangotouch.sx = b, o.mangotouch.lx = b, o.mangotouch.dry = e, o.mangotouch.drx = f, o.mangotouch.tm = g) : (o.scrollmom.stop(), o.scrollmom.update(o.mangotouch.sx - d, o.mangotouch.sy - c), o.mangotouch.tm = g, c = Math.max(Math.abs(o.mangotouch.ly - a), Math.abs(o.mangotouch.lx - b)), o.mangotouch.ly = a, o.mangotouch.lx = b, c > 2 && (o.mangotouch.lazy = setTimeout(function() {
                                o.mangotouch.lazy = !1, o.mangotouch.dry = 0, o.mangotouch.drx = 0, o.mangotouch.tm = 0, o.scrollmom.doMomentum(30)
                            }, 100)))
                        }
                    }, h = o.getScrollTop(), n = o.getScrollLeft(), o.mangotouch = {
                        sy: h,
                        ly: h,
                        dry: 0,
                        sx: n,
                        lx: n,
                        drx: 0,
                        lazy: !1,
                        tm: 0
                    }, o.bind(o.docscroll, "scroll", o.onmangotouch);
                    else {
                        if (q.cantouch || o.istouchcapable || o.opt.touchbehavior || q.hasmstouch) {
                            o.scrollmom = new m(o), o.ontouchstart = function(a) {
                                if (a.pointerType && 2 != a.pointerType) return !1;
                                if (!o.locked) {
                                    if (q.hasmstouch)
                                        for (var c = a.target ? a.target : !1; c;) {
                                            var d = b(c).getNiceScroll();
                                            if (d.length > 0 && d[0].me == o.me) break;
                                            if (d.length > 0) return !1;
                                            if ("DIV" == c.nodeName && c.id == o.id) break;
                                            c = c.parentNode ? c.parentNode : !1
                                        }
                                    if (o.cancelScroll(), (c = o.getTarget(a)) && /INPUT/i.test(c.nodeName) && /range/i.test(c.type)) return o.stopPropagation(a);
                                    if (o.forcescreen && (d = a, a = {
                                            original: a.original ? a.original : a
                                        }, a.clientX = d.screenX, a.clientY = d.screenY), o.rail.drag = {
                                            x: a.clientX,
                                            y: a.clientY,
                                            sx: o.scroll.x,
                                            sy: o.scroll.y,
                                            st: o.getScrollTop(),
                                            sl: o.getScrollLeft(),
                                            pt: 2
                                        }, o.opt.touchbehavior && o.isiframe && q.isie && (d = o.win.position(), o.rail.drag.x += d.left, o.rail.drag.y += d.top), o.hasmoving = !1, o.lastmouseup = !1, o.scrollmom.reset(a.clientX, a.clientY), !q.cantouch && !this.istouchcapable && !q.hasmstouch) {
                                        if (!c || !/INPUT|SELECT|TEXTAREA/i.test(c.nodeName)) return !o.ispage && q.hasmousecapture && c.setCapture(), o.cancelEvent(a);
                                        /SUBMIT|CANCEL|BUTTON/i.test(b(c).attr("type")) && (pc = {
                                            tg: c,
                                            click: !1
                                        }, o.preventclick = pc)
                                    }
                                }
                            }, o.ontouchend = function(a) {
                                return a.pointerType && 2 != a.pointerType ? !1 : o.rail.drag && 2 == o.rail.drag.pt && (o.scrollmom.doMomentum(), o.rail.drag = !1, o.hasmoving && (o.hasmoving = !1, o.lastmouseup = !0, o.hideCursor(), q.hasmousecapture && document.releaseCapture(), !q.cantouch)) ? o.cancelEvent(a) : void 0
                            };
                            var p = o.opt.touchbehavior && o.isiframe && !q.hasmousecapture;
                            o.ontouchmove = function(a, b) {
                                if (a.pointerType && 2 != a.pointerType) return !1;
                                if (o.rail.drag && 2 == o.rail.drag.pt) {
                                    if (q.cantouch && "undefined" == typeof a.original) return !0;
                                    if (o.hasmoving = !0, o.preventclick && !o.preventclick.click && (o.preventclick.click = o.preventclick.tg.onclick || !1, o.preventclick.tg.onclick = o.onpreventclick), o.forcescreen) {
                                        var c = a,
                                            a = {
                                                original: a.original ? a.original : a
                                            };
                                        a.clientX = c.screenX, a.clientY = c.screenY
                                    }
                                    if (c = ofy = 0, p && !b) {
                                        var d = o.win.position(),
                                            c = -d.left;
                                        ofy = -d.top
                                    }
                                    var e = a.clientY + ofy,
                                        f = o.rail.drag.st - (e - o.rail.drag.y);
                                    o.ishwscroll && o.opt.bouncescroll ? f < 0 ? f = Math.round(f / 2) : f > o.page.maxh && (f = o.page.maxh + Math.round((f - o.page.maxh) / 2)) : (f < 0 && (e = f = 0), f > o.page.maxh && (f = o.page.maxh, e = 0));
                                    var g = a.clientX + c;
                                    if (o.railh && o.railh.scrollable) {
                                        var h = o.rail.drag.sl - (g - o.rail.drag.x);
                                        o.ishwscroll && o.opt.bouncescroll ? h < 0 ? h = Math.round(h / 2) : h > o.page.maxw && (h = o.page.maxw + Math.round((h - o.page.maxw) / 2)) : (h < 0 && (g = h = 0), h > o.page.maxw && (h = o.page.maxw, g = 0))
                                    }
                                    return o.synched("touchmove", function() {
                                        o.rail.drag && 2 == o.rail.drag.pt && (o.prepareTransition && o.prepareTransition(0), o.rail.scrollable && o.setScrollTop(f), o.scrollmom.update(g, e), o.railh && o.railh.scrollable ? (o.setScrollLeft(h), o.showCursor(f, h)) : o.showCursor(f), q.isie10 && document.selection.clear())
                                    }), o.cancelEvent(a)
                                }
                            }
                        }
                        q.cantouch || o.opt.touchbehavior ? (o.onpreventclick = function(a) {
                            return o.preventclick ? (o.preventclick.tg.onclick = o.preventclick.click, o.preventclick = !1, o.cancelEvent(a)) : void 0
                        }, o.onmousedown = o.ontouchstart, o.onmouseup = o.ontouchend, o.onclick = q.isios ? !1 : function(a) {
                            return o.lastmouseup ? (o.lastmouseup = !1, o.cancelEvent(a)) : !0
                        }, o.onmousemove = o.ontouchmove, q.cursorgrabvalue && (o.css(o.ispage ? o.doc : o.win, {
                            cursor: q.cursorgrabvalue
                        }), o.css(o.rail, {
                            cursor: q.cursorgrabvalue
                        }))) : (o.onmousedown = function(a, b) {
                            if (!o.rail.drag || 1 == o.rail.drag.pt) {
                                if (o.locked) return o.cancelEvent(a);
                                o.cancelScroll(), o.rail.drag = {
                                    x: a.clientX,
                                    y: a.clientY,
                                    sx: o.scroll.x,
                                    sy: o.scroll.y,
                                    pt: 1,
                                    hr: !!b
                                };
                                var c = o.getTarget(a);
                                return !o.ispage && q.hasmousecapture && c.setCapture(), o.isiframe && !q.hasmousecapture && (o.saved.csspointerevents = o.doc.css("pointer-events"), o.css(o.doc, {
                                    "pointer-events": "none"
                                })), o.cancelEvent(a)
                            }
                        }, o.onmouseup = function(a) {
                            return o.rail.drag && (q.hasmousecapture && document.releaseCapture(), o.isiframe && !q.hasmousecapture && o.doc.css("pointer-events", o.saved.csspointerevents), 1 == o.rail.drag.pt) ? (o.rail.drag = !1, o.cancelEvent(a)) : void 0
                        }, o.onmousemove = function(a) {
                            if (o.rail.drag) {
                                if (1 == o.rail.drag.pt) {
                                    if (q.ischrome && 0 == a.which) return o.onmouseup(a);
                                    if (o.cursorfreezed = !0, o.rail.drag.hr) {
                                        o.scroll.x = o.rail.drag.sx + (a.clientX - o.rail.drag.x), o.scroll.x < 0 && (o.scroll.x = 0);
                                        var b = o.scrollvaluemaxw;
                                        o.scroll.x > b && (o.scroll.x = b)
                                    } else o.scroll.y = o.rail.drag.sy + (a.clientY - o.rail.drag.y), o.scroll.y < 0 && (o.scroll.y = 0), b = o.scrollvaluemax, o.scroll.y > b && (o.scroll.y = b);
                                    return o.synched("mousemove", function() {
                                        o.rail.drag && 1 == o.rail.drag.pt && (o.showCursor(), o.rail.drag.hr ? o.doScrollLeft(Math.round(o.scroll.x * o.scrollratio.x)) : o.doScrollTop(Math.round(o.scroll.y * o.scrollratio.y)))
                                    }), o.cancelEvent(a)
                                }
                            } else o.checkarea = !0
                        }), (q.cantouch || o.opt.touchbehavior) && o.bind(o.win, "mousedown", o.onmousedown), q.hasmstouch && (o.css(o.rail, {
                            "-ms-touch-action": "none"
                        }), o.css(o.cursor, {
                            "-ms-touch-action": "none"
                        }), o.bind(o.win, "MSPointerDown", o.ontouchstart), o.bind(document, "MSPointerUp", o.ontouchend), o.bind(document, "MSPointerMove", o.ontouchmove), o.bind(o.cursor, "MSGestureHold", function(a) {
                            a.preventDefault()
                        }), o.bind(o.cursor, "contextmenu", function(a) {
                            a.preventDefault()
                        })), this.istouchcapable && (o.bind(o.win, "touchstart", o.ontouchstart), o.bind(document, "touchend", o.ontouchend), o.bind(document, "touchmove", o.ontouchmove)), o.bind(o.cursor, "mousedown", o.onmousedown), o.bind(o.cursor, "mouseup", o.onmouseup), o.railh && (o.bind(o.cursorh, "mousedown", function(a) {
                            o.onmousedown(a, !0)
                        }), o.bind(o.cursorh, "mouseup", function(a) {
                            return o.rail.drag && 2 == o.rail.drag.pt ? void 0 : (o.rail.drag = !1, o.hasmoving = !1, o.hideCursor(), q.hasmousecapture && document.releaseCapture(), o.cancelEvent(a))
                        })), o.bind(document, "mouseup", o.onmouseup), q.hasmousecapture && o.bind(o.win, "mouseup", o.onmouseup), o.bind(document, "mousemove", o.onmousemove), o.onclick && o.bind(document, "click", o.onclick), !q.cantouch && !o.opt.touchbehavior && (o.rail.mouseenter(function() {
                            o.canshowonmouseevent && o.showCursor(), o.rail.active = !0
                        }), o.rail.mouseleave(function() {
                            o.rail.active = !1, o.rail.drag || o.hideCursor()
                        }), o.opt.sensitiverail && (o.rail.click(function(a) {
                            o.doRailClick(a, !1, !1)
                        }), o.rail.dblclick(function(a) {
                            o.doRailClick(a, !0, !1)
                        }), o.cursor.click(function(a) {
                            o.cancelEvent(a)
                        }), o.cursor.dblclick(function(a) {
                            o.cancelEvent(a)
                        })), o.railh && (o.railh.mouseenter(function() {
                            o.canshowonmouseevent && o.showCursor(), o.rail.active = !0
                        }), o.railh.mouseleave(function() {
                            o.rail.active = !1, o.rail.drag || o.hideCursor()
                        })), o.zoom && (o.zoom.mouseenter(function() {
                            o.canshowonmouseevent && o.showCursor(), o.rail.active = !0
                        }), o.zoom.mouseleave(function() {
                            o.rail.active = !1, o.rail.drag || o.hideCursor()
                        }))), o.opt.enablemousewheel && (o.isiframe || o.bind(q.isie && o.ispage ? document : o.docscroll, "mousewheel", o.onmousewheel), o.bind(o.rail, "mousewheel", o.onmousewheel), o.railh && o.bind(o.railh, "mousewheel", o.onmousewheelhr)), !o.ispage && !q.cantouch && !/HTML|BODY/.test(o.win[0].nodeName) && (o.win.attr("tabindex") || o.win.attr({
                            tabindex: e++
                        }), o.win.focus(function(a) {
                            c = o.getTarget(a).id || !0, o.hasfocus = !0, o.canshowonmouseevent && o.noticeCursor()
                        }), o.win.blur(function() {
                            c = !1, o.hasfocus = !1
                        }), o.win.mouseenter(function(a) {
                            d = o.getTarget(a).id || !0, o.hasmousefocus = !0, o.canshowonmouseevent && o.noticeCursor()
                        }), o.win.mouseleave(function() {
                            d = !1, o.hasmousefocus = !1
                        }))
                    }
                    if (o.onkeypress = function(a) {
                            if (o.locked && 0 == o.page.maxh) return !0;
                            var a = a ? a : window.e,
                                b = o.getTarget(a);
                            if (b && /INPUT|TEXTAREA|SELECT|OPTION/.test(b.nodeName) && (!b.getAttribute("type") && !b.type || !/submit|button|cancel/i.tp)) return !0;
                            if (o.hasfocus || o.hasmousefocus && !c || o.ispage && !c && !d) {
                                var b = a.keyCode,
                                    e = a.ctrlKey || !1;
                                if (o.locked && 27 != b) return o.cancelEvent(a);
                                var f = !1;
                                switch (b) {
                                    case 38:
                                    case 63233:
                                        o.doScrollBy(72), f = !0;
                                        break;
                                    case 40:
                                    case 63235:
                                        o.doScrollBy(-72), f = !0;
                                        break;
                                    case 37:
                                    case 63232:
                                        o.railh && (e ? o.doScrollLeft(0) : o.doScrollLeftBy(72), f = !0);
                                        break;
                                    case 39:
                                    case 63234:
                                        o.railh && (e ? o.doScrollLeft(o.page.maxw) : o.doScrollLeftBy(-72), f = !0);
                                        break;
                                    case 33:
                                    case 63276:
                                        o.doScrollBy(o.view.h), f = !0;
                                        break;
                                    case 34:
                                    case 63277:
                                        o.doScrollBy(-o.view.h), f = !0;
                                        break;
                                    case 36:
                                    case 63273:
                                        o.railh && e ? o.doScrollPos(0, 0) : o.doScrollTo(0), f = !0;
                                        break;
                                    case 35:
                                    case 63275:
                                        o.railh && e ? o.doScrollPos(o.page.maxw, o.page.maxh) : o.doScrollTo(o.page.maxh), f = !0;
                                        break;
                                    case 32:
                                        o.opt.spacebarenabled && (o.doScrollBy(-o.view.h), f = !0);
                                        break;
                                    case 27:
                                        o.zoomactive && (o.doZoom(), f = !0)
                                }
                                if (f) return o.cancelEvent(a)
                            }
                        }, o.opt.enablekeyboard && o.bind(document, q.isopera && !q.isopera12 ? "keypress" : "keydown", o.onkeypress), o.bind(window, "resize", o.resize), o.bind(window, "orientationchange", o.resize), o.bind(window, "load", o.resize), q.ischrome && !o.ispage && !o.haswrapper) {
                        var r = o.win.attr("style"),
                            h = parseFloat(o.win.css("width")) + 1;
                        o.win.css("width", h), o.synched("chromefix", function() {
                            o.win.attr("style", r)
                        })
                    }
                    o.onAttributeChange = function() {
                        o.lazyResize()
                    }, o.ispage || o.haswrapper || ("WebKitMutationObserver" in window ? (o.observer = new WebKitMutationObserver(function(a) {
                        a.forEach(o.onAttributeChange)
                    }), o.observer.observe(o.win[0], {
                        attributes: !0,
                        subtree: !1
                    })) : (o.bind(o.win, q.isie && !q.isie9 ? "propertychange" : "DOMAttrModified", o.onAttributeChange), q.isie9 && o.win[0].attachEvent("onpropertychange", o.onAttributeChange))), !o.ispage && o.opt.boxzoom && o.bind(window, "resize", o.resizeZoom), o.istextarea && o.bind(o.win, "mouseup", o.resize), o.resize()
                }
                if ("IFRAME" == this.doc[0].nodeName) {
                    var s = function() {
                        o.iframexd = !1;
                        try {
                            var a = "contentDocument" in this ? this.contentDocument : this.contentWindow.document
                        } catch (c) {
                            o.iframexd = !0, a = !1
                        }
                        if (o.iframexd) return "console" in window && console.log("NiceScroll error: policy restriced iframe"), !0;
                        if (o.forcescreen = !0, o.isiframe && (o.iframe = {
                                doc: b(a),
                                html: o.doc.contents().find("html")[0],
                                body: o.doc.contents().find("body")[0]
                            }, o.getContentSize = function() {
                                return {
                                    w: Math.max(o.iframe.html.scrollWidth, o.iframe.body.scrollWidth),
                                    h: Math.max(o.iframe.html.scrollHeight, o.iframe.body.scrollHeight)
                                }
                            }, o.docscroll = b(o.iframe.body)), !q.isios && o.opt.iframeautoresize && !o.isiframe) {
                            o.win.scrollTop(0), o.doc.height("");
                            var d = Math.max(a.getElementsByTagName("html")[0].scrollHeight, a.body.scrollHeight);
                            o.doc.height(d)
                        }
                        o.resize(), q.isie7 && o.css(b(o.iframe.html), {
                            "overflow-y": "hidden"
                        }), o.css(b(o.iframe.body), {
                            "overflow-y": "hidden"
                        }), "contentWindow" in this ? o.bind(this.contentWindow, "scroll", o.onscroll) : o.bind(a, "scroll", o.onscroll), o.opt.enablemousewheel && o.bind(a, "mousewheel", o.onmousewheel), o.opt.enablekeyboard && o.bind(a, q.isopera ? "keypress" : "keydown", o.onkeypress), (q.cantouch || o.opt.touchbehavior) && (o.bind(a, "mousedown", o.onmousedown), o.bind(a, "mousemove", function(a) {
                            o.onmousemove(a, !0)
                        }), q.cursorgrabvalue && o.css(b(a.body), {
                            cursor: q.cursorgrabvalue
                        })), o.bind(a, "mouseup", o.onmouseup), o.zoom && (o.opt.dblclickzoom && o.bind(a, "dblclick", o.doZoom), o.ongesturezoom && o.bind(a, "gestureend", o.ongesturezoom))
                    };
                    this.doc[0].readyState && "complete" == this.doc[0].readyState && setTimeout(function() {
                        s.call(o.doc[0], !1)
                    }, 500), o.bind(this.doc, "load", s)
                }
            }, this.showCursor = function(a, b) {
                o.cursortimeout && (clearTimeout(o.cursortimeout), o.cursortimeout = 0), o.rail && (o.autohidedom && (o.autohidedom.stop().css({
                    opacity: o.opt.cursoropacitymax
                }), o.cursoractive = !0), "undefined" != typeof a && a !== !1 && (o.scroll.y = Math.round(1 * a / o.scrollratio.y)), "undefined" != typeof b && (o.scroll.x = Math.round(1 * b / o.scrollratio.x)), o.cursor.css({
                    height: o.cursorheight,
                    top: o.scroll.y
                }), o.cursorh && (o.cursorh.css(!o.rail.align && o.rail.visibility ? {
                    width: o.cursorwidth,
                    left: o.scroll.x + o.rail.width
                } : {
                    width: o.cursorwidth,
                    left: o.scroll.x
                }), o.cursoractive = !0), o.zoom && o.zoom.stop().css({
                    opacity: o.opt.cursoropacitymax
                }))
            }, this.hideCursor = function(a) {
                !o.cursortimeout && o.rail && o.autohidedom && (o.cursortimeout = setTimeout(function() {
                    o.rail.active && o.showonmouseevent || (o.autohidedom.stop().animate({
                        opacity: o.opt.cursoropacitymin
                    }), o.zoom && o.zoom.stop().animate({
                        opacity: o.opt.cursoropacitymin
                    }), o.cursoractive = !1), o.cursortimeout = 0
                }, a || 400))
            }, this.noticeCursor = function(a, b, c) {
                o.showCursor(b, c), o.rail.active || o.hideCursor(a)
            }, this.getContentSize = o.ispage ? function() {
                return {
                    w: Math.max(document.body.scrollWidth, document.documentElement.scrollWidth),
                    h: Math.max(document.body.scrollHeight, document.documentElement.scrollHeight)
                }
            } : o.haswrapper ? function() {
                return {
                    w: o.doc.outerWidth() + parseInt(o.win.css("paddingLeft")) + parseInt(o.win.css("paddingRight")),
                    h: o.doc.outerHeight() + parseInt(o.win.css("paddingTop")) + parseInt(o.win.css("paddingBottom"))
                }
            } : function() {
                return {
                    w: o.docscroll[0].scrollWidth,
                    h: o.docscroll[0].scrollHeight
                }
            }, this.onResize = function(a, b) {
                if (!o.win) return !1;
                if (!o.haswrapper && !o.ispage) {
                    if ("none" == o.win.css("display")) return o.visibility && o.hideRail().hideRailHr(), !1;
                    !o.hidden && !o.visibility && o.showRail().showRailHr()
                }
                var c = o.page.maxh,
                    d = o.page.maxw,
                    e = o.view.w;
                if (o.view = {
                        w: o.ispage ? o.win.width() : parseInt(o.win[0].clientWidth),
                        h: o.ispage ? o.win.height() : parseInt(o.win[0].clientHeight)
                    }, o.page = b ? b : o.getContentSize(), o.page.maxh = Math.max(0, o.page.h - o.view.h), o.page.maxw = Math.max(0, o.page.w - o.view.w), o.page.maxh == c && o.page.maxw == d && o.view.w == e) {
                    if (o.ispage) return o;
                    if (c = o.win.offset(), o.lastposition && (d = o.lastposition, d.top == c.top && d.left == c.left)) return o;
                    o.lastposition = c
                }
                return 0 == o.page.maxh ? (o.hideRail(), o.scrollvaluemax = 0, o.scroll.y = 0, o.scrollratio.y = 0, o.cursorheight = 0, o.setScrollTop(0), o.rail.scrollable = !1) : o.rail.scrollable = !0, 0 == o.page.maxw ? (o.hideRailHr(), o.scrollvaluemaxw = 0, o.scroll.x = 0, o.scrollratio.x = 0, o.cursorwidth = 0, o.setScrollLeft(0), o.railh.scrollable = !1) : o.railh.scrollable = !0, o.locked = 0 == o.page.maxh && 0 == o.page.maxw, o.locked ? (o.ispage || o.updateScrollBar(o.view), !1) : (o.hidden || o.visibility ? !o.hidden && !o.railh.visibility && o.showRailHr() : o.showRail().showRailHr(), o.istextarea && o.win.css("resize") && "none" != o.win.css("resize") && (o.view.h -= 20), o.ispage || o.updateScrollBar(o.view), o.cursorheight = Math.min(o.view.h, Math.round(o.view.h * (o.view.h / o.page.h))), o.cursorheight = Math.max(o.opt.cursorminheight, o.cursorheight), o.cursorwidth = Math.min(o.view.w, Math.round(o.view.w * (o.view.w / o.page.w))), o.cursorwidth = Math.max(o.opt.cursorminheight, o.cursorwidth), o.scrollvaluemax = o.view.h - o.cursorheight - o.cursor.hborder, o.railh && (o.railh.width = o.page.maxh > 0 ? o.view.w - o.rail.width : o.view.w, o.scrollvaluemaxw = o.railh.width - o.cursorwidth - o.cursorh.wborder), o.scrollratio = {
                    x: o.page.maxw / o.scrollvaluemaxw,
                    y: o.page.maxh / o.scrollvaluemax
                }, o.getScrollTop() > o.page.maxh ? o.doScroll(o.page.maxh) : (o.scroll.y = Math.round(o.getScrollTop() * (1 / o.scrollratio.y)), o.scroll.x = Math.round(o.getScrollLeft() * (1 / o.scrollratio.x)), o.cursoractive && o.noticeCursor()), o.scroll.y && 0 == o.getScrollTop() && o.doScrollTo(Math.floor(o.scroll.y * o.scrollratio.y)), o)
            }, this.resize = function() {
                return o.delayed("resize", o.onResize, 30), o
            }, this.lazyResize = function() {
                o.delayed("resize", o.resize, 250)
            }, this._bind = function(a, b, c, d) {
                o.events.push({
                    e: a,
                    n: b,
                    f: c,
                    b: d
                }), a.addEventListener ? a.addEventListener(b, c, d || !1) : a.attachEvent ? a.attachEvent("on" + b, c) : a["on" + b] = c
            }, this.bind = function(a, b, c, d) {
                var e = "jquery" in a ? a[0] : a;
                e.addEventListener ? (q.cantouch && /mouseup|mousedown|mousemove/.test(b) && o._bind(e, "mousedown" == b ? "touchstart" : "mouseup" == b ? "touchend" : "touchmove", function(a) {
                    if (a.touches) {
                        if (a.touches.length < 2) {
                            var b = a.touches.length ? a.touches[0] : a;
                            b.original = a, c.call(this, b)
                        }
                    } else a.changedTouches && (b = a.changedTouches[0], b.original = a, c.call(this, b))
                }, d || !1), o._bind(e, b, c, d || !1), "mousewheel" == b && o._bind(e, "DOMMouseScroll", c, d || !1), q.cantouch && "mouseup" == b && o._bind(e, "touchcancel", c, d || !1)) : o._bind(e, b, function(a) {
                    return (a = a || window.event || !1) && a.srcElement && (a.target = a.srcElement), c.call(e, a) === !1 || d === !1 ? o.cancelEvent(a) : !0
                })
            }, this._unbind = function(a, b, c, d) {
                a.removeEventListener ? a.removeEventListener(b, c, d) : a.detachEvent ? a.detachEvent("on" + b, c) : a["on" + b] = !1
            }, this.unbindAll = function() {
                for (var a = 0; a < o.events.length; a++) {
                    var b = o.events[a];
                    o._unbind(b.e, b.n, b.f, b.b)
                }
            }, this.cancelEvent = function(a) {
                return (a = a.original ? a.original : a ? a : window.event || !1) ? (a.preventDefault && a.preventDefault(), a.stopPropagation && a.stopPropagation(), a.preventManipulation && a.preventManipulation(), a.cancelBubble = !0, a.cancel = !0, a.returnValue = !1) : !1
            }, this.stopPropagation = function(a) {
                return (a = a.original ? a.original : a ? a : window.event || !1) ? a.stopPropagation ? a.stopPropagation() : (a.cancelBubble && (a.cancelBubble = !0), !1) : !1
            }, this.showRail = function() {
                return 0 == o.page.maxh || !o.ispage && "none" == o.win.css("display") || (o.visibility = !0, o.rail.visibility = !0, o.rail.css("display", "block")), o
            }, this.showRailHr = function() {
                return o.railh ? (0 == o.page.maxw || !o.ispage && "none" == o.win.css("display") || (o.railh.visibility = !0, o.railh.css("display", "block")), o) : o
            }, this.hideRail = function() {
                return o.visibility = !1, o.rail.visibility = !1, o.rail.css("display", "none"), o
            }, this.hideRailHr = function() {
                return o.railh ? (o.railh.visibility = !1, o.railh.css("display", "none"), o) : o
            }, this.show = function() {
                return o.hidden = !1, o.locked = !1, o.showRail().showRailHr()
            }, this.hide = function() {
                return o.hidden = !0, o.locked = !0, o.hideRail().hideRailHr()
            }, this.remove = function() {
                o.doZoomOut(), o.unbindAll(), o.observer !== !1 && o.observer.disconnect(), o.events = [], o.cursor && (o.cursor.remove(), o.cursor = null), o.cursorh && (o.cursorh.remove(), o.cursorh = null), o.rail && (o.rail.remove(), o.rail = null), o.railh && (o.railh.remove(), o.railh = null), o.zoom && (o.zoom.remove(), o.zoom = null);
                for (var a = 0; a < o.saved.css.length; a++) {
                    var b = o.saved.css[a];
                    b[0].css(b[1], "undefined" == typeof b[2] ? "" : b[2])
                }
                return o.saved = !1, o.me.data("__nicescroll", ""), o.me = null, o.doc = null, o.docscroll = null, o.win = null, o
            }, this.scrollstart = function(a) {
                return this.onscrollstart = a, o
            }, this.scrollend = function(a) {
                return this.onscrollend = a, o
            }, this.scrollcancel = function(a) {
                return this.onscrollcancel = a, o
            }, this.zoomin = function(a) {
                return this.onzoomin = a, o
            }, this.zoomout = function(a) {
                return this.onzoomout = a, o
            }, this.isScrollable = function(a) {
                for (a = a.target ? a.target : a; a && 1 == a.nodeType && !/BODY|HTML/.test(a.nodeName);) {
                    var c = b(a);
                    if (/scroll|auto/.test(c.css("overflowY") || c.css("overflowX") || c.css("overflow") || "")) return a.clientHeight != a.scrollHeight;
                    a = a.parentNode ? a.parentNode : !1
                }
                return !1
            }, this.onmousewheel = function(a) {
                return o.locked ? !0 : o.rail.scrollable ? (o.opt.preservenativescrolling && o.checkarea && (o.checkarea = !1, o.nativescrollingarea = o.isScrollable(a)), o.nativescrollingarea ? !0 : o.locked ? o.cancelEvent(a) : o.rail.drag ? o.cancelEvent(a) : (n(a, !1), o.cancelEvent(a))) : o.railh && o.railh.scrollable ? o.onmousewheelhr(a) : !0
            }, this.onmousewheelhr = function(a) {
                return o.locked || !o.railh.scrollable ? !0 : (o.opt.preservenativescrolling && o.checkarea && (o.checkarea = !1, o.nativescrollingarea = o.isScrollable(a)), o.nativescrollingarea ? !0 : o.locked ? o.cancelEvent(a) : o.rail.drag ? o.cancelEvent(a) : (n(a, !0), o.cancelEvent(a)))
            }, this.stop = function() {
                return o.cancelScroll(), o.scrollmon && o.scrollmon.stop(), o.cursorfreezed = !1, o.scroll.y = Math.round(o.getScrollTop() * (1 / o.scrollratio.y)), o.noticeCursor(), o
            }, this.getTransitionSpeed = function(a) {
                var b = Math.round(10 * o.opt.scrollspeed),
                    a = Math.min(b, Math.round(a / 20 * o.opt.scrollspeed));
                return a > 20 ? a : 0
            }, o.opt.smoothscroll ? o.ishwscroll && q.hastransition && o.opt.usetransition ? (this.prepareTransition = function(a, b) {
                var c = b ? a > 20 ? a : 0 : o.getTransitionSpeed(a),
                    d = c ? q.prefixstyle + "transform " + c + "ms ease-out" : "";
                return o.lasttransitionstyle && o.lasttransitionstyle == d || (o.lasttransitionstyle = d, o.doc.css(q.transitionstyle, d)), c
            }, this.doScrollLeft = function(a, b) {
                var c = o.scrollrunning ? o.newscrolly : o.getScrollTop();
                o.doScrollPos(a, c, b)
            }, this.doScrollTop = function(a, b) {
                var c = o.scrollrunning ? o.newscrollx : o.getScrollLeft();
                o.doScrollPos(c, a, b)
            }, this.doScrollPos = function(a, b, c) {
                var d = o.getScrollTop(),
                    e = o.getScrollLeft();
                return ((o.newscrolly - d) * (b - d) < 0 || (o.newscrollx - e) * (a - e) < 0) && o.cancelScroll(), o.newscrolly = b, o.newscrollx = a, o.newscrollspeed = c || !1, o.timer ? !1 : void(o.timer = setTimeout(function() {
                    var e, f, c = o.getScrollTop(),
                        d = o.getScrollLeft();
                    e = a - d, f = b - c, e = Math.round(Math.sqrt(Math.pow(e, 2) + Math.pow(f, 2))), e = o.prepareTransition(o.newscrollspeed ? o.newscrollspeed : e), o.timerscroll && o.timerscroll.tm && clearInterval(o.timerscroll.tm), e > 0 && (!o.scrollrunning && o.onscrollstart && o.onscrollstart.call(o, {
                        type: "scrollstart",
                        current: {
                            x: d,
                            y: c
                        },
                        request: {
                            x: a,
                            y: b
                        },
                        end: {
                            x: o.newscrollx,
                            y: o.newscrolly
                        },
                        speed: e
                    }), q.transitionend ? o.scrollendtrapped || (o.scrollendtrapped = !0, o.bind(o.doc, q.transitionend, o.onScrollEnd, !1)) : (o.scrollendtrapped && clearTimeout(o.scrollendtrapped), o.scrollendtrapped = setTimeout(o.onScrollEnd, e)), o.timerscroll = {
                        bz: new BezierClass(c, o.newscrolly, e, 0, 0, .58, 1),
                        bh: new BezierClass(d, o.newscrollx, e, 0, 0, .58, 1)
                    }, o.cursorfreezed || (o.timerscroll.tm = setInterval(function() {
                        o.showCursor(o.getScrollTop(), o.getScrollLeft())
                    }, 60))), o.synched("doScroll-set", function() {
                        o.timer = 0, o.scrollendtrapped && (o.scrollrunning = !0), o.setScrollTop(o.newscrolly), o.setScrollLeft(o.newscrollx), o.scrollendtrapped || o.onScrollEnd()
                    })
                }, 50))
            }, this.cancelScroll = function() {
                if (!o.scrollendtrapped) return !0;
                var a = o.getScrollTop(),
                    b = o.getScrollLeft();
                return o.scrollrunning = !1, q.transitionend || clearTimeout(q.transitionend), o.scrollendtrapped = !1, o._unbind(o.doc, q.transitionend, o.onScrollEnd), o.prepareTransition(0), o.setScrollTop(a), o.railh && o.setScrollLeft(b), o.timerscroll && o.timerscroll.tm && clearInterval(o.timerscroll.tm), o.timerscroll = !1, o.cursorfreezed = !1, o.showCursor(a, b), o
            }, this.onScrollEnd = function() {
                o.scrollendtrapped && o._unbind(o.doc, q.transitionend, o.onScrollEnd), o.scrollendtrapped = !1, o.prepareTransition(0), o.timerscroll && o.timerscroll.tm && clearInterval(o.timerscroll.tm), o.timerscroll = !1;
                var a = o.getScrollTop(),
                    b = o.getScrollLeft();
                return o.setScrollTop(a), o.railh && o.setScrollLeft(b), o.noticeCursor(!1, a, b), o.cursorfreezed = !1, a < 0 ? a = 0 : a > o.page.maxh && (a = o.page.maxh), b < 0 ? b = 0 : b > o.page.maxw && (b = o.page.maxw), a != o.newscrolly || b != o.newscrollx ? o.doScrollPos(b, a, o.opt.snapbackspeed) : (o.onscrollend && o.scrollrunning && o.onscrollend.call(o, {
                    type: "scrollend",
                    current: {
                        x: b,
                        y: a
                    },
                    end: {
                        x: o.newscrollx,
                        y: o.newscrolly
                    }
                }), void(o.scrollrunning = !1))
            }) : (this.doScrollLeft = function(a) {
                var b = o.scrollrunning ? o.newscrolly : o.getScrollTop();
                o.doScrollPos(a, b)
            }, this.doScrollTop = function(a) {
                var b = o.scrollrunning ? o.newscrollx : o.getScrollLeft();
                o.doScrollPos(b, a)
            }, this.doScrollPos = function(a, b) {
                function c() {
                    if (o.cancelAnimationFrame) return !0;
                    if (o.scrollrunning = !0, k = 1 - k) return o.timer = h(c) || 1;
                    var a = 0,
                        b = sy = o.getScrollTop();
                    if (o.dst.ay) {
                        var b = o.bzscroll ? o.dst.py + o.bzscroll.getNow() * o.dst.ay : o.newscrolly,
                            d = b - sy;
                        (d < 0 && b < o.newscrolly || d > 0 && b > o.newscrolly) && (b = o.newscrolly), o.setScrollTop(b), b == o.newscrolly && (a = 1)
                    } else a = 1;
                    var e = sx = o.getScrollLeft();
                    o.dst.ax ? (e = o.bzscroll ? o.dst.px + o.bzscroll.getNow() * o.dst.ax : o.newscrollx, d = e - sx, (d < 0 && e < o.newscrollx || d > 0 && e > o.newscrollx) && (e = o.newscrollx), o.setScrollLeft(e), e == o.newscrollx && (a += 1)) : a += 1, 2 == a ? (o.timer = 0, o.cursorfreezed = !1, o.bzscroll = !1, o.scrollrunning = !1, b < 0 ? b = 0 : b > o.page.maxh && (b = o.page.maxh), e < 0 ? e = 0 : e > o.page.maxw && (e = o.page.maxw), e != o.newscrollx || b != o.newscrolly ? o.doScrollPos(e, b) : o.onscrollend && o.onscrollend.call(o, {
                        type: "scrollend",
                        current: {
                            x: sx,
                            y: sy
                        },
                        end: {
                            x: o.newscrollx,
                            y: o.newscrolly
                        }
                    })) : o.timer = h(c) || 1
                }
                if (b = "undefined" == typeof b || b === !1 ? o.getScrollTop(!0) : b, o.timer && o.newscrolly == b && o.newscrollx == a) return !0;
                o.timer && i(o.timer), o.timer = 0;
                var d = o.getScrollTop(),
                    e = o.getScrollLeft();
                ((o.newscrolly - d) * (b - d) < 0 || (o.newscrollx - e) * (a - e) < 0) && o.cancelScroll(), o.newscrolly = b, o.newscrollx = a, o.bouncescroll && o.rail.visibility || (o.newscrolly < 0 ? o.newscrolly = 0 : o.newscrolly > o.page.maxh && (o.newscrolly = o.page.maxh)), o.bouncescroll && o.railh.visibility || (o.newscrollx < 0 ? o.newscrollx = 0 : o.newscrollx > o.page.maxw && (o.newscrollx = o.page.maxw)), o.dst = {}, o.dst.x = a - e, o.dst.y = b - d, o.dst.px = e, o.dst.py = d;
                var f = Math.round(Math.sqrt(Math.pow(o.dst.x, 2) + Math.pow(o.dst.y, 2)));
                o.dst.ax = o.dst.x / f, o.dst.ay = o.dst.y / f;
                var g = 0,
                    j = f;
                if (0 == o.dst.x ? (g = d, j = b, o.dst.ay = 1, o.dst.py = 0) : 0 == o.dst.y && (g = e, j = a, o.dst.ax = 1, o.dst.px = 0), f = o.getTransitionSpeed(f), o.bzscroll = f > 0 ? o.bzscroll ? o.bzscroll.update(j, f) : new BezierClass(g, j, f, 0, 1, 0, 1) : !1, !o.timer) {
                    (d == o.page.maxh && b >= o.page.maxh || e == o.page.maxw && a >= o.page.maxw) && o.checkContentSize();
                    var k = 1;
                    o.cancelAnimationFrame = !1, o.timer = 1, o.onscrollstart && !o.scrollrunning && o.onscrollstart.call(o, {
                        type: "scrollstart",
                        current: {
                            x: e,
                            y: d
                        },
                        request: {
                            x: a,
                            y: b
                        },
                        end: {
                            x: o.newscrollx,
                            y: o.newscrolly
                        },
                        speed: f
                    }), c(), (d == o.page.maxh && b >= d || e == o.page.maxw && a >= e) && o.checkContentSize(), o.noticeCursor()
                }
            }, this.cancelScroll = function() {
                return o.timer && i(o.timer), o.timer = 0, o.bzscroll = !1, o.scrollrunning = !1, o
            }) : (this.doScrollLeft = function(a, b) {
                var c = o.getScrollTop();
                o.doScrollPos(a, c, b)
            }, this.doScrollTop = function(a, b) {
                var c = o.getScrollLeft();
                o.doScrollPos(c, a, b)
            }, this.doScrollPos = function(a, b) {
                var c = a > o.page.maxw ? o.page.maxw : a;
                c < 0 && (c = 0);
                var d = b > o.page.maxh ? o.page.maxh : b;
                d < 0 && (d = 0), o.synched("scroll", function() {
                    o.setScrollTop(d), o.setScrollLeft(c)
                })
            }, this.cancelScroll = function() {}), this.doScrollBy = function(a, b) {
                var c = 0,
                    c = b ? Math.floor((o.scroll.y - a) * o.scrollratio.y) : (o.timer ? o.newscrolly : o.getScrollTop(!0)) - a;
                if (o.bouncescroll) {
                    var d = Math.round(o.view.h / 2);
                    c < -d ? c = -d : c > o.page.maxh + d && (c = o.page.maxh + d)
                }
                return o.cursorfreezed = !1, py = o.getScrollTop(!0), c < 0 && py <= 0 ? o.noticeCursor() : c > o.page.maxh && py >= o.page.maxh ? (o.checkContentSize(), o.noticeCursor()) : void o.doScrollTop(c)
            }, this.doScrollLeftBy = function(a, b) {
                var c = 0,
                    c = b ? Math.floor((o.scroll.x - a) * o.scrollratio.x) : (o.timer ? o.newscrollx : o.getScrollLeft(!0)) - a;
                if (o.bouncescroll) {
                    var d = Math.round(o.view.w / 2);
                    c < -d ? c = -d : c > o.page.maxw + d && (c = o.page.maxw + d)
                }
                return o.cursorfreezed = !1, px = o.getScrollLeft(!0), c < 0 && px <= 0 ? o.noticeCursor() : c > o.page.maxw && px >= o.page.maxw ? o.noticeCursor() : void o.doScrollLeft(c)
            }, this.doScrollTo = function(a, b) {
                b && Math.round(a * o.scrollratio.y), o.cursorfreezed = !1, o.doScrollTop(a)
            }, this.checkContentSize = function() {
                var a = o.getContentSize();
                (a.h != o.page.h || a.w != o.page.w) && o.resize(!1, a)
            }, o.onscroll = function() {
                o.rail.drag || o.cursorfreezed || o.synched("scroll", function() {
                    o.scroll.y = Math.round(o.getScrollTop() * (1 / o.scrollratio.y)), o.railh && (o.scroll.x = Math.round(o.getScrollLeft() * (1 / o.scrollratio.x))), o.noticeCursor()
                })
            }, o.bind(o.docscroll, "scroll", o.onscroll), this.doZoomIn = function(a) {
                if (!o.zoomactive) {
                    o.zoomactive = !0, o.zoomrestore = {
                        style: {}
                    };
                    var e, c = "position,top,left,zIndex,backgroundColor,marginTop,marginBottom,marginLeft,marginRight".split(","),
                        d = o.win[0].style;
                    for (e in c) {
                        var f = c[e];
                        o.zoomrestore.style[f] = "undefined" != typeof d[f] ? d[f] : ""
                    }
                    return o.zoomrestore.style.width = o.win.css("width"), o.zoomrestore.style.height = o.win.css("height"), o.zoomrestore.padding = {
                        w: o.win.outerWidth() - o.win.width(),
                        h: o.win.outerHeight() - o.win.height()
                    }, q.isios4 && (o.zoomrestore.scrollTop = b(window).scrollTop(), b(window).scrollTop(0)), o.win.css({
                        position: q.isios4 ? "absolute" : "fixed",
                        top: 0,
                        left: 0,
                        "z-index": o.opt.zindex + 100,
                        margin: "0px"
                    }), c = o.win.css("backgroundColor"), ("" == c || /transparent|rgba\(0, 0, 0, 0\)|rgba\(0,0,0,0\)/.test(c)) && o.win.css("backgroundColor", "#fff"), o.rail.css({
                        "z-index": o.opt.zindex + 110
                    }), o.zoom.css({
                        "z-index": o.opt.zindex + 112
                    }), o.zoom.css("backgroundPosition", "0px -18px"), o.resizeZoom(), o.onzoomin && o.onzoomin.call(o), o.cancelEvent(a)
                }
            }, this.doZoomOut = function(a) {
                return o.zoomactive ? (o.zoomactive = !1, o.win.css("margin", ""), o.win.css(o.zoomrestore.style), q.isios4 && b(window).scrollTop(o.zoomrestore.scrollTop), o.rail.css({
                    "z-index": o.ispage ? o.opt.zindex : o.opt.zindex + 2
                }), o.zoom.css({
                    "z-index": o.opt.zindex
                }), o.zoomrestore = !1, o.zoom.css("backgroundPosition", "0px 0px"), o.onResize(), o.onzoomout && o.onzoomout.call(o), o.cancelEvent(a)) : void 0
            }, this.doZoom = function(a) {
                return o.zoomactive ? o.doZoomOut(a) : o.doZoomIn(a)
            }, this.resizeZoom = function() {
                if (o.zoomactive) {
                    var a = o.getScrollTop();
                    o.win.css({
                        width: b(window).width() - o.zoomrestore.padding.w + "px",
                        height: b(window).height() - o.zoomrestore.padding.h + "px"
                    }), o.onResize(), o.setScrollTop(Math.min(o.page.maxh, a))
                }
            }, this.init(), b.nicescroll.push(this)
        },
        m = function(a) {
            var b = this;
            this.nc = a, this.steptime = this.lasttime = this.speedy = this.speedx = this.lasty = this.lastx = 0, this.snapy = this.snapx = !1, this.demuly = this.demulx = 0, this.lastscrolly = this.lastscrollx = -1, this.timer = this.chky = this.chkx = 0, this.time = function() {
                return +new Date
            }, this.reset = function(a, c) {
                b.stop();
                var d = b.time();
                b.steptime = 0, b.lasttime = d, b.speedx = 0, b.speedy = 0, b.lastx = a, b.lasty = c, b.lastscrollx = -1, b.lastscrolly = -1
            }, this.update = function(a, c) {
                var d = b.time();
                b.steptime = d - b.lasttime, b.lasttime = d;
                var d = c - b.lasty,
                    e = a - b.lastx,
                    f = b.nc.getScrollTop(),
                    g = b.nc.getScrollLeft();
                f += d, g += e, b.snapx = g < 0 || g > b.nc.page.maxw, b.snapy = f < 0 || f > b.nc.page.maxh, b.speedx = e, b.speedy = d, b.lastx = a, b.lasty = c
            }, this.stop = function() {
                b.nc.unsynched("domomentum2d"), b.timer && clearTimeout(b.timer), b.timer = 0, b.lastscrollx = -1, b.lastscrolly = -1
            }, this.doSnapy = function(a, c) {
                var d = !1;
                c < 0 ? (c = 0, d = !0) : c > b.nc.page.maxh && (c = b.nc.page.maxh, d = !0), a < 0 ? (a = 0, d = !0) : a > b.nc.page.maxw && (a = b.nc.page.maxw, d = !0), d && b.nc.doScrollPos(a, c, b.nc.opt.snapbackspeed)
            }, this.doMomentum = function(a) {
                var c = b.time(),
                    d = a ? c + a : b.lasttime,
                    a = b.nc.getScrollLeft(),
                    e = b.nc.getScrollTop(),
                    f = b.nc.page.maxh,
                    g = b.nc.page.maxw;
                if (b.speedx = g > 0 ? Math.min(60, b.speedx) : 0, b.speedy = f > 0 ? Math.min(60, b.speedy) : 0, d = d && c - d <= 50, (e < 0 || e > f || a < 0 || a > g) && (d = !1), a = b.speedx && d ? b.speedx : !1, b.speedy && d && b.speedy || a) {
                    var h = Math.max(16, b.steptime);
                    h > 50 && (a = h / 50, b.speedx *= a, b.speedy *= a, h = 50), b.demulxy = 0, b.lastscrollx = b.nc.getScrollLeft(), b.chkx = b.lastscrollx, b.lastscrolly = b.nc.getScrollTop(), b.chky = b.lastscrolly;
                    var i = b.lastscrollx,
                        j = b.lastscrolly,
                        k = function() {
                            var a = b.time() - c > 600 ? .04 : .02;
                            b.speedx && (i = Math.floor(b.lastscrollx - b.speedx * (1 - b.demulxy)), b.lastscrollx = i, i < 0 || i > g) && (a = .1), b.speedy && (j = Math.floor(b.lastscrolly - b.speedy * (1 - b.demulxy)), b.lastscrolly = j, j < 0 || j > f) && (a = .1), b.demulxy = Math.min(1, b.demulxy + a), b.nc.synched("domomentum2d", function() {
                                b.speedx && (b.nc.getScrollLeft() != b.chkx && b.stop(), b.chkx = i, b.nc.setScrollLeft(i)), b.speedy && (b.nc.getScrollTop() != b.chky && b.stop(), b.chky = j, b.nc.setScrollTop(j)), b.timer || (b.nc.hideCursor(), b.doSnapy(i, j))
                            }), b.demulxy < 1 ? b.timer = setTimeout(k, h) : (b.stop(), b.nc.hideCursor(), b.doSnapy(i, j))
                        };
                    k()
                } else b.doSnapy(b.nc.getScrollLeft(), b.nc.getScrollTop())
            }
        },
        n = b.fn.scrollTop;
    b.cssHooks.pageYOffset = {
        get: function(a) {
            var c = b.data(a, "__nicescroll") || !1;
            return c && c.ishwscroll ? c.getScrollTop() : n.call(a)
        },
        set: function(a, c) {
            var d = b.data(a, "__nicescroll") || !1;
            return d && d.ishwscroll ? d.setScrollTop(parseInt(c)) : n.call(a, c), this
        }
    }, b.fn.scrollTop = function(a) {
        if ("undefined" == typeof a) {
            var c = this[0] ? b.data(this[0], "__nicescroll") || !1 : !1;
            return c && c.ishwscroll ? c.getScrollTop() : n.call(this)
        }
        return this.each(function() {
            var c = b.data(this, "__nicescroll") || !1;
            c && c.ishwscroll ? c.setScrollTop(parseInt(a)) : n.call(b(this), a)
        })
    };
    var o = b.fn.scrollLeft;
    b.cssHooks.pageXOffset = {
        get: function(a) {
            var c = b.data(a, "__nicescroll") || !1;
            return c && c.ishwscroll ? c.getScrollLeft() : o.call(a)
        },
        set: function(a, c) {
            var d = b.data(a, "__nicescroll") || !1;
            return d && d.ishwscroll ? d.setScrollLeft(parseInt(c)) : o.call(a, c), this
        }
    }, b.fn.scrollLeft = function(a) {
        if ("undefined" == typeof a) {
            var c = this[0] ? b.data(this[0], "__nicescroll") || !1 : !1;
            return c && c.ishwscroll ? c.getScrollLeft() : o.call(this)
        }
        return this.each(function() {
            var c = b.data(this, "__nicescroll") || !1;
            c && c.ishwscroll ? c.setScrollLeft(parseInt(a)) : o.call(b(this), a)
        })
    };
    var p = function(c) {
        var d = this;
        if (this.length = 0, this.name = "nicescrollarray", this.each = function(a) {
                for (var b = 0; b < d.length; b++) a.call(d[b]);
                return d
            }, this.push = function(a) {
                d[d.length] = a, d.length++
            }, this.eq = function(a) {
                return d[a]
            }, c)
            for (a = 0; a < c.length; a++) {
                var e = b.data(c[a], "__nicescroll") || !1;
                e && (this[this.length] = e, this.length++)
            }
        return this
    };
    ! function(a, b, c) {
        for (var d = 0; d < b.length; d++) c(a, b[d])
    }(p.prototype, "show,hide,onResize,resize,remove,stop,doScrollPos".split(","), function(a, b) {
        a[b] = function() {
            var a = arguments;
            return this.each(function() {
                this[b].apply(this, a)
            })
        }
    }), b.fn.getNiceScroll = function(a) {
        return "undefined" == typeof a ? new p(this) : b.data(this[a], "__nicescroll") || !1
    }, b.extend(b.expr[":"], {
        nicescroll: function(a) {
            return b.data(a, "__nicescroll") ? !0 : !1
        }
    }), b.fn.niceScroll = function(a, c) {
        "undefined" == typeof c && "object" == typeof a && !("jquery" in a) && (c = a, a = !1);
        var d = new p;
        "undefined" == typeof c && (c = {}), a && (c.doc = b(a), c.win = b(this));
        var e = !("doc" in c);
        return e || "win" in c || (c.win = b(this)), this.each(function() {
            var a = b(this).data("__nicescroll") || !1;
            a || (c.doc = e ? b(this) : c.doc, a = new l(c, b(this)), b(this).data("__nicescroll", a)), d.push(a)
        }), 1 == d.length ? d[0] : d
    }, window.NiceScroll = {
        getjQuery: function() {
            return b
        }
    }, b.nicescroll || (b.nicescroll = new p)
}(jQuery),
function() {
    jQuery(".mk-body-parallax").length > 0 && 
    jQuery("body").parallax("50%", body_parallax_speed),
     jQuery(".mk-page-parallax").length > 0 && 
     jQuery("#page").parallax("50%", page_parallax_speed), 
     jQuery(".mk-nicescroll").length > 0 && 
     0 == jQuery(".mk-flexsldier-slideshow").length && 
     jQuery("html").niceScroll({
        cursorwidth: 8,
        cursorcolor: "#464646",
        bouncescroll: !1
    }), jQuery(".mk-scroll-top").on("click", function() {
        jQuery("body").ScrollTo({
            duration: 3e3,
            easing: "easeOutQuart",
            durationMode: "all"
        })
    })
}(jQuery);