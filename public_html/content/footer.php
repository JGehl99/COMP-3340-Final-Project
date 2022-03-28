<!doctype html>
<html lang="en">


<!-- Footer -->
<footer class="bg-link text-center ">
    <div class="container p-4">
        <section class="">
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">About Us</h5>
                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="../content/about_us.php#joshua_gehl" id="josh" class="text-50">Joshua Gehl</a>
                        </li>
                        <li>
                            <a href="../content/about_us.php#jarrett_jackson" id="jarr" class="text-50">Jarrett Jackson</a>
                        </li>
                        <li>
                            <a href="../content/about_us.php#brady_malott" id="brady" class="text-50">Brady Malott</a>
                        </li>
                        <li>
                            <a href="../content/about_us.php#jonathan_fehr" id="jon" class="text-50">Jonathan Fehr</a>
                        </li>
                        <li>
                            <a href="../content/about_us.php#shady_gerges" id="shady" class="text-50">Shady Gerges</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Customer Support</h5>
                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="../content/faq.php" id="faq" class="text-50">F.A.Q.</a>
                        </li>
                        <li>
                            <a href="../content/shipping_returns.php" id="ship" class="text-50">Shipping & Returns</a>
                        </li>
                        <li>
                            <a href="../content/contact_us.php" id="contact" class="text-50">Contact Us</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Sales</h5>
                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="../content/products.php" id="products" class="text-50">Products</a>
                        </li>
                        <li>
                            <a href="../content/gallery.php" id="gallery" class="text-50">Gallery</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">My Account</h5>

                    <ul class="list-unstyled mb-0">
                        <?php
                            if (!isLoggedIn()) { ?>
                                <li>
                                    <a href="../content/login.php" id="login" class="text-50">Log In</a>
                                </li>
                            <?php } else { ?>
                                <li>
                                    <a href="../content/#" id="myAcc" class="text-50">My Account</a>
                                </li>
                                <li>
                                    <a href="../content/cart.php" id="cart" class="text-50">Cart</a>
                                </li>
                                <li>
                                    <a href="../content/logout.php" id="logOut" class="text-black-50">Log Out</a>
                                </li>
                        <?php }?>
                    </ul>
                </div>
            </div>
        </section>
    </div>
    <div class="text-center p-3" id="foot" style="background-color: rgba(0, 0, 0, 0.125)">
        2022
    </div>
</footer>
