<?php $this->Html->addCrumb('Forum index'); ?>
<section class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php foreach ($sections as $section): ?>
                    <?php if (!$section->deleted): ?>
                        <div class="card">
                            <div class="card-header card-primary">
                                <?= $section->name; ?>
                            </div>
                            <div class="card-block">
                                <?php
                                foreach ($section->forums as $forum):
                                    $latest_thread = $section->getLatestThreads($forum->id);
                                    ?>
                                    <div class="row forum-row">
                                        <div class="col-xs-12 col-md-8 col-sm-8">
                                            <div
                                                class="hidden-xs visible-sm visible-lg visible-md pull-left forum-icon">
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
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <?= $this->element('Interactive/recent_threads'); ?>
        </div>
    </div>
</section>
