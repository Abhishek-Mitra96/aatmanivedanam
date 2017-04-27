<?php 



include_once '../include/config.php';

session_start(); 
if(!isset($_SESSION['id']) && !isset($_SESSION['sess_user']))
{
	header("Location:index.php");
}
?>
        
        
        <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $company_name; ?> </title>
  <?php require_once ('css_assets.php'); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
        
        
        
        