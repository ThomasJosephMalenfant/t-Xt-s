<?= session()->getFlashdata('error') ?>
<?= validation_list_errors() ?>

<form action="/hermew" method="post">
    <?= csrf_field() ?>

    <input type="input" name="ref" value="<?= set_value('ref') ?>">

    <input type="submit" name="submit" value="">
</form>