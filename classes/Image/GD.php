<?php

class Image_GD extends Kohana_Image_GD
{
	protected function _do_place($i, $offset_x, $offset_y, $size_x, $size_y)
	{
		// Loads image if not yet loaded
		$this->_load_image();

		// Create the watermark image resource
		$overlay = imagecreatefromstring($i->render());

		//imagealphablending($overlay, FALSE);
		//imagesavealpha($overlay, TRUE);

		// Get the width and height of the watermark
		$width  = imagesx($overlay);
		$height = imagesy($overlay);

		if($size_x === NULL)
		{
			$size_x = $width;
		}

		if($size_y === NULL)
		{
			$size_y = $height;
		}

		// Alpha blending must be enabled on the background!
		imagealphablending($this->_image, true);
		//imagesavealpha($this->_image, TRUE);

		if (imagecopyresampled($this->_image, $overlay, $offset_x, $offset_y, 0, 0, $size_x, $size_y, $width, $height))
		{
			// Destroy the overlay image
			imagedestroy($overlay);
		}
	}

	protected function _do_text($text, $color, $font, $size, $x, $y, $angle = 0)
	{
		$this->_load_image();

		if($x == 'center')
		{
			$box = imagettfbbox($size, $angle, $font, $text);
			$width = Arr::get($box, 2, 0);

			$x = intval((imagesx($this->_image) - $width) / 2);
		}

		$color = imagecolorallocate($this->_image, $color[0], $color[1], $color[2]);
		imagettftext($this->_image, $size, $angle, $x, $y, $color, $font, $text);
	}

	protected function _do_fill($color, $x, $y)
	{
		$this->_load_image();

		$color = imagecolorallocate($this->_image, $color[0], $color[1], $color[2]);
		imagefill($this->_image, $x, $y, $color);
	}

	protected function _do_rectangle($color, $x, $y, $width, $height)
	{
		$this->_load_image();

		if($x == 'center')
		{
			$x = intval((imagesx($this->_image) - $width) / 2);
		}

		$color = imagecolorallocate($this->_image, $color[0], $color[1], $color[2]);
		imagefilledrectangle($this->_image, $x, $y, $x + $width, $y + $height, $color);
	}
}