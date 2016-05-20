<?php $t->extend('layout-full') ?>
<?php $t->section('main', function ($data) { ?>
<form action="" method="POST">
    <div class="mdl-card mdl-card--page mdl-shadow--16dp">
        <div class="mdl-card__supporting-text">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <label class="mdl-textfield__label" for="input-username">Username</label>
                <input type="text" name="username" id="input-username" class="mdl-textfield__input"
                    value="<?php echo @$data['entry']['username'] ?>" required>
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <label class="mdl-textfield__label" for="input-password">Password</label>
                <input type="password" name="password" class="mdl-textfield__input" id="input-password"
                    required>
            </div>
            <div style="display: flex">
                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="input-keep">
                    <input type="checkbox" id="input-keep" name="keep" class="mdl-checkbox__input" checked>
                    <span class="mdl-checkbox__label">Keep login</span>
                </label>
                <input class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"
                    type="submit" value="Login">
                <div class="mdl-layout-spacer"></div>
            </div>
        </div>
    </div>
</form>
<?php }) ?>