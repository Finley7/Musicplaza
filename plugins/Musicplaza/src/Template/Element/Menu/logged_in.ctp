<nav class="navbar navbar-default menu-header">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu-collapse"
                    aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="" class="navbar-brand">musicplaza</a>
        </div>
        <div class="collapse navbar-collapse" id="menu-collapse">
            <ul class="nav navbar-nav">
                <li><?= $this->Html->link('<i class="fa fa-home"></i> ' . __('Home'), ['controller' => 'Pages', 'action' => 'landing', 'prefix' => false], ['escape' => false]); ?></li>
                <li><?= $this->Html->link(__('Forum'), ['controller' => 'Forums', 'action' => 'index', 'prefix' => false]); ?></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">
                        <i class="fa fa-globe"></i>
                        <?php if (!is_null($notifications->where(['is_read' => false]))): ?>
                            <span class="amount-wows"><?= $notifications->where(['is_read' => false])->count(); ?></span>
                        <?php endif; ?>
                    </a>
                    <ul class="dropdown-menu userinfo">
                        <?php if (is_null($notifications->first())): ?>
                            <li class="active"><a><?= __('Je hebt geen notificaties'); ?></a></li>
                        <?php else: ?>
                            <?php foreach ($notifications->all() as $notification): ?>
                                <li><?= $this->Form->postLink($notification->message, ['controller' => 'Notifications', 'action' => 'handle', $notification->id]); ?></li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <li role="separator" class="divider"></li>
                        <li><?= $this->Html->link(__('Notificatie center'), ['controller' => 'Notifications', 'action' => 'index']); ?></li>
                    </ul>
                </li>
                <li><?= $this->Html->link('<i class="fa fa-comments"></i>', ['controller' => 'PrivateMessages', 'action' => 'index', 'prefix' => false], ['escape' => false]); ?></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false"><?= $user->username; ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu userinfo">
                        <li><?= $this->Html->link(__('Mijn profiel'), ['controller' => 'Users', 'action' => 'view', $user->username, 'prefix' => false]); ?></li>
                        <li><?= $this->Html->link(__('Instellingen'), ['controller' => 'Users', 'action' => 'settings', 'prefix' => false]); ?></li>
                        <li><?= $this->Html->link(__('Avatar aanpassen'), ['controller' => 'Users', 'action' => 'avatar', 'prefix' => false]); ?></li>
                        <li><?= $this->Html->link(__('Handtekening aanpassen'), ['controller' => 'Users', 'action' => 'autograph', 'prefix' => false]); ?></li>
                        <li role="separator" class="divider"></li>
                        <li><?= $this->Form->postLink(__('Uitloggen'), ['controller' => 'Users', 'action' => 'logout', 'prefix' => false]); ?></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
