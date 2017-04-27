<header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      
      <span class="logo-lg"><?php echo $company_name; ?></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <!-- <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a> -->

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
        
          <!-- <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope" aria-hidden="true"></i> Message  <i class="fa fa-angle-down" aria-hidden="true"></i></a>
            <ul class="dropdown-menu">
              <li>
                <a href="notification_settings.php">Settings </a>
              </li>
              <li class="divider"></li>
              <li>
                <a href="message_templates.php">Templates</a>
              </li> -->
              <!-- <li class="divider"></li> -->
              <!-- <li>
                <a href="bulk_sms.php">Bulk SMS</a>
              </li>
              <li class="divider"></li>
              <li>
                <a href="bulk_notification.php">Bulk Notification</a>
              </li> -->
           <!--  </ul>
          </li> -->

         <!--  <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cogs" aria-hidden="true"></i> Settings <i class="fa fa-angle-down" aria-hidden="true"></i></a>
            <ul class="dropdown-menu">
              <li>
                <a href="general_settings.php">General Settings </a>
              </li>
              
            </ul>
          </li> -->

          <!-- <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user" aria-hidden="true"></i> Admin Management <i class="fa fa-angle-down" aria-hidden="true"></i></a>
            <ul class="dropdown-menu">
              <li>
                <a href="create_admin.php"> Create New Admin</a>
              </li>
              <li class="divider"></li>
              <li>
                <a href="view_admin.php"> View Other Admin</a>
              </li>
            </ul>
          </li>     -->

          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
<!--              <img src="assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">-->
                <span class="hidden-xs"><i class="fa fa-user"></i>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_SESSION['sess_user'];?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
<!--                <img src="assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">-->

                  <p>
                  <?php echo $company_name; ?>
                </p>
              </li>
             
              <li class="user-footer">
                <div class="row">
                  <div class="col-md-6">
                  <a href="changepassword.php" style="width:100%;padding-left:5px" class="btn btn-default btn-flat">Change Password</a>
                </div>
                <div class="col-md-6">
                  <a href="logout.php"  style="width:100%" class="btn btn-default btn-flat">Sign out</a>
                </div>
                </div>
              </li>
            </ul>
          </li>
          
        </ul>
      </div>
    </nav>
  </header>