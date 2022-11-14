let dataRow = 0
$('#add').click(() => {
    dataRow++
    inputRow(dataRow)
})
inputRow = (i) => {
    i += 1;
    var tr = [`
<div id="divId">
<span>${i}.</span>
<label for="id${i}">Id</label>
<input type="text" name="id[]" id="id${i}" title="Tidak boleh mengandung angka" pattern="[A-Za-z]{1,}" required="required">
<br>
<label for="name${i}">Nama</label>
<input type="text" name="name[]" id="name${i}" title="Tidak boleh mengandung angka" pattern="[A-Za-z]{1,}" required="required">
<br>
<label for="qty${i}">Quantity</label>
<input type="number" name="qty[]" id="qty${i}" required="required">
<hr>
</div>`];

    $('#data').append(tr)
}

$('#rm').click(() => {
    let data = $('#data');
    if (dataRow > 0) {
        dataRow--
    }
    let lists = data.find('#divId');

    if (lists.length) {
        lists.last().remove();
    }
})

// Validation form
// $(function () {
//     let fIdErr = $(".idErr");
//     fIdErr.hide();
//     let fNameErr = $("#nameErr1");
//     fNameErr.hide();
//     let fQtyErr = $("#qtyErr1");
//     fQtyErr.hide();
//
//     var idErr = false;
//     var nameErr = false;
//     var qtyErr = false;
//
//     let vId = $(".id");
//     vId.focusout(function () {
//         id();
//     });
//     let vName = $("#name1");
//     vName.focusout(function () {
//         name();
//     });
//     let vQty = $("#qty1");
//     vQty.focusout(function () {
//         qty();
//     });
//
//     function id() {
//         var pattern = /^[a-zA-Z]*$/;
//         var id = vId.val();
//
//         if (pattern.test(id) && id !== '') {
//             fIdErr.hide();
//             vId.css("border-bottom", "2px solid #34F458");
//         } else {
//             fIdErr.html("Harus huruf atau angka");
//             fIdErr.show();
//             vId.css("border-bottom", "2px solid #F90A0A");
//             idErr = true;
//         }
//     }
//
//     function name() {
//         var pattern = /^[a-zA-Z]*$/;
//         var name = vName.val();
//
//         if (pattern.test(name) && name !== '') {
//             fNameErr.hide();
//             vName.css("border-bottom", "2px solid #34F458");
//         } else {
//             fNameErr.html("Harus huruf");
//             fNameErr.show();
//             vName.css("border-bottom", "2px solid #F90A0A");
//             nameErr = true;
//         }
//     }
//
//     function qty() {
//         var qty = vQty.val();
//
//         if (qty !== '') {
//             fQtyErr.hide();
//             vQty.css("border-bottom", "2px solid #34F458");
//         } else {
//             fQtyErr.html("Tidak boleh kosong");
//             fQtyErr.show();
//             vQty.css("border-bottom", "2px solid #F90A0A");
//             nameErr = true;
//         }
//     }
//
//     $("#forms").submit(function () {
//         idErr = false;
//         nameErr = false;
//         id();
//         name();
//
//         if (idErr === false && nameErr === false && qtyErr === false) {
//             return true;
//         } else {
//             alert("Mohon masukan data yang valid");
//             return false;
//         }
//     });
// });