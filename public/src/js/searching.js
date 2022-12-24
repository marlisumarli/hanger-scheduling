const search = () => {
    const input = document.getElementById('searchData');
    let split = input.value.replace(/-/g, '');
    let year = split.slice(0, 4);
    let month = split.slice(4, 6);

    const found = document.getElementById('found');
    const notFound = document.getElementById('notFound');

    const data = document.getElementsByClassName('data');

    let x = year+month
    let ketemu = 0;
    for (let i = 0; i < data.length; i++) {
        if (data[i].id === x) {
            ketemu++;
            data[i].classList.remove('d-none');
        } else {
            data[i].classList.add('d-none');
        }
    }
    // ketemu
    if (ketemu === 0) {
        notFound.classList.remove('d-none');
        found.classList.add('d-none');
        // tidak ketemu
    } else {
        notFound.classList.add('d-none');
        found.classList.remove('d-none');
    }
}
