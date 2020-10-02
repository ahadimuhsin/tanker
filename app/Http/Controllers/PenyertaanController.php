<?php

namespace App\Http\Controllers;

use App\Anggota;
use App\Functions\NoAnggota;
use App\Penyertaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PenyertaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('penyertaan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $anggota = Anggota::all()->where('status', '=', 1);

        //mendapatkan nomor admin sesuai format
        $getLastID = Penyertaan::select('id_penyertaan')
            ->orderBy('id_penyertaan', 'desc')->first();
        $ambil_id = new NoAnggota();
        $ambil_id = $ambil_id->generate($getLastID);

        $prefix = date('Ym');

        $no_admin = $prefix.sprintf("%03d", $ambil_id).'-06';
        return view('penyertaan.create', compact('anggota'))
            ->with('no_admin', $no_admin);
    }

    //mengambil data anggota berdasarkan no_anggota
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
        $validation = Validator::make($request->all(), [
            "no_anggota" => "required",
            "tgl_input_penyertaan" => "required|date",
            "jumlah" => "required"
        ]);

        if ($validation->fails()){
            return redirect()->back()->withErrors($validation->errors())->withInput();
        }

        $penyertaan = new Penyertaan();
        $penyertaan -> no_admin = $request -> input('no_admin');
        $penyertaan -> no_anggota = $request->input('no_anggota');
        $penyertaan -> tgl_input_penyertaan = date('Y-m-d', strtotime($request->input('tgl_input_penyertaan')));
        $penyertaan -> jumlah = preg_replace('/(?:[.]|\,00)/', '$1', $request->input('jumlah'));
        $penyertaan -> save();

        return redirect(url('penyertaan'))->with('status', 'Data berhasil ditambah!');
    }

    public function get_list_penyertaan(Request $request)
    {

        //inspired from https://datatables.yajrabox.com/eloquent/joins
        $penyertaan = Penyertaan::join('tbl_anggota', 'tbl_anggota.no_anggota',
            '=', 'tbl_penyertaan.no_anggota')
            -> select (['tbl_penyertaan.id_penyertaan', 'tbl_penyertaan.no_admin', 'tbl_anggota.nama', 'tbl_penyertaan.no_anggota' ,'tbl_anggota.no_hp',
                'tbl_penyertaan.tgl_input_penyertaan', 'tbl_anggota.bank', 'tbl_penyertaan.jumlah', 'tbl_penyertaan.status1', 'tbl_penyertaan.status2']);

        return DataTables::of($penyertaan)->filter(function($query) use ($request){
            if($request->has('nama')){
                $query->where('tbl_anggota.nama', 'like', "%{$request->get('nama')}%");
            }
        })->addColumn('action1', function (Penyertaan $status){
            $url = url('');
            if($status -> status1 == 1){
                return '<div><i class="fa fa-check" style="color: limegreen"></i>Approved</div>';
            }
            else if ($status -> status1 ==2){
                return '<div><i class="fa fa-close" style="color: red"></i>Rejected</div>';
            }
            else{
                return "<a type='button' class='btn btn-sm btn-success' id='acceptPenyertaan1' href='".$url."/approve1_penyertaan/".$status-> no_admin."'>Approve</a>
                        <a type='button' class='btn btn-sm btn-danger' id='rejectPenyertaan1' href='".$url."/reject1_penyertaan/".$status->no_admin."'>Reject</a>";
            }
        })->addColumn('action2', function(Penyertaan $status){
            $url = url('');
            if ($status->status1 ==2){
                return 'Data tidak bisa disetujui';
            }
            else if($status->status1 == null){
                return 'Mohon tentukan status 1 terlebih dahulu';
            }
            else{
                if ($status->status2 == 1){
                    return '<div><i class="fa fa-check" style="color: limegreen"></i>Approved</div>';
                }
                else if ($status->status2 == 2){
                    return '<div><i class="fa fa-close" style="color: red"></i>Rejected</div>';
                }
                else{
                    return "<a type='button' class='btn btn-sm btn-success' id='acceptPenyertaan2' href='".$url."/approve2_penyertaan/".$status-> no_admin."'>Approve</a>
                     <a type='button' class='btn btn-sm btn-danger' id='rejectPenyertaan2' href='".$url."/reject2_penyertaan/".$status->no_admin."'>Reject</a>";
                }
            }
        })->addColumn('action', function (Penyertaan $penyertaan){
            $csrf = csrf_token();
            return "<a type='button' class='btn btn-info btn-sm' href='penyertaan/".$penyertaan->no_admin."/edit' title='Edit'><span class='fa fa-pencil-square'></span></a>
                  <form method='post' action='penyertaan/".$penyertaan->no_admin."'
                  onsubmit='return confirm(\"Hapus data penyertaan $penyertaan->nama ?\")'>
                  <input type=\"hidden\" name=\"_token\" value='".$csrf."'>
                  <input type='hidden' name='_method' value='delete'>
                  <button type=\"submit\" class='btn btn-danger btn-sm' title='Delete'><span class='fa fa-trash'></span></button>
                  </form> ";

        })
            ->rawColumns(['action1', 'action2', 'action'])
            ->make(true);
    }

    function acceptPenyertaan1($no_admin)
    {
        DB::table('tbl_penyertaan')->where('no_admin', $no_admin)->update(['status1' => 1]);

        return redirect(url('penyertaan'));
    }

    function rejectPenyertaan1($no_admin)
    {
        DB::table('tbl_penyertaan')->where('no_admin', $no_admin)->update(['status1' => 2]);

        return redirect(url('penyertaan'));
    }

    function acceptPenyertaan2($no_admin)
    {
        DB::table('tbl_penyertaan')->where('no_admin', $no_admin)->update(['status2' => 1]);

        return redirect(url('penyertaan'));
    }

    function rejectPenyertaan2($no_admin)
    {
        DB::table('tbl_penyertaan')->where('no_admin', $no_admin)->update(['status2' => 2]);

        return redirect(url('penyertaan'));
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
        $penyertaan = Penyertaan::where('no_admin', $id)->firstOrFail();
        $penyertaan->tgl_input_penyertaan = date('d F Y', strtotime($penyertaan->tgl_input_penyertaan));
        $penyertaan->jumlah = number_format($penyertaan->jumlah, 0, '.', '.');

        return view('penyertaan.edit')->with('penyertaan', $penyertaan);
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
        $penyertaan = Penyertaan::where('no_admin', $id)->firstOrFail();

        $validation = Validator::make($request->all(), [
            "tgl_input_penyertaan" => "required|date",
            "jumlah" => "required"
        ]);

        if ($validation->fails()){
            return redirect()->back()->withErrors($validation->errors())->withInput();
        }
        $penyertaan -> tgl_input_penyertaan = date('Y-m-d', strtotime($request->input('tgl_input_penyertaan')));
        $penyertaan -> jumlah = preg_replace('/(?:[.]|\,00)/', '$1', $request->input('jumlah'));
        $penyertaan -> save();

        return redirect(url('penyertaan'))->with('Data berhasil diubah');
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
        $penyertaan = Penyertaan::where('no_admin', $id)->firstOrFail();

        $penyertaan->delete();
        DB::select(DB::raw("ALTER TABLE tbl_penyertaan AUTO_INCREMENT = 1"));


        return redirect(url('penyertaan'));
    }
}
