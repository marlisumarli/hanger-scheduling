const addM1 = document.getElementById('add-m1');
addM1.addEventListener('click', addMoreFields1);
addM1.addEventListener('click', countFieldDate);

function addMoreFields1() {
    const m1 = document.getElementById('m1');
    const input = document.createElement('input');
    const div = document.createElement('div');
    const buttonRemove = document.createElement('button');

    div.setAttribute('class', 'mt-3 mb-3 input-group');
    m1.appendChild(div);

    input.setAttribute('class', 'form-control');
    input.setAttribute('name', 'date-m1[]');
    input.setAttribute('type', 'date');
    input.setAttribute('required', 'required');
    div.appendChild(input);
    buttonRemove.setAttribute('class', 'btn btn-danger input-group-tex');
    buttonRemove.setAttribute('type', 'button');
    buttonRemove.innerHTML = '<i class="fa-solid fa-xmark"></i>';

    buttonRemove.addEventListener('click', function () {
        m1.removeChild(div);
        countFieldDate();
    });
    div.appendChild(buttonRemove);
}

const addM2 = document.getElementById('add-m2');
addM2.addEventListener('click', addMoreFields2);
addM2.addEventListener('click', countFieldDate);

function addMoreFields2() {
    const m2 = document.getElementById('m2');
    const input = document.createElement('input');
    const div = document.createElement('div');
    const buttonRemove = document.createElement('button');

    div.setAttribute('class', 'mt-3 mb-3 input-group');
    m2.appendChild(div);

    input.setAttribute('class', 'form-control');
    input.setAttribute('name', 'date-m2[]');
    input.setAttribute('type', 'date')
    input.setAttribute('required', 'required');
    div.appendChild(input);
    buttonRemove.setAttribute('class', 'btn btn-danger input-group-tex');
    buttonRemove.setAttribute('type', 'button');
    buttonRemove.innerHTML = '<i class="fa-solid fa-xmark"></i>';

    buttonRemove.addEventListener('click', function () {
        m2.removeChild(div);
        countFieldDate();
    });
    div.appendChild(buttonRemove);
}

const addM3 = document.getElementById('add-m3');
addM3.addEventListener('click', addMoreFields3);
addM3.addEventListener('click', countFieldDate);

function addMoreFields3() {
    const m3 = document.getElementById('m3');
    const input = document.createElement('input');
    const div = document.createElement('div');
    const buttonRemove = document.createElement('button');

    div.setAttribute('class', 'mt-3 mb-3 input-group');
    m3.appendChild(div);

    input.setAttribute('class', 'form-control');
    input.setAttribute('name', 'date-m3[]');
    input.setAttribute('type', 'date')
    input.setAttribute('required', 'required');
    div.appendChild(input);
    buttonRemove.setAttribute('class', 'btn btn-danger input-group-tex');
    buttonRemove.setAttribute('type', 'button');
    buttonRemove.innerHTML = '<i class="fa-solid fa-xmark"></i>';

    buttonRemove.addEventListener('click', function () {
        m3.removeChild(div);
        countFieldDate();
    });
    div.appendChild(buttonRemove);
}

const addM4 = document.getElementById('add-m4');
addM4.addEventListener('click', addMoreFields4);
addM4.addEventListener('click', countFieldDate);

function addMoreFields4() {
    const m4 = document.getElementById('m4');
    const input = document.createElement('input');
    const div = document.createElement('div');
    const buttonRemove = document.createElement('button');

    div.setAttribute('class', 'mt-3 mb-3 input-group');
    m4.appendChild(div);

    input.setAttribute('class', 'form-control');
    input.setAttribute('name', 'date-m4[]');
    input.setAttribute('type', 'date')
    input.setAttribute('required', 'required');
    div.appendChild(input);
    buttonRemove.setAttribute('class', 'btn btn-danger input-group-tex');
    buttonRemove.setAttribute('type', 'button');
    buttonRemove.innerHTML = '<i class="fa-solid fa-xmark"></i>';

    buttonRemove.addEventListener('click', function () {
        m4.removeChild(div);
        countFieldDate();
    });
    div.appendChild(buttonRemove);
}

const addM5 = document.getElementById('add-m5');
addM5.addEventListener('click', addMoreFields5);
addM5.addEventListener('click', countFieldDate);

function addMoreFields5() {
    const m5 = document.getElementById('m5');
    const input = document.createElement('input');
    const div = document.createElement('div');
    const buttonRemove = document.createElement('button');

    div.setAttribute('class', 'mt-3 mb-3 input-group');
    m5.appendChild(div);

    input.setAttribute('class', 'form-control');
    input.setAttribute('name', 'date-m5[]');
    input.setAttribute('type', 'date')
    input.setAttribute('required', 'required');
    div.appendChild(input);
    buttonRemove.setAttribute('class', 'btn btn-danger input-group-tex');
    buttonRemove.setAttribute('type', 'button');
    buttonRemove.innerHTML = '<i class="fa-solid fa-xmark"></i>';

    buttonRemove.addEventListener('click', function () {
        m5.removeChild(div);
        countFieldDate();
    });
    div.appendChild(buttonRemove);
}

function countFieldDate() {
    const buttonSubmit = document.getElementById('submit');
    const m1 = document.getElementById('m1');
    const m2 = document.getElementById('m2');
    const m3 = document.getElementById('m3');
    const m4 = document.getElementById('m4');
    const countM1 = m1.querySelectorAll('input').length;
    const countM2 = m2.querySelectorAll('input').length;
    const countM3 = m3.querySelectorAll('input').length;
    const countM4 = m4.querySelectorAll('input').length;
    if ((countM1 >= 1) && (countM2 >= 1) && (countM3 >= 1) && (countM4 >= 1)) {
        buttonSubmit.classList.remove('disabled');
    } else {
        buttonSubmit.classList.add('disabled');
    }
}