<!--<div class="alert alert-success" style="margin:0;" onclick="this.classList.add('hidden')">Voltooid: <?/*= h($message) */?></div>-->
<script>
    $.amaran({
        'theme': 'colorful',
        'content': {
            bgcolor: '#5cb85c',
            color: '#fff',
            message: '<?= h($message) ?>'
        },
        'position': 'top right',
        'outEffect': 'slideRight'
    });
</script>