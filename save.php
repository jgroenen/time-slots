<?php

$filename = "posts.json";

$data = json_decode(file_get_contents($filename), true);

if (!$data) $data = [
    "posts" => []
];

$dag = $_POST["dag"];
$slot = $_POST["slot"];
$naam = $_POST["naam"];

$data["posts"][$dag][$slot] = $naam;

var_dump($data);

file_put_contents($filename, json_encode($data));
