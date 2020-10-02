@extends('layouts.master')
@section('script')
    @include('penyertaan.datatable_penyertaan');
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">

            @if(session('status'))
                <br>
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    {{session('status')}}
                </div>
                <br>
                <br>
            @endif

            <div class="col-md-12">
                {{--                Nanti bikin form input dulu--}}
                <a href="{{ route('penyertaan.create') }}" class="btn btn-success">
                    <span class="btn-label"><i class="material-icons">input</i> </span>Tambah Penyertaan Modal</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" id="calon_anggota" style="display:block">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-bold"><i class="material-icons text-info">monetization_on</i>Penyertaan Modal</h4>
                    </div>
                    <form name="search-penyertaan" id = "search-penyertaan">
                        <div class="form-group row">
                            <label class="col-lg-1" style="color: black">Nama</label>
                            <div class="col-lg-2">
                                <input name="nama" id="nama" class="form-control">
                            </div>
                            <div class="col">
                                <button class="btn btn-primary" type="submit" style="padding: 12px 16px;font-size: 16px; place-content: center">
                                    <i class="fa fa-search"></i></button>
                                {{--                          <a class="btn" type="submit"><i class="fa fa-search"></i> </a>--}}
                                <button class="btn btn-danger" onclick="reset()" style="padding: 12px 16px;font-size: 16px; place-content: center">
                                    <i class="fa fa-refresh"></i> </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card">
                    <div class="card-content">
                        <label><h4 style="color: #0b0b0b">Tabel Daftar Penyertaan Modal</h4></label>
                        <div class="tab-pane" id="messages">
                            <div class="material-datatables">
                                <table id="table-penyertaan" class="display table-responsive table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">No Admin</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">No. Anggota</th>
                                        <th class="text-center">No. Telepon</th>
                                        <th class="text-center">Tanggal Input Penyertaan Modal</th>
                                        <th class="text-center">Bank</th>
                                        <th class="text-center">Jumlah</th>
                                        <th class="text-center">Status 1</th>
                                        <th class="text-center">Status 2</th>
                                        <th class="text-center">Action</th>
{{--                                        <th class="text-center">Jumlah</th>--}}
                                        {{--                                        <th class="text-center">Status Approval</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody style="font-weight:bold">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

