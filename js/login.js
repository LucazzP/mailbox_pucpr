$(document).ready(function () {
   $('#btn-entrar').click(function (e) {
      e.preventDefault();
      $.ajax({
         type: "POST",
         dataType: "json",
         url: "/php/login.php",
         data: {
            email: $("#email").val(),
            senha: $("#password").val()
         },
         success: function (resposta) {
            if (resposta) {
               console.log("Usuário Logado com sucesso!")
               window.location.pathname = '/mail/index.html';
            }
         },
         error: function (xhr, ajaxOptions, thrownError) {
            alert("Usuário ou senha incorretos, digite novamente.");
         }
      });
      return false;
   });
});
