<div class="col-md-3">
    <div class="card">
        <div class="card-header card-primary">
            Jouw profiel
        </div>
        <ul class="list-group">
            <?= $this->Html->link('<i class="fa fa-user" aria-hidden="true"></i> Je eigen profiel', [
                'controller' => 'Users',
                'action' => 'view',
                $user->id,
            ], ['class' => 'list-group-item', 'escape' => false]); ?>
            <?= $this->Html->link('<i class="fa fa-camera" aria-hidden="true"></i> Verander avatar', [
                'controller' => 'Users',
                'action' => 'avatar'
            ], ['class' => 'list-group-item', 'escape' => false]); ?>
            <?= $this->Html->link('<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Verander handtekening', [
                'controller' => 'Users',
                'action' => 'autograph'
            ], ['class' => 'list-group-item', 'escape' => false]); ?>
        </ul>

    </div>
</div>