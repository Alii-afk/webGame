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
            margin: auto;
            width: 50%;
            border: 3px solid white;
            padding: 30px;
            margin-top: 10%;
            border-radius: 20px;
            background-color: #0264D6;
            color: white;

        }

        @media screen and (max-width: 992px) {
            .center {
                margin: auto;
                width: 75%;
                border: 3px solid white;
                padding: 30px;
                margin-top: 10%;
                border-radius: 20px;
                background-color: #0264D6;
                color: white;

            }

            .image {
                display: none;
            }

            .image2 {
                display: none;
            }
        }
    </style>
</head>

<body style="background-image: url('4668997.jpg'); background-size: cover; background-repeat: no-repeat; background-position: top; height:100vh;">
    <div style="position: absolute; top: 1%; left:20%" class="image2">
        <img src="bunny.png" alt="" width="50%">
    </div>
    <div class="center">
        <form action="process.php" method="POST">
            <div class="form-group">
                <label for="exampleInputEmail1">
                    <h4>Sign Up</h4>
                </label>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1"><b>UserName:</b></label>
                <input class="form-control" type="text" name="user" placeholder="UserName" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1"><b>Email:</b></label>
                <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"><b>Password:</b></label>
                <input type="password" class="form-control" name="pass" id="exampleInputPassword1" placeholder="Password" required>
            </div>
            <div class="form-group" style="display:flex; justify-content: end; margin: 0px !important;">
                <input type="submit" class="btn" style="background-color: brown; color: white; font-weight: 600; " name="subjoinguard" value="Sign Up">
            </div>
            <a href="login.php"><small id="emailHelp" class="form-text text-light">Click to Login.</small></a>

        </form>
    </div>
    <div style="position: absolute; top: 3%; right:3%" class="image">
        <img src="monkey.png" alt="" width="40%">
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</html>