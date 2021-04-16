<?php
    $spajanje=new mysqli("localhost", "root", "", "keks");
    if($spajanje->connect_errno){
        echo "Veza s bazom nije uspostavljena <br>";
    }
    $spajanje->set_charset("utf8");
?>