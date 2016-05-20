<?php $t['layout'] = 'mdl-default-layout' ?>
<?php $t->section('page', function($data) { ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>Application Title</title>

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="images/android-desktop.png">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Material Design Lite">
    <link rel="apple-touch-icon-precomposed" href="images/ios-desktop.png">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="<?php echo $this->assetUrl('/images/touch/ms-touch-icon-144x144-precomposed.png') ?>">
    <meta name="msapplication-TileColor" content="#3372DF">

    <link rel="shortcut icon" href="<?php echo $this->assetUrl('/images/favicon.png') ?>">

    <!-- SEO: If your mobile URL is different from the desktop URL, add a canonical link to the desktop page https://developers.google.com/webmasters/smartphone-sites/feature-phones -->
    <!--
    <link rel="canonical" href="http://www.example.com/">
    -->

    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en"> -->
    <link rel="stylesheet" href="<?php echo $this->assetUrl('/bower_components/material-design-lite/material.min.css') ?>">
    <link rel="stylesheet" href="<?php echo $this->assetUrl('/fonts/material-icons.css') ?>">
    <link rel="stylesheet" href="<?php echo $this->assetUrl('/css/user.css') ?>">
</head>
<body class="<?php echo $this['layout'] ?>">
    <!-- The drawer is always open in large screens. The header is always shown,
      even in small screens. -->
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
        <?php echo $this->show('header-block', $data) ?>

        <?php echo $this->show('drawer-block') ?>

        <main class="mdl-layout__content">
            <div class="page-content">
                <?php echo $this->show('notification', $data) ?>

                <?php echo $this->show('main', $data) ?>
            </div>
        </main>
    </div>

    <script src="<?php echo $this->assetUrl('/bower_components/material-design-lite/material.min.js') ?>"></script>
</body>
</html>
<?php }) ?>

<?php $t->section('header-block', function ($data) { ?>
<header class="mdl-layout__header">
    <?php echo $this->show('header', $data) ?>
</header>
<?php }) ?>

<?php $t->section('drawer-block', function() { ?>
<div class="mdl-layout__drawer">
    <span class="mdl-layout-title">Application Title</span>
    <nav class="mdl-navigation">
        <a class="mdl-navigation__link" href="<?php echo $this->siteUrl() ?>"><i class="material-icons">list</i> Home</a>
        <a class="mdl-navigation__link" href="<?php echo $this->siteUrl('/auth/user') ?>"><i class="material-icons">list</i> User</a>
        <a class="mdl-navigation__link" href="<?php echo $this->siteUrl('/foo') ?>"><i class="material-icons">list</i> Foo</a>
        <a class="mdl-navigation__link" href="<?php echo $this->siteUrl('/auth/logout') ?>"><i class="material-icons">list</i> Logout</a>
    </nav>
</div>
<?php }) ?>

<?php $t->section('notification', function () { ?>
<div class="notification notification--visible mdl-card mdl-shadow--2dp">
    <?php echo $this->call('@notification', 'render') ?>
    <button class="notification--close mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect">
        <i class="material-icons">clear</i>
    </button>
</div>
<script>
(function() {
    document.querySelector('.notification--close').addEventListener('click', function() {
        document.querySelector('.notification').classList.remove('notification--visible');
    });
})();
</script>
<?php }) ?>

<?php $t->section('header', function($data) { ?>
<div class="mdl-layout__header-row">
    <h2 class="mdl-layout-title"><?php echo @$this['title'] ?></h2>
    <div class="mdl-layout-spacer"></div>
    <?php $this->show('actions', $data) ?>
</div>
<?php }) ?>

<?php $t->section('actions', function() { ?>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable mdl-textfield--floating-label mdl-textfield--align-right">
        <label class="mdl-button mdl-js-button mdl-button--icon" for="search-input">
            <i class="material-icons">search</i>
        </label>
        <div class="mdl-textfield__expandable-holder">
            <input class="mdl-textfield__input" type="text" name="sample" id="search-input">

            <script src="<?php echo $this->assetUrl('/js/criteria-parser.js') ?>"></script>
            <script>
            (function() {
                'use strict';

                function serialize(obj, prefix) {
                    var str = [];
                    for(var p in obj) {
                        if (obj.hasOwnProperty(p)) {
                            var k = prefix ? prefix + "[" + p + "]" : p, v = obj[p];
                            str.push(typeof v == "object" ?
                            serialize(v, k) :
                            encodeURIComponent(k) + "=" + encodeURIComponent(v));
                        }
                    }
                    return str.join("&");
                }

                var searchInput = document.getElementById('search-input');
                searchInput.addEventListener('keypress', function(evt) {
                    var key = evt.which;
                    if (key === 13) {
                        evt.preventDefault();

                        var criteria = Expr.parse(searchInput.value);
                        location.href = location.pathname + '?' + serialize(criteria);
                    }
                });
            })();
            </script>
        </div>
    </div>
<?php }) ?>