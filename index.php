<?php 
/**
* Find the surface area of all the boxes, using 2 * l * w + 2 * w * h + 2 * h * l
* Add the area of the smallest side of each box
*
*
* @author Vince Jones <vjones@nerdery.com>
*/


$allPresents = new WrapPresents();
echo "The elves will need ".number_format($allPresents->getAllDimensions())." SqFt of wrapping paper to wrap all the presents" . PHP_EOL;


class WrapPresents {

	public function __construct() {
		$this->boxes = file("data/present-dimensions.txt");
		$this->totalPaperNeeded = 0;
	}

	 public function getBoxDimensions($box) {
		 $dimensions = explode("x", $box);

		 if ( count($dimensions) < 3) {
			 return 0;
		 }
		 $dimensions = array_map(function ($value) {
			 return (int)$value;
		 },$dimensions);

		 $length = $dimensions[0];
		 $width = $dimensions[1];
		 $height = $dimensions[2];

		 $sqFtOfBox = 2 * $length * $width + 2 * $width * $height + 2 * $height * $length;

		 $minValOne = min($dimensions);
		 unset($dimensions[array_search($minValOne, $dimensions)]);
		 $minValTwo = min($dimensions);

		 $allSqFtNeeded = $minValOne * $minValTwo + $sqFtOfBox;

		 return $allSqFtNeeded;
	 }

	public function getAllDimensions() {
		foreach ($this->boxes as $box) {
			$this->totalPaperNeeded += $this->getBoxDimensions($box);
		}
		return $this->totalPaperNeeded;
	}
}