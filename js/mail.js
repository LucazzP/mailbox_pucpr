$(document).ready(function () {

   $('#btn-new-email').click(function (e) {
      e.preventDefault();
      $.post(
         "../php/mail.php", {
            de: "lucas@gmail.com",
            para: "renan@gmail.com",
            cc: "pedrinho@gmail.com",
            assunto: "O lincon eh viado",
            texto: "eh mesmo"
         },
         function (data, textStatus, jqXHR) {
            alert(data);
         },
      )
   });

});

$("#menu-toggle").click(function (e) {
   e.preventDefault();
   $("#wrapper").toggleClass("toggled");
   $("#page-content-wrapper").toggleClass("col-12");
});
