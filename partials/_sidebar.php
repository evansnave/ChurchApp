<nav class="pcoded-navbar">
    <div class="navbar-wrapper">
        <div class="navbar-brand header-logo">
            <a href="dashboard.php" class="b-brand">
                <img src="assets/images/gb.jpg" height="50px" width="60px" alt="">
                <span class="b-title">NLCBC</span>
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

                    <li class="nav-item pcoded-hasmenu">
                        <a href="javascript:" class="nav-link">
                            <span class="pcoded-micon">
                                <i class="feather icon-users"></i>
                            </span>
                            <span class="pcoded-mtext">Members Bio</span></a>
                            <ul class="pcoded-submenu">
                                <li class=""><a href="members.php" class="">Members</a></li>
                                <li class=""><a href="attendance.php" class="">Attendance</a></li>
                                <li class=""><a href="first_timers.php" class="">First Timers</a></li>
                            </ul>
                    </li>

                    <li class="nav-item pcoded-hasmenu">
                        <a href="javascript:" class="nav-link "><span class="pcoded-micon"><i class="feather icon-award"></i></span><span class="pcoded-mtext">Leaders Bio</span></a>
                        <ul class="pcoded-submenu">
                            <li class=""><a href="leaders.php" class="">Leaders</a></li>
                            <li class=""><a href="Leaders_attendance.php" class="">Leaders Attendance</a></li>
                           
                           
                        </ul>
                    </li>

                    <li class="nav-item ">
                        <a href="Ministries.php" class="nav-link ">
                            <span class="pcoded-micon">
                                <i class="feather icon-globe"></i>
                            </span>
                            <span class="pcoded-mtext">Ministries</span>
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

                    <li class="nav-item pcoded-hasmenu">
                        <a href="javascript:" class="nav-link "><span class="pcoded-micon"><i class="feather icon-users"></i></span><span class="pcoded-mtext">Cells</span></a>
                        <ul class="pcoded-submenu">
                            <li class=""><a href="fellowships.php" class="">Cells</a></li>
                            <li class=""><a href="cell_first_timers.php" class="">Cell first timers</a></li>

                            </ul>
                    </li> 

                    <li class="nav-item pcoded-hasmenu">
                        <a href="javascript:" class="nav-link "><span class="pcoded-micon"><i class="feather icon-book"></i></span><span class="pcoded-mtext">Foundation School</span></a>
                        <ul class="pcoded-submenu">
                            <li class=""><a href="foundation_school.php" class="">Foundation Classes</a></li>
                            <li class=""><a href="foundation_school_teachers.php" class="">Foundation School Teachers</a></li>

                            </ul>
                    </li> 
                    <li class="nav-item pcoded-hasmenu">
                        <a href="javascript:" class="nav-link ">
                            <span class="pcoded-micon">
                                <i class="feather icon-bar-chart"></i>
                            </span>
                            <span class="pcoded-mtext">Finances</span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class=""><a href="offerings.php" class="">Offerings</a></li>
                            <li class=""><a href="tithes.php" class="">Tithes</a></li>
                            <li class=""><a href="fundraising.php" class="">Fundraising</a></li>
                            <li class=""><a href="finacial_report.php" class="">Financial Report</a></li>
                        </ul>
                    </li> 

                    <li class="nav-item ">
                        <a href="programs.php" class="nav-link ">
                            <span class="pcoded-micon">
                                <i class="feather icon-calendar"></i>
                            </span>
                            <span class="pcoded-mtext">Programs</span>
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
                        <a href="families.php" class="nav-link ">
                            <span class="pcoded-micon">
                                <i class="feather icon-activity"></i>
                            </span>
                            <span class="pcoded-mtext">Families</span>
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a href="child_dedication.php" class="nav-link ">
                            <span class="pcoded-micon">
                                <i class="feather icon-activity"></i>
                            </span>
                            <span class="pcoded-mtext">Infant Dedication</span>
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


                    <li class="nav-item pcoded-hasmenu">
                        <a href="javascript:" class="nav-link "><span class="pcoded-micon">
                            <i class="feather icon-bar-chart"></i>
                            </span><span class="pcoded-mtext">Kingdom Kids</span></a>
                            <ul class="pcoded-submenu">
                                <li class=""><a href="Infants.php" class="">Infants</a></li>
                                <li class=""><a href="teens.php" class="">Teens</a></li>
                            </ul>
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
                            <span class="pcoded-mtext">Families</span>
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
                            <span class="pcoded-mtext">Family First Timers</span>
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
                
                <!-- <li class="nav-item pcoded-hasmenu active">
                        <a href="javascript:" class="nav-link "><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">Components</span></a>
                        <ul class="pcoded-submenu">
                            <li class=""><a href="bc_button.html" class="">Button</a></li>
                            <li class=""><a href="bc_badges.html" class="">Badges</a></li>
                            <li class="active"><a href="bc_breadcrumb-pagination.html" class="">Breadcrumb & paggination</a></li>
                            <li class=""><a href="bc_collapse.html" class="">Collapse</a></li>
                            <li class=""><a href="bc_tabs.html" class="">Tabs & pills</a></li>
                            <li class=""><a href="bc_typography.html" class="">Typography</a></li>
                            <li class=""><a href="icon-feather.html" class="">Feather<span class="pcoded-badge label label-danger">NEW</span></a></li>
                        </ul>
                    </li> -->
            </ul>
        </div>
    </div>
</nav>

