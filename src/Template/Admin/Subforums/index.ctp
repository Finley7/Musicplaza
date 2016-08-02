<section class="main">
    <div class="container">
        <div class="row">
            <?= $this->element('Menu/admin_menu', ['pageParent' => 'dashboard']); ?>
            <div style="margin-top:15px;" class="col-md-9">
                <div class="card">
                    <div class="card-header card-primary">
                        Bekijk secties
                    </div>
                    <div class="card-block">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Naam</th>
                                <th>Omschrijving</th>
                                <th>Minimale rol</th>
                                <th>Hoofd forum</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($subforums as $subforum): ?>
                                <tr scope="row">
                                    <td><?= $subforum->id; ?></td>
                                    <td><?= $subforum->title; ?></td>
                                    <td><?= $subforum->description; ?></td>
                                    <td><?= $subforum->min_permission; ?></td>
                                    <td><?= $subforum->forum->name ?></td>
                                    <td><?= $this->Html->link(__('Bewerken'), [
                                            'controller' => 'Subforums',
                                            'action' => 'edit',
                                            $subforum->id,
                                        ], ['class' => 'btn btn-xs btn-warning']); ?>
                                        <?=  $this->Form->postButton(__('Uitschakelen'), [
                                            'controller' => 'Subforums',
                                            'action' => 'disable',
                                            $subforum->id,
                                        ], ['class' => 'btn btn-xs btn-danger']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <hr>
                        <nav style="margin:0;padding:0;">
                            <ul class="pagination pagination-sm">
                                <li class="page-item">
                                    <?= $this->Paginator->prev(__('Back'), ['class' => 'page-link']) ?>
                                </li>
                                <li class="page-item">
                                    <?= $this->Paginator->numbers(['class' => 'page-link']); ?>
                                </li>
                                <li class="page-item">
                                    <?= $this->Paginator->next(__('Next'), ['class' => 'page-link']) ?>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
