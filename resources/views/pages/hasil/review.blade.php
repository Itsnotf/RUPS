@extends('layouts.app')

@section('title', 'Edit Hasil')
@section('desc', 'Dihalaman ini anda bisa edit hasil.')

@section('content')
    <form action="{{ route('next', $item->id) }}" method="POST" enctype="multipart/form-data">
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
                            <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                            <div class="col-sm-9">
                                <input value="{{ old('keterangan', $item->keterangan) }}" type="text"
                                    class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" id="keterangan"
                                    placeholder="Keterangan">
                                @error('keterangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="status" class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                <select name="status" id="status"
                                    class="form-control text-capitalize @error('status') is-invalid @enderror">
                                    <option value="Revisi">Revisi</option>
                                    <option value="Dalam proses">Sudah Sesuai</option>
                                </select>
                                @error('status')
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
