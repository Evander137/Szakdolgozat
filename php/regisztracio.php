<?php

//alapellenőrzés:

function ellenorzes($email,$jelszo,$jelszo2)
{
    if (empty($email) || empty($jelszo) || empty($jelszo2))
    {
        return false;
    }

    else if ($jelszo != $jelszo2)
    {
        return false;
    }
    else
    {
        return true;
    }
}

//regisztrált-e már
function letezik($email) 
{
    $query = "SELECT Email FROM felhasznalo WHERE Email = '{$email}'";

    include "db_kapcsolat.php";

    $eredmeny = $db -> query($query) or die($db -> error);

    if($eredmeny->num_rows != 0)
    {
        return false;
    }
    else
    {
        return true;
    }
}

//regisztráció

function regisztral($email,$jelszo)
{
    $urese = ellenorzes($_POST["Email"],$_POST["jelszo"],$_POST["jelszo2"]);
    $vane = letezik($_POST["Email"]);

    if($urese && $vane)
    {
        include "db_kapcsolat.php";
        include "sozas.php";

        $so = sozas(2);
        $jelszo .= $so;

        $query = "INSERT INTO felhasznalo VALUES ('','{$email}','".hash("sha256",$jelszo)."','{$so}')";

        $db -> query($query) or die($db -> error);
        //header("Location:../index.php");
    }
    else
    {
        echo "Else ág xd Nem gyütt össze";
    }
}

regisztral($_POST["Email"],$_POST["jelszo"]);
?>