<?php

include("constants.php");

class MySQLDB
{
   var $connection;
   var $num_active_users;
   var $num_active_guests;
   var $num_members;

   function __construct()
   {

      $this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME) or die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());


      $this->num_members = -1;

      if (TRACK_VISITORS) {

         $this->calcNumActiveUsers();


         $this->calcNumActiveGuests();
      }
   }


   function confirmUserPass($username, $password)
   {

      $username = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $username))));
      $password = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $password))));




      $q = "SELECT password FROM " . TBL_USERS . " WHERE username = '$username'";
      $result = mysqli_query($this->connection, $q);
      if (!$result || (mysqli_num_rows($result) < 1)) {
         return 1;
      }


      $dbarray = mysqli_fetch_array($result);
      $dbarray['password'] = stripslashes($dbarray['password']);
      $password = stripslashes($password);


      if ($password == $dbarray['password']) {
         return 0;
      } else {
         return 2;
      }
   }


   function confirmUserID($username, $userid)
   {
      $username = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $username))));
      $userid = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $userid))));



      $q = "SELECT userid FROM " . TBL_USERS . " WHERE username = '$username'";
      $result = mysqli_query($this->connection, $q);
      if (!$result || (mysqli_num_rows($result) < 1)) {
         return 1;
      }


      $dbarray = mysqli_fetch_array($result);
      $dbarray['userid'] = stripslashes($dbarray['userid']);
      $userid = stripslashes($userid);


      if ($userid == $dbarray['userid']) {
         return 0;
      } else {
         return 2;
      }
   }


   function usernameTaken($username)
   {
      $username = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $username))));

      $q = "SELECT username FROM " . TBL_USERS . " WHERE username = '$username'";
      $result = mysqli_query($this->connection, $q);
      return (mysqli_num_rows($result) > 0);
   }

   function setdata($username)
   {
      $username = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $username))));

      $q = "SELECT * FROM track_game WHERE username = '$username' AND time_end = 0";
      $result = mysqli_query($this->connection, $q);
      if (!$result || (mysqli_num_rows($result) < 1)) {
         return NULL;
      }
      $num_rows = mysqli_num_rows($result);

      if (!$result || ($num_rows < 0)) {
         echo "";
         return;
      }
      if ($num_rows == 0) {
         echo "";
         return;
      }
      $time = time();
      for ($i = 0; $i < $num_rows; $i++) {

         mysqli_data_seek($result, $i);
         $row = mysqli_fetch_row($result);

         $total = $time - $row[3];
         $q1 = "UPDATE `track_game` SET `time_end`='$time', `total_time`='$total' WHERE `id` = '$row[0]'";
         mysqli_query($this->connection, $q1);
      }
   }

   function adddata($username, $game)
   {
      $username = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $username))));
      $time = time();
      $q = "INSERT INTO `track_game`(`username`, `game`, `time_start`, `time_end`) VALUES ('$username','$game','$time','0')";
      mysqli_query($this->connection, $q);
   }



   function usernameBanned($username)
   {
      $username = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $username))));

      $q = "SELECT username FROM " . TBL_BANNED_USERS . " WHERE username = '$username'";
      $result = mysqli_query($this->connection, $q);
      return (mysqli_num_rows($result) > 0);
   }


   ////// START Custom Functions


   function clientdata($username)
   {
      $username = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $username))));
      $q = "SELECT * FROM users where username='$username'";
      $result = mysqli_query($this->connection, $q);

      if (!$result || (mysqli_num_rows($result) < 1)) {
         return NULL;
      }

      $dbarray = mysqli_fetch_array($result);
      return $dbarray;
   }

   function addNewUser($username, $password, $email, $ulevel)
   {
      global $session;

      $username_login = $session->username;
      $username = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $username))));
      $password = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $password))));
      $email = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $email))));

      $time = time();

      if ($ulevel == 1) {
         $q = "INSERT INTO `users` (`username`, `password`, `userid`, `userlevel`, `email`, `timestamp`, `parent_directory`)  VALUES ('$username', '$password', '0', '$ulevel', '$email', '$time', 'admin')";
         return mysqli_query($this->connection, $q);
      }
      if ($ulevel == 2) {
         $q = "INSERT INTO `users` (`username`, `password`, `userid`, `userlevel`, `email`, `timestamp`, `parent_directory`)  VALUES ('$username', '$password', '0', '$ulevel', '$email', '$time', '$username_login')";
         return mysqli_query($this->connection, $q);
      }
   }



   function updateUserField($username, $field, $value)
   {
      $username = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $username))));
      $field = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $field))));
      $value = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $value))));
      $q = "UPDATE " . TBL_USERS . " SET " . $field . " = '$value' WHERE username = '$username'";
      return mysqli_query($this->connection, $q);
   }

   function delete($username)
   {
      $username = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $username))));
      $q = "DELETE FROM `users` WHERE `username` = '$username'";
      return mysqli_query($this->connection, $q);
   }

   function deleteData($username)
   {
      $username = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $username))));

      $q = "SELECT * FROM users WHERE parent_directory = '$username'";
      $result = mysqli_query($this->connection, $q);
      if (!$result || (mysqli_num_rows($result) < 1)) {
         return NULL;
      }
      $num_rows = mysqli_num_rows($result);

      if (!$result || ($num_rows < 0)) {
         echo "";
         return;
      }
      if ($num_rows == 0) {
         echo "";
         return;
      }
      for ($i = 0; $i < $num_rows; $i++) {

         mysqli_data_seek($result, $i);
         $row = mysqli_fetch_row($result);
         $user = $row[0];
         $q1 = "DELETE FROM `track_game` WHERE `username` = '$user'";
         mysqli_query($this->connection, $q1);
      }
      return 0;
   }

   function groupdata($type, $var1, $var2, $var3, $CSRF_Code)
   {
      $type = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $type))));
      $CSRF_Code = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $CSRF_Code))));

      $jumo2 = md5($_SESSION['CSRF_Code'] . '8j5j&*&K5jrffgF9wAJDIH' . 'JKHds998954(*)(*dfkjll');

      if ($CSRF_Code == $jumo2) {
         // in CKRF

         if ($type == "stp_fieldset") {
            $q = "SELECT username FROM users order by username ASC";
         }


         // End in CKRF
      }



      // Out of CKRF
      if ($type == "stp_fieldset_more") {
         $q = "SELECT username FROM users order by username ASC";
      }

      if ($type == "show_kids") {
         $q = "SELECT * FROM users where userlevel = 2 AND parent_directory = '$var1' order by username ASC";
      }
      if ($type == "show_proggress") {
         $q = "SELECT * FROM users where userlevel = 2 AND parent_directory = '$var1' order by username ASC";
      }



      //start query process



      $result = mysqli_query($this->connection, $q);
      $num_rows = mysqli_num_rows($result);
      if (!$result || ($num_rows < 0)) {
         echo "";
         return;
      }
      if ($num_rows == 0) {
         echo "";
         return;
      }


      for ($i = 0; $i < $num_rows; $i++) {

         mysqli_data_seek($result, $i);
         $row = mysqli_fetch_row($result);

         //END query process


         if ($CSRF_Code == $jumo2) {
            //In CKRF
            if ($type == "stp_fieldset") {
               echo $row[0];
            }

            //END In CKRF
         }

         //Out of CKRF
         if ($type == "stp_fieldset_getnamereg") {
            echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
         }

         if ($type == "show_kids") {
            echo '<tr>
            <td>' . $row[0] . '</td>
            <td>' . $row[4] . '</td>
            <td style="text-align: center;"><form action="process.php" method="POST"><input type="hidden" value="' . $row[0] . '" name="user"><input type="submit" class="btn btn-danger" name="delete-kid" value="Delete"></form></td>
            </tr>';
         }

         if ($type == "show_proggress") {

            $q1 = "SELECT sum(total_time) as abc FROM `track_game` where username = '$row[0]' AND time_end != 0 AND game = 'abc'";
            $result1 = mysqli_query($this->connection, $q1);
            $dbarray1 = mysqli_fetch_array($result1);
            $abc = $dbarray1['abc'];

            $q2 = "SELECT sum(total_time) as num FROM `track_game` where username = '$row[0]' AND time_end != 0 AND game = 'num'";
            $result2 = mysqli_query($this->connection, $q2);
            $dbarray2 = mysqli_fetch_array($result2);
            $num = $dbarray2['num'];

            $q3 = "SELECT sum(total_time) as urdu FROM `track_game` where username = '$row[0]' AND time_end != 0 AND game = 'urdu'";
            $result3 = mysqli_query($this->connection, $q3);
            $dbarray3 = mysqli_fetch_array($result3);
            $urdu = $dbarray3['urdu'];
            if ($abc > 0) {
               $abc = gmdate("H:i:s", $abc);
            } else {
               $abc = "00:00:00";
            }
            if ($num > 0) {
               $num = gmdate("H:i:s", $num);
            } else {
               $num = "00:00:00";
            }
            if ($urdu > 0) {
               $urdu = gmdate("H:i:s", $urdu);
            } else {
               $urdu = "00:00:00";
            }

            echo '<tr>
            <td>' . $row[0] . '</td>
            <td>' . $abc . '</td>
            <td>' . $num . '</td>
            <td>' . $urdu . '</td>
            </tr>';
         }





         // END Out of CKRF
      }
   }





   ///////END Custom Functions


   function getUserInfo($username)
   {
      $username = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $username))));
      $q = "SELECT * FROM " . TBL_USERS . " WHERE username = '$username'";
      $result = mysqli_query($this->connection, $q);

      if (!$result || (mysqli_num_rows($result) < 1)) {
         return NULL;
      }

      $dbarray = mysqli_fetch_array($result);
      return $dbarray;
   }

   function getUserOnly($username)
   {
      $username = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $username))));
      $q = "SELECT username FROM " . TBL_USERS . " WHERE username = '$username'";
      $result = mysqli_query($this->connection, $q);

      if (!$result || (mysqli_num_rows($result) < 1)) {
         return NULL;
      }

      $dbarray = mysqli_fetch_array($result);
      return $dbarray;
   }


   function getNumMembers()
   {
      if ($this->num_members < 0) {
         $q = "SELECT * FROM " . TBL_USERS;
         $result = mysqli_query($this->connection, $q);
         $this->num_members = mysqli_num_rows($result);
      }
      return $this->num_members;
   }


   function calcNumActiveUsers()
   {

      $q = "SELECT * FROM " . TBL_ACTIVE_USERS;
      $result = mysqli_query($this->connection, $q);
      $this->num_active_users = mysqli_num_rows($result);
   }

   function calcNumActiveGuests()
   {

      $q = "SELECT * FROM " . TBL_ACTIVE_GUESTS;
      $result = mysqli_query($this->connection, $q);
      $this->num_active_guests = mysqli_num_rows($result);
   }

   function addActiveUser($username, $time)
   {
      $username = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $username))));
      $time = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $time))));
      $q = "UPDATE " . TBL_USERS . " SET timestamp = '$time' WHERE username = '$username'";
      mysqli_query($this->connection, $q);

      if (!TRACK_VISITORS) return;
      $q = "REPLACE INTO " . TBL_ACTIVE_USERS . " VALUES ('$username', '$time')";
      mysqli_query($this->connection, $q);
      $this->calcNumActiveUsers();
   }


   function addActiveGuest($ip, $time)
   {
      $ip = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $ip))));
      $time = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $time))));
      if (!TRACK_VISITORS) return;
      $q = "REPLACE INTO " . TBL_ACTIVE_GUESTS . " VALUES ('$ip', '$time')";
      mysqli_query($this->connection, $q);
      $this->calcNumActiveGuests();
   }


   function removeActiveUser($username)
   {
      $username = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $username))));
      if (!TRACK_VISITORS) return;
      $q = "DELETE FROM " . TBL_ACTIVE_USERS . " WHERE username = '$username'";
      mysqli_query($this->connection, $q);
      $this->calcNumActiveUsers();
   }


   function removeActiveGuest($ip)
   {
      $ip = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $ip))));
      if (!TRACK_VISITORS) return;
      $q = "DELETE FROM " . TBL_ACTIVE_GUESTS . " WHERE ip = '$ip'";
      mysqli_query($this->connection, $q);
      $this->calcNumActiveGuests();
   }


   function removeInactiveUsers()
   {
      if (!TRACK_VISITORS) return;
      $timeout = time() - USER_TIMEOUT * 60;
      $q = "DELETE FROM " . TBL_ACTIVE_USERS . " WHERE timestamp < $timeout";
      mysqli_query($this->connection, $q);
      $this->calcNumActiveUsers();
   }


   function removeInactiveGuests()
   {
      if (!TRACK_VISITORS) return;
      $timeout = time() - GUEST_TIMEOUT * 60;
      $q = "DELETE FROM " . TBL_ACTIVE_GUESTS . " WHERE timestamp < $timeout";
      mysqli_query($this->connection, $q);
      $this->calcNumActiveGuests();
   }


   function query($query)
   {
      return mysqli_query($this->connection, $query);
   }
};


$database = new MySQLDB;
