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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-primary">
                        <?= __('{0} resultaten gevonden!', (isset($records)) ? $records->totalResultSize : 'Nog geen zoek'); ?>
                    </div>
                    <div class="card-block">
                        <?php if(isset($records) && $records->totalResultSize > 0): ?>
                        <ul class="list-group">

                            <?php
                            foreach($records->products as $record):

                                $album_cover = (!isset($record->images)) ? "./img/not-found.png" : $record->images[2]->url;
                                $album_info = (isset($record->shortDescription)) ?  $record->shortDescription : __('Geen verdere omschrijving beschikbaar');

                                ?>
                            <li class="media list-group-item">
                                <a class="media-left">
                                    <img style="width:150px;height:150px;" src="<?= $album_cover; ?>" alt="">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><?= $record->specsTag; ?> - <?= $record->title; ?></h4>
                                    <?= $album_info; ?>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <?php elseif(!isset($records)): ?>
                            <div class="alert alert-info"><?= __('Zorg dat je minimaal 4 karakters hebt'); ?></div>
                        <?php else: ?>
                            <div class="alert alert-warning"><?= __('Er zijn 0 resultaten!'); ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= debug($records->products); ?>