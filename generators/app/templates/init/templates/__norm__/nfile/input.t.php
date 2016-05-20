<?php $t->section('main', function ($data) { ?>
<?php $uniqId = uniqid('nfile-') ?>

<style>
    #<?php echo $uniqId ?> {
        display:flex;
        width: 100%;
    }

    #<?php echo $uniqId ?> .viewer {
        flex: 1;
    }

    #<?php echo $uniqId ?> .file {
        display: none;
    }
</style>

<div id="<?php echo $uniqId ?>"  class="mdl-cell mdl-cell--12-col field-group nfile">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label viewer">
        <input type="text"
            class="mdl-textfield__input"
            id="input_<?php echo $data['self']['name'] ?>"
            name="<?php echo $data['self']['name'] ?>"
            value="<?php echo $data['value'] ?>"
            readonly
            />
        <label for="input_<?php echo $data['self']['name'] ?>" class="mdl-textfield__label">
            <?php echo $data['self']->getRepository()->translate($data['self']['label']).(isset($data['self']['filter.required']) ? '*' : '') ?>
        </label>
    </div>
    <input class="file" type="file" />
    <label class="image_input_button mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-js-ripple-effect mdl-button--colored button">
        <i class="material-icons">file_upload</i>
    </label>
</div>

<script>
(function() {
    'use strict';

    var uploadUrl = "<?php echo $data['self']->getAttribute('nfile.uploadUrl') ?>";

    var containerEl = document.getElementById('<?php echo $uniqId ?>');
    var fileEl = containerEl.querySelector('.file');
    var buttonEl = containerEl.querySelector('.button');
    var viewerEl = containerEl.querySelector('.viewer');
    var inputEl = viewerEl.querySelector('input[type=text]');

    buttonEl.addEventListener('click', function(evt) {
        evt.preventDefault();
        fileEl.click();
    });

    fileEl.addEventListener('change', function() {
        var files = this.files;

        function undo() {
            for (var i = 0; i < files.length; i++) {
                files[i].$el.value = '';
            }
        }

        new Promise(function(resolve, reject) {
            var form = new FormData();
            for (var i = 0; i < files.length; i++) {
                var file = files[i];

                inputEl.value = file.name;
                viewerEl.classList.add('is-dirty');

                file.$el = viewerEl;

                // Add the file to the request.
                form.append('files[]', file); //, file.name);
            }

            var request = new XMLHttpRequest();

            request.onerror = undo;

            request.onload = function(evt) {
                if (request.status >= 200 && request.status < 400) {
                    var data = JSON.parse(request.responseText);
                    if (data.files.length !== files.length) {
                        undo();
                        return;
                    }
                    for (var i = 0; i < files.length; i++) {
                        form.append('files[]', files[i]); //, file.name);
                    }
                    // Success!
                } else {
                    undo();
                }
            };
            request.open('POST', uploadUrl, true);
            request.setRequestHeader('X-Data-Dir', "<?php echo $data['self']->getDataDir() ?>");
            request.send(form);
        });
    });
})();
</script>

<?php }) ?>
