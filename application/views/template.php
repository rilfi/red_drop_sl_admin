<!DOCTYPE html>
<html>
<?php $this->load->view("includes/head"); ?>
<body class="hold-transition sidebar-mini layout-fixed text-sm">
<div class="wrapper">

    <!-- Navbar -->
    <?php $this->load->view("includes/nav"); ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php $this->load->view("includes/sidebar"); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <?php if ($this->session->flashdata("error") || $this->session->flashdata("success")|| $this->session->flashdata("warning")) { ?>
            <div class="col-md-12 pt-2">

                <?php
                if ($this->session->flashdata("error")) {
                    ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-ban"></i> Error!</h5>
                        <?php echo $this->session->flashdata("error"); ?>
                    </div>
                    <?php
                } else if ($this->session->flashdata("success")) {
                    ?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-info"></i> Success!</h5>
                        <?php echo $this->session->flashdata("success"); ?>
                    </div>
                    <?php
                } else if ($this->session->flashdata("warning")) {
                    ?>
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-info"></i> Warning!</h5>
                        <?php echo $this->session->flashdata("warning"); ?>
                    </div>
                    <?php
                } ?>
            </div>
        <?php } ?>

        <!-- Main content -->
        <?php $this->load->view($content); ?>

        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php $this->load->view("includes/footer"); ?>

    <!-- Control Sidebar -->
    <?php $this->load->view("includes/control_sidebar"); ?>

    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php $this->load->view("includes/js"); ?>
<?php $this->load->view("includes/extra_html"); ?>


</body>
</html>
