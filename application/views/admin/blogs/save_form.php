<form action="<?php echo base_url('admin/blogs/save'); ?>" class="form form-horizontal" enctype="multipart/form-data"
      method="post" name="addeditblog">
    <input name="id" type="hidden"
           value="<?php if (isset($blog)) echo $blog['id']; ?>"/>
    <div class="section">
        <div class="section-body">
            <div class="form-group row">
                <label class="sub-title col-md-2 form-control-label">
                    Title :-
                </label>
                <div class="col-md-10">
                    <input class="form-control" id="blog_title" name="blog_title"
                           required="" placeholder="Title" type="text"
                           value="<?php if (isset($blog)) {
                               echo $blog['blog_title'];
                           } ?>">

                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 form-control-label">
                    Description :-
                </label>
                <div class="col-md-10"><textarea class="form-control" id="ckEditor"
                                                name="blog_content" required=""
                                                type="text"><?php if (isset($blog)) {
                                                    echo $blog['blog_content'];
                                                } ?></textarea>
                    <script>
                        $(function(){
                            // initCkEditor();
                            // $('textarea').summernote();
                            // CKEDITOR.replace('blog_content');
                            // CKEDITOR.replace('blog_content' ,{
                            //    filebrowserImageBrowseUrl : '<?php //echo base_url('plugins/kcfinder/browse.php');?>//'
                            // });
                        })
                        // CKEDITOR.replace('blog_content');
                    </script>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 form-control-label">
                    Posted/ Updated At :-
                </label>
                <div class="col-md-10">
                    <input class="form-control" id="posted_at" name="posted_at"
                           required="" placeholder="Date" type="text"
                           value="<?php if (isset($blog)) {
                               echo $blog['posted_at'];
                           } else {
                               echo $today = date("d/m/Y, g:i A");
                           } ?>" disabled>

                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-2 form-control-label">
                    Thumbnail :-
                </label>
                <div class="col-md-10">
                    <div>
                        <input id="fileupload" class="col-md-12 btn btn-grd-inverse"
                               name="blog_image" type="file" value="fileupload">
                        <?php if (isset($blog) and $blog['blog_image'] != "") { ?>
                            <div>
                                <img <?php if (isset($blog)) { ?> class="col-md-12" <?php } else { ?> class="" <?php } ?>
                                        alt="image"
                                        src="images/<?php echo $blog['blog_image']; ?>"
                                        type="image"/>
                            </div>
                        <?php } else { ?>
                            <div>
                                <img <?php if (isset($blog)) { ?> class="col-md-12" <?php } else { ?> class="" <?php } ?>
                                        alt="image"
                                        src="<?php echo base_url() ?>images/add-image.png"
                                        type="image"/>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-10 offset-3">
                    <button class="col-md-12 btn btn-info"
                            name="submit" type="submit">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
