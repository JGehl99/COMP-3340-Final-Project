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
    $result = $conn->query($sql);

    function get_star_rating($rating) {
      $whole_stars = intdiv($rating, 20);
      $remainder_after_whole_stars = $rating - (20 * $whole_stars);
      if ($remainder_after_whole_stars >= 10) {
        return $whole_stars + 0.5;
      }
      return $whole_stars;
    }
?>

<body class="bg-white">
    <div class="container d-flex justify-content-center">
    <?php
            // Generating the product cards
          if ($result->num_rows > 0) {
              echo '<div class="row">';
              while($row = $result->fetch_assoc()) {
                  // Get an array of description items
                  $description_items = explode(",", $row["description"]);
                  // $row["description"] ends in a comma, so remove the last empty element from the array
                  array_pop($description_items);

                  // Create the card for the item
                  echo '
                      <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4 mt-5">
                        <div class="card h-100 hover_expand bg-light text-dark">
                        <img class="card-img-top p-4" src="' . $row["imageURL"] . '" alt="' . $row["name"] . '" />
                          <div class="card-body">
                            <h5 class="card-title">' . $row["name"] . '</h5>
                            <div class="d-flex justify-content-between">
                              <h6 class="card-subtitle text-success my-2">$' . $row["price"] . '</h6>
                              <div>';

                  // Create the chicken icons to display the star rating
                  $num_stars = get_star_rating($row["rating"]);
                  for ($i = 0; $i < (int) $num_stars; ++$i) {
                    echo '<img src="../static/icon.svg" alt="OldChicken Icon" style="height:16px;width:16px;" />';
                  }
                  if (!is_int($num_stars)) {
                    echo '<img src="../static/icon_half.svg" alt="OldChicken Icon" style="height:16px;width:16px;" />';
                  }

                  echo '        <h6 class="card-subtitle text-muted my-2 d-inline-block">' . $row["numRatings"] . '</h6>
                              </div>
                            </div>
                            <ul class="card-text">
                  ';

                  // Add the bullet points for the description
                  foreach($description_items as $item) {
                      echo '<li>' . $item . '</li>';
                  }

                  // Close tags
                  echo '    
                            </ul>
                            <div class="d-flex justify-content-end">
                              <div class="input-group" style="width: 9rem;">
                                <button type="button" class="btn btn-danger d-flex align-items-center decrease-amt" data-field="' . $row["id"] . '-amt">
                                  <img src="../static/dash-lg.svg" alt="Decrease Quantity" />
                                </button>
                                <input type="text" id="' . $row["id"] . '-amt" class="form-control amt" value="0" min="0" max="100" />
                                <button type="button" class="btn btn-success d-flex align-items-center increase-amt" data-field="' . $row["id"] . '-amt">
                                  <img src="../static/plus-lg.svg" alt="Increase Quantity" />
                                </button>
                              </div>
                              <span class="mx-2"></span>
                              <button type="button" class="btn btn-primary d-flex align-items-center add-to-cart" data-field="' . $row["id"] . '-amt">
                                <img src="../static/cart.svg" alt="Add To Cart" />
                              </button>
                            </div>
                          </div>
                        </div>
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
