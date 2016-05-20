<?php $t->extend('layout') ?>
<?php $t['title'] = 'Read '.$t['bundle']['collection'] ?>
<?php $t->section('main', function($data) { ?>
<form id="form" method="POST">
    <div class="mdl-card mdl-card--page">
        <div class="mdl-card__supporting-text">
            <?php foreach ($this->call('route.bundle', 'getSchema')->format('inputFields') as $field): ?>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-dirty">
                <?php echo $field->format('label') ?>
                <?php echo $field->format('readonly', @$data['entry'][$field['name']]) ?>
            </div>
            <?php endforeach ?>

            <script>
                // document.addEventListener('DOMLoadedContent', function() {
                //     setTimeout(function() {

                        // Array.prototype.forEach.call(document.querySelectorAll('label'), function(el) {
                        //     el.classList.add('is-dirty');
                        // });
                //     }, 300);
                // });
            </script>
        </div>
    </div>
</form>
<?php }) ?>

<?php $t->section('actions', function($data) { ?>
<a href="<?php echo $this->bundleUrl('/{$id}/update', $data['entry']) ?>" class="mdl-button mdl-js-button mdl-button--icon mdl-button--accent"><i class="material-icons">edit</i></a>
<a href="<?php echo $this->bundleUrl('/{$id}/delete', $data['entry']) ?>" id="deleteBtn" class="mdl-button mdl-js-button mdl-button--icon mdl-button--accent"><i class="material-icons">delete</i></a>
<script>
    deleteBtn.addEventListener('click', function() {
        var request = new XMLHttpRequest();
        request.open('DELETE', deleteBtn.href, true);
        request.setRequestHeader('Content-Type', 'application/json');
        request.onload = function() {
            if (request.status >= 200 && request.status < 400) {
                location.href = '<?php echo $this->bundleUrl() ?>';
            } else {
                alert('Error deleting...');
            }
        };

        request.onerror = function() {
            alert('Error deleting...');
        };
        request.send();
    });
</script>
<?php }) ?>