<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight webCMS
 * Copyright (C) 2005 Leo Feyer
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at http://www.gnu.org/licenses/.
 *
 * PHP version 5
 * @copyright  Andreas Schempp 2009-2010
 * @author     Andreas Schempp <andreas@schempp.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 * @version    $Id$
 */


/**
 * Listing
 */
$GLOBALS['TL_DCA']['tl_page']['list']['label']['label_callback'] = array('tl_page_cacheicon', 'addImage');



class tl_page_cacheicon extends Backend
{

	public function addImage($row, $label, $param3, $param4, $blnReturnImage=false)
	{
		// Parameter sorting has been changed in 2.8: http://dev.typolight.org/issues/show/1488
		if (version_compare(VERSION.'.'.BUILD, '2.7.6', '>'))
		{
			$dc = $param3;
			$imageAttribute = $param4;
		}
		else
		{
			$dc = $prama4;
			$imageAttribute = $param3;
		}
		
		$tl_page = new tl_page();
		$label = version_compare(VERSION.'.'.BUILD, '2.7.6', '>') ? $tl_page->addIcon($row, $label, $dc, $imageAttribute, $blnReturnImage) : $tl_page->addImage($row, $label, $imageAttribute, $dc);
		
		$objPage = $this->getPageDetails($row['id']);
		
		if (intval($objPage->cache) > 0 && !$objPage->protected)
		{
			return str_replace('system/themes/'.$this->getTheme().'/images/', 'system/modules/cacheicon/html/', $label);
		}
		
		return $label;
	}
}

