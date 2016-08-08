<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Musicplaza |
        <?= isset($title) ? $title : $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">

    <meta name="author" content="Finley Siebert">
    <meta name="theme-color" content="#ff5a26">

    <?= $this->Html->css('bootstrap.min.css') ?>
    <link rel="stylesheet" href="https://bootswatch.com/yeti/bootstrap.min.css">
    <?= $this->Html->css('font-awesome.min.css') ?>
    <?= $this->Html->css('amaran.min.css'); ?>
    <?= $this->Html->css('animate.min.css'); ?>

    <?= $this->Html->css('base.css') ?>


    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    <?= $this->Html->script('jquery-2.2.4.min'); ?>
    <?= $this->Html->script('jquery.amaran.min.js'); ?>
    <?= $this->Html->script('bootstrap.min'); ?>

</head>
<body>
<?= $this->Flash->render() ?>
<?= $this->Flash->render('auth') ?>

<?php
    if(isset($user) && $user->id > 0) {
       echo $this->Element('Menu/logged_in');
    }
    else
    {
        echo $this->Element('Menu/default');
    }
?>

<?= $this->fetch('content') ?>

<?= $this->element('footer'); ?>

</body>
</html>