<?php

namespace App\Http\Controllers;

use App\Anggota;
use App\Bagian;
use App\Functions\NoAnggota;
use App\statusPekerja;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $status_kerja = statusPekerja::all();

        return view('anggota.index', compact('status_kerja'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $status_kerja = statusPekerja::all();
        //menngambil data bagian
        $bagian = Bagian::all();

        //menggenerate Nomor Anggota
        $getLast_ID = Anggota::select('id')->orderBy('id', 'desc')->first();
        $ambil_id = new NoAnggota();
        $ambil_id = $ambil_id->generate($getLast_ID);
        $prefix = date('Ym');
        $no_admin =  $prefix.sprintf("%03d", $ambil_id).'-01';

        return view('anggota.create', compact('status_kerja', 'bagian'))
            ->with('no_admin', $no_admin);
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
            "tgl_input" => "date",
            "nama" => "required",
            "identitas" => "required",
            "nomor_identitas" => "required",
            "alamat_kantor" => "min:10|max:500",
            "no_hp" => "required",
            "no_rekening" => "required",
            "bank" => "required",
            "nama_rekening" => "required",
            "bagian" => "required",
            "no_pekerja" => "required|unique:tbl_anggota",
            "simpanan_pokok" => "required",
            "simpanan_wajib" => "required",
            "simpanan_sukarela" => "required",
            "cara_pembayaran" => "required",
            "tgl_mulai_potong" => "required"

        ],
            [
                "no_pekerja.unique" => "Nomor Pekerja sudah terdaftar",
                "alamat_kantor.min" => "Alamat Kantor setidaknya 10 karakter",
                "no_hp.digits_between" => "No HP harus berisi angka sebanyak 10-12 karakter"
            ]);

        if ($validation->fails())
        {
            return redirect()->back()->withErrors($validation->errors())->withInput();
        }


        $anggota = new Anggota();
        $anggota -> tgl_input = date('Y-m-d', strtotime($request->input('tgl_input')));
        $anggota -> no_admin = $request->input('no_admin');
        $anggota -> no_anggota = $request->input('no_anggota');
        $anggota -> nama = $request->input('nama');
        $anggota -> id_status_pekerja = $request->input('status_kerja');
        $anggota -> identitas = $request->input('identitas');
        $anggota -> nomor_identitas = $request->input('nomor_identitas');
        $anggota -> nik = $request->input('identitas');
        $anggota -> alamat_kantor = $request->input('alamat_kantor');
        $anggota -> no_hp = $request->input('no_hp');
        $anggota -> no_rek_payroll = $request->input('no_rekening');
        $anggota -> bank = $request->input('bank');
        $anggota -> nama_rekening = $request->input('nama_rekening');
        $anggota -> id_bagian = $request->input('bagian');
        $anggota -> no_pekerja = $request->input('no_pekerja');
//        $anggota -> kebutuhan = json_encode($kebutuhan);
//        foreach (Input::get('kebutuhan') as $key => $val){
//            $anggota->kebutuhan = Input::get('kebutuhan.$key');
//        }
        $anggota -> simpanan_pokok = preg_replace('/(?:[.]|\,00)/', '$1', $request->input('simpanan_pokok'));
        $anggota -> simpanan_wajib = preg_replace('/(?:[.]|\,00)/', '$1', $request->input('simpanan_wajib'));
        $anggota -> simpanan_sukarela = preg_replace('/(?:[.]|\,00)/', '$1', $request->input('simpanan_sukarela'));
        $anggota -> cara_pembayaran = $request->input('cara_pembayaran');
        $anggota -> tgl_mulai_potong = date('Y-m-d', strtotime($request->input('tgl_mulai_potong')));
        $anggota -> save();
        return redirect(url('anggota'))->with('status', 'Data berhasil ditambah!');

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

    //mengembalikan data anggota ke datatable
    public function get_anggota_list(Request $request)
    {
        //inspired from https://datatables.yajrabox.com/eloquent/joins
        $anggota = Anggota::join('m_status_pekerja', 'tbl_anggota.id_status_pekerja',
            '=', 'm_status_pekerja.id_status_pekerja')
            -> select(['tbl_anggota.no_admin', 'tbl_anggota.nama', 'tbl_anggota.no_hp',
                'm_status_pekerja.nama_status_pekerja', 'tbl_anggota.tgl_mulai_potong', 'tbl_anggota.bank',
                'tbl_anggota.simpanan_pokok', 'tbl_anggota.simpanan_wajib', 'tbl_anggota.simpanan_sukarela',
                'tbl_anggota.cara_pembayaran', 'tbl_anggota.status']);

//            $from = Carbon::parse($request->tanggal_awal);
//            $to = Carbon::parse($request->tanggal_akhir);

        //mengembalikan data ke datatable
        return DataTables::of($anggota)
            ->filter(function ($query) use ($request){
                //pencarian berdasarkan nama
                if ($request->has('nama')){
                    $query->where('tbl_anggota.nama', 'like', "%{$request->get('nama')}%");
                }
                //pencarian berdasarkan status pekerjaan
                if ($request->has('status_kerja')){
                    $query->where('m_status_pekerja.nama_status_pekerja', 'like', "%{$request->get('status_kerja')}%");
                }
                /*
                 * Activate this code if want to enable filter date feature
                 */
//                if($request->has('tanggal_awal') and $request->has('tanggal_akhir'))
//                {
//                    $from = Carbon::parse($request->tanggal_awal);
//                    $to = Carbon::parse($request->tanggal_akhir);
//                    $query->whereBetween('tbl_anggota.tgl_mulai_potong', [$from, $to]);
////                        [$request->get('tanggal_awal'), $request->get('tanggal_akhir')]);
//                }
            })
            ->addColumn('action', function (Anggota $member){
                $CSRFToken = csrf_token();
                return "<a type='button' class='btn btn-info btn-sm' href='anggota/".$member->no_admin."/edit' title='Edit'><span class='fa fa-pencil-square'></span></a>
                  <form method='post' action='anggota/".$member->no_admin."'
                  onsubmit='return confirm(\"Hapus data anggota $member->nama?\")'>
                  <input type=\"hidden\" name=\"_token\" value='".$CSRFToken."'>
                  <input type='hidden' name='_method' value='delete'>
                  <button type=\"submit\" class='btn btn-danger btn-sm' title='Delete'><span class='fa fa-trash'></span></button>
                  </form>
                    ";
            })
            ->addColumn('status', function(Anggota $status) {
                $perbandingan = $status->status;
                $url = url('');
//                echo $perbandingan;
                if ($perbandingan == 1) {
                    return '<div><i class="fa fa-check" style="color: limegreen"></i>Approved</div>';
                } elseif ($perbandingan == 2) {
                    return '<div><i class="fa fa-close" style="color: red"></i>Rejected</div>';
                } else {
                    return "<a type='button' class='btn btn-sm btn-success' id='acceptAnggota' href='".$url."/approve_anggota/".$status-> no_admin."'>Approve</a>
                        <a type='button' class='btn btn-sm btn-danger' id='rejectAnggota' href='".$url."/reject_anggota/".$status->no_admin."'>Reject</a>";
//                    return "/<p>Muhsin Ganteng</p>/";
                }
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
//        return Datatables::of($anggota)->make(true);
    }
//<a type='button' class='btn btn-danger btn-sm' action='anggota/".$member->no_admin."/hapus'>Hapus</a>
    //mengubah nilai status karyawan dan status_anggota apabila disetujui admin
    function acceptAnggota($no_admin){
        DB::table('tbl_anggota')->where('no_admin', $no_admin)->update(['status' => 1, 'id_status_anggota' => 1]);

        return redirect(url('anggota'));
    }

    //mengubah nilai status karyawan dan status_anggota apabila ditolak admin
    function rejectAnggota($no_admin){
        DB::table('tbl_anggota')->where('no_admin', $no_admin)->update(['status' => 2]);

        return redirect(url('anggota'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

        public function edit($no_admin)
    {
        //
        $anggota = Anggota::where('no_admin', $no_admin)->firstOrFail();
//        echo $anggota;
        $status_kerja = statusPekerja::all();
        //mengambil seluruh data dari model bagian
        $bagian = Bagian::all();

        $anggota->tgl_input = date('d F Y', strtotime($anggota->tgl_input));
        $anggota->simpanan_pokok = number_format($anggota->simpanan_pokok, 0, '.', '.');
        $anggota->simpanan_wajib = number_format($anggota->simpanan_wajib, 0, '.', '.');
        $anggota->simpanan_sukarela = number_format($anggota->simpanan_sukarela, 0, '.', '.');
        $anggota->tgl_mulai_potong = date ('d F Y', strtotime($anggota->tgl_mulai_potong));

//        echo gettype($anggota);
//        echo gettype($status_kerja);
//        echo gettype($bagian);

        return view('anggota.edit', compact('status_kerja', 'bagian'))
            ->with('anggota', $anggota);
//            ->with('bagian', $bagian)->with('status_kerja', $status_kerja);
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
        $anggota = Anggota::where('no_admin', $id)->firstOrFail();
//        sdasdsads;
        $validation = Validator::make($request->all(), [
            "tgl_input" => "date",
            "nama" => "required",
            "identitas" => "required",
            "nomor_identitas" => "required",
            "alamat_kantor" => "min:10|max:500",
            "no_hp" => "required",
            "no_rekening" => "required",
            "bank" => "required",
            "nama_rekening" => "required",
            "bagian" => "required",
            "no_pekerja" => "required",
            "simpanan_pokok" => "required",
            "simpanan_wajib" => "required",
            "simpanan_sukarela" => "required",
            "cara_pembayaran" => "required",
            "tgl_mulai_potong" => "required"

        ],
            [
                "alamat_kantor.min" => "Alamat Kantor setidaknya 10 karakter",
                "no_hp.digits_between" => "No HP harus berisi angka sebanyak 10-12 karakter"
            ]);

        if ($validation->fails())
        {
            return redirect()->back()->withErrors($validation->errors())->withInput();
        }
//        $anggota = new Anggota_Tanker();
        $anggota -> tgl_input = date('Y-m-d', strtotime($request->get('tgl_input')));
        $anggota -> nama = $request->get('nama');
        $anggota -> id_status_pekerja = $request->get('status_kerja');
        $anggota -> identitas = $request->get('identitas');
        $anggota -> nomor_identitas = $request->get('nomor_identitas');
        $anggota -> nik = $request->get('identitas');
        $anggota -> alamat_kantor = $request->get('alamat_kantor');
        $anggota -> no_hp = $request->get('no_hp');
        $anggota -> no_rek_payroll = $request->get('no_rekening');
        $anggota -> bank = $request->get('bank');
        $anggota -> nama_rekening = $request->get('nama_rekening');
        $anggota -> id_bagian = $request->get('bagian');
        $anggota -> no_pekerja = $request->get('no_pekerja');
//        $anggota -> kebutuhan = json_encode($kebutuhan);
//        foreach (Input::get('kebutuhan') as $key => $val){
//            $anggota->kebutuhan = Input::get('kebutuhan.$key');
//        }
        $anggota -> simpanan_pokok = preg_replace('/(?:[.]|\,00)/', '$1', $request->get('simpanan_pokok'));
        $anggota -> simpanan_wajib = preg_replace('/(?:[.]|\,00)/', '$1', $request->get('simpanan_wajib'));
        $anggota -> simpanan_sukarela = preg_replace('/(?:[.]|\,00)/', '$1', $request->get('simpanan_sukarela'));
        $anggota -> cara_pembayaran = $request->get('cara_pembayaran');
        $anggota -> tgl_mulai_potong = date('Y-m-d', strtotime($request->get('tgl_mulai_potong')));
        $anggota -> save();

        return redirect(url('anggota'))->with('status', 'Data berhasil diperbarui');
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
        //
        $anggota = DB::table('tbl_anggota')
                ->where('no_admin', $id);

        $anggota->delete();
        //query untuk mereset auto increment kembali ke id terakhir
        DB::select(DB::raw("ALTER TABLE tbl_anggota AUTO_INCREMENT = 1"));

        return redirect(url('anggota'));
    }
}
