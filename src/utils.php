<?php

namespace App;

function getRandomPastelColor() : string {
	$colors = [
		"pastel-blue", "pastel-bland-pink",
		"pastel-pink", "pastel-yellow", "pastel-green",
	];
	return $colors[array_rand($colors)];
}