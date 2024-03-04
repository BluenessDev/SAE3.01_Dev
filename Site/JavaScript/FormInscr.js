window.onload = init;

function init() {
    // Générer un identifiant unique pour cet onglet si ce n'est pas déjà fait
    if (!window.name) {
        window.name = Date.now().toString();
    }

    let email = sessionStorage.getItem(window.name + 'email');
    let login = sessionStorage.getItem(window.name + 'login');

    if (email !== null) {
        document.getElementById('email').value = email;
    }
    if (login !== null) {
        document.getElementById('login').value = login;
    }
}

function conserverChamps() {
    let email = document.getElementById('email').value;
    let login = document.getElementById('login').value;

    sessionStorage.setItem(window.name + 'email', email);
    sessionStorage.setItem(window.name + 'login', login);
}

function clearChamps() {
    sessionStorage.removeItem(window.name + 'email');
    sessionStorage.removeItem(window.name + 'login');
    document.getElementById('email').value = '';
    document.getElementById('login').value = '';
}