<script>
    $(document).ready(function() {
        $('#identitas').on("change", function () {
            $('#nomor_id').show();
            var id = document.getElementById('identitas').value;
            if (id === "KTP") {
                $('#nomor_identitas').mask('00-00-00-00-00-00-0000', {
                    placeholder: "Masukkan Nomor KTP"
                });
            } else if (id === "SIM") {
                $('#nomor_identitas').mask('0000000000000000', {
                    placeholder: "Masukkan Nomor SIM"
                });
            }
                // } else if (id === "Paspor") {
                //     $('#nomor_identitas').mask('S#', {placeholder: "Masukkan Nomor Paspor"});
            // }
            else{
                $('#nomor_id').hide();
            }
        });

        $('#status_kerja').on("change", function () {
            var status_kerja = document.getElementById('status_kerja').value;
            console.log(status_kerja);

            const tetap_outsorce = 50000
            //jika status kerja tetap atau outsourcing, simpanan pokok bernilai 50 ribu
            if (status_kerja === '1' || status_kerja === '3'){
                $("#simpanan_pokok").val(tetap_outsorce.toLocaleString('id'));
                $("#label_pokok").hide();
                $("#label_wajib").hide();
            }
            else {
                $('#simpanan_pokok').val('');
                $("#label_pokok").show();
                $("#label_wajib").show();
            }

            //jika status kerja adalah tetap, simpanan wajib 300 ribu.
            //jika status kerja adalah outsourcing, simpanan wajib 100 ribu
            const wajib_tetap = 300000;
            const wajib_outsource = 100000;
            if (status_kerja === '1'){
                $('#simpanan_wajib').val(wajib_tetap.toLocaleString('id'));
            }
            else if (status_kerja === '3'){
                $('#simpanan_wajib').val(wajib_outsource.toLocaleString('id'));
            }
            else{
                $('#simpanan_wajib').val('');
            }

        });

        //untuk masking no_hp dan no_rekening
        $('#no_hp').mask('089999999999');
        $('#no_rekening').mask('#');

        //mengatur format tanggal
        $("input[name='tgl_input']").datepicker({
            format: 'd MM yyyy',
            autoclose: true
        });

        $("input[name='tgl_mulai_potong']").datepicker({
            format: 'd MM yyyy',
            autoclose: true
        });

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
{{--    //membuat elemen select ke html--}}
{{--    // var selectList = document.createElement('select');--}}
{{--    // selectList.setAttribute('id', 'bagian');--}}
{{--    // selectList.setAttribute('name', 'bagian');--}}
{{--    // selectList.setAttribute('class', 'form-control');--}}
{{--    //--}}
{{--    // var myDiv = document.getElementById('select_bagian');--}}
{{--    // myDiv.appendChild(selectList);--}}
{{--    //--}}
{{--    // $('#status').on("change", function(){--}}
{{--    //    $("#row_bagian").show();--}}
{{--    //--}}
{{--    //    //membuat array untuk tiap status karyawan--}}
{{--    //     var magang = ["A", "B", "C"];--}}
{{--    //     var kontrak = ["D", "E", "F"];--}}
{{--    //     var pertamina = ["G", "H", "I"];--}}
{{--    //--}}
{{--    //     //memeriksa value dari status--}}
{{--    //     if($(this).val() === "Karyawan Magang"){--}}
{{--    //         for (var i = 0; i < magang.length; i++) {--}}
{{--    //             var option = document.createElement('option');--}}
{{--    //             option.setAttribute('value', magang[i]);--}}
{{--    //             option.setAttribute('id', 'option_magang');--}}
{{--    //             option.text = magang[i];--}}
{{--    //--}}
{{--    //             $("#bagian option[id='option_kontrak']").remove();--}}
{{--    //             $("#bagian option[id='option_pertamina']").remove();--}}
{{--    //             selectList.appendChild(option);--}}
{{--    //         }--}}
{{--    //     }--}}
{{--    //     else if($(this).val() === "Karyawan Kontrak"){--}}
{{--    //         for (var k = 0; k < kontrak.length; k++) {--}}
{{--    //             var option = document.createElement('option');--}}
{{--    //             option.setAttribute('value', kontrak[k]);--}}
{{--    //             option.setAttribute('id', 'option_kontrak');--}}
{{--    //             option.text = kontrak[k];--}}
{{--    //--}}
{{--    //             $("#bagian option[id='option_magang']").remove();--}}
{{--    //             $("#bagian option[id='option_pertamina']").remove();--}}
{{--    //--}}
{{--    //             selectList.appendChild(option);--}}
{{--    //         }--}}
{{--    //     }--}}
{{--    //     else if ($(this).val() === "Karyawan Pertamina"){--}}
{{--    //         for (var j = 0; j < pertamina.length; j++){--}}
{{--    //               var option = document.createElement('option');--}}
{{--    //               option.setAttribute('value', pertamina[j]);--}}
{{--    //               option.setAttribute('id', 'option_pertamina');--}}
{{--    //               option.text = pertamina[j];--}}
{{--    //--}}
{{--    //               $("#bagian option[id='option_kontrak']").remove();--}}
{{--    //               $("#bagian option[id='option_magang']").remove();--}}
{{--    //--}}
{{--    //               selectList.appendChild(option);--}}
{{--    //         }--}}
{{--    //     }--}}
{{--    //     else{--}}
{{--    //         $("#row_bagian").hide();--}}
{{--    //     }--}}
{{--    // });--}}

{{--    //     var wrapper = $(".input_wrap>div");--}}
{{--    //     var add_button = $(".add_field");--}}
{{--    //--}}
{{--    //     $(add_button).click(function (e) {--}}
{{--    //         e.preventDefault();--}}
{{--    //         $(wrapper).after('<div><input type="text" id="kebutuhan" name="kebutuhan[]" class="form-control"><i href="#" class="fa fa-minus remove_field"></i></div>'); //add input box--}}
{{--    //     });--}}
{{--    //--}}
{{--    //     $(document).on("click",".remove_field",function(){--}}
{{--    //         $(this).parent().remove();--}}
{{--    //     });--}}
{{--    // });--}}
{{--    //--}}
{{--    // function reset() {--}}
{{--    //     document.getElementById("fpro").reset();--}}
{{--    // }--}}

{{--    // $('#btnsimpan').on('click', function()--}}
{{--    // {--}}
{{--    //     $('#fpro').submit();--}}
{{--    // });--}}