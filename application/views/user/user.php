<?php include '\..\header.php' ?>


	<? foreach( $users as $item ): ?>
		<?=$item->login;?>
	<? endforeach ?>

<?php include '\..\footure.php' ?>
