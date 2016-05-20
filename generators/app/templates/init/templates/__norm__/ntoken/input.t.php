<?php $t->section('main', function($data) { ?>
<?php $uniqueId = uniqid('ntoken-') ?>

<style>
    #<?php echo $uniqueId ?> {
        display:flex;
        width: 100%;
    }

    #<?php echo $uniqueId ?> .viewer {
        flex: 1;
    }

    #<?php echo $uniqueId ?> .file {
        display: none;
    }
</style>

<div id="<?php echo $uniqueId ?>"  class="mdl-cell mdl-cell--12-col field-group ntoken">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input type="text"
            class="mdl-textfield__input"
            id="input_<?php echo $data['self']['name'] ?>"
            name="<?php echo $data['self']['name'] ?>"
            value="<?php echo $data['value'] ?>"
            />
        <label for="input_<?php echo $data['self']['name'] ?>" class="mdl-textfield__label">
            <?php echo $data['self']->getRepository()->translate($data['self']['label']).(isset($data['self']['filter.required']) ? '*' : '') ?>
        </label>
    </div>
    <a class="image_input_button mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-js-ripple-effect mdl-button--colored button">
        <i class="material-icons">adjust</i>
    </a>
</div>

<script type="text/javascript">
(function() {
    'use strict';

    var containerEl = document.querySelector("#<?php echo $uniqueId ?>");
    var textFieldEl = containerEl.querySelector('.mdl-textfield');

    containerEl.querySelector('a').addEventListener("click", function(evt) {
        evt.preventDefault();
        evt.stopImmediatePropagation();

        containerEl.querySelector('input').value = (function makeid(len) {
            len = len || 5;
            var text = "";
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

            for( var i=0; i < len; i++ )
                text += possible.charAt(Math.floor(Math.random() * possible.length));

            return text;
        })(20);

        textFieldEl.classList.add('is-dirty');
    });
})();
</script>


<?php }) ?>
