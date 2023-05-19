function gravaGenero(codigo, descricao, ativo) {
    $.ajax({
        url: 'js/sqlscopegeneroFuncionario.php',
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: { funcao: "gravar", codigo: codigo, descricao: descricao, ativo: ativo }, //valores enviados ao script
        beforeSend: function () {
            //função chamada antes de realizar o ajax
        },
        complete: function () {
            ss
            //função executada depois de terminar o ajax
        },
        ///////////////////////////////////////////////////
        success: function (data, textStatus) {
            if (data.indexOf('sucess') < 0) {
                var piece = data.split("#");
                var mensagem = piece[1];
                if (mensagem !== "") {
                    smartAlert("Atenção", mensagem, "error");
                } else {
                    smartAlert("Sucesso", "Operação realizada com sucesso!", "success");
                    voltar();
                }

                return '';
            }
            ////////////////////////////////////////
            //retorno dos dados
        },
        error: function (xhr, er) {
            //tratamento de erro
        }
    });
    return '';

}



function generoVerificado(descricao) {
    $.ajax({
        url: 'js/sqlscopegeneroFuncionario.php',
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: { funcao: "verificaGenero", descricao: descricao }, //valores enviados ao script
        success: function (data, textStatus) {
            // if (data.indexOf('success') > -1) {
                var piece = data.split("#");
                var mensagem = piece[1];
                if (piece[0] === "success") {
                    smartAlert("Sucesso", "Operação realizada com sucesso!", "success");
                    return;
                }
                else {
                    mensagem = "Genero já registrado.";
                    smartAlert("Atenção", mensagem, "error");
                    document.getElementById('descricao').value = "";
                    $("#descricao").focus();
                    return;
                }
            // }
            ////////////////////////////////////////
            //retorno dos dados
        },
        error: function (xhr, er) {
            //tratamento de erro
            console.log(xhr, er)
        }
    });
    return '';
}

function recupera(id, callback) {
    $.ajax({
        url: 'js/sqlscopegeneroFuncionario.php', //caminho do arquivo a ser executado
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: { funcao: 'recuperaFuncionario', id: id }, //valores enviados ao script      
        success: function (data) {
            callback(data);
        }
    });
}

function excluirGenero(id) {
    $.ajax({
        url: 'js/sqlscopegeneroFuncionario.php', //caminho do arquivo a ser executado
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: { funcao: 'excluir', id: id }, //valores enviados ao script     
        success: function (data, textStatus) {
            if (textStatus === 'success') {
                smartAlert("Sucesso", "Operação realizada com sucesso!", "success");
                novo();
            } else {
                smartAlert("Atenção", "Operação não realizada - entre em contato com a GIR!", "error");
            }
        }, error: function (xhr, er) {
            console.log(xhr, er);
        }
    });
}