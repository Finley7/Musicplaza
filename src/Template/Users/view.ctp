<?php
$this->Html->addCrumb('Forum index', '/forums');
$this->Html->addCrumb(__("Gebruiker {0} bekijken", $profile->username));
?>
<section class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="profile">
                    <div class="card">
                        <div class="card-block">
                            <?= $this->Html->image('uploads/avatars/' . $profile->avatar, ['class' => 'avatar profile img-circle pull-left img-thumbnail img-responsive']); ?>
                            <h4 class="<?= $profile->primary_role->name; ?>" style="display:inline-block;">
                                <?= $profile->username; ?>
                            </h4>
                            <span class="label label-default label-<?= $profile->primary_role->name; ?>">
                                <?= $profile->primary_role->name; ?>
                            </span>
                            </p>
                            <ul class="user-information">
                                <li><i class="fa fa-fw fa-comments-o"></i> Berichten: <?= $comments->count(); ?></li>
                                <li><i class="fa fa-fw fa-commenting-o"></i> Topics: <?= $threads->count(); ?></li>
                                <li><i class="fa fa-fw fa-clock-o"></i> Aangemaakt op: <?= $profile->created_at->nice(); ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
