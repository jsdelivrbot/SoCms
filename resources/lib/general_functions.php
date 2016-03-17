<?php 

function class_active($pagename)
{
    $active = basename($_SERVER['PHP_SELF'], ".php");
    if ($active === $pagename) echo "class='active'";
}

function output_errors($errors) {
	return '<ul><li>' . implode('</li><li>', $errors) . '</li></ul>';
}

function notFound(){
	echo '<strong><div style="font-size: 35px;">The page was not found.</div></strong>';
}

function edit_settings($var, $new ) {
	$fname = $_SERVER['DOCUMENT_ROOT'].'/resources/settings.ini';
	$fhandle = fopen($fname, "r");
	$content = fread($fhandle, filesize($fname));

	$var_to_change = parse_ini_file($_SERVER['DOCUMENT_ROOT']."/resources/settings.ini")[$var];

	$content = str_replace($var . ' = "'.$var_to_change.'"', $var . ' = "'.$new.'"', $content);
	$fhandle = fopen($fname, "w");
	fwrite($fhandle, $content);
	fclose($fhandle);
}
?>