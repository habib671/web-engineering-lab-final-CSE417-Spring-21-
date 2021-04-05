<?php
include "config.php";
session_start();

if (isset($_SESSION["username"])) {
    header("Location: {$hostname}/user.php");
}

function showAlert($message)
{
    echo '<div class="alert alert-danger" role="alert"><strong>WARNING!</strong> ' . $message . '</div>';
}

function checkErrors($username, $pass, $connection)
{
    $passhash = md5($pass);
    $sql1 = "SELECT * FROM users WHERE username = '{$username}' OR email = '{$username}'";
    $sql2 = "SELECT * FROM users WHERE username = '{$username}' OR email = '{$username}' AND password = '{$passhash}'";

    $result1 = mysqli_query($connection, $sql1) or die("Query 1 Failed.");
    $result2 = mysqli_query($connection, $sql2) or die("Query 2 Failed.");

    if (mysqli_num_rows($result1) < 1) {
        showAlert("Email/Username not found.");
        return true;
    } elseif (mysqli_num_rows($result2) < 1) {
        showAlert("Wrong password.");
        return true;
    } else {
        return false;
    }
}
?>
<!doctype html>
<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- Font awesome -->

    <!-- Custom style -->
    <link rel="stylesheet" href="style.css">
</head>
<html>

<body style="background-color:gray" >
    <div id="wrapper-admin" class="body-content">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-4 col-md-4">
                    <img class="logo" src="../images/logo.png">
                </div>
                <div class="col-md-offset-3 col-md-6">
                    <h3 class="heading">User Log In</h3>
                    <?php
                    if (isset($_POST['login'])) {
                        if (checkErrors($_POST['username'], $_POST['password'], $con)) {
                            showAlert("Something went wrong. Please try again.");
                        } else {
                            $username = mysqli_real_escape_string($con, $_POST['username']);
                            $password = md5($_POST['password']);

                            $sql = "SELECT user_id, username FROM users WHERE username = '{$username}' OR email = '{$username}' AND password= '{$password}'";

                            $result = mysqli_query($con, $sql) or die("Query 3 Failed.");

                            if (mysqli_num_rows($result) > 0) {

                                while ($row = mysqli_fetch_assoc($result)) {
                                    session_start();
                                    $_SESSION["username"] = $row['username'];
                                    $_SESSION["user_id"] = $row['user_id'];

                                    header("Location: {$hostname}/user.php");
                                }
                            } else {
                                showAlert("Enter correct Email/Username and Password.");
                            }
                        }
                    }
                    ?>
                    <!-- Form Start -->
                    <form style="background-color:yellow" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="" required>
                        </div>
                        <input type="submit" name="login" class="btn btn-primary" value="LOG IN" />
                    </form>
                    <!-- /Form  End -->
                </div>
            </div>
        </div>
    </div>

</body>

</html>