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

function checkErrors($username, $email, $pass, $passconf, $connection)
{
    $sql1 = "SELECT * FROM users WHERE username = '{$username}'";
    $sql2 = "SELECT * FROM users WHERE email = '{$email}'";

    $result1 = mysqli_query($connection, $sql1) or die("Query Failed.");
    $result2 = mysqli_query($connection, $sql2) or die("Query Failed.");

    if ($pass !== $passconf) {
        showAlert("Passwords did not match.");
        return true;
    } elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        showAlert("Only letters and numbers are allowed in Username.");
        return true;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        showAlert("Incorrect email.");
        return true;
    } elseif (mysqli_num_rows($result1) > 0) {
        showAlert("Username already exists.");
        return true;
    } elseif (mysqli_num_rows($result2) > 0) {
        showAlert("Email already exists.");
        return true;
    } else {
        return false;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- Font awesome -->
  
    <!-- Custom style -->
    <link rel="stylesheet" href="style.css">
</head>

<body style="background-color: gray">
    <div id="admin-content">
        <div class="container d-flex justify-content-center offset-4">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="admin-heading">Create new account</h1>
                </div>
                <div class="col-md-offset-3 col-md-6">

                    <?php
                    if (isset($_POST['save'])) {
                        if (empty($_FILES['userpic']['name'])) {
                            $file_name = $_POST['old_pic'];
                        } else {
                            $errors = array();

                            $file_name = $_FILES['userpic']['name'];
                            $file_size = $_FILES['userpic']['size'];
                            $file_tmp = $_FILES['userpic']['tmp_name'];
                            $file_type = $_FILES['userpic']['type'];
                            $exp = explode('.', $file_name);
                            $file_ext = end($exp);

                            $extensions = array("jpeg", "jpg", "png");

                            if (in_array($file_ext, $extensions) === false) {
                                $errors[] = "This extension file not allowed, Please choose a JPG or PNG file.";
                            }

                            if ($file_size > 10485750) {
                                $errors[] = "File size must be 10mb or lower.";
                            }

                            if (empty($errors) == true) {
                                move_uploaded_file($file_tmp, "images/" . $file_name);
                            } else {
                                print_r($errors);
                                die();
                            }
                        }

                        if (!checkErrors($_POST['user'], $_POST['email'], $_POST['password'], $_POST['passconfirm'], $conn)) {
                            $fname = mysqli_real_escape_string($con, $_POST['fname']);
                            $lname = mysqli_real_escape_string($con, $_POST['lname']);
                            $user = mysqli_real_escape_string($con, $_POST['user']);
                            $email = mysqli_real_escape_string($con, $_POST['email']);
                            $password = mysqli_real_escape_string($con, md5($_POST['password']));

                            $sql1 = "INSERT INTO users (first_name,last_name,username,password,email)
                            VALUES ('{$fname}','{$lname}','{$user}','{$password}','{$email}')";

                            if (mysqli_query($con, $sql1)) {
                                $sql2 = "SELECT user_id, username, role FROM user WHERE username = '{$user}' AND password= '{$password}'";
                                $result = mysqli_query($con, $sql2) or die("Query Failed.");
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $_SESSION["username"] = $row['username'];
                                        $_SESSION["user_id"] = $row['user_id'];
                                        $_SESSION["user_role"] = $row['role'];
                                    }
                                }
                                header("Location: {$hostname}");
                            } else {
                                showAlert("Something went wrong. Please try again.");
                            }
                        }
                    }
                    ?>

                    <!-- Form Start -->
                    <form style="background-color:green "  action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                        <div class="form-group">
                            <label>Profile Picture</label>
                            <input type="file" name="userpic">
                            <img src="images/<?php echo $row['userpic']; ?>">
                            <input type="hidden" name="old_pic" value="<?php echo $row['userpic']; ?>">
                        </div>
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="user" class="form-control" placeholder="Username" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" name="passconfirm" class="form-control" placeholder="Confirm Password" required>
                        </div>
                        <input type="submit" name="save" class="btn btn-primary" value="SIGN UP" required />
                    </form>
                    <!-- Form End-->
                </div>
            </div>
        </div>
    </div>