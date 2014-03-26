<?php
/**
 * GoogleMapsFU: Marker representation
 * 
 * @project GoogleMapsFU
 * @see https://developers.google.com/maps/documentation/javascript/reference#Marker
 * @author Günter Grodotzki <guenter@weheartwebsites.de>
 * @version 20140326
 */
namespace GoogleMapsFU
{
	class Marker
	{
		private $position;
		private $meta;
		
		public function getMeta()
		{
			return $this->meta;
		}
		
		public function setMeta($meta)
		{
			$this->meta = $meta;
		}
		
		public function getPosition()
		{
			return $this->position;
		}
		
		public function setPosition(\GoogleMapsFU\LatLng $latLng)
		{
			$this->position = $latLng;
		}
		
		public function distance(\GoogleMapsFU\Marker $other, $zoom)
		{
			$x1 = $this->getPosition()->lngToX();
			$y1 = $this->getPosition()->latToY();
			
			$x2 = $other->getPosition()->lngToX();
			$y2 = $other->getPosition()->latToY();
			
			return sqrt(pow(($x1 - $x2), 2) + pow(($y1 - $y2), 2)) >> (21 - $zoom);
		}
	}
}