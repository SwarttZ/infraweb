$(document).ready(function() {

    $(".btn-success").click(function() {
        var html = $(".clone").html();
        $(".increment").after(html);
    });

    $("body").on("click", ".btn-danger", function() {
        $(this).parents(".control-group").remove();
    });
});

function taginTag(query) {
    var dados = new Tagin(query);
    return dados;
}

var Programas = document.querySelector('#programasInstalados');
var SistemasQs = document.querySelector('#sistemasQs');
var hd_primario = document.querySelector('#hd_primario');
var hd_secundario = document.querySelector('#hd_secundario');

taginTag(Programas);
taginTag(SistemasQs);
taginTag(hd_primario);
taginTag(hd_secundario);

function checkbox() {
    if ($('.externa').is(':checked')) {
        $('.interna').prop('checked', false);
    }


    if ($('.externa').is(':checked') && $('.interna').is(':checked')) {

        $('.externa').prop('checked', false);
        $('.interna').prop('checked', false);

        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Ação invalida! só é possível marcar rede interna ou externa',
            toast: true,
            footer: '<a href="#">Documentação?</a>'
        });
    }
}