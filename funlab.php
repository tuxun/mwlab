<?php
/**
 * MonoBook nouveau. tweaked by tuxun...
 * http://www.gnu.org/copyleft/gpl.html
 * @file
 * @ingroup Skins
 */

$wgExtensionCredits['skin'][] = array(
	'path' => __FILE__,
	'name' => 'funlab',
	'namemsg' => 'skinname-funlab',
	'descriptionmsg' => 'funlab-desc',
	'url' => 'https://www.mediawiki.org/wiki/Skin:MonoBook',
	'author' => array( 'Gabriel Wicke', '...' ),
	'license-name' => 'GPLv2+',
);

// Register files
$wgAutoloadClasses['Skinfunlab'] = __DIR__ . '/Skinfunlab.php';
$wgAutoloadClasses['funlabTemplate'] = __DIR__ . '/funlabTemplate.php';
$wgMessagesDirs['funlab'] = __DIR__ . '/i18n';

// Register skin
$wgValidSkinNames['funlab'] = 'funlab';

// Register modules
$wgResourceModules['skins.funlab.styles'] = array(
	'styles' => array(
		'main.css' => array( 'media' => 'screen' ),
	),
	'remoteSkinPath' => 'funlab',
	'localBasePath' => __DIR__,
);
