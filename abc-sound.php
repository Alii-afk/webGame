<?php
include("include/classes/session.php");

$result = $database->clientdata($session->username);
$username  = ($result['username']);
$userlevel  = ($result['userlevel']);

if ($userlevel == 2) {
    $result2 = $database->adddata($username, "abc");
}
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
            margin: auto;
            margin-top: 5%;
            width: 80%;

        }

        @media screen and (max-width: 1440px) {
            body {
                background-size: 100% 200% !important;
            }
        }

        @media screen and (max-width: 1024px) {
            body {
                background-size: 100% 170% !important;
            }

            .center {
                margin-top: 8% !important;
            }
        }

        @media screen and (max-width: 992px) {
            body {
                background-size: 100% 160% !important;
            }

            .center {
                margin-top: 8% !important;
            }
        }

        @media screen and (max-width: 768px) {
            body {
                background-size: 100% 120% !important;
            }

            .center {
                margin-top: 10% !important;
            }
        }

        @media screen and (max-width: 425px) {
            body {
                background-size: 100% 100% !important;
            }

            .center {
                margin-top: 16% !important;
            }
        }

        @media screen and (max-width: 375px) {
            body {
                background-size: 100% 100% !important;
            }

            .center {
                margin-top: 18% !important;
            }
        }

        @media screen and (max-width: 320px) {
            body {
                background-size: 100% 100% !important;
            }

            .center {
                margin-top: 20% !important;
            }
        }
    </style>
</head>

<body style="background-image: url('abc-background.jpg');  background-size: cover;   background-repeat: repeat; background-position: top; height:100vh;">
    <a href="index.php" class="btn" style="position: absolute; top:2%; left:12%; color:white; background-color: maroon; width:120px; "><b>Back</b></a>
    <div class="center">
        <?php
        for ($i = 1; $i <= 26; $i++) { ?>
            <img src="drawable/sound-abc/<?php echo $i . '.png'; ?>" alt="" id="<?php echo $i; ?>" style="margin:5px;" width="17%" onclick="playsound(this)">
        <?php }
        ?>
    </div>
</body>

<script>
    function playsound(element) {
        var id = element.id;
        var audio = new Audio("Audio/audio-abc/" + id + ".mp3");
        audio.loop = false;
        audio.play();
    }
</script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</html>