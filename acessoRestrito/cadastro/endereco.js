async function buscaEndereco(cep) {

  if (cep.length != 9) return;

  try {
    let response = await fetch("Endereco.php?cep=" + cep);
    if (!response.ok) throw new Error(response.statusText);
    var endereco = await response.json();
  }
  catch (error) {
    console.error(error);
    return;
  }

  let form = document.querySelector("form");
  form.rua.value = endereco.rua;
  form.bairro.value = endereco.bairro;
  form.cidade.value = endereco.cidade;
}

window.onload = function () {
  const inputCep = document.querySelector("#cep");
  inputCep.onkeyup = () => buscaEndereco(inputCep.value);
}
