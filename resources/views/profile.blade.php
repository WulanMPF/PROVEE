@extends('layouts.template')

@section('content')
    <div style="flex: 1; padding: 10px;">

        {{-- Alert Success/Error --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Container Isi Profil -->
        <div
            style="
        background-color: #fff; 
        padding: 50px; 
        border-radius: 19px; 
        box-shadow: 2px 2px 10px rgba(0,0,0,0.1);
        height: auto;
        margin-top: -40px;
    ">
            <div
                style="
            border: 1px solid #EBEBEB;
            border-radius: 7px;
            padding: 20px;
            display: flex;
            align-items: center;">
                <img src="{{ asset('assets/Avatar_Profile.png') }}" alt="Profile Picture"
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
                    Reset Password</button>

                <form action="{{ route('logout') }}" method="GET" style="flex: 1;">
                    @csrf
                    <button type="submit"
                        style="width: 100%; padding: 10px; background-color: #C8170D; color: white; border: none; border-radius: 5px; cursor: pointer;">
                        Log Out</button>
                </form>
            </div>

            {{-- RESET PASSWORD GAISO --}}
            <!-- Modal Reset Password -->
            <div id="resetPasswordModal" class="modal"
                style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center;">
                <div style="background: #fff; padding: 40px; border-radius: 15px; width: 400px; text-align: center;">
                    <h2 style="font-size: 24px; font-weight: bold; color: #881A14; margin-bottom: 20px;">Reset Password</h2>
                    <form id="resetPasswordForm" action="{{ route('profile.reset-password', $user->id_user) }}" method="POST">
                        @csrf
                        <div style="text-align: left; margin-bottom: 10px;">
                            <label style="display: block; font-weight: 500; color: #84858C;">Password Lama</label>
                            <input type="password" name="old_password" placeholder="Masukkan Password Lama" required
                                style="width: 100%; padding: 10px; border-radius: 7px; background-color: #F5F5F6; outline: none; border: none;"
                                onfocus="this.style.border='2px solid #C8170D'" onblur="this.style.border='none'">
                        </div>
                        <div style="text-align: left; margin-bottom: 10px;">
                            <label style="display: block; font-weight: 500; color: #84858C;">Password Baru</label>
                            <input type="password" name="new_password" placeholder="Masukkan Password Baru" required
                                style="width: 100%; padding: 10px; border-radius: 7px; background-color: #F5F5F6; outline: none; border: none;"
                                onfocus="this.style.border='2px solid #C8170D'" onblur="this.style.border='none'">
                        </div>
                        <div style="text-align: left; margin-bottom: 10px;">
                            <label style="display: block; font-weight: 500; color: #84858C;">Konfirmasi Password Baru</label>
                            <input type="password" name="new_password_confirmation" placeholder="Konfirmasi Password Baru" required
                                style="width: 100%; padding: 10px; border-radius: 7px; background-color: #F5F5F6; outline: none; border: none;"
                                onfocus="this.style.border='2px solid #C8170D'" onblur="this.style.border='none'">
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

            {{-- RESET PASSWORD GAISO --}}
            <script>
                document.getElementById("resetPassword").addEventListener("click", function () {
                    document.getElementById("resetPasswordModal").style.display = "flex";
                });
            
                function closeModal() {
                    document.getElementById("resetPasswordModal").style.display = "none";
                }
            </script>                        

        </div>

    </div>
@endsection
