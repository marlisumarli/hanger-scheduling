$(document).ready(function () {
    $("#download").click(function () {
        let table = $("#exporting").html();
        let uri = 'Data:application/vnd.ms-excel;base64,';
        let template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head></head><body><table>{table}</table></body></html>';
        let base64 = function (s) {
            return window.btoa(unescape(encodeURIComponent(s)))
        };
        let format = function (s, c) {
            return s.replace(/{(\w+)}/g, function (m, p) {
                return c[p];
            })
        };
        let ctx = {
            worksheet: 'Worksheet',
            table: table
        };
        let link = document.createElement("a");
        link.download = "Data-supply-bulan-december2022.xls";
        link.href = uri + base64(format(template, ctx));
        link.click();
    });
});