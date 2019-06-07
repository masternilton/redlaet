$(document).on("submit","#form_rest_password",function(e){
    e.preventDefault();
    $('.preloader').fadeIn();
    var quien=$(this).attr("id");
    var formu=$(this);
    var varurl;
    varurl=$(this).attr("action");

    $(".preleader").fadeIn();

    $.ajax({
        // la URL para la petición
        url : varurl,
        data : formu.serialize(),
        method : 'POST',
        cache: false,
        processData: false



    }).done(function(resul){

        $('.preloader').fadeOut();
        if(resul.estado=="enviado"){
            swal("Correo enviado", "Se han enviado los datos de ingreso a su correo", "success");
        }


    })
    .fail( function (jqXHR, status, error) {
            $('.preloader').fadeOut();
            swal("No encontrado", "no se ha encontrado el email en nuestros registros", "warning");
    });


});