<?php

namespace App\Http\Controllers;

use App\Anggota;
use App\Functions\NoAnggota;
use App\Simpanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SimpananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('simpanan_shu.index');
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

        //generate no_admin ambil simpanan
        $getLastID = Simpanan::select('id_ambil_simpanan')
            ->orderBy('id_ambil_simpanan', 'desc')->first();
        $ambil_id = new NoAnggota();
        $ambil_id = $ambil_id->generate($getLastID);

        $prefix = date('Ym');
//        $no_urut = str_pad($ambil_id + 1, 3, 0, STR_PAD_LEFT);
//        $no_admin = $prefix.$no_urut.'-03';
        $no_admin = $prefix.sprintf("%03d", $ambil_id).'-03';

        return view('simpanan_shu.create', compact('anggota_tanker'))
            ->with('no_admin', $no_admin);
    }

    //mengambil data anggota berdasarkan no_anggota
    public function get_list_anggota($no_anggota)
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
            "tgl_input_ambil_simpanan" => "required|date",
            "alasan" => "required|string",
            "jumlah" => "required",
            "cara_bayar" => "required"
        ]);

        if ($validation->fails()){
            return redirect()->back()->withErrors($validation->errors())->withInput();
        }

        $simpanan_shu = new Simpanan();
        $simpanan_shu -> no_admin = $request -> input('no_admin');
        $simpanan_shu -> no_anggota = $request -> input('no_anggota');
        $simpanan_shu -> tgl_input_ambil_simpanan = date ('Y-m-d', strtotime($request -> input('tgl_input_ambil_simpanan')));
        $simpanan_shu -> alasan = $request -> input('alasan');
        $simpanan_shu -> jumlah = preg_replace('/(?:[.]|\,00)/', '$1', $request->input('jumlah'));
        $simpanan_shu -> cara_bayar = $request -> input('cara_bayar');
        $simpanan_shu -> save();

        return redirect(url('simpanan_shu'))->with('status', 'Data berhasil ditambah!');
    }

    public function get_list_simpanan_shu(Request $request)
    {
        $simpanan_shu = Simpanan::join('tbl_anggota', 'tbl_anggota.no_anggota', '=',
            'tbl_ambil_simpanan.no_anggota')
            ->select(['tbl_ambil_simpanan.id_ambil_simpanan', 'tbl_ambil_simpanan.no_admin',
                'tbl_anggota.nama', 'tbl_ambil_simpanan.no_anggota', 'tbl_anggota.no_hp',
                'tbl_ambil_simpanan.tgl_input_ambil_simpanan', 'tbl_ambil_simpanan.alasan',
                'tbl_ambil_simpanan.jumlah', 'tbl_ambil_simpanan.cara_bayar', 'tbl_ambil_simpanan.status1',
                'tbl_ambil_simpanan.status2']);

        return DataTables::of($simpanan_shu)->filter(function($query) use ($request){
            if($request->has('nama')){
                $query->where('tbl_anggota.nama', 'like', "%{$request->get('nama')}%");
            }
        })->addColumn('action1', function (Simpanan $status){
            $url = url('');
            if($status -> status1 == 1){
                return '<div><i class="fa fa-check" style="color: limegreen"></i>Approved</div>';
            }
            else if ($status -> status1 ==2){
                return '<div><i class="fa fa-close" style="color: red"></i>Rejected</div>';
            }
            else{
                return "<a type='button' class='btn btn-sm btn-success' id='acceptSimpanan1' href='".$url."/approve1_simpanan/".$status-> no_admin."'>Approve</a>
                        <a type='button' class='btn btn-sm btn-danger' id='rejectSimpanan1' href='".$url."/reject1_simpanan/".$status->no_admin."'>Reject</a>";
            }
        })->addColumn('action2', function(Simpanan $status){
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
                    return "<a type='button' class='btn btn-sm btn-success' id='acceptSimpanan2' href='".$url."/approve2_simpanan/".$status-> no_admin."'>Approve</a>
                     <a type='button' class='btn btn-sm btn-danger' id='rejectSimpanan2' href='".$url."/reject2_simpanan/".$status->no_admin."'>Reject</a>";
                }
            }
        })->addColumn('action', function (Simpanan $simpanan){
            $csrf = csrf_token();
            return "<a type='button' class='btn btn-info btn-sm' href='simpanan_shu/".$simpanan->no_admin."/edit' title='Edit'><span class='fa fa-pencil-square'></span></a>
                  <form method='post' action='simpanan_shu/".$simpanan->no_admin."/delete'
                  onsubmit='return confirm(\"Hapus data simpanan $simpanan->nama ?\")'>
                  <input type=\"hidden\" name=\"_token\" value='".$csrf."'>
                  <input type='hidden' name='_method' value='delete'>
                  <button type=\"submit\" class='btn btn-danger btn-sm' title='Delete'><span class='fa fa-trash'></span></button>
                  </form> ";
        })
            ->rawColumns(['action', 'action1', 'action2'])
            ->make(true);
    }

    function acceptSimpanan1($no_admin)
    {
        DB::table('tbl_ambil_simpanan')->where('no_admin', $no_admin)->update(['status1' => 1]);

        return redirect(url('simpanan_shu'));
    }

    function rejectSimpanan1($no_admin)
    {
        DB::table('tbl_ambil_simpanan')->where('no_admin', $no_admin)->update(['status1' => 2]);

        return redirect(url('simpanan_shu'));
    }

    function acceptSimpanan2($no_admin)
    {
        DB::table('tbl_ambil_simpanan')->where('no_admin', $no_admin)->update(['status2' => 1]);

        return redirect(url('simpanan_shu'));
    }

    function rejectSimpanan2($no_admin)
    {
        DB::table('tbl_ambil_simpanan')->where('no_admin', $no_admin)->update(['status2' => 2]);

        return redirect(url('simpanan_shu'));
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
        $simpanan_shu = Simpanan::where('no_admin', $id)->firstOrFail();

        $simpanan_shu->tgl_input_ambil_simpanan = date('d F Y', strtotime($simpanan_shu->tgl_input_ambil_simpanan));
        $simpanan_shu->jumlah = number_format($simpanan_shu->jumlah, 0, '.', '.');

        return view('simpanan_shu.edit')->with('simpanan_shu', $simpanan_shu);
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
        //mengubah data simpanan shu
        $simpanan_shu = Simpanan::where('no_admin', $id)->firstOrFail();
        //form validasi
        $validation = Validator::make($request->all(), [
            "tgl_input_ambil_simpanan" => "required|date",
            "alasan" => "required|string",
            "jumlah" => "required",
            "cara_bayar" => "required"
        ]);

        if ($validation->fails()){
            return redirect()->back()->withErrors($validation->errors())->withInput();
        }

        $simpanan_shu -> tgl_input_ambil_simpanan = date ('Y-m-d', strtotime($request -> input('tgl_input_ambil_simpanan')));
        $simpanan_shu -> alasan = $request -> input('alasan');
        $simpanan_shu -> jumlah = preg_replace('/(?:[.]|\,00)/', '$1', $request->input('jumlah'));
        $simpanan_shu -> cara_bayar = $request -> input('cara_bayar');
        $simpanan_shu -> save();

        return redirect(url('simpanan_shu'))->with('status', 'Data berhasil diubah!');
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
        $simpanan = Simpanan::where('no_admin', $id);

        $simpanan->delete();

        DB::select(DB::raw("ALTER TABLE tbl_ambil_simpanan AUTO_INCREMENT = 1"));


        return redirect(url('simpanan_shu'));
    }
}
