<!doctype html>
<html lang="en">

<head>
    <?php
    $title = 'Dataset - Global Average Temperatures';
    include('headers.php');
    ?>
    <meta name="title" content="Climate Action">
    <meta name="description"
          content="Here at OldChicken we are taking the proper steps to ensure our operation doesn't contribute to the growing climate problem.">
    <meta name="keywords"
          content="old chicken,e-commerce,climate change,global temperatures,environmental,action,eco-friendly">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
</head>

<body class="page-background">
<?php include('navbar.php'); ?>
<!--Dataset - Global and Hemispheric Monthly Means and Zonal Annual Means - Zonal annual means-->
<!--https://data.giss.nasa.gov/gistemp/-->
<!--Mean Temperature-->
<!--https://earthobservatory.nasa.gov/world-of-change/DecadalTemp = 14°-->

<div class="container page-background pt-5 min_height">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-11 col-lg-10 col-xl-8 col-xxl-8">
            <div class="card background text-color rounded-5 shadow">
                <div class="card-body p-3 text-center">
                    <h1>Global Average Temperatures 1880-2020</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-11 col-lg-10 col-xl-8 col-xxl-8 mt-5">
            <div class="card h-100 p-3 background text-color rounded-5 shadow">
                <canvas id="chart"></canvas>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-11 col-lg-10 col-xl-8 col-xxl-8 mt-5">
            <div class="card h-100 p-3 background text-color rounded-5 shadow">
                <h4>The Global Average Temperature has risen greatly over the last 140 years. Here at OldChicken we are
                    taking the proper steps to
                    ensure our operation doesn't contribute to the growing climate problem. Below are some steps you can
                    take to limit your carbon footprint.
                </h4>
                <table class="table text-color">
                    <thead>
                    <tr>
                        <th scope="col">Solution</th>
                        <th scope="col">Explanation</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Don't buy from us</td>
                        <td>Buying from us costs electricity; here are some better options. Plant some trees, walk to
                            work, build a Nuclear-fusion reactor.
                        </td>
                    </tr>
                    <tr>
                        <td>Recycle your computer</td>
                        <td>Your computer is made up of rare metals, materials, and lots of plastic. Do us all a favour
                            and recycle it so it's materials can be reused.
                        </td>
                    </tr>
                    <tr>
                        <td>Stop paying your power bill</td>
                        <td>Unless you live in Ontario, chances are your power is generated mostly by coal so either
                            move or live like a caveman. ¯\_(ツ)_/¯
                        </td>
                    </tr>

                    <tr>
                        <td>Incite an insurrection</td>
                        <td>Our governments aren't doing anything to combat climate change, march your way down to your
                            nations capital and take over
                            (It won't end badly).
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
<!--JS for Chart.js-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<!--Creates the Chart using the global_temps.csv file-->
<script src="../js/dataset.js"></script>
</body>

</html>





