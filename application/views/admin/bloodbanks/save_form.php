<form action="<?php echo base_url('admin/bloodbanks/save'); ?>" method="post" class="form form-horizontal"
      enctype="multipart/form-data">
    <?php if (isset($bloodbank, $bloodbank['id'])) { ?>
        <input type="hidden" name="id" value="<?php echo $bloodbank['id']; ?>"/>

    <?php } ?>
    <div class="card-body">
        <div class="form-group row">
            <label class="col-md-3 control-label">Bloodbank Name :-</label>
            <div class="col-md-9">
                <input type="text" autofocus placeholder="Bloodbank Name" name="bb_name" id="bb_name"
                       value="<?php if (isset($bloodbank)) {
                           echo $bloodbank['name'];
                       } ?>" class="form-control" required>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 control-label">Contact# :-</label>
            <div class="col-md-9">
                <input type="text" placeholder="Contact#" name="bb_contact" id="bb_contact"
                       value="<?php if (isset($bloodbank)) {
                           echo $bloodbank['contact'];
                       } ?>" class="form-control" required>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 control-label">Country :-</label>
            <div class="col-md-9">
                <select name="country" data-placeholder="Select Country"
                        id="countryId" class="form-control countries select2bs4" required>
                    <option value=""></option>
                    <?php if (isset($country_res)) {
                        foreach ($country_res as $country): ?>
                            <option value="<?= $country['id']; ?>" <?php if (isset($bloodbank)) if ($country['id'] == $bloodbank['country'] || $country['name'] == $bloodbank['country']) echo "selected"; ?>><?= $country['name']; ?></option>
                        <?php endforeach;
                    } ?>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 control-label">State :-</label>
            <div class="col-md-9">
                <select name="state" data-placeholder="Select State"
                        id="stateId" class="form-control states select2bs4" required>
                    <option value=""></option>
                    <?php if (isset($states_res)) {
                        foreach ($states_res as $state): ?>
                            <option value="<?= $state['id']; ?>" <?php if (isset($bloodbank)) if ($state['id'] == $bloodbank['state'] || $state['name'] === $bloodbank['state']) echo "selected"; ?>><?= $state['name']; ?></option>
                        <?php endforeach;
                    } ?>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 control-label">City :-</label>
            <div class="col-md-9">
                <select name="city" data-placeholder="Select City" data-width="100%"
                        id="cityId" class="form-control cities select2bs4" required>
                    <option value=""></option>
                    <?php
                    if (isset($cities_res)) {
                        foreach ($cities_res as $city) {
                            ?>
                            <option value="<?= $city['id']; ?>" <?php if (isset($bloodbank)) if ($city['id'] == $bloodbank['city']) echo "selected"; ?>><?php echo $city['name']; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 control-label">Address :-</label>
            <div class="col-md-9">
                <textarea type="text" placeholder="Address" name="bb_address"
                          id="bb_address" class="form-control" required><?php if (isset($bloodbank)) {
                        echo $bloodbank['address'];
                    } ?></textarea>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 control-label">Search Location :-</label>
            <div class="col-md-9">
                <input type="text" class="form-control" id="us2-address" name="location" required>
                <span class="bar"></span>

            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 control-label">Or pick from map :-</label>
            <div class="col-md-9">
                <div id="us2" style="height: 250px;"></div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 control-label">Latitude</label>
            <div class="col-md-9">
                <input type="text" class="form-control" id="us2-lat" name="latitude"
                       value="<?php if (isset($bloodbank)) {
                           echo $bloodbank['latitude'];
                       } else echo 0; ?>" required>
                <span class="bar"></span>

            </div>
        </div>
        <div class="form-group row">

            <label class="col-md-3 control-label">Longitude</label>
            <div class="col-md-9">
                <input type="text" class="form-control" id="us2-lon" value="<?php if (isset($bloodbank)) {
                    echo $bloodbank['longitude'];
                } else echo 0; ?>" name="longitude" required>
                <span class="bar"></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="status" class="col-md-3 control-label">Status :- </label>
            <div class="col-md-9">
                <select name="status" class="form-control" id="status">
                    <option <?php if (isset($bloodbank)) if($bloodbank['status']==1) {echo "selected";} ?> value="1">Active</option>
                    <option <?php if (isset($bloodbank)) if($bloodbank['status']==0) {echo "selected";} ?> value="0">Not active</option>
                </select>
            </div>
        </div>

        <div class="card-footer justify-content-between">
            <button type="submit" class="btn bg-gradient-info float-right">Save</button>
        </div>

    </div>
</form>