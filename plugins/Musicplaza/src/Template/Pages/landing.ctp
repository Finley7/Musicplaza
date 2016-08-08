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
        <?php if (isset($user)): ?>
            <div class="col-md-3 col-xs-12 col-lg-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                            <?= $this->Html->image('uploads/avatars/' . $user->avatar, ['class' => 'img-circle img-thumbnail', 'style' => 'width:100px;height:100px;']); ?>
                            <h3 style="margin:4px;"><?= $user->username; ?></h3>
                        </div>
                    </div>
                    <div class="list-group">
                        <li class="list-group-item">Lid sinds: <b><?= $user->created_at->nice(); ?></b></li>
                        <li class="list-group-item">E-mail: <b><?= $user->email; ?></b></li>
                        <li class="list-group-item">Tijdlijn berichten: <b><?= $myTimeline->count(); ?></b></li>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="col-md-<?= isset($user) ? '6' : '9'; ?> col-xs-12 col-lg-<?= isset($user) ? '6' : '9'; ?>">
            <div class="panel panel-default">
                <div class="panel-heading"><?= __('Tijdlijn van vrienden'); ?></div>
                <?php if (isset($user)): ?>
                    <div class="panel-body">
                        <?= $this->Form->create('', ['url' => '/timeline/add']); ?>
                        <fieldset class="form-group">
                            <?= $this->Form->textarea('message', ['style' => 'resize:none;', 'class' => 'form-control', 'maxlength' => 200, 'rows' => 3, 'placeholder' => __('Voeg een kort bericht bij je liedje toe. (optioneel)')]); ?>
                        </fieldset>
                        <fieldset class="form-group">
                            <?= $this->Form->input('url', ['class' => 'form-control', 'maxlength' => 255, 'label' => false, 'placeholder' => __('De volledige URL van het nummer')]); ?>
                        </fieldset>
                        <fieldset class="form-group">
                            <input type="hidden" name="type" value="">

                            <input type="radio" name="type" value="spotify" class="url-type-text" id="url-type-spotify">
                            <label class="url-type spotify" for="url-type-spotify">
                                Spotify
                            </label>

                            <input type="radio" name="type" value="youtube" class="url-type-text" id="url-type-youtube"
                                   checked>
                            <label class="url-type youtube" for="url-type-youtube">
                                YouTube
                            </label>

                        </fieldset>
                        <?= $this->Form->submit(__('Plaatsen'), ['class' => 'btn btn-primary pull-right']); ?>
                        <?= $this->Form->end(); ?>
                    </div>
                <?php endif; ?>
                <?php if (isset($timelines)): ?>
                    <ul class="list-group">
                        <?php foreach ($timelines as $timeline): ?>
                            <?php foreach ($timeline as $time): ?>
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
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
        <?= $this->element('Interactive/recent_threads'); ?>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?= __('Je eigen tijdlijn'); ?>
                </div>
                <?php if (isset($myTimeline)): ?>
                    <ul class="list-group">
                        <?php foreach ($myTimeline as $time): ?>
                            <li class="list-group-item">
                                <div class="" id="timeline_<?= $time->id; ?>">
                                    <?php if ($time->type == 'spotify'): ?>
                                        <div class="status">
                                            <script>loadsong('<?= $time->url; ?>', <?= $time->id; ?>);</script>
                                            <div class="spotify_body">
                                                <div class="pull-right">
                                                    <div class="text-muted">
                                                        <i class="fa fa-spotify"></i>
                                                    </div>
                                                </div>
                                                <div class="pull-left album-image">

                                                </div>
                                                <div class="pull-right play"></div>
                                                <div class="artists"></div>
                                            </div>
                                        </div>
                                    <?php elseif ($time->type == 'youtube'): ?>
                                        <div class="status">
                                            <iframe id="ytplayer" type="text/html" width="175" height="125"
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
                                    <span class="amount-wows"><?= count($time->wows); ?></span>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<script>
    $('#url-type-spotify').click(function () {
        $('input[name="url"]').attr('placeholder', "(bijv. spotify:track:UUID) Alleen losse tracks!");
    })
    $('#url-type-youtube').click(function () {
        $('input[name="url"]').attr('placeholder', "(bijv. https://youtu.be/ID of https://youtube.com/watch?v=ID)");
    })

</script>