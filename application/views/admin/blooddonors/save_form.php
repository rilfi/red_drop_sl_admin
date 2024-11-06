<form action="<?php echo base_url('admin/blooddonors/save'); ?>" method="post" class="form form-horizontal"
      enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php if (isset($blooddonor, $blooddonor['id'])) echo $blooddonor['id']; ?>"/>

    <div class="card-body">
        <div class="form-group row">
            <label class="col-md-3 control-label">Full Name :-</label>
            <div class="col-md-9">
                <input type="text" placeholder="Full Name" name="full_name"
                       id="full_name" value="<?php if (isset($blooddonor)) {
                    echo $blooddonor['full_name'];
                } ?>" class="form-control" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 control-label">Mobile :-</label>
            <div class="col-md-9">
                <input type="text" placeholder="Mobile" name="mobile"
                       id="mobile" value="<?php if (isset($blooddonor)) {
                    echo $blooddonor['mobile'];
                } ?>" class="form-control" required>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 control-label">Country :-</label>
            <div class="col-md-9">
                <select name="country" data-placeholder="Select Country"
                        id="countryId" class="form-control countries select2" required>
                    <option value=""></option>
                    <?php if (isset($country_res)) {
                        foreach ($country_res as $country): ?>
                            <option value="<?= $country['id']; ?>" <?php if (isset($blooddonor)) if ($country['id'] == $blooddonor['country'] || $country['name'] == $blooddonor['country']) echo "selected"; ?>><?= $country['name']; ?></option>
                        <?php endforeach;
                    } ?>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 control-label">State :-</label>
            <div class="col-md-9">
                <select name="state" data-placeholder="Select State"
                        id="stateId" class="form-control states select2" required>
                    <option value=""></option>
                    <?php if (isset($states_res)) {
                        foreach ($states_res as $state): ?>
                            <option value="<?= $state['id']; ?>" <?php if (isset($blooddonor)) if ($state['id'] == $blooddonor['state'] || $state['name'] === $blooddonor['state']) echo "selected"; ?>><?= $state['name']; ?></option>
                        <?php endforeach;
                    } ?>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 control-label">City :-</label>
            <div class="col-md-9">
                <select name="city" data-placeholder="Select City" data-width="100%"
                        id="cityId" class="form-control cities select2" required>
                    <option value=""></option>
                    <?php
                    if (isset($cities_res)) {
                        foreach ($cities_res as $city) {
                            ?>
                            <option value="<?= $city['id']; ?>" <?php if (isset($blooddonor)) if ($city['id'] == $blooddonor['city']) echo "selected"; ?>><?php echo $city['name']; ?></option>
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
                                            <textarea type="text" placeholder="Address" name="address"
                                                      id="address" class="form-control"
                                                      required><?php if (isset($blooddonor)) {
                                                    echo $blooddonor['address'];
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
                       value="<?php if (isset($blooddonor)) {
                           echo $blooddonor['latitude'];
                       } else echo 0; ?>" required>
                <span class="bar"></span>

            </div>
        </div>
        <div class="form-group row">

            <label class="col-md-3 control-label">Longitude</label>
            <div class="col-md-9">
                <input type="text" class="form-control" id="us2-lon" value="<?php if (isset($blooddonor)) {
                    echo $blooddonor['longitude'];
                } else echo 0; ?>" name="longitude" required>
                <span class="bar"></span>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 control-label">Habits :-</label>
            <div class="col-md-9">
                                            <textarea type="text" placeholder="Habits" name="habits"
                                                      id="habits" class="form-control"
                                                      ><?php if (isset($blooddonor)) {
                                                    echo $blooddonor['habits'];
                                                } ?></textarea>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 control-label">Last Donation date :-</label>
            <div class="col-md-9">
                <input type="date" placeholder="Last Donation date" name="lastDonationDate"
                       id="lastDonationDate" value="<?php if (isset($blooddonor)) {
                    echo $blooddonor['lastDonationDate'];
                } ?>" class="form-control" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 control-label">Date Of birth :-</label>
            <div class="col-md-9">
                <input type="date" placeholder="Date of birth" name="date_of_birth"
                       id="date_of_birth" value="<?php if (isset($blooddonor)) {
                    echo $blooddonor['date_of_birth'];
                } ?>" class="form-control" required>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 control-label">Blood Group :-</label>
            <div class="col-md-9">
                <select name="blood_group" data-width="100%"
                        data-placeholder="Select Blood Group" id="blood_group"
                        class="form-control select2" required>
                    <option value=""></option>
                    <?php
                    if (isset($bg_result)) {
                        foreach ($bg_result as $bg_row) {
                            ?>
                            <option value="<?php echo strtoupper($bg_row['blood_type']); ?>" <?php if (isset($blooddonor)) if (strtoupper($bg_row['blood_type']) == strtoupper($blooddonor['blood_group'])) echo "selected"; ?>><?php echo strtoupper($bg_row['blood_type']); ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="status" class="col-md-3 control-label">Donor Type :- </label>
            <div class="col-md-9">
                <select name="status" class="form-control" id="status">
                    <option <?php if (isset($blooddonor)) if (strtolower($blooddonor['type']) == "free") echo " selected "; ?>
                            value="free">Free
                    </option>
                    <option <?php if (isset($blooddonor)) if (strtolower($blooddonor['type']) == "paid") echo " selected "; ?>
                            value="paid">Paid
                    </option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="gender" class="col-md-3 control-label">Gender :- </label>
            <div class="col-md-9">
                <select name="gender" class="form-control" id="gender">
                    <option <?php if (isset($blooddonor)) if ($blooddonor['gender'] == 'male') echo " selected "; ?>
                            value="male">Male
                    </option>
                    <option <?php if (isset($blooddonor)) if ($blooddonor['gender'] == 'female') echo " selected "; ?>
                            value="female">Female
                    </option>
	                <option <?php if (isset($blooddonor)) if ($blooddonor['gender'] == 'other') echo " selected "; ?>
		                value="other">Other
	                </option>
                </select>
            </div>
        </div>

	    <div class="form-group row">
            <label for="status" class="col-md-3 control-label">Status :- </label>
            <div class="col-md-9">
                <select name="status" class="form-control" id="status">
                    <option <?php if (isset($blooddonor)) if ($blooddonor['status'] == 1) echo " selected "; ?>
                            value="1">Active
                    </option>
                    <option <?php if (isset($blooddonor)) if ($blooddonor['status'] == 0) echo " selected "; ?>
                            value="0">Not active
                    </option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-9 offset-3">
                <button type="submit" name="submit" class="btn btn-block btn-info">Save
                </button>
            </div>
        </div>
    </div>
</form>
