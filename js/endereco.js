

function insertEndereco() {
    let cep = document.getElementById('campoCEP').value;
    let logr = document.getElementById('campoLogradouro').value;
    let estado = document.getElementById('campoEstado').value;
    let cidade = document.getElementById('campoCidade').value;

    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'enderecoController.php?acao=cadEndereco&CEP=' + cep + '&logr=' + logr + '&estado=' + estado + '&cidade=' + cidade);
    xhr.responseType = 'json';

    xhr.onload = function () {
        if (xhr.status != 200 || xhr.response == null) {
            console.log('Erro ao efetuar o cadastro de endereço');
            alert('Erro ao efetuar o cadastro de endereço');
            return false;
        }

        alert('Cadastro de endereço efetuado com sucesso');
        const result = xhr.response;
        if (result.success)
            window.location.assign('acessoRestrito');
        else {
            alert('Erro ao efetuar o cadastro de endereço');
            cep.value = "";
            logr.value = "";
            estado.value = "";
            cidade.value = "";
        }

    }
    xhr.send();

}

var form = document.getElementById('formCad');
form.onsubmit = function (e) {
    insertEndereco();
    e.preventDefault();
}