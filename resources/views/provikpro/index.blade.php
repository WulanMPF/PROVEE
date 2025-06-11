@extends('layouts.template')

@section('content')
    <div style="flex: 1; padding: 10px;">
        <div class="upload-container">
            <h2 class="upload-title">REPORT PROVISIONING INDIHOME {{ date('d/m/Y') }}</h2>
            <div style="position: relative;">
                <button type="submit" form="upload-form" class="btn send-button" id="send">Send</button>
            </div>
            <h2 class="upload-title">POSISI PUKUL {{ now()->format('H:i:s') }} <br><br></h2>

            <h2 class="upload-title">NO. WILAYAH : PI [TOT] | PS [TOT] | ACOMP [TOT] | PS + ACOMP [TOT] | % PS + ACOMP
                [TOT] / PI | SISA MANJA</h2>

            @php
                // Initialize totals for JATIM BARAT
                $total_pi_tot = 0;
                $total_ps_tot = 0;
                $total_accomp_tot = 0;
                $total_ps_accomp_tot = 0;
                $total_sisa_manja = 0;

                $total_target_ps = 0;
                $today = \Carbon\Carbon::now()->day;
                $days_in_month = \Carbon\Carbon::now()->daysInMonth;

                $total_ps_hi = 0;
            @endphp

            @foreach ($data as $key => $item)
                @php
                    $region = $item['region'];
                    $sector = $item['sector'];

                    $pi_tot = $region->pi_tot ?? 0;
                    $ps_tot = $region->ps_tot ?? 0;
                    $accomp_tot = $region->accomp ?? 0;
                    $ps_accomp_tot = $ps_tot + $accomp_tot;
                    $percentage_ps_pi = $pi_tot != 0 ? round(($ps_accomp_tot / $pi_tot) * 100, 2) . '%' : '0%';
                    $sisa_manja = $sector->total ?? 0;

                    $target_ps = $region->target_tot ?? 0;
                    $ps_hi = $region->ps_hi ?? 0;

                    // Accumulate totals for JATIM BARAT
                    $total_pi_tot += $pi_tot;
                    $total_ps_tot += $ps_tot;
                    $total_accomp_tot += $accomp_tot;
                    $total_ps_accomp_tot += $ps_accomp_tot;
                    $total_sisa_manja += $sisa_manja;

                    $total_target_ps += $target_ps;
                    $total_pi_target = $total_target_ps != 0 ? round(($total_pi_tot / $total_target_ps) * 100, 2) . '%' : '0%';
                    $total_ps_target = $total_target_ps != 0 ? round(($total_ps_tot / $total_target_ps) * 100, 2) . '%' : '0%';
                    $run_rate_ps = $today != 0 ? floor($total_ps_tot / $today) : 0;
                    $estimasi_ps = $run_rate_ps * $days_in_month;
                    $estimasi_ps_target = $total_target_ps != 0 ? round(($estimasi_ps / $total_target_ps) * 100, 2) . '%' : '0%';

                    $cc4 = $days_in_month - $today + 1;
                    $deviasi_target = $total_target_ps - $total_ps_tot;
                    $target_in_day = $cc4 != 0 ? ceil($deviasi_target / $cc4) : 0;
                    $total_ps_hi += $ps_hi;
                    $estimasi_hari_ini = $total_ps_hi + $total_accomp_tot;
                    $deviasi = $target_in_day - $total_ps_hi - $total_accomp_tot;
                @endphp

                <h2 class="upload-title">
                    {{ $loop->index + 1 }}. {{ $key }} : {{ $pi_tot }} |
                    {{ $ps_tot }} | {{ $accomp_tot }} | {{ $ps_accomp_tot }} | {{ $percentage_ps_pi }} |
                    {{ $sisa_manja }}
                </h2>
            @endforeach

            {{-- Add JATIM BARAT totals --}}
            <h2 class="upload-title">4. JATIM BARAT : {{ $total_pi_tot }} | {{ $total_ps_tot }} | {{ $total_accomp_tot }}
                | {{ $total_ps_accomp_tot }} |
                {{ $total_pi_tot != 0 ? round(($total_ps_accomp_tot / $total_pi_tot) * 100, 2) . '%' : '0%' }} |
                {{ $total_sisa_manja }}</h2>

            <h2 class="upload-title"><br></h2>
            <h2 class="upload-title">TARGET PS JATIM 3: {{ $total_target_ps }}</h2>
            <h2 class="upload-title">PI/TARGET: {{ $total_pi_target }}</h2>
            <h2 class="upload-title">PS/TARGET: {{ $total_ps_target }}</h2>
            <h2 class="upload-title">RUN RATE PS: {{ $run_rate_ps }}</h2>
            <h2 class="upload-title">ESTIMASI PS: {{ $estimasi_ps }}</h2>
            <h2 class="upload-title">ESTIMASI PS/TARGET: {{ $estimasi_ps_target }}</h2>
            <h2 class="upload-title"><br>KESIMPULAN: DIBUTUHKAN RUN RATE PS {{ $target_in_day }}</h2>
            <h2 class="upload-title">ESTIMASI PS HARI INI: {{ $estimasi_hari_ini }}</h2>
            <h2 class="upload-title">DEVIASI: {{ $deviasi }}</h2>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Pasang event listener tombol Send sekali saja
            console.log("Memasang event listener tombol Send");
            let isSending = false;

            $('#send').off('click').on('click', function(e) {
                e.preventDefault();

                // Mengambil teks dari kontainer yang diinginkan
                let rawHtml = $('.upload-container').html();

                // Membuat elemen sementara untuk parsing
                let tempDiv = document.createElement('div');
                tempDiv.innerHTML = rawHtml;

                // Mengambil semua elemen yang dianggap "baris"
                let lines = [];

                tempDiv.querySelectorAll('h2').forEach((el) => {
                    let text = el.textContent.replace(/\s+/g, ' ').trim();
                    if (!text) return;

                    // Menambahkan newline di awal baris tertentu
                    if (text.startsWith('NO. WILAYAH : ')) {
                        lines.push('\n' + text);
                    } else if (text.startsWith('NO. WILAYAH')) {
                        lines.push('\n' + text);
                    } else if (text.startsWith('TARGET PS JATIM 3:')) {
                        lines.push('\n' + text);
                        wilayahDone = true;
                    } else if (text.startsWith('KESIMPULAN:')) {
                        lines.push('\n' + text);
                    } else if (/^\d+\.\s/.test(text)) {
                        lines.push(text);
                    } else {
                        lines.push(text);
                    }
                });

                // Menggabungkan dengan newline
                let textToSend = lines.join('\n');

                if (!textToSend) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Teks kosong!',
                        text: 'Silakan pastikan ada data yang dapat dikirim!',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                if (isSending) {
                    console.log("Proses pengiriman sedang berjalan, harap tunggu...");
                    return;
                }
                isSending = true;

                const formData = new FormData();
                formData.append('text', textToSend);
                formData.append('_token', '{{ csrf_token() }}');

                fetch('{{ route('provikpro.send-to-telegram') }}', {
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
                                text: data.error ||
                                    'Terjadi kesalahan saat mengirim ke Telegram.',
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

            // Pasang event listener form upload
            $('#upload-form').on('submit', function(e) {
                // Logic untuk upload jika diperlukan
            });
        });
    </script>
@endpush

{{-- <script>
        $(document).ready(function() {
            if (!$.fn.DataTable.isDataTable('#tabel_provikpro')) {
                var dataUser = $('#tabel_provikpro').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('provikpro.list') }}", // URL to fetch data
                        type: "POST",
                        data: function(d) {
                            d.id_wilayah = $('#id_wilayah').val(); // Ensure these elements exist
                            d.id_endstate = $('#id_endstate').val();
                            d.id_provi_manja = $('#id_provi_manja').val();
                        }
                    },
                    columns: [{
                            data: "DT_RowIndex",
                            className: "text-center",
                            orderable: false,
                            searchable: false
                        },
                        {
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

                // Reload data when filters change
                $('#id_wilayah, #id_endstate, #id_provi_manja').on('change', function() {
                    dataUser.ajax.reload();
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
    </script> --}}
