//var dirBase = '/gde';
var dirBase = '';
(function ($) {
    $.fn.extend({
        simpleAutoComplete: function (page, options, callback) {
            if (typeof(page) == "undefined") {
                alert("simpleAutoComplete: Debe especificar la url que ejecutará la consulta.");
            }

            var classAC = 'autocomplete';
            var selClass = 'sel';
            var attrCB = 'rel';
            var nEleCombo = 10;
            var functionAjax = '';
            var userParams = '';
            var nombreCombo = '';
            var c = '';
            var a = '';

            var thisElement = $(this);

            $(":not(div." + classAC + ")").click(function () {
                $("div." + classAC).remove();
            });

            thisElement.attr("autocomplete", "off");
            thisElement.attr('selectedClick', 'false');

            thisElement.blur(function (ev) {
                var getOptions = {query: thisElement.val()}
                if (typeof(options) == "object") {
                    classAC = typeof( options.autoCompleteClassName ) != "undefined" ? options.autoCompleteClassName : classAC;
                    selClass = typeof( options.selectedClassName ) != "undefined" ? options.selectedClassName : selClass;
                    nombreCombo = typeof( options.identifier ) != "undefined" ? options.identifier : identifier;
                    c = typeof( options.c ) != "undefined" ? options.c : c;
                    a = typeof( options.a ) != "undefined" ? options.a : a;
                    attrCB = typeof( options.attrCallBack ) != "undefined" ? options.attrCallBack : attrCB;

                    attrCB = typeof( options.attrCallBack ) != "undefined" ? options.attrCallBack : attrCB;
                    if (typeof( options.identifier ) == "string")
                        getOptions.identifier = options.identifier;

                    if (typeof( options.extraParamFromInput ) != "undefined")
                        getOptions.extraParam = $(options.extraParamFromInput).val();
                }

                if (thisElement.attr('selectedClick') == 'true') {
                    //	alert('seleccionado');
                } else {
                    //	alert('NO seleccionado');
                    if ($('div.' + classAC + ' li').length > 0) {    /* solamente si hay lista de valeres, se coge el primero */
                        $($('div.' + classAC + ' li')[0]).addClass(selClass)
                        $('div.' + classAC + ' li.' + selClass).trigger('click');
                        $('div.' + classAC).remove();
                    }
                }

            });


            thisElement.keyup(function (ev) {
                var getOptions = {query: thisElement.val()}
                //var heightEle = $('div.' + classAC).css('font-size')*1.5+2; /* alto letra * alto linea + 2 puntos bordes */
                var heightEle = 18;
                var functionAjax = '';
                var userParams = '';
                var nombreCombo = '';
                var c = '';
                var a = '';

                if (typeof(options) == "object") {
                    classAC = typeof( options.autoCompleteClassName ) != "undefined" ? options.autoCompleteClassName : classAC;
                    selClass = typeof( options.selectedClassName ) != "undefined" ? options.selectedClassName : selClass;
                    nEleCombo = typeof( options.nEleCombo ) != "undefined" ? options.nEleCombo : nEleCombo;
                    functionAjax = typeof( options.functionAjax ) != "undefined" ? options.functionAjax : functionAjax;
                    usrParam = typeof( options.userParams ) != "undefined" ? options.userParams : userParams;
                    c = typeof( options.c ) != "undefined" ? options.c : c;
                    a = typeof( options.a ) != "undefined" ? options.a : a;
                    nombreCombo = typeof( options.identifier ) != "undefined" ? options.identifier : identifier;
                    attrCB = typeof( options.attrCallBack ) != "undefined" ? options.attrCallBack : attrCB;
                    if (typeof( options.identifier ) == "string")
                        getOptions.identifier = options.identifier;

                    if (typeof( options.extraParamFromInput ) != "undefined")
                        getOptions.extraParam = $(options.extraParamFromInput).val();
                }


                kc = ( ( typeof( ev.charCode ) == 'undefined' || ev.charCode === 0 ) ? ev.keyCode : ev.charCode );
                key = String.fromCharCode(kc);

                //console.log(kc, key, ev );
                /* tecla de escape */
                if (kc == 27) {
                    $('div.' + classAC).remove();
                }

                /* tecla de return */
                if (kc == 13) {
                    thisElement.attr('selectedClick', 'false');
                    $('div.' + classAC + ' li.' + selClass).trigger('click');
                }

                if (key.match(/[a-zA-Z0-9_\- ]/) || kc == 8 || kc == 46 || kc == 192) {
                    $.get(page + '?funcion=' + functionAjax + usrParam + '&c=' + c + '&a=' + a + '&numEle=' + nEleCombo, getOptions, function (r) {
                        $('div.' + classAC).remove();
                        autoCompleteList = $('<div>').addClass(classAC).html(r);
                        if (r != '') {
                            autoCompleteList.insertAfter(thisElement);

                            var position = thisElement.position();
                            var height = thisElement.height();
                            var width = thisElement.width();

                            $('div.' + classAC).css({
                                'top': ( height + position.top + 6 ) + 'px',
                                'left': ( position.left ) + 'px',
                                'margin': '0px'
                            });

                            /* limitar el n�mero de elementos VISIBLES de la lista del combo */
                            if ($('div.' + classAC + ' li').length > nEleCombo) {

                                $('div.' + classAC).height(heightEle * nEleCombo);

                                $('div.' + classAC).height(18 * nEleCombo);
                            } else {
                                $('div.' + classAC).height($('div.' + classAC + ' li').length * 15);
                            }

                            $('div.' + classAC + ' ul').css({
                                'margin-left': '0px'
                            });

                            $('div.' + classAC + ' li').each(function (n, el) {
                                el = $(el);
                                el.mouseenter(function () {
                                    thisElement.attr('selectedClick', 'true');
                                    /* seleccionado valor con raton */
                                    $('div.' + classAC + ' li.' + selClass).removeClass(selClass);
                                    $(this).addClass(selClass);
                                });

                                el.click(function () {
                                    thisElement.attr('selectedClick', 'true');
                                    /* seleccionado valor con intro */
//									thisElement.attr('value', el.text()); no funciona en jquery 1.9.1
                                    thisElement.val(el.text());
                                    if (typeof( callback ) == "function")

                                    /* callback( el.attr(attrCB).split('_') );  original */
                                        $("#img_" + nombreCombo).attr('src', dirBase + '/js/simpleautocomplete/ok.png');
                                    callback([nombreCombo, el.attr(attrCB).split('_')[0], el.attr(attrCB).split('_')[1]]);

                                    $('div.' + classAC).remove();
                                    thisElement.focus();
                                });

                            });
                        }
                    });
                }

                if (kc == 38 || kc == 40) { /* tecla de cursores de arriba y abajo. */
                    if ($('div.' + classAC + ' li.' + selClass).length == 0) {
                        if (kc == 38) {
                            $($('div.' + classAC + ' li')[$('div.' + classAC + ' li').length - 1]).addClass(selClass);
                        } else {
                            $($('div.' + classAC + ' li')[0]).addClass(selClass);
                        }
                    } else {
                        sel = false;
                        $('div.' + classAC + ' li').each(function (n, el) {
                            el = $(el);

                            altodiv = $($('div.' + classAC + ' li')[0]).parent('ul').parent('div').height();
                            if (!sel && el.hasClass(selClass)) {
                                if (n > 0 && kc == 38) { /* subir */
                                    el.removeClass(selClass);
                                    $($('div.' + classAC + ' li')[n - 1]).addClass(selClass);
                                    posili = $($('div.' + classAC + ' li')[n - 1]).position();
                                    posiscroll = $($('div.' + classAC + ' li')[n - 1]).parent('ul').parent('div').scrollTop();
                                    posilitop = posili.top;
                                    if (posiscroll > posilitop) $($('div.' + classAC + ' li')[n - 1]).parent('ul').parent('div').scrollTop(posiscroll - 18);
                                    sel = true;
                                }
                                if (n < ($('div.' + classAC + ' li').length - 1) && kc == 40) {/* abajo */
                                    el.removeClass(selClass);
                                    $($('div.' + classAC + ' li')[n + 1]).addClass(selClass);
                                    posili = $($('div.' + classAC + ' li')[n + 1]).position();
                                    posiscroll = $($('div.' + classAC + ' li')[n + 1]).parent('ul').parent('div').scrollTop();
                                    posilitop = posili.top;
                                    if (altodiv - posilitop - 18 < 17) $($('div.' + classAC + ' li')[n + 1]).parent('ul').parent('div').scrollTop(posiscroll + 18);
                                    sel = true;
                                }

                            }
                        });
                    }
                }

                if (kc == 8 || kc == 46) { /* borrado hacia atras o del */
                    $('#img_' + nombreCombo).attr('src', dirBase + '/js/simpleautocomplete/edit.png');
                    thisElement.attr('selectedClick', 'false');
                    /* se considera que se ha deseleccionado el valor anterior */
                    callback([nombreCombo, '', '']);
                    /* se limpian los valores */
                }

                if (thisElement.val() == '') {
                    thisElement.attr('selectedClick', 'false');
                    /* se considera que se ha deseleccionado el valor anterior */
                    $('div.' + classAC).remove();
                    $("#img_" + nombreCombo).attr('src', dirBase + '/js/simpleautocomplete/edit.png');
                    callback([nombreCombo, '', '']);
                    /* se limpian los valores */
                }

            });
        }
    });
})(jQuery);
