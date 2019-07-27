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
  <link rel="stylesheet" href="main.css">
  <link
    href="https://fonts.googleapis.com/css?family=Cormorant+Infant|Gilda+Display|Raleway+Dots|Love+Ya+Like+A+Sister|Reenie+Beanie|Fredericka+the+Great|Shadows+Into+Light+Two|Major+Mono+Display|Bilbo|Architects+Daughter|Sacramento|Marck+Script|Thasadith|Open+Sans+Condensed:300"
    rel="stylesheet">
  <title>Web PL Project</title>

  <script type="text/javascript">
    function setFocus() // sets focus on the email input box
    {
      document.forms[0].elements[0].focus();
    }

    function validateInfo() { // checks if the user filled out all the fields correctly
      var email = document.getElementById("email").value;
      var password = document.getElementById("password").value;
      var password2 = document.getElementById("password2").value;
      if (email.length == 0) {
        document.getElementById("emailerror").innerHTML = "Please enter an email";
        document.getElementById("email").focus();
        return false;
      }
      else if (password.length == 0) {
        document.getElementById("passworderror").innerHTML = "Please enter a password";
        document.getElementById("password").focus();
        return false;
      }
      else if (password2.length == 0) {
        document.getElementById("password2error").innerHTML = "Please enter a password";
        document.getElementById("password2").focus();
        return false;
      }
      else if (password2 !== password) {
        document.getElementById("passworderror").innerHTML = "Passwords do not match!";
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
      <a class="navbar-brand" href="index.php"
        style="text-shadow: 0 0 10px #ff0fa2 , 0 0 10px #ffadc0 , 0 0 10px #ffadc0 , 0 0 10px #ff0fa2;">DeCo</a>
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
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true"
              aria-expanded="false">Category</a>
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

  <!-- Sign-up box -->
  <div class="container login" onsubmit="return(validateInfo())">
    <form  action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
      <span>
        <h4 style="text-align: center;color:#fff; font-family:'Raleway Dots', cursive; font-weight:bold">Welcome! Please
          sign up!</h4>
      </span>
      <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
          require("db-connect.php");
          //select username 
          $query = "SELECT username FROM users";
          $statement = $db->prepare($query);
          $statement->execute();
          $results = $statement->fetchAll();
          $usernamesindb = [];
          $truthbool = 0;
          foreach ($results as $value) {
            $usernamesindb = $value;
            foreach ($value as $item) {
              if ($item == $_POST["email"]) {
                $truthbool = 1;
                break;
              }
            }
          }
          if ($truthbool) {
            //username already taken
            echo '<h3 style="text-align: center;color:#fff; font-family:' . "'Raleway Dots'". ', cursive; font-weight:bold">';
            echo "I'm sorry that email has an account already! Try signing in! <br>";
            echo '</h3>';
          }
          
          else {
            $query = "INSERT INTO users VALUES (:username, :pass, :names)";
            $statement = $db -> prepare($query);
            $user = $_POST["email"];
            $password = $_POST["password"];
            $name = $_POST["displayname"];
            $statement->bindValue(':username', $user);
            $statement->bindValue(':pass',$password);
            $statement->bindValue(':names',$name);
            $statement->execute();
            $statement->closeCursor();
            //redirect to login
            header("Location: log-in.php");
          }
      }
      ?>
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="displayname" id="name" placeholder="John Doe">
      </div>
      <div class="form-group">
        <label for="email">Email address:</label>
        <input type="text" class="form-control" name="email" id="email" placeholder="Enter email">
        <div id="emailerror" class="error"></div>
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
        <div id="passworderror" class="error"></div>
      </div>
      <div class="form-group">
        <label for="password">Re-Enter Password</label>
        <input type="password" class="form-control" name="password2" id="password2" placeholder="Re-Enter Password">
        <div id="password2error" class="error"></div>
      </div>
      <div class="row ">
        <div class="col-md-6 ">
          <button type="submit" class="btn btn-primary" name="submit" value="Submit">submit</button>
        </div>
        <div class="col-md-6">
        </div>
      </div>
    </form>


  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


</body>

</html>