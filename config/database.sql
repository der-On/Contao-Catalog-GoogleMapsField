-- **********************************************************
-- *                                                        *
-- * IMPORTANT NOTE                                         *
-- *                                                        *
-- * Do not import this file manually but use the TYPOlight *
-- * install tool to create and maintain database tables!   *
-- *                                                        *
-- **********************************************************


-- --------------------------------------------------------

CREATE TABLE `tl_catalog_fields` (
  `googlemaps_latfield` varchar(60) NOT NULL default ' ',
  `googlemaps_lonfield` varchar(255) NOT NULL default '',
  `googlemaps_zoomfield` varchar(255) NOT NULL default '',
) TYPE=MyISAM DEFAULT CHARSET=utf8;