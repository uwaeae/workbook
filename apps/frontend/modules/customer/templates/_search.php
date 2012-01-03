<?php use_javascript('/sfFormExtraPlugin/js/jquery.autocompleter.js') ?>
<?php use_stylesheet('/sfFormExtraPlugin/css/jquery.autocompleter.css') ?>

<form action="<?php echo url_for('customer/search') ?>" method="get" accept-charset="utf-8">
    <?php echo $form ?>
    <?php echo $form->renderHiddenFields() ?>
    <input type="submit" value="go">
</form>

