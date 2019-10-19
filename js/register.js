$(document).ready(function(){

    $("#btn-register").click(function(e){
        e.preventDefault();
        var email = $("#email").val();
        var senha = $("#password").val();
        var senha2 = $("#password-again").val();

        function testeEmail(email) {
            var RegExp = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return RegExp.test(email);
        }
        if(testeEmail(email)){
            if(senha == senha2){
                $.post(
                    "http://" + window.location.host + "/mailbox_pucpr/php/register.php", 
                    {
                        email: email,
                        senha: senha2
                    },
                    function (data, textStatus, jqXHR) {
                        alert(data);
                        alert("Usuario cadastrado com sucesso");
                    },
                )
            }else{
                alert("Senhas diferentes, digite novamente");
            }
        }else{
            alert("Email não valido, digite novamente");
        }
        
    })
});