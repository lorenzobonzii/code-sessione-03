function file_get_contents(filename) {
    fetch(filename).then((resp) => resp.text()).then(function(data) {
        return data;
    });
}
function contaOggetto() {
    var cont_oggetto = document.getElementById('cont-oggetto');
    var numero = document.form.oggetto.value.length;
    cont_oggetto.textContent = numero+'/255';
}function contaMessaggio() {
    var cont_messaggio = document.getElementById('cont-messaggio');
    var numero = document.form.messaggio.value.length;
    cont_messaggio.textContent = numero+'/1000';
}
function verificaNome(){
    var nome = document.form.nome.value;
    if ((nome == "") || (nome == "undefined")){
        var p = document.getElementById('nome-errore');
        if (!p){
            var p = document.createElement('p');
            p.id = 'nome-errore';
            p.classList.add('testo-errore');
            document.form.nome.after(p);
        }
        p.textContent = 'Inserisci il nome';
        document.form.nome.classList.add('errore');
        document.querySelectorAll('label[for="nome"]')[0].classList.add('errore');
    } else {
        var p = document.getElementById('nome-errore');
        if (p){
            p.remove();
            document.form.nome.classList.remove('errore');
            document.querySelectorAll('label[for="nome"]')[0].classList.remove('errore');
        }
        return true;
    }
}
function verificaCognome(){
    var cognome = document.form.cognome.value;
    if ((cognome == "") || (cognome == "undefined")){
        var p = document.getElementById('cognome-errore');
        if (!p){
            var p = document.createElement('p');
            p.id = 'cognome-errore';
            p.classList.add('testo-errore');
            document.form.cognome.after(p);
        }
        p.textContent = 'Inserisci il cognome';
        document.form.cognome.classList.add('errore');
        document.querySelectorAll('label[for="cognome"]')[0].classList.add('errore');
    } else {
        var p = document.getElementById('cognome-errore');
        if (p){
            p.remove();
            document.form.cognome.classList.remove('errore');
            document.querySelectorAll('label[for="cognome"]')[0].classList.remove('errore');
        }
        return true;
    }
}
function verificaTelefono(){
    var telefono = document.form.telefono.value;
    if ((telefono == "") || (telefono == "undefined")){
        var p = document.getElementById('telefono-errore');
        if (!p){
            var p = document.createElement('p');
            p.id = 'telefono-errore';
            p.classList.add('testo-errore');
            document.form.telefono.after(p);
        }
        p.textContent = 'Inserisci il telefono';
        document.form.telefono.classList.add('errore');
        document.querySelectorAll('label[for="telefono"]')[0].classList.add('errore');
    } else {
        var p = document.getElementById('telefono-errore');
        if (p){
            p.remove();
            document.form.telefono.classList.remove('errore');
            document.querySelectorAll('label[for="telefono"]')[0].classList.remove('errore');
        }
        return true;
    }
}
function verificaEmail(){
    var email = document.form.email.value;
    var email_reg_exp = /^[A-z0-9\.\+_-]+@[A-z0-9\._-]+\.[A-z]{2,6}$/;
    if ((email == "") || (email == "undefined")){
        var p = document.getElementById('email-errore');
        if (!p){
            var p = document.createElement('p');
            p.id = 'email-errore';
            p.classList.add('testo-errore');
            document.form.email.after(p);
        }
        p.textContent = 'Inserisci la email';
        document.form.email.classList.add('errore');
        document.querySelectorAll('label[for="email"]')[0].classList.add('errore');
    } else if (!email_reg_exp.test(email)){
        var p = document.getElementById('email-errore');
        if (!p){
            var p = document.createElement('p');
            p.id = 'email-errore';
            p.classList.add('testo-errore');
            document.form.email.after(p);
        }
        p.textContent = 'La mail inserita non è valida';
        document.form.email.classList.add('errore');
        document.querySelectorAll('label[for="email"]')[0].classList.add('errore');
    } else {
        var p = document.getElementById('email-errore');
        if (p){
            p.remove();
            document.form.email.classList.remove('errore');
            document.querySelectorAll('label[for="email"]')[0].classList.remove('errore');
        }
        return true;
    }
}
function verificaOggetto(){
    var oggetto = document.form.oggetto.value;
    if ((oggetto == "") || (oggetto == "undefined")){
        var p = document.getElementById('oggetto-errore');
        if (!p){
            var p = document.createElement('p');
            p.id = 'oggetto-errore';
            p.classList.add('testo-errore');
            document.form.oggetto.after(p);
        }
        p.textContent = "Inserisci l'oggetto";
        document.form.oggetto.classList.add('errore');
        document.querySelectorAll('label[for="oggetto"]')[0].classList.add('errore');
    } else if (oggetto.length > 255){
        var p = document.getElementById('oggetto-errore');
        if (!p){
            var p = document.createElement('p');
            p.id = 'oggetto-errore';
            p.classList.add('testo-errore');
            document.form.oggetto.after(p);
        }
        p.textContent = "L'oggetto inserito supera i 255 caratteri";
        document.form.oggetto.classList.add('errore');
        document.querySelectorAll('label[for="oggetto"]')[0].classList.add('errore');
    } else {
        var p = document.getElementById('oggetto-errore');
        if (p){
            p.remove();
            document.form.oggetto.classList.remove('errore');
            document.querySelectorAll('label[for="oggetto"]')[0].classList.remove('errore');
        }
        return true;
    }
}
function verificaMessaggio(){
    var messaggio = document.form.messaggio.value;
    if ((messaggio == "") || (messaggio == "undefined")){
        var p = document.getElementById('messaggio-errore');
        if (!p){
            var p = document.createElement('p');
            p.id = 'messaggio-errore';
            p.classList.add('testo-errore');
            document.form.messaggio.after(p);
        }
        p.textContent = 'Inserisci il messaggio';
        document.form.messaggio.classList.add('errore');
        document.querySelectorAll('label[for="messaggio"]')[0].classList.add('errore');
    } else if (messaggio.length > 1000){
        var p = document.getElementById('messaggio-errore');
        if (!p){
            var p = document.createElement('p');
            p.id = 'messaggio-errore';
            p.classList.add('testo-errore');
            document.form.messaggio.after(p);
        }
        p.textContent = 'Il messaggio inserito supera i 1000 caratteri';
        document.form.messaggio.classList.add('errore');
        document.querySelectorAll('label[for="messaggio"]')[0].classList.add('errore');
    } else {
        var p = document.getElementById('messaggio-errore');
        if (p){
            p.remove();
            document.form.messaggio.classList.remove('errore');
            document.querySelectorAll('label[for="messaggio"]')[0].classList.remove('errore');
        }
        return true;
    }
}
function verificaContatto(){
    var verNome = verificaNome();
    var verCognome = verificaCognome();
    var verTelefono = verificaTelefono();
    var verEmail = verificaEmail();
    var verOggetto = verificaOggetto();
    var verMessaggio = verificaMessaggio();
    if (verNome && verCognome && verTelefono && verEmail && verOggetto && verMessaggio){
        return true;
    } else {
        return false;
    }
}

window.onload = function (){
    contaOggetto();
    contaMessaggio();
    document.form.contatti.onclick = function (e){
        e.preventDefault();
        if (verificaContatto()){
            document.form.submit();
        }
    }
    document.form.nome.oninput = function (){
        verificaNome();
    }
    document.form.cognome.oninput = function (){
        verificaCognome();
    }
    document.form.telefono.oninput = function (){
        verificaTelefono();
    }
    document.form.email.oninput = function (){
        verificaEmail();
    }
    document.form.oggetto.oninput = function (){
        contaOggetto();
        verificaOggetto();
    }
    document.form.messaggio.oninput = function (){
        contaMessaggio();
        verificaMessaggio();
    }
}