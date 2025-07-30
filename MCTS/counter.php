<?php
session_start();

// ファイルパス
$counterFile = 'counter.txt';

// ファイルが存在しない場合、初期値を設定
if (!file_exists($counterFile)) {
    $data = [
        'player_wins' => 0,
        'computer_wins' => 0
    ];
    file_put_contents($counterFile, json_encode($data));
}

// ファイルからデータを読み込み
$data = json_decode(file_get_contents($counterFile), true);

// 勝者が決まった場合、勝数を更新
if (isset($_POST['winner'])) {
    if ($_POST['winner'] === 'player') {
        $data['player_wins']++;
    } elseif ($_POST['winner'] === 'computer') {
        $data['computer_wins']++;
    }
    file_put_contents($counterFile, json_encode($data));
}

// プレイヤーの勝数を取得
$playerWins = $data['player_wins'];
$computerWins = $data['computer_wins'];

// プレイヤー番号の計算修正
$totalGames = $playerWins + $computerWins;
$playerNumber = $totalGames + 1;

// 表示データを返す
header('Content-Type: application/json');
echo json_encode([
    'player_wins' => $playerWins,
    'computer_wins' => $computerWins,
    'player_number' => $playerNumber
]);
?>
