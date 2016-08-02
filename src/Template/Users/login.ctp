<section class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-primary">
                        <?= __('Aanmelden op VinylVinder'); ?>
                    </div>
                    <div class="card-block">
                        <legend><?= __('Log in om mee te doen met de community!'); ?></legend>
                        <?= $this->Form->create(); ?>
                        <fieldset class="form-group">
                            <?= $this->Form->input('username', ['class' => 'form-control']); ?>
                        </fieldset>
                        <fieldset class="form-group">
                            <?= $this->Form->input('password', ['class' => 'form-control']); ?>
                        </fieldset>
                        <fieldset class="form-group">
                            <?= $this->Html->link(__('Wachtwoord vergeten?'), ['action' => 'forgot']); ?>
                        </fieldset>
                        <?= $this->Html->link(__('Nieuw hier? Maak een account!'),['action' => 'add'], ['class' => 'btn btn-primary pull-right']); ?>
                        <?= $this->Form->submit(__('Aanmelden'), ['class' => 'btn btn-success']); ?>
                        <?= $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>