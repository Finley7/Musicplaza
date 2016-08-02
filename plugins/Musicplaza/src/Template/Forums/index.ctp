<div class="container">
    <div class="row">
        <div class="col-md-12">
            <li class="panel panel-default">
                <div class="header-up">
                    <h1 class="logo text-center">musicplaza forums</h1>
                </div>
                <ul class="list-group">
                    <?php foreach ($sections as $section): ?>
                        <?php if (!$section->deleted): ?>
                            <li style="background:#eee;" class="list-group-item">
                                <?= $section->name; ?>
                            </li>
                            <li class="list-group-item">
                                <?php
                                foreach ($section->forums as $forum):
                                    $latest_thread = $section->getLatestThreads($forum->id);
                                    ?>
                                    <div class="row forum-row">
                                        <div class="col-xs-12 col-md-8 col-sm-8">
                                            <div class="hidden-xs visible-sm visible-lg visible-md pull-left forum-icon">
                                                <i class="fa fa-comment"></i>
                                            </div>
                                            <?= $this->Html->link($forum->name, [
                                                'controller' => 'Forums',
                                                'action' => 'view',
                                                $forum->id
                                            ]); ?>
                                            <br/>
                                            <small><?= $forum->description; ?></small>
                                        </div>
                                        <div class="col-xs-12 col-md-4 col-sm-4">
                                            <?php if (!is_null($latest_thread)): ?>

                                                <p class="forum-data cutoff"><?= $this->Html->link($latest_thread->title, [
                                                        'controller' => 'Threads',
                                                        'action' => 'view',
                                                        $latest_thread->id,
                                                        $latest_thread->slug,
                                                        '?' => ['action' => 'lastpost']
                                                    ]) ?></p>
                                                <small>
                                                    door <?= $this->Html->link("<span class='" . $latest_thread->lastposter->primary_role->name . "'>" . $latest_thread->lastposter->username . "</span>", [
                                                        'controller' => 'Users',
                                                        'action' => 'view',
                                                        $latest_thread->lastposter->username
                                                    ], ['escape' => false]); ?>
                                                    <p class="forum-data">
                                                        <?= $latest_thread->lastpost_date->timeAgoInWords(); ?> </p>
                                                </small>
                                            <?php else: ?>
                                                <p class="forum-data cutoff">-</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </li>

                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
        </div>
    </div>
</div>
</div>