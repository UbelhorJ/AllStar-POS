<?php
require_once('util/main.php');
require_once('model/database.php');
require_once('model/release_notes_db.php');

// Get last three release notes for Release Notes info panel
$release_notes = get_last_three_release_notes();

include('home_view.php');

?>