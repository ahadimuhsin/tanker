<script>
  $('#btnsimpan').on('click', function() {
      if ($('#no_anggota').val ===""){
          swal("", "No. Anggota tidak boleh kosong", "error");
      }
    else if ($('#nama').val() === "") {
      swal("", "Nama tidak boleh kosong", "error");
    } else if ($('#status').val() === "") {
      swal("", "Mohon isi status karyawan", "error");
    } else if ($('#identitas').val() === "") {
      swal("", "Mohon pilih salah satu jenis identitas", "error");
    } else if ($('#nomor_identitas').val() === "") {
      swal("", "Nomor Identitas tidak boleh kosong", "error");
    } else if ($('#alamat_kantor').val() === "") {
      swal("", "Alamat Kantor tidak boleh kosong", "error");
    } else if ($('#no_hp').val() === "") {
        swal("", "Nomor Handphone tidak boleh kosong", "error");
    } else if ($('#no_rekening').val() === "") {
      swal("", "Nomor Rekening Payroll tidak boleh kosong", "error");
    } else if ($('#bank').val() === "") {
      swal("", "Bank tidak boleh kosong", "error");
    } else if ($('#nama_rekening').val() === "") {
      swal("", "Nama Rekening tidak boleh kosong", "error");
    } else if ($('#kebutuhan').val() === "") {
      swal("", "Kebutuhan tidak boleh kosong", "error");
    } else if ($('#simpanan_pokok').val() === "") {
      swal("", "Simpanan Pokok tidak boleh kosong", "error");
    } else if ($('#simpanan_wajib').val() === "") {
      swal("", "Simpanan Wajib tidak boleh kosong", "error");
    } else if ($('#simpanan_sukarela').val() === "") {
      swal("", "Simpanan Sukarela tidak boleh kosong", "error");
    } else if ($('#cara_pembayaran').val() === "") {
      swal("", "Cara Pembayaran tidak boleh kosong", "error");
    }else if ($('#tgl_input').val() === "")
    {
        swal("", "Mohon masukkan tanggal input", "error");
    }
    else{
      $('#fpro').submit();
    }
  });
</script>
