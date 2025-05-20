@extends('layouts.template')

@section('content')
    <div style="flex: 1; padding: 10px;">

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
                <img src="{{ asset('assets/Icon_Profile.png') }}" alt="Profile Picture"
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
                <div style="background: #fff; padding: 20px; border-radius: 10px; width: 400px;">
                    <h3 style="margin-bottom: 15px;">Reset Password</h3>
                    <form action="{{ route('profile.reset', ['id' => $user->id_user]) }}" method="POST">
                        @csrf
                        {!! method_field('PUT') !!}
                        <label>Masukkan Password Baru</label>
                        <input type="text" name="password" required
                            style="width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 5px;">

                        <label>Konfirmasi Password Baru</label>
                        <input type="password" name="confirm_new_password" required
                            style="width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 5px;">

                        <div style="display: flex; justify-content: space-between;">
                            <button type="button" onclick="closeModal()"
                                style="background: gray; color: white; padding: 8px 15px; border: none; border-radius: 5px; cursor: pointer;">Cancel</button>
                            <button type="submit"
                                style="background: #C8170D; color: white; padding: 8px 15px; border: none; border-radius: 5px; cursor: pointer;">Save</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- RESET PASSWORD GAISO --}}
            <script>
                document.getElementById("resetPassword").addEventListener("click", function() {
                    document.getElementById("resetPasswordModal").style.display = "flex";
                });

                function closeModal() {
                    document.getElementById("resetPasswordModal").style.display = "none";
                }
            </script>

        </div>

    </div>
@endsection
