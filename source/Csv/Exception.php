<?php

/**
 * CSV LIBRARY
 * 
 * This program is free software: you can redistribute it and / or
 * modify it under the terms of the GNU General Public License as
 * published by the Free Software Foundation (FSF), version 2 of the
 * License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of fitness for any
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program, if not, write to the Foundation of Software
 * Free (FSF) Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 * 
 * For the complete license, read COPYING text file on the project page.
 * 
 * Any problems, read README text file, containts instructions for problems solutions.
 * 
 * @category Csv
 * @package Csv
 * @copyright SDMF Development Systems (c) 2011-2012 (http://www.devsdmf.net)
 * 
 */

/**
 * 
 * Csv Exception Manager Class
 * @author Lucas Mendes de Freitas (devsdmf)
 * @since 2012
 * @category Csv
 * @package Csv
 * @version 1.0.0
 *
 */

class Csv_Exception 
{
	
	const INCORRECT_INITIALIZATION = 'Use Singleton method to get the instance of this class.';
	
	const INVALID_DATA_TYPE = 'Verify parameters on methods, invalid values have been inserted.';
	
	const FILE_NOTEXISTS = 'File not exists, use create method of Csv Library.';
	
	const FILE_NOT_OPENED = 'Open one file first!';
	
	const DEFAULT_EXCEPTION = 'Unknow error!';
	/**
	 * Function to get the message by the code of error
	 * @param int $code
	 * @return string
	 */
	static function getMessage( $code )
	{
		switch($code)
		{
			case 1 :
				return self::INCORRECT_INITIALIZATION;
				break;
			case 2 :
				return self::INVALID_DATA_TYPE;
				break;
			case 3 :
				return self::FILE_NOTEXISTS;
				break;
			case 4 :
				return self::FILE_NOT_OPENED;
				break;
			default :
				return self::DEFAULT_EXCEPTION;
				break;
		}
	}
	/**
	 * Function to trigger an Exception
	 * @param int $code
	 * @return void
	 */
	static function triggerException( $code )
	{
		$message = self::getMessage($code);
		$e = new Exception();	
		echo '<h1>CSV Library Exception</h1><br />';
		echo '<h2>' . $message . '</h2>';
		echo $e->getTraceAsString();
		die();
	}
}