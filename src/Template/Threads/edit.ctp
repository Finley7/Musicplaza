<?php
$this->Html->addCrumb('Forum index', '/forums');
$this->Html->addCrumb($forum->name, '/forums/view/' . $forum->id);
$this->Html->addCrumb(__('Bewerk thread: {0}', $forum->name));

?>
<section class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-primary">
                        <?= __('Maak een nieuwe thread in {0}', $forum->name); ?>
                    </div>
                    <div class="card-block">
                        <?= $this->Form->create($thread); ?>
                        <fieldset class="form-group">
                            <?= $this->Form->input('title', ['class' => 'form-control']); ?>
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="body">Bericht</label>
                            <textarea name="body" id="body" class="form-control" cols="30" rows="10"><?= $thread->body; ?></textarea>
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="subforum">Subforum (optioneel)</label>
                            <select name="subforum" id="subforum" class="form-control">
                                <option value="null">Geen subforum</option>
                                <?php foreach($forum->subforums as $subforum): ?>
                                    <option value="<? $subforum->id; ?>"><?= $subforum->title; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </fieldset>
                        <?= $this->Form->submit(__('Plaats thread'), ['class' => 'btn btn-success']); ?>
                        <?= $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>



    var wbbOpt = {
        onlyBBmode: false
    }

    $("#body").wysibb(wbbOpt);

</script>