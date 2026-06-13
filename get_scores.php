<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require 'db.php';

// 撈取分數最高的前 10 名
$sql = "SELECT player_name, score, level, created_at FROM leaderboard ORDER BY score DESC LIMIT 10";
$stmt = $pdo->query($sql);
$results = $stmt->fetchAll();

echo json_encode($results);
?>