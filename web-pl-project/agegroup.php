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

    <!-- Background image and title/menu bar -->
</head>

<body background="image/brush.jpg">
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
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">Category</a>
                        <!-- Dropdown menu -->
                        <div class="dropdown-menu" aria-labelledby="dropdown01">
                            <a class="dropdown-item" href="skintype.php">Skin Type</a>
                            <a class="dropdown-item" href="agegroup.php">Age Group</a>
                            <a class="dropdown-item" href="mostpopular.php">Most Popular</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <?php
                        //display cookie username
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
    <!-- Display Sample Links -->
    <div class="agegroup">
        <h3 style="text-align: center; font-size: 40px; margin-bottom: 20px;">Age Group</h3>
        <p>Recommendation of products based on the user's age group
            such as 10s, 20s, 30s, 40s, 50s, etc.
        </p>
        <ol>
            <li><a id="link" href="foundationex1.html">Product for Age Group 20: Luminous Silk Foundation</a></li>
            <li><a id="link" href="foundationex2.html">Product for Age Group 30: Double Wear Stay-in-Place Makeup</a></li>
            <li><a id="link" href="foundationex2.html">Product for Age Group Ex. 3</a></li>
            <li><a id="link" href="foundationex2.html">Product for Age Group Ex. 4</a></li>
            <li><a id="link" href="foundationex2.html">Product for Age Group Ex. 5</a></li>
        </ol>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>