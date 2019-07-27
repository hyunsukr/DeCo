<?php
// php code to get teh data from the angular web app
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // try commenting out the header setting to experiment how the back end refuses the request
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
}
else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // try commenting out the header setting to experiment how the back end refuses the request
    header('Access-Control-Allow-Origin: http://localhost:4200');
    header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding');
    header('Access-Control-Allow-Credentials: true');
    header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");

    // retrieve data from the request
    $pass_ang= $_GET["password"];
    $email = $_GET["email"];
    $json_password = json_encode($pass_ang);
    $json_email = json_encode($email);

    require('db-connect.php');
    $query = "SELECT * FROM users";
    $statement = $db->prepare($query);
    $statement->execute();

    // fetchAll() returns an array for all of the rows in the result set
    $results = $statement->fetchAll();

    // closes the cursor and frees the connection to the server so other SQL statements may be issued
    $statement->closecursor();
    //for all items in teh results array
    
    foreach ($results as $result)
    {
    //set cookies with username and mpassword then send the user to mainuser.php
       $db_user = $result['username'];
       $db_pass = $result['pass'];
        if($email == $db_user) {
            if($pass_ang == $db_pass){

                setcookie("user", $result['username'], time() + 3600);
                setcookie("pwd", md5($password), time() + 3600);

                echo $json_email;

            }
        }
    }
    // echo $json_email;
    // if ($password) {
    //     return "TrueTrueTrueTrueTrueTrueTrueTrueTrueTrueTrueTrue";
    // }
    // if ($json_email == "hyunsukr@gmail.com") {
    //     echo True;
    // }
    // echo False;
     //echo "Done";
    // //echo $postdata;
    // $request = json_decode($postdata);
    // echo $postdata;
    // echo gettype($request);
    // echo gettype($postdata);

    // echo "Size of: " . sizeof($request);

    // $data = [];
    // foreach ($request as $k => $v)
    // {
    // $data[0][$k] = $v;
    // }

    // // sent response (in json format) back to the front end
    // echo json_encode(['content'=>$data]);

    // process data 
    // (this example simply extracts the data and restructures them back) 
    //$request = json_decode($postdata);

    //echo $request;
    }
?>