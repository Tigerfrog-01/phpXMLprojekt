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
