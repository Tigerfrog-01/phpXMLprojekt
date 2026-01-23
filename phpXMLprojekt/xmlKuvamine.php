<?php
$opilased=simplexml_load_file("opilased.xml");


$feed=simplexml_load_file("https://www.err.ee/rss/");

function lisaOpilane()
{

        $xmlDoc = new DOMDocument("1.0","UTF-8");
        $xmlDoc->preserveWhiteSpace = false;
        $xmlDoc->load('opilased.xml');
        $xmlDoc->formatOutput = true;


        $xml_root = $xmlDoc->documentElement;
        $xmlDoc->appendChild($xml_root);


        $xml_opilane = $xmlDoc->createElement("opilane");
        $xmlDoc->appendChild($xml_opilane);



        $xml_root->appendChild($xml_opilane);


        $elukoht = $xmlDoc->createElement("elukoht");
       $xml_opilane->appendChild($elukoht);

    $aine = $xmlDoc->createElement("aine");
    $xml_opilane->appendChild($aine);

    $aine1 = $xmlDoc->createElement("aine1");
    $xml_opilane->appendChild($aine1);



        unset($_POST['submit']);

        foreach($_POST as $voti => $vaartus)
        {
            if($voti == "linn" || $voti == "maakond")
            {
                $kirje = $xmlDoc->createElement($voti,$vaartus);
            $elukoht ->appendChild($kirje);
            }

            else if($voti == "nimetus" || $voti == "hinne")
            {
                $kirje = $xmlDoc->createElement($voti,$vaartus);
                $aine ->appendChild($kirje);
            }

            else if($voti == "nimetus1" || $voti == "hinne1")
            {
                $kirje = $xmlDoc->createElement($voti,$vaartus);
                $aine1 ->appendChild($kirje);
            }

            else {
                $kirje = $xmlDoc->createElement($voti, $vaartus);
                $xml_opilane->appendChild($kirje);
            }



            $xmlDoc->save('opilased.xml');






        }
}
function erialaOtsing($paring){
    global $opilased;
    $tulemus=array();

    foreach($opilased->opilane as $opilane)
    {
        if(substr(strtolower($opilane->eriala),0,strlen($paring)) == strtolower($paring))
        {
            array_push($tulemus, $opilane);
        }
        else if(substr(strtolower($opilane->nimi),0,strlen($paring)) == strtolower($paring))
        {
            array_push($tulemus, $opilane);
        }
        else if(substr(strtolower($opilane->isikukood),0,strlen($paring)) == strtolower($paring))
        {
            array_push($tulemus, $opilane);
        }
        else if(substr(strtolower($opilane->aine->nimetus),0,strlen($paring)) == strtolower($paring))
        {
            array_push($tulemus, $opilane);
        }
        else if(substr(strtolower($opilane->isikukood),0,strlen($paring)) == strtolower($paring))
        {
            array_push($tulemus, $opilane);
        }

    }
    return $tulemus;


}
?>
<!DOCTYPE html>
<html lang="et">
<head>
    <title>Xml faili kuvamine Opilased.xml</title>
</head>
<link rel="stylesheet" href="style.css">
<body>
<h1>XML faili kuvamine - Opilased.XML</h1>

<?php
//1. õpilase nimi
//echo "1.õpilase nimi: ".$opilased->opilane[0]->nimi;

?>

<form action="?" method="post">
    <label for="otsing">Sisesta (nimi/isikukood/Eriala/Aine)</label>
    <input type="text" name="otsing" id="otsing" placeholder="Otsi">
    <input type="submit" value="Ok">
</form>
<br>
<?php
//otsingu tulemus
if(!empty($_POST['otsing']))
{
    $tulemus=erialaOtsing($_POST['otsing']);





echo"<br>";
echo"<table>";

    echo" <tr>
        <th>Õpilase nimi</th>
        <th>Pilt</th>
        <th>Isikukood</th>
        <th>Eriala</th>
        <th>Elukoht</th>
        <th>Aine/Hinne</th>
         <th>Aine/Hinne</th>
    </tr>";
        foreach($tulemus as $opilane) {
        echo"<tr>";
        echo "<td>".$opilane->nimi."</td>";
        echo "<td><img src='".$opilane->pilt."' alt='Pilt' style='max-width:150px; height:150px;'></td>";
        echo "<td>".$opilane->isikukood."</td>";
        echo "<td>".$opilane->eriala."</td>";
        echo "<td>".$opilane->elukoht->linn."
        ,".$opilane->elukoht->maakond."</td>";
        echo "<td>".$opilane->aine->nimetus."
        ,".$opilane->aine->hinne."</td>";
            echo "<td>".$opilane->aine1->nimetus1."
        ,".$opilane->aine1->hinne1."</td>";

    echo"</tr>";
echo"</table>" ;
    }
        exit;
} else {
    ?>
<table>
    <tr>
        <th>Õpilase nimi</th>
        <th>Pilt</th>
        <th>Isikukood</th>
        <th>Eriala</th>
        <th>Elukoht</th>
        <th>Aine/Hinne</th>
        <th>Aine/Hinne</th>
    </tr>
    <?php
    foreach ($opilased->opilane as $opilane)
    {
        echo "<tr>";
        echo "<td>".$opilane->nimi."</td>";
        echo "<td><img src='".$opilane->pilt."'alt='Pilt' style='max-width:150px; height:150px;'></td>";
        echo "<td>".$opilane->isikukood."</td>";
        echo "<td>".$opilane->eriala."</td>";
        echo "<td>".$opilane->elukoht->linn."
        ,".$opilane->elukoht->maakond."</td>";
        echo "<td>".$opilane->aine->nimetus."
        ,".$opilane->aine->hinne."</td>";
        echo "<td>".$opilane->aine1->nimetus1."
        ,".$opilane->aine1->hinne1."</td>";
    }
}

    ?>
</table>
<br>

<form method="post">


    <input type="text" name="nimi" placeholder="eesnimi">
    <input type="text" name="pilt" placeholder="pilt">
    <input type="text" name="isikukood" placeholder="isikukood">
    <input type="text" name="eriala" placeholder="eriala">
    <br>
    <input type="text" name="linn" placeholder="linn">
    <input type="text" name="maakond" placeholder="maakond">
    <input type="text" name="nimetus" placeholder="nimetus">
    <input type="text" name="hinne" placeholder="hinne">

    <input type="text" name="nimetus1" placeholder="nimetus">
    <input type="text" name="hinne1" placeholder="hinne">



    <input type="submit" name="submit" value="lisa"   >



</form>

<?php
if (isset($_POST['submit'])) {

    lisaOpilane();
    echo "õpilane on lisatud";
    header("Refresh:0");

}
exit;
?>





</body>
</html>
