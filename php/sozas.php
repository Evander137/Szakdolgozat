<?php  
    function sozas($x) 
    {  
        $so = "";  
        for ($i = 0; $i<$x; $i++) 
        {  
            $veletlenszam = rand(48,57);  
            $so .= Chr($veletlenszam); // [48,57]=>[0,9]
            
            $veletlenNB = rand(65,90);
            $so .= Chr($veletlenNB); // [65,90] => [A,Z]  
            
            $veletlenKB = rand(97,122);
            $so.= Chr($veletlenKB); // [97,122] => [a,z]   
        }
        return $so;  
    }
?>  

