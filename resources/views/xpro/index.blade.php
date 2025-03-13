@extends('layouts.template')

@section('content')
    <div style="flex: 1; padding: 10px;">
        <div class="upload-container">
            <h2 class="upload-title">Upload File</h2>
            <form action="{{ route('xpro.store') }}" method="POST" enctype="multipart/form-data" class="upload-form">
                @csrf
                <input type="file" name="file" accept=".csv" required>
            </form>

            <h2 class="pivot-title">Pivot Table</h2>
            <table class="table table-bordered table-striped table-hover table-sm" id="tabel_xpro">
                <thead>
                    <tr>
                        <th>WILAYAH</th>
                        <th>RE HI</th>
                        <th>PI HI</th>
                        <th>PS HI</th>
                        <th>ACCOMP</th>
                        <th>PS/RE HI</th>
                        <th>PS/PI HI</th>
                        <th>RE TOT</th>
                        <th>PI TOT</th>
                        <th>PS TOT</th>
                        <th>PS/RE TOT</th>
                        <th>PS/PI TOT</th>
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
            height: 500px;
            margin-top: -40px;
        }

        .upload-title, .pivot-title {
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
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            if (!$.fn.DataTable.isDataTable('#tabel_xpro')) {
                var dataUser = $('#tabel_xpro').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        "url": "{{ url('xpro/list') }}",
                        "type": "POST",
                        "data": function(d) {
                            d.id_wilayah = $('#id_wilayah').val();
                        }
                    },
                    columns: [
                        { data: "wilayah.nama_wilayah", orderable: true, searchable: true },
                        { data: "re_hi", orderable: true, searchable: true },
                        { data: "pi_hi", orderable: false, searchable: false },
                        { data: "ps_hi", orderable: false, searchable: false },
                        { data: "accomp", orderable: false, searchable: false },
                        { data: "ps_re_hi", orderable: false, searchable: false },
                        { data: "ps_pi_hi", orderable: false, searchable: false },
                        { data: "re_tot", orderable: false, searchable: false },
                        { data: "pi_tot", orderable: false, searchable: false },
                        { data: "ps_tot", orderable: false, searchable: false },
                        { data: "ps_re_tot", orderable: false, searchable: false },
                        { data: "ps_pi_tot", orderable: false, searchable: false }
                    ]
                });

                $('#id_wilayah').on('change', function() {
                    dataWilayah.ajax.reload();
                });
            }
        });
    </script>
@endpush