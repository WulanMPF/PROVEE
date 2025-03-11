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
