function insertAbsen(e) {
    $.post('update-jadwal', {
        val: $(e).val(),
        employee_no: $(e).data('employee_id'),
        tanggal: $(e).data('tanggal'),
        idJadwal: $(e).data('id-jadwal'),
    }, function (r) {
        $.pjax.reload({
            container: "#pjax-jadwal-gaji",
            async: false,
        });
        toastr.success("Berhasil Mengupdate Jadwal Pegawai " + r.namaPegawai);
    }, 'JSON')
}