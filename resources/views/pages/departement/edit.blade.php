@extends('layouts.app')

@section('title', 'Edit Department')
@section('desc', 'Dihalaman ini anda bisa edit department.')

@section('content')
<form action="{{ route('department.update', $item->id) }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Department</h4>
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
                        <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input value="{{ old('nama', $item->nama) }}" type="text"
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const kompartementSelect = document.getElementById('id_Kompartement');
        const departmentSelect = document.getElementById('id_Department');

        kompartementSelect.addEventListener('change', function () {
            const kompartementId = this.value;

            if (kompartementId) {
                fetch(`/get-departments/${kompartementId}`)
                    .then(response => response.json())
                    .then(data => {
                        departmentSelect.innerHTML = '<option value="">Pilih Department</option>';
                        data.forEach(department => {
                            const option = document.createElement('option');
                            option.value = department.id;
                            option.textContent = department.nama;
                            departmentSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching departments:', error));
            } else {
                departmentSelect.innerHTML = '<option value="">Pilih Department</option>';
            }
        });

        // Trigger the change event to load the departments when the page loads
        if (kompartementSelect.value) {
            kompartementSelect.dispatchEvent(new Event('change'));
        }
    });
</script>
@endsection
