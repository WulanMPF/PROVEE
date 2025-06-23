<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .my-swal-popup {
            font-family: 'Poppins', sans-serif;
        }

        .my-confirm-button {
            background-color: #e74c3c !important;
            color: white !important;
            font-weight: bold;
            font-family: 'Poppins', sans-serif;
            border: none;
            border-radius: 6px;
            padding: 8px 20px;
        }

        .my-confirm-button:hover {
            background-color: #c0392b !important;
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen bg-gradient-to-b from-red-800 via-red-500 to-white">
    <div class="bg-white rounded-xl shadow-lg p-8 w-96 text-center relative">
        <img src="{{ asset('images/telkomakses_logo.png') }}" alt="Telkom Akses" class="mx-auto w-40 mb-4">
        <div class="mt-12">
            <h2 class="text-xl font-bold text-red-800">Provee</h2>

            <form action="{{ route('login-proses') }}" method="POST" class="mt-4">
                @csrf
                <div class="text-left">
                    <label class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" name="nik" placeholder="Masukkan username"
                        class="mt-1 w-full px-3 py-2 border rounded-lg bg-gray-100 focus:outline-none focus:ring-2 focus:ring-red-500">
                    @error('nik')
                        <small>{{ $message }}</small>
                    @enderror
                </div>

                <div class="text-left mt-4">
                    <label class="block text-sm font-medium text-gray-700">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" placeholder="Masukkan password"
                            class="mt-1 w-full px-3 py-2 border rounded-lg bg-gray-100 focus:outline-none focus:ring-2 focus:ring-red-500">
                        <span onclick="togglePassword('password', this)"
                            style="cursor: pointer; position: absolute; right: 10px; top: 50%; transform: translateY(-50%);">
                            <img src="{{ asset('assets/eye-closed.png') }}" alt="Show" id="password_eye"
                                style="width: 40px; height: 40px;">
                        </span>
                    </div>
                    @error('password')
                        <small>{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit"
                    class="mt-6 w-full bg-red-600 text-white py-2 rounded-lg font-semibold hover:bg-red-700 transition">
                    Log In
                </button>
            </form>
        </div>
    </div>
    <!-- /.login-box -->

    <script>
        function togglePassword(id, element) {
            const input = document.getElementById(id);
            const eyeIcon = element.querySelector('img');

            if (input.type === "password") {
                input.type = "text";
                eyeIcon.src = "{{ asset('assets/eye-open.png') }}"; // Change to eye open icon

            } else {
                input.type = "password";
                eyeIcon.src = "{{ asset('assets/eye-closed.png') }}"; // Change to eye closed icon
            }
        }
    </script>

    <!-- jQuery -->
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if ($message = Session::get('failed'))
        <script>
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Username atau Password Salah!",
                customClass: {
                    confirmButton: 'my-confirm-button',
                    popup: 'my-swal-popup'
                }
            });
        </script>
    @endif

    {{-- SUCCESS MESSAGE --}}
    {{-- @if ($message = Session::get('success'))
        <script>
            Swal.fire({
                title: "Anda Berhasil Log Out!",
                icon: "success",
                draggable: true
            });
        </script>
    @endif --}}
</body>

</html>
