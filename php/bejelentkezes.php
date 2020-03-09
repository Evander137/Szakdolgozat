<?php

function bejelentkezes($email,$jelszo)
{
    if (empty($email) || empty($jelszo))
    {
        echo "Kérem töltsön ki minden mezőt!";
        return false;
    }
    else 
    {
        include 'db_kapcsolat.php';

        $solekeres = "SELECT So FROM felhasznalo WHERE Email = '{$email}'";
        $result = $db -> query($solekeres) or die($db->error);
        $so = $result -> fetch_array();
        $jelszo .= $so["So"];

        $query = "SELECT ID FROM felhasznalo WHERE Email = '{$email}' AND Jelszo = '".hash("sha256",$jelszo)."'"; 
        $result = $db -> query($query) or die($db->error);
        
        if($result->num_rows != 0)
        {
            $id = $result->fetch_array();
            session_start();
            $_SESSION["id"] = $id["ID"];
            header("Location:../pages/tranzakciok.php");
            echo "Sikeres bejelentkezés";
        }

        else
        {
            echo "Nem megfelelő adatok!";
        }
    }
}

bejelentkezes($_POST['email'],$_POST['jelszo']);