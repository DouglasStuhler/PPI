function selectMedicos() {
    var especialidade = document.getElementById('especialidade').value;
    var medicoSelect = document.getElementById('medico');

    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'agendamentoController.php?acao=getMedicosEspecialidade&param='+especialidade);
    xhr.responseType = 'json';

    xhr.onload = function(){
        if(xhr.status != 200 || xhr.response == null){
            console.log('Erro ao solicitar a requisição');
            return false;
        }

        const dados = xhr.response;

        medicoSelect.innerHTML = '';
        var opcao = document.createElement('option');
    
        opcao.text = 'Selecione um médico';
        opcao.value = '';

        medicoSelect.appendChild(opcao);

        for (let i = 0; i < dados.length; i++) {
    
            var opcao = document.createElement('option');
    
            opcao.text = dados[i].nome;
            opcao.value = dados[i].id_medico;
    
            medicoSelect.appendChild(opcao);
        }
    }
    xhr.send();
}

function selectHorario() {
    let medico = document.getElementById('medico').value;
    let data = document.getElementById('data').value;
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'agendamentoController.php?acao=getHorarios&medico='+medico+'&data='+data)
    xhr.responseType = 'json';

    xhr.onload = function(){
        if(xhr.status != 200 || xhr.response == null){
            console.log('Erro ao efeturar requisição de horários disponíveis.');
            return false;
        }

        const dados = xhr.response;


        var horario = document.getElementById('horario');
    
        horario.innerHTML = '';
    
        var opcao = document.createElement('option');
        
        opcao.text = 'Selecione um horário';
        opcao.value = '';
    
        for (let i = 8; i < 18; i++) {
            if (!dados.includes(i+':00') && !dados.includes('0'+i+':00')){
                var opcao = document.createElement('option');
        
                opcao.text = i.toString() + ':00';
                opcao.value = i.toString() + ':00';
        
                horario.appendChild(opcao);
            }
        }
    }
    xhr.send();

}

window.onload = function(){
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'agendamentoController.php?acao=getEspecialidadeMedicos');
    xhr.responseType = 'json';
    
    xhr.onload = function(){
        if(xhr.status != 200 || xhr.response == null){
            console.log('Erro ao realizar as solicitações');
            console.log(xhr.status);
            return false;
        }
        
        const dados = xhr.response;
        var especialidade = document.getElementById('especialidade');

        for(i = 0; i < dados.length; i++){
            var opcao = document.createElement('option');

            opcao.text = dados[i];
            opcao.value = dados[i];
            especialidade.appendChild(opcao);
        }
    }

    xhr.onerror = function(){
        alert('Erro ao efetuar a requisição das especialidades.');
    }

    xhr.send();
}

var form = document.getElementById('cadAgenda');
form.onsubmit = async function(e){
    e.preventDefault();

    let dados = new FormData(form);

    const opcoes = {
        method: 'POST',
        body: dados
    }

    let envioForm = await fetch('agendamentoController.php', opcoes);
    let resposta = await envioForm.json();

    if(resposta){
        alert('Consulta agenda!');

        var horario = document.getElementById('horario');
    
        horario.innerHTML = '';
    
        var opcao = document.createElement('option');
        
        opcao.text = 'Horário Consulta';
        opcao.value = '';

        horario.appendChild(opcao);

        form.reset();
        span.style = 'display: none';
    } else {
        let span = document.querySelector('span#avisoErro');
        span.textContent = 'Erro ao enviar o formulário';
        span.style = 'display: inline-block';
    }
}