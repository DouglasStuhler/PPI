async function busca_endereco(cep){

  if (cep.length != 9) return;

  try {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "../cadastro/controlador_endereco.php?acao=getEndereco&cep="+cep);
    xhr.responseType = 'json';
  
    xhr.onload = function () {
    var x = xhr.response;
    debugger;

    if (xhr.status != 200 || xhr.response === null) {
      console.log("Resposta não obtida");
      return;
    }

    const endereco = xhr.response;
    let form = document.querySelector("#formCad");
    form.logradouro.value = endereco.logradouro;
    form.cidade.value = endereco.cidade;
    form.estado.value = endereco.estado;
   };

    xhr.onerror = function () {
      console.error("Requisição não finalizada");
      return;
    };

   xhr.send();
  } catch (error) {
    console.error('Erro ao fazer requisição:', error);
  }
}

window.onload = function () {
  const inputCep = document.querySelector("#cep");
  inputCep.onkeyup = () => busca_endereco(inputCep.value);
}