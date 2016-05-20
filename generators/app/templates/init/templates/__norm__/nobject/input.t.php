<?php $t->section('main', function($data) { ?>
<?php $uniqid = uniqid('nobject-') ?>

<div id="<?php echo $uniqid ?>" class="field-group nobject mdl-card mdl-shadow--2dp">
    <template class="tpl">
        <div style="display: flex">
            <div class="mdl-textfield mdl-js-textfield">
                <input type="text"
                    class="mdl-textfield__input property-name"
                    value="property"
                    />
            </div>
            <div class="mdl-textfield mdl-js-textfield property-value">
                <input type="text"
                    class="mdl-textfield__input"
                    name="<?php echo $data['self']['name'] ?>[]"
                    />
            </div>
        </div>
    </template>
    <label><?php echo $data['self']['label'] ?></label>
    <div class="container">
        <?php if (!empty($value)): ?>
        <?php foreach ($value as $k => $v): ?>
        <div style="display: flex">
            <div class="mdl-textfield mdl-js-textfield">
                <input type="text"
                    class="mdl-textfield__input property-name"
                    value="<?php echo $k ?>"
                    />
            </div>
            <div class="mdl-textfield mdl-js-textfield">
                <input type="text"
                    class="mdl-textfield__input property-value"
                    name="<?php echo $data['self']['name'] ?>[$k]"
                    value="<?php echo $v ?>"
                    />
            </div>
        </div>
        <?php endforeach ?>
        <?php endif ?>
    </div>
    <a href="#" class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored button">
        <i class="material-icons">add</i>
    </a>

    <script type="text/javascript">
    (function() {
        var component = document.getElementById('<?php echo $uniqid ?>');
        var container = component.querySelector('.container');

        component.addEventListener('change', function(evt) {
            var target = evt.target;
            if (target.classList.contains('property-name')) {
                var value = target.value.trim();
                if (value) {
                    target.parentElement.parentElement.querySelector('.property-value').name = '<?php echo $data["self"]["name"] ?>[' + value + ']';
                } else {
                    target.parentElement.parentElement.parentElement.removeChild(target.parentElement.parentElement);
                    evt.stopPropagation();
                }
            }
        });

        component.querySelector('.button').addEventListener('click', function(evt) {
            evt.preventDefault();
            var tpl = component.querySelector('.tpl').cloneNode(true);
            container.appendChild(tpl.content);
        });
    })();
    </script>
</div>
<?php }) ?>