<script>
    $('#btnsimpan').on('click', function() {
        if ($('#no_anggota').val() === "") {
            swal("", "No. Anggota tidak boleh kosong", "error");
        } else if ($('#tgl_input_penyertaan').val() === "") {
            swal("", "Tanggal Input Penyertaan Modal tidak boleh kosong", "error");
        } else if ($('#jumlah').val() === "") {
            swal("", "Jumlah tidak boleh kosong", "error");
        }else{
            $('#fpro').submit();
        }
    });
</script>
