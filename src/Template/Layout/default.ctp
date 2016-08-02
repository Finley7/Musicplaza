<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
    <title>
        VinylVinder |
        <?= isset($title) ? $title : $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->meta('description', 'Vinylvinder: Een forum voor muziekliefhebbers!'); ?>
    <?= $this->Html->meta('title', 'Vinylvinder ~ ' . isset($title) ? $title : $this->fetch('title')); ?>
    <?= $this->Html->meta('keywords', 'muziek,vinyl,cd,forum,discussiebord,genesis,pink floyd'); ?>
    <?= $this->Html->meta('google-site-verification', 'WmAm1iIazYcUQw-HEkC2x-5c1RbVm0rEHO0I2peuMuU'); ?>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="author" content="Finley Siebert">

    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('shCore.css') ?>
    <?= $this->Html->css('shThemeDefault.css') ?>
    <?= $this->Html->css('font-awesome.min.css') ?>
    <?= $this->Html->css('amaran.min.css'); ?>
    <?= $this->Html->css('animate.min.css'); ?>
    <?= $this->Html->css('base.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <?= $this->Html->css('wbbtheme.css'); ?>
    <?= $this->Html->script('jquery.wysibb.min.js'); ?>
    <?= $this->Html->script('shCore.js'); ?>
    <?= $this->Html->script('shLegacy.js'); ?>
    <?= $this->Html->script('shBrushPhp.js'); ?>
    <?= $this->Html->script('jquery.amaran.min.js'); ?>
</head>
<body>
<?= $this->Flash->render() ?>
<?= $this->Flash->render('auth') ?>
<nav class="navbar navbar-dark" style="background:#5183b2;border-radius:0;">
    <div class="container">
        <?= $this->Html->link("<i class=\"fa fa-play-circle\"></i> VinylVinder</a>", [
            'controller' => 'Pages',
            'action' => 'landing',
            'prefix' => false,
        ], [
            'class' => 'navbar-brand',
            'escape' => false
        ]); ?>
        <ul class="nav navbar-nav pull-right">
            <li class="<?= ($page_parent == 'home') ? 'nav-item active' : 'nav-item'; ?>">
                <?= $this->Html->link(__(' Home'), [
                    'controller' => 'Pages',
                    'action' => 'landing',
                    'prefix' => false,
                ], [
                    'class' => 'nav-link',
                    'id' => 'home'
                ]); ?>

            </li>
            <li class="<?= ($page_parent == 'search') ? 'nav-item active' : 'nav-item'; ?>">
                <?= $this->Html->link(__(' Zoeken'), [
                    'controller' => 'Search',
                    'action' => 'index',
                    'prefix' => false,
                ], [
                    'class' => 'nav-link',
                    'id' => 'search'
                ]); ?>
            </li>
            <li class="nav-item <?= ($page_parent == 'community') ? 'nav-item active' : 'nav-item'; ?>">
                <?= $this->Html->link(__(' Community'), [
                    'controller' => 'Forums',
                    'action' => 'index',
                    'prefix' => false,
                ], [
                    'class' => 'nav-link',
                    'id' => 'community'
                ]); ?>
            </li>
            <li class="nav-item <?= ($page_parent == 'user') ? 'nav-item active' : 'nav-item'; ?>">
                <?php if (isset($user->id)): ?>
                    <?= $this->Html->link(' ' . $user->username, [
                        'controller' => 'Users',
                        'action' => 'view',
                        $user->username,
                        'prefix' => false,
                    ], [
                        'class' => 'nav-link',
                        'id' => 'user'
                    ]); ?>
                <?php else: ?>
                    <?= $this->Html->link(__(' Aanmelden'), [
                        'controller' => 'Users',
                        'action' => 'login',
                        'prefix' => false,
                    ], [
                        'class' => 'nav-link',
                        'id' => 'user'
                    ]); ?>
                <?php endif; ?>
            </li>
            <?php if (!isset($user->id)): ?>
                <li class="nav-item <?= ($page_parent == 'add') ? 'nav-item active' : 'nav-item'; ?>">
                    <?php if (\Cake\Core\Configure::read('App.can_register')): ?>
                        <?= $this->Html->link(__(' Maak een account'), [
                            'controller' => 'Users',
                            'action' => 'add',
                            'prefix' => false,
                        ], [
                            'class' => 'nav-link',
                            'id' => 'add'
                        ]); ?>
                    <?php endif ?>
                </li>
            <?php endif; ?>
            <li class="nav-item <?= ($page_parent == 'settings') ? 'nav-item active' : 'nav-item'; ?>">
                <?php if (isset($user->id)): ?>
                    <?= $this->Html->link('<i class="fa fa-gear"></i>', [
                        'controller' => 'Users',
                        'action' => 'settings',
                        'prefix' => false,
                    ], [
                        'class' => 'nav-link',
                        'escape' => false
                    ]); ?>
                <?php endif; ?>
            </li>
            <?php if (isset($user->id)): ?>
            <li class="nav-item active">
                <?php if($user->hasPermission('mod_pages_landing')): ?>
                    <?= $this->Html->link('<i class="fa fa-star"></i> MOD', [
                        'controller' => 'Pages',
                        'action' => 'landing',
                        'prefix' => 'mod',
                    ], [
                        'class' => 'nav-link',
                        'escape' => false
                    ]); ?>
                <?php endif; ?>
            </li>
            <li class="nav-item active">
                <?php if($user->hasPermission('admin_pages_landing')): ?>
                    <?= $this->Html->link('<i class="fa fa-bolt"></i> ACP', [
                        'controller' => 'Pages',
                        'action' => 'landing',
                        'prefix' => 'admin',
                    ], [
                        'class' => 'nav-link',
                        'escape' => false
                    ]); ?>
                <?php endif; ?>
            </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
<?php if ($page_parent == 'community'): ?>
    <section class="brcrmb">
        <div class="container">
            <div class="col-md-12">
                <div class="row">
                    <?= $this->Html->getCrumbList([
                        'lastClass' => 'active',
                        'class' => 'breadcrumb',
                        'escape' => false
                    ], '<i class="fa fa-play-circle" aria-hidden="true"></i>
 Vinylvinder'); ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<?= $this->fetch('content') ?>
<footer>
    <div class="container">
        <div class="col-md-12">
            <div class="row">
                <div class="card card-block">
                    <?php if(isset($user->id)): ?>
                    <span class="pull-right">
                        <span class="text-muted">Ingelogd als <?= $user->username; ?> | </span>
                        <?= $this->Form->postLink('Uitloggen', ['controller' => 'Users', 'action' => 'logout'], ['class' => 'btn btn-xs btn-primary-outline']); ?>
                    </span>
                    <?php endif; ?>
                    Copyright &copy; 2016 VinylVinder - Alle rechten voorbehouden.
                </div>
            </div>
        </div>
    </div>
</footer>
</body>
</html>
