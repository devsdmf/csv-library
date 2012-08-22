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
 * Interface for Csv Reader Class
 * @author Lucas Mendes de Freitas (devsdmf)
 * @since 2012
 * @category Csv
 * @package Csv
 * @subpackage Csv_Reader
 * @version 1.0.0
 *
 */

interface Csv_Reader_Interface
{
	/**
	 * Function to read one line of csv file
	 * @param mixed $handler
	 * @param string $delimiter
	 * @param string $enclosure
	 * @param string $escape
	 * @return array with contents of csv file or array null if the pointer is in end of file
	 */
	public function readln( $handler , $delimiter , $enclosure , $escape );
	/**
	 * Function to read all content of csv file
	 * @param mixed $handler
	 * @param int $length
	 * @param string $delimiter
	 * @param enclosure $enclosure
	 * @param escape $escape
	 * @return array with contents of csv file or array null if the pointer is in end of file
	 */
	public function read( $handler , $length , $delimiter , $enclosure , $escape );
	/**
	 * Function to set the handler in object
	 * @param mixed $handler
	 * @return void
	 */
	public function setHandler( $handler );
	/**
	 * Function to set the lenght used in read methods
	 * @param int $lenght
	 * @return void
	 */
	public function setLength( $lenght );
	/**
	 * Function to set the delimiter used in read methods
	 * @param string $delimiter
	 * @return void
	 */
	public function setDelimiter( $delimiter );
	/**
	 * Function to set the enclosure used in read methods
	 * @param string $enclosure
	 * @return void
	 */
	public function setEnclosure( $enclosure );
	/**
	 * Function to set the escape char 
	 * @param string $escape
	 */
	public function setEscape( $escape );
	/**
	 * Function to return the actual data stored in object
	 * @return array
	 */
	public function getData();
}