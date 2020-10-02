<script>
    $(document).ready(function () {
        moment.locale('id');
        var table = $("#table-pinjaman").DataTable({
            dom : 'lfBrtip',
            processing: true,
            serverSide: true,
            responsive: true,
            "pagingType" : "full_numbers",
            type: "GET",
            // "lengthChange" : false,
            "lengthMenu": [10, 25, 50, 100],
            order : [[1, 'desc']],
            searching: false,
            ajax: {
                url : "{{url('get/pinjaman_tanker')}}",
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
                    name: 'tbl_peminjaman.no_admin'
                },
                {
                    data: "nama",
                    name: "tbl_anggota.nama"
                },
                {
                    data: "no_anggota",
                    name: "tbl_peminjaman.no_anggota"
                },
                {
                    data: "tgl_input_pinjam",
                    name: "tbl_peminjaman.tgl_input_pinjam",
                    type: 'date', render:function(value){
                        if (value === null) return "";
                        return moment(value).format('LL');
                    }
                },
                {
                    data: "kebutuhan",
                    name: "tbl_peminjaman.kebutuhan"
                },
                {
                    data: "angsuran",
                    name: "tbl_peminjaman.angsuran",
                    'orderable':false,
                    render: $.fn.dataTable.render.number( '.', '.', 0, 'Rp ' )
                },
                {
                    data: "termin",
                    name: "tbl_peminjaman.termin",
                    render:function(data){
                        return data + ' ' + 'Bulan'
                    }
                },
                {
                    data: "jumlah",
                    name: "tbl_peminjaman.jumlah",
                    render: $.fn.dataTable.render.number( '.', '.', 0, 'Rp ' )
                },
                {
                  data: 'status',
                  name: 'status',
                  'orderable': false
                },
                {
                    data: "action",
                    name: "action",
                    'orderable': false
                }
            ],
            buttons: [
                {
                    extend : 'pdf',
                    orientation : 'landscape',
                    // text: 'PDF',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9]
                    },
                    text: 'PDF',
                    filename: function()
                    {
                        var today = new Date();
                        var dd = String(today.getDate()).padStart(2,'0');
                        var mm = String(today.getMonth()+1).padStart(2, '0');
                        var yyyy = today.getFullYear();
                        var time = today.getHours() + "." + today.getMinutes() + "." + today.getSeconds();
                        var full_date = dd + "-" + mm + "-" + yyyy;
                        return 'Daftar Pinjaman' + ' ' + full_date + ' ' + time;
                    },
                },
                {
                    extend: 'excel',
                    text: 'Excel',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9]
                    },
                    filename: function()
                    {
                        var today = new Date();
                        var dd = String(today.getDate()).padStart(2,'0');
                        var mm = String(today.getMonth()+1).padStart(2, '0');
                        var yyyy = today.getFullYear();
                        var time = today.getHours() + "." + today.getMinutes() + "." + today.getSeconds();
                        var full_date = dd + "-" + mm + "-" + yyyy;
                        return 'Daftar Pinjaman' + ' ' + full_date + ' ' + time;
                    },
                },
            ],
        });

        $('#search-pinjaman').on('submit', function (e) {
            table.draw();
            e.preventDefault();
            table.ajax.reaload();
        });

        $(".alert-success").fadeTo(2000,500).slideUp(500, function(){
            $('.alert-success').slideUp(500);
        });
    });
    function reset(){
        document.getElementById("search-pinjaman").reset();
    }
</script>
