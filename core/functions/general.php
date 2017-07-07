<?php
function sanitize($data){
	global $dbc;
	return mysqli_real_escape_string($dbc,$data);
}
?>