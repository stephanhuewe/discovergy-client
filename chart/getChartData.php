<?php

include('../oauth1ClientBuilder.php');

$clientBuilder = new OAuth1ClientBuilder();
$client = $clientBuilder->buildClient();

$meters = $client->getMeters();
$meterId = $meters[0]->meterId;
$meterSerialnumber = $meters[0]->fullSerialNumber;
$fieldPower = 'power';
$timenow = time() * 1000;
$energyProduced = $client->getReadings($meterId, $fieldPower, $timenow-43200000, $timenow, 'raw');
echo '{"powerdata": ' . $energyProduced . '}';

?>