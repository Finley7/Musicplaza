<div class="col-md-4">
    <div class="card">
        <div class="card-header card-primary">
            Recente posts
        </div>

        <?php foreach ($recent_threads as $thread): ?>
            <a href="<?= $this->Url->build([
                'controller' => 'Threads',
                'action' => 'view',
                $thread->id,
                $thread->slug,
                '?' => ['action' => 'lastpost']
            ]); ?>" class="list-group-item">
                <h5 class="list-group-item-heading"><?= $thread->title; ?></h5>
                <p class="list-group-item-text"><?= __("{0}  <span class='pull-right'>{1}</span>", [
                        "<span class='" . $thread->lastposter->primary_role->name . "'>" . $thread->lastposter->username . "</span>",
                        $thread->lastpost_date->timeAgoInWords()
                    ]); ?></p>
            </a>
        <?php endforeach; ?>

    </div>
</div>