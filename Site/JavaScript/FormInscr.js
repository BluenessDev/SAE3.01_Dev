window.onload = init;

function init() {
    let email = localStorage.getItem('email');
    let login = localStorage.getItem('login');

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

    localStorage.setItem('email', email);
    localStorage.setItem('login', login);
}