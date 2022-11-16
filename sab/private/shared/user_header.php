<?php
  if(!isset($page_title)) { $page_title = 'Bird Area'; }
?>

<!doctype html>

<html lang="en">
  <head>
    <title>SA Birds - <?php echo h($page_title); ?></title>
    <meta charset="utf-8">
    <!-- <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/staff.css'); ?>" /> -->
  </head>

  <body>
    <header>
      <h1>SA Birds Admin Area</h1>
    </header>
    <navigation>

        <?php 
        require_login();
        echo "<a href='../users'>Username Page</a><br>";
        echo "<a href='../birds'>Birds Page</a><br>";
        echo "<a href='../logout.php'>Logout</a>";
        ?>

    </navigation>


    <?php echo display_session_message(); ?>
