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
 * Definig Library Path
 * @var string
 */
define("CSVLibrary_Path" , dirname(__FILE__) . '/Csv/');

/**
 * Loading Classes
 */

require CSVLibrary_Path . 'Interface.php';

require CSVLibrary_Path . 'Exception.php';

require CSVLibrary_Path . 'Reader.php';

require CSVLibrary_Path . 'Writer.php';

/**
 * 
 * Csv Library Class
 * @author Lucas Mendes de Freitas (devsdmf)
 * @since 2012
 * @category Csv
 * @package Csv
 * @version 1.0.0
 *
 */

class Csv implements Csv_Interface
{
	/**
	 * Var to store the name of file
	 * @var string
	 * @access protected
	 */
	protected $_file = null;
	/**
	 * Var to store the handle returned by fopen function
	 * @var mixed
	 */
	protected $_handle = null;
	/**
	 * The instance of Csv_Writer
	 * @var Csv_Writer
	 */
	protected $_writer = null;
	/**
	 * The instance of Csv_Reader
	 * @var Csv_Reader
	 */
	protected $_reader = null;
	/**
	 * The delimiter used in operations
	 * @var string
	 */
	protected $_delimiter = ',';
	/**
	 * The enclosure param
	 * @var string
	 */
	protected $_enclosure = '"';
	/**
	 * The escape char
	 * @var string
	 */
	protected $_escape = '\\';
	/**
	 * Constructor
	 * @return Csv
	 */
	public function __construct()
	{
		$this->_writer = Csv_Writer::getInstance();
		$this->_reader = Csv_Reader::getInstance();	
	}
	/**
	 * Function to open an exists csv file
	 * @see Csv/Csv_Interface::open()
	 * @param string $file
	 * @return boolean
	 */
	public function open( $file )
	{
		if(file_exists($file))
		{
			$this->_file = $file;
			$this->_handle = fopen($this->_file, "r+");
			return $this->fileOpened();
		} else
			Csv_Exception::triggerException(3);
	}
	/**
	 * Function to create a new csv file, if exists will be opened with pointer in end of file
	 * @see Csv/Csv_Interface::create()
	 * @param string $file
	 * @return boolean
	 */
	public function create( $file )
	{
		$this->_file = $file;
		$this->_handle = fopen($this->_file, "a+");
		return $this->fileOpened();
	}
	/**
	 * Function to get one line of csv file opened
	 * @see Csv/Csv_Interface::readln()
	 * @param string $delimiter
	 * @param string $enclosure
	 * @param string $escape
	 * @return array with content of csv file case success or array null if pointer is in end of file 
	 */
	public function readln($delimiter = null, $enclosure = null, $escape = null)
	{
		if(is_string($delimiter))
			$this->setDelimiter($delimiter);
			
		if(is_string($enclosure))
			$this->setEnclosure($enclosure);
			
		if(is_string($escape))
			$this->setEscape($escape);
		if($this->fileOpened())
			return $this->_reader->readln($this->_handle,$this->_delimiter,$this->_enclosure,$this->_escape);
		else
			Csv_Exception::triggerException(4);
	}	
	/**
	 * Function to get full content of csv file
	 * @see Csv/Csv_Interface::read()
	 * @param string $delimiter
	 * @param string $enclosure
	 * @param string $escape
	 * @return array with content of csv file case success or array null if pointer is in end of file 
	 */
	public function read($delimiter = null, $enclosure = null, $escape = null)
	{
		if(is_string($delimiter))
			$this->setDelimiter($delimiter);
			
		if(is_string($enclosure))
			$this->setEnclosure($enclosure);
			
		if(is_string($escape))
			$this->setEscape($escape);
			
		if($this->fileOpened())
			return $this->_reader->read($this->_handle, 0, $this->_delimiter, $this->_enclosure, $this->_escape);
		else
			Csv_Exception::triggerException(4);
	}
	/**
	 * Function to write in csv file
	 * @see Csv/Csv_Interface::write()
	 * @param array $data
	 * @param string $delimiter
	 * @return size written in file, or boolean false if an error occurred
	 */
	public function write( array $data, $delimiter = null)
	{
		if(is_string($delimiter))
			$this->setDelimiter($delimiter);
		
		if($this->fileOpened())
			return $this->_writer->write($this->_handle, $data , $this->_delimiter);
		else
			Csv_Exception::triggerException(4);
	}
	/**
	 * Function to close the file
	 * @see Csv/Csv_Interface::close()
	 * @return null
	 */
	public function close()
	{
		if($this->fileOpened())
			fclose($this->_handle);
		return null;
	}
	/**
	 * Function to remove the file
	 * @see Csv/Csv_Interface::remove()
	 * @param string $file
	 * @return boolean
	 */
	public function remove( $file )
	{
		$rs = unlink($file);
		return $rs;
	}
	/**
	 * Function to clone the file
	 * @see Csv/Csv_Interface::cloning()
	 * @param string $file
	 * @param string $newfile
	 * @return boolean
	 */
	public function cloning( $file , $newfile )
	{
		$rs = copy($file, $newfile);
		return $rs;
	}
	/**
	 * Function to set the delimiter
	 * @see Csv/Csv_Interface::setDelimiter()
	 * @param string $delimiter
	 * @return void
	 */
	public function setDelimiter( $delimiter )
	{
		if(is_string($delimiter))
			$this->_delimiter = $delimiter;
		else
			Csv_Exception::triggerException(2);
	}
	/**
	 * Function to set the enclosure
	 * @see Csv/Csv_Interface::setEnclosure()
	 * @param string $enclosure
	 * @return void
	 */
	public function setEnclosure( $enclosure )
	{
		if(is_string($enclosure))
			$this->_enclosure = $enclosure;
		else
			Csv_Exception::triggerException(2);
	}
	/**
	 * Function to set the escape char
	 * @see Csv/Csv_Interface::setEscape()
	 * @param string $escape
	 * @return void
	 */
	public function setEscape( $escape )
	{
		if(is_string($escape))
			$this->_escape = $escape;
		else
			Csv_Exception::triggerException(2);
	}
	/**
	 * Function to verify if the file has opened
	 * @return boolean
	 */
	protected function fileOpened()
	{
		if($this->_handle)
			return true;
		else
			return false;
	}
}