<section class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-primary">
                        <?= __('Aanmelden op VinylVinder'); ?>
                    </div>
                    <div class="card-block">
                        <legend><?= __('Maak een account aan om mee te doen aan het forum!'); ?></legend>
                        <?= $this->Form->create($user); ?>
                        <fieldset class="form-group">
                            <?= $this->Form->input('username', ['class' => 'form-control']); ?>
                        </fieldset>
                        <fieldset class="form-group">
                            <?= $this->Form->input('password', ['class' => 'form-control']); ?>
                        </fieldset>
                        <fieldset class="form-group">
                            <?= $this->Form->input('password_verify', ['class' => 'form-control', 'type' => 'password']); ?>
                        </fieldset>
                        <fieldset class="form-group">
                            <?= $this->Form->input('email', ['class' => 'form-control']); ?>
                        </fieldset>
                        <fieldset class="form-group">
                            <label style="display:block;" for="dob"><?= __('Geboortedag'); ?></label>
                            <?= $this->Form->datetime('dob', [
                                'minYear' => 1900,
                                'maxYear' => date('Y') - 12,
                                'minute' => false,
                                'hour' => false,
                                'meridian' => false,
                                'year' => [
                                    'style' => 'width:100px;display:inline-block;',
                                    'class' => 'form-control'
                                ],
                                'month' => [
                                    'style' => 'width:125px;display:inline-block;',
                                    'class' => 'form-control'
                                ],
                                'day' => [
                                    'style' => 'width:100px;display:inline-block;',
                                    'class' => 'form-control'
                                ]
                            ]);
                            ?>
                        </fieldset>
                        <?= $this->Html->link(__('Toch inloggen?'),['action' => 'login'], ['class' => 'btn btn-primary pull-right']); ?>
                        <?= $this->Form->submit(__('Maak je account'), ['class' => 'btn btn-success']); ?>
                        <?= $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>