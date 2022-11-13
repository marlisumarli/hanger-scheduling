let dataRow = 0
$('#add').click(() => {
    dataRow++
    inputRow(dataRow)
})

inputRow = (i) => {
    var tr = [`
<div id="id">
<span>${i}.</span>
<label for="id">Id</label>
<input type="text" name="id[]" id="id" required>
<br>
<label for="name">Nama</label>
<input type="text" name="name[]" id="name" required>
<br>
<label for="qty">Quantity</label>
<input type="number" name="qty[]" id="qty" required>
<hr>
                            </div>`];

    $('#data').append(tr)
}

$('#rm').click(() => {
    if (dataRow > 0) {
        dataRow--
    }
    var lists = $('#data').find('div');
    if (lists.length) {
        $('#data').find('div').last().remove();
    }
})
