<section class="main">
    <div class="container">
        <div class="row">
            <?= $this->element('Menu/settings_menu'); ?>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header card-primary">
                        Bewerk je handtekening
                    </div>
                    <div class="card-block">
                        <legend>Je handtekening bewerken</legend>
                        <?= $this->Form->create($editUser); ?>
                        <fieldset class="form-group">
                            <label for="body">Handtekening</label>
                            <textarea name="autograph" id="body" class="form-control" rows="3"><?= $editUser->autograph; ?></textarea>
                        </fieldset>
                        <?= $this->Form->submit(__('Opslaan'), ['class' => 'btn btn-success']); ?>
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