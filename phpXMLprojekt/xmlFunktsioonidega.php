<?php
require ('funktsioonid.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Xml faili kuvamine Opilased.xml</title>
</head>
<body>









<h1>RSS uudised</h1>
<?php
uudised('https://www.err.ee/rss', 5)
?>
<h1>Postimees RSS uudised</h1>
<?php
uudised('https://www.postimees.ee/rss', 5)
?>

</body>
