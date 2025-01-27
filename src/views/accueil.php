<?php
if (isset($_SESSION['user'])){


    $date_embauche = date('Y-m-d H:i:s');
}

?>



<h1>Hey Goood Hero !</h1>
<h1>Comment ça va Aujourdhui ?</h1>
<p><?= $date_embauche ?></p>
