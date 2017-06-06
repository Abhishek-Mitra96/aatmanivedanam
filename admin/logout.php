<?php
   session_start();
   unset($_SESSION['sess_user']);
   unset($_SESSION['id']);
   session_destroy();
   header("location:/admin/");
   ?>