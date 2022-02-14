<?php if (count($errors) > 0) : ?>
    <div>
        <?php foreach ($errors as $error) : ?>
            <div>
                <label class="col-md-4 col-form-label text-danger"><?php echo $error ?></label>
            </div>
        <?php endforeach ?>
    </div>
<?php endif ?>