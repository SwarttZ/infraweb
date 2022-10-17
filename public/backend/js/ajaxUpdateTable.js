function atualizaTabela() {
    $('#formUpdateTable').submit(function(e) {
        e.preventDefault();

        $.ajaxSetup({
            beforeSend: function(xhr, type) {
                if (!type.crossDomain) {
                    xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                }
            },
        });

        $.ajax({
            url: '/dashboard/error/list/backups',
            dataType: 'json',
            method: 'GET',
            beforeSend: function() {
                $('#loader').show();
            },
            complete: function() {
                $('#loader').hide();
            },
            success: function(result) {
                if (result.resultado === true) {

                    Swal.fire({
                        icon: 'success',
                        title: 'Backup...',
                        text: 'Tabela de backups atualizada com sucesso!',
                        toast: true,
                        footer: 'Quality Sistemas'
                    })
                    location.reload(true);
                } else {

                    Swal.fire({
                        icon: 'error',
                        title: 'Opss...',
                        text: 'Não foi possivel atualizar a tabela!',
                        toast: true,
                        footer: 'Quality Sistemas'
                    })
                }


            },
        });
    });
}

function carregaBancosCorrompidos() {
    $('#formCorrompidos').submit(function(e) {
        e.preventDefault();

        $.ajaxSetup({
            beforeSend: function(xhr, type) {
                if (!type.crossDomain) {
                    xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                }
            },
        });
        var data = $('data').val();
        $.ajax({
            url: '/dashboard/error/backups/corrompidos/' + data,
            dataType: 'json',
            method: 'GET',
            beforeSend: function() {
                $('#loader').show();
            },
            complete: function() {
                $('#loader').hide();
            },
            success: function(result) {
                if (result.resultado === true) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Backup...',
                        text: 'Tabela de backups corrompidos carregada com sucesso!',
                        toast: true,
                        footer: 'Quality Sistemas'
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Opss...',
                        text: 'Nenhum banco corrompido identificado!',
                        toast: true,
                        footer: 'Quality Sistemas'
                    })
                }
            },
        });
    });
}