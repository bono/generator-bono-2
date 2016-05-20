<?php $t->section('main', function($data) { ?>

<div class="mdl-cell mdl-cell--12-col">
    <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect">
        <input type="checkbox" class="mdl-switch__input" <?php echo $data['value'] ? 'checked' : '' ?>>
        <span class="mdl-switch__label">
            <?php echo $data['self']->getRepository()->translate($data['self']['label']).(isset($data['self']['filter.required']) ? '*' : '') ?>
        </span>
    </label>
</div>

<?php }) ?>