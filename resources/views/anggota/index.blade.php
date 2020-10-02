@extends('layouts.master')
@section('script')
    @include('anggota.datatable_anggota');
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
              <a href="{{ route('anggota.create') }}" class="btn btn-success">
                  <span class="btn-label"><i class="material-icons">input</i> </span>Tambah Anggota</a>
          </div>
      </div>
    <div class="row">
       <div class="col-md-12" id="calon_anggota" style="display:block">
          <div class="card">
             <div class="card-header">
                 <h4 class="card-title text-bold"><i class="material-icons text-info">people</i> Anggota</h4>
             </div>
              <form name="search-anggota" id = "search-anggota">
                  <div class="form-group row">
                      <label class="col-lg-1" style="color: black">Nama</label>
                      <div class="col-lg-3">
                          <input name="nama" id="nama" class="form-control" placeholder="Nama Anggota"/>
                      </div>
                      <label class="col-lg-1" style="color: black">Status</label>
                      <div class="col-lg-3">
                          <select name="status_kerja" id="status_kerja" class="form-control">
                              <option value= "">Pilih Status</option>
                              @foreach($status_kerja as $status)
                                  <option value="{{$status->nama_status_pekerja}}">
                                      {{$status->nama_status_pekerja}}
                                  </option>
                                  @endforeach
                          </select>
                      </div>
{{--                      For filter date feature--}}
{{--                      <div class="col-lg-3">--}}
{{--                          <input type="text" id="tanggal_awal" name="tanggal_awal" class="form-control" placeholder="Dari">--}}
{{--                          <input type="text" id="tanggal_akhir" name="tanggal_akhir" class="form-control" placeholder="Sampai">--}}
{{--                      </div>--}}
                      <div class="col">
                          <button class="btn btn-primary btn-sm" type="submit" style="padding: 12px 16px;font-size: 16px;">
                              <i class="fa fa-search"></i></button>
{{--                          <a class="btn" type="submit"><i class="fa fa-search"></i> </a>--}}
                          <button class="btn btn-danger btn-sm" onclick="reset()" style="padding: 12px 16px;font-size: 16px;">
                              <i class="fa fa-refresh"></i> </button>
                      </div>
                  </div>
              </form>

          </div>
           <div class="card">
             <div class="card-content">
                 <label><h4 style="color: #0b0b0b">Tabel Daftar Anggota</h4></label>
                <div class="tab-pane" id="messages">
                  <div class="material-datatables">
                    <table id="table-anggota" class="display table-responsive table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                              <th class="text-center">No</th>
                              <th class="text-center">No Admin</th>
                              <th class="text-center">Nama</th>
                              <th class="text-center">Nomor HP</th>
                              <th class="text-center">Status Pekerja</th>
                              <th class="text-center">Tanggal Mulai Pemotongan</th>
                              <th class="text-center">Bank</th>
                              <th class="text-center">Simpanan Pokok</th>
                              <th class="text-center">Simpanan Wajib</th>
                              <th class="text-center">Simpanan Sukarela</th>
                              <th class="text-center">Cara Pembayaran</th>
                              <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
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

