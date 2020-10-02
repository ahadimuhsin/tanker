@extends('layouts.master')
@section('script')
    @include('pinjaman.form_validasi_edit')
    @include('pinjaman.pinjaman_js')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="wizard-container">
                    <div class="card wizard-card" data-color="blue" id="wizardProfile">
                        <div class="card-header card-header-icon" data-background-color="blue">
                            <i class="material-icons">money</i>
                        </div>
                        <form id="edit_pinjaman" method="post"
                              action="{{url('pinjaman/'.$pinjaman->no_admin.'')}}"
                              enctype="multipart/form-data">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="wizard-header">
                                <h3 class="wizard-title">
                                    Edit Pinjaman untuk No. Admin {{$pinjaman->no_admin}}
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
{{--                                <label class="col-md-3" style="margin-top:30px; margin-left: 30px; color: #0b0b0b">Tanggal Pengajuan Pinjaman</label>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <input type="text" id="tgl_input_pinjam" name="tgl_input_pinjam" class="form-control"--}}
{{--                                           value="{{old('tgl_input_pinjam') ? old('tgl_input_pinjam') : $pinjaman->tgl_input_pinjam }}">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="row">--}}
{{--                                <label class="col-md-3" style="margin-top:30px; margin-left: 30px; color: #0b0b0b">Kebutuhan</label>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <input type="text" id="kebutuhan" name="kebutuhan" class="form-control" value="{{old('kebutuhan') ? old('kebutuhan') : $pinjaman->kebutuhan}}">--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="row">--}}
{{--                                <label class="col-md-3" style="margin-top:30px; margin-left: 30px; color: #0b0b0b">Angsuran</label>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <input type="text" id="angsuran" name="angsuran" class="form-control" onkeyup="formatRupiah(this, '')" value="{{old('angsuran') ? old('angsuran') : $pinjaman->angsuran}}">--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="row">--}}
{{--                                <label class="col-md-3" style="margin-top:30px; margin-left: 30px; color: #0b0b0b">Termin</label>--}}
{{--                                <div class="col-md-3">--}}
{{--                                    --}}{{--                                    <input id="termin" name="termin" class="form-control">--}}
{{--                                    <select id="termin" name="termin" class="form-control">--}}
{{--                                        <option value="">Pilih Termin</option>--}}
{{--                                        <option value="1" {{$pinjaman->termin == "1" ? "selected" : ""}}>1 Bulan</option>--}}
{{--                                        <option value="2" {{$pinjaman->termin == "2" ? "selected" : ""}}>2 Bulan</option>--}}
{{--                                        <option value="3" {{$pinjaman->termin == "3" ? "selected" : ""}}>3 Bulan</option>--}}
{{--                                        <option value="4" {{$pinjaman->termin == "4" ? "selected" : ""}}>4 Bulan</option>--}}
{{--                                        <option value="5" {{$pinjaman->termin == "5" ? "selected" : ""}}>5 Bulan</option>--}}
{{--                                        <option value="6" {{$pinjaman->termin == "6" ? "selected" : ""}}>6 Bulan</option>--}}
{{--                                        <option value="7" {{$pinjaman->termin == "7" ? "selected" : ""}}>7 Bulan</option>--}}
{{--                                        <option value="8" {{$pinjaman->termin == "8" ? "selected" : ""}}>8 Bulan</option>--}}
{{--                                        <option value="9" {{$pinjaman->termin == "9" ? "selected" : ""}}>9 Bulan</option>--}}
{{--                                        <option value="10" {{$pinjaman->termin == "10" ? "selected" : ""}}>10 Bulan</option>--}}
{{--                                        <option value="11" {{$pinjaman->termin == "11" ? "selected" : ""}}>11 Bulan</option>--}}
{{--                                        <option value="12" {{$pinjaman->termin == "12" ? "selected" : ""}}>12 Bulan</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="row">--}}
{{--                                <label class="col-md-3" style="margin-top:30px; margin-left: 30px; color: #0b0b0b">Jumlah</label>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <input type="text" id="jumlah" name="jumlah" class="form-control" onkeyup="formatRupiah(this, '')" value="{{old('jumlah') ? old('jumlah') : $pinjaman->jumlah}}">--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="pull-right">--}}
{{--                                <div class="col-md-12">--}}
{{--                                    <a id="btnsimpan" class="btn btn-fill btn-success"><i class="fa fa-save"></i> </a>--}}
{{--                                    <a id="btn_back" class="btn btn-fill btn-warning" href="javascript:history.back()"><i class="fa fa-arrow-left"></i> </a>--}}
{{--                                    --}}{{--                           <input type="button" class="btn btn-fill btn-danger" onclick="reset()" value="Reset">--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div style="margin-left: 180px">
                            <div class="col-md-8">
                            <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">calendar_today</i>
                                    </span>
                                <div class="form-group label-floating">
                                    <label class="control-label">Tanggal Input Pinjam</label>
                                    <input type="text" id="tgl_input_pinjam" name="tgl_input_pinjam" class="form-control"
                                           value="{{old('tgl_input_pinjam') ? old('tgl_input_pinjam') : $pinjaman->tgl_input_pinjam}}">
                                </div>
                            </div>

                            <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">shopping_basket</i>
                                    </span>
                                <div class="form-group label-floating">
                                    <label class="control-label">Kebutuhan</label>
                                    <input type="text" id="kebutuhan" name="kebutuhan" class="form-control"
                                           value="{{old('kebutuhan') ? old('kebutuhan') : $pinjaman->kebutuhan}}">
                                </div>
                            </div>

                            <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">money</i>
                                    </span>
                                <div class="form-group label-floating">
                                    <label class="control-label">Angsuran</label>
                                    <input type="text" id="angsuran" name="angsuran" class="form-control" value="{{old('angsuran') ? old('angsuran') : $pinjaman->angsuran}}" onkeyup="formatRupiah(this, '')">
                                </div>
                            </div>

                            <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">access_time</i>
                                    </span>
                                <div class="form-group">
                                    <label class="control-label">Termin</label>
                                    <select id="termin" name="termin" class="form-control">--}}
                                        <option value="">Pilih Termin</option>
                                        <option value="1" {{$pinjaman->termin == "1" ? "selected" : ""}}>1 Bulan</option>
                                        <option value="2" {{$pinjaman->termin == "2" ? "selected" : ""}}>2 Bulan</option>
                                        <option value="3" {{$pinjaman->termin == "3" ? "selected" : ""}}>3 Bulan</option>
                                        <option value="4" {{$pinjaman->termin == "4" ? "selected" : ""}}>4 Bulan</option>
                                        <option value="5" {{$pinjaman->termin == "5" ? "selected" : ""}}>5 Bulan</option>
                                        <option value="6" {{$pinjaman->termin == "6" ? "selected" : ""}}>6 Bulan</option>
                                        <option value="7" {{$pinjaman->termin == "7" ? "selected" : ""}}>7 Bulan</option>
                                        <option value="8" {{$pinjaman->termin == "8" ? "selected" : ""}}>8 Bulan</option>
                                        <option value="9" {{$pinjaman->termin == "9" ? "selected" : ""}}>9 Bulan</option>
                                        <option value="10" {{$pinjaman->termin == "10" ? "selected" : ""}}>10 Bulan</option>
                                        <option value="11" {{$pinjaman->termin == "11" ? "selected" : ""}}>11 Bulan</option>
                                        <option value="12" {{$pinjaman->termin == "12" ? "selected" : ""}}>12 Bulan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">money</i>
                                    </span>
                                <div class="form-group">
                                    <label class="control-label">Jumlah</label>
                                    <input type="text" id="jumlah" name="jumlah" class="form-control" value="{{old('jumlah') ? old('jumlah') : $pinjaman->jumlah}}" onkeyup="formatRupiah(this, '')" readonly>
                                </div>
                            </div>

                            <div>
                                <div class="col-md-12" style="margin-left: 100px">
                                    <a id="btnsimpan" class="btn btn-fill btn-success"><i class="fa fa-save"></i> </a>
                                    <a id="btn_back" class="btn btn-fill btn-warning" href="javascript:history.back()"><i class="fa fa-arrow-left"></i></a>
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
