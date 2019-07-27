<?php
// ajax element
// Array with names
$a[] = "Chloe";
$a[] = "Maybelline";
$a[] = "Guerlain";
$a[] = "Chanel";
$a[] = "NARS";
$a[] = "Clarins";
$a[] = "L’Oreal";
$a[] = "SHISEIDO";
$a[] = "Dior";
$a[] = "Yves Saint Laurent";
$a[] = "MAC";
$a[] = "Lancome";
$a[] = "Clinique";
$a[] = "Covergirl";
$a[] = "Revlon";


// get the q parameter from URL
$q = $_REQUEST["brand"];

$hint = "";

// lookup all hints from array if $q is different from "" 
if ($q !== "") {
  $len=strlen($q);
  foreach($a as $name) {
    if (stristr($q, substr($name, 0, $len))) {
      if ($hint === "") {
        $hint = "<a = href='brandsearch.php?brand=$name'> $name </a>";
      } else {
        $hint = "$hint  <a = href='brandsearch.php?brand=$name'> $name </a>";
      }
    }
  }
}
// Output "no suggestion" if no hint was found or output correct values 
echo $hint === "" ? "no suggestion" : $hint;
?>