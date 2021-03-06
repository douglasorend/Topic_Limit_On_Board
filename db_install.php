<?php
$SSI_INSTALL = false;
if (file_exists(dirname(__FILE__) . '/SSI.php') && !defined('SMF'))
{
	$SSI_INSTALL = true;
	require_once(dirname(__FILE__) . '/SSI.php');
}
elseif (!defined('SMF')) // If we are outside SMF and can't find SSI.php, then throw an error
	die('<b>Error:</b> Cannot install - please verify you put this file in the same place as SMF\'s SSI.php.');
require($sourcedir.'/Subs-Admin.php');
db_extend('packages');

//==============================================================================
// Insert one column into the necessary tables:
//==============================================================================
// {prefix}boards table gets 2 new columns to hold the topic restrictions info:
$smcFunc['db_add_column'](
	'{db_prefix}boards', 
	array(
		'name' => 'topic_limit', 
		'size' => 8, 
		'type' => 'int', 
		'null' => false, 
		'default' => 0
	)
);
$smcFunc['db_add_column'](
	'{db_prefix}boards', 
	array(
		'name' => 'topic_limit_time', 
		'size' => 8, 
		'type' => 'int', 
		'null' => false, 
		'default' => 0
	)
);

// Echo that we are done if necessary:
if ($SSI_INSTALL)
	echo 'DB Changes should be made now...';
?>