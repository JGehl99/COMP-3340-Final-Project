<nav class="sticky-top navbar navbar-expand-md background text-color shadow">
    <div class="container-fluid">
        <a class="navbar-brand d-flex" href="index.php">
            <img src="../static/icon.svg" alt="OldChicken Icon" class="navbar_icon">
        </a>
        <button class="navbar-toggler border border-1" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
            <img id="navbar_icon" class="navbar-toggler-icon" src="../static/hamburger_black.svg"
                 alt="Hamburger Menu Icon">
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link link-color" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-color" href="products.php">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-color" href="gallery.php">Gallery</a>
                </li>
            </ul>
            <form class="d-flex" action="products.php" method="get">
                <input class="form-control mr-3" id="search" name="search" type="search" placeholder="Search"
                       aria-label="Search">
                <button class="btn btn-primary text-nowrap" type="submit">Search</button>
            </form>
            <hr class="dropdown-divider mt-sm-3 mt-md-0 d-md-none d-lg-none d-lx-none d-xxl-none">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <?php if (!isLoggedIn()) { ?>
                    <li class="nav-item">
                        <a class="nav-link link-color" aria-current="page" href="login.php">Log In</a>
                    </li>
                <?php } else { ?>


                    <!-- This list only shows when > sm breakpoint, shows on navbar -->
                    <li class="nav-item dropdown d-none d-sm-none d-md-block d-lg-block d-lx-block d-xxl-block background">
                        <a class="nav-link link-color dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            My Account
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end background" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item link-color" href="account_homepage.php">Account Homepage</a>
                            </li>
                            <li><a class="dropdown-item link-color" href="cart.php">Cart</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item link-color" href="logout.php">Log Out</a></li>
                        </ul>
                    </li>
                    <!-- This list only shows in the collapsed navbar menu when <= sm breakpoint -->
                    <li class="nav-item dropdown d-block d-sm-block d-md-none background text-color">
                        <a class="nav-link dropdown-toggle link-color" href="#" id="navbarDropdownSm" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            My Account
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end background border-0"
                            aria-labelledby="navbarDropdownSm">
                            <li><a class="dropdown-item link-color" href="account_homepage.php">Account Homepage</a>
                            </li>
                            <li><a class="dropdown-item link-color" href="cart.php">Cart</a></li>
                            <li><a class="dropdown-item link-color" href="logout.php">Log Out</a></li>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
<button type="button" class="btn btn-color rounded-circle  text-nowrap" id="btn-btt" style="z-index: 2;">
    <img src="../static/arrow_upward_white.svg" alt="arrowUP" id="btn-btt-img">
</button>

<script src="../js/scrollButton.js"></script>