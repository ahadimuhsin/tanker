<script>

    $(document).ready(function() {
        moment.locale('id'); //dari library moment.js
        var table = $("#table-anggota").DataTable({
            dom :'lfBrtip',
            processing: true,
            serverSide: true,
            responsive: true,
            "pagingType" : "full_numbers",
            type: "GET",
            // "lengthChange" : false,
            "lengthMenu": [10, 25, 50, 100],
            // page: 'all',
            order: [[ 1, 'desc' ]],
            searching : false,
            ajax: {
                url: "get/anggota_tanker",
                data: function (d) {
                    d.nama = $('#nama').val();
                    d.status_kerja = $('#status_kerja').val();
                    /*
                    For filter date feature
                     */
                    // d.tanggal_awal = $('#tanggal_awal').val();
                    // d.tanggal_akhir = $('#tanggal_akhir').val();
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
                    data: 'no_admin', name: 'tbl_anggota.no_admin'
                },
                {
                    data: 'nama', name: 'tbl_anggota.nama'
                },
                {
                    data: 'no_hp', name: 'tbl_anggota.no_hp', 'orderable': false
                },
                {
                    data: 'nama_status_pekerja', 'orderable': false, name: 'm_status_pekerja.nama_status_pekerja'
                },
                {
                    data: 'tgl_mulai_potong',
                    name: 'tbl_anggota.tgl_mulai_potong',
                    type: 'date',
                    render: function(value){
                        if (value === null) return "";
                        return moment(value).format('LL');
                    }
                },
                {
                    data: 'bank',
                    name: 'tbl_anggota.bank'
                },
                {
                    data: 'simpanan_pokok',
                    name: 'tbl_anggota.simpanan_pokok',
                    render: $.fn.dataTable.render.number( '.', '.', 0, 'Rp ' )
                },
                {
                    data: 'simpanan_wajib',
                    name: 'tbl_anggota.simpanan_wajib',
                    render: $.fn.dataTable.render.number( '.', '.', 0, 'Rp ' )
                },
                {
                    data: 'simpanan_sukarela',
                    name: 'tbl_anggota.simpanan_sukarela',
                    render: $.fn.dataTable.render.number( '.', '.', 0, 'Rp ' )
                },
                {
                    data: 'cara_pembayaran',
                    'orderable' : false,
                    name: "tbl_anggota.cara_pembayaran"
                },
                {
                    data: 'status',
                    name: 'status',
                    'orderable': false
                },
                {
                    data: 'action',
                    name: 'action',
                    'orderable': false
                }
            ],
            buttons: [
                {
                    extend : 'pdf',
                    orientation : 'landscape',
                    text: 'PDF',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9,10]
                    },
                    filename: function()
                    {
                        var today = new Date();
                        var dd = String(today.getDate()).padStart(2,'0');
                        var mm = String(today.getMonth()+1).padStart(2, '0');
                        var yyyy = today.getFullYear();
                        var time = today.getHours() + "." + today.getMinutes() + "." + today.getSeconds();
                        var full_date = dd + "-" + mm + "-" + yyyy;
                        return 'Daftar Anggota' + ' ' + full_date + ' ' + time;
                    },
                },
                {
                    extend: 'excel',
                    text: 'Excel',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9,10]
                    },
                    filename: function()
                    {
                        var today = new Date();
                        var dd = String(today.getDate()).padStart(2,'0');
                        var mm = String(today.getMonth()+1).padStart(2, '0');
                        var yyyy = today.getFullYear();
                        var time = today.getHours() + "." + today.getMinutes() + "." + today.getSeconds();
                        var full_date = dd + "-" + mm + "-" + yyyy;
                        return 'Daftar Anggota' + ' ' + full_date + ' ' + time;
                    },
                },
            ],
        });

        $('#search-anggota').on('submit', function (e) {
            table.draw();
            e.preventDefault();
            table.ajax.reload();
        });

        $("#tanggal_awal").datepicker({
            onSelect: function(){
                table.draw()
            },
            format: "dd MM yyyy",
            autoclose: true,
            changeMonth: true,
            changeYear: true,
            // viewMode: "months",
            // minViewMode: "months"
        });
        $("#tanggal_akhir").datepicker({
            onSelect: function(){
                table.draw()
            },
            format: "dd MM yyyy",
            autoclose: true,
            changeMonth: true,
            changeYear: true,
            // viewMode: "months",
            // minViewMode: "months"
        });

        $('#tanggal_awal, #tanggal_akhir').change(function(){
           table.draw();
        });

        $(".alert-success").fadeTo(2000,500).slideUp(500, function(){
           $('.alert-success').slideUp(500);
        });
    });
    function reset() {
        document.getElementById("search-anggota").reset();
    }
</script>
