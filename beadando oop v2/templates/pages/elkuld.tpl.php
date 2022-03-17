
<?php if(isset($uzenet)) { ?>
    <h1><?= $uzenet ?></h1>
    <p>
    E-mail: <?= $_POST['email'] ?> <br>
    Tárgy:  <?= $_POST['subject'] ?> <br>
    Lakhely: <?= $_POST['lakhely'] ?> <br>
    Üzenet:  <?= $_POST['message'] ?> <br>
    </p> 
    <?php if($ujra) { ?>
        <a href="?oldal=kapcsolat">Próbálja újra!</a>
    <?php } ?>
<?php } ?>