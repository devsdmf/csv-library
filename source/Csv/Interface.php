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
 * Interface for Csv Clas
 * @author Lucas Mendes de Freitas (devsdmf)
 * @since 2012
 * @category Csv
 * @package Csv
 * @version 1.0.0
 * 
 */

interface Csv_Interface
{
	/**
	 * Function to open an exists csv file
	 * @param string $file
	 * @return boolean
	 */
	public function open( $file );
	/**
	 * Function to create a new csv file, if exists will be opened with pointer in end of file
	 * @param string $file
	 * @return boolean
	 */
	public function create( $file );
	/**
	 * Function to get one line of csv file opened
	 * @param string $delimiter
	 * @param string $enclosure
	 * @param string $escape
	 * @return array with content of csv file case success or array null if pointer is in end of file 
	 */
	public function readln( $delimiter = null , $enclosure = null , $escape = null );
	/**
	 * Function to get full content of csv file
	 * @param string $delimiter
	 * @param string $enclosure
	 * @param string $escape
	 * @return array with content of csv file case success or array null if pointer is in end of file 
	 */
	public function read( $delimiter = null , $enclosure = null , $escape = null );
	/**
	 * Function to write in csv file
	 * @param array $data
	 * @param string $delimiter
	 * @return size written in file, or boolean false if an error occurred
	 */
	public function write( array $data , $delimiter = null );
	/**
	 * Function to close the file
	 * @see Csv/Csv_Interface::close()
	 * @return null
	 */
	public function close();
	/**
	 * Function to remove the file
	 * @see Csv/Csv_Interface::remove()
	 * @param string $file
	 * @return boolean
	 */
	public function remove( $file );
	/**
	 * Function to clone the file
	 * @see Csv/Csv_Interface::cloning()
	 * @param string $file
	 * @param string $newfile
	 * @return boolean
	 */
	public function cloning( $file , $newfile );
	/**
	 * Function to set the delimiter
	 * @see Csv/Csv_Interface::setDelimiter()
	 * @param string $delimiter
	 * @return void
	 */
	public function setDelimiter( $delimiter );
	/**
	 * Function to set the enclosure
	 * @see Csv/Csv_Interface::setEnclosure()
	 * @param string $enclosure
	 * @return void
	 */
	public function setEnclosure( $enclosure );
	/**
	 * Function to set the escape char
	 * @see Csv/Csv_Interface::setEscape()
	 * @param string $escape
	 * @return void
	 */
	public function setEscape( $escape );
}