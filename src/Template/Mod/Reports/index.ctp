<section class="main">
    <div class="container">
        <div class="row">
            <?= $this->element('Menu/mod_menu', ['pageParent' => 'dashboard']); ?>
            <div style="margin-top:15px;" class="col-md-9">
                <div class="card">
                    <div class="card-header card-primary">
                        Bekijk gerapporteerde berichten
                    </div>
                    <div class="card-block">
                        <table class="table table-responsive table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Behandeld</th>
                                <th>Thread</th>
                                <th>Reactie</th>
                                <th>Reden</th>
                                <th>Tijd</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($reports as $report): ?>
                                <tr scope="row">
                                    <td><?= $report->id; ?></td>
                                    <td><?= $report->handled ? 'Ja' : 'Nee'; ?></td>
                                    <td>
                                        <?= $this->Html->link($report->thread->title, [
                                            'controller' => 'Threads',
                                            'action' => 'view',
                                            'prefix' => false,
                                            $report->thread->id,
                                            $report->thread->slug,
                                        ]); ?>
                                    </td>
                                    <td><?= is_null($report->comment) ? '-' : $this->Html->link(
                                            'Reactie id #' . $report->comment->id, [
                                            'controller' => 'Threads',
                                            'action' => 'view',
                                            'prefix' => false,
                                            $report->thread->id,
                                            $report->thread->slug,
                                            '?' => ['pid' => $report->comment->id]
                                        ]);
                                        ?></td>
                                    <td><?= $report->reason; ?></td>
                                    <td><?= $report->created_at->timeAgoInWords(); ?></td>
                                    <td><?= (!$report->handled) ? $this->Form->postButton(__('Markeren als behaneld'), [
                                            'controller' => 'Reports',
                                            'action' => 'view',
                                            $report->id,
                                        ], ['class' => 'btn btn-xs btn-primary']) : '<div class="btn btn-xs btn-primary disabled">Behandled</div>'; ?>
                                        <?= $this->Html->link(__('Bekijken'),
                                            [
                                                'controller' => 'Reports',
                                                'action' => 'view',
                                                $report->id
                                            ], ['class' => 'btn btn-xs btn-info']); ?></td>
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
