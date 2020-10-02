<?php

namespace App\Http\Controllers;

use App\Anggota;
use App\Functions\NoAnggota;
use App\Pinjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PinjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view ('pinjaman.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $anggota_tanker = Anggota::all()->where('status', 1);
//        echo $anggota_tanker;

        //mendapatkan no_admin sesuai format
        $getLastID = Pinjaman::select('id_peminjaman')->orderBy('id_peminjaman', 'desc')
            ->first();
        $ambil_id = new NoAnggota();
        $ambil_id = $ambil_id->generate($getLastID);
        $prefix = date('Ym');
//        $no_urut = str_pad($ambil_id + 1, 3, '0', STR_PAD_LEFT);
//        $no_admin = $prefix.$no_urut.'-05';

        $no_admin = $prefix.sprintf("%03d", $ambil_id).'-05';
        //menampilkan halaman create dengan mengirimkan data anggota_tanker dan no_admin form pinjaman
        return view('pinjaman.create', compact('anggota_tanker'))
            ->with('no_admin', $no_admin);
    }

    //untuk mengambil data anggota berdasarkan no_anggota
    public function get_anggota_list($no_anggota)
    {
        $anggota = DB::table('tbl_anggota')
            ->join('m_status_pekerja', 'tbl_anggota.id_status_pekerja',
                '=', 'm_status_pekerja.id_status_pekerja')
            ->join('m_bagian', 'tbl_anggota.id_bagian',
                '=', 'm_bagian.id_bagian')
            ->select('tbl_anggota.*', 'm_bagian.nama_bagian',
                'm_status_pekerja.nama_status_pekerja')
            ->where('tbl_anggota.no_anggota', $no_anggota)
            ->get();

        return json_encode($anggota);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validation = Validator::make($request->all(),[
            "tgl_input_pinjam" => "required|date",
            "no_anggota" => "required",
            "jumlah" => "required",
            "kebutuhan" => "string|required",
            "angsuran" => "required",
            "termin" => "required"
        ]);

        if ($validation->fails()){
            return redirect()->back()->withErrors($validation->errors())->withInput();
        }
        $pinjaman = new Pinjaman();
        $pinjaman -> no_admin = $request -> input('no_admin');
        $pinjaman -> no_anggota = $request -> input('no_anggota');
        $pinjaman -> tgl_input_pinjam = date('Y-m-d', strtotime($request->input('tgl_input_pinjam')));
        $pinjaman -> kebutuhan = $request -> input('kebutuhan');
        $pinjaman -> jumlah = preg_replace('/(?:[.]|\,00)/', '$1', $request->input('jumlah'));
        $pinjaman -> angsuran = preg_replace('/(?:[.]|\,00)/', '$1', $request->input('angsuran'));
        $pinjaman -> termin = $request -> input('termin');
        $pinjaman -> save();

        return redirect(url('pinjaman'))->with('status', 'Data berhasil ditambah!');
    }

    public function get_pinjaman_list(Request $request){
        //inspired from https://datatables.yajrabox.com/eloquent/joins
        $pinjaman = Pinjaman::join('tbl_anggota', 'tbl_peminjaman.no_anggota',
            '=', 'tbl_anggota.no_anggota')
            ->select(['tbl_peminjaman.no_admin', 'tbl_anggota.nama',
                'tbl_peminjaman.tgl_input_pinjam', 'tbl_peminjaman.kebutuhan', 'tbl_peminjaman.no_anggota' ,'tbl_peminjaman.angsuran',
                'tbl_peminjaman.termin', 'tbl_peminjaman.jumlah', 'tbl_peminjaman.status']);

        //mengembalikan data ke datatables
        return DataTables::of($pinjaman)
            ->filter(function ($query) use ($request){
                //untuk field pencarian nama di halaman index
                if ($request->has('nama')){
                    $query->where('tbl_anggota.nama', 'like', "%{$request->get('nama')}%");
                }
            })
            ->addColumn('status', function (Pinjaman $status){
                $url = url('');
                if ($status -> status == 1){
                    return '<div><i class="fa fa-check" style="color: limegreen"></i>Approved</div>';
                }
                else if ($status -> status ==2){
                    return '<div><i class="fa fa-close" style="color: red"></i>Rejected</div>';
                }
                else{
                    return "<a type='button' class='btn btn-sm btn-success' id='acceptPinjaman' href='".$url."/approve_pinjaman/".$status-> no_admin."'>Approve</a>
                        <a type='button' class='btn btn-sm btn-danger' id='rejectPinjaman' href='".$url."/reject_pinjaman/".$status->no_admin."'>Reject</a>";
                }
            })
            ->addColumn('action', function (Pinjaman $pinjaman){
                $CSRFToken = csrf_token();
                return "<a type='button' class='btn btn-info btn-sm' href='pinjaman/".$pinjaman->no_admin."/edit' title='Edit'><span class='fa fa-pencil-square'></span></a>
                  <form method='post' action='pinjaman/".$pinjaman->no_admin."/delete'
                  onsubmit='return confirm(\"Hapus data pinjaman $pinjaman->nama ?\")'>
                  <input type=\"hidden\" name=\"_token\" value='".$CSRFToken."'>
                  <input type='hidden' name='_method' value='delete'>
                  <button type=\"submit\" class='btn btn-danger btn-sm' title='Delete'><span class='fa fa-trash'></span></button>
                  </form> ";
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    function acceptPinjaman($no_admin){
        DB::table('tbl_peminjaman')->where('no_admin', $no_admin)->update(['status' => 1]);

        return redirect(url('pinjaman'));
    }

    function rejectPinjaman($no_admin){
        DB::table('tbl_peminjaman')->where('no_admin', $no_admin)->update(['status' => 2]);

        return redirect(url('pinjaman'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $pinjaman = Pinjaman::where('no_admin', $id)->firstOrFail();
        $pinjaman->tgl_input_pinjam = date('d F Y', strtotime($pinjaman->tgl_input_pinjam));
        $pinjaman->angsuran = number_format($pinjaman->angsuran, 0, '.', '.');
        $pinjaman->jumlah = number_format($pinjaman->jumlah, 0, '.', '.');

        return view('pinjaman.edit')->with('pinjaman', $pinjaman);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $pinjaman = Pinjaman::where('no_admin', $id)
            ->firstOrFail();
        $validation = Validator::make($request->all(),[
            "tgl_input_pinjam" => "required|date",
            "jumlah" => "required",
            "kebutuhan" => "string|required",
            "angsuran" => "required",
            "termin" => "required"
        ]);

        if ($validation->fails()){
            return redirect()->back()->withErrors($validation->errors())->withInput();
        }
        $pinjaman -> tgl_input_pinjam = date('Y-m-d', strtotime($request->get('tgl_input_pinjam')));
        $pinjaman -> kebutuhan = $request -> get('kebutuhan');
        $pinjaman -> jumlah = preg_replace('/(?:[.]|\,00)/', '$1', $request->get('jumlah'));
        $pinjaman -> angsuran = preg_replace('/(?:[.]|\,00)/', '$1', $request->get('angsuran'));
        $pinjaman -> termin = $request -> get('termin');
        $pinjaman -> save();

        return redirect(url('pinjaman'))->with('status', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $pinjaman = Pinjaman::where('no_admin', $id);

        $pinjaman->delete();
        //query untuk mereset auto increment kembali ke id terakhir
        DB::select(DB::raw("ALTER TABLE tbl_peminjaman AUTO_INCREMENT = 1"));

        return redirect(url('pinjaman'));
    }
}
