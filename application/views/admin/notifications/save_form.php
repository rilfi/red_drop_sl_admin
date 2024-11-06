<form action="<?php echo base_url('admin/notifications/save'); ?>" method="post" class="form form-horizontal"
      enctype="multipart/form-data">

    <div class="card-body">

        <div class="form-group row">
            <label class="col-md-3 control-label">Title :-</label>
            <div class="col-md-9">
                <input type="text" name="notification_title" id="notification_title"
                       class="form-control" value="" placeholder="" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 control-label">External Link <small>(optional)</small> :-</label>
            <div class="col-md-9">
                <input type="text" name="external_link" id="external_link"
                       class="form-control" value="" placeholder="">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 control-label">Message :-</label>
            <div class="col-md-9">
                                            <textarea name="notification_msg" id="notification_msg" class="form-control"
                                                      required></textarea>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 control-label">Notification Image <small>(Optional)</small><p
                        class="small">(Recommended resolution: 600x293 or
                    650x317 or 700x342 or 750x366)</p></label>

            <div class="col-md-9">
                <div class="fileupload_block">
                    <input type="file" name="big_picture" value="" id="fileupload">
                    <div class="fileupload_img"><img type="image"
                                                     src="images/add-image.png"
                                                     alt="category image"/></div>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-9 offset-3">
                <button type="submit" name="submit" class="btn btn-block btn-info">Send
                    Notification
                </button>
            </div>
        </div>
    </div>
</form>
