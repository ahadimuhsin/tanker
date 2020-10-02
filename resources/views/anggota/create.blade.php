{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>--}}
@extends('layouts.master')
@section('script')
    @include('anggota.form_validasi');
    @include('anggota.anggota_js');
@endsection
@section('content')
{
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="blue">
                        <i class="material-icons">people</i>
                    </div>

                    <div class="card-content">
                        <h4 class="card-title">Anggota</h4>
                        <form id="fpro" action="{{route('anggota.store')}}" method="post" enctype="multipart/form-data">
                            <input type="hidden" value="{{csrf_token()}}" name="_token">
                            <div class="wizard-header">
                                <h3 class="wizard-title">
                                    Tambah Anggota
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
                                        <i class="material-icons">calendar_today</i>
                                    </span>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Tanggal Input</label>
                                        <input type="text" id="tgl_input" name="tgl_input"
                                               class="form-control" onkeypress="return justnumber(event, false)"
                                               value="{{old('tgl_input')}}">
                                    </div>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">card_membership</i>
                                    </span>
                                    <div class="form-group label-floating">
                                        <label class="control-label">No. Admin</label>
                                        <input type="text" id="no_admin" name="no_admin"
                                               class="form-control" value="{{$no_admin}}" readonly>
                                    </div>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">card_membership</i>
                                    </span>
                                    <div class="form-group label-floating">
                                        <label class="control-label">No. Anggota</label>
                                        <input type="text" id="no_anggota" name="no_anggota"
                                               class="form-control" value="{{$no_admin}}" readonly>
                                    </div>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">people</i>
                                    </span>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Nama</label>
                                        <input type="text" id="nama" name="nama"
                                               class="form-control" value="{{old('nama')}}">
                                    </div>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">work</i>
                                    </span>
                                    <div class="form-group label-floating">
                                        <label class="control-label">No. Pekerja</label>
                                        <input type="text" id="no_pekerja" name="no_pekerja"
                                               class="form-control" value="{{old('no_pekerja')}}">
                                    </div>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">people</i>
                                    </span>
                                    <div class="form-group label-floating">
{{--                                        <label class="control-label">Status Pekerja</label>--}}
                                        <select id="status_kerja" name="status_kerja" class="form-control">
                                            <option value="">Pilih Status Pekerja</option>
                                            @foreach($status_kerja as $status)
                                                <option value="{{$status->id_status_pekerja}}" {{old('status_kerja') == $status->id_status_pekerja ? "selected" : ''}}>
                                                    {{$status->nama_status_pekerja}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">work</i>
                                    </span>
                                    <div class="form-group label-floating">
                                        {{--                                        <label class="control-label">Status Pekerja</label>--}}
                                        <select id="bagian" name="bagian" class="form-control">
                                            <option value="">Pilih Bagian</option>
                                            @foreach($bagian as $divisi)
                                                <option value="{{$divisi->id_bagian}}" {{old('bagian') == $divisi->id_bagian ? "selected" : ''}}>
                                                    {{$divisi->nama_bagian}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">card_membership</i>
                                    </span>
                                    <div class="form-group label-floating">
                                        {{--                                        <label class="control-label">Status Pekerja</label>--}}
                                        <select id="identitas" name="identitas" class="form-control">
                                            <option value="">Pilih Identitas</option>
                                            <option value="KTP" {{old('identitas') == "KTP" ? "selected" : ""}}>KTP</option>
                                            <option value="SIM" {{old('identitas') == "SIM" ? "selected" : ""}}>SIM</option>
{{--                                            <option value="Paspor">Paspor</option>--}}
                                        </select>
                                    </div>
                                </div>

                                <div class="input-group" id="nomor_id" style="display: none">
                                    <span class="input-group-addon">
                                        <i class="material-icons">card_membership</i>
                                    </span>
                                    <div class="form-group label-floating">
{{--                                        <label class="control-label">Nomor Identitas</label>--}}
                                        <input id="nomor_identitas" type="text" name="nomor_identitas" class="form-control"
                                        value="{{old('nomor_identitas')}}">
                                    </div>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">streetview</i>
                                    </span>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Alamat Kantor</label>
                                        <textarea id="alamat_kantor" type="text" name="alamat_kantor" class="form-control"
                                        >{{old('alamat_kantor')}}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">smartphone</i>
                                    </span>
                                    <div class="form-group label-floating">
                                        <label class="control-label">No. HP</label>
                                        <input id="no_hp" type="text" name="no_hp" class="form-control" value="{{old('no_hp')}}">
                                    </div>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">account_balance</i>
                                    </span>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Bank</label>
                                        <input id="bank" type="text" name="bank" class="form-control" value="{{old('bank')}}">
                                    </div>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">account_balance</i>
                                    </span>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Nama Rekening</label>
                                        <input id="nama_rekening" type="text" name="nama_rekening" class="form-control" value="{{old('nama_rekening')}}">
                                    </div>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">account_balance</i>
                                    </span>
                                    <div class="form-group label-floating">
                                        <label class="control-label">No. Rekening Payroll</label>
                                        <input id="no_rekening" type="text" name="no_rekening" class="form-control" value="{{old('no_rekening')}}">
                                    </div>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">money</i>
                                    </span>
                                    <div class="form-group label-floating">
                                        <label class="control-label" id="label_pokok">Simpanan Pokok</label>
                                        <input id="simpanan_pokok" type="text" name="simpanan_pokok" class="form-control" value="{{old('simpanan_pokok')}}" onkeyup="formatRupiah(this, '')">
                                    </div>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">money</i>
                                    </span>
                                    <div class="form-group label-floating">
                                        <label class="control-label" id="label_wajib">Simpanan Wajib</label>
                                        <input id="simpanan_wajib" type="text" name="simpanan_wajib" class="form-control" value="{{old('simpanan_wajib')}}" onkeyup="formatRupiah(this, '')">
                                    </div>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">money</i>
                                    </span>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Simpanan Sukarela</label>
                                        <input id="simpanan_sukarela" type="text" name="simpanan_sukarela" class="form-control" value="{{old('simpanan_sukarela')}}" onkeyup="formatRupiah(this, '')">
                                    </div>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">payments</i>
                                    </span>
                                    <div class="form-group label-floating">
{{--                                        <label class="control-label">Simpanan Pokok</label>--}}
                                        <select id="cara_pembayaran" name="cara_pembayaran" class="form-control">
                                            <option value="">Pilih Cara Pembayaran</option>
                                            <option value="Transfer" {{old('cara_pembayaran') == "Transfer" ? "selected" : ""}}>Transfer</option>
                                            <option value="Payroll" {{old('cara_pembayaran') == "Payroll" ? "selected" : ""}}>Payroll</option>
                                            <option value="Autodebet" {{old('cara_pembayaran') == "Autodebet" ? "selected" : ""}}>Autodebet</option>
                                            <option value="Jasa Penyertaan" {{old('cara_pembayaran') == "Jasa Penyertaan" ? "selected" : ""}}>Jasa Penyertaan</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">calendar_today</i>
                                    </span>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Tanggal Mulai Potong</label>
                                        <input type="text" id="tgl_mulai_potong" name="tgl_mulai_potong" class="form-control" value="{{old('tgl_mulai_potong')}}" onkeypress="justnumber(event, false)">
                                    </div>
                                </div>
                            </div>
                            <div class="pull-right">
                                <div class="col-md-12">
                                <a id="btnsimpan" class="btn btn-fill btn-success"><i class="fa fa-save"></i> </a>
                                <a id="btn_back" class="btn btn-fill btn-warning" href="javascript:history.back()"><i class="fa fa-arrow-left"></i> </a>
{{--                                <input type="button" class="btn btn-fill btn-danger" onclick="reset()" value="Reset">--}}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
