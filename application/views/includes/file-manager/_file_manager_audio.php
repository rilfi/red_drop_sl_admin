<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Modal -->
<div id="audio_file_manager" class="modal fade modal-file-manager" role="dialog">
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

                        <div id="add_audio_form">
                            <div class="form-group">
                                <label class="control-label"><?php echo ucwords('audio_name'); ?></label>
                                <input type="text" id="audio_name" class="form-control"
                                       placeholder="<?php echo ucwords('audio_name'); ?>" <?php if (isset($rtl)) {
                                    echo ($rtl == true) ? 'dir="rtl"' : '';
                                } ?>>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label class="control-label"><?php echo ucwords('musician'); ?></label>
                                        <input type="text" id="musician" class="form-control"
                                               placeholder="<?php echo ucwords('musician'); ?>" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?>>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label><?php echo ucwords('download_button'); ?></label>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="radio" id="rb_download_button_1" name="audio_download_button"
                                               value="1" class="square-purple" checked>&nbsp;&nbsp;
                                        <label for="rb_download_button_1"
                                               class="cursor-pointer"><?php echo ucwords('show'); ?></label>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="radio" id="rb_download_button_2" name="audio_download_button"
                                               value="0" class="square-purple">&nbsp;&nbsp;
                                        <label for="rb_download_button_2"
                                               class="cursor-pointer"><?php echo ucwords('hide'); ?></label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label"><?php echo ucwords('audio_file'); ?></label>
                                <div class="row">
                                    <div class="col-sm-12 m-b-10">
                                        <a class='btn btn-sm bg-olive'>
                                            <?php echo ucwords('select_file'); ?>
                                            <input type="file" id="audio_file_input" name="file"
                                                   class="upload-file-input input-post-image-file" accept=".mp3, .wav"
                                                   onchange="$('#input_audio_file_label').html($(this).val());">
                                        </a>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="input-file-label" id="input_audio_file_label"></div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-12">
                                    <a id="btn_audio_upload" class='btn btn-lg bg-purple btn-upload'>
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
                            <div id="audio_file_upload_response">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <?php if (isset($audios)) {
                                            foreach ($audios as $audio): ?>
                                                <div class="col-sm-2 col-file-manager"
                                                     id="audio_col_id_<?php echo $audio->id; ?>">
                                                    <div class="file-box" data-file-id="<?php echo $audio->id; ?>">
                                                        <img src="<?php echo base_url(); ?>assets/admin/img/music-file.png"
                                                             alt="" class="img-fluid file-icon">
                                                        <p class="file-manager-list-item-name"><?php echo character_limiter($audio->musician . " - " . $audio->audio_name, 18, '...'); ?></p>
                                                    </div>
                                                </div>
                                                <?php $_SESSION["fm_last_audio_id"] = $audio->id; ?>
                                            <?php endforeach;
                                        } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="selected_audio_file_id">

                </div>
            </div>
            <div class="modal-footer">
                <div class="file-manager-footer">
                    <button type="button" id="btn_audio_delete" class="btn btn-danger pull-left btn-file-delete"><i
                                class="fa fa-trash"></i>&nbsp;&nbsp;<?php echo ucwords('delete'); ?></button>
                    <button type="button" id="btn_audio_select" class="btn bg-olive btn-file-select"><i
                                class="fa fa-check"></i>&nbsp;&nbsp;<?php echo ucwords('select_audio'); ?></button>
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal"><?php echo ucwords('close'); ?></button>
                </div>
            </div>

        </div>

    </div>
</div>
