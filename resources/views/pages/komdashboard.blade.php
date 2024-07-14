@extends('layouts.app')

@section('title', 'Dashboard Kompertment')
@section('desc', 'Halaman Dashboard Kompertment.')

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
                                <th>Pembuatan Hasil</th>
                                <th>Keterangan Hasil</th>
                                <th>Tahap</th>
                                <th>Keterangan Status</th>
                                <th>Bukti</th>
                                <th>File Arahan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

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
                                data: 'user',
                                name: 'user'
                            },
                            {
                                data: 'desk',
                                name: 'desk'
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
                                data: 'Bukti',
                                name: 'Bukti'
                            },
                            {
                                data: 'file',
                                name: 'file'
                            },
                            {
                                data: 'status',
                                name: 'status'
                            },
                        ],
                        columnDefs: [{
                            "targets": -1,
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
                            "targets": 6,
                            "render": function(data, type, row, meta) {
                                let img = `assets/img/avatar/avatar-1.png`;
                                if (data) {
                                    img = `storage/${data}`;
                                }
                                if (data === 'Belum ada') {
                                    return 'Belum ada';
                                }
                                return `<a href="{{ asset('/') }}${img}" target="_blank"><img alt="avatar" src="{{ asset('/') }}${img}" width="60"></a>`;
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

@endsection
