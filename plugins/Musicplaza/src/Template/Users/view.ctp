<script>
    function loadsong(song_id, post_id) {
        $.getJSON('https://api.spotify.com/v1/tracks/' + song_id + '?market=NL', function (result) {
            $('#timeline_' + post_id + ' .spotify_body').append('<h4>' + result.name + '</h4>');
            $.each(result.artists, function (key, value) {
                $('#timeline_' + post_id + ' .spotify_body > .artists').append('<span>' + value.name + '</span>')
            });
            $('#timeline_' + post_id + ' .spotify_body').append('<span class="text-muted"><i class="fa fa-clock-o"></i> ' + Math.ceil((result.duration_ms / 1000) / 60) + ' minuten</span>')
            $('#timeline_' + post_id + ' .spotify_body .album-img').attr('src', result.album.images[0].url)
            $('#timeline_' + post_id + ' .spotify_body .play').append('<h1><a class="playbutton" target="_blank" href="' + result.external_urls.spotify + '"><i class="fa fa-play-circle"></i></a></h1>')
        });
    }

</script>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading"><?= $profile->username; ?>'s profiel</div>
                <div class="panel-body">
                    <div class="text-center">
                        <?= $this->Html->image('uploads/avatars/' . $profile->avatar, ['class' => 'img-circle img-thumbnail', 'style' => 'width:150px;']); ?>
                        <h1><?= $profile->username; ?></h1>
                    </div>
                </div>
                <div class="list-group">
                    <li class="list-group-item">
                        <?php if($profile->id == $user->id): ?>
                            <button class="btn btn-secondary btn-block disabled"><?= __('Dit bent jij'); ?></button>
                        <?php elseif(in_array($profile->id, $foreign_ids)): ?>
                            <?= $this->Form->postLink(
                                '<i class="fa fa-user-times"></i> '  . __('{0} verwijderen', $profile->username),
                                ['controller' => 'Friends', 'action' => 'remove', $profile->id],
                                [
                                    'class' => 'btn btn-danger btn-block',
                                    'escape' => false,
                                    'confirm' => __('Weet je zeker dat je {0} wilt verwijderen als vriend?', $profile->username)
                                ]
                            ); ?>
                        <?php else: ?>
                            <?= $this->Form->postButton(
                                '<i class="fa fa-user-plus"></i> ' . __('{0} toevoegen', $profile->username),
                                ['controller' => 'Friends', 'action' => 'add', $profile->id],
                                [
                                    'class' => 'btn btn-success btn-block',
                                    'escape' => false,
                                ]
                            ); ?>
                        <?php endif; ?>
                    </li>
                    <li class="list-group-item"><i class="fa fa-calendar-o"></i> Aantal berichten op tijdlijn: <b><?= count($profile->timeline); ?></b></li>
                    <li class="list-group-item"><i class="fa fa-fire"></i> Aantal berichten ge'wowed: <b><?= count($profile->timeline_wows); ?></b></li>
                    <li class="list-group-item"><i class="fa fa-clock-o"></i> Lid sinds: <b><?= $profile->created_at->nice(); ?></b></li>
                    <li class="list-group-item"><i class="fa fa-star-o"></i> Rank: <b class="<?= $profile->primary_role->name; ?>"><?= $profile->primary_role->name; ?></b></li>
                    <li class="list-group-item"><i class="fa fa-fw fa-comments-o"></i> Aantal threads: <b><?= count($profile->threads); ?></b></li>
                    <li class="list-group-item"><i class="fa fa-fw fa-commenting-o"></i> Aantal reacties: <b><?= count($profile->comments); ?></b></li>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading"><?= $profile->username; ?>'s tijdlijn</div>
                <?php if (isset($profile->timeline)): ?>
                    <ul class="list-group">
                        <?php foreach ($profile->timeline as $time): ?>
                                <li class="list-group-item">


                                    <div class="media" id="timeline_<?= $time->id; ?>">
                                        <div class="media-left">
                                            <a href="#">
                                                <?= $this->Html->image('uploads/avatars/' . $time->user->avatar, ['class' => 'media-object img-thumbnail', 'style' => 'width:100px;']); ?>
                                            </a>
                                            <p class="text-center">
                                        <span class="role <?= $time->user->primary_role->name; ?>"
                                              style="display:inline-block;">
                                                    <?= $time->user->username; ?>
                                                </span>
                                        </div>
                                        <?php if ($time->type == 'spotify'): ?>
                                            <div class="media-body status">
                                                <script>loadsong('<?= $time->url; ?>', <?= $time->id; ?>);</script>
                                                <div class="spotify_body">
                                                    <div class="pull-right">
                                                        <div class="text-muted">
                                                            <i class="fa fa-spotify"></i>
                                                        </div>
                                                    </div>
                                                    <div class="pull-left album-image">
                                                        <img class="album-img" style="width:90px;height:90px;"
                                                             src="img/not-found.png" alt="">
                                                    </div>
                                                    <div class="pull-right play"></div>
                                                    <div class="artists"></div>
                                                </div>
                                            </div>
                                        <?php elseif ($time->type == 'youtube'): ?>
                                            <div class="media-body status">
                                                <iframe id="ytplayer" type="text/html" width="400" height="200"
                                                        src="https://www.youtube.com/embed/<?= $time->url; ?>?&origin=http://example.com"
                                                        frameborder="0">

                                                </iframe>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </li>
                                <?php if (!empty($time->message)): ?>
                                    <li class="list-group-item">
                                        <p class="message"><?= h($time->message); ?></p>
                                    </li>
                                <?php endif; ?>
                                <li class="list-group-item">
                                    <div class="pull-right text-muted">
                                        <?= $time->created->timeAgoInWords(); ?> geplaatst
                                    </div>
                                    <div>
                                        <?= $this->Form->postButton(' <b>WOW!</b> <span class="amount-wows">' . count($time->wows) . '</span>', ['controller' => 'TimelineWows', 'action' => 'add', $time->id], ['class' => 'btn-xs btn btn-default', 'escape' => false]); ?>
                                    </div>
                                </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>