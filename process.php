<?php

include("include/classes/session.php");

class Process
{

   function __construct()
   {
      global $session;

      if (isset($_POST['sublogin'])) {
         $this->procLogin();
      } else if (isset($_POST['subjoinguard'])) {
         $this->procRegisterguard();
      } else if (isset($_POST['updateprofile'])) {
         $this->procupdateprofile();
      } else if (isset($_POST['subjoinkid'])) {
         $this->procRegisterkid();
      } else if (isset($_POST['delete-kid'])) {
         $this->procDeletekid();
      } else if (isset($_POST['delete-data'])) {
         $this->procDeleteData();
      } else if (isset($_POST['subedit'])) {
         $this->procEditAccount();
      } else if ($session->logged_in) {
         $this->procLogout();
      } else {
         header("Location: login.php");
      }
   }

   function procLogin()
   {
      global $session, $form;
      $retval = $session->login($_POST['user'], $_POST['pass'], $_POST['CSRF_Code']);

      if ($retval) {
         $_SESSION['reguname'] = $_POST['user'];
         $_SESSION['regsuccess'] = true;
         header("Location: index.php?Success");
      } else {
         $_SESSION['reguname'] = $_POST['user'];
         $_SESSION['regsuccess'] = false;
         header("Location: login.php?Error");
      }
   }


   function procLogout()
   {
      global $session;
      $retval = $session->logout();
      header("Location: login.php");
   }


   function procRegisterguard()
   {
      global $session, $form;
      if (ALL_LOWERCASE) {
         $_POST['user'] = strtolower($_POST['user']);
      }
      $ulevel = 1;

      $retval = $session->register($_POST['user'], $_POST['pass'], $_POST['email'], $ulevel);


      if ($retval == 0) {
         $_SESSION['reguname'] = $_POST['user'];
         $_SESSION['regsuccess'] = true;
         header("Location: login.php?Success");
      } else if ($retval == 1) {
         $_SESSION['value_array'] = $_POST;
         $_SESSION['error_array'] = $form->getErrorArray();
         header("Location: signup.php?FormError");
      } else if ($retval == 2) {
         $_SESSION['reguname'] = $_POST['user'];
         $_SESSION['regsuccess'] = false;
         header("Location: signup.php?DbError");
      }
   }



   function procDeleteData()
   {
      global $session, $form, $database;

      $retval = $database->deleteData($_POST['user']);


      if ($retval == 0) {
         $_SESSION['reguname'] = $_POST['user'];
         $_SESSION['regsuccess'] = true;
         header("Location: index.php?Success");
      } else if ($retval == 1) {
         $_SESSION['value_array'] = $_POST;
         $_SESSION['error_array'] = $form->getErrorArray();
         header("Location: index.php?Success");
      } else if ($retval == 2) {
         $_SESSION['reguname'] = $_POST['user'];
         $_SESSION['regsuccess'] = false;
         header("Location: index.php?Success");
      }
   }


   function procDeletekid()
   {
      global $session, $form, $database;

      $retval = $database->delete($_POST['user']);


      if ($retval) {
         $_SESSION['reguname'] = $_POST['user'];
         $_SESSION['regsuccess'] = true;
         header("Location: kid-profile.php?Success");
      } else if ($retval == 1) {
         $_SESSION['value_array'] = $_POST;
         $_SESSION['error_array'] = $form->getErrorArray();
         header("Location: kid-profile.php?Success");
      } else if ($retval == 2) {
         $_SESSION['reguname'] = $_POST['user'];
         $_SESSION['regsuccess'] = false;
         header("Location: kid-profile.php?Success");
      }
   }

   function procRegisterkid()
   {
      global $session, $form;
      if (ALL_LOWERCASE) {
         $_POST['user'] = strtolower($_POST['user']);
      }
      $ulevel = 2;
      $retval = $session->register($_POST['user'], $_POST['pass'], $_POST['email'], $ulevel);


      if ($retval == 0) {
         $_SESSION['reguname'] = $_POST['user'];
         $_SESSION['regsuccess'] = true;
         header("Location: kid-profile.php?Success");
      } else if ($retval == 1) {
         $_SESSION['value_array'] = $_POST;
         $_SESSION['error_array'] = $form->getErrorArray();
         header("Location: kid-profile.php?Error");
      } else if ($retval == 2) {
         $_SESSION['reguname'] = $_POST['user'];
         $_SESSION['regsuccess'] = false;
         header("Location: kid-profile.php?DbError");
      }
   }

   function procupdateprofile()
   {
      global $session, $form, $database;

      $retval = $session->updateprofile($_POST['email'], $_POST['pass']);

      if ($retval == 0) {
         $_SESSION['reguname'] = $_POST['username'];
         $_SESSION['regsuccess'] = true;
         header("Location: profile.php?Updated");
      } else if ($retval == 1) {
         $_SESSION['value_array'] = $_POST;
         $_SESSION['error_array'] = $form->getErrorArray();
         header("Location: profile.php?Error");
      } else if ($retval == 2) {
         $_SESSION['reguname'] = $_POST['user'];
         $_SESSION['regsuccess'] = false;
         header("Location: profile.php?DBError");
      }
   }



   function procEditAccount()
   {
      global $session, $form;

      $retval = $session->editAccount($_POST['curpass'], $_POST['newpass'], $_POST['email']);


      if ($retval) {
         $_SESSION['useredit'] = true;
         header("Location: " . $session->referrer);
      } else {
         $_SESSION['value_array'] = $_POST;
         $_SESSION['error_array'] = $form->getErrorArray();
         header("Location: " . $session->referrer);
      }
   }
};


$process = new Process;
