<!-- Footer -->
<footer class="text-center bg-light">
    <div class="container p-4">
        <section class="">
            <div class="row text-dark">
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">About Us</h5>
                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="../content/about_us.php#joshua_gehl" class="link-dark">Joshua Gehl</a>
                        </li>
                        <li>
                            <a href="../content/about_us.php#jarrett_jackson" class="link-dark">Jarrett Jackson</a>
                        </li>
                        <li>
                            <a href="../content/about_us.php#brady_malott" class="link-dark">Brady Malott</a>
                        </li>
                        <li>
                            <a href="../content/about_us.php#jonathan_fehr" class="link-dark">Jonathan Fehr</a>
                        </li>
                        <li>
                            <a href="../content/about_us.php#shady_gerges" class="link-dark">Shady Gerges</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Customer Support</h5>
                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="../content/faq.php" class="link-dark">F.A.Q.</a>
                        </li>
                        <li>
                            <a href="../content/shipping_returns.php" class="link-dark">Shipping & Returns</a>
                        </li>
                        <li>
                            <a href="../content/contact_us.php" class="link-dark">Contact Us</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Sales</h5>
                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="../content/products.php" class="link-dark">Products</a>
                        </li>
                        <li>
                            <a href="../content/gallery.php" class="link-dark">Gallery</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">My Account</h5>

                    <ul class="list-unstyled mb-0">
                        <?php
                            if (!isLoggedIn()) { ?>
                                <li>
                                    <a href="../content/login.php" class="link-dark">Log In</a>
                                </li>
                            <?php } else { ?>
                                <li>
                                    <a href="../content/#" class="link-dark">My Account</a>
                                </li>
                                <li>
                                    <a href="../content/cart.php" class="link-dark">Cart</a>
                                </li>
                                <li>
                                    <a href="../content/logout.php" class="link-dark">Log Out</a>
                                </li>
                        <?php }?>
                    </ul>
                </div>
            </div>
        </section>
    </div>
    <div class="text-center p-3 bg-light d-flex justify-content-end">
        <div class="form-check form-switch">
            <input type="checkbox" class="form-check-input" id="darkSwitch">
            <label class="form-check-label" for="darkSwitch">
                <img id="dark_mode_icon" src="../static/light_icon.svg" alt="Icon for light mode">
            </label>
        </div>
    </div>
</footer>

<!--For Dark-mode slider-->
<script src="../js/dark-mode.js"></script>