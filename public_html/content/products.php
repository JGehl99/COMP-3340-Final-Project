<!doctype html>
<html lang="en">

<?php
$title = 'Products';
include('../content/navbar.php');
?>

<?php
    $dbServerName = "localhost";
    $dbUsername = "gehlj_OldChickenDB";
    $dbPassword = "Pt9me6124l";
    $dbName = "gehlj_OldChickenDB";
    $port = 3306;

    // create connection
    $conn = new mysqli($dbServerName, $dbUsername, $dbPassword, $dbName, $port);

    // check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT id, name, description, imageURL, price FROM PRODUCT";
    $result = $conn->query($sql);
?>

<body>
    <div class="container flex justify-content-center">
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
                        <div class="card" style="height: 100%;">
                        <img class="card-img-top p-4" src="' . $row["imageURL"] . '" alt="' . $row["name"] . '">
                          <div class="card-body">
                            <h5 class="card-title">' . $row["name"] . '</h5>
                            <h6 class="card-subtitle text-success my-2">$' . $row["price"] . '</h6>
                            <ul class="card-text">
                  ';

                  // Add the bullet points for the description
                  foreach($description_items as $item) {
                      echo '<li>' . $item . '</li>';
                  }

                  // Close tags
                  echo '    
                            </ul>
                          </div>
                        </div>
                      </div>
                  ';
              }
              echo '</div>';
          }
    ?>
    </div>
</body>
</html>
