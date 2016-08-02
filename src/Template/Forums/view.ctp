<?php
$this->Html->addCrumb('Forum index', '/forums');
$this->Html->addCrumb($forum->name);
?>
<section class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-primary">
                        <?= __('Subfora van {0}', $forum->name); ?>
                    </div>
                    <div class="card-block">
                        <?php if (empty($forum->subforums)): ?>
                            <div class="alert alert-info"><?= __('Er is/zijn geen subfora voor dit forum'); ?></div>
                        <?php endif; ?>
                        <?php
                        foreach ($forum->subforums as $subforum):
                            $latest_thread = $forum->getLatestThreads($subforum->id);
                            ?>
                            <div class="row forum-row">
                                <div class="col-xs-12 col-md-8 col-sm-8">
                                    <div class="hidden-xs visible-sm visible-lg visible-md pull-left forum-icon">
                                        <i class="fa fa-file-text"></i>
                                    </div>
                                    <?= $this->Html->link($subforum->title, [
                                        'controller' => 'Subforums',
                                        'action' => 'view',
                                        $subforum->id
                                    ]); ?>
                                    <br/>
                                    <small><?= $subforum->description; ?></small>
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
                    </div>
                </div>
                <div class="card">
                    <div class="card-header card-primary">
                        <?= __('Threads in {0}', $forum->name); ?>
                        <?php if ($user->hasPermission($forum->min_permission)): ?>
                            <?= $this->Html->link(__('Nieuwe thread'), [
                                'controller' => 'Threads',
                                'action' => 'add',
                                $forum->id
                            ], ['class' => 'btn btn-success btn-xs pull-right']); ?>
                        <?php endif; ?>
                    </div>
                    <div class="card-block">
                        <?php if (empty($forum->threads)): ?>
                            <div class="alert alert-info"><?= __('Er is/zijn geen threads voor dit forum'); ?></div>
                        <?php endif; ?>
                        <?php foreach ($forum->threads as $thread): ?>

                            <?php if ($thread->subforum_id == 0): ?>
                                <div class="row forum-row">
                                    <div class="col-xs-12 col-md-8 col-sm-8">
                                        <div
                                            class="hidden-xs visible-sm visible-lg visible-md pull-left forum-icon">
                                            <i class="fa fa-comment"></i>
                                        </div>
                                        <?= $this->Html->link($thread->title, [
                                            'controller' => 'Threads',
                                            'action' => 'view',
                                            $thread->id,
                                            $thread->slug,
                                            '?' => ['action' => 'lastpost']
                                        ]); ?>
                                        <br/>
                                        <small><?= __('Aangemaakt door {0} op {1}', [
                                                "<span class='" . $thread->user->primary_role->name . "'>" . $thread->user->username . "</span>",
                                                $thread->created_at->nice()
                                            ]); ?></small>
                                    </div>
                                    <div class="col-xs-12 col-md-4 col-sm-4">
                                        <?= $this->Html->link("<span class='" . $thread->lastposter->primary_role->name . "'>" . $thread->lastposter->username . "</span>", [
                                            'controller' => 'Users',
                                            'action' => 'view',
                                            $thread->lastposter->id
                                        ], ['escape' => false]); ?><br/>
                                        <small><?= $thread->lastpost_date->timeAgoInWords(); ?></small>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?= $this->element('Interactive/recent_threads'); ?>
        </div>
    </div>
</section>
