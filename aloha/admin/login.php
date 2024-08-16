<?php
require_once("../includes/initialize.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Aloha Nui Hotel</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
 <?php
if (admin_logged_in()) {
    ?>
    <script type="text/javascript">
        redirect('progressbar.php');
    </script>
    <?php
}

if (isset($_POST['btnlogin'])) {
    // Form has been submitted
    $uname = trim($_POST['email']);
    $upass = trim($_POST['pass']);
    
    $h_upass = sha1($upass);
    
    // Check if the email and password are empty
    if ($uname == '' OR $upass == '') {
        ?>
        <script type="text/javascript">
            alert("Invalid Username and Password!");
        </script>
        <?php
    } else {
        // Create a new user object
        $user = new User();
        // Authenticate the user
        $res = $user::AuthenticateUser($uname, $h_upass);
        
        if ($res == true) {
            // Authentication successful
            // Insert login record into tbladminlogs table using existing database connection
            $loginTime = date('Y-m-d H:i:s'); // Get current login time
            
            // Insert the login record into tbladminlogs
            $query = "INSERT INTO tbladminlogs (uname, logintime) VALUES ('$uname', '$loginTime')";
            $mydb->setQuery($query);

            // After successfully inserting the login record into tbladminlogs

// After successfully inserting the login record into tbladminlogs
// After successfully inserting the login record into tbladminlogs

if ($mydb->executeQuery()) {
    // Manually fetch the last inserted ID
    $query = "SELECT LAST_INSERT_ID() AS last_id";
    $mydb->setQuery($query);
    $results = $mydb->loadResultList(); // Assuming loadResultList() method returns multiple results

    if (!empty($results)) {
        // If there are multiple results, loop through each result
        foreach ($results as $result) {
            // Access the object property correctly
            $lastInsertId = $result->last_id;
            // Set the loginid in the session
            $_SESSION['loginid'] = $lastInsertId;

            // Output loginid to the console for debugging
            ?>
            <script type="text/javascript">
                console.log("Login ID:", <?php echo $lastInsertId; ?>);
            </script>
            <?php

            message("Insert successful!", "success");
        }
    } else {
        message("Failed to retrieve last insert ID!", "error");
    }
} else {
    message("Failed to insert!", "error");
    // Output database error for debugging
    ?>
    <script type="text/javascript">
        console.error("Failed to insert login record!");
    </script>
    <?php
}


            
            // Redirect to progressbar.php
            ?>
            <script type="text/javascript">
                window.location = "index.php";
            </script>
            <?php
        } else {
            // Authentication failed
            ?>
            <script type="text/javascript">
                alert("Username or Password Not Registered! Contact Your administrator.");
                window.location = "index.php";
            </script>
            <?php
        }
    }
} else {
    $email = "";
    $upass = ""; 
}
?>


<div class="center-div">
    <div class="login-panel panel panel-default">
        <div class="panel-heading">
            <!-- Add your logo here -->
          
            <img src="../images/image/login.png" alt="Logo" class="logo">
        </div>
        <div class="panel-body">
    
            <form role="form" method="POST" action="login.php">
                <fieldset>
                    <div class="form-group">
                        <input class="form-control" placeholder="Username" name="email" type="text" autofocus>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Password" name="pass" type="password" value="">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input name="remember" type="checkbox" value="Remember Me">Remember Me
                        </label>
                    </div>
                    <!-- Change this to a button or input when using this as a form -->
                    <button type="submit"  name="btnlogin" class="btn btn-lg btn-success btn-block">Login</button>
                </fieldset>
            </form>
        </div>
    </div>
</div>

<style>
/* Heading */
.login-panel .panel-body h3{
 font-family:Georgia,Times,'Times New Roman',serif;
 font-size:23px;
 text-align:center;
 padding-bottom:16px;
}

/* Logo */
.login-panel .panel-heading img{
 height:108px;
}

/* Panel heading */
.center-div .login-panel .panel-heading{
 transform:translatex(0px) translatey(0px);
 padding-bottom:0px;
}
/* Login panel */
.center-div .login-panel{
 margin-bottom:0px;
 transform:translatex(0px) translatey(0px);
 height:94px !important;
 overflow:visible;
 min-width:29px;
 max-height:312px;
}


/* Logo */
.login-panel .panel-heading img{
 max-width:332px;
 max-height:67px;
}

/* Logo */
.center-div .login-panel .panel-heading img{
 width:416px !important;
}


.logo {
  
    margin: 0 auto; /* Center the logo horizontally */
    display: block; /* Ensure it's treated as a block element */
}

        .center-div {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
/* Login panel */
.center-div .login-panel{
 width:367px;
 height:255px;
}

body{
 background-image:url("../images/image/InteriorView.jpeg");
 background-size:cover;
}
.center-div .login-panel .panel-body{
 height:196px;
}

/* Login panel */
.center-div .login-panel{
 height:385px !important;
}




    </style>
  </body>
</html>
