<script>
    $('#btnsimpan').on('click', function() {
        if ($('#tgl_input_ambil_simpanan').val() === "") {
            swal("", "Tanggal Input Ambil Simpanan tidak boleh kosong", "error");
        } else if ($('#jumlah').val() === "") {
            swal("", "Jumlah tidak boleh kosong", "error");
        }
        else if($('#alasan').val() === ""){
            swal("", "Alasan tidak boleh kosong", "error");
        }
        else if ($("#cara_bayar").val() === ""){
            swal("", "Cara Pembayaran tidak boleh kosong", "error");
        }
        else{
            $('#edit_simpanan').submit();
        }
    });
</script>