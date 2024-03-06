function selectMedicos() {
    var especialidade = document.getElementById('especialidade').value;
    var medicoSelect = document.getElementById('medico');

    medicoSelect.innerHTML = '';

    if (especialidade === 'cardiologia') {
        var medico = ['Dr. Dráuzio Varella', 'Dr. José Eduardo']
    } else if (especialidade === 'mamografia') {
        var medico = ['Dr. Oswaldo Cruz', 'Dra. Maria Augusta']
    } else if (especialidade === 'oftalmologia') {
        var medico = ['Dr. João', 'Dra. Adriana Melo']
    } else if (especialidade === 'ressonancia') {
        var medico = ['Dra. Valeria Petri', 'Dr. José Osmar']
    } else if (especialidade === 'prontoSocorro') {
        var medico = ['Dr. Francis Collins', 'Dr. Nise da Silveira']
    } else if (especialidade === 'ultrassom') {
        var medico = ['Dra. Rita Lobato', 'Dr. Carlos Chagas']
    } else {
        var medico = ['Selecione um Médico'];
    }

    for (let i = 0; i < medico.length; i++) {

        var opcao = document.createElement('option');

        opcao.text = medico[i];
        opcao.value = medico[i];

        medicoSelect.appendChild(opcao);

    }
}

function selectHorario() {
    var horario = document.getElementById('horario');

    horario.innerHTML = '';

    for (let i = 8; i < 18; i++) {

        var opcao = document.createElement('option');

        opcao.text = i.toString() + ':00';
        opcao.value = i.toString();

        horario.appendChild(opcao);

    }

}

function selectEspec() {

    var especialidade = document.getElementById('especialidade');

    var opcao = document.createElement('option');

    opcao.text = 'Cardiologia';
    opcao.value = 'cardiologia';
    especialidade.appendChild(opcao);

    opcao = document.createElement('option');
    opcao.text = 'Mamografia';
    opcao.value = 'mamografia';
    especialidade.appendChild(opcao);

    opcao = document.createElement('option');
    opcao.text = 'Oftalmologia';
    opcao.value = 'oftalmologia';
    especialidade.appendChild(opcao);

    opcao = document.createElement('option');
    opcao.text = 'Ressonancia';
    opcao.value = 'ressonancia';
    especialidade.appendChild(opcao);

    opcao = document.createElement('option');
    opcao.text = 'Pronto Socorro';
    opcao.value = 'prontoSocorro';
    especialidade.appendChild(opcao);

    opcao = document.createElement('option');
    opcao.text = 'Ultrassom';
    opcao.value = 'ultrassom';
    especialidade.appendChild(opcao);
}

window.onload = selectEspec;