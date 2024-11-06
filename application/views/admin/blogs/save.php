<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard <small><?php if (isset($title)) {
                            echo $title;
                        } ?></small></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Blogs</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?php if (isset($title)) echo $title; else echo "Add Blog" ?></h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <div class="card-body">
                <?php $this->load->view("admin/blogs/save_form"); ?>
            </div>
        </div>
        <!-- /.card -->
    </div>
</section>

<script>
    $(function () {
        // setLocationPicker(null, null);
    });
</script>