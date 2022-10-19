<?php require_once('../../../private/initialize.php'); ?>

<?php
  
// Find all bicycles;
$birds = Bird::find_all();
  
?>
<?php $page_title = 'Birds'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <div class="birds listing">
    <h1>Birds</h1>

    <div class="actions">
      <a class="action" href="<?php echo url_for('/staff/birds/new.php'); ?>">Add Bird</a>
    </div>

  	<table class="list">
    <tr>
      <th>Common Name</th>
      <th>Habitat</th>
      <th>Food</th>
      <th>Conservation Level</th>
      <th>Backyard Tips</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
    </tr>

      <?php foreach($birds as $bird) { ?>
        <tr>
        <td><?= h($bird->common_name); ?></td>
        <td><?= h($bird->habitat); ?></td>
        <td><?= h($bird->food); ?></td>
        <td><?= h($bird->conservation_level()); ?></td>
        <td><?= h($bird->backyard_tips); ?></td>
        <td><a class="action" href="<?php echo url_for('/staff/birds/show.php?id=' . h(u($bird->id))); ?>">View</a></td>
        <td><a class="action" href="<?php echo url_for('/staff/birds/edit.php?id=' . h(u($bird->id))); ?>">Edit</a></td>
        <td><a class="action" href="<?php echo url_for('/staff/birds/delete.php?id=' . h(u($bird->id))); ?>">Delete</a></td>
    	  </tr>
      <?php } ?>
  	</table>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
