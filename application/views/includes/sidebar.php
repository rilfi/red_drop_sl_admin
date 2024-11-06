<aside class="main-sidebar sidebar-light-red elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url(); ?>" class="brand-link">
        <img src="<?php echo base_url('images/').$this->settings->app_logo; ?>" alt="Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light"><?php echo $this->settings->app_name; ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo base_url('images/profile.png'); ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="<?php echo base_url('admin/settings/profile'); ?>" class="d-block"><?php echo $this->session->userdata("name"); ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="admin/dashboard" class="nav-link <?php if (isset($bbdashboard)) echo 'active'; ?> ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <!--                <li class="nav-item has-treeview -->
                <?php //if(isset($bbsave) || isset($bblist)) echo 'menu-open'; ?><!-- ">-->
                <!--                    <a href="#" class="nav-link  -->
                <?php //if(isset($bbsave) || isset($bblist)) echo 'active'; ?><!-- ">-->
                <!--                        <i class="nav-icon fas fa-hospital"></i>-->
                <!--                        <p>-->
                <!--                            Blood Banks-->
                <!--                            <i class="right fas fa-angle-left"></i>-->
                <!--                        </p>-->
                <!--                    </a>-->
                <!--                    <ul class="nav nav-treeview">-->
                <!--                        <li class="nav-item">-->
                <!--                            <a href="admin/bloodbanks/save" class="nav-link -->
                <?php //if(isset($bbsave)) echo 'active'; ?><!-- ">-->
                <!--                                <i class="far fa-circle nav-icon"></i>-->
                <!--                                <p>Add New</p>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <li class="nav-item">
                    <a href="admin/bloodbanks" class="nav-link <?php if (isset($bblist)) echo 'active'; ?> ">
                        <i class="fas fa-hospital-alt nav-icon"></i>
                        <p>Blood Banks</p>
                    </a>
                </li>
                <!--                    </ul>-->
                <!--                </li>-->

                <!--                <li class="nav-item has-treeview -->
                <?php //if(isset($bdsave) || isset($bdlist)) echo 'menu-open'; ?><!--">-->
                <!--                    <a href="#" class="nav-link -->
                <?php //if(isset($bdsave) || isset($bdlist)) echo 'active'; ?><!--">-->
                <!--                        <i class="nav-icon fas fa-users"></i>-->
                <!--                        <p>-->
                <!--                            Blood Donors-->
                <!--                            <i class="right fas fa-angle-left"></i>-->
                <!--                        </p>-->
                <!--                    </a>-->
                <!--                    <ul class="nav nav-treeview">-->
                <!--                        <li class="nav-item">-->
                <!--                            <a href="admin/blooddonors/save" class="nav-link -->
                <?php //if(isset($bdsave)) echo 'active'; ?><!-- ">-->
                <!--                                <i class="far fa-circle nav-icon"></i>-->
                <!--                                <p>Add New</p>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <li class="nav-item">
                    <a href="admin/blooddonors" class="nav-link <?php if (isset($bdlist)) echo 'active'; ?> ">
                        <i class="fas fa-user-alt nav-icon"></i>
                        <p>Blood Donors</p>
                    </a>
                </li>
                <!--                    </ul>-->
                <!---->
                <!--                </li>-->

                <!--                <li class="nav-item has-treeview -->
                <?php //if(isset($brsave) || isset($brlist)) echo 'menu-open'; ?><!--">-->
                <!--                    <a href="#" class="nav-link">-->
                <!--                        <i class="nav-icon fas fa-hospital-alt"></i>-->
                <!--                        <p>-->
                <!--                            Blood Requests-->
                <!--                            <i class="right fas fa-angle-left"></i>-->
                <!--                        </p>-->
                <!--                    </a>-->
                <!--                    <ul class="nav nav-treeview">-->
                <!--                        <li class="nav-item">-->
                <!--                            <a href="" class="nav-link">-->
                <!--                                <i class="far fa-circle nav-icon"></i>-->
                <!--                                <p>Add New</p>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <li class="nav-item">
                    <a href="admin/bloodrequests" class="nav-link <?php if (isset($brlist)) echo 'active'; ?> ">
                        <i class="fas fa-hospital-alt nav-icon"></i>
                        <p>Blood Requests</p>
                    </a>
                </li>
                <!--                    </ul>-->
                <!--                </li>-->

                <!--                <li class="nav-item has-treeview">-->
                <!--                    <a href="#" class="nav-link">-->
                <!--                        <i class="nav-icon fas fa-users-cog"></i>-->
                <!--                        <p>-->
                <!--                            App Users-->
                <!--                            <i class="right fas fa-angle-left"></i>-->
                <!--                        </p>-->
                <!--                    </a>-->
                <!--                    <ul class="nav nav-treeview">-->
                <!--                        <li class="nav-item">-->
                <!--                            <a href="" class="nav-link">-->
                <!--                                <i class="far fa-circle nav-icon"></i>-->
                <!--                                <p>Add New</p>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <li class="nav-item">
                    <a href="admin/appusers" class="nav-link <?php if (isset($busers)) echo 'active'; ?> ">
                        <i class="fas fa-users-cog nav-icon"></i>
                        <p>App Users</p>
                    </a>
                </li>
                <!--                    </ul>-->
                <!--                </li>-->

                <!--                <li class="nav-item has-treeview">-->
                <!--                    <a href="#" class="nav-link">-->
                <!--                        <i class="nav-icon fas fa-home"></i>-->
                <!--                        <p>-->
                <!--                            Countries-->
                <!--                            <i class="right fas fa-angle-left"></i>-->
                <!--                        </p>-->
                <!--                    </a>-->
                <!--                    <ul class="nav nav-treeview">-->
                <!--                        <li class="nav-item">-->
                <!--                            <a href="" class="nav-link">-->
                <!--                                <i class="far fa-circle nav-icon"></i>-->
                <!--                                <p>Add New</p>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <li class="nav-item">
                    <a href="admin/countries" class="nav-link <?php if (isset($bcountry)) echo 'active'; ?> ">
                        <i class="fas fa-home nav-icon"></i>
                        <p>Countries</p>
                    </a>
                </li>
                <!--                    </ul>-->
                <!--                </li>-->


                <!--                <li class="nav-item has-treeview">-->
                <!--                    <a href="#" class="nav-link">-->
                <!--                        <i class="nav-icon fas fa-home"></i>-->
                <!--                        <p>-->
                <!--                            States-->
                <!--                            <i class="right fas fa-angle-left"></i>-->
                <!--                        </p>-->
                <!--                    </a>-->
                <!--                    <ul class="nav nav-treeview">-->
                <!--                        <li class="nav-item">-->
                <!--                            <a href="" class="nav-link">-->
                <!--                                <i class="far fa-circle nav-icon"></i>-->
                <!--                                <p>Add New</p>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <li class="nav-item">
                    <a href="admin/states" class="nav-link <?php if (isset($bstates)) echo 'active'; ?> ">
                        <i class="fas fa-home nav-icon"></i>
                        <p>States</p>
                    </a>
                </li>
                <!--                    </ul>-->

                <!--                </li>-->

                <!--                <li class="nav-item has-treeview">-->
                <!--                    <a href="#" class="nav-link">-->
                <!--                        <i class="nav-icon fas fa-home"></i>-->
                <!--                        <p>-->
                <!--                            Cities-->
                <!--                            <i class="right fas fa-angle-left"></i>-->
                <!--                        </p>-->
                <!--                    </a>-->
                <!--                    <ul class="nav nav-treeview">-->
                <!--                        <li class="nav-item">-->
                <!--                            <a href="" class="nav-link">-->
                <!--                                <i class="far fa-circle nav-icon"></i>-->
                <!--                                <p>Add New</p>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <li class="nav-item">
                    <a href="admin/cities" class="nav-link <?php if (isset($bcities)) echo 'active'; ?> ">
                        <i class="fas fa-home nav-icon"></i>
                        <p>Cities</p>
                    </a>
                </li>
                <!--                    </ul>-->
                <!---->
                <!--                </li>-->

                <!--                <li class="nav-item has-treeview">-->
                <!--                    <a href="#" class="nav-link">-->
                <!--                        <i class="nav-icon fas fa-pager"></i>-->
                <!--                        <p>-->
                <!--                            Blogs-->
                <!--                            <i class="right fas fa-angle-left"></i>-->
                <!--                        </p>-->
                <!--                    </a>-->
                <!--                    <ul class="nav nav-treeview">-->
                <!--                        <li class="nav-item">-->
                <!--                            <a href="" class="nav-link">-->
                <!--                                <i class="far fa-circle nav-icon"></i>-->
                <!--                                <p>Add New</p>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <li class="nav-item">
                    <a href="admin/blogs" class="nav-link <?php if (isset($bblogs)) echo 'active'; ?> ">
                        <i class="fas fa-list nav-icon"></i>
                        <p>Blogs</p>
                    </a>
                </li>
                <!--                    </ul>-->

                <!--                </li>-->

                <li class="nav-item">
                    <a href="admin/notifications" class="nav-link <?php if (isset($bnotification)) echo 'active'; ?> ">
                        <i class="nav-icon fas fa-bell"></i>
                        <p>
                            Notifications
<!--                            <span class="right badge badge-danger">New</span>-->
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="admin/settings" class="nav-link <?php if (isset($bsetting)) echo 'active'; ?> ">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Settings
<!--                            <span class="right badge badge-danger">New</span>-->
                        </p>
                    </a>
                </li>

                <li class="nav-header">MISCELLANEOUS</li>
                <li class="nav-item">
                    <a href="auth/logout" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>