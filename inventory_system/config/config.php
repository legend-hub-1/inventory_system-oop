<?php
try
{
$pdo= new PDO("mysql:host=localhost;dbname=inventory_system","root","");
}

Catch(PDOException $e)
{
echo "error:".$e->getMessage();
}
?>