$(document).ready(function(){

    $("#adicionar").click(function(){
        var idproduto = $('input[name="idprod"]').val();

        $.ajax({
            url: 'ajax/carrinho.php',
            type: 'POST',
            data: 'produto='+idproduto+'&acao="add"',
            dataType: 'json',
            beforeSend: function(){

            },

            success: function(data){
                console.log(data);
            }

        });

    });


});