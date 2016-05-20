<?php $t->section('main', function($data) { ?>

<?php $uniqid = uniqid('nreference-list-') ?>
<div id="<?php echo $uniqid ?>" class="field-group mdl-card mdl-shadow--2dp">
    <label>
        <?php echo $data['self']->getRepository()->translate($data['self']['label']).(isset($data['self']['filter.required']) ? '*' : '') ?>
    </label>

    <template class="tpl">
        <?php echo $data['self']->render('__norm__/nreference/input', [
            'self' => $data['self'],
            'name' => $data['self']['name'].'[]',
            'value' => '',
            // 'entry' => '',
        ]); ?>
    </template>

    <div class="container">
        <?php if (!empty($value)): ?>
        <?php foreach ($value as $k => $v): ?>
            <?php echo $data['self']->render('__norm__/nreference/input', [
                'self' => $data['self'],
                'name' => $data['self']['name'].'[]',
                'value' => $v,
                // 'entry' => '',
            ]); ?>
        <?php endforeach ?>
        <?php endif ?>

        <?php echo $data['self']->render('__norm__/nreference/input', [
            'self' => $data['self'],
            'name' => $data['self']['name'].'[]',
            'value' => '',
            // 'entry' => '',
        ]); ?>
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
