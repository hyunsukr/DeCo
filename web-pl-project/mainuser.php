<!-- Sumin Kim (sk5gz)
     Max Ryoo (hr2ee)
     Sujin Park (sjp7yf) -->

<!-- 1. create HTML5 doctype -->

<?php
  //start session
  session_start();
  if (isset($_POST['brand']))
  {
     $yourbrand = $_POST['brand'];
     $_SESSION['brand'] = $yourbrand;
     //header('Location: mainuser.php');
  }
?>
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
        function setFocus() // sets focus on the email input box
        {
          document.forms[0].elements[0].focus();
        }

        function checkuser() { // checks if the user entered in a valid email address
          var email = document.getElementById("email").value;
          if (email.length == 0) {
            document.getElementById("emailerror").innerHTML = "Please enter an email";
            document.getElementById("email").focus();
            return false;
          }
          else if (!email.includes("@")) {
            document.getElementById("emailerror").innerHTML = "Please enter a valid email";
            document.getElementById("email").focus();
            return false;
          }
          else {
            return true;
          }
        }

        function checkpass() { // checks password
          var password = document.getElementById("password").value;
          if (email.length == 0) {
            document.getElementById("passworderror").innerHTML = "Please enter an email";
            document.getElementById("password").focus();
            return false;
          }
          else {
            return true;
          }
        }
        function changeColor(row) {
            var currrow = document.getElementById(row);
            currrow.style.color = '#FFF';
        }
        function resetColor(row) {
            var currrow = document.getElementById(row);
            currrow.style.color = '#000';
        }
    </script>
  </head>

    <!-- Background image and title/menu bar -->
  <body background="image/brush.jpg" onload="setFocus()">
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
              <a class="nav-link" href="log-out.php">Log out</a>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <br>

    <!-- Time display -->
    <div class="container user" method="post">
        <script>
          var d = new Date();
          var hour = d.getHours();
          var minutes = d.getMinutes();
          if (minutes < 10) {
            minutes = '0' + minutes;
          }
          var time = d.getHours() + ":" + minutes;
          var greeting = "";
          if (hour > 4 && hour < 12) {
            var greeting = "Good Morning!";
            time = d.getHours() + ":" + minutes + " AM";
          }
          else if (hour >= 12 && hour < 20) {
            time = d.getHours() - 12 + ":" + minutes + " PM";
            var greeting = "Good Afternoon!";
          }
          else if (hour >= 20 || hour <= 4) {
            var greeting = "Good Night!";
            time = d.getHours() - 12 + ":" + minutes + " PM";
          }
          else if (hour <= 0 && hour <= 4) {
            var greeting = "Good Night!";
            time = d.getHours() + ":" + minutes + " AM";
          }
          greeting = greeting + " It is currently \r" + time
          document.write('<h2 class = "greeting"><span>' + greeting + '</span>');
        </script>
        <!-- Logged in user page -->
        <h3 style="text-align: center;padding-top:5px;font-family: 'Fredericka the Great', cursive;">Welcome back



        !</h3>
        <div class="row ">

          <!-- Basic user info -->
            <div class="col-lg-6 ">
                Name : <?php
                //get name from db
                if (isset($_COOKIE["user"])) {
                  $username = $_COOKIE["user"];
                  require('db-connect.php');
                  $cookiedata = $_COOKIE["user"];
                  $query = "SELECT names FROM users WHERE username = '$cookiedata'";
                  $statement = $db->prepare($query);
                  $statement->execute();
                  $results = $statement->fetchAll();
                  foreach ($results as $result) {
                    echo $result["names"];
                  }
                }
              ?> <br>
                Skin Type:
                <?php
                //get skin type from db
                  if (isset($_COOKIE["user"])) {
                    $username = $_COOKIE["user"];
                    require('db-connect.php');
                    $cookiedata = $_COOKIE["user"];
                    $query = "SELECT skintype FROM userinfo WHERE username = '$cookiedata'";
                    $statement = $db->prepare($query);
                    $statement->execute();
                    $results = $statement->fetchAll();
                    foreach ($results as $result) {
                      echo $result["skintype"];
                    }
                  }
                ?>
                <br>
                Age:
                <?php
                //get age from db
                  if (isset($_COOKIE["user"])) {
                    $username = $_COOKIE["user"];
                    require('db-connect.php');
                    $cookiedata = $_COOKIE["user"];
                    $query = "SELECT age FROM userinfo WHERE username = '$cookiedata'";
                    $statement = $db->prepare($query);
                    $statement->execute();
                    $results = $statement->fetchAll();
                    foreach ($results as $result) {
                      echo $result["age"];
                      $userage = $result["age"];
                    }
                  }
                ?>
                <br>
                <?php
              if (isset($_SESSION['brand']))
              //access teh session
              {
                echo "Your favorite brand is ",$_SESSION['brand'],"!";
              }
              ?>
                <a href="updateuserinfo.php"><button class="login-button form-control">Update info!</button></a>
                <?php
                  if (isset($_COOKIE["user"])) {
                    $cookiedata = $_COOKIE["user"];
                    if ($cookiedata == "hyunsukr@gmail.com") {
                      echo "<br><a href='updatedb.php'><button class='login-button form-control'>Update the Database!</button></a>";
                    }
                    //if the user is admin then have option to update the database
                  }
                ?>
              <div class="container" style="padding-top:5%;">
                <h4>What is your favorite brand?</h4>
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                  <input type="text" name="brand" class="form-control" autofocus required /> <br />
                  <input type="submit" value="Submit" class="btn btn-light" style="margin-bottom:3%;"/>
                </form>
              </div>
            </div>

            <!-- Recommendations list for the user -->
            <div class="col-lg-6">
                <h4>DeCo's recommendations for you!</h4>
                <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">Type</th>
                        <th scope="col">Name</th>
                        <th scope="col">Company</th>
                        <th scope="col">Rating</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //function to get avgrating
                        function avgrating($array) 
                        {
                          $total = 0;
                          foreach ($array as $number) {
                            $total = $total + $number/5;
                          }
                          $avg = ($total/sizeof($array)) * 5; 
                          return $avg;
                        }
                        $rating = [];
                        //get the top products for the current user
                        require('db-connect.php');
                        $query = "SELECT ProductName, BrandName, Votes, TVotes, CDPHId, CSFId, 	SubCategoryId, 	ChemicalId FROM itemdescription WHERE Age = '$userage' and SubCategory LIKE '%foundation%'  ORDER BY Votes/TVotes DESC";
                        $statement = $db->prepare($query);
                        $statement->execute();
                        $results = $statement->fetchAll();
                        $counter = 0;
                        if (sizeof($results) == 0) {
                          echo '<tr id="row' . "No Foundations found" . '" onmouseover="changeColor(' . "'row" . "No Foundations found" . "')" . '" onmouseout="resetColor(' . "'row" . "No Foundations found" . "')" . '" style="cursor:pointer">';;
                          echo '<th scope="row">' . "No Foundations found" . "</th>";
                          echo '<td> Sorry for the Inconvience</td>';
                          echo '<td> No Foundation Found </td>';
                          echo '<td> Please check later! </td>';
                          echo '</tr>';
                          $rating[] = 0;
                        }
                        foreach ($results as $result) {
                          if ($counter < 1) {
                            $CDPHId = $result["CDPHId"];
                            $CSFId = $result["CSFId"];
                            $SubCategoryId = $result["SubCategoryId"];
                            $ChemicalId = $result["ChemicalId"];
                            echo '<tr id="row' . "Foundation" . '" onmouseover="changeColor(' . "'row" . "Foundation" . "')" . '" onmouseout="resetColor(' . "'row" . "Foundation" . "')" .'"onclick="location.href=' . "'productinfo.php?CDPHId=$CDPHId&CSFId=$CSFId&SubCategoryId=$SubCategoryId&ChemicalId=$ChemicalId';" . '" style="cursor:pointer">';;
                            echo '<th scope="row">' . "Foundation" . "</th>";
                            echo '<td>' . $result["ProductName"] . '</td>';
                            echo '<td>' . $result["BrandName"] . '</td>';
                            if ($result["Votes"] == 0) {
                              echo '<td>0/5</td>';
                              $rating[] = 0;
                            }
                            else {
                              $rating[] = ($result["Votes"] / $result["TVotes"]) * 5;
                              echo '<td>' . ($result["Votes"] / $result["TVotes"]) * 5 . "/5 </td>";
                            }
                            echo '</tr>';
                            $counter = $counter + 1;
                          }
                          else {
                            break;
                          }
                        }
                        require('db-connect.php');
                        $query = "SELECT ProductName, BrandName, Votes, TVotes, CDPHId, CSFId, 	SubCategoryId, 	ChemicalId FROM itemdescription WHERE Age = '$userage' andSubCategory LIKE '%lip%' ORDER BY Votes/TVotes DESC";
                        $statement = $db->prepare($query);
                        $statement->execute();
                        $results = $statement->fetchAll();
                        $counter = 0;
                        if (sizeof($results) == 0) {
                          echo '<tr id="row' . "No lipstick found" . '" onmouseover="changeColor(' . "'row" . "No lipstick found" . "')" . '" onmouseout="resetColor(' . "'row" . "No lipstick found" . "')" . '" style="cursor:pointer">';;
                          echo '<th scope="row">' . "No lipstick found" . "</th>";
                          echo '<td> Sorry for the Inconvience</td>';
                          echo '<td> No lipstick Found </td>';
                          echo '<td> Please check later! </td>';
                          echo '</tr>';
                          $rating[] = 0;
                        }
                        foreach ($results as $result) {
                          if ($counter < 1) {
                            $CDPHId = $result["CDPHId"];
                            $CSFId = $result["CSFId"];
                            $SubCategoryId = $result["SubCategoryId"];
                            $ChemicalId = $result["ChemicalId"];
                            echo '<tr id="row' . "Lipstick" . '" onmouseover="changeColor(' . "'row" . "Lipstick" . "')" . '" onmouseout="resetColor(' . "'row" . "Lipstick" . "')" .'"onclick="location.href=' . "'productinfo.php?CDPHId=$CDPHId&CSFId=$CSFId&SubCategoryId=$SubCategoryId&ChemicalId=$ChemicalId';" . '" style="cursor:pointer">';;
                            echo '<th scope="row">' . "Lipstick" . "</th>";
                            echo '<td>' . $result["ProductName"] . '</td>';
                            echo '<td>' . $result["BrandName"] . '</td>';
                            if ($result["Votes"] == 0) {
                              echo '<td>0/5</td>';
                              $rating[] = 0;
                            }
                            else {
                              $rating[] = ($result["Votes"] / $result["TVotes"]) * 5;
                              echo '<td>' . ($result["Votes"] / $result["TVotes"]) * 5 . "/5 </td>";
                            }
                            echo '</tr>';
                            $counter = $counter + 1;
                          }
                          else {
                            break;
                          }
                        }
                        require('db-connect.php');
                        $query = "SELECT ProductName, BrandName, Votes, TVotes, CDPHId, CSFId, 	SubCategoryId, 	ChemicalId FROM itemdescription WHERE Age = '$userage' andSubCategory LIKE '%skin%' ORDER BY Votes/TVotes DESC";
                        $statement = $db->prepare($query);
                        $statement->execute();
                        $results = $statement->fetchAll();
                        $counter = 0;
                        if (sizeof($results) == 0) {
                          echo '<tr id="row' . "No Skincare found" . '" onmouseover="changeColor(' . "'row" . "No Skincare found" . "')" . '" onmouseout="resetColor(' . "'row" . "No Skincare found" . "')" . '" style="cursor:pointer">';;
                          echo '<th scope="row">' . "No Skincare found" . "</th>";
                          echo '<td> Sorry for the Inconvience</td>';
                          echo '<td> No Skincare Found </td>';
                          echo '<td> Please check later! </td>';
                          echo '</tr>';
                          $rating[] = 0;
                        }
                        foreach ($results as $result) {
                          if ($counter < 1) {
                            $CDPHId = $result["CDPHId"];
                            $CSFId = $result["CSFId"];
                            $SubCategoryId = $result["SubCategoryId"];
                            $ChemicalId = $result["ChemicalId"];
                            echo '<tr id="row' . "SkinCare" . '" onmouseover="changeColor(' . "'row" . "SkinCare" . "')" . '" onmouseout="resetColor(' . "'row" . "SkinCare" . "')" .'"onclick="location.href=' . "'productinfo.php?CDPHId=$CDPHId&CSFId=$CSFId&SubCategoryId=$SubCategoryId&ChemicalId=$ChemicalId';" . '" style="cursor:pointer">';;
                            echo '<th scope="row">' . "SkinCare" . "</th>";
                            echo '<td>' . $result["ProductName"] . '</td>';
                            echo '<td>' . $result["BrandName"] . '</td>';
                            if ($result["Votes"] == 0) {
                              echo '<td>0/5</td>';
                              $rating[] = 0;
                            }
                            else {
                              $rating[] = ($result["Votes"] / $result["TVotes"]) * 5;
                              echo '<td>' . ($result["Votes"] / $result["TVotes"]) * 5 . "/5 </td>";
                            }
                            echo '</tr>';
                            $counter = $counter + 1;
                          }
                          else {
                            break;
                          }
                        }
                        require('db-connect.php');
                        $query = "SELECT ProductName, BrandName, Votes, TVotes, CDPHId, CSFId, 	SubCategoryId, 	ChemicalId FROM itemdescription WHERE Age = '$userage' and SubCategory LIKE '%eye%' ORDER BY Votes/TVotes DESC";
                        $statement = $db->prepare($query);
                        $statement->execute();
                        $results = $statement->fetchAll();
                        $counter = 0;
                        if (sizeof($results) == 0) {
                          echo '<tr id="row' . "No Eye Products found" . '" onmouseover="changeColor(' . "'row" . "No Eye Products found" . "')" . '" onmouseout="resetColor(' . "'row" . "No Eye Products found" . "')" . '" style="cursor:pointer">';;
                          echo '<th scope="row">' . "No Eye Products found" . "</th>";
                          echo '<td> Sorry for the Inconvience</td>';
                          echo '<td> No Eye Products Found </td>';
                          echo '<td> Please check later! </td>';
                          echo '</tr>';
                          $rating[] = 0;
                        }
                        foreach ($results as $result) {
                          if ($counter < 1) {
                            $CDPHId = $result["CDPHId"];
                            $CSFId = $result["CSFId"];
                            $SubCategoryId = $result["SubCategoryId"];
                            $ChemicalId = $result["ChemicalId"];
                            echo '<tr id="row' . "Eye Products" . '" onmouseover="changeColor(' . "'row" . "Eye Products" . "')" . '" onmouseout="resetColor(' . "'row" . "Eye Products" . "')" .'"onclick="location.href=' . "'productinfo.php?CDPHId=$CDPHId&CSFId=$CSFId&SubCategoryId=$SubCategoryId&ChemicalId=$ChemicalId';" . '" style="cursor:pointer">';;
                            echo '<th scope="row">' . "Eye Products" . "</th>";
                            echo '<td>' . $result["ProductName"] . '</td>';
                            echo '<td>' . $result["BrandName"] . '</td>';
                            if ($result["Votes"] == 0) {
                              echo '<td>0/5</td>';
                              $rating[] = 0;
                            }
                            else {
                              $rating[] = ($result["Votes"] / $result["TVotes"]) * 5;
                              echo '<td>' . ($result["Votes"] / $result["TVotes"]) * 5 . "/5 </td>";
                            }
                            echo '</tr>';
                            $counter = $counter + 1;
                          }
                          else {
                            break;
                          }
                        }
                        require('db-connect.php');
                        $query = "SELECT ProductName, BrandName, Votes, TVotes, CDPHId, CSFId, 	SubCategoryId, 	ChemicalId FROM itemdescription WHERE Age = '$userage' and SubCategory NOT LIKE '%skin%' and  SubCategory NOT LIKE '%eye%' and SubCategory NOT LIKE '%foundation%' and SubCategory NOT LIKE '%lip%'  ORDER BY Votes/TVotes DESC";
                        $statement = $db->prepare($query);
                        $statement->execute();
                        $results = $statement->fetchAll();
                        $counter = 0;
                        if (sizeof($results) == 0) {
                          echo '<tr id="row' . "No Other found" . '" onmouseover="changeColor(' . "'row" . "No Other found" . "')" . '" onmouseout="resetColor(' . "'row" . "No Other found" . "')" . '" style="cursor:pointer">';;
                          echo '<th scope="row">' . "No Other found" . "</th>";
                          echo '<td> Sorry for the Inconvience</td>';
                          echo '<td> No Other Found </td>';
                          echo '<td> Please check later! </td>';
                          echo '</tr>';
                          $rating[] = 0;
                        }
                        foreach ($results as $result) {
                          if ($counter < 1) {
                            $CDPHId = $result["CDPHId"];
                            $CSFId = $result["CSFId"];
                            $SubCategoryId = $result["SubCategoryId"];
                            $ChemicalId = $result["ChemicalId"];
                            echo '<tr id="row' . "Other" . '" onmouseover="changeColor(' . "'row" . "Other" . "')" . '" onmouseout="resetColor(' . "'row" . "Other" . "')" .'"onclick="location.href=' . "'productinfo.php?CDPHId=$CDPHId&CSFId=$CSFId&SubCategoryId=$SubCategoryId&ChemicalId=$ChemicalId';" . '" style="cursor:pointer">';;
                            echo '<th scope="row">' . "Other" . "</th>";
                            echo '<td>' . $result["ProductName"] . '</td>';
                            echo '<td>' . $result["BrandName"] . '</td>';
                            if ($result["Votes"] == 0) {
                              echo '<td>0/5</td>';
                              $rating[] = 0;
                            }
                            else {
                              $rating[] = ($result["Votes"] / $result["TVotes"]) * 5;
                              echo '<td>' . ($result["Votes"] / $result["TVotes"]) * 5 . "/5 </td>";
                            }
                            echo '</tr>';
                            $counter = $counter + 1;
                          }
                          else {
                            break;
                          }
                        }
                        //call function
                        echo '<tr id="row' . "avg" . '" onmouseover="changeColor(' . "'row" . "avg" . "')" . '" onmouseout="resetColor(' . "'row" . "avg" . "')" .' "style="cursor:pointer">';;
                        echo '<th scope="row">' . "avg" . "</th>";
                        echo '<td>Average</td>';
                        echo '<td>Rating</td>';
                        echo "<td>" . avgrating($rating) . "/5 </td>";
                        echo '</tr>';
                        echo "</tbody></table><br>";

                      ?>
                <br><br>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


  </body>
</html>
