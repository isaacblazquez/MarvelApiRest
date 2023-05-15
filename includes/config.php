<?php
// you must fill it with your public API key
$pk="";
// you must fill it with your private API key
$pr_k="";

$key=$pr_k.$pk;
$currentTime = time();
$hash=md5($currentTime.$key);
?>