<?php $t->extend('layout') ?>
<?php $t['title'] = $t['bundle']['collection'] ?>
<?php $t->section('main', function($data) { ?>
<div class="mdl-card mdl-card--page">
    <div class="mdl-card__table">
        <table class="mdl-data-table mdl-js-data-table">
            <thead>
                <tr>
                    <th></th>
                    <?php foreach ($this->call('route.bundle', 'getSchema')->format('tableFields') as $field): ?>
                    <th class="mdl-data-table__cell--non-numeric"><?php echo $field['label'] ?></th>
                    <?php endforeach ?>
                </tr>
                <!-- <tr>
                    <td>
                        <i class="material-icons">search</i>
                    </td>
                    <?php foreach ($this->call('route.bundle', 'getSchema')->format('tableFields') as $field): ?>
                    <td><input  style="margin: 0; width: 100%; height: 100%; border: 0" type="text"></td>
                    <?php endforeach ?>
                </tr> -->
            </thead>
            <tbody>
                <?php foreach($data['entries'] as $row): ?>
                <tr>
                    <td>
                        <a href="<?php echo $this->bundleUrl('/{$id}/read', $row) ?>" class="mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored">
                            <i class="material-icons">insert_drive_file</i>
                        </a>
                    </td>
                    <?php foreach ($this->call('route.bundle', 'getSchema')->format('tableFields') as $field): ?>
                    <td class="mdl-data-table__cell--non-numeric"><?php echo $field->format('plain', $row[$field['name']]) ?></td>
                    <?php endforeach ?>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <?php if (0 === count($data['entries'])): ?>
        <div class="empty-row">empty</div>
        <?php endif ?>
    </div>
</div>

<a href="<?php echo $this->bundleUrl('/null/create') ?>" id="action-btn" class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored">
  <i class="material-icons">add</i>
</a>
<?php }) ?>