<?php
$opilased=simplexml_load_file("opilased.xml");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Xml faili kuvamine Opilased.xml</title>
</head>
<h1>XML faili kuvamine - Opilased.XML</h1>
<?php
//1. õpilase nimi
echo "1.õpilase nimi: ".$opilased->opilane[0]->nimi;

?>
</html>
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