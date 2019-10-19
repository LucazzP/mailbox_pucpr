$(document).ready(function() {
    $('#btn-entrar').click(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "/mailbox_pucpr/php/login.php",
            data: {
                email: $("#email").val(),
                senha: $("#password").val()
            },
            success: function(resposta) {
                if (resposta) {
                    alert("Usuario Logado com sucesso!")
                    window.location.pathname = '/mail';
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert("Usuario ou senha incorretos, por favro cadastre-se")
            }
        });
    });
});