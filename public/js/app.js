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