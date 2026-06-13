<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // 如果前後端在不同網域請開啟
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

require 'db.php';

// 接收前端傳來的 JSON 資料
$data = json_decode(file_get_contents("php://input"));

if (isset($data->player_name) && isset($data->score) && isset($data->level)) {
    $name = htmlspecialchars(strip_tags($data->player_name));
    $score = (int)$data->score;
    $level = (int)$data->level;

    $sql = "INSERT INTO leaderboard (player_name, score, level) VALUES (:name, :score, :level)";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute(['name' => $name, 'score' => $score, 'level' => $level])) {
        echo json_encode(["status" => "success", "message" => "戰績已上傳"]);
    } else {
        echo json_encode(["status" => "error", "message" => "資料庫寫入失敗"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "資料格式錯誤"]);
}
?>