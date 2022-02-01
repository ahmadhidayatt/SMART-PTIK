@extends('layouts.main')

@section('container')

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>

<link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">
<style>
    .kbw-signature {
        width: 100%;
        height: 200px;
    }

    #sig canvas {
        width: 100% !important;
        height: auto;
    }
</style>
@if (session('status'))
<div class="alert alert-success" role="alert">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ session('status') }}
</div>
@elseif(session('failed'))
<div class="alert alert-danger" role="alert">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ session('failed') }}
</div>
@endif
<div class="content">
    <div class="container-fluid">
        <div class="row" style="justify-content: center;">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Absensi Mahasiswa</h4>
                    </div>
                    <div class="card-body" onload="startTime()">
                        <form action="{{route('absensiMhs.store')}}" method="post" id="formAbsen" enctype="multipart/form-data">
                            <div class="row">

                            </div>
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="id_absen" class="form-control" value="{{ old('id_absen',  $absensis->id_absen) }} " style="display:none;" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Nama Lengkap:</label>
                                        <input type="text" name="nama" class="form-control" value="{{ old('nama', auth()->user()->name) }} " readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">NIM:</label>
                                        <input type="text" name="nii" class="form-control" value="{{ old('nii', auth()->user()->nii) }} " readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Mata Kuliah:</label>
                                        <input type="text" name="matkul" class="form-control" value="{{ old('matkul', $absensis->matkul) }} " readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Jam Masuk:</label>
                                        <input type="text" class="form-control" id="jam" name="jam" readonly>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Kehadiran:</label>
                                        <select name="kehadiran" id="kehadiran" class="form-control">
                                            <option value="masuk">Hadir</option>
                                            <option value="izin">Izin</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="izin">
                                <div class="col-md-12">
                                    <input type="file" id="file" name="file">
                                </div>
                            </div>
                            <div class="row" id="hadir">
                                <div class="col-md-12">
                                    <label class="" for="">Tanda Tangan:</label>
                                    <br />
                                    <div id="sign" name="sign"></div>
                                    <br />
                                    <button id="clear" class="btn btn-danger btn-sm">Clear Signature</button>
                                    <textarea id="signature64" name="sign" style="display: none"></textarea>
                                </div>

                            </div>
                            <br />
                            <button type="submit" class="btn btn-success pull-left">Save</button>
                        </form>
                        <a href="{{route('absensiMhs.index')}}" class="btn btn-danger pull-right">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#izin").hide();
        setInterval(startTime, 1000);

        function startTime() {

            const today = new Date();
            let h = today.getHours();
            let m = today.getMinutes();
            let s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            $('#jam').val(h + ":" + m + ":" + s)
            setTimeout(startTime, 1000);
        }

        function checkTime(i) {
            if (i < 10) {
                i = "0" + i
            }; // add zero in front of numbers < 10
            return i;
        }
    });
</script>
<script type="text/javascript">
    var sig = $('#sign').signature({
        syncField: '#signature64',
        syncFormat: 'PNG'
    });
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#signature64").val('');
    });
</script>
@endsection