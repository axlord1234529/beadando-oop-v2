
    <div id="galeria">
    <h1>Galéria</h1>
    <form id="kapcsolat" action="?oldal=galeria" method="post" enctype="multipart/form-data">
        <input  type="hidden" name="max_file_size" value="110000">
       
            
            <label for="file-upload" class="custom-file-upload">Fájlok kiválasztása
            <input  id="file-upload" type="file" name="fajlok[]" accept="image/png, image/jpeg" multiple required>
        </label>
       
        <input class="btn2" type="submit" name="kuld">
        
      </form>
    <?php
    if (!empty($uzenet))
    {
        echo '<ul>';
        foreach($uzenet as $u)
            echo "<li>$u</li>";
        echo '</ul>';
    }
?>
    <?php
    arsort($kepek);
    foreach($kepek as $fajl => $datum)
    {
    ?>
        <div class="kep">
            <a href="<?php echo $MAPPA.$fajl ?>">
                <img src="<?php echo $MAPPA.$fajl ?>">
            </a>            
           
        </div>
    <?php
    }
    ?>
    </div>


