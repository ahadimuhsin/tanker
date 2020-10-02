@extends('layouts.master')
@section('script')
    @include('penyertaan.form_validasi_edit')
    @include('penyertaan.penyertaan_js')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="wizard-container">
                    <div class="card wizard-card" data-color="rose" id="wizardProfile">
                        <div class="card-header card-header-icon" data-background-color="blue">
                            <i class="material-icons">attach_money</i>
                        </div>
                        <form id="edit_penyertaan" method="post" action="{{url('penyertaan/'.$penyertaan->no_admin.'')}}" enctype="multipart/form-data">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="wizard-header">
                                <h3 class="wizard-title">
                                    Edit Penyertaan Modal untuk No.Admin {{$penyertaan->no_admin}}
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
{{--                                <label class="col-md-3" style="margin-top:30px; margin-left: 30px; color: #0b0b0b">Tanggal Input Penyertaan Modal</label>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <input type="text" id="tgl_input_penyertaan" name="tgl_input_penyertaan" class="form-control"--}}
{{--                                           value="{{old('tgl_input_penyertaan') ? old('tgl_input_penyertaan') : $penyertaan->tgl_input_penyertaan}}">--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="row">--}}
{{--                                <label class="col-md-3" style="margin-top:30px; margin-left: 30px; color: #0b0b0b">Jumlah</label>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <input type="text" id="jumlah" name="jumlah" class="form-control" onkeyup="formatRupiah(this, '')"--}}
{{--                                           value="{{old('jumlah') ? old('jumlah') : $penyertaan->jumlah}}">--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div style="margin-left: 180px">
                                <div class="col-md-8">

                                    <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">calendar_today</i>
                                    </span>
                                        <div class="form-group label-floating">
                                            <label class="control-label">Tanggal Input Penyertaan</label>
                                            <input type="text" id="tgl_input_penyertaan" name="tgl_input_penyertaan" class="form-control"
                                                   value="{{old('tgl_input_penyertaan') ? old('tgl_input_penyertaan') : $penyertaan->tgl_input_penyertaan}}">
                                        </div>
                                    </div>

                                    <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">attach_money</i>
                                    </span>
                                        <div class="form-group label-floating">
                                            <label class="control-label">Jumlah</label>
                                            <input type="text" id="jumlah" name="jumlah" class="form-control"
                                                   value="{{old('jumlah') ? old('jumlah') : $penyertaan->jumlah}}">
                                        </div>
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


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
