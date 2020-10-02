<script>
    $(document).ready(function () {
        moment.locale('id');
        var table = $("#table-penyertaan").DataTable({
            dom: 'lfBrtip',
            processing: true,
            serverSide: true,
            responsive: true,
            "pagingType": "full_numbers",
            type: "GET",
            // "lengthChange": false,
            "lengthMenu": [10, 25, 50, 100],
            order: [[1, 'desc']],
            searching: false,
            ajax: {
                url: "{{url('get/penyertaan_tanker')}}",
                data: function (d) {
                    d.nama = $('input[name=nama]').val();
                }
            },
            columns: [
                {
                    data: "id",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: "no_admin",
                    name: 'tbl_penyertaan.no_admin'
                },
                {
                    data: "nama",
                    name: "tbl_anggota.nama"
                },
                {
                    data: "no_anggota",
                    name: "tbl_penyertaan.no_anggota"
                },
                {
                    data: "no_hp",
                    name: "tbl_anggota.no_hp",
                    'orderable' : false
                },
                {
                    data: "tgl_input_penyertaan",
                    name: "tbl_penyertaan.tgl_input_penyertaan",
                    type: 'date', render: function (value) {
                        if (value === null) return "";
                        return moment(value).format('LL');
                    }
                },
                {
                    data: "bank",
                    name: "tbl_anggota.bank"
                },

                {
                    data: "jumlah",
                    name: "tbl_penyertaan.jumlah",
                    render: $.fn.dataTable.render.number('.', '.', 0, 'Rp ')
                },
                {
                    data: "action1",
                    name: "action1", 'orderable': false
                },
                {
                    data: "action2",
                    name: "action2", 'orderable': false
                },
                {
                  data: 'action',
                  name: 'action',
                  'orderable' : false
                },
            ],
            buttons: [
                {
                    extend: 'pdf',
                    orientation : 'landscape',
                    // text: 'PDF',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9]
                    },
                    text: 'PDF',
                    filename: function () {
                        var today = new Date();
                        var dd = String(today.getDate()).padStart(2, '0');
                        var mm = String(today.getMonth() + 1).padStart(2, '0');
                        var yyyy = today.getFullYear();
                        var time = today.getHours() + "." + today.getMinutes() + "." + today.getSeconds();
                        var full_date = dd + "-" + mm + "-" + yyyy;
                        return 'Daftar Penyertaan Modal' + ' ' + full_date + ' ' + time;
                    },
                },
                {
                    extend: 'excel',
                    text: 'Excel',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9]
                    },
                    filename: function () {
                        var today = new Date();
                        var dd = String(today.getDate()).padStart(2, '0');
                        var mm = String(today.getMonth() + 1).padStart(2, '0');
                        var yyyy = today.getFullYear();
                        var time = today.getHours() + "." + today.getMinutes() + "." + today.getSeconds();
                        var full_date = dd + "-" + mm + "-" + yyyy;
                        return 'Daftar Penyertaan Modal' + ' ' + full_date + ' ' + time;
                    },
                },
            ],
        });

        $('#search-penyertaan').on('submit', function (e) {
            table.draw();
            e.preventDefault();
            table.ajax.reaload();
        });

        {{--$('#acceptPenyertaan2').on('click', function () {--}}
        {{--    console.log('Muhsin Ganteng');--}}
        {{--    $.ajax({--}}
        {{--        type: 'GET',--}}
        {{--        url : '{{url('get/penyertaan_tanker')}}',--}}
        {{--        success: function(result){--}}
        {{--            console.log(result);--}}
        {{--            for (var i = 0; i < result.data.length; i ++){--}}
        {{--                var status = result.data[i].status1;--}}
        {{--                console.log(status);--}}
        {{--                if (status !== 1){--}}
        {{--                    var a_tag1 = document.createElement('a');--}}
        {{--                    a_tag1.setAttribute('class', 'alert alert-danger alert-dismissable');--}}
        {{--                    a_tag1.innerHTML('Permohonan Anda Pada Status 1 Belum Disetujui atau Ditolak');--}}
        {{--                    document.body.appendChild(a_tag1);--}}
        {{--                }--}}
        {{--            }--}}
        {{--        }--}}
        {{--    })--}}

        {{--    });--}}

        {{--$.ajax({--}}
        {{--    type: 'GET',--}}
        {{--    url : '{{url('get/penyertaan_tanker')}}',--}}
        {{--    success: function(result){--}}
        {{--        console.log(result);--}}
        {{--        for (var i = 0; i < result.data.length; i ++){--}}
        {{--            var status = result.data[i].status1;--}}
        {{--            console.log(status);--}}
        {{--        }--}}
        {{--    }--}}
        {{--})--}}
    });
    function reset(){
        document.getElementById("search-penyertaan").reset();
    }
</script>
