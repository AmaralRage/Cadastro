function gravaFuncionario(id, ativo,
    nome,
    cpf,
    rg,
    genero,
    estadoCivil,
    dataNascimento,
    cep,
    logradouro,
    numero,
    complemento,
    uf,
    bairro,
    cidade,
    primeiroEmprego,
    pispasep,
    jsonTelefoneArray,
    jsonEmailArray,
    jsonDependenteArray) {
    $.ajax({
        url: 'js/sqlscopeFuncionario.php',
        type: 'post',
        dataType: "html",
        data: {
            funcao: "grava", id: id, ativo: ativo,
            nome: nome,
            cpf: cpf,
            rg: rg,
            genero: genero,
            estadoCivil: estadoCivil,
            dataNascimento: dataNascimento,
            cep: cep,
            logradouro: logradouro,
            numero: numero,
            complemento: complemento,
            uf: uf,
            bairro: bairro,
            cidade: cidade,
            primeiroEmprego: primeiroEmprego,
            pispasep: pispasep,
            jsonTelefoneArray: jsonTelefoneArray,
            jsonEmailArray: jsonEmailArray,
            jsonDependenteArray: jsonDependenteArray
        },


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

function validaCPF(cpf) {
    $.ajax({
        url: 'js/sqlscopeFuncionario.php',
        type: 'post',
        dataType: "html",
        data: { funcao: "validaCPF", cpf: cpf },

        success: function (data, textStatus) {
            if (data.trim() === 'success') {
            } else {
                smartAlert("Atenção", "CPF Inválido", "error");
                document.getElementById('cpf').value = "";
            }
        }, error: function (xhr, er) {
            console.log(xhr, er);
        }
    });
}


function validaCPFDependente(cpfDependente) {
    $.ajax({
        url: 'js/sqlscopeFuncionario.php',
        type: 'post',
        dataType: "html",
        data: { funcao: "validaCPFDependente", cpfDependente: cpfDependente },

        success: function (data, textStatus) {
            if (data.trim() === 'succes#') {
            } else {
                smartAlert("Atenção", "CPF Inválido", "error");
            }
        }, error: function (xhr, er) {
            console.log(xhr, er);
        }
    })
}

function validarDataDependente() {
    var data = $("#dataNascimentoDependente").val();
    data = data.replace(/\//g, "/");
    var data_array = data.split("/"); //responsável por quebrar a data em array

    //Inserir formato DD/MM/YYYY
    if (data_array[0].length != 4) {
        data = data_array[2] + "-" + data_array[1] + "-" + data_array[0];
    }

    //Calculo da idade referente a Data de Nascimento
    var hoje = new Date();
    var nasc = new Date(data);
    var idade = hoje.getFullYear() - nasc.getFullYear();
    var m = hoje.getMonth() - nasc.getMonth();
    if (m < 0 || (m === 0 && hoje.getDate() < nasc.getDate())) idade--;

    if (idade <= 0) {
        // alert("Usuários com menos de 18 anos não podem ser cadastrados.");
        $("#idade").val(idade)
        $("#btnGravar").prop('disabled', false);
        return false;
    }

    if (idade >= 18 && idade <= 120) {
        // smartAlert("Sucesso","Data permitida.", "success")
        $("#idade").val(idade)
        $("#btnGravar").prop('disabled', false);
        return;
    }

    //Idade superior a 50 não altera o cadastro

    if (hoje) return false;
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
                    mensagem = "Opa! CPF já registrado.";
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

function RGverificado(rg) {
    $.ajax({
        url: 'js/sqlscopeFuncionario.php',
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: { funcao: "VerificaRG", rg: rg }, //valores enviados ao script
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
                    mensagem = "RG já registrado.";
                    smartAlert("Atenção", mensagem, "error");
                    document.getElementById('rg').value = "";
                    $("#rg").focus();
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
        data: { funcao: 'recuperaFuncionario', id: id }, //valores enviados ao script      
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
        data: { funcao: 'excluir', id: id }, //valores enviados ao script     
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
