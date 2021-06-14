function gravaEntradaItem(formData) {
    formData.append('funcao', 'grava');
    $.ajax({ 
        url: 'js/sqlscope_cadastroEntradaItem.php',
        type: 'post',
        data: formData,
        processData: false,
        contentType: false,
        success: function (data, textStatus) {
            if (data.trim() === 'success') {
                smartAlert("Sucesso", "Operação realizada com sucesso!", "success"); 
                voltar(); 
            } else {
                $("#btnGravar").attr('disabled', false);
                smartAlert("Atenção", "Operação não realizada - entre em contato com a GIR!", "error"); 
            }
        }, error: function (xhr, er) {
            console.log(xhr, er);
        }
    }); 
}

function recuperaEntradaItem(codigo, callback) {
    $.ajax({
        url: 'js/sqlscope_cadastroEntradaItem.php',
        dataType: 'html', 
        type: 'post',
        data: {funcao: 'recupera', codigo: codigo},      
        success: function (data) {
            callback(data); 
        }
    });
}

function recuperaDescricaoCodigo(codigo, callback) {
    $.ajax({
        url: 'js/sqlscope_cadastroEntradaItem.php',
        dataType: 'html', 
        type: 'post',
        data: {funcao: 'recuperaDescricaoCodigo', codigo: codigo},      
        success: function (data) {
            callback(data); 
        }
    });
}

function populaComboEstoque(unidadeDestino, callback) {
    $.ajax({
        url: 'js/sqlscope_cadastroEntradaItem.php', //caminho do arquivo a ser executado
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: { funcao: 'populaComboEstoque', unidadeDestino: unidadeDestino }, //valores enviados ao script     
        async: false,
        success: function (data) {
            callback(data);
        }

    });

    return;
}

function recuperaFornecedorObrigatorio(callback) {
    $.ajax({
        url: 'js/sqlscope_cadastroEntradaItem.php',
        dataType: 'html', 
        type: 'post',
        data: {funcao: 'recuperaFornecedorObrigatorio'},      
        success: function (data) {
            callback(data); 
        }
    });
}

function excluirEntradaItem(codigo, xmlNotaPath, callback) {
    $.ajax({
        url: 'js/sqlscope_cadastroEntradaItem.php', 
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: {funcao: 'excluir', codigo: codigo, xmlNotaPath:xmlNotaPath}, //valores enviados ao script   
        success: function (data, textStatus) {
            if (data.indexOf('sucess') < 0) {
                var piece = data.split("#");
                var mensagem = piece[1];
                if (mensagem !== "") {
                    smartAlert("Atenção", mensagem, "error");
                } else {
                    smartAlert("Atenção", "Operação não realizada - entre em contato com a GIR!", "error");
                }

                return '';
            } else {
                smartAlert("Sucesso", "Operação realizada com sucesso!", "success");
                novo();
            }
        }, error: function (xhr, er) {
            console.log(xhr, er);
        }
    }); 
}