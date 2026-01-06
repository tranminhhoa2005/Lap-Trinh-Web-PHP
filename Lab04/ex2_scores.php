<?php
$scores = [8.5, 7.0, 9.25, 6.5, 8.0, 5.75];
$avg = array_sum($scores) / count($scores);
$high_scores = array_filter($scores, fn($s) => $s >= 8.0);

$max = max($scores);
$min = min($scores);

$asc_scores = $scores; sort($asc_scores);
$desc_scores = $scores; rsort($desc_scores);

echo "Điểm trung bình: " . number_format($avg, 2) . "<br>";
echo "Các điểm >= 8.0: " . implode(", ", $high_scores) . " (Tổng: " . count($high_scores) . ")<br>";
echo "Max: $max, Min: $min <br>";
echo "Tăng dần: " . implode(", ", $asc_scores) . "<br>";
echo "Giảm dần: " . implode(", ", $desc_scores);