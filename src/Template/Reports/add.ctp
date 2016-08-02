<section class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-primary">
                        Rapporteer een reactie/thread
                    </div>
                    <div class="card-block">
                        <legend>Rapporteren</legend>
                        <?= $this->Form->create($report); ?>
                        <fieldset class="form-group row">
                            <label class="col-sm-2 form-control-label">Thread</label>
                            <div class="col-sm-10">
                                <p class="form-control-static"><b><?= $thread->title; ?></b></p>
                            </div>
                        </fieldset>
                        <fieldset class="form-group row">
                            <label class="col-sm-2 form-control-label">Reactie ID</label>
                            <div class="col-sm-10">
                                <p class="form-control-static"><b><?= (!is_null($comment)) ? '#' . $comment->id : '-'; ?></b></p>
                            </div>
                        </fieldset>
                        <fieldset class="form-group row">
                            <label class="col-sm-2 form-control-label">Datum</label>
                            <div class="col-sm-10">
                                <p class="form-control-static"><b><?= (!is_null($comment)) ? 'thread: ' . $thread->created_at->nice() . '. reactie: ' . $comment->created_at->nice() : $thread->created_at->nice(); ?></b></p>
                            </div>
                        </fieldset>
                        <fieldset class="form-group row">
                            <label class="col-sm-2 form-control-label">Reden</label>
                            <div class="col-sm-10">
                                <?= $this->Form->input('reason', ['label' => false, 'class' => 'form-control']); ?>
                            </div>
                        </fieldset>
                        <?= $this->Form->submit(__('Rapporteren'), ['class' => 'btn btn-warning']); ?>
                        <?= $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
