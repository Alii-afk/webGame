<?php
include("include/classes/session.php");

$result = $database->clientdata($session->username);
$username  = ($result['username']);
$userlevel  = ($result['userlevel']);

$jumostp = rand(100000, 999999);
$jumo1 = $jumostp;
$_SESSION['CSRF_Code'] =    $jumo1;
$jumo = md5($_SESSION['CSRF_Code'] . '8j5j&*&K5jrffgF9wAJDIH' . 'JKHds998954(*)(*dfkjll');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        .center {

            margin-top: 5%;



        }
    </style>
</head>

<body style="background-image: url('4668997.jpg'); background-size: cover; background-repeat: no-repeat; background-position: top; height:100vh;">
    <?php include('navbar.php'); ?>
    <div class="center " style="display: flex; justify-content:space-around;">
        <div class="table-responsive col-md-8">
            <a href="add-kid.php" class="btn btn-warning" style="float: right; margin-bottom: 10px; color: black !important; font-weight: 600 !important;">Add New</a>
            <table class="table table-bordered " style="background-color: white;">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: center; font-size:25px;">Kids Account</th>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th style="text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $database->groupdata("show_kids", $username, "", "", ""); ?>

                </tbody>
            </table>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</html>