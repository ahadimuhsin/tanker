@extends('layouts.master')
@section('script')
    @include('penyertaan.form_validasi');
    @include('penyertaan.penyertaan_js');
@endsection
@section('content')

{{--    <div class="container-fluid">--}}
{{--        <div class="row">--}}
{{--            <div class="col-sm-10 col-sm-offset-1">--}}
{{--                <div class="wizard-container">--}}
{{--                    <div class="card wizard-card" data-color="rose" id="wizardProfile">--}}
{{--                        <form id="fpro" method="post" action="{{url('post/penyertaan_tanker')}}" enctype="multipart/form-data">--}}
{{--                            <input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
{{--                            <div class="wizard-header">--}}
{{--                                <h3 class="wizard-title">--}}
{{--                                    Tambah Penyertaan Modal--}}
{{--                                </h3>--}}
{{--                            </div>--}}

{{--                            @if($errors->any())--}}
{{--                                <div class="alert alert-danger" role="alert">--}}
{{--                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
{{--                                        <span aria-hidden="true">×</span>--}}
{{--                                    </button>--}}

{{--                                    @foreach($errors->all() as $error)--}}
{{--                                        <li> {{ $error }}</li><br/>--}}
{{--                                    @endforeach--}}

{{--                                </div>--}}
{{--                            @endif--}}

{{--                            <div class="row">--}}
{{--                                <label class="col-md-3" style="margin-top:30px; margin-left: 30px; color: #0b0b0b">No. Admin</label>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <input type="text" id="no_admin" name="no_admin" class="form-control" value="{{$no_admin}}" readonly>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="row">--}}
{{--                                <label class="col-md-3" style="margin-top:30px; margin-left: 30px; color: #0b0b0b">No. Anggota</label>--}}
{{--                                <div class="col-md-5">--}}
{{--                                    <select name="no_anggota" id="no_anggota" class="form-control">--}}
{{--                                        <option value="">Pilih No. Anggota</option>--}}
{{--                                        @foreach($anggota_tanker as $anggota)--}}
{{--                                            <option value="{{$anggota->no_anggota}}">--}}
{{--                                                {{$anggota->no_anggota}} - {{$anggota->nama}}--}}
{{--                                            </option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="row">--}}
{{--                                <label class="col-md-3" style="margin-top:30px; margin-left: 30px; color: #0b0b0b">Nama</label>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <input type="text" id="nama" name="nama" class="form-control" readonly>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="row">--}}
{{--                                <label class="col-md-3" style="margin-top:30px; margin-left: 30px; color: #0b0b0b">No. Pekerja</label>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <input type="text" id="no_pekerja" name="no_pekerja" class="form-control" readonly>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="row">--}}
{{--                                <label class="col-md-3" style="margin-top:30px; margin-left: 30px; color: #0b0b0b">Fungsi / Bagian</label>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <input type="text" id="bagian" name="bagian" class="form-control" readonly>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="row">--}}
{{--                                <label class="col-md-3" style="margin-top:30px; margin-left: 30px; color: #0b0b0b">Status</label>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <input id="status" name="status" class="form-control" readonly>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="row">--}}
{{--                                <label class="col-md-3" style="margin-top:30px; margin-left: 30px; color: #0b0b0b">Identitas</label>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <input id="identitas" name="identias" class="form-control" readonly>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="row" id="nomor_id" style="display: none">--}}
{{--                                <label class="col-md-3" style="margin-top:30px; margin-left: 30px; color: #0b0b0b">Nomor Identitas</label>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <input id="nomor_identitas" type="text" name ="nomor_identitas" class="form-control" readonly>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="row">--}}
{{--                                <label class="col-md-3" style="margin-top:30px; margin-left: 30px; color: #0b0b0b">Alamat Kantor</label>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <input type="text" id="alamat_kantor" name="alamat_kantor" class="form-control" readonly>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="row">--}}
{{--                                <label class="col-md-3" style="margin-top:30px; margin-left: 30px; color: #0b0b0b">No. HP</label>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <input type="text" id="no_hp" name="no_hp" class="form-control" readonly>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="row">--}}
{{--                                <label class="col-md-3" style="margin-top:30px; margin-left: 30px; color: #0b0b0b">No Rekening Payroll</label>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <input type="text" id="no_rekening" name="no_rekening" class="form-control" readonly>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="row">--}}
{{--                                <label class="col-md-3" style="margin-top:30px; margin-left: 30px; color: #0b0b0b">Bank</label>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <input type="text" id="bank" name="bank" class="form-control" readonly>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="row">--}}
{{--                                <label class="col-md-3" style="margin-top:30px; margin-left: 30px; color: #0b0b0b">Nama Rekening</label>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <input type="text" id="nama_rekening" name="nama_rekening" class="form-control" readonly>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="row">--}}
{{--                                <label class="col-md-3" style="margin-top:30px; margin-left: 30px; color: #0b0b0b">Tanggal Input Penyertaan Modal</label>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <input type="text" id="tgl_input_penyertaan" name="tgl_input_penyertaan" class="form-control" value="{{old('tgl_input_penyertaan')}}">--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="row">--}}
{{--                                <label class="col-md-3" style="margin-top:30px; margin-left: 30px; color: #0b0b0b">Jumlah</label>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <input type="text" id="jumlah" name="jumlah" class="form-control" onkeyup="formatRupiah(this, '')" value="{{old('jumlah')}}">--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="pull-right">--}}
{{--                                <div class="col-md-12">--}}
{{--                                    <a id="btnsimpan" class="btn btn-fill btn-success"><i class="fa fa-save"></i> </a>--}}
{{--                                    <a id="btn_back" class="btn btn-fill btn-warning" href="javascript:history.back()"><i class="fa fa-arrow-left"></i> </a>--}}
{{--                                    --}}{{--                           <input type="button" class="btn btn-fill btn-danger" onclick="reset()" value="Reset">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="blue">
                        <i class="material-icons">attach_money</i>
                    </div>

                    <div class="card-content">
                        <h4 class="card-title">Penyertaan Modal</h4>
                        <form id="fpro" action="{{route('penyertaan.store')}}" method="post" enctype="multipart/form-data">
                            <input type="hidden" value="{{csrf_token()}}" name="_token">
                            <div class="wizard-header">
                                <h3 class="wizard-title">
                                    Tambah Penyertaan Modal
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
                                            @foreach($anggota as $anggotas)
                                                <option value="{{$anggotas->no_anggota}}">
                                                    {{$anggotas->no_anggota}} - {{$anggotas->nama}}
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
                                        <i class="material-icons">streetview</i>
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
                                        <label class="control-label">Tanggal Input Penyertaan Modal </label>
                                        <input type="text" id="tgl_input_penyertaan" name="tgl_input_penyertaan" class="form-control" value="{{old('tgl_input_penyertaan')}}">
                                    </div>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">attach_money</i>
                                    </span>
                                    <div class="form-group">
                                        <label class="control-label">Jumlah </label>
                                        <input type="text" id="jumlah" name="jumlah" class="form-control" value="{{old('jumlah')}}" onkeyup="formatRupiah(this, '')">
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
