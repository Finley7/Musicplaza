<section class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2><?= __('VinylVinder, voor vinyl en meer!'); ?></h2>
            </div>
        </div>
        <div class="row">
            <?= $this->Form->create(null, ['url' => ['controller' => 'Search', 'action' => 'index'], 'type' => 'get']); ?>
            <div class="col-md-10">
                <?= $this->Form->input('search_string', ['class' => 'form-control form-control-lg', 'label' => false, 'placeholder' => __('Zoek op artiest, liedje of album!')]); ?>
            </div>
            <div class="col-md-2">
                <button class="btn btn-block btn-success btn-lg"><i class="fa fa-search"></i> Zoeken</button>
            </div>
            <?= $this->Form->end(); ?>
        </div>
    </div>
</section>
<section class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-8">

            </div>
            <?= $this->element('Interactive/recent_threads'); ?>
        </div>
    </div>
</section>
