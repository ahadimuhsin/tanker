@extends('layouts.master')

@section('script')
    @include('simpanan_shu.form_validasi_edit')
    @include('simpanan_shu.simpanan_js')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="wizard-container">
                    <div class="card wizard-card" data-color="blue" id="wizardProfile">
                        <div class="card-header card-header-icon" data-background-color="blue">
                            <i class="material-icons">attach_money</i>
                        </div>
                        <form id="edit_simpanan" method="post" action="{{url('simpanan_shu/'.$simpanan_shu->no_admin.'')}}" enctype="multipart/form-data">
                            <input type="hidden" name="_method" value="put">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="wizard-header">
                                <h3 class="wizard-title">
                                    Edit Pengambilan Simpanan SHU untuk No. Admin {{$simpanan_shu -> no_admin}}
                                </h3>
                            </div>

                            @if($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>

                                    @foreach($errors->all() as $error)
                                        <li> {{ $error }}</li><br/>
                                    @endforeach

                                </div>
                            @endif

{{--                            <div class="row">--}}
{{--                                <label class="col-md-3" style="margin-top:30px; margin-left: 30px; color: #0b0b0b">Tanggal Input Pengambilan Simpanan</label>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <input type="text" id="tgl_input_ambil_simpanan" name="tgl_input_ambil_simpanan" class="form-control"--}}
{{--                                    value="{{old('tgl_input_ambil_simpanan') ? old('tgl_input_ambil_simpanan') : $simpanan_shu->tgl_input_ambil_simpanan}}">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="row">--}}
{{--                                <label class="col-md-3" style="margin-top:30px; margin-left: 30px; color: #0b0b0b">Alasan</label>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <input type="text" id="alasan" name="alasan" class="form-control"--}}
{{--                                    value = {{old('alasan') ? old('alasan') : $simpanan_shu -> alasan}}>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="row">--}}
{{--                                <label class="col-md-3" style="margin-top:30px; margin-left: 30px; color: #0b0b0b">Jumlah</label>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <input type="text" id="jumlah" name="jumlah" class="form-control" onkeyup="formatRupiah(this, '')"--}}
{{--                                    value="{{old('jumlah') ? old('jumlah') : $simpanan_shu -> jumlah}}">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="row">--}}
{{--                                <label class="col-md-3" style="margin-top:30px; margin-left: 30px; color: #0b0b0b">Cara Pembayaran</label>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <select id="cara_bayar" name="cara_bayar" class="form-control">--}}
{{--                                        <option value="">Pilih Cara Pembayaran</option>--}}
{{--                                        <option {{$simpanan_shu -> cara_bayar = "Transfer"}} value="Transfer">Transfer</option>--}}
{{--                                        <option {{$simpanan_shu -> cara_bayar = "Payroll"}} value="Payroll">Payroll</option>--}}
{{--                                        <option {{$simpanan_shu -> cara_bayar = "Autodebet"}} value="Autodebet">Autodebet</option>--}}
{{--                                        <option {{$simpanan_shu -> cara_bayar = "Jasa Penyertaan"}} value="Jasa Penyertaan">Jasa Penyertaan</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div style="margin-left: 180px">
                                <div class="col-md-8">
                            <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">calendar_today</i>
                                    </span>
                                <div class="form-group label-floating">
                                    <label class="control-label">Tanggal Input Pengambilan Simpanan </label>
                                    <input type="text" id="tgl_input_ambil_simpanan" name="tgl_input_ambil_simpanan" class="form-control" value="{{old('tgl_input_ambil_simpanan') ? old('tgl_input_ambil_simpanan') : $simpanan_shu->tgl_input_ambil_simpanan}}">
                                </div>
                            </div>

                            <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">question_answer</i>
                                    </span>
                                <div class="form-group label-floating">
                                    <label class="control-label">Alasan</label>
                                    <input type="text" id="alasan" name="alasan" class="form-control" value="{{old('alasan') ? old('alasan') : $simpanan_shu->alasan}}">
                                </div>
                            </div>

                            <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">attach_money</i>
                                    </span>
                                <div class="form-group label-floating">
                                    <label class="control-label">Jumlah</label>
                                    <input type="text" id="jumlah" name="jumlah" class="form-control" value="{{old('jumlah') ? old('jumlah') : $simpanan_shu->jumlah}}" onkeyup="formatRupiah(this, '')">
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
                                        <option value="Transfer" {{$simpanan_shu->cara_bayar == "Transfer" ? 'selected' : ''}}>Transfer</option>
                                        <option value="Payroll" {{$simpanan_shu->cara_bayar == "Payroll" ? 'selected' : ''}}>Payroll</option>
                                        <option value="Autodebet" {{$simpanan_shu->cara_bayar == "Autodebet" ? 'selected' : ''}}>Autodebet</option>
                                        <option value="Jasa Penyertaan" {{$simpanan_shu->cara_bayar == "Jasa Penyertaan" ? 'selected' : ''}}>Jasa Penyertaan</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <div class="col-md-12" style="margin-left: 100px">
                                    <a id="btnsimpan" class="btn btn-fill btn-success"><i class="fa fa-save"></i> </a>
                                    <a id="btn_back" class="btn btn-fill btn-warning" href="javascript:history.back()"><i class="fa fa-arrow-left"></i> </a>
                                    {{--                           <input type="button" class="btn btn-fill btn-danger" onclick="reset()" value="Reset">--}}
                                </div>
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
