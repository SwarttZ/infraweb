function carregaTabela() {
    $('#formUpdate').submit(function(e) {
        e.preventDefault();

        $.ajaxSetup({
            beforeSend: function(xhr, type) {
                if (!type.crossDomain) {
                    xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                }
            },
        });

        $.ajax({
            url: '/error/backup/list',
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
                        //location.reload(true);
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

function apagar() {
    $('#formApagar').submit(function(e) {
        e.preventDefault();

        $.ajaxSetup({
            beforeSend: function(xhr, type) {
                if (!type.crossDomain) {
                    xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                }
            },
        });


        $.ajax({
            url: '/error/backup/delete',
            dataType: 'json',
            method: 'GET',
            beforeSend: function() {
                $('#loader').show();
            },
            complete: function() {
                $('#loader').hide();
            },
            success: function(result) {
                if (result === true) {

                    Swal.fire({
                        icon: 'success',
                        title: 'Backup...',
                        text: 'Tabela deletada com sucesso mostrando apenas erros da data de hoje!',
                        toast: true,
                        footer: 'Quality Sistemas'
                    })
                    location.reload(true);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Opss...',
                        text: 'Não foi possível deletar a tabela!',
                        toast: true,
                        footer: 'Quality Sistemas'
                    })
                }
            },
        });
    });
}

function updateTable() {
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
            url: '/error/backup/update',
            dataType: 'json',
            method: 'GET',
            beforeSend: function() {
                $('#loader').show();
            },
            complete: function() {
                $('#loader').hide();
            },
            success: function(result) {
                if (result === true) {

                    Swal.fire({
                        icon: 'success',
                        title: 'Backup...',
                        text: 'Tabela atualizada!',
                        toast: true,
                        footer: 'Quality Sistemas'
                    })
                    location.reload(true);
                } else {

                    Swal.fire({
                        icon: 'error',
                        title: 'Opss...',
                        text: 'Não foi possível atualziar!',
                        toast: true,
                        footer: 'Quality Sistemas'
                    })
                }
            },
        });
    });
}