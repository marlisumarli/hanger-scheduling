const search = () => {
    let x = document.getElementById('searchData').value
    x = x.toLowerCase();
    let data = document.getElementsByClassName('data');

    let i;
    let n = data.length;
    for (i = 0; i < n; i++) {
        if (!data[i].id.toLowerCase().includes(x)) {
            data[i].style.display = "none";
        } else {
            data[i].style.display = "block";
        }
    }
}

