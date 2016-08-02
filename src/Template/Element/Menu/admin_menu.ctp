<div style="margin-top:15px;" class="col-md-3">
    <?php if($user->hasPermission('admin_sections_index')): ?>
        <div class="card">
            <div class="card-header card-primary">
                Algemeen forum beheer
            </div>
            <ul class="list-group list-group-flush">
                <?= $this->Html->link('<i class="fa fa-archive"></i> ' . __('Secties bekijken'), ['controller' => 'Sections', 'action' => 'index'], ['class' => 'list-group-item', 'escape' => false]); ?>
                <?= $this->Html->link('<i class="fa fa-plus"></i> ' . __('Secties toevoegen'), ['controller' => 'Sections', 'action' => 'add'], ['class' => 'list-group-item', 'escape' => false]); ?>
                <li class="list-group-item" style="background:#f3f3f3;"><?= __('Forum & Subforum beheer'); ?></li>
                <?= $this->Html->link('<i class="fa fa-comment"></i> ' . __('Forums bekijken'), ['controller' => 'Forums', 'action' => 'index'], ['class' => 'list-group-item', 'escape' => false]); ?>
                <?= $this->Html->link('<i class="fa fa-commenting"></i> ' . __('Forums toevoegen'), ['controller' => 'Forums', 'action' => 'add'], ['class' => 'list-group-item', 'escape' => false]); ?>
                <?= $this->Html->link('<i class="fa fa-file-text"></i> ' . __('Subforums bekijken'), ['controller' => 'Subforums', 'action' => 'index'], ['class' => 'list-group-item', 'escape' => false]); ?>
                <?= $this->Html->link('<i class="fa fa-plus-circle"></i> ' . __('Subforums toevoegen'), ['controller' => 'Subforums', 'action' => 'add'], ['class' => 'list-group-item', 'escape' => false]); ?>

            </ul>
        </div>
    <?php endif; ?>
    <?php if($user->hasPermission('admin_users_index')): ?>
        <div class="card">
            <div class="card-header card-primary">
                Algemeen leden beheer
            </div>
            <ul class="list-group list-group-flush">
                <?= $this->Html->link('<i class="fa fa-users"></i> ' . __('Leden'), ['controller' => 'Users', 'action' => 'index'], ['class' => 'list-group-item', 'escape' => false]); ?>
                <li class="list-group-item" style="background:#f3f3f3;"><?= __('Waarschuwingen'); ?></li>
                <?= $this->Html->link('<i class="fa fa-exclamation"></i> ' . __('Actieve waarschuwingen'), ['controller' => 'Sections', 'action' => 'index'], ['class' => 'list-group-item', 'escape' => false]); ?>
                <?= $this->Html->link('<i class="fa fa-exclamation-triangle"></i> ' . __('Waarschuwing geven'), ['controller' => 'Sections', 'action' => 'index'], ['class' => 'list-group-item', 'escape' => false]); ?>
            </ul>
        </div>
    <?php endif; ?>
</div>
