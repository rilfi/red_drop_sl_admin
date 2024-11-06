<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Modal -->
<div id="ck_file_manager" class="modal fade modal-file-manager" role="dialog">
    <div class="modal-dialog modal-xl">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo ucwords('file manager'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

                <div class="file-manager">

                    <div class="file-manager-left">

                        <div class="row">
                            <div class="col-sm-12">
                                <a id="btn_ckimg_upload" class='btn btn-lg bg-purple btn-upload'>
                                    <i class="fa fa-cloud-upload"></i>&nbsp;&nbsp;
                                    <?php echo ucwords('add image'); ?>
                                    <input type="file" id="ckimg_file_input" name="file"
                                           class="upload-file-input input-post-image-file"
                                           accept=".png, .jpg, .jpeg, .gif"
                                           onchange="alert('hi'); $('#input_image_file_label').html($(this).val()); $('#input_image_file_button').show();">
                                </a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="image-preview">
                                    <img id="ckimg_file_preview" src="#" alt="" class="img-fluid"/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="loader-file-manager">
                                    <img src="<?php echo base_url(); ?>assets/admin/img/loader.gif" alt="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="file-manager-right">

                        <div class="file-manager-content">
                            <div id="ckimage_file_upload_response">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <?php if (isset($images)) {
                                            foreach ($images as $image): ?>

                                                <div class="col-sm-2 col-file-manager"
                                                     id="ckimg_col_id_<?php echo $image->id; ?>">
                                                    <div class="file-box" data-file-id="<?php echo $image->id; ?>"
                                                         data-file-path="<?php echo $image->image_default; ?>">
                                                        <img src="<?php echo base_url() . $image->image_mid; ?>" alt=""
                                                             class="img-fluid">
                                                    </div>
                                                </div>
                                                <?php $_SESSION["fm_last_ckimg_id"] = $image->id; ?>
                                            <?php endforeach;
                                        } ?>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>


                    <input type="hidden" id="selected_ckimg_file_id">
                    <input type="hidden" id="selected_ckimg_file_path">

                </div>

            </div>

            <div class="modal-footer">
                <div class="file-manager-footer">
                    <button type="button" id="btn_ckimg_delete" class="btn btn-danger pull-left btn-file-delete"><i
                                class="fa fa-trash"></i>&nbsp;&nbsp;<?php echo ucwords('delete'); ?></button>
                    <button type="button" id="btn_ckimg_select" class="btn bg-olive btn-file-select"><i
                                class="fa fa-check"></i>&nbsp;&nbsp;<?php echo ucwords('select_image'); ?></button>
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal"><?php echo ucwords('close'); ?></button>
                </div>
            </div>

        </div>

    </div>
</div>