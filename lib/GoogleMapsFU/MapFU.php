<?php
/**
 * GoogleMapsFU: MapsFU, a pseudo Map class
 * 
 * @project GoogleMapsFU
 * @author Günter Grodotzki <guenter@weheartwebsites.de>
 * @version 20140324
 * @see https://developers.google.com/maps/documentation/javascript/reference#Map
 */
namespace GoogleMapsFU
{
	class MapFU
	{
		private $zoom;
		private $projection;
		
		public function setZoom($zoom)
		{
			$this->zoom = (int) $zoom;
		}
		
		public function getZoom()
		{
			return $this->zoom;
		}
		
		public function getProjection()
		{
			if ($this->projection === null)
			{
				$this->projection = new \GoogleMapsFU\MapCanvasProjection($this->zoom);
			}
			
			return $this->projection;
		}
		
	}
}