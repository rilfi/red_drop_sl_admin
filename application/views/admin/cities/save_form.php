<form action="<?php echo base_url('admin/cities/save'); ?>" method="post" class="form form-horizontal"
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
                                <option value="<?= $country['id']; ?> <?php if(isset($states_res)) if ($states_res[0]['country_id'] ==$country['id']) echo " selected "; ?>"><?= $country['name']; ?></option>
                            <?php endforeach;
                        } ?>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3 control-label">State :-</label>
                <div class="col-md-9">
                    <select name="state" data-placeholder="Select State"
                            id="stateId" class="form-control states" required>
                        <option value=""></option>
                        <?php if (isset($states_res)) {
                            foreach ($states_res as $state): ?>
                                <option value="<?= $state['id']; ?>" <?php if (isset($city)) if ($state['id'] == $city['state_id']) echo "selected"; ?>><?= $state['name']; ?></option>
                            <?php endforeach;
                        } ?>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="city" class="col-md-3 control-label">City :-</label>
                <div class="col-md-9">
                    <input type="text" name="name" class="form-control"
                           value="<?php if (isset($city)) echo $city['name'] ?>">
                    <!-- /.form-control -->
                </div>
                <!-- /.col-md-10 -->
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