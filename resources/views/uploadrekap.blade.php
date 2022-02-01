@extends('layouts.main')

@section('container')
<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Upload Rekapitulasi Absensi</h4>
                </div>
                <div class="card-body">
                  <form action="{{url('rekap')}}" method="post">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Pengirim</label>
                          <input type="type" name="pengirim"class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Mata Kuliah</label>
                          <input type="type" name="mk"class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating"></label>
                          <select name="hari" id="hari">
                            <option value="senin">Senin</option>
                            <option value="dosen">Selasa</option>
                            <option value="rabu">Rabu</option>
                            <option value="kamis">Kamis</option>
                            <option value="jumat">Jumat</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Tanggal</label>
                          <select name="tgl" id="tgl">
                            <option value="08.00-10.00">08.00-10.00</option>
                            <option value="10.00-12.00">10.00-12.00</option>
                            <option value="13.00-15.00">13.00-15.00</option>
                            <option value="15.00-17.00">15.00-17.00</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                            <input type="file" id="myFile" name="filename">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-blue">Save</button>
                  </form>
                  <a href="{{route('rekap.index')}}" class="btn btn-danger pull-right">Kembali</a>
                </div>
              </div>
            </div>
        </div>        
      </div>
      </div>  
@endsection