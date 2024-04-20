async function sendForm(form) {
    try {
        const response = await fetch("model/login.php", { method: 'post', body: new FormData(form) });
        if (!response.ok) throw new Error(response.statusText);
        var bodyText = await response.text();
        const result = JSON.parse(bodyText);

        if (result.success)
            window.location.assign('acessoRestrito');
        else {
            document.querySelector("#loginFailMsg").style.display = 'block';
            window.alert("Usuário e/ou senha incorreta. Por favor, tente novamente.");
            form.senha.value = "";
            form.senha.focus();
        }
    }
    catch (e) {
        console.log(bodyText ?? "");
        console.error(e);
    }

}
const form = document.querySelector("#formulario");
form.onsubmit = function (e) {
    sendForm(form);
    e.preventDefault();
}