<section class="main">
    <div class="container">
        <div class="row">
            <?= $this->element('Menu/mod_menu', ['pageParent' => 'dashboard']); ?>
            <div style="margin-top:15px;" class="col-md-9">
                <div class="card">
                    <div class="card-header card-primary">
                        Bekijk gerapporteerd bericht <?= $report->id; ?>
                    </div>
                    <div class="card-block">
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Aangegeven door</label>
                            <div class="col-sm-9">
                                <p class="form-control-static"><?= $report->reporter->username; ?></p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Aangegeven op</label>
                            <div class="col-sm-9">
                                <p class="form-control-static"><?= $report->created_at->nice(); ?></p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Aangegeven thread</label>
                            <div class="col-sm-9">
                                <p class="form-control-static"><?= $this->Html->link($report->thread->title, [
                                        'controller' => 'Threads',
                                        'action' => 'view',
                                        'prefix' => false,
                                        $report->thread->id,
                                        $report->thread->slug,
                                    ]); ?></p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Aangegeven reactie</label>
                            <div class="col-sm-9">
                                <p class="form-control-static"><?= is_null($report->comment) ? '-' : $this->Html->link(
                                        $report->thread->title . ' #' . $report->comment->id, [
                                        'controller' => 'Threads',
                                        'action' => 'view',
                                        'prefix' => false,
                                        $report->thread->id,
                                        $report->thread->slug,
                                        '?' => ['pid' => $report->comment->id]
                                    ]);
                                    ?></p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Reden van aangifte</label>
                            <div class="col-sm-9">
                                <p class="form-control-static"><?= h($report->reason); ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Opgelost:</label>
                            <div class="col-sm-9">
                                <p class="form-control-static"><?= $report->handled ? 'Ja' : 'Nee'; ?></p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Opgelost door:</label>
                            <div class="col-sm-9">
                                <p class="form-control-static"><?= is_null($report->handler) ? '-' : $report->handler->username; ?></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div
    </div>
</section>