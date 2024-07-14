<!-- resources/views/pages/user/create.blade.php -->

@extends('layouts.app')

@section('title', 'Buat User')
@section('desc', 'Dihalaman ini anda bisa membuat user.')

@section('content')
<form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h4>Buat User</h4>
                </div>
                <div class="card-body">

                    <div class="form-group row">
                        <label for="id_Jabatan" class="col-sm-3 col-form-label">Jabatan</label>
                        <div class="col-sm-9">
                            <select name="id_Jabatan" id="id_Jabatan"
                                class="form-control text-capitalize @error('id_Jabatan') is-invalid @enderror">
                                @foreach ($jabatans as $j )
                                <option value="{{$j->id}}">{{$j->nama}}</option>
                                @endforeach

                            </select>
                            @error('id_Jabatan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

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
                        <label for="id_Department" class="col-sm-3 col-form-label">Department</label>
                        <div class="col-sm-9">
                            <select name="id_Department" id="id_Department" class="form-control text-capitalize @error('id_Department') is-invalid @enderror">
                                <option value="">Pilih Kompertement Dahulu</option>
                            </select>
                            @error('id_Department')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input value="{{ old('name') }}" type="text"
                                class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                                placeholder="Nama">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input value="{{ old('email') }}" type="text"
                                class="form-control @error('email') is-invalid @enderror" name="email" id="email"
                                placeholder="Email">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="role" class="col-sm-3 col-form-label">Role</label>
                        <div class="col-sm-9">
                            <select name="role" id="role"
                                class="form-control text-capitalize @error('role') is-invalid @enderror">
                                <option value="admin">admin</option>
                                <option value="coadmin">coadmin</option>
                                <option value="user">user</option>
                            </select>
                            @error('role')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="username" class="col-sm-3 col-form-label">Username</label>
                        <div class="col-sm-9">
                            <input value="{{ old('username') }}" type="text"
                                class="form-control @error('username') is-invalid @enderror" name="username"
                                id="username" placeholder="Username">
                            @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" id="password" placeholder="Password">
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password_confirmation" class="col-sm-3 col-form-label">Confirm Password</label>
                        <div class="col-sm-9">
                            <input type="password"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                name="password_confirmation" id="password_confirmation" placeholder="Password">
                            @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Existing form fields -->
                    <!-- ... -->
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h4>Avatar</h4>
                </div>
                <div class="card-body">
                    <img alt="avatar" src="{{ asset('/assets/img/avatar/avatar-1.png') }}" class="rounded-circle w-100 mb-3">
                    <div class="clearfix"></div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="avatar" name="avatar">
                        <label class="custom-file-label" for="avatar">Pilih Avatar</label>
                    </div>
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
    });
</script>
@endsection
