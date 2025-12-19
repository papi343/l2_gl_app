<?php 
$prenom="yaya";
if(is_string($prenom)){
    echo "la variable c'est un char";
    echo "<br>";
}
$age=10;
if(is_int($age)){
    echo " la variable c'est un entier";
    echo "<br>";
}
$age=10.2;
if(is_float($age)){
    echo "la variable c'est un reel";
    echo "<br>";
}
$reponse=true;
if(is_bool($reponse)){
    echo "la variable c'est un boleen";
    echo "<br>";
}
$reponse=null;
if(is_null($reponse)){
    echo "la variable est vide";
    echo "<br>";
  }
   echo "<br>";
    echo "<br>";
     echo "<br>";

 echo "<table border='1' >";
 echo "<tr> <th> x </th>";
  for($i=1;$i<=10;$i++)
  {
    echo "<th>$i</th>";
  }
 echo "</tr>";
 for($i=1;$i<=10;$i++)
  {
     echo "<tr> <th> $i</th>";
    for($j=1;$j<=10;$j++) {
        echo "<td>";
        echo $i*$j;
        echo "</td>";
    }
         echo "</tr>";
    }
  
 echo "</table>";