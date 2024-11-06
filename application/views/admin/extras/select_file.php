<form action="<?php if (isset($form_action)) echo $form_action; ?>" enctype="multipart/form-data" method="post">
    <div class="row">
        <div class="col-md-9">
            <div class="callout callout-danger">
                <h5>Note!</h5>
                <p>Data will be imported as you will upload. (Your file may not contain duplicate entries)</p>
                <p><b>Supported</b> File formats are: <b>CSV, XLS, XLSX</b></p>
            </div>
        </div>
        <?php if (isset($sample_file)) { ?>
            <div class="col-md-3">
                <a target="_blank" href="<?php echo $sample_file; ?>" class="btn btn-primary float-right">  <i class="fas fa-download"></i> Download
                    Sample File</a>
            </div>
        <?php } ?>
        <div class="clearfix"></div>
        <div class="form-group col-md-9">
            <input type="file" id="uploadFile" name="uploadFile" class="btn btn-default btn-sm btn-block">
        </div>
        <div class="form-group col-md-3">
            <input type="submit" name="submit" class="btn btn-dark btn-block" value="Upload"/>
        </div>
    </div>
    <!--    <div class="form-group">-->
    <!--        <label for="exampleInputFile">File input</label>-->
    <!--        <div class="input-group">-->
    <!--            <div class="custom-file">-->
    <!--                <input type="file" class="custom-file-input" id="exampleInputFile">-->
    <!--                <label class="custom-file-label" for="exampleInputFile">Choose file</label>-->
    <!--            </div>-->
    <!--            <div class="input-group-append">-->
    <!--                <span class="input-group-text" type="submit" id="">Upload</span>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
</form>