<?php declare(strict_types=1);

class SearchPoint {
	public function __construct(
		public float $long,
		public float $lat,
	){}
}

interface Searchable {
	/** @return SearchPoint[] */
	public function searchPoints(): array;
}

class Camera implements Searchable {
	public function __construct(
		private float $long,
		private float $lat,
	) {}

	public function searchPoints(): array {
		return [new SearchPoint($this->long, $this->lat)];
	}
}

class SpeedCamera implements Searchable {
	public function __construct(
		/** @property Camera[] $cameras **/
		private array $cameras,
	) {}

	public function searchPoints(): array {
		$searchPoints = [];
		foreach ($this->cameras as $camera) {
			$searchPoints = array_merge($searchPoints, $camera->searchPoints());
		}

		return $searchPoints;
	}
}


$camera1 = new Camera(1, 1);
$camera2 = new SpeedCamera([new Camera(2, 2), new Camera(3, 3,)]);

var_dump($camera1->searchPoints());
var_dump($camera2->searchPoints());



