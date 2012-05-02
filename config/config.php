<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight webCMS
 *
 * The TYPOlight webCMS is an accessible web content management system that 
 * specializes in accessibility and generates W3C-compliant HTML code. It 
 * provides a wide range of functionality to develop professional websites 
 * including a built-in search engine, form generator, file and user manager, 
 * CSS engine, multi-language support and many more. For more information and 
 * additional TYPOlight applications like the TYPOlight MVC Framework please 
 * visit the project website http://www.typolight.org.
 *
 * This is the catalog cataloggeocoordsfield extension configuration file.
 *
 * PHP version 5
 * @copyright  Nikolas Runde 2011
 * @author     Nikolas Runde  <nikolas.runde@nrmedia.de> 
 * @package    CatalogGeoCoordsField
 * @license    GPL 
 * Fieldimage copyright by http://www.famfamfam.com/lab/icons/silk/
 */


/**
 * Back-end module
 */
 
// Register field type editor to catalog module.
$GLOBALS['BE_MOD']['content']['catalog']['fieldTypes']['googlemapsfield'] = array
(
	'typeimage'    => 'system/modules/cataloggooglemapsfield/html/world.png',
	'fieldDef'     => array
	(
		'input_field_callback' => array('CatalogGoogleMapsField', 'getField')
        /*'inputType' => 'checkbox',
		'save_callback' =>array(array('CatalogGoogleMapsField', 'saveField')),
		'eval'      => array
		(
			'doNotSaveEmpty'=>true,
			'alwaysSave'=>true,
			//'readonly'=>true,
		),*/
	),
	'sqlDefColumn' => "int(1)",
);

$GLOBALS['BE_MOD']['content']['catalog']['typesCatalogFields'][] = 'googlemapsfield';

?>