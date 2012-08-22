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
require CSVLibrary_Path . 'Reader/Interface.php';

/**
 * 
 * Csv Reader Class
 * @author Lucas Mendes de Freitas (devsdmf)
 * @since 2012
 * @category Csv
 * @package Csv
 * @version 1.0.0
 *
 */

class Csv_Reader implements Csv_Reader_Interface
{
	/**
	 * Var to store the instance of Csv_Reader
	 * @var Csv_Reader
	 */
	protected static $_instance = null;
	/**
	 * Var to store the handler used in methods
	 * @var mixed
	 */
	protected $_handler = null;
	/**
	 * Var to store the last data readed in methods
	 * @var array
	 */
	protected $_data = Array();
	/**
	 * Var to store the default length to read in csv file
	 * @var int
	 */
	protected $_length = 0;
	/**
	 * Var to store the delimiter used in read methods
	 * @var string
	 */
	protected $_delimiter = ',';
	/**
	 * Var to store the enclosure used in read methods
	 * @var string
	 */
	protected $_enclosure = '"';
	/**
	 * Var to store the escape char used in read methods
	 * @var string
	 */
	protected $_escape = '\\';
	/**
	 * Constructor
	 */
	private function __construct(){}
	/**
	 * Method to get the instance of this class
	 * @return Csv_Reader
	 */
	public static function getInstance()
	{
		if(!self::$_instance instanceof Csv_Reader)
			self::$_instance = new Csv_Reader();
		return self::$_instance;
	}
	/**
	 * Function to read on line of csv file
	 * @see Csv/Reader/Csv_Reader_Interface::readln()
	 * @param mixed $handler
	 * @param string $delimiter
	 * @param string $enclosure
	 * @param string $escape
	 * @return array with the contents of csv file or array null if the pointer is in the end of file
	 */
	public function readln($handler, $delimiter, $enclosure, $escape)
	{
		self::verifyInstance();
		
		if(!is_null($handler))
			$this->setHandler($handler);
		
		if(is_string($delimiter))
			$this->setDelimiter($delimiter);
		
		if(is_string($enclosure))
			$this->setEnclosure($enclosure);
		
		if(is_string($escape))
			$this->setEscape($escape);
			
		$this->_data = fgetcsv($this->_handler, 0, $this->_delimiter, $this->_enclosure, $this->_escape);
		
		return $this->getData();
	}
	/**
	 * The function to read all content of csv file
	 * @see Csv/Reader/Csv_Reader_Interface::read()
	 * @param mixed $handler
	 * @param int $lenght
	 * @param string $delimiter
	 * @param string $enclosure
	 * @param string $escape
	 * @return array with contents of csv file or array null if the pointer is in the end of file
	 */
	public function read($handler, $length, $delimiter, $enclosure, $escape)
	{
		self::verifyInstance();
		
		if(!is_null($handler))
			$this->setHandler($handler);
		
		if(is_int($length))
			$this->setLength($length);
		
		if(is_string($delimiter))
			$this->setDelimiter($delimiter);
			
		if(is_string($enclosure))
			$this->setEnclosure($enclosure);
			
		if(is_string($escape))
			$this->setEscape($escape);
			
		$this->resetData();
		
		$this->resetPosition();
		
		while(!feof($this->_handler))
			$this->_data[] = fgetcsv($this->_handler, $this->_length, $this->_delimiter, $this->_enclosure, $this->_escape);
		
		return $this->getData();
	}
	/**
	 * Function to set the handler in object
	 * @see Csv/Reader/Csv_Reader_Interface::setHandler()
	 * @param mixed $handler
	 * @return void
	 */
	public function setHandler($handler)
	{
		self::verifyInstance();
		
		$this->_handler = $handler;
	}
	/**
	 * Function to set the length in object
	 * @see Csv/Reader/Csv_Reader_Interface::setLength()
	 * @param int $length
	 * @return void
	 */
	public function setLength( $lenght )
	{
		self::verifyInstance();
		
		if(is_int($lenght))
			$this->_length = $lenght;
		else
			Csv_Exception::triggerException(2);
	}
	/**
	 * Function to set the delimiter in object
	 * @see Csv/Reader/Csv_Reader_Interface::setDelimiter()
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
	 * Function to set the enclosure
	 * @see Csv/Reader/Csv_Reader_Interface::setEnclosure()
	 * @param string $enclosure
	 * @return void
	 */
	public function setEnclosure( $enclosure )
	{
		self::verifyInstance();
		if(is_string($enclosure))
			$this->_enclosure = $enclosure;
		else
			Csv_Exception::triggerException(2);
	}
	/**
	 * Function to set the escape char in object
	 * @see Csv/Reader/Csv_Reader_Interface::setEscape()
	 * @param string $escape
	 * @return void
	 */
	public function setEscape( $escape )
	{
		self::verifyInstance();
		
		if(is_string($escape))
			$this->_escape = $escape;
		else
			Csv_Exception::triggerException(2);
	}
	/**
	 * Function to get last line readed on csv
	 * @see Csv/Reader/Csv_Reader_Interface::getData()
	 * @return array
	 */
	public function getData()
	{
		self::verifyInstance();
		
		return $this->_data;
	}
	/**
	 * Function to clear data field
	 */
	protected function resetData()
	{
		self::verifyInstance();
		
		$this->_data = Array();
	}
	/**
	 * Function to reset the position of pointer in handler
	 */
	protected function resetPosition()
	{
		self::verifyInstance();
		
		if(fseek($this->_handler, 0, SEEK_SET))
			return true;
		else
			return false;
	}
	/**
	 * Function to verify if object is correctly initialized
	 */
	protected function verifyInstance()
	{
		if(is_null(self::$_instance))
			Csv_Exception::triggerException(1);
	}
}