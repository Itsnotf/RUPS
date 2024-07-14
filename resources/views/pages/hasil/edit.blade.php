@extends('layouts.app')

@section('title', 'Edit Hasil')
@section('desc', 'Dihalaman ini anda bisa edit hasil.')

@section('content')
    <form action="{{ route('hasil.update', $item->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Arahan</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="bukti" class="col-sm-3 col-form-label">Bukti Hasil</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="Bukti" name="Bukti">
                                        <label class="custom-file-label" for="Bukti">Pilih Bukti</label>
                                    </div>
                                </div>
                                @error('bukti')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="desk" class="col-sm-3 col-form-label">Desk</label>
                            <div class="col-sm-9">
                                <input value="{{ old('desk', $item->desk) }}" type="text"
                                    class="form-control @error('desk') is-invalid @enderror" name="desk" id="desk"
                                    placeholder="Desk">
                                @error('desk')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
