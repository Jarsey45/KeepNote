<?php

function getRandomPastelColor() : string {
  $colors = [
    "pastel-blue", "pastel-bland-pink",
    "pastel-pink", "pastel-yellow", "pastel-green",
  ];
  return $colors[array_rand($colors)];
}

function createPreparedWhereClause(array $conditions): string
{
  if (empty($conditions)) {
    return '1=1'; // No conditions, return an empty string
  }

  $placeholders = [];
  $whereClauses = [];
  foreach ($conditions as $field => $value) {
    $placeholder = ":" . $field; // Define named placeholder
    $placeholders[] = $placeholder;
    $whereClauses[] = "$field = $placeholder";
  }

  return implode(' AND ', $whereClauses);
}