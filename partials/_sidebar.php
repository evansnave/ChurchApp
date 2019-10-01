<nav class="pcoded-navbar">
    <div class="navbar-wrapper">
        <div class="navbar-brand header-logo">
            <a href="dashboard.php" class="b-brand">
                <img src="assets/images/pci.jpg" height="50px" width="60px" alt="">
                <span class="b-title">Rehoboth Temple</span>
            </a>
            <a class="mobile-menu" id="mobile-collapse" href="javascript:"><span></span></a>
        </div>
        <div class="navbar-content scroll-div">
            <ul class="nav pcoded-inner-navbar">
                <li class="nav-item pcoded-menu-caption">
                    <label>Navigation</label>
                </li>
                <?php if ($_SESSION['role'] == 'admin') { ?>
                    <li class="nav-item ">
                        <a href="dashboard.php" class="nav-link ">
                            <span class="pcoded-micon">
                                <i class="feather icon-home"></i>
                            </span>
                            <span class="pcoded-mtext">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a href="attendance.php" class="nav-link ">
                            <span class="pcoded-micon">
                                <i class="feather icon-check-circle"></i>
                            </span>
                            <span class="pcoded-mtext">Attendance</span>
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a href="Leaders_attendance.php" class="nav-link ">
                            <span class="pcoded-micon">
                                <i class="feather icon-box"></i>
                            </span>
                            <span class="pcoded-mtext">Leaders Attendance</span>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="leaders.php" class="nav-link ">
                            <span class="pcoded-micon">
                                <i class="feather icon-box"></i>
                            </span>
                            <span class="pcoded-mtext">Leaders</span>
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a href="Ministries.php" class="nav-link ">
                            <span class="pcoded-micon">
                                <i class="feather icon-box"></i>
                            </span>
                            <span class="pcoded-mtext">Ministries</span>
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a href="programs.php" class="nav-link ">
                            <span class="pcoded-micon">
                                <i class="feather icon-target"></i>
                            </span>
                            <span class="pcoded-mtext">Programs</span>
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a href="members.php" class="nav-link ">
                            <span class="pcoded-micon">
                                <i class="feather icon-users"></i>
                            </span>
                            <span class="pcoded-mtext">Members</span>
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a href="first_timers.php" class="nav-link ">
                            <span class="pcoded-micon">
                                <i class="feather icon-user-plus"></i>
                            </span>
                            <span class="pcoded-mtext">First Timers</span>
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a href="cell_first_timers.php" class="nav-link ">
                            <span class="pcoded-micon">
                                <i class="feather icon-box"></i>
                            </span>
                            <span class="pcoded-mtext">Family First Timers</span>
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a href="follow_up.php" class="nav-link ">
                            <span class="pcoded-micon">
                                <i class="feather icon-trending-up"></i>
                            </span>
                            <span class="pcoded-mtext">Follow up </span>
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a href="fellowships.php" class="nav-link ">
                            <span class="pcoded-micon">
                                <i class="feather icon-layers"></i>
                            </span>
                            <span class="pcoded-mtext">Families</span>
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a href="foundation_school.php" class="nav-link ">
                            <span class="pcoded-micon">
                                <i class="feather icon-star"></i>
                            </span>
                            <span class="pcoded-mtext">Foundation School</span>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="foundation_school_teachers.php" class="nav-link ">
                            <span class="pcoded-micon">
                                <i class="feather icon-star"></i>
                            </span>
                            <span class="pcoded-mtext">Foundation School Teachers</span>
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a href="baptism.php" class="nav-link ">
                            <span class="pcoded-micon">
                                <i class="feather icon-droplet"></i>
                            </span>
                            <span class="pcoded-mtext">Baptism</span>
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a href="activity_groups.php" class="nav-link ">
                            <span class="pcoded-micon">
                                <i class="feather icon-activity"></i>
                            </span>
                            <span class="pcoded-mtext">Department</span>
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a href="users.php" class="nav-link ">
                            <span class="pcoded-micon">
                                <i class="feather icon-user"></i>
                            </span>
                            <span class="pcoded-mtext">Users</span>
                        </a>
                    </li>
                <?php }; ?>

                <?php if ($_SESSION['role'] == 'official') { ?>
                    <li class="nav-item ">
                        <a href="registration.php" class="nav-link ">
                            <span class="pcoded-micon">
                                <i class="feather icon-check-circle"></i>
                            </span>
                            <span class="pcoded-mtext">Registration</span>
                        </a>
                    </li>
                <?php } ?>

                <?php if ($_SESSION['role'] == 'follow_up') { ?>
                    <li class="nav-item ">
                        <a href="follow_up.php" class="nav-link ">
                            <span class="pcoded-micon">
                                <i class="feather icon-check-circle"></i>
                            </span>
                            <span class="pcoded-mtext">Follow Up</span>
                        </a>
                    </li>
                <?php } ?>


                <?php if ($_SESSION['role'] == 'cell_leader') { ?>

                    <li class="nav-item ">
                        <a href="cells.php" class="nav-link ">
                            <span class="pcoded-micon">
                                <i class="feather icon-users"></i>
                            </span>
                            <span class="pcoded-mtext">Family Members</span>
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a href="first_timers.php" class="nav-link ">
                            <span class="pcoded-micon">
                                <i class="feather icon-user-plus"></i>
                            </span>
                            <span class="pcoded-mtext">Assigned First Timers</span>
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a href="cell_first_timers.php" class="nav-link ">
                            <span class="pcoded-micon">
                                <i class="feather icon-box"></i>
                            </span>
                            <span class="pcoded-mtext">Cell First Timers</span>
                        </a>
                    </li>

                    <!-- <li class="nav-item ">
                        <a href="prospective_ft.php.php" class="nav-link ">
                            <span class="pcoded-micon">
                                <i class="feather icon-box"></i>
                            </span>
                            <span class="pcoded-mtext">Prospective First Timers</span>
                        </a>
                    </li> -->

                    <li class="nav-item ">
                        <a href="follow_up.php" class="nav-link ">
                            <span class="pcoded-micon">
                                <i class="feather icon-trending-up"></i>
                            </span>
                            <span class="pcoded-mtext">Follow up </span>
                        </a>
                    </li>

                     <li class="nav-item ">
                        <a href="programs.php" class="nav-link ">
                            <span class="pcoded-micon">
                                <i class="feather icon-target"></i>
                            </span>
                            <span class="pcoded-mtext">Programs</span>
                        </a>
                    </li> 
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>

