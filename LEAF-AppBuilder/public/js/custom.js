  //////////////////////////////////////////////////////////////////
 ////////////////       BOTONES + - SECCIONES    //////////////////
//////////////////////////////////////////////////////////////////
$(document).ready(function (){
    $('.increment-btn').click(function (e){
        e.preventDefault();

        var qty = $(this).closest(' .product-seccion').find(' .input-qty').val();
        //alert(qty);

        var value = parseInt(qty, 10);
        value     = isNaN(value) ? 0 : value;
        if(value < 10) // 10 es el maximo
        {
            value ++;
            //$(' .input-qty').val(value);
            $(this).closest(' .product-seccion').find(' .input-qty').val(value);
        }
    });

    $('.decrement-btn').click(function (e){
        e.preventDefault();

        var qty = $(this).closest(' .product-seccion').find(' .input-qty').val();
        //alert(qty);

        var value = parseInt(qty, 10);
        value     = isNaN(value) ? 0 : value;
        if(value > 0) // 10 es el maximo
        {
            value --;
            //$(' .input-qty').val(value);
            $(this).closest(' .product-seccion').find(' .input-qty').val(value);
        }
    });
});

$(document).ready(function (){
    $('.increment-btn').click(function (e){
        e.preventDefault();

        var qty = $(this).closest(' .product-embrague').find(' .input-qty').val();
        //alert(qty);

        var value = parseInt(qty, 24);
        value     = isNaN(value) ? 0 : value;
        if(value < 10) // 10 es el maximo
        {
            value ++;
            //$(' .input-qty').val(value);
            $(this).closest(' .product-embrague').find(' .input-qty').val(value);
        }
    });

    $('.decrement-btn').click(function (e){
        e.preventDefault();

        var qty = $(this).closest(' .product-embrague').find(' .input-qty').val();
        //alert(qty);

        var value = parseInt(qty, 24);
        value     = isNaN(value) ? 0 : value;
        if(value > 0) // 10 es el maximo
        {
            value --;
            //$(' .input-qty').val(value);
            $(this).closest(' .product-seccion').find(' .input-qty').val(value);
        }
    });
});
  //////////////////////////////////////////////////////////////////
 //////////////// BOTON SELECCIONAR TODOS TIPO DE SIEMBRA /////////
//////////////////////////////////////////////////////////////////
$('document').ready(function()
{
 $(".select-all").click(function () 
 {
  $('.chk-box').attr('checked', this.checked)
 });
  
 $(".chk-box").click(function()
 {
  if($(".chk-box").length == $(".chk-box:checked").length) 
  {
   $(".select-all").attr("checked", "checked");
  } 
  else 
  {
   $(".select-all").removeAttr("checked");
  }
 });
});
  //////////////////////////////////////////////////////////////////
 ////////////// BOTON SELECCIONAR TODOS TIPO DE SIEMBRA ///////////
//////////////////////////////////////////////////////////////////

$(document).ready(function() {
    $('.select-todos').click(function() {
        var checkboxes = $('.110rows').length;
        for(i = 1; i <= checkboxes; i++){
            var nombre = '#110-S' + i;
                $(nombre).attr('checked', this.checked)
        }
    })
});
  //////////////////////////////////////////////////////////////////
 //////////////// BOTON SELECCIONAR PAR TIPO DE SIEMBRA ///////////
//////////////////////////////////////////////////////////////////

$(document).ready(function() {
    $('.select-par').click(function() {
        var checkboxes = $('.110rows').length;
        for(i = 1; i <= checkboxes; i++){
            var nombre = '#110-S' + i;
            if(i % 2 == 0){
                $(nombre).attr('checked', this.checked)
            }
        }
    })
});
  //////////////////////////////////////////////////////////////////
 ////////////// BOTON SELECCIONAR IMPAR TIPO DE SIEMBRA ///////////
//////////////////////////////////////////////////////////////////

$(document).ready(function() {
    $('.select-impar').click(function() {
        var checkboxes = $('.110rows').length;
        for(i = 1; i <= checkboxes; i++){
            var nombre = '#110-S' + i;
            if(i % 2 != 0){
                $(nombre).attr('checked', this.checked)
            }
        }
    })
});

  //////////////////////////////////////////////////////////////////
 //////////////// BOTON CANTIDAD DE SENSORES POR LINEA    /////////
//////////////////////////////////////////////////////////////////
$('.increment-btn').click(function (a){
    a.preventDefault();

    var asd = $(this).closest(' .sensors-line').find(' .input-line').val();
    //alert(qty);

    var value = parseInt(asd, 3);
    value     = isNaN(value) ? 0 : value;
    if(value <= 3) // 10 es el maximo
    {
        value ++;
        //$(' .input-qty').val(value);
        $(this).closest(' .sensors-line').find(' .input-line').val(value);
    }
});

$('.decrement-btn').click(function (a){
    a.preventDefault();

    var asd = $(this).closest(' .sensors-line').find(' .input-line').val();
    //alert(qty);

    var value = parseInt(asd, 4);
    value     = isNaN(value) ? 1 : value;
    if(value > 1) // 10 es el maximo
    {
        value --;
        //$(' .input-qty').val(value);
        $(this).closest(' .sensors-line').find(' .input-line').val(value);
    }
});

var switchStatus = false;
$( '#icsflex').on( 'change', function() {
if( $(this).is(':checked') ){
  $(this).attr('value','true');
  switchStatus = $(this).is(':checked');
  // Hacer algo si el checkbox ha sido seleccionado
  //alert("El checkbox con valor ");
} else {
  switchStatus = $(this).is(':checked');
  // Hacer algo si el checkbox ha sido deseleccionado
  //alert("El checkbox NO valor ");
}
});