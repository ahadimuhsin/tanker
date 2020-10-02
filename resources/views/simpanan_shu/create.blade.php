@extends('layouts.master')
@section('script')
    @include('simpanan_shu.form_validasi');
    @include('simpanan_shu.simpanan_js');
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="blue">
                        <i class="material-icons">account_balance</i>
                    </div>

                    <div class="card-content">
                        <h4 class="card-title">Simpanan & SHU</h4>
                        <form id="fpro" action="{{route('simpanan_shu.store')}}" method="post" enctype="multipart/form-data">
                            <input type="hidden" value="{{csrf_token()}}" name="_token">
                            <div class="wizard-header">
                                <h3 class="wizard-title">
                                    Tambah Simpanan & SHU
                                </h3>
                            </div>

                            @if($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>

                                    @foreach($errors->all() as $error)
                                        <li> {{$error }}</li><br/>
                                    @endforeach
                                </div>
                            @endif

                            <div class="col-md-6">

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">card_membership</i>
                                    </span>
                                    <div class="form-group label-floating">
                                        <label class="control-label">No. Admin</label>
                                        <input type="text" id="no_admin" name="no_admin" class="form-control"
                                               value="{{$no_admin}}" readonly>
                                    </div>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">card_membership</i>
                                    </span>
                                    <div class="form-group">
                                        <label class="control-label">No. Anggota</label>
                                        <select name="no_anggota" id="no_anggota" class="form-control">--}}
                                            <option value="">Pilih No. Anggota</option>
                                            @foreach($anggota_tanker as $anggota)
                                                <option value="{{$anggota->no_anggota}}">
                                                    {{$anggota->no_anggota}} - {{$anggota->nama}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">people</i>
                                    </span>
                                    <div class="form-group">
                                        <label class="control-label">Nama</label>
                                        <input type="text" id="nama" name="nama" class="form-control" readonly>
                                    </div>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">card_membership</i>
                                    </span>
                                    <div class="form-group">
                                        <label class="control-label">No. Pekerja</label>
                                        <input type="text" id="no_pekerja" name="no_pekerja" class="form-control" readonly>
                                    </div>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">work</i>
                                    </span>
                                    <div class="form-group">
                                        <label class="control-label">Fungsi/Bagian</label>
                                        <input type="text" id="bagian" name="bagian" class="form-control" readonly>
                                    </div>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">work</i>
                                    </span>
                                    <div class="form-group">
                                        <label class="control-label">Status</label>
                                        <input type="text" id="status" name="status" class="form-control" readonly>
                                    </div>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">card_membership</i>
                                    </span>
                                    <div class="form-group">
                                        <label class="control-label">Identitas</label>
                                        <input type="text" id="identitas" name="identitas" class="form-control" readonly>
                                    </div>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">card_membership</i>
                                    </span>
                                    <div class="form-group">
                                        <label class="control-label">Nomor Identitas</label>
                                        <input type="text" id="nomor_identitas" name="nomor_identitas" class="form-control" readonly>
                                    </div>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">add_location_alt</i>
                                    </span>
                                    <div class="form-group">
                                        <label class="control-label">Alamat Kantor</label>
                                        <textarea type="text" id="alamat_kantor" name="alamat_kantor" class="form-control" readonly></textarea>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">smartphone</i>
                                    </span>
                                    <div class="form-group">
                                        <label class="control-label">No. HP</label>
                                        <input type="text" id="no_hp" name="no_hp" class="form-control" readonly>
                                    </div>
                                </div>



                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">account_balance</i>
                                    </span>
                                    <div class="form-group">
                                        <label class="control-label">No. Rekening</label>
                                        <input type="text" id="no_rekening" name="no_rekening" class="form-control" readonly>
                                    </div>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">account_balance</i>
                                    </span>
                                    <div class="form-group">
                                        <label class="control-label">Bank</label>
                                        <input type="text" id="bank" name="bank" class="form-control" readonly>
                                    </div>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">account_balance</i>
                                    </span>
                                    <div class="form-group">
                                        <label class="control-label">Nama Rekening </label>
                                        <input type="text" id="nama_rekening" name="nama_rekening" class="form-control" readonly>
                                    </div>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">calendar_today</i>
                                    </span>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Tanggal Input Pengambilan Simpanan </label>
                                        <input type="text" id="tgl_input_ambil_simpanan" name="tgl_input_ambil_simpanan" class="form-control" value="{{old('tgl_input_ambil_simpanan')}}">
                                    </div>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">question_answer</i>
                                    </span>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Alasan</label>
                                        <input type="text" id="alasan" name="alasan" class="form-control" value="{{old('alasan')}}">
                                    </div>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">attach_money</i>
                                    </span>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Jumlah</label>
                                        <input type="text" id="jumlah" name="jumlah" class="form-control" value="{{old('jumlah')}}" onkeyup="formatRupiah(this, '')">
                                    </div>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">payments</i>
                                    </span>
                                    <div class="form-group">
                                        <label class="control-label">Cara Pembayaran</label>
                                        <select id="cara_bayar" name="cara_bayar" class="form-control">
                                            <option value="">Pilih Cara Pembayaran</option>
                                            <option value="Transfer">Transfer</option>
                                            <option value="Payroll">Payroll</option>
                                            <option value="Autodebet">Autodebet</option>
                                            <option value="Jasa Penyertaan">Jasa Penyertaan</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="pull-right">
                                    <div class="col-md-12">
                                        <a id="btnsimpan" class="btn btn-fill btn-success"><i class="fa fa-save"></i> </a>
                                        <a id="btn_back" class="btn btn-fill btn-warning" href="javascript:history.back()"><i class="fa fa-arrow-left"></i> </a>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
