<!-- Footer -->
<footer class="text-center background">
    <div class="container p-4 mt-5">
        <section class="">
            <div class="row text-color">
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">About Us</h5>
                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="about_us.php#joshua_gehl" class="link-color">Joshua Gehl</a>
                        </li>
                        <li>
                            <a href="about_us.php#brady_malott" class="link-color">Brady Malott</a>
                        </li>
                        <li>
                            <a href="about_us.php#jarrett_jackson" class="link-color">Jarrett Jackson</a>
                        </li>
                        <li>
                            <a href="about_us.php#jonathan_fehr" class="link-color">Jonathan Fehr</a>
                        </li>
                        <li>
                            <a href="about_us.php#shady_gerges" class="link-color">Shady Gerges</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Customer Support</h5>
                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="faq.php" class="link-color">F.A.Q.</a>
                        </li>
                        <li>
                            <a href="shipping_returns.php" class="link-color">Shipping & Returns</a>
                        </li>
                        <li>
                            <a href="contact_us.php" class="link-color">Contact Us</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Sales</h5>
                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="products.php" class="link-color">Products</a>
                        </li>
                        <li>
                            <a href="gallery.php" class="link-color">Gallery</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">My Account</h5>

                    <ul class="list-unstyled mb-0">
                        <?php
                        if (!isLoggedIn()) { ?>
                            <li>
                                <a href="login.php" class="link-color">Log In</a>
                            </li>
                        <?php } else { ?>
                            <li>
                                <a href="account_homepage.php" class="link-color">My Account</a>
                            </li>
                            <li>
                                <a href="cart.php" class="link-color">Cart</a>
                            </li>
                            <li>
                                <a href="logout.php" class="link-color">Log Out</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </section>
    </div>
    <div class="text-center p-3 background d-flex justify-content-start">
        <form class="form-check form-switch" id="theme-form">
            <input type="checkbox" class="form-check-input" id="darkSwitch" onclick="setTheme()">
            <label class="form-check-label" for="darkSwitch">
                <img id="dark_mode_icon" src="../static/light_icon.svg" alt="Icon for light mode">
            </label>
        </form>
    </div>
</footer>

<!--For Dark-mode slider-->
<script src="../js/dark-mode.js"></script>