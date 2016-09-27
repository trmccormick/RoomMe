<?php

	require_once("../../../../engineHeader.php");

	$errorMsg = "";
	$error    = FALSE;
	$id       = NULL;

	$db       = db::get($localvars->get('dbConnectionName'));

	$reservationPermissions = new reservationPermissions;


	if (isset($_POST['MYSQL']['multiDelete'])){
		$reservationPermissions->multiDelete($_POST['MYSQL']['delete']);
	}

	$localvars->set('table', $reservationPermissions->renderDataTable());

	templates::display('header');
?>

<header>
	<h1>Reservation Permissions</h1>
</header>

{local var="table"}

<?php
templates::display('footer');
?>
