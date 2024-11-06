<form action="<?php echo base_url('admin/bloodrequests/save'); ?>" method="post" class="form form-horizontal"
      enctype="multipart/form-data">
    <input type="hidden" name="id"
           value="<?php if (isset($blood_request, $blood_request['id'])) echo $blood_request['id']; ?>"/>

    <div class="section">
        <div class="section-body">
            <div class="form-group row">
                <label class="col-md-3 control-label">Full Name :-</label>
                <div class="col-md-9">
                    <input type="text" placeholder="Full Name" name="full_name"
                           id="full_name" value="<?php if (isset($blood_request)) {
                        echo $blood_request['full_name'];
                    } ?>" class="form-control" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 control-label">Mobile :-</label>
                <div class="col-md-9">
                    <input type="text" placeholder="Mobile" name="mobile"
                           id="mobile" value="<?php if (isset($blood_request)) {
                        echo $blood_request['mobile'];
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
                                <option value="<?= $country['id']; ?>" <?php if (isset($blood_request)) if ($country['id'] == $blood_request['country'] || $country['name'] == $blood_request['country']) echo "selected"; ?>><?= $country['name']; ?></option>
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
                                <option value="<?= $state['id']; ?>" <?php if (isset($blood_request)) if ($state['id'] == $blood_request['state'] || $state['name'] === $blood_request['state']) echo "selected"; ?>><?= $state['name']; ?></option>
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
                                <option value="<?= $city['id']; ?>" <?php if (isset($blood_request)) if ($city['id'] == $blood_request['city']) echo "selected"; ?>><?php echo $city['name']; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3 control-label">Hospital/ Address :-</label>
                <div class="col-md-9">
                                            <textarea type="text" placeholder="Hospital Name/ Address"
                                                      name="hospital_name"
                                                      id="hospital_name" class="form-control"
                                                      required><?php if (isset($blood_request)) {
                                                    echo $blood_request['hospital_name'];
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
                           value="<?php if (isset($blood_request)) {
                               echo $blood_request['latitude'];
                           } else echo 0; ?>" required>
                    <span class="bar"></span>

                </div>
            </div>
            <div class="form-group row">

                <label class="col-md-3 control-label">Longitude</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="us2-lon" value="<?php if (isset($blood_request)) {
                        echo $blood_request['longitude'];
                    } else echo 0; ?>" name="longitude" required>
                    <span class="bar"></span>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3 control-label">No of bags :-</label>
                <div class="col-md-9">
                    <input type="number" placeholder="No of bags" min="1" name="no_of_bags"
                           id="no_of_bags" value="<?php if (isset($blood_request)) {
                        echo $blood_request['no_of_bags'];
                    } ?>" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3 control-label">Blood Group :-</label>
                <div class="col-md-9">
                    <select name="blood_group" data-width="100%" data-placeholder="Select Blood Group" id="blood_group"
                            class="form-control select2bs4" required>
                        <option value=""></option>
                        <?php
                        if (isset($bg_result)) {
                            foreach ($bg_result as $bg_row) {
                                ?>
                                <option value="<?php echo $bg_row['blood_type']; ?>" <?php if (isset($blood_request)) if ($bg_row['blood_type'] == $blood_request['blood_group']) echo "selected"; ?>><?php echo $bg_row['blood_type']; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 control-label">Your message :-</label>
                <div class="col-md-9"><textarea type="text" placeholder="Your message" name="message"
                                                id="message" class="form-control"
                                                required><?php if (isset($blood_request)) {
                            echo $blood_request['message'];
                        } ?></textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="status" class="col-md-3 control-label">Status :- </label>
                <div class="col-md-9">
                    <select name="status" class="form-control" id="status">
                        <option <?php if (isset($blood_request)) if($blood_request['status']==1) {echo "selected";} ?> value="1">Active</option>
                        <option <?php if (isset($blood_request)) if($blood_request['status']==0) {echo "selected";} ?> value="0">Not active</option>
                    </select>
                </div>
            </div>

            <br>
            <div class="form-group row">
                <div class="col-md-9 offset-3">
                    <button type="submit" name="submit" class="btn btn-block bg-gradient-info">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>