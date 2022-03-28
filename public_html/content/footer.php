<!doctype html>
<html lang="en">


<!-- Footer -->
<footer class="bg-link text-center bg-light">
    <div class="container p-4">
        <section class="">
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">About Us</h5>
                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="../content/about_us.php#joshua_gehl" class="text-black-50">Joshua Gehl</a>
                        </li>
                        <li>
                            <a href="../content/about_us.php#jarrett_jackson" class="text-black-50">Jarrett Jackson</a>
                        </li>
                        <li>
                            <a href="../content/about_us.php#brady_malott" class="text-black-50">Brady Malott</a>
                        </li>
                        <li>
                            <a href="../content/about_us.php#jonathan_fehr" class="text-black-50">Jonathan Fehr</a>
                        </li>
                        <li>
                            <a href="../content/about_us.php#shady_gerges" class="text-black-50">Shady Gerges</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Customer Support</h5>
                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="../content/faq.php" class="text-black-50">F.A.Q.</a>
                        </li>
                        <li>
                            <a href="../content/shipping_returns.php" class="text-black-50">Shipping & Returns</a>
                        </li>
                        <li>
                            <a href="../content/contact_us.php" class="text-black-50">Contact Us</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Sales</h5>
                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="../content/products.php" class="text-black-50">Products</a>
                        </li>
                        <li>
                            <a href="../content/gallery.php" class="text-black-50">Gallery</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">My Account</h5>

                    <ul class="list-unstyled mb-0">
                        <?php
                            if (!isLoggedIn()) { ?>
                                <li>
                                    <a href="../content/login.php" class="text-black-50">Log In</a>
                                </li>
                            <?php } else { ?>
                                <li>
                                    <a href="../content/#" class="text-black-50">My Account</a>
                                </li>
                                <li>
                                    <a href="../content/cart.php" class="text-black-50">Cart</a>
                                </li>
                                <li>
                                    <a href="../content/logout.php" class="text-black-50">Log Out</a>
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
                <img src="../static/light_icon.svg" alt="Icon for light mode">
            </label>
        </div>
    </div>
</footer>

<!--For Dark-mode slider-->
<script src="../js/dark-mode.js"></script>