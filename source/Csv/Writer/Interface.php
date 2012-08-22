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
 * Interface for Csv Writer Class
 * @author Lucas Mendes de Freitas (devsdmf)
 * @since 2012
 * @category Csv
 * @package Csv
 * @subpackage Csv_Writer
 * @version 1.0.0
 *
 */

interface Csv_Writer_Interface
{
	/**
	 * Function to write data on csv file
	 * @param mixed $handler
	 * @param array $data
	 * @param string $delimiter
	 * @return Size written on file or boolean false case an error ocourred
	 */
	public function write( $handler , $data , $delimiter );
	/**
	 * Function to set handler file in object
	 * @param mixed $handler
	 * @return void
	 */
	public function setHandler( $handler );
	/**
	 * Function to set data in object
	 * @param array $data
	 * @return void
	 */
	public function setData( array $data );
	/**
	 * Function to set the delimiter to write in csv file
	 * @param string $delimiter
	 * @return void
	 */
	public function setDelimiter( $delimiter );
}