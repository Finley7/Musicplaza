<section class="main">
    <div class="container">
        <div class="row">
            <?= $this->element('Menu/admin_menu', ['pageParent' => 'dashboard']); ?>
            <div style="margin-top:15px;" class="col-md-9">
                <div class="card">
                    <div class="card-header card-primary">
                        Bekijk gebruikers
                    </div>
                    <div class="card-block">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Gebruikersnaam</th>
                                <th>E-mail adres</th>
                                <th>Primaire rol</th>
                                <th>Aangemaakt</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($users as $member): ?>
                                <tr scope="row">
                                    <td><?= $member->id; ?></td>
                                    <td><span style="font-size:18px;" class="<?= $member->primary_role->name; ?>">
                                <?= $this->Html->link($member->username, [
                                    'controller' => 'Users',
                                    'action' => 'view',
                                    $member->username
                                ], ['style' => 'color:inherit;']); ?>
                            </span></td>
                                    <td><?= $member->email; ?></td>
                                    <td><?= $member->primary_role->name; ?></td>
                                    <td><?= $member->created_at->nice() ?></td>
                                    <td><?= $this->Html->link(__('Bewerken'), [
                                            'controller' => 'Users',
                                            'action' => 'edit',
                                            $member->id,
                                        ], ['class' => 'btn btn-xs btn-warning']); ?>
                                        <?=  $this->Form->postButton(__('Waarschuwen'), [
                                            'controller' => 'Users',
                                            'action' => 'disable',
                                            $member->id,
                                        ], ['class' => 'btn btn-xs btn-danger']) ?>
                                        <?=  $this->Form->postButton(__('Verbannen'), [
                                            'controller' => 'Users',
                                            'action' => 'disable',
                                            $member->id,
                                        ], ['class' => 'btn btn-xs btn-info']) ?></td>
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
