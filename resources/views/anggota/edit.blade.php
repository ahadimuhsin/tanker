@extends('layouts.master')
@section('script')
    @include('anggota.form_validasi_edit')
    @include('anggota.anggota_js')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="card wizard-card" data-color="blue" id="wizardProfile">
                    <div class="card-header card-header-icon" data-background-color="blue">
                        <i class="material-icons">people</i>
                    </div>
                    <form id="edit_anggota" method="post"
                          action="{{url('anggota/'.$anggota->no_admin.'')}}"
                          enctype="multipart/form-data" accept-charset="UTF-8">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="wizard-header">
                            <h3 class="wizard-title">
                                Edit Anggota untuk No.Admin {{$anggota->no_admin}}
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
{{--                        <div class="row">--}}
{{--                            <label class="col-md-3" style="margin-top:30px; margin-left: 30px; color: #0b0b0b">Tanggal Input</label>--}}
{{--                            <div class="col-md-4">--}}
{{--                                <input type="text" id="tgl_input" name="tgl_input" class="form-control"--}}
{{--                                onkeypress="return justnumber(event, false)"--}}
{{--                                       value="{{old('tgl_input') ? old('tgl_input') : $anggota->tgl_input}}">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row">--}}
{{--                            <label class="col-md-3" style="margin-top:30px; margin-left: 30px; color: #0b0b0b">Nama</label>--}}
{{--                            <div class="col-md-6">--}}
{{--                                <input type="text" id="nama" name="nama" class="form-control"--}}
{{--                                value="{{old('nama') ? old('nama') : $anggota->nama}}">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row">--}}
{{--                            <label class="col-md-3" style="margin-top:30px; margin-left: 30px; color: #0b0b0b">No. Pekerja</label>--}}
{{--                            <div class="col-md-6">--}}
{{--                                <input type="text" id="no_pekerja" name="no_pekerja" class="form-control"--}}
{{--                                value="{{old('no_pekerja') ? old('no_pekerja') : $anggota -> no_pekerja}}">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row">--}}
{{--                            <label class="col-md-3" style="margin-top:30px; margin-left: 30px; color: #0b0b0b">Status</label>--}}
{{--                            <div class="col-md-6">--}}
{{--                                <select id="status_kerja" name="status_kerja" class="form-control">--}}
{{--                                    @foreach($status_kerja as $status)--}}
{{--                                        <option--}}
{{--                                        {{$anggota->id_status_pekerja == $status->id_status_pekerja ? 'selected' : ''}}--}}
{{--                                        value="{{$status->id_status_pekerja}}">--}}
{{--                                            {{$status->nama_status_pekerja}}--}}
{{--                                        </option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row" id="row_bagian">--}}
{{--                            <label class="col-md-3" style="margin-top:30px; margin-left: 30px; color: #0b0b0b">Fungsi / Bagian</label>--}}
{{--                            <div class="col-md-6" id="select_bagian">--}}
{{--                                <select id="bagian" name="bagian" class="form-control">--}}
{{--                                    @foreach($bagian as $divisi)--}}
{{--                                        <option--}}
{{--                                        {{$anggota->id_bagian == $divisi->id_bagian ? 'selected' : ''}}--}}
{{--                                        value="{{$divisi->id_bagian}}">--}}
{{--                                            {{$divisi->nama_bagian}}--}}
{{--                                        </option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row">--}}
{{--                            <label class="col-md-3" style="margin-top:30px; margin-left: 30px; color: #0b0b0b">Identitas</label>--}}
{{--                        <div class="col-md-6">--}}
{{--                            <select type="text" id="identitas" name="identitas" class="form-control">--}}
{{--                                <option {{$anggota->identitas == 'KTP' ? 'selected' : ''}} value="KTP">KTP</option>--}}
{{--                                <option {{$anggota->identitas == 'SIM' ? 'selected' : ''}} value="SIM">SIM</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                        </div>--}}

{{--                        <div class="row" id="nomor_id">--}}
{{--                            <label class="col-md-3" style="margin-top:30px; margin-left: 30px; color: #0b0b0b">Nomor Identitas</label>--}}
{{--                            <div class="col-md-6">--}}
{{--                                <input id="nomor_identitas" type="text" name="nomor_identitas"--}}
{{--                                class="form-control" value="{{old('nomor_identitas') ? old('nomor_identitas'): $anggota->nomor_identitas}}">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row">--}}
{{--                            <label class="col-md-3" style="margin-top:30px; margin-left: 30px; color: #0b0b0b">Alamat Kantor</label>--}}
{{--                            <div class="col-md-6">--}}
{{--                                <textarea type="text" id="alamat_kantor" name="alamat_kantor" class="form-control">{{$anggota->alamat_kantor}}</textarea>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row">--}}
{{--                            <label class="col-md-3" style="margin-top:30px; margin-left: 30px; color: #0b0b0b">No. HP</label>--}}
{{--                            <div class="col-md-6">--}}
{{--                                <input type="text" id="no_hp" name="no_hp" class="form-control" value="{{$anggota->no_hp}}">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row">--}}
{{--                            <label class="col-md-3" style="margin-top:30px; margin-left: 30px; color: #0b0b0b">No. Rekening Payroll</label>--}}
{{--                            <div class="col-md-6">--}}
{{--                                <input type="text" id="no_rekening" name="no_rekening" class="form-control"--}}
{{--                                value="{{$anggota->no_rek_payroll}}">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row">--}}
{{--                            <label class="col-md-3" style="margin-top:30px; margin-left: 30px; color: #0b0b0b">Bank</label>--}}
{{--                            <div class="col-md-6">--}}
{{--                                <input type="text" id="bank" name="bank" class="form-control" value="{{$anggota->bank}}">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row">--}}
{{--                            <label class="col-md-3" style="margin-top:30px; margin-left: 30px; color: #0b0b0b">Nama Rekening</label>--}}
{{--                            <div class="col-md-6">--}}
{{--                                <input type="text" name="nama_rekening" id="nama_rekening" class="form-control"--}}
{{--                                value="{{$anggota->nama_rekening}}">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row">--}}
{{--                            <label class="col-md-3" style="margin-top:30px; margin-left: 30px; color: #0b0b0b">Simpanan Pokok</label>--}}
{{--                            <div class="col-md-6">--}}
{{--                                <input type="text" id="simpanan_pokok" name="simpanan_pokok" class="form-control"--}}
{{--                                value="{{$anggota->simpanan_pokok}}">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row">--}}
{{--                            <label class="col-md-3" style="margin-top:30px; margin-left: 30px; color: #0b0b0b">Simpanan Wajib</label>--}}
{{--                            <div class="col-md-6">--}}
{{--                                <input type="text" id="simpanan_wajib" name="simpanan_wajib" class="form-control"--}}
{{--                                       value="{{$anggota->simpanan_wajib}}">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row">--}}
{{--                            <label class="col-md-3" style="margin-top:30px; margin-left: 30px; color: #0b0b0b">Simpanan Sukarela</label>--}}
{{--                            <div class="col-md-6">--}}
{{--                                <input type="text" id="simpanan_sukarela" name="simpanan_sukarela" class="form-control"--}}
{{--                                       onkeyup="formatRupiah(this, '')" value="{{$anggota->simpanan_sukarela}}">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row">--}}
{{--                            <label class="col-md-3" style="margin-top:30px; margin-left: 30px; color: #0b0b0b">Cara Pembayaran</label>--}}
{{--                            <div class="col-md-6">--}}
{{--                                <select id="cara_pembayaran" name="cara_pembayaran" class="form-control">--}}
{{--                                <option {{$anggota->cara_pembayaran == 'Transfer' ? 'selected' : ''}} value="Transfer">Transfer</option>--}}
{{--                                <option {{$anggota->cara_pembayaran == 'Payroll' ? 'selected' : ''}} value="Payroll">Payroll</option>--}}
{{--                                <option {{$anggota->cara_pembayaran == 'Autodebet' ? 'selected' : ''}} value="Autodebet">Autodebet</option>--}}
{{--                                <option {{$anggota->cara_pembayaran == 'Jasa Penyertaan' ? 'selected' : ''}} value="Jasa Penyertaan">Transfer</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row">--}}
{{--                            <label class="col-md-3" style="margin-top:30px; margin-left: 30px; color: #0b0b0b">Tanggal Mulai Potong</label>--}}
{{--                            <div class="col-md-4">--}}
{{--                                <input type="text" id="tgl_mulai_potong" name="tgl_mulai_potong" class="form-control"--}}
{{--                                value="{{$anggota->tgl_mulai_potong}}" onkeypress="justnumber(event, false)">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="pull-right">--}}
{{--                            <div class="col-md-12">--}}
{{--                                <a id="btnsimpan" class="btn btn-fill btn-success"><i class="fa fa-save"></i> </a>--}}
{{--                                <a id="btn_back" class="btn btn-fill btn-warning" href="javascript:history.back()"><i class="fa fa-arrow-left"></i> </a>--}}
{{--                                --}}{{--                           <input type="button" class="btn btn-fill btn-danger" onclick="reset()" value="Reset">--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="col-md-6">
                            <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">calendar_today</i>
                                    </span>
                                <div class="form-group label-floating">
                                    <label class="control-label">Tanggal Input</label>
                                    <input type="text" id="tgl_input" name="tgl_input"
                                           class="form-control" onkeypress="return justnumber(event, false)"
                                           value="{{old('tgl_input') ? old('tgl_input') : $anggota->tgl_input}}">
                                </div>
                            </div>

{{--                            <div class="input-group">--}}
{{--                                    <span class="input-group-addon">--}}
{{--                                        <i class="material-icons">card_membership</i>--}}
{{--                                    </span>--}}
{{--                                <div class="form-group label-floating">--}}
{{--                                    <label class="control-label">No. Admin</label>--}}
{{--                                    <input type="text" id="no_admin" name="no_admin"--}}
{{--                                           class="form-control" value="{{$no_admin}}" readonly>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="input-group">--}}
{{--                                    <span class="input-group-addon">--}}
{{--                                        <i class="material-icons">card_membership</i>--}}
{{--                                    </span>--}}
{{--                                <div class="form-group label-floating">--}}
{{--                                    <label class="control-label">No. Anggota</label>--}}
{{--                                    <input type="text" id="no_anggota" name="no_anggota"--}}
{{--                                           class="form-control" value="{{$no_admin}}" readonly>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">people</i>
                                    </span>
                                <div class="form-group label-floating">
                                    <label class="control-label">Nama</label>
                                    <input type="text" id="nama" name="nama"
                                           class="form-control" value="{{old('nama') ? old('nama') : $anggota->nama}}">
                                </div>
                            </div>

                            <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">work</i>
                                    </span>
                                <div class="form-group label-floating">
                                    <label class="control-label">No. Pekerja</label>
                                    <input type="text" id="no_pekerja" name="no_pekerja"
                                           class="form-control" value="{{old('no_pekerja') ? old('no_pekerja') : $anggota->no_pekerja}}">
                                </div>
                            </div>

                            <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">people</i>
                                    </span>
                                <div class="form-group label-floating">
                                    <label class="control-label">Status Pekerja</label>
                                    <select id="status_kerja" name="status_kerja" class="form-control">
{{--                                        <option value="">Pilih Status Pekerja</option>--}}
                                        @foreach($status_kerja as $status)
                                            <option
                                                    {{$anggota->id_status_pekerja == $status->id_status_pekerja ? 'selected' : ''}}
                                                    value="{{$status->id_status_pekerja}}">
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
                                    <label class="control-label">Status Pekerja</label>
                                    <select id="bagian" name="bagian" class="form-control">
{{--                                        <option value="">Pilih Bagian</option>--}}
                                        @foreach($bagian as $divisi)
                                            <option
                                                    {{$anggota->id_bagian == $divisi->id_bagian ? 'selected' : ''}}
                                                    value="{{$divisi->id_bagian}}"}>
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
                                    <label class="control-label">Status Pekerja</label>
                                    <select id="identitas" name="identitas" class="form-control">
{{--                                        <option value="">Pilih Identitas</option>--}}
                                        <option value="KTP" {{$anggota->identitas == "KTP" ? "selected" : ""}}>KTP</option>
                                        <option value="SIM" {{$anggota->identitas == "SIM" ? "selected" : ""}}>SIM</option>
                                        {{--                                            <option value="Paspor">Paspor</option>--}}
                                    </select>
                                </div>
                            </div>

                            <div class="input-group" id="nomor_id">
                                    <span class="input-group-addon">
                                        <i class="material-icons">card_membership</i>
                                    </span>
                                <div class="form-group label-floating">
                                    {{--                                        <label class="control-label">Nomor Identitas</label>--}}
                                    <input id="nomor_identitas" type="text" name="nomor_identitas" class="form-control"
                                           value="{{old('nomor_identitas') ? old('nomor_identitas') : $anggota->nomor_identitas}}">
                                </div>
                            </div>

                            <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">streetview</i>
                                    </span>
                                <div class="form-group label-floating">
                                    <label class="control-label">Alamat Kantor</label>
                                    <textarea id="alamat_kantor" type="text" name="alamat_kantor" class="form-control"
                                    >{{old('alamat_kantor') ? old('alamat_kantor') : $anggota->alamat_kantor}}</textarea>
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
                                    <input id="no_hp" type="text" name="no_hp" class="form-control"
                                           value="{{old('no_hp') ? old('no_hp'): $anggota->no_hp}}">
                                </div>
                            </div>

                            <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">account_balance</i>
                                    </span>
                                <div class="form-group label-floating">
                                    <label class="control-label">Bank</label>
                                    <input id="bank" type="text" name="bank" class="form-control"
                                           value="{{old('bank') ? old('bank'): $anggota->bank}}">
                                </div>
                            </div>

                            <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">account_balance</i>
                                    </span>
                                <div class="form-group label-floating">
                                    <label class="control-label">Nama Rekening</label>
                                    <input id="nama_rekening" type="text" name="nama_rekening" class="form-control"
                                           value="{{old('nama_rekening') ? old('nama_rekening'): $anggota->nama_rekening}}">
                                </div>
                            </div>

                            <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">account_balance</i>
                                    </span>
                                <div class="form-group label-floating">
                                    <label class="control-label">No. Rekening Payroll</label>
                                    <input id="no_rekening" type="text" name="no_rekening" class="form-control"
                                           value="{{old('no_rekening')?old('no_rekening'): $anggota->no_rek_payroll}}">
                                </div>
                            </div>

                            <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">money</i>
                                    </span>
                                <div class="form-group label-floating">
                                    <label class="control-label" id="label_pokok">Simpanan Pokok</label>
                                    <input id="simpanan_pokok" type="text" name="simpanan_pokok" class="form-control"
                                           value="{{old('simpanan_pokok') ? old('simpanan_pokok') : $anggota->simpanan_pokok}}" onkeyup="formatRupiah(this, '')">
                                </div>
                            </div>

                            <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">money</i>
                                    </span>
                                <div class="form-group label-floating">
                                    <label class="control-label" id="label_wajib">Simpanan Wajib</label>
                                    <input id="simpanan_wajib" type="text" name="simpanan_wajib" class="form-control"
                                           value="{{old('simpanan_wajib') ? old('simpanan_wajib') : $anggota->simpanan_wajib}}" onkeyup="formatRupiah(this, '')">
                                </div>
                            </div>

                            <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">money</i>
                                    </span>
                                <div class="form-group label-floating">
                                    <label class="control-label">Simpanan Sukarela</label>
                                    <input id="simpanan_sukarela" type="text" name="simpanan_sukarela" class="form-control"
                                           value="{{old('simpanan_sukarela') ? old('simpanan_sukarela') : $anggota->simpanan_sukarela}}" onkeyup="formatRupiah(this, '')">
                                </div>
                            </div>

                            <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">payments</i>
                                    </span>
                                <div class="form-group label-floating">
                                    <label class="control-label">Simpanan Pokok</label>
                                    <select id="cara_pembayaran" name="cara_pembayaran" class="form-control">
                                        <option value="">Pilih Cara Pembayaran</option>
                                        <option value="Transfer" {{$anggota->cara_pembayaran == "Transfer" ? "selected" : ""}}>Transfer</option>
                                        <option value="Payroll" {{$anggota->cara_pembayaran == "Payroll" ? "selected" : ""}}>Payroll</option>
                                        <option value="Autodebet" {{$anggota->cara_pembayaran == "Autodebet" ? "selected" : ""}}>Autodebet</option>
                                        <option value="Jasa Penyertaan" {{$anggota->cara_pembayaran == "Jasa Penyertaan" ? "selected" : ""}}>Jasa Penyertaan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">calendar_today</i>
                                    </span>
                                <div class="form-group label-floating">
                                    <label class="control-label">Tanggal Mulai Potong</label>
                                    <input type="text" id="tgl_mulai_potong" name="tgl_mulai_potong" class="form-control"
                                           value="{{old('tgl_mulai_potong') ? old('tgl_mulai_potong') : $anggota->tgl_mulai_potong}}" onkeypress="justnumber(event, false)">
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
@endsection
