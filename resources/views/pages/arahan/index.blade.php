@extends('layouts.app')

@section('title', 'Kelola Arahan')
@section('desc', ' Dihalaman ini anda bisa kelola arahan. ')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>List Arahan</h4>
            <div class="card-header-action">
                @if (strtolower(auth()->user()->Jabatan->nama) == 'staff monitoring eval' || strtolower(auth()->user()->Jabatan->nama) == 'direktur')
                    <a href="{{ route('arahan.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i>
                        Tambah
                    </a>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped w-100" id="datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Arahan</th>
                            <th>Pembuatan Arahan</th>
                            <th>Kompartement</th>
                            <th>File</th>
                            @if (strtolower(auth()->user()->Jabatan->nama) == 'staff monitoring eval' || strtolower(auth()->user()->Jabatan->nama) == 'direktur')
                                <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            var datatable = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                ajax: {
                    url: "{!! url()->current() !!}"
                },
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, 'ALL']
                ],
                responsive: true,
                order: [
                    [0, 'desc'],
                ],
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'desk', name: 'desk' },
                    { data: 'user', name: 'user' },
                    { data: 'kompartement', name: 'kompartement' },
                    { data: 'file', name: 'file' },
                    @if (strtolower(auth()->user()->Jabatan->nama) == 'staff monitoring eval' || strtolower(auth()->user()->Jabatan->nama) == 'direktur')
                    { data: 'aksi', name: 'aksi', orderable: false, searchable: false }
                    @endif
                ],
                columnDefs: [
                    {
                        targets: -1,
                        render: function(data, type, row, meta) {
                            @if (strtolower(auth()->user()->Jabatan->nama) == 'staff monitoring eval' || strtolower(auth()->user()->Jabatan->nama) == 'direktur')
                            return `
                                <form action="{{ url('/arahan') }}/${row.id}" method="POST" class="d-flex">
                                    @method('DELETE')
                                    @csrf
                                    <a href="{{ url('/arahan') }}/${row.id}/edit" class="btn btn-sm btn-warning mr-2">Edit</a>
                                    <button type="submit" class="btn-delete btn btn-sm btn-danger">Delete</button>
                                </form>
                            `;
                            @else
                            return '';
                            @endif
                        }
                    }
                ],
                rowId: function(a) {
                    return a;
                },
                rowCallback: function(row, data, iDisplayIndex) {
                    var info = this.fnPagingInfo();
                    var page = info.iPage;
                    var length = info.iLength;
                    var index = page * length + (iDisplayIndex + 1);
                    $('td:eq(0)', row).html(index);
                },
            });
        });
    </script>
@endpush
