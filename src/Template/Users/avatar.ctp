<section class="main">
    <div class="container">
        <div class="row">
            <?= $this->element('Menu/settings_menu'); ?>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header card-primary">
                        Bewerk je avatar
                    </div>
                    <div class="card-block">
                        <?= $this->Html->image('uploads/avatars/' . $editUser->avatar, ['class' => 'img-circle', 'style' => 'width:150px']); ?>
                        <?= $this->Form->create($editUser, ['type' => 'file']); ?>
                            <fieldset class="form-group">
                                <?= $this->Form->file('avatar'); ?>
                            </fieldset>
                            <?= $this->Form->submit('Uploaden'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>