<!doctype html>
<html lang="en">

<?php
$title = 'Product';
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

  $id = $_GET["item-id"];
  if (empty($id)) {
    die("Invalid item ID");
  }

  $sql = "SELECT id, name, description, imageURL, price, rating, numRatings FROM PRODUCT WHERE id = " . $id;
  $result = $conn->query($sql);
?>

<body class="bg-white">
<div class="container text-wrap py-5">
  <?php
    // Generating the product card
    if ($result->num_rows == 1) {
      $item = $result->fetch_assoc();
      // Get an array of description items
      $description_items = explode(",", $item["description"]);
      // $row["description"] ends in a comma, so remove the last empty element from the array
      array_pop($description_items);

      // Create the product cards
      echo '<div class="row">
              <div class="col-12 col-lg-4 mb-4">
                <div class="card">
                  <div class="card-body">
                    <img src="' . $item["imageURL"] . '" alt="' . $item["name"] . '" class="w-100" />
                  </div>
                </div>
              </div>
              <div class="col mb-4">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-12 col-sm">
                        <h4 class="card-title">' . $item["name"] . '</h4>
                        <div>';

      // Create the chicken icons to display the star rating
      $num_stars = get_star_rating($item["rating"]);
      for ($i = 0; $i < (int) $num_stars; ++$i) {
        echo '            <img src="../static/icon.svg" alt="OldChicken Icon" style="height:16px;width:16px;" />';
      }
      if (!is_int($num_stars)) {
        echo '            <img src="../static/icon_half.svg" alt="OldChicken Icon" style="height:16px;width:16px;" />';
      }

      echo '            
                          <h6 class="card-subtitle text-muted d-inline-block">' . $item["numRatings"] . '</h6>
                        </div>
                      </div>
                      <span class="d-none d-sm-block col-1"></span>
                      <div class="col col-sm-4 col-md-3 col-lg-4 col-xl-3">
                        <h4 class="text-success text-end">$' . $item["price"] . '</h4>
                        <div class="d-flex justify-content-end mb-2">
                          <div class="input-group" style="width: 9rem;">
                            <button type="button" class="btn btn-danger d-flex align-items-center decrease-amt" data-field="' . $item["id"] . '-amt">
                              <img src="../static/dash-lg.svg" alt="Decrease Quantity" />
                            </button>
                            <input type="text" id="' . $item["id"] . '-amt" class="form-control amt" value="0" min="0" max="100" />
                            <button type="button" class="btn btn-success d-flex align-items-center increase-amt" data-field="' . $item["id"] . '-amt">
                              <img src="../static/plus-lg.svg" alt="Increase Quantity" />
                            </button>
                          </div>
                        </div>
                        <div class="d-flex justify-content-end">
                          <button type="button" class="btn btn-primary d-flex align-items-center add-to-cart" data-field="' . $item["id"] . '-amt">
                              <img src="../static/cart.svg" alt="Add To Cart" />
                          </button>
                        </div>
                      </div>
                    </div>
                    <div>
                      <ul class="card-text mt-2">';

      // Add the bullet points for the description
      foreach($description_items as $description_item) {
        echo            '<li>' . $description_item . '</li>';
      }

      echo '          </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>';
      
    }
  ?>
</div>
<?php include('../content/footer.php'); ?>
</body>
</html>
