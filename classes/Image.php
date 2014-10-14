<?php

abstract class Image extends Kohana_Image
{
	public function place($i, $offset_x, $offset_y, $size_x = null, $size_y = null)
	{
		$this->_do_place($i, $offset_x, $offset_y, $size_x, $size_y);

		return $this;
	}

	public function text($text, $color, $font, $size, $x, $y, $angle = 0)
	{
		$this->_do_text($text, $color, $font, $size, $x, $y, $angle = 0);

		return $this;
	}

	public function fill($color, $x, $y)
	{
		$this->_do_fill($color, $x, $y);

		return $this;
	}

	public function rectangle($color, $x, $y, $width, $height)
	{
		$this->_do_rectangle($color, $x, $y, $width, $height);

		return $this;
	}
}