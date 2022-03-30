<!doctype html>
<html lang="en">

<head>
    <?php
    $title = 'Index';
    include('../content/headers.php');
    ?>
</head>

<body class="bg-white">
<?php include('../content/navbar.php'); ?>
<div class="bg-white" style="height:100vh">
    <div class="container col-12">
        <div class="row d-flex justify-content-center mt-5">
            <div class="rounded rounded-3 col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                <div id="carousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner rounded rounded-3">
                        <div class="carousel-item active" data-bs-interval="5000">
                            <img src="https://picsum.photos/seed/<?php echo rand(0, 999999) ?>/800/450"
                                 class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item" data-bs-interval="5000">
                            <img src="https://picsum.photos/seed/<?php echo rand(0, 999999) ?>/800/450"
                                 class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item" data-bs-interval="5000">
                            <img src="https://picsum.photos/seed/<?php echo rand(0, 999999) ?>/800/450"
                                 class="d-block w-100" alt="...">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('../content/footer.php'); ?>
</body>
</html>