<style>
	.coin {
		background: #999999;
		color: #333333;
		border-radius: 50%;
		padding: 50px;
		text-align: center;
		font-size: 2rem;
		font-weight: bold;
		width: 50px;
	}
</style>

<?php

use LDAP\Result;

function flip() {
	// Challenge: define this function
  $result = random_int(0, 1);
  if($result == 0)
    return "H";
  return "T";
}

?>

<div class="coin">
	<?php echo flip(); ?>
</div>