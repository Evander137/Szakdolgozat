<?php
session_start();
include("db_kapcsolat.php");

$teljesUrl = $_SERVER["REQUEST_URI"];
$url= explode("/",$teljesUrl);
$adatok = trim(file_get_contents("php://input"));
@$adatPost = json_decode($adatok,true);

isset($_GET["id"]) ? $id = $_GET["id"] : $id = 0;

    //SQL utasítások:
    $kordiagram = "SELECT kategoria.Nev, SUM(penzvaltozas.Osszeg) AS Osszeg 
    FROM penzvaltozas INNER JOIN kategoria 
    ON penzvaltozas.Kategoria_ID=kategoria.ID INNER JOIN felhasznalo 
    ON penzvaltozas.Felhasznalo_ID=felhasznalo.ID 
    WHERE kategoria.Koltsege = true 
    AND penzvaltozas.Datum BETWEEN CONCAT(YEAR(CURDATE()), '-', MONTH(CURDATE()), '-01') AND CONCAT(YEAR(CURDATE()), '-', MONTH(CURDATE()), '-31') 
    AND felhasznalo.ID = {$_SESSION["id"]}
    GROUP BY kategoria.Nev";

    $test = "SELECT ";

    /*$kulonbseg = "SELECT IFNULL(SUM(penzvaltozas.Osszeg), 0)-
    IFNULL((SELECT SUM(penzvaltozas.Osszeg) AS penzvaltozas
    FROM penzvaltozas 
    INNER JOIN kategoria ON penzvaltozas.Kategoria_ID=kategoria.ID
    INNER JOIN felhasznalo ON penzvaltozas.Felhasznalo_ID=felhasznalo.ID
    WHERE kategoria.Koltsege is true
    AND penzvaltozas.Datum BETWEEN CONCAT(YEAR(CURDATE()),'-01-01') AND CONCAT(YEAR(CURDATE()),'-01-31')
    AND felhasznalo.ID = {$_SESSION["id"]}),0) AS penzvaltozas    
    FROM penzvaltozas 
    INNER JOIN kategoria ON penzvaltozas.Kategoria_ID=kategoria.ID
    INNER JOIN felhasznalo ON penzvaltozas.Felhasznalo_ID=felhasznalo.ID
    WHERE kategoria.Koltsege is false
    AND penzvaltozas.Datum BETWEEN CONCAT(YEAR(CURDATE()),'-01-01') AND CONCAT(YEAR(CURDATE()),'-01-31')
    AND felhasznalo.ID = {$_SESSION["id"]}
    GROUP BY MONTH(penzvaltozas.Datum)";*/

    $szamlak = "SELECT szamla.Nev, szamla.ID, szamla.Penzosszeg
    FROM szamla
    WHERE Felhasznalo_ID = {$_SESSION["id"]}";

    $kategoriak = "SELECT * FROM kategoria";

    //SQL lekérdezések végrehajtása:

    function leker($muvelet){
		
		global $db, $nev;
			$eredmeny = $db->query($muvelet) or die($db->error);
			if ($eredmeny->num_rows != 0) {
				while ( $i = $eredmeny->fetch_assoc())  {
						$adatok[]=$i;
				}
                
				//print_r($adatok);
				echo json_encode($adatok,JSON_UNESCAPED_UNICODE);
					
				}
			else {
				echo "NINCS TALÁLAT";
			}
    }

    function felvitel($muvelet) {
        global $db;
        $db->query($muvelet) or die($db->error);
    }

    //Egyes kérések kiszolgálása:  

    switch (end($url)) {
        case "kordiagram" : {
            leker($kordiagram);
            break;
        }
        case "kulonbseg" : {
            $eredmenyek = new SplFixedArray(11);
            $test = 10;            
            for($i = 0; $i < 1; $i++)
            {
                $koltsegek = "SELECT SUM(penzvaltozas.Osszeg) AS penzvaltozas
                FROM penzvaltozas 
                INNER JOIN kategoria ON penzvaltozas.Kategoria_ID=kategoria.ID
                INNER JOIN felhasznalo ON penzvaltozas.Felhasznalo_ID=felhasznalo.ID
                WHERE kategoria.Koltsege is true
                AND penzvaltozas.Datum BETWEEN CONCAT(YEAR(CURDATE()),'-{$i}-01') AND CONCAT(YEAR(CURDATE()),'-{$i}-31')
                AND felhasznalo.ID = {$_SESSION["id"]}";

                $result = $connect->query($jovedelmek) or die($connect->$connect_error);
                $row = $result->fetch_array();
                $koltseg = $row["penzvaltozas"];

                

                $jovedelmek = "SELECT SUM(penzvaltozas.Osszeg) AS penzvaltozas
                FROM penzvaltozas 
                INNER JOIN kategoria ON penzvaltozas.Kategoria_ID=kategoria.ID
                INNER JOIN felhasznalo ON penzvaltozas.Felhasznalo_ID=felhasznalo.ID
                WHERE kategoria.Koltsege is false
                AND penzvaltozas.Datum BETWEEN CONCAT(YEAR(CURDATE()),'-{$i}-01') AND CONCAT(YEAR(CURDATE()),'-{$i}-31')
                AND felhasznalo.ID = {$_SESSION["id"]}";
                

                $result = $connect->query($jovedelmek) or die($connect->$connect_error);
                $row = $result->fetch_array();
                $jovedelem = $row["penzvaltozas"];

                $eredmenyek[$i] = $koltseg - $jovedelem;                
            }
            echo json_encode($eredmenyek,JSON_UNESCAPED_UNICODE);
            //echo json_encode($eredmenyek);
            break;
        }
        case "szamlak" : {
            leker($szamlak);
            break;
        }
        case "kategoriak" : {
            leker($kategoriak);
            break;
        }
        case "ujszamla" : {
            $query = "INSERT into szamla(szamla.ID, szamla.Felhasznalo_ID, szamla.Nev, szamla.Penzosszeg)
            VALUES ('', {$_SESSION["id"]}, '{$adatPost["szamla"]}', {$adatPost["osszeg"]})";
            felvitel($query);
            break;
        }
        case "szamlatorles" : {
            $query = "DELETE from szamla
            where szamla.ID = {$adatPost["id"]}";
            felvitel($query);
            leker($szamlak);
            break;
        }
        case "szerkesztes" : {
            $query = "UPDATE szamla
            set szamla.Penzosszeg = {$adatPost["osszeg"]}, szamla.Nev = '{$adatPost["szamla"]}'
            where szamla.ID = {$adatPost["id"]}";

            felvitel($query);
            leker($szamlak);
            break;
        }
        case "felvitel" : {
            $ujPenzvaltozat = "INSERT INTO penzvaltozas
            VALUES('', {$_SESSION["id"]}, {$adatPost["kategoria"]}, {$adatPost["szamla"]}, {$adatPost["osszeg"]}, '{$adatPost["datum"]}', '{$adatPost["megjegyzes"]}')";

            include 'db_kapcsolat.php';

            $query = "SELECT Koltsege from kategoria where kategoria.ID = {$adatPost["kategoria"]}";
            $result = $db->query($query) or die($db->$connect_error);
            if($result->num_rows > 0)
            {
                $koltsege = $result->fetch_array();
                if($koltsege["Koltsege"])
                {
                    $osszegValtozas = "UPDATE szamla
                    set szamla.Penzosszeg = szamla.Penzosszeg - {$adatPost["osszeg"]}
                    where szamla.ID = {$adatPost["szamla"]}";
                }
                else if(!$koltsege["Koltsege"])
                {
                    $osszegValtozas = "UPDATE szamla
                    set szamla.Penzosszeg = szamla.Penzosszeg + {$adatPost["osszeg"]}
                    where szamla.ID = {$adatPost["szamla"]}";
                }
            }

            felvitel($osszegValtozas);
            felvitel($ujPenzvaltozat);
            break;
        }
    }
?>