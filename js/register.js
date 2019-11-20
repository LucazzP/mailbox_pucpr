$(document).ready(function() {

  $("#btn-register").click(function(e) {
    e.preventDefault();
    var email = $("#email").val();
    var senha = $("#password").val();
    var senha2 = $("#password-again").val();

    function testeEmail(email) {
      var RegExp = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      return RegExp.test(email);
    };
    if (testeEmail(email)) {
      if (senha == senha2) {
        $.post(
          window.location.origin + window.location.pathname.replace("/register/index.html", "/php/register.php"), {
            email: email,
            senha: senha2
          },
          function(data, textStatus, jqXHR) {
            //Login
            $.ajax({
              type: "POST",
              dataType: "json",
              url: "../php/login.php",
              data: {
                email: email,
                senha: senha
              },
              success: function(resposta) {
                if (resposta) {
                  window.location.href = '../mail';
                }
              },
            });
          },
        )
      } else {
        alert("Senhas diferentes, digite novamente.");
      }
    } else {
      alert("E-mail inválido, digite novamente.");
    };

  });
});