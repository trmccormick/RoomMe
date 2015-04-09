<?php

	$localvars  = localvars::getInstance();
	$enginevars = enginevars::getInstance();

	$localvars->set("loginURL",    $enginevars->get('loginPage').'?page='.$_SERVER['PHP_SELF']."&qs=".(urlencode($_SERVER['QUERY_STRING'])));
?>

<ul>
	<li>
		<a href="{local var="roomReservationHome"}">Room Reservation Home</a>
	</li>
	<li>
		<a href="{local var="roomReservationHome"}/find/">Check Room Availability</a>
	</li>
	<li>
		<a href="http://home.hsc.wvu.edu/its/forms/library-study-room-reservation/">Health Sciences Libraries</a>
	</li>
	<li>
		<?php if (is_empty(session::get("username"))) { ?>
		<a href="{local var="loginURL"}">Login</a>
		<?php } else { ?>
		<a href="{local var="roomReservationHome"}/calendar/user/">View your reservations</a>
		<a href="{engine var="logoutPage"}?csrf={engine name="csrfGet"}">Logout</a>
		<?php } ?>
	</li>
</ul>

<ul>
	<li class="rightNavListHeader">Building Calendars <br /> (all rooms)</li>

	<?php
	// Not happy about this
	$db        = db::get($localvars->get('dbConnectionName'));
	$sql       = sprintf("SELECT * FROM building ORDER BY name");
	$sqlResult = $db->query($sql);

	while ($row = $sqlResult->fetch()) {

	?>

	<?php if (is_empty($row['externalURL'])) { ?>
	<li>
		<a href="#" class="calendarModal_link" data-type="building" data-id="<?php print htmlSanitize($row['ID']); ?>"><?php print htmlSanitize($row['name']);?></a>
	</li>
	<?php } else { ?>
	<li>
		<a href="<?php print htmlSanitize($row['externalURL']) ?>"><?php print htmlSanitize($row['name']);?></a>
	</li>
	<?php } ?>

	<?php } ?>

</ul>
