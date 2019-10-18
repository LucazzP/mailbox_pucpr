$(document).ready(function () {
    $('#btn-register').click(function (e) {
        $('#formId').submit(function(e){
            var json = ConvertFormToJSON("#formId");
            var Form = this;
            alert(JSON.stringify(json));
            alert(JSON.stringify($(Form).serialize()));
            alert(JSON.stringify($(Form).serializeArray()));
            alert(json);

            e.preventDefault();
        })

        e.preventDefault();
        // window.location.href = 'pages/mail.html';
    });
    function ConvertFormToJSON(form){
        console.log('Convertendo form para json');
        var array = jQuery(form).serializeArray();
        var json = {};
        
        jQuery.each(array, function () {
            json[this.nome] = this.value || '';
        });

        console.log('JSON: '+json);
        return json;
    }
});