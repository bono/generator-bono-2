<?php $t->section('main', function($data) { ?>

<div class="mdl-cell mdl-cell--6-col">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input type="password"
        class="mdl-textfield__input"
        id="input_<?php echo $data['self']['name'] ?>"
        name="<?php echo $data['self']['name'] ?>"
        value=""
        autocomplete="off"
        />
        <label for="input_<?php echo $data['self']['name'] ?>" class="mdl-textfield__label">
            <?php echo $data['self']->getRepository()->translate($data['self']['label']).(isset($data['self']['filter.required']) ? '*' : '') ?>
        </label>
    </div>
</div>
<div class="mdl-cell mdl-cell--6-col">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input type="password"
            class="mdl-textfield__input"
            id="input_<?php echo $data['self']['name'] ?>_confirmation"
            name="<?php echo $data['self']['name'] ?>_confirmation"
            value=""
            autocomplete="off"
            />
        <label for="input_<?php echo $data['self']['name'] ?>_confirmation" class="mdl-textfield__label">
            <?php echo $data['self']->getRepository()->translate('Confirmation') ?>
        </label>
    </div>
</div>

<?php }) ?>
