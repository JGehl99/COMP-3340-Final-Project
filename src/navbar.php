<!doctype html>
<html lang="en">
<head>

    <!-- Ensure $title isn't undefined, if undefined: initialize to empty string-->
    <title> <?php if (empty($title)) $title = ""; echo $title; ?> </title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
            crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet"  integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" crossorigin="anonymous">
</head>

<body>
<nav class="navbar navbar-expand-md navbar-light bg-light border" style="margin-bottom: 10px">
    <a href="https://github.com/jgehl99">
        <img src="../public_html/static/icon.svg" alt="Image of Author"
             width="40px" height="40px" style="margin-right: 5px">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="https://gehlj.myweb.cs.uwindsor.ca/">Home</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="https://gehlj.myweb.cs.uwindsor.ca/COMP-2707-W22">Products</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="https://gehlj.myweb.cs.uwindsor.ca/COMP-3340-W22/">About Us</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="https://gehlj.myweb.cs.uwindsor.ca/COMP-3340-W22/">Contact Us</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="https://gehlj.myweb.cs.uwindsor.ca/COMP-3340-W22/">Gallery</a>
            </li>

            <li class="nav-item" style="float:left">
                <a class="nav-link" href="https://gehlj.myweb.cs.uwindsor.ca/COMP-3340-W22/">Log in</a>
            </li>
        </ul>
    </div>
</nav>
</body>
</html>