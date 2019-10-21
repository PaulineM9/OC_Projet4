<?php if (isset($_SESSION['flash'])) { ?>
    <?php foreach ($_SESSION['flash'] as $key => $value) { ?>
        <p><?= $value ?></p>
    <?php } ?>
<?php }
unset($_SESSION['flash']);
?>