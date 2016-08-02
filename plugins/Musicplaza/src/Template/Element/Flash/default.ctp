<?php
$class = 'alert alert-info';

?>
<script>
    $.amaran({
        'theme': 'colorful',
        'content': {
            bgcolor: '#d9edf7',
            color: '#31708f',
            message: '<?= h($message) ?>'
        },
        'position': 'top right',
        'outEffect': 'slideRight'
    });
</script>
<!--<div style="margin:0;" class="<?/*= h($class) */?>"><i class="fa fa-exclamation-circle"></i> <strong><?/*= __('Let op'); */?>:</strong> <?/*= h($message) */?></div>-->