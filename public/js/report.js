$(document).ready(function () {            
    $(".precio").each(function() {
        var html = format($(this).html());
        $(this).html(html);
    });

    $(".total").each(function() {
        var html = format($(this).html());
        $(this).html(html);
    });

    var html = format($('#viatico').html());
    $('#viatico').html(html);
    html = format($('#sumatoria').html());
    $('#sumatoria').html(html);
    html = format($('#descuento').html());
    $('#descuento').html(html);
    html = format($('#subtotal').html());
    $('#subtotal').html(html);
    html = format($('#impuesto').html());
    $('#impuesto').html(html);
    html = format($('#total').html());
    $('#total').html(html);
});

function format(input)
{
    console.log(input);
    var num = input.replace(/\./g,'');
    if(!isNaN(num)) {
        num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
        num = num.split('').reverse().join('').replace(/^[\.]/,'');
        return num
    }	  
    else { 
        alert('Solo se permiten numeros');
        input.value = input.value.replace(/[^\d\.]*/g,'');
    }
}