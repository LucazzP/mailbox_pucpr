$(document).ready(function() {
    $('#btn-entrar').click(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "/php/login.php",
            data: {
                email: $("#email").val(),
                senha: $("#password").val()
            },
            success: function(resposta) {
                if (resposta) {
                    window.location.href = '/mail';
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert("Usuario ou senha incorretos, por favor cadastre-se")
            }
        });
        return false;
    });
});