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
        function setFocus() // sets focus on the search box
        {
          document.forms[0].elements[0].focus();
        }

        function validateInfo() { // displays a message when search button is clicked without any input
          var search = document.getElementById("search").value;
          if (search.length == 0) {
            document.getElementById("searcherror").innerHTML = "Please enter the name of an item";
            document.getElementById("search").focus();
            return false;
          }
          else {
            return true;
          }
        }
    </script>
  </head>

    <!-- Background image and title/menu bar -->
   <body background="image/brush.jpg" onload="setFocus()">
   <!--<body onload="setFocus()"> -->
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
              if ($_SERVER["REQUEST_METHOD"] == "POST" && strlen($_POST["prodname"]) > 0) {
                $prodname = trim($_POST["prodname"]);
                require('db-connect.php');
                $query = "SELECT * FROM itemdescription WHERE ProductName = '$prodname'";
                $statement = $db->prepare($query); 
                $statement->execute();
                $results = $statement->fetchAll();
                $fields = [];
                foreach ($results as $result) {
                  $CDPHId = $result["CDPHId"];
                  $CSFId = $result["CSFId"];
                  $SubCategoryId = $result["SubCategoryId"];
                  $ChemicalId = $result["ChemicalId"];
                  $counter = 0;
                  foreach ($result as $value) {
                    if ($counter % 2 == 0) {
                      $fields[] =  $value;
                    }
                    $counter = $counter + 1;
                  }
                }
                $query = "select column_name from information_schema.columns where table_name='itemdescription'";
                //get the column names
                $statement = $db->prepare($query); 
                $statement->execute();
                $results = $statement->fetchAll();
                $colnames = [];
                foreach ($results as $names) {
                  $counter = 0;
                  foreach ($names as $description) {
                    if ($counter % 2 ==0) {
                      $colnames[] = $description;
                    }
                    $counter = $counter + 1;
                  }
                }
                $redirect = "Location: searchproduct.php?";
                for ($i = 0; $i < sizeof($colnames); $i++) {
                  //get redirect link
                  $redirect =  $redirect . $colnames[$i] . "=" . $fields[$i] . "&";
                }
                header($redirect);
                exit();
                }
                ?>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <!-- Boxes displaying item categories -->
    <div class="container">
        <div class="row">
            <div class="col-md-4">
            <a id="link" href="foundation.php">
                <div class="categoryproducts">
                    <h3>Foundations</h3>
                    <p>Take a look at the most popular Foundations!
                    </p>
                </div>
            </a>
            </div>
            <div class="col-md-4">
            <a id="link" href="lipstick.php">
                <div class="categoryproducts">
                    <h3>Lipsticks</h3>
                    <p>Take a look at the most popular Lipsticks!
                    </p>
                </div>
            </a>
            </div>
            <div class="col-md-4">
            <a id="link" href="skincare.php">
                <div class="categoryproducts">
                    <h3>Skin Care</h3>
                    <p>Find out with skin care products are for your skin!
                    </p>
                </div>
            </a>
            </div>
            <div class="col-md-4">
            <a id="link" href="eyeprod.php">
                <div class="categoryproducts">
                    <h3>Eye Products</h3>
                    <p>Take a look at the most popular Eye Products!
                    </p>
                </div>
            </a>
            </div>
            <div class="col-md-4">
            <a id="link" href="accessory.php">
                <div class="categoryproducts">
                    <h3>Other</h3>
                    <p>Check out accessories and tools you might want to have.
                    </p>
                </div>
            </a>
            </div>
            <div class="col-md-4">
            <a id="link" href="recommendation.php">
                <div class="categoryproducts">
                    <h3>What is recommended for you?</h3>
                    <p>Not sure which is the best for you? Take a look at our recommendations to help you make the perfect choice.
                    </p>
                </div>
            </a>
            </div>
      </div>

      <!-- Search function -->
      <div class="category3" style="width: 100%">
        <h4 style="text-align: center"><span style="font-family:'Raleway Dots', cursive;">Want to search for a product?</span></h4>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" style="display: flex">
            <input type="text" class="form-control" type="search" id="search" name="prodname" placeholder="Search" style="font-family:'Raleway Dots', cursive;">
            <button type="submit" class="btn btn-outline-search" name="submit" value="Submit">Search</button>
        </form>
        <br>
        <h4 style="text-align: center"><span style="font-family:'Raleway Dots', cursive;">Want to search by Product??</span></h4>
        <input type="text" class="form-control"id="txt1" onkeyup="showbrands(this.value)">
        <h6 style="text-align: center"><span style="font-family:'Raleway Dots', cursive;">Suggestions</span></h6>
        <span id="brands"></span>

    </div>
    <script>
    // js for ajax function 
    function showbrands(str) {
      var xhttp;
      if (str.length == 0) { 
        document.getElementById("brands").innerHTML = "";
        return;
      }
      xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("brands").innerHTML = this.responseText;
        }
      };
      xhttp.open("GET", "getbrands.php?brand="+str, true);
      xhttp.send();   
    }
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


  </body>
</html>
