jQuery(document).ready(function($) {    


///////////////formateando telefono y otros

///https://stackoverflow.com/questions/12578507/implement-an-input-with-a-mask

    for (const el of document.querySelectorAll("[placeholder][data-slots]")) {
        const pattern = el.getAttribute("placeholder"),
            slots = new Set(el.dataset.slots || "_"),
            prev = (j => Array.from(pattern, (c,i) => slots.has(c)? j=i+1: j))(0),
            first = [...pattern].findIndex(c => slots.has(c)),
            accept = new RegExp(el.dataset.accept || "\\d", "g"),
            clean = input => {
                input = input.match(accept) || [];
                return Array.from(pattern, c =>
                    input[0] === c || slots.has(c) ? input.shift() || c : c
                );
            },
            format = () => {
                const [i, j] = [el.selectionStart, el.selectionEnd].map(i => {
                    i = clean(el.value.slice(0, i)).findIndex(c => slots.has(c));
                    return i<0? prev[prev.length-1]: back? prev[i-1] || first: i;
                });
                el.value = clean(el.value).join``;
                el.setSelectionRange(i, j);
                back = false;
            };
        let back = false;
        el.addEventListener("keydown", (e) => back = e.key === "Backspace");
        el.addEventListener("input", format);
        el.addEventListener("focus", format);
        el.addEventListener("blur", () => el.value === pattern && (el.value=""));
    }


///////////////////////////


      jQuery('body').on('click', '#sig_candidato, #ant_candidato', function(e){
        este = this;
        //console.log( jQuery(this).attr('id') ); //.val()

         btn=jQuery(this).attr('id');
        
        str= jQuery('.show').attr('id');

        campo=str.substring(0, str.length - 1);
        num=str.substring(str.length - 1, str.length);
        
        campo_actual=campo+num;

        if (btn=='sig_candidato') {
            resultado = (parseInt(num) == 7) ? (campo+'1') : (campo+(parseInt(num) +1));  
        } else { //anterior
            resultado = (parseInt(num) == 1) ? (campo+'7') : (campo+(parseInt(num) -1));  
        }

        jQuery('button[data-target="#'+resultado+', .naveg.show"]').trigger('click');

      });  
      jQuery('button[data-target="#p1, .naveg.show"]').trigger('click');

              
        /////////////////////////para levantar los checkbox de 3) Entrevistas y Evaluaciones

        $.each([ 0,1,2,3,4 ], function( index, value ) {
            //alert( index + ": " + value );
              if ( $.trim(jQuery('textarea[name="comentario[]"]:eq('+index+')').text()) !="" ) {
                  jQuery('label.ch'+index).trigger('click');        
              }

        });


      
  

/////////////////////datepicker///////////////////////////// 
$('.datepicker').datepicker({
    format: 'dd-mm-yyyy', 
    language: "es",
    autoclose: true
});

/////////////////////galeria/////////////////////////////
// opciones de configuración para dropzone.
var total_photos_counter = 0; //variable de contador para las imagenes
var name = "";

//myDropzone es la versión camelizada de id presente en nuestro formulario, que en nuestro caso es my-dropzone
if ( $("#preview").length > 0 ) 
Dropzone.options.myDropzone = { //estamos creando un objeto llamado Dropzone.options.myDropzone
    uploadMultiple: true, //subir varios archivos simultáneamente
    parallelUploads: 2, // Dropzone cargará dos archivos simultáneamente.
    maxFilesize: 16, //Dropzone solo permitirá imágenes con un tamaño inferior a 16 MB.
    previewTemplate: document.querySelector('#preview').innerHTML, //estamos obteniendo "innerHTML" la plantilla de vista previa que definimos en nuestra vista
    addRemoveLinks: true, //mostrará el botón Eliminar para eliminar nuestro archivo cargado.
    dictRemoveFile: 'Eliminar fichero', // texto que se mostrará debajo de las fotos para eliminar imágenes.
    dictFileTooBig: 'Image superior a 16MB', // texto se mostrará cuando intentemos subir imágenes con un tamaño superior a 16 MB 
    timeout: 10000, //tiempo de espera para la solicitud XHR en milisegundos.
    renameFile: function (file) {
        name = new Date().getTime() + Math.floor((Math.random() * 100) + 1) + '_' + file.name;
        return name;
    },

    init: function () { // función init para configurar nuestros oyentes de eventos
        this.on("removedfile", function (file) { //evento que se dispara, cdo hagamos clic en el botón Eliminar archivo para eliminar un archivo cargado
            $.ajax({                 
                url: '/images-delete', //endpoint               
                data: {
                    id: file.customName,  //nombre de archivo
                },
                headers: {
                        //'{{ csrf_token()}}' 
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          },                
                type : 'POST',                 
                dataType : 'json',     

                success: function (data) {  //en caso de exito se disminuye el contador
                    total_photos_counter--; 
                    $("#counter").text("# " + total_photos_counter);
                },
              error : function(jqXHR, status, error) {                                      
                                                     },                 
              complete : function(jqXHR, status) {                                      
                                                  }  

            });
        });
    },
    success: function (file, done) {  //Se llamará cuando una imagen se cargue correctamente
        total_photos_counter++;
        $("#counter").text("# " + total_photos_counter);
        file["customName"] = name;
    }

};




/////////////////subir imagen ajax
 var $avatarImage, $avatarInput, $avatarForm;

    $avatarImage = $('#avatarImage'); //este es el <img src
    $avatarInput = $('#avatarInput'); //input q provocara submit
    $avatarForm = $('#avatarForm');  //y el formulario donde esta la imagen

    $avatarImage.on('click', function () { //para provocar el input desde la imagen
        $avatarInput.click(); 
    });

  $avatarInput.on('change', function () {
        var formData = new FormData();
        formData.append('photo', $avatarInput[0].files[0]);
        $.ajax({
            url: $avatarForm.attr('action') + '?' + $avatarForm.serialize(),
            method: $avatarForm.attr('method'),
            data: formData,
            processData: false,
            contentType: false
        }).done(function (data) {
            if (data.success)
                $avatarImage.attr('src', data.path); //poner la imagen
        }).fail(function () {
            alert('La imagen subida no tiene un formato correcto');
        });
  });

/////////////////

idioma= (jQuery('.idioma').attr('idioma')!='') ? jQuery('.idioma').attr('idioma') : "es";

////////////////////////recepcion o entrada/////////////////////////////////////



        jQuery('#tabla_recepcion').DataTable( {
              "processing": true,
              "serverSide": true,
              "ajax": "/busqueda_recepcion_temporal", //"scripts/server_processing.php"

              "pageLength": 10, //numeros de filas por paginas

              "language": {  //tratamiento de lenguaje
                   "url": "/plugins/dataTables-1.10.21/Plugins/i18n/"+idioma+".lang",
                },
               "columnDefs": [
                            
                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.id;
                                },
                                "targets": [0] 
                            },


                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.productos.surtido;
                                },
                                "targets": [1] //codigo
                            },

                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.precio;
                                },
                                "targets": [2] //precio
                            },


                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.cantidad;
                                },
                                "targets": [3] //cantidad
                            },


                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.almacens.nombre;
                                },
                                "targets": [4] //almacen
                            },



                            {
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                texto='<td>';
                                    texto+='<a href="/eliminar_recepcion/'+row.id+'" type="button"';
                                    texto+=' class="btn btn-danger btn-sm btn-block" >';
                                        texto+=' <span class="oi oi-pencil">Eliminar</span>';
                                    texto+=' </a>';
                                texto+='</td>';

                                    return texto;   
                                },
                                "targets": 5
                            },



                ],            
              


                } );

////////////////////////nomenclador de productos/////////////////////////////////////

 $('#multiselect_fabricante').multiselect({

            templates: {
                //button: '<button type="button" class="multiselect dropdown-toggle form-control" data-toggle="dropdown"></button>',
                        //ul: '<ul class="multiselect-container dropdown-menu form-control" style="height:250px;overflow-y:scroll;"></ul>'

               /* ul: '<ul class="multiselect-container dropdown-menu"></ul>',
                filter: '<li class="multiselect-item filter"><div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span><input class="form-control multiselect-search" type="text"></div></li>',
                filterClearBtn: '<span class="input-group-btn"><button class="btn btn-default multiselect-clear-filter" type="button"><i class="glyphicon glyphicon-remove-circle"></i></button></span>',
                li: '<li><a href="javascript:void(0);"><label></label></a></li>',
                divider: '<li class="multiselect-item divider"></li>',
                liGroup: '<li class="multiselect-item group"><label class="multiselect-group"></label></li>'
                */
                //li: '<li class="checkList"><a tabindex="0"><div class="aweCheckbox aweCheckbox-danger"><label for=""></label></div></a></li>'
   
            },   

 });
var options = [
        {label: 'Option 1', title: 'Option 1', value: '1', selected: true},
        {label: 'Option 2', title: 'Option 2', value: '2'},
        {label: 'Option 3', title: 'Option 3', value: '3', selected: true},
        {label: 'Option 4', title: 'Option 4', value: '4'},
        {label: 'Option 5', title: 'Option 5', value: '5'},
        {label: 'Option 6', title: 'Option 6', value: '6', disabled: true}
    ];
    $('#multiselect_fabricante').multiselect('dataprovider', options);




 if ( $('input[multiple="multiple"]').length > 0 ) 

 {
  $('#multiselect_marca, #multiselect_descripcion, #multiselect_codigo, #multiselect_imagen, #multiselect_categoria, #multiselect_fabricante').multiselect({

   //seleccionar todos
            includeSelectAllOption: true,   //para habilitar seleccionar todo
            selectAllText : 'Seleccionar todos!', // texto q se muestra para "seleccionar todo"
            selectAllValue: 0,                  //para controlar el "value" , para la opcion seleccionar todo
            selectAllName : 'select-all-name', //para controlar el "name" , para la opcion seleccionar todo
            selectAllJustVisible: false,   //este permite que se seleccionen todas las opciones con includeSelectAllOption, aunq no esten visibles
           
            /*
           buttonClass : 'btn btn-link form-control',
           inheritClass: true,

                optionClass: function(element) {  //callback para definir clase de los elementos li que contienen casillas de verificación y etiquetas.
                    var value = $(element).val();
     
                    if (value%2 == 0) {
                        return 'even form-control';
                    }
                    else {
                        return 'odd form-control';
                    }
                },

             selectedClass : 'seleccionada form-control' ,   
             */

            templates: {
                button: '<button type="button" class="multiselect dropdown-toggle" data-toggle="dropdown"></button>',
                ul: '<ul class="multiselect-container dropdown-menu"></ul>',
                filter: '<li class="multiselect-item filter"><div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span><input class="form-control multiselect-search" type="text"></div></li>',
                filterClearBtn: '<span class="input-group-btn"><button class="btn btn-default multiselect-clear-filter" type="button"><i class="glyphicon glyphicon-remove-circle"></i></button></span>',
                li: '<li><a href="javascript:void(0);"><label></label></a></li>',
                divider: '<li class="multiselect-item divider"></li>',
                liGroup: '<li class="multiselect-item group"><label class="multiselect-group"></label></li>'
            },             



    //filtros
            enableFiltering: true,  //habilitar o deshabilitar el filtro. 
                                    //Se agregará un input  para filtrar dinámicamente todas las opciones.
            enableCaseInsensitiveFiltering : true, //filtrado de forma sensible, May y Min

            //enableFullValueFiltering : true , // cuando se filtra con esto, lo q prevalece es el orden de las letras q se van escribiendo
                                               //https://github.com/davidstutz/bootstrap-multiselect/pull/555

            filterBehavior: 'value',   //Filtrar las opciones por(valor, texto o ambos) value, text, both, 

            filterPlaceholder: 'Filtrar', //Placeholder para el filtrado

            maxHeight: 200,  //altura del menu
            //buttonWidth : '400px', //El ancho del botón de selección múltiple se puede corregir con esta opción.


            buttonText: function(options, select) {   // callback que especifica el texto que se muestra en el botón en función de las opciones seleccionadas actualmente
                    if (options.length === 0) {
                        return 'No hay elementos seleccionados ...';
                    }
                    else if (options.length > 3) {
                        return 'Más de 3 opciones seleccionadas!';
                    }
                     else {  //aqui va a mostrar las etiquetas seleccionadas
                         var labels = [];
                         options.each(function() {
                             if ($(this).attr('label') !== undefined) {
                                 labels.push($(this).attr('label'));  
                             }
                             else {
                                 labels.push($(this).html());
                             }
                         });
                         return labels.join(', ') + '';
                     }
                },


                      
});         






 jQuery.ajax({
        url:'/get_elementos_productos', //this returns object data
        data:
            {                     
                valor: 1, //jQuery('select[modulo="fabricantes"]').val(),
                modulo: 1, //jQuery('select[modulo="fabricantes"]').attr('modulo'),
              }, 

            headers: {
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },    
        type:'GET',
        datatype:'json',
        success:function(data) { //data = {"0":{"id":1,"name":"Jason"},"1":{"id":2,"name":"Will"},"length":2 }
          //console.log( (data.descripcion[0]) );
         


          //categoria
          var datos = [];
            $.each( data.categoria, function( key, valor ) {

                      datos.push( {
                                    label: (valor.nombre),
                                    title: (valor.nombre),
                                    value: valor.id, 
                                    
                       });
            });
            $('#multiselect_categoria').multiselect('dataprovider', datos);




          //fabricante
          var datos = [];
            $.each( data.fabricante, function( key, valor ) {

                      datos.push( {
                                    label: (valor.nombre),
                                    title: (valor.nombre),
                                    value: valor.id, 
                                    
                       });
            });
            $('#multiselect_fabricante').multiselect('dataprovider', datos);



          //variacion
          var datos = [];
            $.each( data.variacion, function( key, marca ) {
                var group = {label: '' + marca.nombre, children: []};
                //console.log( marca.nombre );
                $.each( marca.modelo, function( key_marca, modelo ) {
                    $.each( modelo.variacion, function( key_variacion, variacion ) {
                       group['children'].push({
                                    label: '' + (modelo.nombre) + ' ' + (variacion.nombre),
                                    value: variacion.id, //(modelo.nombre) + ' ' + (variacion.nombre)+ ' ' + (variacion.motor.id),
                                    
                       });

                    });      
                 
                 });

                datos.push(group);
            });

            $('#multiselect_marca').multiselect('dataprovider', datos);




          //descripcion
          var datos = [];
            $.each( data.descripcion, function( key, valor ) {

                      datos.push( {
                                    label: (valor.nombre),
                                    title: (valor.nombre),
                                    value: valor.nombre, 
                                    
                       });
            });
            $('#multiselect_descripcion').multiselect('dataprovider', datos);



          //codigo
          var datos = [];
            $.each( data.codigo, function( key, valor ) {

                      datos.push( {
                                    label: (valor.nombre),
                                    title: (valor.nombre),
                                    value: valor.nombre, 
                                    
                       });
            });
            $('#multiselect_codigo').multiselect('dataprovider', datos);



          //foto
          var datos = [];
            $.each( data.foto, function( key, valor ) {

                      datos.push( {
                                    label: (valor.nombre),
                                    title: (valor.nombre),
                                    value: valor.url, 
                                    
                       });
            });
            $('#multiselect_imagen').multiselect('dataprovider', datos);


            
            
        }
    });



}


////////////////////////////////////////////////////////////////////////////



   var path = "/busqueda_productos"; //"{{ url('search') }}";

//Buscador de proyecto que aparece en el menu
if ( $(".buscar_elemento").length > 0 ) {
    var consulta_elemento = new Bloodhound({
       datumTokenizer: Bloodhound.tokenizers.obj.whitespace('nombre'),
       queryTokenizer: Bloodhound.tokenizers.whitespace,
       remote: {
            url: '/busqueda_productos?key=%QUERY',
            replace: function ( e ) {
                var q = '/busqueda_productos?key='+encodeURIComponent(jQuery('.buscar_elemento').typeahead("val"));
                    q += '&nombre='+encodeURIComponent(jQuery('.buscar_elemento.tt-input').attr("name"));
                    q += '&idusuario='+encodeURIComponent(jQuery('.buscar_elemento.tt-input').attr("idusuario"));
                return  q;
            }
        },   
    });

    consulta_elemento.initialize();
    jQuery('.buscar_elemento').typeahead({
               hint: true,
          highlight: true,
          minLength: 1
        },
        {
            name: 'buscar_elemento',
            displayKey: 'surtido', //
            source: consulta_elemento.ttAdapter(),
             templates: {
                      suggestion: function (data) {  
                        //console.log(data);

                          return '<p><strong>' + data.surtido + '</strong></p>'; //+
        }
      }
    });


    jQuery('.buscar_elemento').on('typeahead:selected', function (e, datum,otro) {
        key = datum.key;
        if  (datum.valor=='proyectos') {
            window.location.href = '/'+'editar_proyecto/'+jQuery.base64.encode(key);  
        } else {  //usuarios
        }
    }); 
    jQuery('.buscar_elemento').on('typeahead:closed', function (e) {
    }); 
}    
////////////////////////////////////////////////////////////////////////////

  /*

   if ( $("#search").length > 0 ) {
     
        $('#search').typeahead({
             minLength: 2,
            source:  function (query, process) {
            return $.get(path, { query: query }, function (data) {
                    return process(data);
                });
            }
        });
    }    
*/


    var uno=['william','osmel'];
    var dos=['duvi','alex', 'fidel' , 'frida'];
    var  condiciones= [];
    condiciones['uno']= uno;
    condiciones['dos']= dos;

    //console.log(uno);
    //console.log(dos);

//var tempArr = [];

var elemento = {};
Object.keys(condiciones).forEach( (element,i) => { //element=uno y dos
    elemento[element]=(JSON.stringify(condiciones[element]));
});
condiciones= elemento; 


$.ajax({                 
            url : '/pagina',                 
            data:{                     
                    condiciones:condiciones, //JSON.stringify((condiciones)) 
                        //JSON.stringify(JSON.parse(condiciones)) 
                 },    
            headers: {
                    //'{{ csrf_token()}}' 
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },                
            type : 'POST',                 
            dataType : 'json',                 
            success : function(data) {                     
                                //    alert(  JSON.stringify(JSON.parse(data)) );                 
                                      },                 
            error : function(jqXHR, status, error) {                                      
                                                   },                 
            complete : function(jqXHR, status) {                                      
                                                }         
      }); 





        

        jQuery('#tabla_usuario').DataTable( {
              "processing": true,
              "serverSide": true,

              "ajax": "/usuarios/tabla_usuario", //"scripts/server_processing.php"

              "pageLength": 10, //numeros de filas por paginas

              "language": {  //tratamiento de lenguaje
                   "url": "/plugins/dataTables-1.10.21/Plugins/i18n/"+idioma+".lang",
                },
                /*
                search: {
                    "regex": true
                },*/

                //https://datatables.net/reference/option/columns.render

               "columnDefs": [
                            
                            { 
                                
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.id;
                                },
                                "targets": [0] 
                            },


                            { 
                                
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.name;
                                },
                                "targets": [1] 
                            },

                          { 
                                
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.role.nombre_rol;
                                },
                                "targets": [2] 
                            },
                            { 
                                
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.email;
                                },
                                "targets": [3] 
                            },

                             {
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                return `<div class="margin-bottom-5">

                                        <a href="/usuarios/${row.id}/editar"
                                         class="btn btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>


                                        <a href="/eliminar_usuario/${row.id}" class="btn btn-outline-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>                                        
                                </div>`;
                                   
                                },
                                "targets": 4
                            },
                            
                { 
                     "visible": false,
                    "targets": [0]
                } 



                ],            
          
          

                } );



//clientes

  jQuery('#tabla_cliente').DataTable( {
              "processing": true,
              "serverSide": true,
              "ajax": "/clientes/tabla_cliente", //"scripts/server_processing.php"

              "pageLength": 10, //numeros de filas por paginas

              "language": {  //tratamiento de lenguaje
                   "url": "/plugins/dataTables-1.10.21/Plugins/i18n/"+idioma+".lang",
                },
                /*
                search: {
                    "regex": true
                },*/

               "columnDefs": [
                            
                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.id;
                                },
                                "targets": [0] 
                            },


                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.name;
                                },
                                "targets": [1] 
                            },

                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.cliente.puesto.nombre; //puesto
                                },
                                "targets": [2] 
                            },

                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.cliente.telefono; //telefono
                                },
                                "targets": [3] 
                            },                            

                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.email;
                                },
                                "targets": [4] 
                            },

                            {
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                return `<div class="margin-bottom-5">

                                        <a href="/clientes/${row.id}/editar"
                                         class="btn btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>


                                        <a href="/eliminar_cliente/${row.id}" class="btn btn-outline-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>                                        
                                </div>`;
                                
                                },
                                "targets": 5
                            },

                { 
                     "visible": false,
                    "targets": [0]
                } 




                ],            
            


                } );



//candidatos

  jQuery('#tabla_candidato').DataTable( {
              "processing": true,
              "serverSide": true,
              "ajax": "/candidatos/tabla_candidato", //"scripts/server_processing.php"

              "pageLength": 10, //numeros de filas por paginas

              "language": {  //tratamiento de lenguaje
                   "url": "/plugins/dataTables-1.10.21/Plugins/i18n/"+idioma+".lang",
                },
                /*
                search: {
                    "regex": true
                },*/

               "columnDefs": [
                            
                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.id;
                                },
                                "targets": [0] 
                            },


                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.name;
                                },
                                "targets": [1] 
                            },


                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        
                                        return ((row.candidato)) ? ( ((row.candidato.vacante_activa).length>0) ? row.candidato.vacante_activa[0].pivot.sueldo : '-') : '-'; 

                                        //'No'; 
                                        //porque este es un sueldo q esta asociado con la vacante
                                        //para cada vacante el usuario pide un sueldo
                                        //row.candidato.sueldo;
                                },
                                "targets": [2] 
                            },


                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.email;
                                },
                                "targets": [3] 
                            },

                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return  ((row.candidato)) ? row.candidato.telefono1 : '-';
                                },
                                "targets": [4] 
                            },


                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.created_at; //fecha de creación
                                },
                                "targets": [5] 
                            },                            

                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return 'estatus final';
                                        //esto esta asociado con la vacante... por tanto no se puede dar
                                },
                                "targets": [6] 
                            },                            

                            {
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                return `<div class="margin-bottom-5">

                                        <a href="/candidatos/${row.id}/editar"
                                         class="btn btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>


                                        <a href="/eliminar_candidato/${row.id}" class="btn btn-outline-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>                                        
                                </div>`;
                                   
                                },
                                "targets": 7
                            },
                           
                            
                { 
                     "visible": false,
                    "targets": [0]
                } 



                ],            
            


                } );




jQuery('body').on('change', 'select#vacante_id', function(e){
        este = this;
        //console.log( jQuery(this).val() );
        identificador=jQuery(este).val();

            if (!($('#vacante_id').val())) return false; //esto es para el caso en q no haya vacante
            if (($('#vacante_id').val())=="0" ) return false; //esto es para el caso en q no haya vacante
            
            //cantidad = ( (parseInt($(this).val())>0) ? (parseInt($(this).val())) : 0);
            //id_producto =  ( $(this).attr('id_producto')  );

            jQuery.ajax({
                    url : '/candidatos/adjunto_devacante/'+identificador,
                    data:{
                       // cambio:0,
                    },
                    //esta clausula es obligatoria en laravel
                    headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
                    type : 'GET',
                    dataType : 'json',
                    success : function(data) {
                      
                      //console.log( data.data[0].adjuntos_activos);
                      //console.log( data[0].preguntas);
                      
                      dato='';
                        $.each( data.data[0].adjuntos_activos, function( key, value ) {
                          //console.log(value.pivot.activo);
                          dato +=`<label class="form-check-inline">
                            <b> ${value.nombre}</b>
                          </label>    

                          <input style="float:right;" type="file" name="adjunto[]">
                          <br/>`;
                          

                        });

                        
                        jQuery('#contenido_documento').html(dato);
                        

                         


                        //alert(  JSON.stringify(JSON.parse(data)) );
                    },
                    error : function(jqXHR, status, error) {
                        //
                    },
                    complete : function(jqXHR, status) {
                        
                    }
            }); 
            

      });  

      jQuery('select#vacante_id').trigger('change');
         






        //perfiles

        jQuery('#tabla_perfiles').DataTable( {
              "processing": true,
              "serverSide": true,
              "ajax": "/api/resultado_perfiles", //"scripts/server_processing.php"

              "pageLength": 10, //numeros de filas por paginas

              "language": {  //tratamiento de lenguaje
                   "url": "/plugins/dataTables-1.10.21/Plugins/i18n/"+idioma+".lang",
                },
               "columnDefs": [
                            
                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.id;
                                },
                                "targets": [0] 
                            },


                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.nombre_rol;
                                },
                                "targets": [1] 
                            },

                             {
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                return `<div class="margin-bottom-5">

                                        <a href="/perfiles/${row.id}/editar"
                                         class="btn btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>


                                        <a href="/eliminar_perfil/${row.id}" class="btn btn-outline-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>                                        
                                </div>`;
                                return texto;   
                                },
                                "targets": 2
                            },                          

                            



                ],            
              


                } );




    //areas

        jQuery('#tabla_areas').DataTable( {
              "processing": true,
              "serverSide": true,
              "ajax": "/api/resultado_areas", //"scripts/server_processing.php"

              "pageLength": 10, //numeros de filas por paginas

              "language": {  //tratamiento de lenguaje
                   "url": "/plugins/dataTables-1.10.21/Plugins/i18n/"+idioma+".lang",
                },
               "columnDefs": [
                            
                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.id;
                                },
                                "targets": [0] 
                            },


                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.nombre;
                                },
                                "targets": [1] 
                            },

                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return JSON.parse(row.user).name;
                                },
                                "targets": [2] 
                            },              

                             {
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                return `<div class="margin-bottom-5">

                                        <a href="/areas/${row.id}/editar"
                                         class="btn btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>


                                        <a href="/eliminar_area/${row.id}" class="btn btn-outline-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>                                        
                                </div>`;
                                return texto;   
                                },
                                "targets": 3
                            },                                        




                ],            
              


                } );

//puestos

        jQuery('#tabla_puestos').DataTable( {
              "processing": true,
              "serverSide": true,
              "ajax": "/api/resultado_puestos", //"scripts/server_processing.php"

              "pageLength": 10, //numeros de filas por paginas

              "language": {  //tratamiento de lenguaje
                   "url": "/plugins/dataTables-1.10.21/Plugins/i18n/"+idioma+".lang",
                },
               "columnDefs": [
                            
                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.id;
                                },
                                "targets": [0] 
                            },


                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.nombre;
                                },
                                "targets": [1] 
                            },

                             {
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                return `<div class="margin-bottom-5">

                                        <a href="/puestos/${row.id}/editar"
                                         class="btn btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>


                                        <a href="/eliminar_puesto/${row.id}" class="btn btn-outline-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>                                        
                                </div>`;
                                return texto;   
                                },
                                "targets": 2
                            },

                ],            
              


                } );


//situacions

        jQuery('#tabla_situacions').DataTable( {
              "processing": true,
              "serverSide": true,
              "ajax": "/api/resultado_situacions", //"scripts/server_processing.php"

              "pageLength": 10, //numeros de filas por paginas

              "language": {  //tratamiento de lenguaje
                   "url": "/plugins/dataTables-1.10.21/Plugins/i18n/"+idioma+".lang",
                },
               "columnDefs": [
                            
                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.id;
                                },
                                "targets": [0] 
                            },


                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.nombre;
                                },
                                "targets": [1] 
                            },

                             {
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                return `<div class="margin-bottom-5">

                                        <a href="/situacions/${row.id}/editar"
                                         class="btn btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>


                                        <a href="/eliminar_situacion/${row.id}" class="btn btn-outline-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>                                        
                                </div>`;
                                return texto;   
                                },
                                "targets": 2
                            },
                          



                ],            
              


                } );


//estatus

        jQuery('#tabla_estatus').DataTable( {
              "processing": true,
              "serverSide": true,
              "ajax": "/api/resultado_estatus", //"scripts/server_processing.php"

              "pageLength": 10, //numeros de filas por paginas

              "language": {  //tratamiento de lenguaje
                   "url": "/plugins/dataTables-1.10.21/Plugins/i18n/"+idioma+".lang",
                },
               "columnDefs": [
                            
                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.id;
                                },
                                "targets": [0] 
                            },


                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.nombre;
                                },
                                "targets": [1] 
                            },

                          
                             {
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                return `<div class="margin-bottom-5">

                                        <a href="/estatus/${row.id}/editar"
                                         class="btn btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>


                                        <a href="/eliminar_estatu/${row.id}" class="btn btn-outline-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>                                        
                                </div>`;
                                return texto;   
                                },
                                "targets": 2
                            },




                ],            
              


                } );


//semaforos

        jQuery('#tabla_semaforos').DataTable( {
              "processing": true,
              "serverSide": true,
              "ajax": "/api/resultado_semaforos", //"scripts/server_processing.php"

              "pageLength": 10, //numeros de filas por paginas

              "language": {  //tratamiento de lenguaje
                   "url": "/plugins/dataTables-1.10.21/Plugins/i18n/"+idioma+".lang",
                },
               "columnDefs": [
                            
                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.id;
                                },
                                "targets": [0] 
                            },


                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.nombre;
                                },
                                "targets": [1] 
                            },

                             {
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                return `<div class="margin-bottom-5">

                                        <a href="/semaforos/${row.id}/editar"
                                         class="btn btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>


                                        <a href="/eliminar_semaforo/${row.id}" class="btn btn-outline-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>                                        
                                </div>`;
                                return texto;   
                                },
                                "targets": 2
                            },                          




                ],            
              


                } );


//fases

        jQuery('#tabla_fases').DataTable( {
              "processing": true,
              "serverSide": true,
              "ajax": "/api/resultado_fases", //"scripts/server_processing.php"

              "pageLength": 10, //numeros de filas por paginas

              "language": {  //tratamiento de lenguaje
                   "url": "/plugins/dataTables-1.10.21/Plugins/i18n/"+idioma+".lang",
                },
               "columnDefs": [
                            
                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.id;
                                },
                                "targets": [0] 
                            },


                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.nombre;
                                },
                                "targets": [1] 
                            },

                          
                             {
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                return `<div class="margin-bottom-5">

                                        <a href="/fases/${row.id}/editar"
                                         class="btn btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>


                                        <a href="/eliminar_fase/${row.id}" class="btn btn-outline-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>                                        
                                </div>`;
                                return texto;   
                                },
                                "targets": 2
                            },




                ],            
              


                } );


//tipo_entrevistas

        jQuery('#tabla_tipo_entrevistas').DataTable( {
              "processing": true,
              "serverSide": true,
              "ajax": "/api/resultado_tipo_entrevistas", //"scripts/server_processing.php"

              "pageLength": 10, //numeros de filas por paginas

              "language": {  //tratamiento de lenguaje
                   "url": "/plugins/dataTables-1.10.21/Plugins/i18n/"+idioma+".lang",
                },
               "columnDefs": [
                            
                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.id;
                                },
                                "targets": [0] 
                            },


                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.nombre;
                                },
                                "targets": [1] 
                            },

                             {
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                return `<div class="margin-bottom-5">

                                        <a href="/tipo_entrevistas/${row.id}/editar"
                                         class="btn btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>


                                        <a href="/eliminar_tipo_entrevista/${row.id}" class="btn btn-outline-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>                                        
                                </div>`;
                                return texto;   
                                },
                                "targets": 2
                            },                          

                          



                ],            
              


                } );




//vacantes

        jQuery('#tabla_vacantes').DataTable( {
              "processing": true,
              "serverSide": true,
              "ajax": "/api/resultado_vacantes", //"scripts/server_processing.php"

              "pageLength": 10, //numeros de filas por paginas

              "language": {  //tratamiento de lenguaje
                   "url": "/plugins/dataTables-1.10.21/Plugins/i18n/"+idioma+".lang",
                },
               "columnDefs": [
                            
                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.id;
                                },
                                "targets": [0] 
                            },


                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.nombre;
                                },
                                "targets": [1] 
                            },
                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.area; //JSON.parse(JSON.stringify(row.area));
                                },
                                "targets": [2] 
                            },                              

                             {
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                return `<div class="margin-bottom-5">

                                        <a href="/vacantes/${row.id}/editar"
                                         class="btn btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>


                                        <a href="/eliminar_vacante/${row.id}" class="btn btn-outline-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>                                        
                                </div>`;
                                return texto;   
                                },
                                "targets": 3
                            },
                          




                ],            
              


                } );



//tipo_vacantes

        jQuery('#tabla_tipo_vacantes').DataTable( {
              "processing": true,
              "serverSide": true,
              "ajax": "/api/resultado_tipo_vacantes", //"scripts/server_processing.php"

              "pageLength": 10, //numeros de filas por paginas

              "language": {  //tratamiento de lenguaje
                   "url": "/plugins/dataTables-1.10.21/Plugins/i18n/"+idioma+".lang",
                },
               "columnDefs": [
                            
                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.id;
                                },
                                "targets": [0] 
                            },


                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.nombre;
                                },
                                "targets": [1] 
                            },

                             {
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                return `<div class="margin-bottom-5">

                                        <a href="/tipo_vacantes/${row.id}/editar"
                                         class="btn btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>


                                        <a href="/eliminar_tipo_vacante/${row.id}" class="btn btn-outline-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>                                        
                                </div>`;
                                return texto;   
                                },
                                "targets": 2
                            },                          




                ],            
              


                } );





//entrevistas

        jQuery('#tabla_entrevistas').DataTable( {
              "processing": true,
              "serverSide": true,
              "ajax": "/api/resultado_entrevistas", //"scripts/server_processing.php"

              "pageLength": 10, //numeros de filas por paginas

              "language": {  //tratamiento de lenguaje
                   "url": "/plugins/dataTables-1.10.21/Plugins/i18n/"+idioma+".lang",
                },
               "columnDefs": [
                            
                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.id;
                                },
                                "targets": [0] 
                            },


                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.nombre;
                                },
                                "targets": [1] 
                            },

                           {
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                return `<div class="margin-bottom-5">

                                        <a href="/entrevistas/${row.id}/editar"
                                         class="btn btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>


                                        <a href="/eliminar_entrevista/${row.id}" class="btn btn-outline-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>                                        
                                </div>`;
                                return texto;   
                                },
                                "targets": 2
                            },                          

                            



                ],            
              


                } );









//zonas

        jQuery('#tabla_zonas').DataTable( {
              "processing": true,
              "serverSide": true,
              "ajax": "/api/resultado_zonas", //"scripts/server_processing.php"

              "pageLength": 10, //numeros de filas por paginas

              "language": {  //tratamiento de lenguaje
                   "url": "/plugins/dataTables-1.10.21/Plugins/i18n/"+idioma+".lang",
                },
               "columnDefs": [
                            
                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.id;
                                },
                                "targets": [0] 
                            },


                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.nombre;
                                },
                                "targets": [1] 
                            },

                             {
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                return `<div class="margin-bottom-5">

                                        <a href="/zonas/${row.id}/editar"
                                         class="btn btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>


                                        <a href="/eliminar_zona/${row.id}" class="btn btn-outline-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>                                        
                                </div>`;
                                return texto;   
                                },
                                "targets": 2
                            },                          




                ],            
              


                } );





//contactos

        jQuery('#tabla_contactos').DataTable( {
              "processing": true,
              "serverSide": true,
              "ajax": "/api/resultado_contactos", //"scripts/server_processing.php"

              "pageLength": 10, //numeros de filas por paginas

              "language": {  //tratamiento de lenguaje
                   "url": "/plugins/dataTables-1.10.21/Plugins/i18n/"+idioma+".lang",
                },
               "columnDefs": [
                            
                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.id;
                                },
                                "targets": [0] 
                            },


                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.nombre;
                                },
                                "targets": [1] 
                            },

                             {
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                return `<div class="margin-bottom-5">

                                        <a href="/contactos/${row.id}/editar"
                                         class="btn btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>


                                        <a href="/eliminar_contacto/${row.id}" class="btn btn-outline-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>                                        
                                </div>`;
                                return texto;   
                                },
                                "targets": 2
                            },                          

                   



                ],            
              


                } );




//tipo_referencias

        jQuery('#tabla_tipo_referencias').DataTable( {
              "processing": true,
              "serverSide": true,
              "ajax": "/api/resultado_tipo_referencias", //"scripts/server_processing.php"

              "pageLength": 10, //numeros de filas por paginas

              "language": {  //tratamiento de lenguaje
                   "url": "/plugins/dataTables-1.10.21/Plugins/i18n/"+idioma+".lang",
                },
               "columnDefs": [
                            
                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.id;
                                },
                                "targets": [0] 
                            },


                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.nombre;
                                },
                                "targets": [1] 
                            },
                             {
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                return `<div class="margin-bottom-5">

                                        <a href="/tipo_referencias/${row.id}/editar"
                                         class="btn btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>


                                        <a href="/eliminar_tipo_referencia/${row.id}" class="btn btn-outline-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>                                        
                                </div>`;
                                return texto;   
                                },
                                "targets": 2
                            },
                          



                ],            
              


                } );



//referencias
      
        jQuery('#tabla_referencias').DataTable( {
              "processing": true,
              "serverSide": true,
              "ajax": "/api/resultado_referencias/"+jQuery('#identificador').val(), //"scripts/server_processing.php"

              "pageLength": 10, //numeros de filas por paginas

              "language": {  //tratamiento de lenguaje
                   "url": "/plugins/dataTables-1.10.21/Plugins/i18n/"+idioma+".lang",
                },
               "columnDefs": [
                            
                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.id;
                                },
                                "targets": [0] 
                            },


                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.nombre;
                                },
                                "targets": [1] 
                            },

                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.telefono;
                                },
                                "targets": [2] 
                            },

                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.relacion;
                                },
                                "targets": [3] 
                            },                            
                          
                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.tiporeferencia.nombre;
                                },
                                "targets": [4] 
                            },                            


                             {
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                return `<div class="margin-bottom-5">

                                        <a href="/referencias/${row.id}/editar/${jQuery("#identificador").val()}"
                                         class="btn btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>


                                        <a href="/eliminar_referencia/${row.id}/${jQuery("#identificador").val()}" class="btn btn-outline-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>                                        
                                </div>`;
                                return texto;   
                                },
                                "targets": 5
                            },





                ],            
              


                } );



//adjuntos

        jQuery('#tabla_adjuntos').DataTable( {
              "processing": true,
              "serverSide": true,
              "ajax": "/api/resultado_adjuntos", //"scripts/server_processing.php"

              "pageLength": 10, //numeros de filas por paginas

              "language": {  //tratamiento de lenguaje
                   "url": "/plugins/dataTables-1.10.21/Plugins/i18n/"+idioma+".lang",
                },
               "columnDefs": [
                            
                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.id;
                                },
                                "targets": [0] 
                            },


                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.nombre;
                                },
                                "targets": [1] 
                            },

                           { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.orden;
                                },
                                "targets": [2] 
                            },

                             {
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                return `<div class="margin-bottom-5">

                                        <a href="/adjuntos/${row.id}/editar"
                                         class="btn btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>


                                        <a href="/eliminar_adjunto/${row.id}" class="btn btn-outline-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>                                        
                                </div>`;
                                return texto;   
                                },
                                "targets": 3
                            },                            
                          




                ],            
              


                } );




//templates

        jQuery('#tabla_templates').DataTable( {
              "processing": true,
              "serverSide": true,
              "ajax": "/api/resultado_templates", //"scripts/server_processing.php"

              "pageLength": 10, //numeros de filas por paginas

              "language": {  //tratamiento de lenguaje
                   "url": "/plugins/dataTables-1.10.21/Plugins/i18n/"+idioma+".lang",
                },
               "columnDefs": [
                            
                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.id;
                                },
                                "targets": [0] 
                            },


                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.nombre;
                                },
                                "targets": [1] 
                            },

                             {
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                return `<div class="margin-bottom-5">

                                        <a href="/templates/${row.id}/editar"
                                         class="btn btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>


                                        <a href="/eliminar_template/${row.id}" class="btn btn-outline-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>                                        
                                </div>`;
                                return texto;   
                                },
                                "targets": 2
                            },
                          



                ],            
              


                } );






  jQuery('body').on('change', 'select#template_id', function(e){
        este = this;
        //console.log( jQuery(this).val() );
        template=jQuery(este).val();

            
            //cantidad = ( (parseInt($(this).val())>0) ? (parseInt($(this).val())) : 0);
            //id_producto =  ( $(this).attr('id_producto')  );

            jQuery.ajax({
                    url : '/templates/'+template+'/cargar',
                    data:{
                        cambio:0,
                    },
                    //esta clausula es obligatoria en laravel
                    headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
                    type : 'GET',
                    dataType : 'json',
                    success : function(data) {
                      
                      //console.log( data[0].preguntas);
                      dato='';
                        $.each( data[0].preguntas, function( key, value ) {
                          //console.log( 'Fase '+value.fase + ": " + value.nombre+ ": " + value.pivot.dia );

                          dato +=`<label class="form-check-inline">
                            Fase ${value.fase} :  ${value.nombre}:   <b>${value.pivot.dia}</b>
                          </label>    <br/>`;

                        });

                        
                        jQuery('#contenido_template').html(dato);


                         


                        //alert(  JSON.stringify(JSON.parse(data)) );
                    },
                    error : function(jqXHR, status, error) {
                        //
                    },
                    complete : function(jqXHR, status) {
                        
                    }
            }); 
            

      });  

      jQuery('select#template_id').trigger('change');
         




//preguntas

        jQuery('#tabla_preguntas').DataTable( {
              "processing": true,
              "serverSide": true,
              "ajax": "/api/resultado_preguntas", //"scripts/server_processing.php"

              "pageLength": 10, //numeros de filas por paginas

              "language": {  //tratamiento de lenguaje
                   "url": "/plugins/dataTables-1.10.21/Plugins/i18n/"+idioma+".lang",
                },
               "columnDefs": [
                            
                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.id;
                                },
                                "targets": [0] 
                            },


                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.fase;
                                },
                                "targets": [1] 
                            },


                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.nombre;
                                },
                                "targets": [2] 
                            },


                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.dia;
                                },
                                "targets": [3] 
                            },      
                             {
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                return `<div class="margin-bottom-5">

                                        <a href="/preguntas/${row.id}/editar"
                                         class="btn btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>


                                        <a href="/eliminar_pregunta/${row.id}" class="btn btn-outline-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>                                        
                                </div>`;
                                return texto;   
                                },
                                "targets": 4
                            },                                                                            


                ],            
              


                } );

//especialidads

        jQuery('#tabla_especialidads').DataTable( {
              "processing": true,
              "serverSide": true,
              "ajax": "/api/resultado_especialidads", //"scripts/server_processing.php"

              "pageLength": 10, //numeros de filas por paginas

              "language": {  //tratamiento de lenguaje
                   "url": "/plugins/dataTables-1.10.21/Plugins/i18n/"+idioma+".lang",
                },
               "columnDefs": [
                            
                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.id;
                                },
                                "targets": [0] 
                            },


                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.nombre;
                                },
                                "targets": [1] 
                            },


                             {
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                return `<div class="margin-bottom-5">

                                        <a href="/especialidads/${row.id}/editar"
                                         class="btn btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>


                                        <a href="/eliminar_especialidad/${row.id}" class="btn btn-outline-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>                                        
                                </div>`;
                                return texto;   
                                },
                                "targets": 2
                            },
                          

                           



                ],            
              


                } );


//nivels

        jQuery('#tabla_nivels').DataTable( {
              "processing": true,
              "serverSide": true,
              "ajax": "/api/resultado_nivels", //"scripts/server_processing.php"

              "pageLength": 10, //numeros de filas por paginas

              "language": {  //tratamiento de lenguaje
                   "url": "/plugins/dataTables-1.10.21/Plugins/i18n/"+idioma+".lang",
                },
               "columnDefs": [
                            
                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.id;
                                },
                                "targets": [0] 
                            },


                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.nombre;
                                },
                                "targets": [1] 
                            },

                             {
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                return `<div class="margin-bottom-5">

                                        <a href="/nivels/${row.id}/editar"
                                         class="btn btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>


                                        <a href="/eliminar_nivel/${row.id}" class="btn btn-outline-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>                                        
                                </div>`;
                                return texto;   
                                },
                                "targets": 2
                            },
                          




                ],            
              


                } );


//estados

        jQuery('#tabla_estados').DataTable( {
              "processing": true,
              "serverSide": true,
              "ajax": "/api/resultado_estados", //"scripts/server_processing.php"

              "pageLength": 10, //numeros de filas por paginas

              "language": {  //tratamiento de lenguaje
                   "url": "/plugins/dataTables-1.10.21/Plugins/i18n/"+idioma+".lang",
                },
               "columnDefs": [
                            
                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.id;
                                },
                                "targets": [0] 
                            },


                            { 
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.nombre;
                                },
                                "targets": [1] 
                            },

                             {
                                "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                return `<div class="margin-bottom-5">

                                        <a href="/estados/${row.id}/editar"
                                         class="btn btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>


                                        <a href="/eliminar_estado/${row.id}" class="btn btn-outline-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>                                        
                                </div>`;
                                return texto;   
                                },
                                "targets": 2
                            },                            

                          




                ],            
              


                } );










////////////////////////cargar modal dinamica para imagenes y ver con lupa///////
 
    $('body').on('click', '.modal_imagen[data-toggle="modal"]', function(e){




            este = $(this);

        jQuery.ajax({                 
            url : este.data("remoto"),                 
            /*data:{                     
                    condiciones:condiciones, //JSON.stringify((condiciones)) 
                        //JSON.stringify(JSON.parse(condiciones)) 
                 },*/    
            headers: {
                    //'{{ csrf_token()}}' 
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },                
            type : 'GET',                 
            //dataType : 'json',                 
            success : function(data) {       
                    $(este.data("target")+' .modal-content').html(data) ;
                        //alert(data);
                       setTimeout(function(){  //este delay esta porq a veces demora la carga de la imagen
                            img = jQuery('#imageTOzoom')[0];
                              
                              var width = img.clientWidth;
                              var height = img.clientHeight;

                              
                               
                              //if ((width*height)<136080) {return};
                              if ((width*height)<10000) {return};


                               jQuery("#imageTOzoom").mlens(
                                {
                                    imgSrc: jQuery("#imageTOzoom").attr("data-big"),   // path of the hi-res version of the image
                                    lensShape: "circle",                // shape of the lens (circle/square)
                                    lensSize: 380,                  // size of the lens (in px)
                                    borderSize: 4,                  // size of the lens border (in px)
                                    borderColor: "#fff",                // color of the lens border (#hex)
                                    borderRadius: 0,                // border radius (optional, only if the shape is square)
                                    imgOverlay: jQuery("#imageTOzoom").attr("data-overlay"), // path of the overlay image (optional)
                                    overlayAdapt: true // true if the overlay image has to adapt to the lens size (true/false)
                                });

                        }, 100);

                                             
                                         
                   

            },                 
            error : function(jqXHR, status, error) {                                      
                                                   },                 
            complete : function(jqXHR, status) {                                      
                                                }         
        }); 

    });



   //cuando oculta la modal
    jQuery('#modalMessage').on('hide.bs.modal', function(e) {
        jQuery(this).removeData('bs.modal');
    });    



//////////////////////////Cambiar las imagenes dentro de la modal/////////////////////

    $('body').on('click', '.cambio_imagen_modal', function(e){
        //console.log(  $(this) );
          este = $(this);
         jQuery.ajax({
                url :  este.attr("data-remoto"),  //'/cambio_imagen_modal/1',
                data:{
                     //"_token": "{{ csrf_token() }}",
                    id_imagen:este.attr("id_imagen")
                },
                //esta clausula es obligatoria en laravel
                headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},

                type : 'POST',
                dataType : 'json',
                success : function(data) {
                    
                    jQuery('#imageTOzoom').attr('src', "images/piezas/"+data.url ) ;
                    jQuery('#modal_imagen').attr('data-remoto', "images/piezas/"+data.url ) ;

                     activar_lupa();

                    //alert(  JSON.stringify(data.url) ); //JSON.stringify(JSON.parse(data)) 
                },
                error : function(jqXHR, status, error) {
                    //
                },
                complete : function(jqXHR, status) {
                    
                }
        }); 


    });

    function activar_lupa(number) {
             setTimeout(function(){  //este delay esta porq a veces demora la carga de la imagen
                  img = jQuery('#imageTOzoom')[0];
                    
                    var width = img.clientWidth;
                    var height = img.clientHeight;

                    
                     
                    //if ((width*height)<136080) {return};
                    if ((width*height)<10000) {return};


                     jQuery("#imageTOzoom").mlens(
                      {
                          imgSrc: jQuery("#imageTOzoom").attr("data-big"),   // path of the hi-res version of the image
                          lensShape: "circle",                // shape of the lens (circle/square)
                          lensSize: 380,                  // size of the lens (in px)
                          borderSize: 4,                  // size of the lens border (in px)
                          borderColor: "#fff",                // color of the lens border (#hex)
                          borderRadius: 0,                // border radius (optional, only if the shape is square)
                          imgOverlay: jQuery("#imageTOzoom").attr("data-overlay"), // path of the overlay image (optional)
                          overlayAdapt: true // true if the overlay image has to adapt to the lens size (true/false)
                      });

              }, 100);

      }


      /////////////////////////////////paginacion por ajax


    jQuery(document).on('click', '.pagination a', function(e){
          e.preventDefault();  //parar la accion del evento
          var num_page = $(this).attr('href').split('page=')[1];
          //var ruta ="http://autos.dev.com/";  //   /index
          var ruta ="/";  
          //console.log(num_page);
          jQuery.ajax({
                      url :  ruta,
                      data:{
                          page:num_page
                      },
                      headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
                      type : 'GET',
                      dataType : 'json',
                      success : function(data) {
                           //console.log(data); 
                          jQuery('#mi_galeria').html(data ) ;
                          //jQuery('#modal_imagen').attr('data-remoto', "images/piezas/"+data.url ) ;

                    
                      },
                      error : function(jqXHR, status, error) {
                          //
                      },
                      complete : function(jqXHR, status) {
                          
                      }
              });       

    });


    /////////////////////////////////buscador


    jQuery('body').on('click', '.buscar', function(e){
          e.preventDefault();  //parar la accion del evento

          var busqueda = $('#busqueda').val().split(' '); //.split('page=')[1];
          //console.log(busqueda);

          //return false;
          
          var ruta ="/buscar";  //   /index
          
          jQuery.ajax({
                      url :  ruta,
                      data:{
                          busqueda:busqueda
                      },
                      headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
                      type : 'GET',
                      dataType : 'json',
                      success : function(data) {
                           //console.log(data); 
                           jQuery('#mi_galeria').html(data ) ;
                          //jQuery('#mi_galeria').html(data ) ;
                          //jQuery('#modal_imagen').attr('data-remoto', "images/piezas/"+data.url ) ;

                    
                      },
                      error : function(jqXHR, status, error) {
                          //
                      },
                      complete : function(jqXHR, status) {
                          
                      }
              });       

    });


    ////////////////////////////////////////////carrito guardar a la cesta

    jQuery('body').on('click', '.agregar_cesta', function(e){

        if ( $('input').is(':focus') ) {
          return false;
        }
            //e.preventDefault();  //parar la accion del evento

            //cantCarProd
            //console.log( $(this).find('input').val()  );
            //console.log( $(this).attr('id_producto')  );
            //return false;

            cantidad =  ( (parseInt($(this).find('input').val())>0) ? (parseInt($(this).find('input').val())) : 1);
            id_producto =  ( $(this).attr('id_producto')  );
            

            jQuery.ajax({
                    url : '/session_producto',
                    data:{
                           cantidad:cantidad,
                        id_producto:id_producto
                    },
                    //esta clausula es obligatoria en laravel
                    headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},

                    type : 'POST',
                    dataType : 'json',
                    success : function(data) {
                      jQuery('#contenido_cesta').html(data.vista);
                      jQuery('#total_prod_carrito').html(data.total_prod_carrito);
                      jQuery('#importe').html(data.importe);
                      
                        // console.log(data);
                        //alert(  JSON.stringify(JSON.parse(data)) );
                    },
                    error : function(jqXHR, status, error) {
                        //
                    },
                    complete : function(jqXHR, status) {
                        
                    }
            }); 

      });      

///////////////////////////////////eliminar productos de la cesta

 jQuery('body').on('click', 'button.btn_eliminar', function(e){

        if ( $('input').is(':focus') ) {
          return false;
        }

            cantidad = -1* ( (parseInt($(this).parent().parent().find('input').val())>0) ? (parseInt($(this).parent().parent().find('input').val())) : 0);
            id_producto =  ( $(this).attr('id_producto')  );
            

            jQuery.ajax({
                    url : '/session_producto',
                    data:{
                           cantidad:cantidad,
                        id_producto:id_producto
                    },
                    //esta clausula es obligatoria en laravel
                    headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},

                    type : 'POST',
                    dataType : 'json',
                    success : function(data) {
                      jQuery('#contenido_cesta').html(data.vista);
                      jQuery('#total_prod_carrito').html(data.total_prod_carrito);
                      jQuery('#importe').html(data.importe);
                      
                        // console.log(data);
                        //alert(  JSON.stringify(JSON.parse(data)) );
                    },
                    error : function(jqXHR, status, error) {
                        //
                    },
                    complete : function(jqXHR, status) {
                        
                    }
            }); 

      });  





///////////////////////////////////cambiar cantidades



 jQuery('body').on('change', 'input.cantidad', function(e){

            cantidad = ( (parseInt($(this).val())>0) ? (parseInt($(this).val())) : 0);
            id_producto =  ( $(this).attr('id_producto')  );

            jQuery.ajax({
                    url : '/session_producto',
                    data:{
                           cantidad:cantidad,
                        id_producto:id_producto,
                        cambio:0,
                    },
                    //esta clausula es obligatoria en laravel
                    headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},

                    type : 'POST',
                    dataType : 'json',
                    success : function(data) {
                      jQuery('#contenido_cesta').html(data.vista);
                      jQuery('#total_prod_carrito').html(data.total_prod_carrito);
                      jQuery('#importe').html(data.importe);
                      
                        // console.log(data);
                        //alert(  JSON.stringify(JSON.parse(data)) );
                    },
                    error : function(jqXHR, status, error) {
                        //
                    },
                    complete : function(jqXHR, status) {
                        
                    }
            }); 

      });  



} );

