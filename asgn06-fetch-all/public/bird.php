<?php require_once('../private/initialize.php'); ?>

<?php $page_title = 'Inventory'; ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>

<div id="main">

  <div id="page">
    <div class="intro">
      
      <h1>Small Sampling of WNC Birds</h1>
      
    </div>

    <table id="inventory">
    <tr>
        <th>Common Name</th>
        <th>Habitat</th>
        <th>Food</th>
        <th>Nest Placement</th>
        <th>Behavior</th>
        <th>Conservation Level</th>
        <th>Backyard Tips</th>
        <th>&nbsp;</th>
      </tr>

<?php

$birds = Bird::find_all();

?>
      <?php foreach($birds as $bird) { ?>
      <tr>
        <td><?= h($bird->common_name); ?></td>
        <td><?= h($bird->habitat); ?></td>
        <td><?= h($bird->food); ?></td>
        <td><?= h($bird->nest_placement); ?></td>
        <td><?= h($bird->behavior); ?></td>
        <td><?= h($bird->conservation_level()); ?></td>
        <td><?= h($bird->backyard_tips); ?></td>
        <td><a href="detail.php?id=<?= h($bird->id);?>">View</a></td>
      </tr>
      <?php } ?>

    </table>
  </div>

  <?php
  ?>
</div>


<?php include(SHARED_PATH . '/public_footer.php'); ?>
