<?php
/**
 * GoogleMapsFU: MapCanvasProjection (pseudo, only shares same methods, but
 *               works differently to the javascript version)
 *
 * @author Günter Grodotzki <guenter@weheartwebsites.de>
 * @version 20140325
 * @see https://developers.google.com/maps/documentation/javascript/examples/map-coordinates
 */
namespace GoogleMapsFU
{
	class MapCanvasProjection
	{
		const TILE_SIZE = 256;
		
		private $zoom;
		private $numTiles;
		private $pixelOrigin;
		private $pixelsPerLngDegree;
		private $pixelsPerLngRadian;
		
		public function __construct($zoom)
		{
			$this->zoom = $zoom;
			$this->numTiles = 1 << $this->zoom;
			$this->pixelOrigin = new \GoogleMapsFU\Point(self::TILE_SIZE / 2, self::TILE_SIZE / 2);
			$this->pixelsPerLngDegree = self::TILE_SIZE / 360;
			$this->pixelsPerLngRadian = self::TILE_SIZE / (2 * M_PI);
		}
		
		/**
		 * Computes the pixel coordinates of the given geographical location in the DOM element that holds the draggable map.
		 * @param \GoogleMapsFU\LatLng $latLng
		 * @return \GoogleMapsFU\Point
		 */
		public function fromLatLngToDivPixel(\GoogleMapsFU\LatLng $latLng)
		{
			$point = new \GoogleMapsFU\Point(0, 0);
			
			$point->x = $this->pixelOrigin->x + $latLng->lng() * $this->pixelsPerLngDegree;
			
			// Truncating to 0.9999 effectively limits latitude to 89.189. This is
			// about a third of a tile past the edge of the world tile.
			$siny = $this->bound(sin($latLng->lat(true)), -0.9999, 0.9999);

			$point->y = $this->pixelOrigin->y + 0.5 * log((1 + $siny) / (1 - $siny)) * -$this->pixelsPerLngRadian;
			
			$point->x *= $this->numTiles;
			$point->y *= $this->numTiles;
			
			return $point;
		}
		
		/**
		 * Computes the geographical coordinates from pixel coordinates in the div that holds the draggable map.
		 * @param \GoogleMapsFU\Point $pixel
		 * @return \GoogleMapsFU\LatLng
		 */
		public function fromDivPixelToLatLng(\GoogleMapsFU\Point $pixel)
		{
			$lng = ($pixel->x - $this->pixelOrigin->x) / $this->pixelsPerLngDegree;
			$latRadians = ($pixel->y - $this->pixelOrigin->y) / -$this->pixelsPerLngRadian;
			$lat = rad2deg(2 * atan(exp($latRadians)) - M_PI / 2);
			
			return new \GoogleMapsFU\LatLng($lat, $lng);
		}
		
		private function bound($value, $optMin, $optMax)
		{
			$value = max($value, $optMin);
			$value = min($value, $optMax);
			
			return $value;
		}
	}
}