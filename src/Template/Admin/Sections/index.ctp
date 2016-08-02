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
                                <th>Ingeschakeld</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($sections as $section): ?>
                                <tr scope="row">
                                    <td><?= $section->id; ?></td>
                                    <td><?= $section->name; ?></td>
                                    <td><?= $section->description; ?></td>
                                    <td><?= $section->min_role; ?></td>
                                    <td><?= ($section->deleted) ? 'Nee' : 'Ja'; ?></td>
                                    <td><?= $this->Html->link(__('Bewerken'), [
                                            'controller' => 'Sections',
                                            'action' => 'edit',
                                            $section->id,
                                        ], ['class' => 'btn btn-xs btn-warning']); ?>
                                        <?= (!$section->deleted) ? $this->Form->postButton(__('Uitschakelen'), [
                                            'controller' => 'Sections',
                                            'action' => 'disable',
                                            $section->id,
                                        ], ['class' => 'btn btn-xs btn-danger']) : $this->Form->postButton(__('Inschakelen'), [
                                            'controller' => 'Reports',
                                            'action' => 'enable',
                                            $report->id,
                                        ], ['class' => 'btn btn-xs btn-success']); ?></td>
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
