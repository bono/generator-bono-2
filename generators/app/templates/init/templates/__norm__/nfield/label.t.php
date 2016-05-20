<?php $t->section('main', function($data) { ?>

<label for="input_<?php echo $data['self']['name'] ?>" class="mdl-textfield__label">
    <?php echo $data['self']->getRepository()->translate($data['self']['label']).(isset($data['self']['filter.required']) ? '*' : '') ?>
</label>

<?php }) ?>
