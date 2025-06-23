@extends('layouts.template')

@section('content')
    <div style="flex: 1; padding: 10px; font-family: 'Poppins', sans-serif;">

        <!-- Container Isi Profil -->
        <div
            style="background-color: #fff; padding: 50px; border-radius: 19px; box-shadow: 2px 2px 10px rgba(0,0,0,0.1); height: auto; margin-top: -40px;">
            <div style="border: 1px solid #EBEBEB; border-radius: 7px; padding: 20px; display: flex; align-items: center;">
                <img src="{{ asset('assets/Avatar.png') }}" alt="Profile Picture"
                    style="width: 150px; height: 150px; border-radius: 50%; border: 2px solid #EBEBEB;">

                <div style="margin-left: 20px;">
                    <h3 style="font-size: 18px; font-weight: bold; color: #651313;">Nama</h3>
                    <p
                        style="color: #84858C; background-color: #F5F5F6; padding: 5px 10px; border-radius: 6px; width: 300px; display: inline-block; margin-top: -5px;">
                        {{ $user->nama ?? 'Nama tidak tersedia' }}
                    </p>

                    <h3 style="font-size: 18px; font-weight: bold; color: #651313; margin-top: -5px;">NIK</h3>
                    <p
                        style="color: #84858C; background-color: #F5F5F6; padding: 5px 10px; border-radius: 6px; width: 300px; display: inline-block; margin-top: -5px;">
                        {{ $user->nik ?? 'NIK tidak tersedia' }}
                    </p>

                    <h3 style="font-size: 18px; font-weight: bold; color: #651313; margin-top: -5px;">Telegram ID</h3>
                    <p
                        style="color: #84858C; background-color: #F5F5F6; padding: 5px 10px; border-radius: 6px; width: 300px; display: inline-block; margin-top: -5px;">
                        {{ $user->tele_id ?? 'Telegram ID tidak tersedia' }}
                    </p>
                </div>
            </div>

            <!-- Tombol Reset Password & Logout -->
            <div style="margin-top: 20px; display: flex; gap: 10px; width: 100%;">
                <button id="resetPassword"
                    style="flex: 1; padding: 10px; background-color: #FFFFFF; border: 2px solid #EBEBEB; border-radius: 5px; cursor: pointer;">
                    Reset Password
                </button>

                <form action="{{ route('logout') }}" method="GET" style="flex: 1;">
                    @csrf
                    <button type="submit"
                        style="width: 100%; padding: 10px; background-color: #C8170D; color: white; border: none; border-radius: 5px; cursor: pointer;">
                        Log Out
                    </button>
                </form>
            </div>

            <!-- Modal Reset Password -->
            <div id="resetPasswordModal" class="modal"
                style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center;">
                <div style="background: #fff; padding: 40px; border-radius: 15px; width: 400px; text-align: center;">
                    <h2 style="font-size: 24px; font-weight: bold; color: #881A14; margin-bottom: 20px;">Reset Password</h2>
                    <form id="resetPasswordForm" action="{{ route('profile.reset', ['id' => $user->id_user]) }}"
                        method="POST">
                        @csrf
                        <div style="text-align: left; margin-bottom: 10px;">
                            <label style="display: block; font-weight: 500; color: #84858C;">Password Lama</label>
                            <div style="position: relative;">
                                <input type="password" name="old_password" id="old_password"
                                    placeholder="Masukkan Password Lama" required
                                    style="width: 100%; padding: 10px; border-radius: 7px; background-color: #F5F5F6; outline: none; border: none;"
                                    onfocus="this.style.border='2px solid #C8170D'" onblur="this.style.border='none'">
                                <span onclick="togglePassword('old_password', this)"
                                    style="cursor: pointer; position: absolute; right: 10px; top: 50%; transform: translateY(-50%);">
                                    <img src="{{ asset('assets/eye-closed.png') }}" alt="Show" id="old_password_eye"
                                        style="width: 40px; height: 40px;">
                                </span>
                            </div>
                        </div>
                        <div style="text-align: left; margin-bottom: 10px;">
                            <label style="display: block; font-weight: 500; color: #84858C;">Password Baru</label>
                            <div style="position: relative;">
                                <input type="password" name="new_password" id="new_password"
                                    placeholder="Masukkan Password Baru" required
                                    style="width: 100%; padding: 10px; border-radius: 7px; background-color: #F5F5F6; outline: none; border: none;"
                                    onfocus="this.style.border='2px solid #C8170D'" onblur="this.style.border='none'">
                                <span onclick="togglePassword('new_password', this)"
                                    style="cursor: pointer; position: absolute; right: 10px; top: 50%; transform: translateY(-50%);">
                                    <img src="{{ asset('assets/eye-closed.png') }}" alt="Show" id="new_password_eye"
                                        style="width: 40px; height: 40px;">
                                </span>
                            </div>
                        </div>
                        <div style="text-align: left; margin-bottom: 10px;">
                            <label style="display: block; font-weight: 500; color: #84858C;">Konfirmasi Password
                                Baru</label>
                            <div style="position: relative;">
                                <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                                    placeholder="Konfirmasi Password Baru" required
                                    style="width: 100%; padding: 10px; border-radius: 7px; background-color: #F5F5F6; outline: none; border: none;"
                                    onfocus="this.style.border='2px solid #C8170D'" onblur="this.style.border='none'">
                                <span onclick="togglePassword('new_password_confirmation', this)"
                                    style="cursor: pointer; position: absolute; right: 10px; top: 50%; transform: translateY(-50%);">
                                    <img src="{{ asset('assets/eye-closed.png') }}" alt="Show"
                                        id="new_password_confirmation_eye" style="width: 40px; height: 40px;">
                                </span>
                            </div>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-top: 20px;">
                            <button type="button" onclick="closeModal()"
                                style="flex: 1; padding: 10px; border: 1px solid #ccc; border-radius: 7px; background-color: white; cursor: pointer;">
                                Cancel
                            </button>
                            <button type="submit"
                                style="flex: 1; padding: 10px; border-radius: 7px; background-color: #C8170D; color: white; border: none; cursor: pointer; margin-left: 10px;">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('css')
    <style>
        .custom-ok-button {
            background-color: #C8170D !important;
            color: white !important;
            font-family: 'Poppins', sans-serif;
            font-weight: bold;
            border-radius: 6px !important;
            padding: 8px 16px !important;
            border: none !important;
        }

        .custom-ok-button:hover {
            background-color: #C8170D !important;
        }
    </style>
@endpush


@push('js')
    <script>
        document.getElementById("resetPassword").addEventListener("click", function() {
            document.getElementById("resetPasswordModal").style.display = "flex";
        });

        function closeModal() {
            document.getElementById("resetPasswordModal").style.display = "none";
        }

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


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('success'))
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'custom-ok-button'
                }
            });
        @endif

        @if (session('error'))
            Swal.fire({
                title: 'Error!',
                text: '{{ session('error') }}',
                icon: 'error',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'custom-ok-button'
                }
            });
        @endif
    </script>
@endpush
