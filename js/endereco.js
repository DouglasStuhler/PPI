

function insertEndereco(form) {
    /*let cep = form.cep.value;
    let logr = form.logr.value;
    let estado = form.estado.value;
    let cidade = form.cidade.value;*/

    let xhr = new XMLHttpRequest();
    xhr.open('POST', '../enderecoController.php');
    xhr.responseType = 'json';

    xhr.onload = function () {
        if (xhr.status != 200 || xhr.response == null) {
            console.log('Erro ao efetuar o cadastro de endereço');
            alert('Erro ao efetuar o cadastro de endereço');
            return false;
        }

        
        const result = xhr.response;
        if (result == 0){
            alert('Cadastro de endereço efetuado com sucesso');
            window.location.assign('index');
        } else {
            alert('Erro ao efetuar o cadastro de endereço');
            form.cep.value = "";
            form.logr.value = "";
            form.estado.value = "";
            form.cidade.value = "";
            
        }

    }
    xhr.send();

}

var form = document.querySelector("#formCad");
form.onsubmit = function (e) {
    insertEndereco(form);
    e.preventDefault();
}