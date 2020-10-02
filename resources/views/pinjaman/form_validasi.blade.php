<script>
    $('#btnsimpan').on('click', function () {
        if ($('#no_anggota').val === ""){
            swal("", "Mohon pilih salah satu No. Anggota", "error");
        }
        else if ($('#tgl_input_pinjam').val() === ""){
            swal("", "Tanggal Input Pinjam tidak boleh kosong", "error");
        }
        else if($('#kebutuhan').val() ===""){
            swal("", "Kebutuhan tidak boleh kosong", "error");
        }
        else if($('#jumlah').val() === ""){
            swal("", "Jumlah tidak boleh kosong", "error");
        }
        else if($('#termin').val() === ""){
            swal("", "Termin tidak boleh kosong", "error");
        }
        else if($('#angsuran').val() === ""){
            swal("", "Angsuran tidak boleh kosong", "error");
        }
        else{
            $('#fpro').submit();
        }
    })
</script>