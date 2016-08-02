<?php
$this->Html->addCrumb('Forum index', '/forums');
$this->Html->addCrumb($thread->title, '/threads/view/' . $thread->id);
$this->Html->addCrumb(__('Nieuwe reactie op: {0}', $thread->title));
?>
<section class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-primary">
                        Schrijf een reactie
                    </div>
                    <div class="card-block">
                        <?= $this->Form->create($comment); ?>
                        <fieldset class="form-group">
                            <label for="body">Bericht (<a href="http://www.markdowntutorial.com" target="_blank">Markdown</a>, <b>geen</b> UBB!)</label>
                             <textarea name="body" id="body" class="form-control" cols="30" rows="5"></textarea>
                        </fieldset>
                            <?= $this->Form->submit(__('Plaats reactie'), ['class' => 'btn btn-success']); ?>
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
