const form = document.getElementById('form');
const username = document.getElementById('username');
const email = document.getElementById('email');
const password = document.getElementById('password');
const repassword = document.getElementById('repassword');


function error(input, message) {
    input.className = 'form-control is-invalid';
    const div = input.nextElementSibling;
    div.innerText = message;
    div.className = 'invalid-feedback';
}

function success(input) {
    input.className = 'form-control is-valid';
}

function checkEmail(input) {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    if (re.test(input.value)) {
        success(input);
    } else {
        error(input, 'Wrong type');
    }
}

function check_required(inputs) {
    inputs.forEach(function (input) {
        if (input.value === '') {
            error(input, `${input.id} is required.`);
        } else {
            success(input);
        }
    });
}


function check_length(input, min, max) {
    if (input.value.length < min) {
        error(input, ` This side must be minimum ${min} characther.`);
    } else if (input.value.length > max) {
        error(input, `This side must be maximum ${max} characther.`);
    } else {
        success(input);
    }
}

function check_password(pword, repword) {
    if (pword.value !== repword.value) {
        error(repassword, "Passwords are not match!");
    }
}



form.addEventListener('submit', function (e) {
    e.preventDefault();

    check_required([username, email, password, repassword]);
    checkEmail(email);
    check_length(username, 5, 21);
    check_length(password, 5, 21);
    check_password(password, repassword);
});