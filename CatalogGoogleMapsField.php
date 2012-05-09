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
 * This is the catalog geocoordsfield extension file.
 *
 * PHP version 5
 * @copyright  Nikolas Runde 2011
 * @author     Nikolas Runde  <nikolas.runde@nrmedia.de> 
 * @package    CatalogGeoCoordsField
 * @license    GPL 
 * @filesource
 */

// class to manipulate the field info to be as we want it to be, to render it and to make editing possible.
class CatalogGoogleMapsField extends Backend
{
    public function getField($dc)
    {
        $GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/cataloggooglemapsfield/html/googlemapsfield.js';
        $GLOBALS['TL_JAVASCRIPT'][] = 'https://maps.googleapis.com/maps/api/js?sensor=false';

        $objField = $this->Database->prepare("SELECT name, description, colName, googlemaps_lonfield, googlemaps_latfield, googlemaps_zoomfield FROM tl_catalog_fields WHERE colName=?")
            ->limit(1)
            ->execute($dc->field);

        if (!$objField->numRows)
        {
            return null;
        }

        $out = '<div><h3>' . $objField->name . '</h3>';
        $out.='<label class="tl_label" for="ctrl_'.$objField->colName.'_address">'.$GLOBALS['TL_LANG']['cataloggooglemapsfield']['geocode'].'</label>';
        $out.='<input type="text" class="tl_text" id="ctrl_'.$objField->colName.'_address" onfocus="Backend.getScrollOffset()" />';
        $out.='<a href="javascript:void(0);" class="tl_submit" id="ctrl_'.$objField->colName.'_address_submit">'.$GLOBALS['TL_LANG']['cataloggooglemapsfield']['geocode_search'].'</a>';
        $out.='<div id="ctrl_' . $objField->colName . '" style="width:100%;height:30em;margin:1em 0;"></div>';
        $out.='<p class="tl_help tl_tip">' . $objField->description . '</p>';
        $out.='<script type="text/javascript">$(window).addEvent("domready",function(){ new GoogleMapsField("ctrl_' . $objField->colName . '","ctrl_' . $objField->googlemaps_latfield. '","ctrl_' . $objField->googlemaps_lonfield. '","ctrl_' . $objField->googlemaps_zoomfield. '"); });</script>';
        $out.='</div>';

        return $out;
    }
}
?>