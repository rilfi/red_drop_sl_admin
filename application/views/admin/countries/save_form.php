<form action="<?php echo base_url('admin/countries/save'); ?>" method="post" class="form form-horizontal"
      enctype="multipart/form-data">
    <?php if (isset($country)) { ?>
        <input type="hidden" name="id" value="<?php echo $country['id']; ?>"/>

    <?php } ?>
    <div class="section">
        <div class="section-body">

            <div class="form-group row">
                <label class="col-md-3 control-label">Country:-</label>
                <div class="col-md-9">
                    <input type="text" placeholder="Country" name="name" id="name"
                           value="<?php if (isset($country)) {
                               echo $country['name'];
                           } ?>" class="form-control" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 control-label">Short Name:-</label>
                <div class="col-md-9">
                    <input type="text" placeholder="Short Name" name="short_name" id="short_name"
                           value="<?php if (isset($country)) {
                               echo $country['short_name'];
                           } ?>" class="form-control" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 control-label">Phone Code:-</label>
                <div class="col-md-9">
                    <input type="text" placeholder="Phone Code" name="phone_code" id="phone_code"
                           value="<?php if (isset($country)) {
                               echo $country['phone_code'];
                           } ?>" class="form-control" required>
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