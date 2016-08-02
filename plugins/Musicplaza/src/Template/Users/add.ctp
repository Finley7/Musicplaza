<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?= __('Create your account'); ?>
                </div>
                <div class="panel-body">
                    <?= $this->Form->create($new_user); ?>
                    <div class="col-md-12 col-xs-12 col-lg-12">
                        <fieldset class="form-group">
                            <?= $this->Form->input('username', ['class' => 'form-control']); ?>
                            <p class="text-muted"><?= __('This is your username that is unique to you. It is linked to your account'); ?></p>
                        </fieldset>
                    </div>
                    <div class="col-md-12 col-xs-12 col-lg-12">
                        <fieldset class="form-group">
                            <?= $this->Form->input('email', ['class' => 'form-control']); ?>
                            <p class="text-muted"><?= __('Here you enter your e-mail adres. We need it to send you your information when you lost it!'); ?></p>
                        </fieldset>
                    </div>
                    <div class="col-md-6 col-xs-12 col-lg-6">
                        <fieldset class="form-group">
                            <?= $this->Form->input('password', ['class' => 'form-control']); ?>
                            <p class="text-muted"><?= __('Choose a strong password'); ?></p>
                        </fieldset>
                    </div>
                    <div class="col-md-6 col-xs-12 col-lg-6">
                        <fieldset class="form-group">
                            <?= $this->Form->input('password_verify', ['class' => 'form-control', 'type' => 'password']); ?>
                            <p class="text-muted"><?= __('Just to be sure you did not mistype your password'); ?></p>
                        </fieldset>
                    </div>
                    <div class="col-md-12 col-xs-12 col-lg-12">
                        <p class="text-muted"><?= __('By registering to Empire you agree the terms of service'); ?></p>
                        <?= $this->Form->submit(__('Create my account'), ['class' => 'btn btn-primary']); ?>
                    </div>
                    <?= $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>