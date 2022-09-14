<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>asgn02 Inheritance</title>
</head>
<body>
<h1>Inheritance Examples</h1>

<?php 
    include 'Bird.php';
    
    echo '<p>The instance_count for the Bird Class is '.Bird::$instance_count.'</p>';
    echo '<p>The instance_count for the YellowBelliedFlyCatcher Class is '.YellowBelliedFlyCatcher::$instance_count.'</p>';
    echo '<p>The instance_count for the Kiwi Class is '.Kiwi::$instance_count.'</p>';
    $bird = Bird::create();
    echo '<p>The generic song of any bird is "' . $bird->song . '".</p>';
    echo '<p>Default egg_num value: '.Bird::$egg_num.'</p>';

    $fly_catcher = YellowBelliedFlyCatcher::create();
    echo '<p>The song of the ' . $fly_catcher->name . ' on breeding grounds is "' . $fly_catcher->song . '".</p>';
    echo '<p>'.$fly_catcher->name.' egg_num: '.YellowBelliedFlyCatcher::$egg_num.'</p>';

    $kiwi = Kiwi::create();
    $kiwi->flying = "no";
    echo "<p>The " . $fly_catcher->name . " " . $fly_catcher->can_fly() . ".</p>";
    echo "<p>The " . $kiwi->name . " " . $kiwi->can_fly() . ".</p>";   
    echo '<p>The instance_count for the Bird Class is '.Bird::$instance_count.'</p>';
    echo '<p>The instance_count for the YellowBelliedFlyCatcher Class is '.YellowBelliedFlyCatcher::$instance_count.'</p>';
    echo '<p>The instance_count for the Kiwi Class is '.Kiwi::$instance_count.'</p>';

?>
    </body>
</html>

