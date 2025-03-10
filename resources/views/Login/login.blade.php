<!DOCTYPE html>
<html lang="id">
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
    </style>
</head>
<body class="flex items-center justify-center min-h-screen bg-gradient-to-b from-red-800 via-red-700 to-white">
    <div class="bg-white rounded-xl shadow-lg p-8 w-96 text-center relative">
        <img src="{{ asset('images/telkomakses_logo.png') }}" alt="Telkom Akses" class="mx-auto w-40 mb-4">
        <div class="mt-5">
            <h2 class="text-xl font-bold text-red-800">Provee</h2>

            <form action="{{ route('login') }}" method="POST" class="mt-4">
                @csrf
                <div class="text-left">
                    <label class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" name="username" placeholder="Masukkan username"
                        class="mt-1 w-full px-3 py-2 border rounded-lg bg-gray-100 focus:outline-none focus:ring-2 focus:ring-red-500">
                </div>

                <div class="text-left mt-4">
                    <label class="block text-sm font-medium text-gray-700">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" placeholder="Masukkan password"
                            class="mt-1 w-full px-3 py-2 border rounded-lg bg-gray-100 focus:outline-none focus:ring-2 focus:ring-red-500">
                        <button type="button" id="togglePassword" class="absolute inset-y-0 right-3 flex items-center">
                            <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10 3C5.455 3 1.733 6.23.458 10c1.275 3.77 5.997 7 9.542 7s8.267-3.23 9.542-7c-1.275-3.77-5.997-7-9.542-7zm0 12c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm0-6c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2z"/>
                            </svg>
                            <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 hidden" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M1.293 1.293a1 1 0 011.414 0L18.707 17.293a1 1 0 01-1.414 1.414L14.34 16.16A8.956 8.956 0 0110 17c-3.545 0-7.267-3.23-8.542-7a9.3 9.3 0 012.383-3.922L1.293 2.707a1 1 0 010-1.414zM10 3c3.545 0 7.267 3.23 8.542 7a9.293 9.293 0 01-2.382 3.922l-2.057-2.058A3.992 3.992 0 0014 10c0-2.21-1.79-4-4-4a3.992 3.992 0 00-2.864 1.058L5.082 4.539A9.295 9.295 0 0110 3zm0 6c1.104 0 2 .896 2 2s-.896 2-2 2-2-.896-2-2 .896-2 2-2z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <button type="submit"
                        class="mt-6 w-full bg-red-600 text-white py-2 rounded-lg font-semibold hover:bg-red-700 transition">
                    Log In
                </button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const eyeOpen = document.getElementById('eyeOpen');
            const eyeClosed = document.getElementById('eyeClosed');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeClosed.classList.add('hidden');
                eyeOpen.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                eyeClosed.classList.remove('hidden');
                eyeOpen.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
