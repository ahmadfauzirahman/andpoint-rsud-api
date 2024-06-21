// $(document).ready(function () {
//     setInterval(function () {
//         $.pjax.reload({
//             container: '#pjax-absensi',
//             timeout: false
//         });
//     }, 3000);



// })

function save(e) {
    // alert('asda')

    $.post(baseUrl + 'master-absensi/ambil-absen-save', {
        nip: $(e).data("value")
    }, function (r) {
        console.log(r);
        if (r.s) {
            toastr["success"]("Mantap, Sukses menyimpan Data Absen boooyyyy...");
            $.pjax.reload({
                container: '#pjax-absensi',
                timeout: false
            });
        } else {
            toastr["warning"]("Sory, Gagal menyimpan boooyyyy..." + JSON.stringify(r.e))
            $.pjax.reload({
                container: '#pjax-absensi',
                timeout: false
            });

        }
    }, 'JSON');
    return false
}