<?php

// debug
error_reporting(E_ALL);
ini_set('display_errors', true);

require '../lib/GoogleMapsFU/__init__.php';

$projection = new \GoogleMapsFU\MapCanvasProjection(0);
$point = $projection->fromLatLngToDivPixel(new \GoogleMapsFU\LatLng(41.850033, -87.6500523)); // chicago

var_dump((string) $point);