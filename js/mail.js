function loadEmails(request) {
    $.ajax({
        url: "/php/mail_carregar.php",
        data: {
            request: request == null ? " " : request
        },
        type: "POST",
        dataType: "json",
        success: function(resposta) {
            $("#inbox").html("");
            if (resposta[0].erro) {
                $("h2").html(resposta[0].erro);
            } else {
                var itens = '';
                for (var i = 0; i < resposta.length; i++) {
                    var response = JSON.parse(resposta[i]);
                    itens += "<li id=" + response['@attributes']['id'] + " class='mail list-group-item text-left d-xl-flex justify-content-xl-start align-items-xl-center'>";
                    itens += "<i class='far fa-user-circle'></i>"
                    itens += "<span class='e-mail'>" + response['de'] + "</span>";
                    itens += "<span class='assunto text-nowrap'>" + 'Assunto: ' + response['assunto'] + "</span>";
                    itens += "<span class='preview text-nowrap text-truncate'>" + response['texto'] + "</span>";
                    itens += "<div class='flex-fill'></div>";
                    if (request != "favoritos" && request != "excluidos") itens += "<button type='button' onclick='favoriteEmail(" + response['@attributes']['id'] + ")' class='trash'>";
                    if (request != "favoritos" && request != "excluidos") itens += "<i class='fa fa-star'></i>";
                    if (request != "favoritos" && request != "excluidos") itens += "</button>";
                    if (request != "excluidos") itens += "<button type='button' onclick='excludeEmail(" + response['@attributes']['id'] + ")' class='trash'>";
                    if (request != "excluidos") itens += "<i class='fas fa-trash-alt'></i>";
                    if (request != "excluidos") itens += "</button>";
                    itens += "</li>";
                }
                $("#inbox").html(itens);
            }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert("Algo de errado com o xml.");
        }
    });
}

function excludeEmail(id) {
    $.ajax({
        url: "/php/exclude.php",
        dataType: "json",
        type: "POST",
        data: {
            emailToExclude: id,
        },
        success: function(resposta) {
            loadEmails();
        },
        error: function(xhr, ajaxOptions, thrownError) {
            console.log(thrownError);
            alert("Não foi possível excluir o email.");
        }
    });
}

function archiveEmail(id) {
    $.ajax({
        url: "/php/archive.php",
        dataType: "json",
        type: "POST",
        data: {
            emailToArchive: id,
        },
        success: function(resposta) {

        },
        error: function(xhr, ajaxOptions, thrownError) {
            console.log(thrownError);
            alert("Não foi possível arquivar o email.");
        }
    });
}

function favoriteEmail(id) {
    $.ajax({
        url: "/php/favorite.php",
        dataType: "json",
        type: "POST",
        data: {
            emailToFavorite: id,
        },
        success: function(resposta) {

        },
        error: function(xhr, ajaxOptions, thrownError) {
            console.log(thrownError);
            alert("Não foi possível favoritar o email.");
        }
    });
}

function draftEmail(para, cc, assunto, mensagem) {
    $.ajax({
        url: "/php/draft.php",
        dataType: "json",
        type: "POST",
        data: {
            para: para,
            cc: cc,
            assunto: assunto,
            texto: mensagem
        },
        success: function(resposta) {

        },
        error: function(xhr, ajaxOptions, thrownError) {
            console.log(thrownError);
            alert("Não foi possível rascunhar o email.");
        }
    });
}

function searchMail(texto) {
    $.ajax({
        url: "/php/search.php",
        data: {
            search: texto,
        },
        type: "POST",
        dataType: "json",
        success: function(resposta) {
            $("#inbox").html("");
            if (resposta[0].erro) {
                $("h2").html(resposta[0].erro);
            } else {
                var itens = '';
                for (var i = 0; i < resposta.length; i++) {
                    var response = JSON.parse(resposta[i]);
                    itens += "<li id=" + response['@attributes']['id'] + " class='mail list-group-item text-left d-xl-flex justify-content-xl-start align-items-xl-center'>";
                    itens += "<i class='far fa-user-circle'></i>"
                    itens += "<span class='e-mail'>" + response['de'] + "</span>";
                    itens += "<span class='assunto text-nowrap'>" + 'Assunto: ' + response['assunto'] + "</span>";
                    itens += "<span class='preview text-nowrap text-truncate'>" + response['texto'] + "</span>";
                    itens += "<div class='flex-fill'></div>";
                    itens += "<button type='button' onclick='favoriteEmail(" + response['@attributes']['id'] + ")' class='trash'>";
                    itens += "<i class='fa fa-star'></i>";
                    itens += "</button>";
                    itens += "<button type='button' onclick='excludeEmail(" + response['@attributes']['id'] + ")' class='trash'>";
                    itens += "<i class='fas fa-trash-alt'></i>";
                    itens += "</li>";
                }
                $("#inbox").html(itens);
            }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert("Algo de errado com o xml.");
        }
    });
}

$(document).ready(function() {
    loadEmails();
    $("#search").keyup(function() {
        var text = $(this).val();
        if (text != '') {
            searchMail(text);
        } else loadEmails();
    })

    $("#sair").click(function(e) {
        var sair = true;
        e.preventDefault();
        $.ajax({
            url: '/php/sair.php',
            type: "GET",
            success: function(response) { //response is value returned from php (for your example it's "bye bye"
                window.location.pathname = 'index.html';
            },
            error: function(xhr, ajaxOptions, thrownError) {
                window.location.pathname = 'index.html';
            }
        });
    })

    $('.modal').modal('hide');

    $('#caixa-entrada').click(function(e) {
        e.preventDefault();
        loadEmails();
    })

    $('#enviar').click(function(e) {
        e.preventDefault();
        var para = $("#para").val();
        var cc = $("#cc").val();
        var assunto = $("#assunto").val();
        var mensagem = $("#mensagem").val();
        $.post(
            window.location.origin + window.location.pathname.replace("/mail/", "/php/mail.php"), {
                para: para,
                cc: cc,
                assunto: assunto,
                texto: mensagem
            },
            function(data, textStatus, jqXHR) {
                if (data) {
                    alert("Email enviado com sucesso!");
                    setTimeout(1000);
                    $(location).attr('href', '/mail/index.html')
                }
            },
        )
    });

    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
        $("#page-content-wrapper").toggleClass("col-12");
    });

    $("#favoritos").click(function(e) {
        e.preventDefault();
        $("#caixa").html("Favoritos");
        loadEmails("favoritos");
    });

    $("#caixa-entrada").click(function(e) {
        e.preventDefault();
        $("#caixa").html("Caixa de Entrada");
        loadEmails();
    });

    $("#lixo").click(function(e) {
        e.preventDefault();
        $("#caixa").html("Lixo Eletrônico");
    });

    $("#rascunho").click(function(e) {
        e.preventDefault();
        $("#caixa").html("Rascunho");
        loadEmails("rascunho");
    });

    $("#enviados").click(function(e) {
        e.preventDefault();
        $("#caixa").html("Itens Enviados");
        loadEmails("enviados");
    });

    $("#excluidos").click(function(e) {
        e.preventDefault();
        $("#caixa").html("Itens Excluidos");
        loadEmails("excluidos");
    });

    $("#morto").click(function(e) {
        e.preventDefault();
        $("#caixa").html("Arquivo Morto");
    });

    // Salvar rascunho
    // $('#ModalNovaMensagem').on('hidden.bs.modal', function () {
    //    var tempEmail = [$('#para').val(), $('#cc').val(), $('#assunto').val(), $('#mensagem').val()];
    //    console.log(tempEmail);
    //    if (tempEmail[0] != null && tempEmail[1] != null && tempEmail[2] != null && tempEmail[3] != null) {
    //       $.ajax({
    //          type: "POST",
    //          url: "../php/save_draft.php",
    //          data: {
    //             para: tempEmail[0],
    //             cc: tempEmail[1],
    //             assunto: tempEmail[2],
    //             texto: tempEmail[3]
    //          },
    //          dataType: "dataType",
    //          success: function (response) {
    //             alert('Rascunho salvo!');
    //          }
    //       });
    //       tempEmail = [];
    //    }
    // });

});