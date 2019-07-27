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

<!-- Functions dealing with log-in -->
    <script type="text/javascript">
        function setFocus() // Sets focus on the email input box
        {
          document.forms[0].elements[0].focus();
        }

        function checkuser() { // checks if the user entered a valid email address
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
              <a class="nav-link" href="log-in.php">Log in</a>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <!-- Log in box -->
    <div class="container login">
    <?php
      header('Access-Control-Allow-Origin: http://localhost:4200');
      header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding');
      //if cookie is set go straight to mainuser
      $data = json_decode(file_get_contents("php://input"));
      echo "The data is: " . $data;
      
      if (isset($_COOKIE["user"])) {
        header("Location: mainuser.php");
      }
      //if not enter loop
      else if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require('db-connect.php');
        $query = "SELECT * FROM users";
        $statement = $db->prepare($query);
        $statement->execute();

        // fetchAll() returns an array for all of the rows in the result set
        $results = $statement->fetchAll();

        // closes the cursor and frees the connection to the server so other SQL statements may be issued
        $statement->closecursor();
        $email = $_REQUEST["email"];
        $password = $_REQUEST["password"];
        $logged = 0;
        //for all items in teh results array
        foreach ($results as $result)
        {
        //set cookies with username and mpassword then send the user to mainuser.php
        if($email == $result['username'] && $password == $result['pass']) {
        setcookie("user",$result["username"], time() + 3600);
        setcookie("pwd", md5($password), time() + 3600);
        $_SESSION['user'] = $result['username'];
        header("Location: mainuser.php");
        $logged = 1;
        }
      }
      if ($logged == 0) {
        //error message if no user found
        echo "No User Found! Please make an account by pressing the New User Button!";
      }
    }
    ?>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="form-group">
                <label for="email">Email address:</label>
                <input type="text" class="form-control" name="email" id="email" placeholder="Enter email" required onblur="checkuser()">
                <div id="emailerror" class="error"></div>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required onblur="checkpass()">
                <div id="passworderror" class="error"></div>
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