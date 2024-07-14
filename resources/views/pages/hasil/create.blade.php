<!-- resources/views/pages/user/create.blade.php -->

@extends('layouts.app')

@section('title', 'Buat Arahan')
@section('desc', 'Dihalaman ini anda bisa membuat arahan.')

@section('content')
<form action="{{ route('arahan.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Buat User</h4>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="id_Kompartement" class="col-sm-3 col-form-label">Kompartement</label>
                        <div class="col-sm-9">
                            <select name="id_Kompartement" id="id_Kompartement" class="form-control text-capitalize @error('id_Kompartement') is-invalid @enderror">
                                <option value="">Pilih Kompartement</option>
                                @foreach ($kompartements as $k)
                                <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                @endforeach
                            </select>
                            @error('id_Kompartement')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="desk" class="col-sm-3 col-form-label">Arahan</label>
                        <div class="col-sm-9">
                            <input value="{{ old('desk') }}" type="text"
                                class="form-control @error('desk') is-invalid @enderror" name="desk" id="desk"
                                placeholder="Berikan Arahan">
                            @error('desk')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group custom-file">
                        <label for="file" class="custom-file-label">File Notulensi Evaluasi Rapat</label>
                        <input value="{{ old('file') }}" type="file"
                            class="custom-file-input @error('file') is-invalid @enderror" name="file"
                            id="file" placeholder="File">
                        @error('file')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>


                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
