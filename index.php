<?php
error_reporting(0);

include("include/classes/session.php");
// if ($session->logged_in) {
$result = $database->clientdata($session->username);
$username  = ($result['username']);
$userlevel  = ($result['userlevel']);

if ($userlevel == 2) {
   $result2 = $database->setdata($session->username);
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
         margin-left: 30%;
         width: 65%;

      }

      a {
         padding: 10px;
      }

      @media screen and (max-width: 1440px) {
         body {
            background-size: 100% 100% !important;
         }
      }

      @media screen and (max-width: 1024px) {
         body {
            background-size: 100% 100% !important;
         }

         .center {
            margin-left: 22%;

         }

      }

      @media screen and (max-width: 992px) {
         body {
            background-size: 100% 100% !important;
         }
      }

      @media screen and (max-width: 768px) {
         body {
            background-size: 100% 100% !important;
         }
      }

      @media screen and (max-width: 425px) {
         body {
            background-size: 100% 100% !important;
         }
      }

      @media screen and (max-width: 375px) {
         body {
            background-size: 100% 100% !important;
         }
      }

      @media screen and (max-width: 320px) {
         body {
            background-size: 100% 100% !important;
         }
      }


      @media screen and (max-width: 992px) {
         a {
            display: block;
            padding: 10px;
         }

         .center {
            margin-top: 5%;
            margin-left: 25%;
         }

         img {
            width: 150px !important;
            height: 150px !important;
         }
      }

      @media screen and (min-width: 768px) and (max-width: 800px) {
         a {
            display: block;
            padding: 10px;
         }

         .center {
            margin-top: 5%;
            margin-left: 40%;
         }

         img {
            width: 150px !important;
            height: 150px !important;
         }
      }
   </style>
</head>

<body style=" background-repeat: no-repeat !important; background-position: top; height:100vh; background: linear-gradient(0deg, rgb(25 21 23 / 30%), rgb(0 0 0 / 30%)), url(juvenilezone.jpeg);">
   <?php include('navbar.php'); ?>
   <?php if ($userlevel == 1) { ?>
      <div class="" style="display: flex; justify-content:space-around;">
         <form action="process.php" method="POST" style="display: inline-block; position: absolute;  margin-top: 7%; ">
            <input type="hidden" value="<?php echo $username; ?>" name="user">
            <input type="submit" class="btn btn-danger" name="delete-data" value="Reset" style="width:250px !important;">
         </form>
         <div class="table-responsive col-md-8" style="margin-top: 20%;">
            <table class="table table-bordered " style="background-color: white;">
               <thead>
                  <tr>
                     <th colspan="4" style="text-align: center; font-size:25px;">Kids Proggress Detail</th>
                  </tr>
                  <tr>
                     <th>Username</th>
                     <th>ABC </th>
                     <th>Number(123) </th>
                     <th>Urdu </th>
                  </tr>
               </thead>
               <tbody>
                  <?php echo $database->groupdata("show_proggress", $username, "", "", ""); ?>

               </tbody>
            </table>
         </div>
      </div>
   <?php } ?>
   <?php if ($userlevel == 2) { ?>
      <div class="center">
         <a href="abc-sound.php"><img class="card-img-top" src="englishicon.jpeg" alt="English" style="width: 180px; height: 180px "></a>
         <a href="123-sound.php"><img class="card-img-top" src="numicon.jpeg" alt="Number" style="width: 180px; height: 180px"></a>
         <a href="urdu-sound.php"><img class="card-img-top" src="urduicon.jpeg" alt="Urdu" style="width: 180px; height: 180px"></a>
      </div>
   <?php } ?>

</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</html>
<?php
//  } else {
//    echo "UnAuthorized";
// header("Location: login.php");
// }
?>