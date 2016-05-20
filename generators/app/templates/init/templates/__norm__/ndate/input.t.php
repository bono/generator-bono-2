<?php $t->section('main', function($data) { ?>

<div class="mdl-cell mdl-cell--12-col">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input type="date"
            class="mdl-textfield__input"
            id="input_<?php echo $data['self']['name'] ?>"
            name="<?php echo $data['self']['name'] ?>"
            value="<?php echo $data['value'] ?>"
            />
        <label for="input_<?php echo $data['self']['name'] ?>" class="mdl-textfield__label">
            <?php echo $data['self']->getRepository()->translate($data['self']['label']).(isset($data['self']['filter.required']) ? '*' : '') ?>
        </label>
    </div>
</div>

<?php }) ?>
