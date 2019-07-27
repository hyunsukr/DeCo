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

<!-- Functions dealing with log-in -->
    <script type="text/javascript">
        function setFocus() // Sets focus on the email input box
        {
          document.forms[0].elements[0].focus();
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
              <a class="nav-link" href="log-in.php">
              <?php
                if (isset($_COOKIE["user"])) {
                  //display cookie data
                  $cookiedata = $_COOKIE["user"];
                  if ($cookiedata == "hyunsukr@gmail.com") {
                    echo "Log-Out";
                  }
                }
              ?>

              </a>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <!-- Log in box -->
    <div class="container category1" style="overflow-wrap: break-word;">
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                require('db-connect.php');
                $file = fopen($_FILES['file']['tmp_name'],'r');
                $names = [];
                $counter = 0;
                //while (!feof($file)) {
                  //read in 50,000 entries 
                while ($counter < 50000) {
                  $contents = fgetcsv($file);
                  if(empty($names)) {
                    //drop table then make a new table
                    $query = "DROP TABLE itemdescription";
                    $statement = $db->prepare($query);
                    $statement->execute();
                    $statement->closeCursor();
                    $query = "CREATE TABLE IF NOT EXISTS itemdescription (";
                    $names = $contents;
                    foreach ($names as $values) {
                      if ($values === end($names)) {
                        $query = $query . $values . " VARCHAR(50),";
                        $query = $query . "Age" . " INT,";
                        $query = $query . "Votes" . " INT,";
                        $query = $query . "TVotes" . " INT,";
                        $pk = "PRIMARY KEY (CDPHId, CSFId, SubCategoryId, ChemicalId)";
                        $query = $query . $pk . ");";
                        $statement = $db->prepare($query);
                        $statement->execute();
                        $statement->closeCursor();
                      }
                      else {
                        $query = $query . $values . " VARCHAR(50),";
                      }
                    }
                  }
                  else {
                    $counter = $counter + 1;
                    //insert all the data
                    $query = "INSERT INTO itemdescription VALUES (";
                    if (!is_array($contents)) {
                      echo $contents . "<br><br>";
                    }
                    foreach ($contents as $value) {
                      if ($value === end($contents)) {
                        if (end($contents) === "") {
                          echo "Last is none";
                        }
                        $query = $query . "'" . $value . "', " . mt_rand(10, 80) . "," . 0 . ", " . 0 . ")";
                        $statement = $db -> prepare($query);
                        $statement->execute();
                        $statement->closeCursor();
                        if (sizeof($contents) < 22) {
                          echo $query ."<br><br>";
                        }
                      }
                      else {
                        $query = $query . "'" . $value . "', ";
                      }
                    }
                  }
                }
                fclose($file);
            }
        ?>
        <!-- Upload the file -->
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="file"> Upload a File:</label>
                <input type="file" name="file" id="file" accept=".csv">
            </div>

            <!-- Buttons -->
            <div class="row">
                <div class="col-md-6 ">
                  <button type="submit" class="login-button form-control" name="submit" value="Submit" >submit</button>
                </div>
                <div class="col-md-6">
                    <a href="newuser.php" class="login-button form-control">New User?</a>
                </div>
            </div>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


  </body>
</html>
