<!-- Navbar dengan hanya garis tiga (hamburger icon)  -->
<nav class="navbar navbar-expand navbar-light bg-transparent" style="margin-top: -10px;">
    <ul class="navbar-nav">
        <li class="nav-item">
            <!-- Ikon garis tiga (hamburger) -->
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>
</nav>

<section class="content-header">
    <div class="container-fluid custom-container">
        <div class="row justify-content-center align-items-center text-center">
            <div class="col-sm-12">
                <h1 class="breadcrumb-title">{{ $breadcrumb->title }}</h1>
            </div>
        </div>
    </div>
</section>

<style>
    .content-header {
        font-family: Poppins;
        color: #881A14;
    }

    .custom-container {
        background-color: #FFFFFF;
        padding: 20px;
        border-radius: 19px;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        margin-top: -10px;
        margin-bottom: 20px;
        display: flex;
        justify-content: flex-start;
        align-items: center;
        text-align: center;
        min-height: 80px;
    }

    .breadcrumb-title {
        margin: 0;
        font-weight: bolder; 
    }
</style>
