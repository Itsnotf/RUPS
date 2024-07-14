@extends('layouts.app')

@section('title', 'Kelola Hasil')
@section('desc', ' Dihalaman ini anda bisa kelola hasil. ')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>List Hasil</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped w-100" id="datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Arahan</th>
                            <th>File Arahan</th>
                            <th>Pembuatan Hasil</th>
                            <th>Keterangan Hasil</th>
                            <th>Bukti</th>
                            <th>Tahap</th>
                            <th>Keterangan Status</th>
                            <th>Status</th>
                            <th>Aksi</th>
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
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'arahan',
                        name: 'arahan'
                    },
                    {
                        data: 'file',
                        name: 'file'
                    },
                    {
                        data: 'user',
                        name: 'user'
                    },
                    {
                        data: 'desk',
                        name: 'desk'
                    },
                    {
                        data: 'Bukti',
                        name: 'Bukti'
                    },
                    {
                        data: 'tahap',
                        name: 'tahap'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi'
                    },
                ],
                columnDefs: [{
                    "targets": -2,
                    "render": function(data, type, row, meta) {
                        if (data === 'Belum ada') {
                            return `<div class="badge badge-secondary">${data}</div>`;
                        } else if (data === 'Dalam proses') {
                            return `<div class="badge badge-warning">${data}</div>`;
                        } else if (data === 'Revisi') {
                            return `<div class="badge badge-danger">${data}</div>`;
                        } else {
                            return `<div class="badge badge-success">${data}</div>`;
                        }
                    }
                }, {
                    "targets": 5,
                    "render": function(data, type, row, meta) {
                        let img = `assets/img/avatar/avatar-1.png`;
                        if (data) {
                            img = `storage/${data}`;
                        }
                        if (data === 'Belum ada') {
                            return 'Belum ada';
                        }
                        return `<a href="{{ asset('/') }}${img}" target="_blank"><img alt="avatar" src="{{ asset('/') }}${img}" width="35"></a>`;
                    }
                }, {
                    "targets": -1,
                    "render": function(data, type, row, meta) {
                        let buttons = '';

                        // Edit button, disabled if status is 'Dalam proses'
                        if (row.status === 'Dalam proses' || row.status === 'Sudah sesuai') {
                            @if (auth()->user()->Jabatan->nama === 'Staff PIC')
                                buttons +=
                                    `<a href="#" class="btn btn-sm btn-warning mr-2" style="pointer-events: none; opacity: 0.5;" aria-disabled="true">Edit</a>`;
                            @endif

                        } else {
                            @if (auth()->user()->Jabatan->nama === 'Staff PIC')
                                buttons +=
                                    `<a href="{{ url('/hasil') }}/${row.id}/edit" class="btn btn-sm btn-warning mr-2">Edit</a>`;
                            @endif
                        }

                        if (row.status == 'Revisi' || row.tahap != 'Reviewer 1') {
                            @if (strtolower(auth()->user()->Jabatan->nama) === 'staff monitoring eval')
                                buttons +=
                                    `<a href="#" class="btn btn-sm btn-warning mr-2" style="pointer-events: none; opacity: 0.5;" aria-disabled="true">Reviewer 1</a>`;
                            @endif
                        } else {
                            @if (strtolower(auth()->user()->Jabatan->nama) === 'staff monitoring eval')
                                buttons +=
                                    `<a href="{{ url('/hasil') }}/${row.id}/review" class="btn btn-sm btn-warning mr-2">Reviewer 1</a>`;
                            @endif
                        }

                        if (row.status == 'Revisi' || row.tahap != 'Approval 1') {
                            @if (strtolower(auth()->user()->Jabatan->nama) === 'vice president department')
                                buttons +=
                                    `<a href="#" class="btn btn-sm btn-warning mr-2" style="pointer-events: none; opacity: 0.5;" aria-disabled="true">Approval 1</a>`;
                            @endif
                        } else {
                            @if (strtolower(auth()->user()->Jabatan->nama) === 'vice president department')
                                buttons +=
                                    `<a href="{{ url('/hasil') }}/${row.id}/review" class="btn btn-sm btn-warning mr-2">Approval 1</a>`;
                            @endif
                        }

                        if (row.status == 'Revisi' || row.tahap != 'Approval 2') {
                            @if (strtolower(auth()->user()->Jabatan->nama) === 'senior vice president department')
                                buttons +=
                                    `<a href="#" class="btn btn-sm btn-warning mr-2" style="pointer-events: none; opacity: 0.5;" aria-disabled="true">Approval 2</a>`;
                            @endif
                        } else {
                            @if (strtolower(auth()->user()->Jabatan->nama) === 'senior vice president department')
                                buttons +=
                                    `<a href="{{ url('/hasil') }}/${row.id}/review" class="btn btn-sm btn-warning mr-2">Approval 2</a>`;
                            @endif
                        }

                        if (row.status == 'Revisi' || row.tahap != 'Reviewer 2') {
                            @if (strtolower(auth()->user()->Jabatan->nama) === 'senior auditor')
                                buttons +=
                                    `<a href="#" class="btn btn-sm btn-warning mr-2" style="pointer-events: none; opacity: 0.5;" aria-disabled="true">Reviewer 2</a>`;
                            @endif
                        } else {
                            @if (strtolower(auth()->user()->Jabatan->nama) === 'senior auditor')
                                buttons +=
                                    `<a href="{{ url('/hasil') }}/${row.id}/review" class="btn btn-sm btn-warning mr-2">Reviewer 2</a>`;
                            @endif
                        }

                        if (row.status == 'Revisi' || row.tahap != 'Reviewer 3') {
                            @if (strtolower(auth()->user()->Jabatan->nama) === 'pengendali teknis')
                                buttons +=
                                    `<a href="#" class="btn btn-sm btn-warning mr-2" style="pointer-events: none; opacity: 0.5;" aria-disabled="true">Reviewer 3</a>`;
                            @endif
                        } else {
                            @if (strtolower(auth()->user()->Jabatan->nama) === 'pengendali teknis')
                                buttons +=
                                    `<a href="{{ url('/hasil') }}/${row.id}/review" class="btn btn-sm btn-warning mr-2">Reviewer 3</a>`;
                            @endif
                        }

                        if (row.status == 'Revisi' || row.tahap != 'Reviewer 4') {
                            @if (strtolower(auth()->user()->Jabatan->nama) === 'vice president')
                                buttons +=
                                    `<a href="#" class="btn btn-sm btn-warning mr-2" style="pointer-events: none; opacity: 0.5;" aria-disabled="true">Reviewer 4</a>`;
                            @endif
                        } else {
                            @if (strtolower(auth()->user()->Jabatan->nama) === 'vice president')
                                buttons +=
                                    `<a href="{{ url('/hasil') }}/${row.id}/review" class="btn btn-sm btn-warning mr-2">Reviewer 4</a>`;
                            @endif
                        }

                        if (row.status == 'Revisi' || row.tahap != 'Reviewer 5') {
                            @if (strtolower(auth()->user()->Jabatan->nama) === 'senior vice president')
                                buttons +=
                                    `<a href="#" class="btn btn-sm btn-warning mr-2" style="pointer-events: none; opacity: 0.5;" aria-disabled="true">Reviewer 5</a>`;
                            @endif
                        } else {
                            @if (strtolower(auth()->user()->Jabatan->nama) === 'senior vice president')
                                buttons +=
                                    `<a href="{{ url('/hasil') }}/${row.id}/review" class="btn btn-sm btn-warning mr-2">Reviewer 5</a>`;
                            @endif
                        }





                        // Approval and Reviewer buttons based on tahap and status
                        // if (row.status === 'Revisi') {
                        //     buttons +=
                        //         `<a href="{{ url('/hasil') }}/${row.id}/edit" class="btn btn-sm btn-warning mr-2">Edit</a>`;
                        // } else {
                        //     if (row.tahap === 'Approval 1') {
                        //         @if (auth()->user()->Jabatan->nama === 'Vice President Department')
                        //             buttons +=
                        //                 `<a href="{{ url('/hasil') }}/${row.id}/review" class="btn btn-sm btn-warning mr-2">Approval 1</a>`;
                        //         @endif
                        //     } else if (row.tahap === 'Approval 2') {
                        //         @if (auth()->user()->Jabatan->nama === 'Senior President Department')
                        //             buttons +=
                        //                 `<a href="{{ url('/hasil') }}/${row.id}/review" class="btn btn-sm btn-warning mr-2">Approval 2</a>`;
                        //         @endif
                        //     } else if (row.tahap === 'Reviewer 1') {
                        //         @if (auth()->user()->Jabatan->nama === 'Staff monitoring eval')
                        //             buttons +=
                        //                 `<a href="{{ url('/hasil') }}/${row.id}/review" class="btn btn-sm btn-warning mr-2">Reviewer 1</a>`;
                        //         @endif
                        //     } else if (row.tahap === 'Reviewer 2') {
                        //         @if (auth()->user()->Jabatan->nama === 'Senior Auditor')
                        //             buttons +=
                        //                 `<a href="{{ url('/hasil') }}/${row.id}/review" class="btn btn-sm btn-warning mr-2">Reviewer 2</a>`;
                        //         @endif
                        //     } else if (row.tahap === 'Reviewer 3') {
                        //         @if (auth()->user()->Jabatan->nama === 'Pengendali Teknis')
                        //             buttons +=
                        //                 `<a href="{{ url('/hasil') }}/${row.id}/review" class="btn btn-sm btn-warning mr-2">Reviewer 3</a>`;
                        //         @endif
                        //     } else if (row.tahap === 'Reviewer 4') {
                        //         @if (auth()->user()->Jabatan->nama === 'Vice President')
                        //             buttons +=
                        //                 `<a href="{{ url('/hasil') }}/${row.id}/review" class="btn btn-sm btn-warning mr-2">Reviewer 4</a>`;
                        //         @endif
                        //     } else if (row.tahap === 'Reviewer 5') {
                        //         @if (auth()->user()->Jabatan->nama === 'Senior Vice President')
                        //             buttons +=
                        //                 `<a href="{{ url('/hasil') }}/${row.id}/review" class="btn btn-sm btn-warning mr-2">Reviewer 5</a>`;
                        //         @endif
                        //     }
                        // }

                        return buttons;
                    }
                }],
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
@endpush()
