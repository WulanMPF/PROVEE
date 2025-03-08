<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>

    <!-- Google Font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body style="margin: 0; padding: 0; font-family: 'Poppins', sans-serif; background-color: #E5E5E8; display: flex;">

    <!-- Sidebar -->
    <div class="sidebar-container" style="
        width: 90px; 
        height: 90vh; 
        background-color: #FFFFFF; 
        border-radius: 19px; 
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1); 
        display: flex; 
        flex-direction: column; 
        align-items: center; 
        padding-top: 20px; 
        position: fixed; 
        left: 30px; 
        top: 25px;
        justify-content: space-between;
    ">
        <ul style="list-style: none; padding: 0; margin: 0; width: 100%; display: flex; flex-direction: column; align-items: center;">
            <li style="margin-bottom: 30px;">
                <a href="#"><img src="{{ asset('assets/Icon_SideBar.png') }}" alt="Sidebar" style="width: 30px;"></a>
            </li>
            <li style="margin-bottom: 15px;">
                <a href="#"><img src="{{ asset('assets/Icon_XPRO.png') }}" alt="X" style="width: 55px;"></a>
            </li>
            <li style="margin-bottom: 15px;">
                <a href="#"><img src="{{ asset('assets/Icon_ORBIT.png') }}" alt="O" style="width: 55px;"></a>
            </li>
            <li style="margin-bottom: 15px;">
                <a href="#"><img src="{{ asset('assets/Icon_ENDSTATE.png') }}" alt="E" style="width: 55px;"></a>
            </li>
            <li style="margin-bottom: 15px;">
                <a href="#"><img src="{{ asset('assets/Icon_PIVOTENDSTATE.png') }}" alt="PE" style="width: 55px;"></a>
            </li>
            <li style="margin-bottom: 15px;">
                <a href="#"><img src="{{ asset('assets/Icon_PROVIMANJA.png') }}" alt="PM" style="width: 55px;"></a>
            </li>
            <li style="margin-bottom: 15px;">
                <a href="#"><img src="{{ asset('assets/Icon_PROVIKPRO.png') }}" alt="PK" style="width: 55px;"></a>
            </li>
        </ul>

        <!-- Garis Hitam Sebelum Icon Profile -->
        <div style="width: 80%; height: 2px; background-color: black; margin: 90px 0 15px 0;"></div>

        <!-- Profile Icon -->
        <div style="margin-bottom: 20px;">
            <a href="{{ route('profile') }}" class="active" style="
                display: flex; 
                justify-content: center; 
                align-items: center; 
                width: 50px; 
                height: 50px; 
                background-color: #C8170D; 
                border-radius: 10px;
            ">
                <img src="{{ asset('assets/Icon_Profile.png') }}" alt="Profile" style="width: 45px; filter: invert(1);">
            </a>
        </div>
    </div>

    <!-- Konten Halaman -->
    <div style="margin-left: 100px; margin-top: -15px; flex: 1; padding: 20px;">
        @yield('content')
    </div>

</body>
</html>