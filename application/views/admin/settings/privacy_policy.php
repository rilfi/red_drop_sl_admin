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
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/settings'); ?>">Settings</a></li>
                    <li class="breadcrumb-item active">Privacy</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('admin/settings') ?>">App Settings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active"
                           href="<?php echo base_url('admin/settings/privacy_policy') ?>">App Privacy Policy</a>
                    </li>

                </ul>
            </div>

            <div class="card-body">
                <form action="<?php echo base_url('admin/settings/privacy_policy'); ?>"
                      name="api_privacy_policy" method="post" class="form form-horizontal"
                      enctype="multipart/form-data">
                    <div class="form-group row">
                        <label class="col-md-2 control-label">App Privacy Policy :-</label>
                        <div class="col-md-10">
                                            <textarea name="app_privacy_policy" id="ckEditor"
                                                      class="form-control"><?php echo stripslashes($this->settings->app_privacy_policy); ?></textarea>
                            <script type="application/javascript">
                                jQuery(function () {
                                    // CKEDITOR.replace('privacy_policy');
                                });
                            </script>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10 offset-2">
                            <button type="submit" name="app_pri_poly" class="btn btn-block btn-info">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>