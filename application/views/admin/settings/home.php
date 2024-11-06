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
                    <li class="breadcrumb-item active">Settings</li>
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

                    <li class="nav-item"><a class="nav-link active" href="#app_settings" data-toggle="tab">App
                            Settings</a></li>
                    <li class="nav-item"><a class="nav-link" href="#admob_settings" data-toggle="tab">Admob Settings</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#notification_settings" data-toggle="tab">Notification
                            Settings</a></li>
                    <li class="nav-item"><a class="nav-link" href="#api_keys" data-toggle="tab">API Keys</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/settings/privacy_policy') ?>">App Privacy Policy</a></li>

                </ul>
            </div>

            <div class="card-body">
                <div class="tab-content">

                    <div class="tab-pane active" id="app_settings">
                        <form action="<?php echo base_url('admin/settings/save'); ?>" name="settings_from" method="post"
                              class="form form-horizontal"
                              enctype="multipart/form-data">

                            <div class="form-group row">
                                <label class="col-md-2 control-label">App Name :-</label>
                                <div class="col-md-10">
                                    <input type="text" name="app_name" id="app_name"
                                           value="<?php echo $this->settings->app_name; ?>"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label">App Logo :-</label>
                                <div class="col-md-10">
                                    <div class="fileupload_block">
                                        <input type="file" name="app_logo" id="fileupload">

                                        <?php if ($this->settings->app_logo != "") { ?>
                                            <div class="fileupload_img"><img
                                                        type="image" style="width: 30%; height: auto;"
                                                        class="img-thumbnail"
                                                        src="<?php echo base_url('images/' . $this->settings->app_logo); ?>"
                                                        alt="image"/></div>
                                        <?php } else { ?>
                                            <div class="fileupload_img">
                                                <img type="image" class="img-thumbnail"
                                                     src="images/add-image.png"
                                                     alt="image"/></div>
                                        <?php } ?>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label">App Description :-</label>
                                <div class="col-md-10">
                                    <textarea name="app_description" id="ckEditor"
                                              class="form-control"><?php echo stripslashes($this->settings->app_description); ?></textarea>

                                    <script>
                                        $(function () {
                                            // CKEDITOR.replace("app_description");
                                        });
                                    </script>
                                </div>
                            </div>
                            <div class="form-group row">&nbsp;</div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label">App Version :-</label>
                                <div class="col-md-10">
                                    <input type="text" name="app_version" id="app_version"
                                           value="<?php echo $this->settings->app_version; ?>"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label">Author :-</label>
                                <div class="col-md-10">
                                    <input type="text" name="app_author" id="app_author"
                                           value="<?php echo $this->settings->app_author; ?>"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label">Contact :-</label>
                                <div class="col-md-10">
                                    <input type="text" name="app_contact" id="app_contact"
                                           value="<?php echo $this->settings->app_contact; ?>"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label">Email :-</label>
                                <div class="col-md-10">
                                    <input type="text" name="app_email" id="app_email"
                                           value="<?php echo $this->settings->app_email; ?>"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label">Website :-</label>
                                <div class="col-md-10">
                                    <input type="text" name="app_website" id="app_website"
                                           value="<?php echo $this->settings->app_website; ?>"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label">Developed By :-</label>
                                <div class="col-md-10">
                                    <input type="text" name="app_developed_by" id="app_developed_by"
                                           value="<?php echo $this->settings->app_developed_by; ?>"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-10 offset-2">
                                    <button type="submit" name="submit" class="btn btn-block btn-flat btn-info">
                                        Save
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>

                    <div class="tab-pane" id="admob_settings">
                        <form action="<?php echo base_url('admin/settings/admob_save'); ?>" name="admob_settings"
                              method="post" class="form form-horizontal"
                              enctype="multipart/form-data">

                            <div class="setting-title">Android Admob Settings</div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label">Publisher ID
                                    :-</label>
                                <div class="col-md-10">
                                    <input type="text" name="publisher_id"
                                           id="publisher_id"
                                           value="<?php echo $this->settings->publisher_id; ?>"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label">Admob App ID
                                    :-</label>
                                <div class="col-md-10">
                                    <input type="text" name="app_id_android"
                                           id="app_id_android"
                                           value="<?php echo $this->settings->app_id_android; ?>"
                                           class="form-control">
                                    <span>*You must change admob_app_id in AndroidManifest.xml</span>

                                </div>
                            </div>
                            <div class="setting-title">Banner Ads :-</div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label">Banner
                                    Ad:-</label>
                                <div class="col-md-10">
                                    <select name="banner_ad" id="banner_ad"
                                            class="select2bs4">
                                        <option value="true"
                                                <?php if ($this->settings->banner_ad == 'true'){ ?>selected<?php } ?>>
                                            True
                                        </option>
                                        <option value="false"
                                                <?php if ($this->settings->banner_ad == 'false'){ ?>selected<?php } ?>>
                                            False
                                        </option>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label mr_bottom20">Banner
                                    ID :-</label>
                                <div class="col-md-10">
                                    <input type="text" name="banner_ad_id"
                                           id="banner_ad_id"
                                           value="<?php echo $this->settings->banner_ad_id; ?>"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="setting-title">Interstitial Ads :-</div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label">Interstital
                                    :-</label>
                                <div class="col-md-10">
                                    <select name="interstital_ad"
                                            id="interstital_ad" class="select2bs4">
                                        <option value="true"
                                                <?php if ($this->settings->interstital_ad == 'true'){ ?>selected<?php } ?>>
                                            True
                                        </option>
                                        <option value="false"
                                                <?php if ($this->settings->interstital_ad == 'false'){ ?>selected<?php } ?>>
                                            False
                                        </option>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label mr_bottom20">Interstital
                                    ID :-</label>
                                <div class="col-md-10">
                                    <input type="text" name="interstital_ad_id"
                                           id="interstital_ad_id"
                                           value="<?php echo $this->settings->interstital_ad_id; ?>"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label mr_bottom20">Interstital
                                    Clicks :-</label>
                                <div class="col-md-10">
                                    <input type="text"
                                           name="interstital_ad_click"
                                           id="interstital_ad_click"
                                           value="<?php echo $this->settings->interstital_ad_click; ?>"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-10 offset-2">
                                    <button type="submit" name="admob_submit" class="btn btn-block btn-info">
                                        Save
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>

                    <div class="tab-pane" id="notification_settings">
                        <form action="<?php echo base_url('admin/settings/saveNotification'); ?>" name="settings_api"
                              method="post" class="form form-horizontal"
                              enctype="multipart/form-data" id="api_form">
                            <div class="form-group row">
                                <label class="col-md-2 control-label">OneSignal App ID :-</label>
                                <div class="col-md-10">
                                    <input type="text" name="onesignal_app_id" id="onesignal_app_id"
                                           value="<?php echo $this->settings->onesignal_app_id; ?>"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label">OneSignal Rest Key :-</label>
                                <div class="col-md-10">
                                    <input type="text" name="onesignal_rest_key" id="onesignal_rest_key"
                                           value="<?php echo $this->settings->onesignal_rest_key; ?>"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-10 offset-2">
                                    <button type="submit" name="notification_submit"
                                            class="btn btn-block btn-info">Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--                    <div class="tab-pane" id="api_settings">-->
                    <!--                        <form action="<?php echo base_url('admin/settings/save'); ?>" name="settings_api" method="post" class="form form-horizontal"-->
                    <!--                              enctype="multipart/form-data" id="api_form">-->
                    <!---->
                    <!--                            <div class="form-group row">-->
                    <!--                                <label class="col-md-5 control-label">Home Latest Limit:-</label>-->
                    <!--                                <div class="col-md-6">-->
                    <!---->
                    <!--                                    <input type="number" name="home_latest_limit"-->
                    <!--                                           id="home_latest_limit"-->
                    <!--                                           value="-->
                    <?php //echo $this->settings->home_latest_limit; ?><!--"-->
                    <!--                                           class="form-control">-->
                    <!--                                </div>-->
                    <!---->
                    <!--                            </div>-->
                    <!--                            <div class="form-group row">-->
                    <!--                                <label class="col-md-5 control-label">Home Most Viewed-->
                    <!--                                    Limit:-</label>-->
                    <!--                                <div class="col-md-6">-->
                    <!---->
                    <!--                                    <input type="number" name="home_most_viewed_limit"-->
                    <!--                                           id="home_most_viewed_limit"-->
                    <!--                                           value="-->
                    <?php //echo $this->settings->home_most_viewed_limit; ?><!--"-->
                    <!--                                           class="form-control">-->
                    <!--                                </div>-->
                    <!---->
                    <!--                            </div>-->
                    <!--                            <div class="form-group row">-->
                    <!--                                <label class="col-md-5 control-label">Home Most Rated-->
                    <!--                                    Limit:-</label>-->
                    <!--                                <div class="col-md-6">-->
                    <!---->
                    <!--                                    <input type="number" name="home_most_rated_limit"-->
                    <!--                                           id="home_most_rated_limit"-->
                    <!--                                           value="-->
                    <?php //echo $this->settings->home_most_rated_limit; ?><!--"-->
                    <!--                                           class="form-control">-->
                    <!--                                </div>-->
                    <!---->
                    <!--                            </div>-->
                    <!--                            <div class="form-group row">-->
                    <!--                                <label class="col-md-5 control-label">Latest Limit:-</label>-->
                    <!--                                <div class="col-md-6">-->
                    <!---->
                    <!--                                    <input type="number" name="api_latest_limit"-->
                    <!--                                           id="api_latest_limit"-->
                    <!--                                           value="-->
                    <?php //echo $this->settings->api_latest_limit; ?><!--"-->
                    <!--                                           class="form-control">-->
                    <!--                                </div>-->
                    <!---->
                    <!--                            </div>-->
                    <!--                            <div class="form-group row">-->
                    <!--                                <div class="col-md-9">-->
                    <!--                                    <button type="submit" name="api_submit" class="btn btn-info">-->
                    <!--                                        Save-->
                    <!--                                    </button>-->
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!---->
                    <!--                        </form>-->
                    <!--                    </div>-->

<!--                    <div class="tab-pane" id="api_privacy_policy">-->
<!--                        -->
<!--                    </div>-->


                    <div class="tab-pane" id="api_keys">
                        <form action="<?php echo base_url('admin/settings/save_api_keys'); ?>" name="settings_api"
                              method="post" class="form form-horizontal"
                              enctype="multipart/form-data" id="api_form">
                            <div class="form-group row">
                                <label class="col-md-2 control-label">Google Maps API Key :-</label>
                                <div class="col-md-10">
                                    <input type="text" name="google_maps_api_key" id="google_maps_api_key"
                                           autocomplete="off"
                                           value="<?php echo $this->settings->google_maps_api_key; ?>"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-10 offset-2">
                                    <button type="submit" name="api_keys_submit"
                                            class="btn btn-block btn-info">Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>