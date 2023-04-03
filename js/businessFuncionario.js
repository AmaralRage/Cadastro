function gravaFuncionario(id, ativo, nome, cpf, genero,Cargo, PossuiFilhos, dataNascimento) {
    $.ajax({ 
        url: 'js/sqlscopeFuncionario.php',
        type: 'post',
        dataType:"html",
        data: {funcao: "grava", id:id, ativo:ativo, nome:nome, cpf:cpf, genero:genero,Cargo:Cargo, PossuiFilhos:PossuiFilhos, dataNascimento:dataNascimento},
        
        success: function (data, textStatus) {
            if (data.trim() === 'success') {
                smartAlert("Sucesso", "Operação realizada com sucesso!", "success"); 
                voltar();
            } else {
                smartAlert("Atenção", "Operação não realizada - entre em contato com a GIR!", "error");
            }
        }, error: function (xhr, er) {
            console.log(xhr, er);
        }
    });
}
function validaCPF(id, cpf) {
    $.ajax({ 
        url: 'js/sqlscopeFuncionario.php',
        type: 'post',
        dataType:"html",
        data: {funcao: "validaCPF", id:id, cpf:cpf},
        
        success: function (data, textStatus) {  
            if (data.trim() === 'success') {
                smartAlert("Sucesso", "Operação realizada com sucesso!", "success"); 
            } else {
                smartAlert("Atenção", "CPF Inválido", "error");
                document.getElementById('cpf').value = "";
            }
        }, error: function (xhr, er) {
            console.log(xhr, er);
        }
    });
}

function cpfverificado(cpf) {
    $.ajax({
        url: 'js/sqlscopeCadastroFuncionario.php',
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: { funcao: "VerificaCPF", cpf: cpf }, //valores enviados ao script
        beforeSend: function () {
            //função chamada antes de realizar o ajax
        },
        complete: function () {
            //função executada depois de terminar o ajax
        },
        success: function (data, textStatus) {
            if (data.indexOf('success') < 0) {
                var piece = data.split("#");
                var mensagem = piece[1];
                if (piece[0] === "success") {
                    smartAlert("Sucesso", "Operação realizada com sucesso!", "success");
                    return;
                }
                else {
                    mensagem ="Opa! CPF já registrado.";
                    smartAlert("Atenção", mensagem, "error");
                    return;
                }
            }
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
        url: 'js/sqlscopeFuncionario.php', //caminho do arquivo a ser executado
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: {funcao: 'recuperaFuncionario', id: id}, //valores enviados ao script      
        success: function (data) {
            callback(data); 
        }
    });
}

function excluirUsuario(id) {
    $.ajax({
        url: 'js/sqlscopeFuncionario.php', //caminho do arquivo a ser executado
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: {funcao: 'excluir', id: id}, //valores enviados ao script     
        success: function (data, textStatus) { 
            if (textStatus === 'success') {
                smartAlert("Sucesso", "Operação realizada com sucesso!", "success"); 
               voltar();
            } else {
                smartAlert("Atenção", "Operação não realizada - entre em contato com a GIR!", "error");
            }
        }, error: function (xhr, er) {
            console.log(xhr, er);
        }
    });
}
