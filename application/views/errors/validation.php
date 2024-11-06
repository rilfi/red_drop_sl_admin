<?php if(isset($msg) || validation_errors() !== ''): ?>
    <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-warning"></i> Alert!</h4>
        <?= validation_errors();?>
        <?= isset($msg)? $msg: ''; ?>
    </div>
<?php endif; ?>