<section class="main">
    <div class="container">
        <div class="row">
            <?= $this->element('Menu/admin_menu', ['pageParent' => 'dashboard']); ?>
            <div style="margin-top:15px;" class="col-md-9">
                <div class="card">
                    <div class="card-header card-primary">
                        Voeg een nieuw subforum toe!
                    </div>
                    <div class="card-block">
                        <legend>Subforum toevoegen</legend>
                        <?= $this->Form->create($subforum); ?>
                            <fieldset class="form-group">
                                <?= $this->Form->input('title', ['class' => 'form-control']); ?>
                            </fieldset>
                            <fieldset class="form-group">
                                <?= $this->Form->input('description', ['class' => 'form-control']); ?>
                            </fieldset>
                            <fielset class="form-group">
                                <label for="role">Minimale permissie</label>
                                <span class="text-muted">Vanaf welke permissie kan een gebruiker threads plaatsen in het forum?</span>
                                <select id="role" name="min_permission" class="form-control">
                                    <?php foreach($user->_getPermissions() as $permission): ?>
                                        <option value="<?= $permission; ?>">
                                            <?= $permission; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </fielset>
                        <br>
                            <fieldset class="form-group">
                                <label for="section">Hoofdforum</label>
                                <span class="text-muted">In welke sectie word dit forum geplaatst?</span>
                                <?= $this->Form->select('parent_forum', $forums, ['class' => 'form-control']); ?>
                            </fieldset>
                        <?= $this->Form->submit(__('Toevoegen'), ['class' => 'btn btn-success']); ?>
                        <?= $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>