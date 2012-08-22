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
 * Importing Interface
 */
require CSVLibrary_Path . 'Writer/Interface.php';

/**
 * 
 * Csv Writer Class
 * @author Lucas Mendes de Freitas (devsdmf)
 * @since 2012
 * @category Csv
 * @package Csv
 * @version 1.0.0
 *
 */

class Csv_Writer implements Csv_Writer_Interface
{
	/**
	 * Var to store the instance returned by Singleton method
	 * @var Csv_Writer
	 */
	protected static $_instance = null;
	/**
	 * Var to store the file handler
	 * @var mixed
	 */
	protected $_handler = null;
	/**
	 * Var to store the data
	 * @var array
	 */
	protected $_data = array();
	/**
	 * Var to store the delimiter 
	 * @var string
	 */
	protected $_delimiter = ',';
	/**
	 * Constructor
	 */
	private function __construct(){}
	/**
	 * Function to get an instance of this class
	 * @return Csv_Writer
	 */
	public static function getInstance()
	{
		if(!self::$_instance instanceof Csv_Writer)
			self::$_instance = new Csv_Writer(); 
		return self::$_instance;
	}
	/**
	 * Function to write content in csv file
	 * @see Csv/Writer/Csv_Writer_Interface::write()
	 * @param mixed $handler
	 * @param array $data
	 * @param string $delimiter
	 * @return Size writted in file or boolean false case an error ocourred
	 */
	public function write($handler , $data , $delimiter )
	{
		self::verifyInstance(); 
		
		if(!is_null($handler))
			$this->setHandler($handler);
		
		if(is_array($data))
			$this->setData($data);
		
		if(is_string($delimiter))
			$this->setDelimiter($delimiter);
		
		return $this->writeInFile();
	}
	/**
	 * Function to set the handler in object
	 * @see Csv/Writer/Csv_Writer_Interface::setHandler()
	 * @param mixed $handler
	 * @return void
	 */
	public function setHandler( $handler )
	{
		self::verifyInstance(); 
		
		$this->_handler = $handler;
	}
	/**
	 * Function to set data in object
	 * @see Csv/Writer/Csv_Writer_Interface::setData()
	 * @param array $data
	 * @return void
	 */
	public function setData( array $data )
	{
		self::verifyInstance();
		
		if(is_array($data))
			$this->_data = $data;
		else
			Csv_Exception::triggerException(2);
	}
	/**
	 * Function to set the delimiter in object
	 * @see Csv/Writer/Csv_Writer_Interface::setDelimiter()
	 * @param string $delimiter
	 * @return void
	 */
	public function setDelimiter( $delimiter )
	{
		self::verifyInstance();
		
		if(is_string($delimiter))
			$this->_delimiter = $delimiter;
		else
			Csv_Exception::triggerException(2);
	}
	/**
	 * Function to write content in file
	 * @return Size writted in file or boolean false case an error ocourred
	 */
	protected function writeInFile()
	{
		fseek($this->_handler, 0, SEEK_END);
		$rs = fputcsv($this->_handler, $this->_data, $this->_delimiter);
		return $rs;
	}
	/**
	 * Function to verify if object is correctly initialized
	 * @return void
	 */
	protected function verifyInstance()
	{
		if(is_null(self::$_instance))
			Csv_Exception::triggerException(1);
	}
}