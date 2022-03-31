<!doctype html>
<html lang="en">

<head>
    <?php
    $title = 'Gallery';
    include('headers.php');
    ?>
</head>

<body class="bg-white">
<?php include('navbar.php'); ?>
<div class="container flex pt-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-8 col-md-6 col-lg-4 col-xl-3">
            <div class="card bg-light text-dark rounded-5">
                <div class="card-body p-3 text-center">
                    <h1>Gallery</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row d-flex justify-content-center align-items-center h-100 m-3">
    <div class="col-11 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4 mt-5">
        <div class="card h-100 p-3 bg-light text-dark rounded-5 gallery-card">
            <div class="card-body">
                <h5 class="card-title">Custom PC Build #1</h5>
                <img class="rounded img-fluid" src="../media/custom_build_1.jpeg" alt="Custom PC #1">
                <h5 class="card-title"><br>Parts List:</h5>
                <h6 class="card-subtitle text-success my-2">
                    CPU - AMD Ryzen 5 3600<br>
                    GPU - EVGA Geforce GTX 1070</h6>
            </div>
        </div>
    </div>
    <div class="col-11 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4 mt-5">
        <div class="card h-100 p-3 bg-light text-dark rounded-5 gallery-card">
            <div class="card-body">
                <h5 class="card-title">Custom PC Build #2</h5>
                <img class="rounded img-fluid" src="../media/custom_build_2.jpg" alt="Custom PC #2">
                <h5 class="card-title"><br>Parts List:</h5>
                <h6 class="card-subtitle text-success my-2">
                    CPU - AMD Ryzen Threadripper 3970X<br>
                    GPU - AMD Radeon RX 6700 XT</h6>
            </div>
        </div>
    </div>
    <div class="col-11 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4 mt-5">
        <div class="card h-100 p-3 bg-light text-dark rounded-5 gallery-card">
            <div class="card-body">
                <h5 class="card-title">Custom PC Build #3</h5>
                <img class="rounded img-fluid" src="../media/custom_build_3.jpeg" alt="Custom PC #3">
                <h5 class="card-title"><br>Parts List:</h5>
                <h6 class="card-subtitle text-success my-2">
                    CPU - Intel Core i9-9900KF<br>
                    GPU - EVGA Geforce GTX 1080 TI</h6>
            </div>
        </div>
    </div>
    <div class="col-11 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4 mt-5">
        <div class="card h-100 p-3 bg-light text-dark rounded-5 gallery-card">
            <div class="card-body">
                <h5 class="card-title">Custom PC Build #4</h5>
                <img class="rounded img-fluid" src="../media/custom_build_4.jpeg" alt="Custom PC #4">
                <h5 class="card-title"><br>Parts List:</h5>
                <h6 class="card-subtitle text-success my-2">
                    CPU - Intel Core i5-9600K<br>
                    GPU - AMD Radeon RX 5700 XT</h6>
            </div>
        </div>
    </div>
    <div class="col-11 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4 mt-5">
        <div class="card h-100 p-3 bg-light text-dark rounded-5 gallery-card">
            <div class="card-body">
                <h5 class="card-title">Custom PC Build #5</h5>
                <img class="rounded img-fluid" src="../media/custom_build_5.png" alt="Custom PC #5">
                <h5 class="card-title"><br>Parts List:</h5>
                <h6 class="card-subtitle text-success my-2">
                    CPU - AMD Ryzen 7 5800X<br>
                    GPU - EVGA Geforce RTX 2080</h6>
            </div>
        </div>
    </div>
    <div class="col-11 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4 mt-5">
        <div class="card h-100 p-3 bg-light text-dark rounded-5 gallery-card">
            <div class="card-body">
                <h5 class="card-title">Custom PC Build #6</h5>
                <img class="rounded img-fluid" src="../media/custom_build_6.jpg" alt="Custom PC #6">
                <h5 class="card-title"><br>Parts List:</h5>
                <h6 class="card-subtitle text-success my-2">
                    CPU - AMD Ryzen 5 3600<br>
                    GPU - MSI Geforce GTX 1660 Super</h6>
            </div>
        </div>
    </div>
</div>
<br>

<?php include('footer.php'); ?>
</body>

</html>