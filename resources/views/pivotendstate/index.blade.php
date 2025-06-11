@extends('layouts.template')

@section('content')
    <div style="flex: 1; padding: 10px;">
        <div class="upload-container">
            <div style="min-height: 40px;"></div>
            <div style="position: relative;">
                <button type="submit" form="upload-form" class="btn send-button" id="send">Send</button>
            </div>
            {{-- <form action="{{ route('pivotendstate.store') }}" method="POST" enctype="multipart/form-data" class="upload-form">
                @csrf
                <input type="file" name="file" accept=".csv" required>
            </form> --}}

            <h2 class="pivot-title">Pivot Table</h2>
            <div class="table-responsive-wrapper">
                <table class="table table-bordered table-hover table-sm" id="tabel_pivotendstate">
                    <thead>
                        <tr>
                            <th colspan="12" style="text-align: left; background-color: #EBEBEB; font-weight: 500;">
                                REPORT PIVOT ENDSTATE PERIODE {{ date('d/m/Y') }}
                            </th>
                        </tr>
                        <tr style="text-align: center;">
                            <th style="vertical-align: middle; background-color: #0563c1; color: white">SEKTOR</th>
                            <th style="vertical-align: middle; background-color: #0563c1; color: white">PI TOTAL</th>
                            <th style="vertical-align: middle; background-color: #0563c1; color: white">PS TOTAL</th>
                            <th style="vertical-align: middle; background-color: #0563c1; color: white">CANCEL TOTAL</th>
                            <th style="vertical-align: middle; background-color: #0563c1; color: white">FALLOUT TOTAL</th>
                            <th style="vertical-align: middle; background-color: #0563c1; color: white">PS/PI TOTAL</th>
                            <th style="vertical-align: middle; background-color: #0563c1; color: white">CANCEL/PI TOTAL</th>
                            <th style="vertical-align: middle; background-color: #0563c1; color: white">FALLOUT/PI TOTAL</th>
                        </tr>
                    </thead>
                </table>
            </div>
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
            max-height: 500px;
            overflow-y: auto;
            overflow-x: auto;
            border: 1px solid #ccc;
        }

        #tabel_pivotendstate {
            font-family: 'Poppins', sans-serif;
            text-align: center;
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 10px;
            overflow: hidden;
            /* Agar sudutnya ikut melengkung */
        }

        #tabel_pivotendstate th,
        #tabel_pivotendstate td {
            padding: 8px 15px;
        }

        #tabel_pivotendstate tbody tr:last-child td:first-child {
            border-bottom-left-radius: 10px;
        }

        #tabel_pivotendstate tbody tr:last-child td:last-child {
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

        .send-button:hover {
            background-color: #ffffff;
            color: #C8170D;
            cursor: pointer;
            border-color: #afafaf;
        }
    </style>
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            if (!$.fn.DataTable.isDataTable('#tabel_pivotendstate')) {
                $('#tabel_pivotendstate').DataTable({
                    processing: true,
                    serverSide: false,
                    ajax: {
                        "url": "{{ route('pivotendstate.list') }}",
                        "type": "POST",
                        "data": function(d) {
                            console.log(d); // Log data untuk debugging
                            // d.id_sektor = $('#id_sektor').val();
                        }
                    },
                    paging: false, // Nonaktifkan pagination
                    info: false, // Nonaktifkan informasi jumlah data
                    searching: false, // Nonaktifkan fitur pencarian
                    columns: [{
                            data: "sektor.nama_sektor",
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
                            data: "cancel_tot",
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: "fallout_tot",
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: "ps_pi_tot",
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: "cancel_pi_tot",
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: "fallout_pi_tot",
                            orderable: false,
                            searchable: false
                        },
                    ]
                });

                // $('#id_sektor').on('change', function() {
                //     dataWilayah.ajax.reload();
                // });
            }

            // Pasang event listener tombol Send sekali saja
            console.log("Memasang event listener tombol Send");
            let isSending = false;

            $('#send').off('click').on('click', function(e) {
                e.preventDefault();

                // Cek apakah tabel sudah terisi
                const dataTable = $('#tabel_pivotendstate').DataTable();
                const rowCount = dataTable.rows().count();

                if (rowCount === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Tabel kosong!',
                        text: 'Silakan upload file dan pastikan data telah muncul di tabel sebelum mengirim!',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                if (isSending) {
                    console.log("Proses pengiriman sedang berjalan, harap tunggu...");
                    return;
                }
                isSending = true;

                const table = document.querySelector('#tabel_pivotendstate');
                if (!table) {
                    alert("Tabel tidak ditemukan!");
                    isSending = false;
                    return;
                }

                html2canvas(table).then(function(canvas) {
                    canvas.toBlob(function(blob) {
                        const formData = new FormData();
                        formData.append('screenshot', blob, 'screenshot.png');
                        formData.append('_token', '{{ csrf_token() }}');

                        fetch('{{ route("pivotendstate.send-to-telegram") }}', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Laporan berhasil dikirim ke Telegram.',
                                    confirmButtonText: 'OK'
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal mengirim!',
                                    text: data.error || 'Terjadi kesalahan saat mengirim ke Telegram.',
                                    confirmButtonText: 'OK'
                                });
                            }
                            isSending = false;
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi kesalahan',
                                text: 'Gagal mengirim laporan ke Telegram.',
                                confirmButtonText: 'OK'
                            });
                            isSending = false;
                        });
                    });
                });
            });

            // Pasang event listener form upload
            $('#upload-form').on('submit', function(e) {
                
            });
        });   
    </script>
@endpush

        {{-- $(document).ready(function() {
            $('#example').DataTable({
                "searching": false, // Hilangkan fitur Search
                "paging": false, // Hilangkan pagination (Previous/Next)
                "info": false, // Hilangkan informasi jumlah data
                "lengthChange": false // Hilangkan Show Entries
            });
        }); --}}
