$(document).ready(function () {
   $('#btn-entrar').click(function (e) {
      e.preventDefault();
      $.ajax({
         type: "POST",
         dataType: "json",
         url: "/mailbox_pucpr/php/login.php",
         data: {
            email: $("#email").val(),
            senha: $("#password").val()
         },
         success: function (resposta) {
            if (resposta) {
               alert("Usuário Logado com sucesso!")
               window.location.pathname = '/mailbox_pucpr/mail/index.html';
            }
         },
         error: function (xhr, ajaxOptions, thrownError) {
            alert("Usuário ou senha incorretos, digite novamente.");
         }
      });
      return false;
   });
});
