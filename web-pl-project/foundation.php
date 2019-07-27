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
    function changeColor(row) {
      var currrow = document.getElementById(row);
      currrow.style.color = '#FFF';
    }
    function resetColor(row) {
      var currrow = document.getElementById(row);
      currrow.style.color = '#000';
    }
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

    <!-- Time display -->
    <div class="container itemdescription">
        <br>
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

        <!-- Product List -->
        <h3 style="text-align: center;padding-top:5px;font-family: 'Fredericka the Great', cursive;">Sample Product</h3>
        <table class="table table-hover">
            <thead>
                <tr>
                <th scope="col">Rank</th>
                <th scope="col">Name</th>
                <th scope="col">Company</th>
                <th scope="col">Rating</th>
            </a>
                </tr>
            </thead>
            <!-- Individual Products -->
            <tbody>
              <?php
                require('db-connect.php');
                //select all foundations items
                $query = "SELECT ProductName, BrandName, Votes, TVotes, CDPHId, CSFId, 	SubCategoryId, 	ChemicalId FROM itemdescription WHERE SubCategory LIKE '%foundation%' ORDER BY Votes/TVotes DESC";
                $statement = $db->prepare($query);
                $statement->execute();
                $results = $statement->fetchAll();
                $counter = 0;
                foreach ($results as $result) {
                  //loop through the result array
                  if ($counter < 100) {
                    //loop through only the first 100 elements of the array
                    $CDPHId = $result["CDPHId"];
                    $CSFId = $result["CSFId"];
                    $SubCategoryId = $result["SubCategoryId"];
                    $ChemicalId = $result["ChemicalId"];
                    echo '<tr id="row' . ($counter + 1) . '" onmouseover="changeColor(' . "'row" . ($counter + 1) . "')" . '" onmouseout="resetColor(' . "'row" . ($counter + 1) . "')" .'"onclick="location.href=' . "'productinfo.php?CDPHId=$CDPHId&CSFId=$CSFId&SubCategoryId=$SubCategoryId&ChemicalId=$ChemicalId';" . '" style="cursor:pointer">';;
                    echo '<th scope="row">' . ($counter + 1) . "</th>";
                    echo '<td>' . $result["ProductName"] . '</td>';
                    echo '<td>' . $result["BrandName"] . '</td>';
                    //Calculate the ratings in terms of x/5
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
              ?>
                </tr>
            </tbody>
        </table>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


  </body>
</html>
