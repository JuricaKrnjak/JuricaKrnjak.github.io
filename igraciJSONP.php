<?php

    header("Content-Type: application/json; charset=UTF-8");

    $obj = json_decode($_GET["x"], false);
    
    $conn = new mysqli("localhost", "root", "", "korisnici_baza");

    $query = "UPDATE najlosiji_igrac SET Broj_glasova = Broj_glasova + 1 WHERE Ime_igraca = '$obj->name' ";

    $conn->query($query);

    $query2 = "SELECT * FROM najlosiji_igrac ORDER BY ID_igraca";

    $result = $conn->query($query2);

    $i = 0;

    $niz = array();

    while($red = $result->fetch_object()){
        $niz[$i] = $red->Broj_glasova; 
        $i++;
    }
    echo "result(".json_encode($niz).")";

?>