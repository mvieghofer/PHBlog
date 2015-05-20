<p>
<?php
    echo $data['msg'];
?>
</p>
<script type="text/javascript">
    <?php
    if ($data['success'] === 'true') {
        echo '$(function() {';
        echo 'var delay = 5000;';
        echo 'setTimeout(function() { window.location = ' . PHBlog::getUrl('/') . ' }, delay);';
        echo '})';
    }
    ?>
</script>