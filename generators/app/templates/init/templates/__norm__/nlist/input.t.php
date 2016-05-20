<?php $t->section('main', function($data) { ?>
<?php $uniqid = uniqid('nlist-') ?>

<style>
    #<?php echo $uniqid ?> {
        padding: 10px;
    }
</style>
<div id="<?php echo $uniqid ?>" class="field-group nlist mdl-cell mdl-cell--12-col mdl-card mdl-shadow--2dp">
    <template class="tpl">
        <div class="mdl-textfield mdl-js-textfield">
            <input type="text"
                class="mdl-textfield__input"
                name="<?php echo $data['self']['name'] ?>[]"
                value=""
                />
        </div>
    </template>
    <label><?php echo $data['self']['label'] ?></label>
    <div class="container">
        <?php if (!empty($value)): ?>
        <?php foreach ($value as $k => $v): ?>
        <div class="mdl-textfield mdl-js-textfield">
            <input type="text"
                class="mdl-textfield__input"
                name="<?php echo $data['self']['name'] ?>[]"
                value="<?php echo $v ?>"
                />
        </div>
        <?php endforeach ?>
        <?php endif ?>
        <div class="mdl-textfield mdl-js-textfield">
            <input type="text"
                class="mdl-textfield__input"
                name="<?php echo $data['self']['name'] ?>[]"
                value=""
                />
        </div>
    </div>
    <a href="#" class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored button">
        <i class="material-icons">add</i>
    </a>

    <script type="text/javascript">
    (function() {
        var component = document.getElementById('<?php echo $uniqid ?>');
        var container = component.querySelector('.container');

        component.querySelector('.button').addEventListener('click', function(evt) {
            evt.preventDefault();
            var tpl = component.querySelector('.tpl').cloneNode(true);
            container.appendChild(tpl.content);
        });
    })();
    </script>
</div>
<?php }) ?>