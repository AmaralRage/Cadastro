function gravaLocalizacao(localizacao) {
  $.ajax({
    url: "js/sqlscope_tabelaBasicaLocalizacao.php",
    dataType: "html",
    type: "post",
    data: { funcao: "grava", localizacao: localizacao },
    beforeSend: function () {},
    complete: function () {},
    success: function (data, textStatus) {
      if (data.indexOf("sucess") < 0) {
        var piece = data.split("#");
        var mensagem = piece[1];
        if (mensagem !== "") {
          smartAlert("Atenção", mensagem, "error");
        } else {
          smartAlert(
            "Atenção",
            "Operação não realizada - entre em contato com a GIR!",
            "error"
          );
        }

        return "";
      } else {
        smartAlert("Sucesso", "Operação realizada com sucesso!", "success");
        voltar();
      }
    },
    error: function (xhr, er) {},
  });
  return "";
}

function recuperaLocalizacao(id, callback) {
  $.ajax({
    url: "js/sqlscope_tabelaBasicaLocalizacao.php",
    dataType: "html",
    type: "post",
    data: { funcao: "recupera", id: id },

    success: function (data, textStatus) {
      if (data.indexOf("failed") > -1) {
        return;
      } else {
        callback(data);
      }
    },
    error: function (xhr, er) {},
  });

  return;
}

function excluirLocalizacao(id) {
  $.ajax({
    url: "js/sqlscope_tabelaBasicaLocalizacao.php", //caminho do arquivo a ser executado
    dataType: "html", //tipo do retorno
    type: "post", //metodo de envio
    data: { funcao: "excluir", id: id }, //valores enviados ao script
    beforeSend: function () {},
    complete: function () {},
    success: function (data, textStatus) {
      if (data.indexOf("failed") > -1) {
        var piece = data.split("#");
        var mensagem = piece[1];

        if (mensagem !== "") {
          smartAlert("Atenção", mensagem, "error");
        } else {
          smartAlert(
            "Atenção",
            "Operação não realizada - entre em contato com a GIR!",
            "error"
          );
        }
        voltar();
      } else {
        smartAlert("Sucesso", "Operação realizada com sucesso!", "success");
        voltar();
      }
    },
    error: function (xhr, er) {
      //tratamento de erro
    },
  });
}
