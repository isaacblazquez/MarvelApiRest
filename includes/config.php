<?php
//public key
$pk="a614ad95f9c7037cbd6f52f3d84978c4";
//private key 
$pr_k="dea2435911dc24a0fd827e7cdac2465707ec6a96";
$key=$pr_k.$pk;
$currentTime = time();
$hash=md5($currentTime.$key);
?>