<div style="margin-top:15px;" class="col-md-3">
    <?php if($user->hasPermission('mod_reports_index')): ?>
    <div class="card">
        <div class="card-header card-primary">
            Gerraporteerde berichten
        </div>
        <ul class="list-group list-group-flush">
            <?= $this->Html->link('<i class="fa fa-commenting-o"></i> ' . __('Gerapporteerde berichten'), ['controller' => 'Reports', 'action' => 'index'], ['class' => 'list-group-item', 'escape' => false]); ?>
        </ul>
    </div>
    <?php endif; ?>
</div>
