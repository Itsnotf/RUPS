<!-- resources/views/pages/user/create.blade.php -->

@extends('layouts.app')

@section('title', 'Buat Kompartement')
@section('desc', 'Dihalaman ini anda bisa membuat kompartement.')

@section('content')
<form action="{{ route('kompartement.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Buat Kompartement</h4>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input value="{{ old('nama') }}" type="text"
                                class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama"
                                placeholder="Nama">
                            @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="desk" class="col-sm-3 col-form-label">Deskripsi</label>
                        <div class="col-sm-9">
                            <input value="{{ old('desk') }}" type="text"
                                class="form-control @error('desk') is-invalid @enderror" name="desk" id="desk"
                                placeholder="Deskripsi">
                            @error('desk')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
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
