(function () {
    var G = document, K = window;

    function D(O) {
        if (typeof O == "string") {
            O = G.getElementById(O)
        }
        return O
    }

    function C(Q, P, O) {
        if (K.addEventListener) {
            Q.addEventListener(P, O, false)
        } else {
            if (K.attachEvent) {
                var R = function () {
                    O.call(Q, K.event)
                };
                Q.attachEvent("on" + P, R)
            }
        }
    }

    var B = function () {
        var O = G.createElement("div");
        return function (P) {
            O.innerHTML = P;
            var Q = O.childNodes[0];
            O.removeChild(Q);
            return Q
        }
    }();

    function E(P, O) {
        return P.className.match(new RegExp("(\\s|^)" + O + "(\\s|$)"))
    }

    function F(P, O) {
        if (!E(P, O)) {
            P.className += " " + O
        }
    }

    function L(Q, O) {
        var P = new RegExp("(\\s|^)" + O + "(\\s|$)");
        Q.className = Q.className.replace(P, " ")
    }

    function M(O) {
        if (K.jQuery) {
            return jQuery(O).offset()
        }
        var Q = 0, P = 0;
        do {
            Q += O.offsetTop || 0;
            P += O.offsetLeft || 0
        } while (O = O.offsetParent);
        return {left: P, top: Q}
    }

    function A(Q) {
        var S, P, R, O;
        var T = M(Q);
        S = T.left;
        R = T.top;
        P = S + Q.offsetWidth;
        O = R + Q.offsetHeight;
        return {left: S, right: P, top: R, bottom: O}
    }

    function I(O) {
        if (!O.pageX && O.clientX) {
            return {
                x: O.clientX + G.body.scrollLeft + G.documentElement.scrollLeft,
                y: O.clientY + G.body.scrollTop + G.documentElement.scrollTop
            }
        }
        return {x: O.pageX, y: O.pageY}
    }

    var H = function () {
        var O = 0;
        return function () {
            return "ValumsAjaxUpload" + O++
        }
    }();

    function N(O) {
        return O.replace(/.*(\/|\\)/, "")
    }

    function J(O) {
        return (/[.]/.exec(O)) ? /[^.]+$/.exec(O.toLowerCase()) : ""
    }

    (function () {
        var O = null;
        Ajax_upload = AjaxUpload = function (R, P) {
            if (R.jquery) {
                R = R[0]
            } else {
                if (typeof R == "string" && /^#.*/.test(R)) {
                    R = R.slice(1)
                }
            }
            R = D(R);
            this._input = null;
            this._button = R;
            this._disabled = false;
            this._submitting = false;
            this._settings = {
                action: "upload.php",
                name: "userfile",
                data: {},
                autoSubmit: true,
                onChange: function (S, T) {
                },
                onSubmit: function (S, T) {
                },
                onComplete: function (T, S) {
                }
            };
            for (var Q in P) {
                this._settings[Q] = P[Q]
            }
            this._createInput();
            this._rerouteClicks();
            if (!O) {
                this._createIframe()
            }
        };
        AjaxUpload.prototype = {
            setData: function (P) {
                this._settings.data = P
            }, disable: function () {
                this._disabled = true
            }, enable: function () {
                this._disabled = false
            }, set_data: function (P) {
                this.setData(P)
            }, _createInput: function () {
                var Q = this;
                var P = G.createElement("input");
                P.setAttribute("type", "file");
                P.setAttribute("name", this._settings.name);
                var S = {
                    position: "absolute",
                    margin: "-5px 0 0 -175px",
                    padding: 0,
                    width: "220px",
                    height: "10px",
                    opacity: 0,
                    cursor: "pointer",
                    display: "none"
                };
                for (var R in S) {
                    P.style[R] = S[R]
                }
                if (!(P.style.opacity === "0")) {
                    P.style.filter = "alpha(opacity=0)"
                }
                G.body.appendChild(P);
                C(P, "change", function () {
                    var T = N(this.value);
                    if (Q._settings.onChange.call(Q, T, J(T)) == false) {
                        return
                    }
                    if (Q._settings.autoSubmit) {
                        Q.submit()
                    }
                });
                this._input = P
            }, _rerouteClicks: function () {
                var P = this;
                var Q, R = false;
                C(P._button, "mouseover", function (S) {
                    if (!P._input || R) {
                        return
                    }
                    R = true;
                    Q = A(P._button)
                });
                C(document, "mousemove", function (T) {
                    var S = P._input;
                    if (!S || !R) {
                        return
                    }
                    if (P._disabled) {
                        L(P._button, "hover");
                        S.style.display = "none";
                        return
                    }
                    var U = I(T);
                    if ((U.x >= Q.left) && (U.x <= Q.right) && (U.y >= Q.top) && (U.y <= Q.bottom)) {
                        S.style.top = U.y + "px";
                        S.style.left = U.x + "px";
                        S.style.display = "block";
                        F(P._button, "hover")
                    } else {
                        R = false;
                        S.style.display = "none";
                        L(P._button, "hover")
                    }
                })
            }, _createIframe: function () {
                var P = H();
                _iframe = B('<iframe name="' + P + '" />');
                _iframe.id = P;
                _iframe.style.display = "none";
                G.body.appendChild(_iframe)
            }, submit: function () {
                var P = this, S = this._settings;
                if (this._input.value === "") {
                    return
                }
                var Q = N(this._input.value);
                if (!(S.onSubmit.call(this, Q, J(Q)) == false)) {
                    var T = this._createForm();
                    T.appendChild(this._input);
                    T.submit();
                    G.body.removeChild(T);
                    T = null;
                    this._input = null;
                    this._createInput();
                    var R = _iframe;
                    C(R, "load", function () {
                        var V = false;
                        if (R.src == "about:blank") {
                            if (V) {
                                R.remove()
                            }
                            return
                        }
                        var W = R.contentDocument ? R.contentDocument : frames[R.id].document;
                        var U = W.body.innerHTML;
                        S.onComplete.call(P, Q, U);
                        R.src = "about:blank";
                        V = true
                    });
                    this._createIframe()
                } else {
                    this._input.value = ""
                }
            }, _createForm: function () {
                var Q = this._settings;
                var R = B('<form method="post" enctype="multipart/form-data"></form>');
                R.style.display = "none";
                R.action = Q.action;
                R.target = _iframe.name;
                G.body.appendChild(R);
                for (var S in Q.data) {
                    var P = G.createElement("input");
                    P.type = "hidden";
                    P.name = S;
                    P.value = Q.data[S];
                    R.appendChild(P)
                }
                return R
            }
        }
    })()
})();