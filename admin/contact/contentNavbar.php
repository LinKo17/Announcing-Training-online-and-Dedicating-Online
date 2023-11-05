<?php
include("../../vendor/autoload.php");
use Helper\Auth;

//checking user role in here
Auth::checkUserRole();
?>    
    <!-- navbar section -->
    <nav class="navbar navbar-dark bg-primary">
    <div class="container">

    <a href="../../index.php" class="navbar-brand"><span class="fs-5"><span class="text-warning fs-3">My</span>Technology</span></a>

    <!-- responsive button -->
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- responsive button -->

    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">

        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel"><span class="fs-5"><span class="text-warning fs-3">My</span>Technology</span></h5>

        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>

      <div class="offcanvas-body">
      <ul class="navbar-nav">
        <!-- ------------------------------------- -->
        <li class="list-item dropdown">
                    <a class="nav-link  text-dark btn btn-light m-2 dropdown-toggle" data-bs-toggle="dropdown" href="">Home</a>
                    <div class="dropdown-menu">
                        <a href="../adminpanel.php" class="dropdown-item text-center">Admin Panel</a>
                        <a href="../../index.php" class="dropdown-item text-center">Home</a>
                    </div>
                </li> 
        <!-- ------------------------------------- -->

        <!-- ------------------------------------- -->
        <li class="list-item dropdown">
                    <a class="nav-link  text-dark btn btn-warning m-2 dropdown-toggle" data-bs-toggle="dropdown" href="">Register Section</a>
                    <div class="dropdown-menu">
                        <a href="../request_register/adminRequestRegister.php" class="dropdown-item text-center">Request Registers</a>
                        <a href="../request_register/confirmRegisters.php"   class="dropdown-item text-center">Confirm Registers</a>
                        <a href="../request_register/confirmStudents.php"   class="dropdown-item text-center">Confirm Students</a>
                        <a href="../request_register/studentLimit.php"   class="dropdown-item text-center">Limited Students</a>

                        <a href="../request_register/rejectShow.php"   class="dropdown-item text-center text-danger">Reject Register</a>
                    </div>
                </li> 
        <!-- ------------------------------------- -->        

        <!-- ------------------------------------- -->
        <li class="nav-item dropdown">
                    <a class="nav-link text-light btn btn-secondary m-2  dropdown-toggle" href="" data-bs-toggle="dropdown">Active Classes</a>
                    <div class="dropdown-menu">
                        <a href="../createclasspost.php" class="dropdown-item text-center">Create Classes</a>
                        <a href="../createclassinfo.php" class="dropdown-item text-center">Classes Info</a>
                    </div>
                </li>        
        <!-- ------------------------------------- -->


        <!-- ------------------------------------- -->
        <li class="nav-item dropdown">
                    <a class="nav-link  text-light btn btn-secondary m-2 dropdown-toggle" data-bs-toggle="dropdown" href="">Teachers List</a>
                    <div class="dropdown-menu">
                        <a href="../teachers/teachers_create.php" class="dropdown-item text-center">Insert teacher</a>
                        <a href="../teachers/teachers_info.php" class="dropdown-item text-center">Teacher info</a>
                    </div>
                </li>

        <!-- ------------------------------------- -->


        <!-- ------------------------------------- -->
        <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light btn btn-secondary m-2" href="#" data-bs-toggle="dropdown">Courses</a>
                    <div class="dropdown-menu">
                      <a href="../courses/create_course.php" class="dropdown-item text-center">Create Courses</a>
                      <a href="../courses/course_info.php" class="dropdown-item text-center">Courses Info</a>
                    </div>
                </li>        
        <!-- ------------------------------------- -->


        <!-- ------------------------------------- -->
        <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light btn btn-danger m-2" href="#" data-bs-toggle="dropdown">Contact</a>
                    <div class="dropdown-menu text-center">
                      <a href="social_media_link.php" class="dropdown-item">Social Media</a>
                      <a href="users_msg.php" class="dropdown-item text-center">Users Message</a>
                      <a href="about_us.php" class="dropdown-item text-center">About us</a>
                    </div>
                </li>         
        <!-- ------------------------------------- -->

      </ul>

      </div>
    </div>
  </div>
</nav>
    <!-- navbar section -->