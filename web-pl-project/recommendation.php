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
    <link href="https://fonts.googleapis.com/css?family=Cormorant+Infant|Gilda+Display|Raleway+Dots|Love+Ya+Like+A+Sister|Reenie+Beanie|Fredericka+the+Great|Shadows+Into+Light+Two|Major+Mono+Display|Bilbo|Architects+Daughter|Sacramento|Marck+Script|Thasadith|Open+Sans+Condensed:300" rel="stylesheet">
    <title>Web PL Project</title>

    <script type="text/javascript">
        function setFocus() // sets focus on the skin type selection
        {
          document.forms[0].elements[0].focus();
        }
    </script>
  </head>

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
            //display the user information
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

    <!-- Condition selections; dropdown menu for each category -->
    <div class="container itemdescription">
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <span><h4 style="text-align: center;color:#fff;font-family:'Fredericka the Great', cursive;">Find out what's best for you!</h4></span>
            <div class="row ">
            <div class="form-group col-md-3">
                <label for="skin">Skin Type:</label>
                <select class="form-control" id="skin" name = "skin">
                    <option>Dry</option>
                    <option>Combination</option>
                    <option>Oily</option>
                    <option>Sensitive</option>
                    <option>Acne Prone</option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="age">Age Group:</label>
                <select class="form-control" id="age" name="age">
                    <option>0 - 9</option>
                    <option>10 - 19</option>
                    <option>20 - 29</option>
                    <option>30 - 39</option>
                    <option>40 - 49</option>
                    <option>50 - 59</option>
                    <option>60 - 69</option>
                    <option>70+</option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="type">Type</label>
                <select class="form-control" id="type" name="type">
                    <option>Foundations</option>
                    <option>Lipsticks</option>
                    <option>Skin Care</option>
                    <option>Eyes</option>
                    <option>Other</option>
                </select>
                <div id="password2error" class="error"></div>
            </div>
            <div class="form-group col-md-3">
                <br>
                <button type="submit" class="login-button form-control" style="font-weight:bold;">Submit</button>
            </div>
        </form>
            <!-- Individual Products -->
            <tbody>
              <?php
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                  //process the form query
                  $lowage = explode("-",$_POST["age"])[0];
                  $highage = explode("-",$_POST["age"])[1];
                  $type = $_POST["type"];
                  //echo $type . "<br><br><br>";
                  if ($type == "Foundations") {
                    $type = "foundations";
                  }
                  else if ($type == "Lipsticks") {
                    $type = "lip";
                  }
                  else if ($type = "Skin Care") {
                    $type = "skin";
                  }
                  else if ($type = "Eyes") {
                    $type = "eye";
                  }
                  //display the query data
                  echo '<div class="container itemdescription">';
                  echo '<h2 style="text-align:center"> Recommendation for <br> Age:  ' . $_POST["age"] . " <br> Skin Type: " . $_POST["skin"] . " <br> Type: " . $_POST["type"] . "</h2>";
                  echo '<table class="table table-hover">';
                  echo '<thead>';
                  echo '<tr>';
                  echo '<th scope="col">Rank</th>';
                  echo '<th scope="col">Name</th>';
                  echo '<th scope="col">Company</th>';
                  echo '<th scope="col">Rating</th>';
                  echo '</a></tr></thead><tbody>';
                  require('db-connect.php');
                  //select from db
                  $query = "SELECT ProductName, BrandName, Votes, TVotes, CDPHId, CSFId, 	SubCategoryId, 	ChemicalId FROM itemdescription WHERE Age > '$lowage' and Age < '$highage' and SubCategory LIKE '%$type%' ORDER BY Votes/TVotes DESC";
                  $statement = $db->prepare($query); 
                  $statement->execute();
                  $results = $statement->fetchAll();
                  $counter = 0;
                  if (sizeof($results) == 0) {
                    echo "There seems to be nothing at this time! Try redefining your search! ";
                  }
                  foreach ($results as $result) {
                    //display the top 15 ordered by rating
                    if ($counter < 15) {
                      $CDPHId = $result["CDPHId"];
                      $CSFId = $result["CSFId"];
                      $SubCategoryId = $result["SubCategoryId"];
                      $ChemicalId = $result["ChemicalId"];
                      echo '<tr id="row' . ($counter + 1) . '" onmouseover="changeColor(' . "'row" . ($counter + 1) . "')" . '" onmouseout="resetColor(' . "'row" . ($counter + 1) . "')" .'"onclick="location.href=' . "'productinfo.php?CDPHId=$CDPHId&CSFId=$CSFId&SubCategoryId=$SubCategoryId&ChemicalId=$ChemicalId';" . '" style="cursor:pointer">';;
                      echo '<th scope="row">' . ($counter + 1) . "</th>";
                      echo '<td>' . $result["ProductName"] . '</td>';
                      echo '<td>' . $result["BrandName"] . '</td>';
                      if ($result["Votes"] == 0) {
                        echo '<td>0/5</td>';
                      }
                      else {
                        echo '<td>' . ($result["Votes"] / $result["TVotes"]) * 5 . "/5 </td>";
                      }
                      echo '</tr>';
                      $counter = $counter + 1;
                    }
                    else {
                      break;
                    }
                  }
                  echo "</tr>";
                  echo "</tbody>";
                  echo "</table>";
                  echo "</div>";
                }
              ?>


    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


  </body>
</html>
