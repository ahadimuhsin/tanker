<script>
    $('#btnsimpan').on('click', function() {
         if ($('#tgl_input_penyertaan').val() === "") {
            swal("", "Tanggal Input Penyertaan Modal tidak boleh kosong", "error");
        } else if ($('#jumlah').val() === "") {
            swal("", "Jumlah tidak boleh kosong", "error");
        }else{
            $('#edit_penyertaan').submit();
        }
    });
</script>
