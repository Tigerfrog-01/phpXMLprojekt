<?php
$opilased=simplexml_load_file("opilased.xml");
$feed=simplexml_load_file("https://www.err.ee/rss/");
function erialaOtsing($paring){
    global $opilased;
    $tulemus=array();
    foreach($opilased->opilane as $opilane)
    {
        if(substr(strtolower($opilane->eriala),0,strlen($paring)) == strtolower($paring))
        {
            array_push($tulemus, $opilane);
        }
    }
    return $tulemus;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Xml faili kuvamine Opilased.xml</title>
</head>
<body>
<h1>XML faili kuvamine - Opilased.XML</h1>
<?php
//1. õpilase nimi
echo "1.õpilase nimi: ".$opilased->opilane[0]->nimi;

?>
<form action="?" method="post">
    <label for="otsing">Eriala</label>
    <input type="text" name="otsing" id="otsing">
    <input type="submit" value="Ok"
</form>
<?php
//otsingu tulemus
if(!empty($_POST['otsing']))
{
    $tulemus=erialaOtsing($_POST['otsing']);
    foreach($tulemus as $opilane) {
        echo $opilane->nimi . " - " .$opilane->eriala."<br>";
    }
}
?>

<table>
    <tr>
        <th>Õpilase nimi</th>
        <th>Isikukood</th>
        <th>Eriala</th>
        <th>Elukoht</th>
    </tr>
    <?php
    foreach ($opilased->opilane as $opilane)
    {
        echo "<tr>";
        echo "<td>".$opilane->nimi."</td>";
        echo "<td>".$opilane->isikukood."</td>";
        echo "<td>".$opilane->eriala."</td>";
        echo "<td>".$opilane->elukoht->linn."
        ,".$opilane->elukoht->maakond."</td>";
    }

    ?>
</table>

</body>
</html>
