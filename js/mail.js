function loadEmails() {
    $.ajax({
        url: "/php/mail_carregar.php",
        dataType: "json",
        success: function(resposta) {
            if (resposta[0].erro) {
                $("h2").html(resposta[0].erro);
            } else {
                var itens = '';
                for (var i = 0; i < resposta.length; i++) {
                    var response = JSON.parse(resposta[i]);
                    itens += "<li class='mail list-group-item text-left d-xl-flex justify-content-xl-start align-items-xl-center'>";
                    itens += "<i class='far fa-user-circle'></i>"
                    itens += "<span class='e-mail'>" + response['de'] + "</span>";
                    itens += "<span class='assunto text-nowrap'>" + 'Assunto: ' + response['assunto'] + "</span>";
                    itens += "<span class='preview text-nowrap text-truncate'>" + response['texto'] + "</span>";
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
        // $('.modal').modal('hide');
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
            "http://" + window.location.host + "/php/mail.php", {
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

    });

    $("#caixa-entrada").click(function(e) {
        e.preventDefault();
        $("#caixa").html("Caixa de Entrada");

    });

    $("#lixo").click(function(e) {
        e.preventDefault();
        $("#caixa").html("Lixo Eletrônico");

    });

    $("#rascunho").click(function(e) {
        e.preventDefault();
        $("#caixa").html("Rascunho");

    });

    $("#enviados").click(function(e) {
        e.preventDefault();
        $("#caixa").html("Itens Enviados");

    });

    $("#excluidos").click(function(e) {
        e.preventDefault();
        $("#caixa").html("Itens Excluidos");

    });

    $("#morto").click(function(e) {
        e.preventDefault();
        $("#caixa").html("Arquivo Morto");

    });


});