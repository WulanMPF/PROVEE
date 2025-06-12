@extends('layouts.template')

@section('content')
    <div style="flex: 1; padding: 10px;">
        <div class="upload-container">
            <div class="table-responsive-wrapper">
                <table class="table table-bordered table-hover table-sm" id="tabel_endstate">
                    <thead>
                        <tr>
                            <th style="vertical-align: middle; background-color: #0563c1; color: white">WILAYAH</th>
                            <th style="vertical-align: middle; background-color: #0563c1; color: white">PI HI</th>
                            <th style="vertical-align: middle; background-color: #0563c1; color: white">PS HI</th>
                            <th style="vertical-align: middle; background-color: #0563c1; color: white">ACCOMP</th>
                            <th style="vertical-align: middle; background-color: #0563c1; color: white">PS/PI HI</th>
                            <th style="vertical-align: middle; background-color: #0563c1; color: white">PI TOT</th>
                            <th style="vertical-align: middle; background-color: #0563c1; color: white">PS TOT</th>
                            <th style="vertical-align: middle; background-color: #0563c1; color: white">TARGET TOT</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($endstates as $endstate)
                            <tr>
                                <td>{{ $endstates->wilayah->nama_wilayah }}</td>
                                <td>{{ $endstates->pi_hi }}</td>
                                <td>{{ $endstates->ps_hi }}</td>
                                <td>{{ $endstates->accomp }}</td>
                                <td>{{ $endstates->pi_hi != 0 ? round(($endstates->ps_hi / $endstates->pi_hi) * 100, 2) . '%' : '100%' }}</td>
                                <td>{{ $endstates->pi_tot }}</td>
                                <td>{{ $endstates->ps_tot }}</td>
                                <td>
                                    <input type="number" class="form-control target-input" data-id="{{ $endstates->id_endstate }}" value="{{ $endstates->target_tot }}">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <button id="save-targets" class="btn btn-primary">Save Changes</button>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#save-targets').click(function() {
                let targets = [];
                $('.target-input').each(function() {
                    targets.push({
                        id: $(this).data('id'),
                        target_tot: $(this).val()
                    });
                });

                $.ajax({
                    url: "{{ route('endstate.update') }}",
                    method: "PUT",
                    data: {
                        targets: targets,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Target totals updated successfully.',
                        });
                    },
                    error: function(response) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Failed to update targets.',
                        });
                    }
                });
            });
        });
    </script>
@endpush