@extends('layouts.template')

@section('content')
<div style="flex: 1; padding: 10px;">

    <!-- Container Isi Profil -->
    <div style="
        background-color: #fff; 
        padding: 50px; 
        border-radius: 19px; 
        box-shadow: 2px 2px 10px rgba(0,0,0,0.1);
        height: 500px;
        margin-top: -40px;
    ">
        <div style="
            border: 1px solid #EBEBEB;
            border-radius: 7px;
            padding: 20px;
            display: flex;
            align-items: center;">
                <img src="{{ asset('assets/Avatar.png') }}" alt="Profile Picture" 
                    style="width: 150px; height: 150px; border-radius: 50%; border: 2px solid #EBEBEB;">
                
                <div style="margin-left: 20px;">
                    <h3 style="font-size: 18px; font-weight: bold; color: #651313;">Nama</h3>
                    <p style="color: #84858C; background-color: #F5F5F6; padding: 5px 20px; border-radius: 6px; width: 300px; display: inline-block; margin-top: -5px;">Pandam Perdana Putra</p>
            
                    <h3 style="font-size: 18px; font-weight: bold; color: #651313; margin-top: -5px;">NIK</h3>
                    <p style="color: #84858C; background-color: #F5F5F6; padding: 5px 20px; border-radius: 6px; width: 300px; display: inline-block; margin-top: -5px;">00000000</p>
            
                    <h3 style="font-size: 18px; font-weight: bold; color: #651313; margin-top: -5px;">Telegram ID</h3>
                    <p style="color: #84858C; background-color: #F5F5F6; padding: 5px 20px; border-radius: 6px; width: 300px; display: inline-block; margin-top: -5px;">00000000</p>
                </div>
        </div>                

        <!-- Tombol Reset Password & Logout -->
        <div style="margin-top: 20px; display: flex; gap: 10px; width: 100%;">
                <button style="
                    flex: 1;
                    padding: 10px; 
                    background-color: #FFFFFF;
                    border: 2px solid #EBEBEB; 
                    border-radius: 5px; 
                    cursor: pointer;
                ">Reset Password</button>

                <button style="
                    flex: 1;
                    padding: 10px; 
                    background-color: #C8170D; 
                    color: white; 
                    border: none; 
                    border-radius: 5px; 
                    cursor: pointer;
                ">Log Out</button>
        </div>
    </div>

</div>
@endsection
