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
                                <th>Ingedeelde sectie</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($forums as $forum): ?>
                                <tr scope="row">
                                    <td><?= $forum->id; ?></td>
                                    <td><?= $forum->name; ?></td>
                                    <td><?= $forum->description; ?></td>
                                    <td><?= $forum->min_permission; ?></td>
                                    <td><?= $forum->section->name ?></td>
                                    <td><?= $this->Html->link(__('Bewerken'), [
                                            'controller' => 'Sections',
                                            'action' => 'edit',
                                            $forum->id,
                                        ], ['class' => 'btn btn-xs btn-warning']); ?>
                                        <?=  $this->Form->postButton(__('Uitschakelen'), [
                                            'controller' => 'Sections',
                                            'action' => 'disable',
                                            $forum->id,
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
