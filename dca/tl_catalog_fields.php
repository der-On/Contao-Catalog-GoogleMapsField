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
 * This is the enhancement to the data container array for table tl_catalog_fields 
 * to allow the custom field type for geocoordsfield.
 *
 * PHP version 5
 * @copyright  Nikolas Runde 2011
 * @author     Nikolas Runde  <nikolas.runde@nrmedia.de> 
 * @package    CatalogGeoCoordsField
 * @license    GPL 
 * @filesource
 */


/**
 * Table tl_catalog_fields 
 */

// Palettes
$GLOBALS['TL_DCA']['tl_catalog_fields']['palettes']['googlemapsfield'] = 'name,description,type,colName,googlemaps_latfield,googlemaps_lonfield,googlemaps_zoomfield';

// register our fieldtype editor to the catalog Fields
$GLOBALS['TL_DCA']['tl_catalog_fields']['fields']['googlemaps_latfield'] = array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_catalog_fields']['googlemaps_latfield'],
			'inputType'               => 'select',
			'options_callback'        => array('tl_catalog_googlemaps', 'getFields'),
			'eval'                    => array('includeBlankOption'=>true, 'tl_class'=>'w50', 'mandatory'=>true),
		);

$GLOBALS['TL_DCA']['tl_catalog_fields']['fields']['googlemaps_lonfield'] = array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_catalog_fields']['googlemaps_lonfield'],
			'inputType'               => 'select',
			'options_callback'        => array('tl_catalog_googlemaps', 'getFields'),
			'eval'                    => array('includeBlankOption'=>true, 'tl_class'=>'w50', 'mandatory'=>true),
		);
		
$GLOBALS['TL_DCA']['tl_catalog_fields']['fields']['googlemaps_zoomfield'] = array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_catalog_fields']['googlemaps_zoomfield'],
			'inputType'               => 'select',
			'options_callback'        => array('tl_catalog_googlemaps', 'getFields'),
			'eval'                    => array('includeBlankOption'=>true, 'tl_class'=>'w50', 'mandatory'=>false),
		);

$GLOBALS['TL_DCA']['tl_catalog_fields']['fields']['type']['options'][] = 'googlemapsfield';

class tl_catalog_googlemaps extends Backend
{
	function getFields(DataContainer $dc)
	{
        $objField = $this->Database->prepare("SELECT pid FROM tl_catalog_fields WHERE id=?")
            ->limit(1)
            ->execute($dc->id);

        if (!$objField->numRows)
        {
            return array();
        }

        $pid = $objField->pid;

        $objFields = $this->Database->prepare("SELECT name, colName FROM tl_catalog_fields WHERE pid=? AND id!=? AND type IN ('select','number','decimal')")
            ->execute($pid, $dc->id);

        $result = array();
        while ($objFields->next())
        {
            $result[$objFields->colName] = $objFields->name;
        }

        return $result;
	}
}
?>