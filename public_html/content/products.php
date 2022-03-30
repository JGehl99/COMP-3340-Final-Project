<!doctype html>
<html lang="en">

<?php
$title = 'Products';
include('../content/navbar.php');
include('../static/config.php');
?>

<?php

    // create connection
    $conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME, DB_PORT);

    // check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT id, name, description, imageURL, price, rating, numRatings FROM PRODUCT";
    $products = $conn->query($sql)->fetch_all();
    $conn->close();
?>

<body class="bg-white">
    <div class="container d-flex justify-content-center pb-5">
    <?php
            // Generating the product cards
          if (count($products) > 0) {
              echo '<div class="row">';
              foreach ($products as $product) {
                  // Retrieve attributes from $product
                  [$id, $name, $description, $imageURL, $price, $rating, $numRatings] = $product;

                  // Get an array of description items
                  $description_items = explode(",", $description);
                  // $row["description"] ends in a comma, so remove the last empty element from the array
                  array_pop($description_items);

                  // Create the card for the item
                  echo '
                      <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4 pt-5">
                        <a href="#" class="card h-100 hover_expand text-decoration-none bg-light text-dark product-link" item-id="' . $id . '">
                        <img class="card-img-top p-4" src="' . $imageURL . '" alt="' . $name . '" />
                          <div class="card-body">
                            <h5 class="card-title">' . $name . '</h5>
                            <div class="d-flex justify-content-between">
                              <h6 class="card-subtitle text-success my-2">$' . $price . '</h6>
                              <div>';

                  // Create the chicken icons to display the star rating
                  $num_stars = get_star_rating($rating);
                  for ($i = 0; $i < (int) $num_stars; ++$i) {
                    echo '<img src="../static/icon.svg" alt="OldChicken Icon" style="height:16px;width:16px;" />';
                  }
                  if (!is_int($num_stars)) {
                    echo '<img src="../static/icon_half.svg" alt="OldChicken Icon" style="height:16px;width:16px;" />';
                  }

                  echo '        <h6 class="card-subtitle text-muted my-2 d-inline-block">' . $numRatings . '</h6>
                              </div>
                            </div>
                            <ul class="card-text">
                  ';

                  // Add the bullet points for the description
                  foreach($description_items as $item) {
                      echo '<li class="text-dark">' . $item . '</li>';
                  }

                  // Close tags
                  echo '    
                            </ul>
                          </div>
                          <div class="me-3 mb-3">
                              <div class="d-flex justify-content-end">
                                  <div class="input-group" data-no-link style="width: 9rem;">
                                    <button type="button" class="btn btn-secondary d-flex align-items-center decrease-amt" data-field="' . $id . '-amt">
                                      <img src="../static/dash-lg.svg" alt="Decrease Quantity" />
                                    </button>
                                    <input type="text" id="' . $id . '-amt" class="form-control amt" value="0" min="0" max="100" />
                                    <button type="button" class="btn btn-secondary d-flex align-items-center increase-amt" data-field="' . $id . '-amt">
                                      <img src="../static/plus-lg.svg" alt="Increase Quantity" />
                                    </button>
                                  </div>
                                  <span class="mx-2"></span>
                                  <button type="button" class="btn btn-primary d-flex align-items-center add-to-cart" data-no-link data-field="' . $id . '-amt">
                                    <img src="../static/cart.svg" alt="Add To Cart" />
                                  </button>
                              </div>
                          </div>
                        </a>
                      </div>
                  ';
              }
              echo '</div>';
          }
    ?>
    </div>
    <?php include('../content/footer.php'); ?>

    <script src="../js/products-cart-quantity.js"></script>
</body>
</html>
