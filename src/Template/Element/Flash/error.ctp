<!--<div class="alert alert-danger" style="margin:0;" onclick="this.classList.add('hidden');"><strong><? /*= __('Fout'); */ ?>: </strong><? /*= h($message) */ ?></div>-->
<script>
    $.amaran({
        'theme': 'colorful',
        'content': {
            bgcolor: '#d9534f',
            color: '#fff',
            message: '<?= h($message) ?>'
        },
        'position': 'top right',
        'outEffect': 'slideRight'
    });
</script>