<div class="modal animated fade" id="ajaxModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view("includes/file-manager/_file_manager_ckeditor"); ?>
<?php $this->load->view("includes/file-manager/_file_manager_audio"); ?>
<?php $this->load->view("includes/file-manager/_file_manager_image"); ?>
<?php $this->load->view("includes/file-manager/_file_manager_video"); ?>