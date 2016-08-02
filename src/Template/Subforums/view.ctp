<?php
$this->Html->addCrumb('Forum index', '/forums');
$this->Html->addCrumb($subforum->forum->name, '/forums/view/' . $subforum->forum->id);
$this->Html->addCrumb($subforum->title);
?>
<section class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-primary">
                        <?= __('Threads in {0}', $subforum->title); ?>
                        <?php if ($user->hasPermission($subforum->forum->min_permission)): ?>
                            <?= $this->Html->link(__('Nieuwe thread'), [
                                'controller' => 'Threads',
                                'action' => 'add',
                                $subforum->forum->id
                            ], ['class' => 'btn btn-success btn-xs pull-right']); ?>
                        <?php endif; ?>
                    </div>
                    <div class="card-block">
                        <?php if (empty($threads)): ?>
                            <div class="alert alert-info"><?= __('Er is/zijn geen threads voor dit forum'); ?></div>
                        <?php endif; ?>
                        <?php foreach ($threads as $thread): ?>
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
                                        $thread->lastposter->username
                                    ], ['escape' => false]); ?><br/>
                                    <small><?= $thread->lastpost_date->timeAgoInWords(); ?></small>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?= $this->element('Interactive/recent_threads'); ?>
        </div>
    </div>
</section>
