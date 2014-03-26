<?php
/**
 * GoogleMapsFU: this represents a cluster of markers
 * 
 * @project GoogleMapsFU
 * @author Günter Grodotzki <guenter@weheartwebsites.de>
 * @version 20140326
 */
namespace GoogleMapsFU\MarkerClusterer
{
	class Cluster implements \ArrayAccess
	{
		public $length;
		private $markers = array();
		private $center;
		
		public function addMarker(\GoogleMapsFU\Marker $marker)
		{
			if ($this->center === null)
			{
				$this->center = $marker->getPosition();
			}
			
			$this->markers[] = $marker;
			++$this->length;
		}
		
		public function getCenter()
		{
			return $this->center;
		}
		
		public function offsetSet($offset, $value)
		{
			if (is_null($offset))
			{
				$this->markers[] = $value;
				++$this->length;
			}
			else
			{
				$this->markers[$offset] = $value;
			}
		}
		
		public function offsetExists($offset)
		{
			return isset($this->markers[$offset]);
		}
		
		public function offsetUnset($offset)
		{
			unset($this->markers[$offset]);
			--$this->length;
		}
		
		public function offsetGet($offset)
		{
			if (isset($this->markers[$offset]))
			{
				return $this->markers[$offset];
			}
			return null;
		}
	}
}