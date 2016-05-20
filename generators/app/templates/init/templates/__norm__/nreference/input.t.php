<?php $t->section('main', function($data) { ?>

<div class="mdl-cell mdl-cell--12-col">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <select name="<?php echo $data['name'] ?>" class="mdl-textfield__input field" style="margin: 4px 0">
            <option value=""></option>
            <?php foreach ($data['self']->fetch() as $key => $row): ?>
            <option value="<?php echo $key ?>" <?php echo $key == $data['value'] ? 'selected' : '' ?>>
                <?php echo $data['self']['to$label'] ? $row['to$label'] : (
                    $data['self']['to$key']
                        ? $row->format()
                        : $row
                ) ?>
            </option>
            <?php endforeach ?>
        </select>
        <?php if (!($data['self'] instanceof \Norm\Schema\NReferenceList)): ?>
        <label class="mdl-textfield__label">
            <?php echo $data['self']->getRepository()->translate($data['self']['label']).(isset($data['self']['filter.required']) ? '*' : '') ?>
        </label>
        <?php endif ?>
    </div>
</div>

<?php }) ?>
