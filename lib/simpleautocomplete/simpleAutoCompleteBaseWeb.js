function comboSimpleAutoComplete(nombrecombo, controlador, funcion, filas, ancho, parametros) {
	var dirBase = '';
	var pre='au_'; //prefijo para el elemento dentro del que se creará el autocomplete

	//Obtener los parametros (por separado)
	var variables=parametros.split('&');
	var pares;
	var ntabindex=1;
	for(var i=0; i<variables.length; i++){
		pares=variables[i].split('=');
		if(pares[0]=='tabindex') ntabindex=pares[1];
	}
	ntabindex=parseInt(ntabindex);
	//Combo autocomplete de pantalla
	$('#'+nombrecombo+'auto').remove();
	$('<input>').attr({id: nombrecombo+'auto', name: nombrecombo+'auto', type:'text',  tabindex:ntabindex}).appendTo('#'+pre+nombrecombo);
	$('#'+nombrecombo+'auto').addClass('textbox');
	$('#'+nombrecombo+'auto').css({width: ancho+'px', height: '22px'});

	//Imagen de seleccionado
	$('#img_'+nombrecombo).remove();
	$('<img>').attr({id: 'img_'+nombrecombo, src:dirBase+'/js/simpleautocomplete/edit.png'}).appendTo('#'+pre+nombrecombo);
	$('#img_'+nombrecombo).css('vertical-align', 'middle');

	//input de texto selecccionado
	$('#'+nombrecombo+'Nombre').remove();
	$('<input>').attr({id: nombrecombo+'Nombre', name: nombrecombo+'Nombre', type:'hidden'}).appendTo('#'+pre+nombrecombo);

	//input de id seleccionado
	$('#'+nombrecombo).remove();
	$('<input>').attr({id: nombrecombo, name: nombrecombo,type:'hidden'}).appendTo('#'+pre+nombrecombo);


    $('#'+nombrecombo+'auto').simpleAutoComplete(dirBase+'/AjaxC.php',{
		autoCompleteClassName: 'autocomplete',
		selectedClassName: 'sel',
		attrCallBack: 'rel',
		identifier: nombrecombo,
		nEleCombo: filas,
		functionAjax: funcion,
		c: controlador,
		a: funcion,
		userParams: parametros,
		extraParamFromInput: ''
    },comboSimpleAutoCompleteCallback);
}


function comboSimpleAutoCompleteCallback( par ){
	//Cuando se selecciona un valor, se ejecuta una funcion llamada  comboXXXXmodificado(id, nombre)
	$("#"+par[0]).val( par[1] );
    $("#"+par[0]+"Nombre").val( par[2] );

    if(eval('typeof combo'+par[0]+'modificado')== 'function'){
    	eval('combo'+par[0]+"modificado('"+par[1]+"','"+par[2]+"')");
    }
}
