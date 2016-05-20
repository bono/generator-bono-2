<?php $t->extend('layout') ?>
<?php $t['title'] = 'Update '.$t['bundle']['collection'] ?>
<?php $t->section('main', function($data) { ?>
<form id="form" method="POST">
    <div class="mdl-card mdl-card--page">
        <div class="mdl-card__supporting-text">
            <div class="mdl-grid">
                <?php foreach ($this->call('route.bundle', 'getSchema')->format('inputFields') as $field): ?>
                <?php echo $field->format('input', @$data['entry'][$field['name']]) ?>
                <?php endforeach ?>
            </div>
        </div>
    </div>
    <input type="submit" style="display: none">
    <input type="hidden" name="!method" value="PUT">
</form>
<?php }) ?>

<?php $t->section('actions', function() { ?>
<button id="formSaveBtn" class="mdl-button mdl-js-button mdl-button--icon mdl-button--accent"><i class="material-icons">done</i></button>
<script>
(function() {
    formSaveBtn.addEventListener('click', function() {
        form.submit();
    });
})();
</script>
<?php }) ?>