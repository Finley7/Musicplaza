<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="user-info clearfix">
                    <div class="chatbox">
                        <?= $this->Form->create(null, [
                            'url' => ['controller' => 'Chats', 'action' => 'shout', 'prefix' => 'ajax'],
                            'id' => 'messageform',
                            'style' => 'max-width:1108px;'
                        ]);
                        ?>
                        <div class="input-group">
                            <?= $this->Form->input('message', ['maxlength' => 150, 'autocomplete' => 'off', 'class' => 'form-control', 'label' => false, 'placeholder' => 'Please enter a message']); ?>
                            <span class="input-group-btn">
                             <?= $this->Form->button(__('Send message'), ['class' => 'btn btn-info']); ?>
                         </span>
                        </div>
                        <?= $this->Form->end(); ?>
                    </div>
                </div>
                <ul class="list-group chats"></ul>
                <div class="panel-footer">
                    Er zijn in totaal <strong><?= $this->Number->format($users); ?></strong> aantal leden die <strong><?= $this->Number->format($chats); ?></strong> berichten geplaatst hebben.
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->Html->script('chatzor-2'); ?>