@extends('layouts.template')

@section('content')
    <div style="flex: 1; padding: 10px;">
        <div class="upload-container">
            <h2 class="upload-title">Upload File</h2>
            <div style="position: relative;">
                <button type="submit" form="upload-form" class="btn send-button" id="send">Send</button>
            </div>
            <form id="upload-form" action="{{ route('orbit.import-proses') }}" method="POST" enctype="multipart/form-data"
                class="upload-form">
                @csrf
                <input type="file" name="file" id="fileInput" required>
                <button type="submit" class="btn upload-button" id="upload">Upload</button>
            </form>

            <h2 class="pivot-title">Pivot Table</h2>
            <table class="table table-bordered table-hover table-sm" id="tabel_orbit">
                <thead>
                    <tr>
                        <th colspan="12" style="text-align: left; background-color: #EBEBEB; font-weight: 500;">
                            REPORT ORBIT PERIODE {{ date('d/m/Y') }}
                        </th>
                    </tr>
                    <tr style="text-align: center;">
                        <th style="vertical-align: middle;">WILAYAH</th>
                        <th style="vertical-align: middle;">PI HI</th>
                        <th style="vertical-align: middle;">PS HI</th>
                        <th style="vertical-align: middle;">PS/PI HI</th>
                        <th style="vertical-align: middle;">PI TOT</th>
                        <th style="vertical-align: middle;">PS TOT</th>
                        <th style="vertical-align: middle;">PS/PI TOT</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .upload-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 19px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            min-height: auto;
            margin-top: -40px;
        }

        .upload-title,
        .pivot-title {
            text-align: left;
            font-size: 20px;
            color: #881A14;
            margin-bottom: 10px;
            font-weight: bolder;
        }

        .pivot-title {
            margin-top: 50px;
        }

        .upload-form {
            text-align: left;
        }

        .upload-form input[type="file"] {
            display: block;
            margin-bottom: 10px;
        }

        /* Hilangkan fitur Search */
        .dataTables_filter {
            display: none;
        }

        /* Hilangkan fitur Show Entries */
        .dataTables_length {
            display: none;
        }

        /* Hilangkan navigasi Previous dan Next */
        .dataTables_paginate {
            display: none;
        }

        /* Hilangkan informasi jumlah data */
        .dataTables_info {
            display: none;
        }

        #tabel_orbit {
            font-family: 'Poppins', sans-serif;
            text-align: center;
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 10px;
            overflow: hidden;
            /* Agar sudutnya ikut melengkung */
        }

        #tabel_orbit th,
        #tabel_orbit td {
            padding: 8px 15px;
        }

        #tabel_orbit tbody tr:last-child td:first-child {
            border-bottom-left-radius: 10px;
        }

        #tabel_orbit tbody tr:last-child td:last-child {
            border-bottom-right-radius: 10px;
        }

        .send-button {
            font-family: 'Poppins', sans-serif;
            font-weight: bold;
            background-color: #C8170D;
            color: #fff;
            position: absolute;
            right: 1px;
            top: -30px;
            z-index: 10;
            border-radius: 10px;
            padding: 8px 20px;
        }

        .send-button:hover {
            background-color: #ffffff;
            color: #C8170D;
            cursor: pointer;
            border-color: #afafaf;
        }

        .upload-button {
            font-family: 'Poppins', sans-serif;
            font-weight: bold;
            background-color: #ffffff;
            color: #881A14;
            border-color: #afafaf;
            right: 1px;
            top: -30px;
            z-index: 10;
            border-radius: 10px;
            padding: 8px 20px;
        }

        .upload-button:hover {
            background-color: #C8170D;
            color: #fff;
            cursor: pointer;
        }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            if (!$.fn.DataTable.isDataTable('#tabel_orbit')) {
                var dataUser = $('#tabel_orbit').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        "url": "{{ route('orbit.list') }}",
                        "type": "POST",
                        "data": function(d) {
                            d.id_wilayah = $('#id_wilayah').val();
                        }
                    },
                    columns: [{
                            data: "wilayah.nama_wilayah",
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: "pi_hi",
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: "ps_hi",
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: "ps_pi_hi",
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: "pi_tot",
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: "ps_tot",
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: "ps_pi_tot",
                            orderable: false,
                            searchable: false
                        }
                    ]
                });

                $('#id_wilayah').on('change', function() {
                    dataWilayah.ajax.reload();
                });
            }
        });
        $(document).ready(function() {
            $('#example').DataTable({
                "searching": false, // Hilangkan fitur Search
                "paging": false, // Hilangkan pagination (Previous/Next)
                "info": false, // Hilangkan informasi jumlah data
                "lengthChange": false // Hilangkan Show Entries
            });
        });
    </script>
@endpush
