<script>
    $(document).ready(function(){
        //mendapatkan biodata pengaju penyertaan modal berdasarkan nomor admin form anggota
        $("#no_anggota").on("change", function () {
            var no_anggota = $(this).val();
            $.ajax({
                url : "{{url('get/anggota_simpanan_by_no_anggota/')}}" + '/'+ no_anggota,
                dataType: "json",
                type: "GET",
                success: function (result){
                    $('#nama').val(result[0].nama);
                    $('#no_pekerja').val(result[0].no_pekerja);
                    $('#bagian').val(result[0].nama_bagian);
                    $('#status').val(result[0].nama_status_pekerja);
                    $('#no_anggota').val(result[0].no_anggota);
                    $('#identitas').val(result[0].identitas);
                    $('#nomor_identitas').val(result[0].nomor_identitas);
                    $('#alamat_kantor').val(result[0].alamat_kantor);
                    $('#no_hp').val(result[0].no_hp);
                    $('#no_rekening').val(result[0].no_rek_payroll);
                    $('#bank').val(result[0].bank);
                    $('#nama_rekening').val(result[0].nama_rekening);
                }
            });
            // console.log(no_admin);
        });
        $("input[name='tgl_input_ambil_simpanan']").datepicker({
            dateFormat: 'd MM yy',
            autoclose: true
        });
        // $('#jumlah').mask('')
    });
    function formatRupiah(angka, prefix){
        var number_string = angka.value.replace(/[^,\d]/g, '').toString(),
            split   		= number_string.split(','),
            sisa     		= split[0].length % 3,
            rupiah     		= split[0].substr(0, sisa),
            ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        var result = prefix === undefined ? rupiah : (rupiah ? '' + rupiah : '');
        angka.value = result;
    }
</script>
