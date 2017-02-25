<?php

function loadJsonFromFile($filePath) {
    return json_decode(file_get_contents($filePath));
}

function reconstructPathFromArray($pathArray) {
    $path = "";
    foreach ($pathArray as $node) {
        $path .= "/".$node;
    }
    return $path;
}

function unsetAndRebase($anArray, $index) {
    unset($anArray[$index]);
    return array_values($anArray);
}

function writeToTestDump($string) {
    $testDumpPath = __dir__.'/../Test/TestDump/Dump.txt';
    file_put_contents($testDumpPath, $string);
}

function flushSessions() {
    session_unset();
}

function crypto_rand_secure($min, $max)
{
    $range = $max - $min;
    if ($range < 1) return $min; // not so random...
    $log = ceil(log($range, 2));
    $bytes = (int) ($log / 8) + 1; // length in bytes
    $bits = (int) $log + 1; // length in bits
    $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
    do {
        $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
        $rnd = $rnd & $filter; // discard irrelevant bits
    } while ($rnd > $range);
    return $min + $rnd;
}

function getToken($length)
{
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet.= "0123456789";
    $max = strlen($codeAlphabet); // edited

    for ($i=0; $i < $length; $i++) {
        $token .= $codeAlphabet[crypto_rand_secure(0, $max-1)];
    }

    return $token;
}
