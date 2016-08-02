<section class="main">
    <div class="container">
        <div class="row">
            <?= $this->element('Menu/admin_menu', ['pageParent' => 'dashboard']); ?>
            <div style="margin-top:15px;" class="col-md-9">
                <div class="card">
                    <div class="card-header card-primary">
                        Voeg een nieuwe sectie toe!
                    </div>
                    <div class="card-block">
                        <legend>Sectie toevoegen</legend>
                        <?= $this->Form->create($section); ?>
                            <fieldset class="form-group">
                                <?= $this->Form->input('name', ['class' => 'form-control']); ?>
                            </fieldset>
                            <fieldset class="form-group">
                                <?= $this->Form->input('description', ['class' => 'form-control']); ?>
                            </fieldset>
                            <fielset class="form-group">
                                <label for="role">Minimale rol</label>
                                <select id="role" name="min_role" class="form-control">
                                    <?php foreach($roles as $role): ?>
                                        <option value="<?= $role->id; ?>" <?= ($role->name == 'User') ? 'selected' : ''; ?>>
                                            <?= $role->name; ?>
                                        </option>

                                    <?php endforeach; ?>
                                </select>
                            </fielset>
                        <?= $this->Form->submit(__('Toevoegen'), ['class' => 'btn btn-success']); ?>
                        <?= $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
