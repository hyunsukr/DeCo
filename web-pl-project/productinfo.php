<!-- Sumin Kim (sk5gz)
     Max Ryoo (hr2ee)
     Sujin Park (sjp7yf) -->
     
<!-- 1. create HTML5 doctype -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <link rel ="stylesheet" href ="main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Cormorant+Infant|Gilda+Display|Raleway+Dots|Love+Ya+Like+A+Sister|Reenie+Beanie|Fredericka+the+Great|Shadows+Into+Light+Two|Major+Mono+Display|Bilbo|Architects+Daughter|Sacramento|Marck+Script|Thasadith|Open+Sans+Condensed:300" rel="stylesheet">
    <title>Web PL Project</title>

  </head>
  <script>
    function showingredients() { // displays ingredient info when + button is clicked
      var x = document.getElementById("ingredients");
      if (x.style.display === "none") {
        x.style.display = "block";
      }
      else {
        x.style.display = "none";
      }
    }

    function showdescription() { // displays description info when + button is clicked
      var x = document.getElementById("description");
      if (x.style.display === "none") {
        x.style.display = "block";
      }
      else {
        x.style.display = "none";
      }
    }
    var upvote = (params) => document.getElementById(params).innerHTML = "Thank you for the upvote!";
    var downvote = (params) => document.getElementById(params).innerHTML = "Thank you for the downvote!";
  </script>

  <!-- Background image and title/menu bar -->
  <body background="image/brush.jpg">
    <header>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark" style="background-color:transparent !important">
        <a class="navbar-brand" href="index.php" style="text-shadow: 0 0 10px #ff0fa2 , 0 0 10px #ffadc0 , 0 0 10px #ffadc0 , 0 0 10px #ff0fa2;">DeCo</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="about.php">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="products.php">Products</a>
              </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Category</a>
              <div class="dropdown-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item" href="skintype.php">Skin Type</a>
                <a class="dropdown-item" href="agegroup.php">Age Group</a>
                <a class="dropdown-item" href="mostpopular.php">Most Popular</a>
             </div>
            </li>
            <li class="nav-item">
            <?php
              if (isset($_COOKIE["user"])) {
                echo '<a class="nav-link" href="mainuser.php">' . $_COOKIE["user"] . '</a>';
              } 
              else {
                echo '<a class="nav-link" href="log-in.php">Log in</a>';
              }
            ?>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <br>

    <!-- Item description -->
    <div class="container itemdescription">
        <br>
        <?php
            require('db-connect.php');
            //pull from db
            $CDPHId = $_GET['CDPHId'];
            $CSFId = $_GET['CSFId'];
            $SubCategoryId = $_GET['SubCategoryId'];
            $ChemicalId = $_GET['ChemicalId'];
            $query = "SELECT * FROM itemdescription WHERE CDPHId = '$CDPHId' and CSFID = '$CSFId' and SubCategoryId = '$SubCategoryId' and ChemicalId = '$ChemicalId'";
            $statement = $db->prepare($query); 
            $statement->execute();
            $results = $statement->fetchAll();
            foreach ($results as $result) {
              //iterate through array
              $ProductName =  $result["ProductName"];
              $Votes = $result["Votes"];
              $TVotes = $result["TVotes"];
              $age = $result["Age"];
              $brandname = $result["BrandName"];
              $SubCategory = $result["SubCategory"];
              $Chemicalname = $result["ChemicalName"];
            }
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                //display the product
                echo '<h3 style="text-align: center;padding-top:5px;font-family:' . " 'Fredericka the Great', cursive;" .'">'. $ProductName . '</h3>';
                echo '<div class = "row">';
                echo '<div class="col-md-6">';
                echo ' <img class="itempic" src="image/chloe1.jpg" style="width:100%" alt="chloe2"/>';
                echo '</div>';
                echo '<div class="col-md-6">';
                if ($Votes == 0) {
                    $rating = "0/5";
                } 
                else {
                    $rating = $Votes / $TVotes;
                    $rating = $rating * 5;
                    $rating = $rating . "/5"; 
                }
                echo "<strong>Rating: </strong>" . $rating . "<br>";
                $agegroup = (int)($age/10) * 10 . '-' .  (int)(($age + 10)/10) * 10;
                echo "<strong>Popular Age Group: </strong> " . $agegroup . "<br>";
                echo "<strong>Company: </strong> " . $brandname . " <br>";
                echo "<strong>Type: </strong> " . $SubCategory . " <br>"; 
                echo 'Item Chemicals:  <button class="btn-outline-expand" style="background:transparent;border: transparent;" onclick="showingredients()"><i class="fa fa-plus" aria-hidden="true"></i></button>';
                echo '<div id="ingredients" style="display:none">' . $Chemicalname . '</div>'; 
            }
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
              //process the upvote
                echo '<h3 style="text-align: center;padding-top:5px;font-family:' . " 'Fredericka the Great', cursive;" .'">'. $ProductName . '</h3>';
                echo '<div class = "row">';
                echo '<div class="col-md-6">';
                echo ' <img class="itempic" src="image/chloe1.jpg" style="width:100%" alt="chloe2"/>';
                echo '</div>';
                echo '<div class="col-md-6">';
                if ($_POST["upvote"] == 1) {
                    echo "<br>Thank you for the upvote!<br>" ;
                    require('db-connect.php');
                    $newvotes = $Votes + 1;
                    $newtvotes = $TVotes + 1;
                    $query = "UPDATE itemdescription SET Votes = $newvotes, TVotes = $newtvotes WHERE ProductName = '" . $ProductName . "' and CDPHId = '" . $CDPHId . "' and CSFId = '" . $CSFId . "' and SubCategoryId = '" . $SubCategoryId . "' and ChemicalId = '" . $ChemicalId . "'" ;
                    $statement = $db->prepare($query); 
                    $statement->execute();
                    $statement->closeCursor();
                    $rating = ($newvotes / $newtvotes) * 5;
                    echo "<strong>Rating: </strong>" . $rating . "/5<br>";
                }
                else {
                    echo "<br>Thank you for the downvote!<br>" ;
                    require('db-connect.php');
                    $newvotes = $Votes;
                    $newtvotes = $TVotes + 1;
                    $query = "UPDATE itemdescription SET Votes = $newvotes, TVotes = $newtvotes WHERE ProductName = '" . $ProductName . "' and CDPHId = '" . $CDPHId . "' and CSFId = '" . $CSFId . "' and SubCategoryId = '" . $SubCategoryId  . "' and ChemicalId = '" . $ChemicalId . "'" ;
                    $statement = $db->prepare($query); 
                    $statement->execute();
                    $statement->closeCursor();
                    $rating = ($newvotes / $newtvotes) * 5;
                    echo "<strong>Rating: </strong>" . $rating . "/5<br>";
                }
                $agegroup = (int)($age/10) * 10 . '-' .  (int)(($age + 10)/10) * 10;
                echo "<strong>Popular Age Group: </strong> " . $agegroup . "<br>";
                echo "<strong>Company: </strong> " . $brandname . " <br>";
                echo "<strong>Type: </strong> " . $SubCategory . " <br>"; 
                echo 'Item Chemicals:  <button class="btn-outline-expand" style="background:transparent;border: transparent;" onclick="showingredients()"><i class="fa fa-plus" aria-hidden="true"></i></button>';
                echo '<div id="ingredients" style="display:none">' . $Chemicalname . '</div>'; 
            }
        ?><br>
        Would you recommend this item? 
        <!-- Thumbs up -->
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" style="display: inline-block;">
            <input type="hidden" value="1" style="hidden" name="upvote">
        <button type="submit" class="btn-outline-expand" style="background:transparent;border: transparent;"><i class="fa fa-thumbs-up"></i></button>
        </form>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST"  style="display: inline-block;">
            <input type="hidden" value="-1" style="hidden" name="upvote">
        <!-- Thumbs down -->
        <button type="submit" class="btn-outline-expand" style="background:transparent;border: transparent;" ><i class="fa fa-thumbs-down"></i></button>
        </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
      document.getElementById("clearbtn").addEventListener("click", function() {
        document.getElementById("upvote").innerHTML = "";
      });
    </script>

  </body>
</html>
