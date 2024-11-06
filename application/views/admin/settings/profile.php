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
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Admin Profile</h3>

            </div>

            <div class="card-body">
                <form action="<?php echo base_url('admin/settings/profile') ?>" name="editprofile" method="post"
                      class="form form-horizontal"
                      enctype="multipart/form-data">
                    <div class="section">
                        <div class="section-body">
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Profile Image :-</label>
                                <div class="col-md-9">
                                    <div class="fileupload_block">
                                        <input type="file" name="image" id="fileupload">

                                        <div class="fileupload_img">
                                            <img type="image"
                                                 src="images/add-image.png"
                                                 alt="add image"/></div>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label">&nbsp; </label>
                                <div class="col-md-9">
                                    <?php if ($user['image'] != "") { ?>
                                        <div class="block_wallpaper">
                                            <img type="image" class="img-thumbnail"
                                                 src="<?php echo base_url('images/' . $user['image']); ?>"
                                                 alt="profile image"/></div>
                                    <?php } ?>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Username :-</label>
                                <div class="col-md-9">
                                    <input type="text" name="username" id="username"
                                           value="<?php echo $user['username']; ?>" class="form-control form-control-sm"
                                           required
                                           autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Password :-</label>
                                <div class="col-md-9">
                                    <input type="password" name="password" id="password"
                                           value="" class="form-control form-control-sm"
                                           placeholder="Leave empty if want unchanged"
                                           autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Email :-</label>
                                <div class="col-md-9">
                                    <input type="text" name="email" id="email"
                                           value="<?php echo $user['email']; ?>" class="form-control form-control-sm"
                                           required
                                           autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-9 offset-3">
                                    <button type="submit" name="submit" class="btn btn-block bg-gradient-info">Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>