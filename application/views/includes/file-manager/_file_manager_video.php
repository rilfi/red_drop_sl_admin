<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Modal -->
<div id="video_file_manager" class="modal fade modal-file-manager" role="dialog">
    <div class="modal-dialog modal-xl">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo ucwords('file_manager'); ?></h4>
            </div>
            <div class="modal-body">

                <div class="file-manager">

                    <div class="file-manager-left">

                        <div id="add_video_form">
                            <div class="form-group">
                                <label class="control-label"><?php echo ucwords('video_name'); ?></label>
                                <input type="text" id="video_name" class="form-control"
                                       placeholder="Video Name" <?php if (isset($rtl)) {
                                    echo ($rtl == true) ? 'dir="rtl"' : '';
                                } ?>>
                            </div>

                            <div class="form-group">
                                <label class="control-label"><?php echo ucwords('video_file'); ?></label>
                                <div class="row">
                                    <div class="col-sm-12 m-b-10">
                                        <a class='btn btn-sm bg-olive'>
                                            <?php echo ucwords('select_file'); ?>
                                            <input type="file" id="video_file_input" name="file"
                                                   class="upload-file-input input-post-image-file" accept=".mp4, .webm"
                                                   onchange="$('#input_video_file_label').html($(this).val());">
                                        </a>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="input-file-label" id="input_video_file_label"></div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-12">
                                    <a id="btn_video_upload" class='btn btn-lg bg-purple btn-upload'>
                                        <i class="fa fa-cloud-upload"></i>&nbsp;&nbsp;
                                        <?php echo ucwords('upload'); ?>
                                    </a>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="loader-file-manager m-t-15">
                                        <img src="<?php echo base_url(); ?>assets/admin/img/loader.gif" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="file-manager-right">
                        <div class="file-manager-content">
                            <div id="video_file_upload_response">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <?php if (isset($videos)) {
                                            foreach ($videos as $video): ?>
                                                <div class="col-sm-2 col-file-manager"
                                                     id="video_col_id_<?php echo $video->id; ?>">
                                                    <div class="file-box" data-file-id="<?php echo $video->id; ?>">
                                                        <img src="<?php echo base_url(); ?>assets/admin/img/video-file.png"
                                                             alt="" class="img-fluid file-icon">
                                                        <p class="file-manager-list-item-name"><?php echo character_limiter($video->video_name, 18, '...'); ?></p>
                                                    </div>
                                                </div>
                                                <?php $_SESSION["fm_last_video_id"] = $video->id; ?>
                                            <?php endforeach;
                                        } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <input type="hidden" id="selected_video_file_id">

                </div>

            </div>


            <div class="modal-footer">

                <div class="file-manager-footer">
                    <button type="button" id="btn_video_delete" class="btn btn-danger pull-left btn-file-delete"><i
                                class="fa fa-trash"></i>&nbsp;&nbsp;<?php echo ucwords('delete'); ?></button>
                    <button type="button" id="btn_video_select" class="btn bg-olive btn-file-select"><i
                                class="fa fa-check"></i>&nbsp;&nbsp;<?php echo ucwords('select_video'); ?></button>
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal"><?php echo ucwords('close'); ?></button>
                </div>


            </div>

        </div>

    </div>
</div>
