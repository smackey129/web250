<?php

class Bird {
  var $commonName;
  var $habitat;
  var $nestPlacement;
  var $clutchSize;

  function birdSong($song)
  {
    echo "Song: ".$song ."<br>";
  }
}

$bird1 = new Bird;
$bird1->commonName = "Eastern Towhee";
$bird1->habitat = "The Appalachians";
$bird1->nestPlacement = "Ground";
$bird1->clutchSize = "2 - 6 Eggs";

$bird2 = new Bird;
$bird2->commonName = "Indigo Bunting";
$bird2->habitat = "Forest edges and Woods";
$bird2->nestPlacement = "Fields and on the edges of woods, roadsides, and railroad rights-of-way";
$bird2->clutchSize = "3 - 4 Eggs";

echo "Name: ".$bird1->commonName."<br>";
echo "Habitat: ".$bird1->habitat."<br>";
echo "Nest Placement: ".$bird1->nestPlacement."<br>";
echo "Clutch Size: ".$bird1->clutchSize."<br>";
$bird1->birdSong("drink-your-tea!");
echo "<br>";

echo "Name: ".$bird2->commonName."<br>";
echo "Habitat: ".$bird2->habitat."<br>";
echo "Nest Placement: ".$bird2->nestPlacement."<br>";
echo "Clutch Size: ".$bird2->clutchSize."<br>";
$bird2->birdSong("what! what!");