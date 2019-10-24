$(document).ready(function () {
   // $('.modal').modal('hide');
   $('#caixa-entrada').click(function (e) {  
      e.preventDefault();
      $.ajax({
         url: "/php/mail_carregar.php",
         dataType: "json",
         success: function (resposta) {
            if (resposta[0].erro) {
               $("h2").html(resposta[0].erro);
            }else{
               for(var i = 0; i<resposta.length; i++){
                  itens += "<li>";
                  itens += "<span>" + resposta[i].de + "</span>";
                  itens += "<span>" + resposta[i].assunto + "</span>";
                  itens += "<span>" + resposta[i].texto + "</span>";
                  itens += "</li>";
               }
               $("#minha-lista tbody").html(itens);
            }
         },
         error: function (xhr, ajaxOptions, thrownError) {
            alert("Algo de errado com o xml.");
         }
      });
   })
   $('#enviar').click(function (e) {
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
         function (data, textStatus, jqXHR) {
            if(data){
               alert("Email enviado com sucesso!");
               setTimeout(1000);
               $(location).attr('href', '/mail/index.html')
            }
         },
      )
   });

   $("#menu-toggle").click(function (e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
      $("#page-content-wrapper").toggleClass("col-12");
   });

});