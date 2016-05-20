<?php $t->section('main', function($data) { ?>
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <textarea class="mdl-textfield__input" type="text" name="<?php echo $data['self']['name'] ?>"
        rows= "5" id="input-<?php echo $data['self']['name'] ?>" ></textarea>
    <label class="mdl-textfield__label" for="input-<?php echo $data['self']['name'] ?>"><?php echo $data['self']['label'] ?></label>
</div>
<?php }) ?>