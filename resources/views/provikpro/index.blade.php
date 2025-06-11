@extends('layouts.template')

@section('content')
    <div style="flex: 1; padding: 10px;">
        <div class="upload-container">
            <h2 class="upload-title">REPORT PROVISIONING INDIHOME {{ date('d/m/Y') }}</h2>
            <div style="position: relative;">
                <button type="submit" form="upload-form" class="btn send-button" id="send">Send</button>
            </div>
            <h2 class="upload-title">POSISI PUKUL {{ now()->format('H:i:s') }} <br><br></h2>
            <div class="table-responsive-wrapper">
                <table class="table table-bordered table-hover table-sm" id="tabel_provikpro">
                    <thead>
                        <tr style="text-align: center;">
                            <th style="vertical-align: middle; background-color: #0563c1; color: white">NO</th>
                            <th style="vertical-align: middle; background-color: #0563c1; color: white">WILAYAH</th>
                            <th style="vertical-align: middle; background-color: #0563c1; color: white">PI TOTAL</th>
                            <th style="vertical-align: middle; background-color: #0563c1; color: white">ACCOMP TOTAL</th>
                            <th style="vertical-align: middle; background-color: #0563c1; color: white">PS + ACCOMP TOTAL</th>
                            <th style="vertical-align: middle; background-color: #0563c1; color: white">PS/PI TOTAL</th>
                            <th style="vertical-align: middle; background-color: #0563c1; color: white">SISA MANJA</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <h2 class="upload-title"><br><br></h2>
            <h2 class="upload-title">TARGET PS JATIM 3: </h2> {{-- BELUM TERHUBUNG DENGAN DATA --}}
            <h2 class="upload-title">PI/TARGET: </h2> {{-- BELUM TERHUBUNG DENGAN DATA --}}
            <h2 class="upload-title">RUN RATE PS: </h2> {{-- BELUM TERHUBUNG DENGAN DATA --}}
            <h2 class="upload-title">ESTIMASI PS: </h2> {{-- BELUM TERHUBUNG DENGAN DATA --}}
            <h2 class="upload-title">ESTIMASI PS/TARGET: </h2> {{-- BELUM TERHUBUNG DENGAN DATA --}}
            <h2 class="upload-title"><br><br>KESIMPULAN: DIBUTUHKAN RUN RATE PS </h2> {{-- BELUM TERHUBUNG DENGAN DATA --}}
            <h2 class="upload-title">ESTIMASI PS HARI INI: </h2> {{-- BELUM TERHUBUNG DENGAN DATA --}}
            <h2 class="upload-title">DEVIASI: </h2> {{-- BELUM TERHUBUNG DENGAN DATA --}}
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

        .table-responsive-wrapper {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        
        #tabel_provikpro {
            font-family: 'Poppins', sans-serif;
            text-align: center;
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 10px;
            overflow: hidden;
        }

        #tabel_provikpro th,
        #tabel_provikpro td {
            padding: 8px 15px;
        }

        #tabel_provikpro tbody tr:last-child td:first-child {
            border-bottom-left-radius: 10px;
        }

        #tabel_provikpro tbody tr:last-child td:last-child {
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
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            if (!$.fn.DataTable.isDataTable('#tabel_provikpro')) {
                var dataUser = $('#tabel_provikpro').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        "url": "{{ route('provikpro.list') }}",
                        "type": "POST",
                        "data": function(d) {
                            d.id_wilayah = $('#id_wilayah').val();
                            d.id_endstate = $('#id_endstate').val();
                            d.id_provi_manja = $('#id_provi_manja').val();
                        }
                    },
                    columns: [{
                            data: "DT_RowIndex",
                            className: "text-center",
                            orderable: false,
                            searchable: false
                        }, {
                            data: "wilayah.nama_wilayah",
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: "endstate.pi_tot",
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: "endstate.ps_tot",
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: "endstate.accomp",
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: "ps_accomp_tot",
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: "ps_pi_tot",
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: "provimanja.total",
                            orderable: false,
                            searchable: false
                        }
                    ]
                });

                $('#id_sektor').on('change', function() {
                    dataSektor.ajax.reload();
                });

                $('#id_endstate').on('change', function() {
                    dataEndstate.ajax.reload();
                });

                $('#id_provi_manja').on('change', function() {
                    dataProviManja.ajax.reload();
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
