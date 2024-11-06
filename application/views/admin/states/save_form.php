<form action="<?php echo base_url('admin/states/save'); ?>" method="post" class="form form-horizontal"
      enctype="multipart/form-data">
    <?php if (isset($state)) { ?>
        <input type="hidden" name="id" value="<?php echo $state['id']; ?>"/>

    <?php } ?>
    <div class="section">
        <div class="section-body">

            <div class="form-group row">
                <label class="col-md-3 control-label">Country :-</label>
                <div class="col-md-9">
                    <select name="country" data-placeholder="Select Country"
                            id="countryId" class="form-control countries" required>
                        <option value=""></option>
                        <?php if (isset($country_res)) {
                            foreach ($country_res as $country): ?>
                                <option value="<?= $country['id']; ?>" <?php if (isset($state)) if ($country['id'] == $state['country_id']) echo "selected"; ?>><?= $country['name']; ?></option>
                            <?php endforeach;
                        } ?>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3 control-label">State Name:-</label>
                <div class="col-md-9">
                    <input type="text" placeholder="State Name" name="name"
                           id="name"
                           value="<?php if (isset($state)) {
                               echo $state['name'];
                           } ?>" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-9 offset-3">
                    <button type="submit" name="submit" class="btn btn-block btn-info">Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>