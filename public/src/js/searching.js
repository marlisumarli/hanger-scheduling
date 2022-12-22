const search = () => {
    let input = document.getElementById('searchData').value
    input=input.toLowerCase();
    let x = document.getElementsByClassName('data');
    let notFound = document.getElementById('notFound');
    let found = document.getElementById('found');
    let count = 0;

    for (let i = 0; i < x.length; i++) {
        if (!x[i].innerHTML.toLowerCase().includes(input)) {
            x[i].style.display="none";
        }
        else {
            x[i].style.display="block";
            count++;
        }
    }

    if (count === 0){
        notFound.classList.remove('d-none');
        found.classList.add('d-none');
    }else{
        notFound.classList.add('d-none');
        found.classList.remove('d-none');
    }
}
