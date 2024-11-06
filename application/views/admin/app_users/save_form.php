<form action="<?php echo base_url('admin/appusers/save'); ?>" method="post" class="form form-horizontal"
      enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php if (isset($user)) {
        echo $user['id'];
    } ?>"/>

    <div class="card-body">
        <div class="form-group row">
            <label class="col-md-3 control-label">Full Name :-</label>
            <div class="col-md-9">
                <input type="text" placeholder="Full Name" name="name"
                       id="name" value="<?php if (isset($user)) {
                    echo $user['name'];
                } ?>" class="form-control" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 control-label">Mobile :-</label>
            <div class="col-md-9">
                <input type="tel" placeholder="Mobile" name="mobile"
                       id="mobile" value="<?php if (isset($user)) {
                    echo $user['mobile'];
                } ?>" class="form-control" required>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 control-label">Country :-</label>
            <div class="col-md-9">
                <select name="country" data-placeholder="Select Country"
                        id="countryId" class="form-control countries" required>
                    <option value=""></option>
                    <?php if (isset($country_res)) {
                        foreach ($country_res as $country): ?>
                            <option value="<?= $country['id']; ?>" <?php if (isset($user)) if ($country['id'] == $user['country'] || $country['name'] == $user['country']) echo "selected"; ?>><?= $country['name']; ?></option>
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
                            <option value="<?= $state['id']; ?>" <?php if (isset($user)) if ($state['id'] == $user['state'] || $state['name'] === $user['state']) echo "selected"; ?>><?= $state['name']; ?></option>
                        <?php endforeach;
                    } ?>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 control-label">City :-</label>
            <div class="col-md-9">
                <select name="city" data-placeholder="Select City" data-width="100%" id="cityId"
                        class="form-control cities" required>
                    <option value=""></option>
                    <?php
                    if (isset($cities_res)) {
                        foreach ($cities_res as $city) {
                            ?>
                            <option value="<?= $city['id']; ?>" <?php if (isset($user)) if ($city['id'] == $user['city']) echo "selected"; ?>><?php echo $city['name']; ?></option>
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
                <input type="text" placeholder="Address" name="address"
                       id="address" value="<?php if (isset($user)) {
                    echo $user['address'];
                } ?>" class="form-control" required>
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
                       value="<?php if (isset($user)) {
                           echo $user['latitude'];
                       } else echo 0; ?>" required>
                <span class="bar"></span>

            </div>
        </div>
        <div class="form-group row">

            <label class="col-md-3 control-label">Longitude</label>
            <div class="col-md-9">
                <input type="text" class="form-control" id="us2-lon" value="<?php if (isset($user)) {
                    echo $user['longitude'];
                } else echo 0; ?>" name="longitude" required>
                <span class="bar"></span>
            </div>
        </div>


        <div class="form-group row">
            <label class="col-md-3 control-label">Date Of birth :-</label>
            <div class="col-md-9">
                <input type="date" placeholder="Date of birth" name="dob"
                       id="dob" value="<?php if (isset($user)) {
                    echo $user['dob'];
                } ?>" class="form-control" required>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 control-label">Blood Group :-</label>
            <div class="col-md-9">
                <select name="blood_group" data-placeholder="Select Blood Group" data-width="100%" id="blood_group"
                        class="select2bs4 form-control" required>
                    <option value=""></option>
                    <?php
                    if (isset($bg_result)) {
                        foreach ($bg_result as $bg_row) {
                            ?>
                            <option value="<?php echo $bg_row['blood_type']; ?>" <?php if (isset($user)) if ($bg_row['blood_type'] == $user['blood_group']) echo "selected"; ?>><?php echo $bg_row['blood_type']; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="status" class="col-md-3 control-label">Status :- </label>
            <div class="col-md-9">
                <select name="status" class="form-control" id="status">
                    <option <?php if (isset($user)) if ($user['status'] == 1) echo " selected "; ?> value="1">
                        Active
                    </option>
                    <option <?php if (isset($user)) if ($user['status'] == 0) echo " selected "; ?> value="0">Not
                        active
                    </option>
                </select>
            </div>
        </div>

        <br>
        <div class="form-group row">
            <div class="col-md-9 offset-3">
                <button type="submit" name="submit" class="btn btn-block bg-gradient-info">Save
                </button>
            </div>
        </div>
    </div>
</form>
