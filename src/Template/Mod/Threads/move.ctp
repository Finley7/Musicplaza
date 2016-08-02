<section class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-primary">
                        Verplaats thread <?= $thread->name; ?>
                    </div>
                    <div class="card-block">
                        <legend>Verplaats thread '<?= $thread->title; ?>'</legend>
                        <br>
                        <?= $this->Form->create(); ?>
                        <fieldset class="form-group">
                            <label for="forum_type">Ik wil deze thread verplaatsen naar</label>
                            <br>
                            <label class="c-input c-radio forum_type">
                                <input id="forum_type" class="forum-type" name="forum_type" value="forum" type="radio">
                                <span class="c-indicator"></span>
                                Een forum (direct)
                            </label>
                            <label class="c-input c-radio forum_type">
                                <input id="forum_type" class="forum-type" name="forum_type" value="subforum" type="radio">
                                <span class="c-indicator"></span>
                                Een subforum (een vertakking van een forum)
                            </label>
                        </fieldset>
                        <fieldset style="display:none;" class="form-group forum">
                            <label for="forum_id">Forum</label>
                            <?= $this->Form->select('forum_id', $forums, ['class' => 'form-control']); ?>
                        </fieldset>
                        <fieldset style="display:none;" class="form-group subforum">
                            <label for="forum_id">Subforum</label>
                            <?= $this->Form->select('subforum_id', $subforums, ['class' => 'form-control']); ?>
                        </fieldset>
                        <?= $this->Form->submit(__('Verplaatsen'), ['class' => 'btn btn-warning']); ?>
                        <?= $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>

    $('.forum_type').click(function(){
        if($('input[name="forum_type"]:checked').val() == 'forum'){
            $('.subforum').hide();
            $('.forum').show();
        }
        else
        {
            $('.subforum').show();
            $('.forum').hide();
        }
    })
</script>