<!DOCTYPE html>
<html>
<head>
<style>
    .board-container {
        display: flex;
    }
    .board {
        display: flex;
        flex-wrap: wrap;
        border: 1px solid black;
    }
    .cell {
        box-sizing: border-box;
        border: 1px solid black;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 64px;
        height: 50px;
    }
    .green {
        background-color: green;
    }
    .red {
        background-color: red;
    }
    .yellow {
        background-color: yellow;
    }
    .grey {
        background-color: grey;
    }
    .coordinates {
        font-size: 10px;
    }
    .coord-x, .coord-y {
        font-size: 12px;
    }
</style>
</head>
<body>
<?php
function drawBoard($centerX, $centerY, $width, $height, $minX, $maxX, $minY, $maxY) {
    $boardWidth = $width * 64;
    $board = '<div class="board" style="width:' . $boardWidth . 'px;">';

    for ($y = $centerY + (int)($height / 2); $y >= $centerY - (int)($height / 2); $y--) {
        for ($x = $centerX - (int)($width / 2); $x <= $centerX + (int)($width / 2); $x++) {
            $coordinates = "X: {$x}, Y: {$y}";

            $dx = $x - $centerX;
            $dy = $y - $centerY;
            $direction = '';
            if ($dx == 0 && $dy == 1) {
                $direction = 'N';
            } elseif ($dx == 0 && $dy == -1) {
                $direction = 'S';
            } elseif ($dx == 1 && $dy == 0) {
                $direction = 'E';
            } elseif ($dx == -1 && $dy == 0) {
                $direction = 'W';
            } elseif ($dx == 1 && $dy == 1) {
                $direction = 'NE';
            } elseif ($dx == 1 && $dy == -1) {
                $direction = 'SE';
            } elseif ($dx == -1 && $dy == 1) {
                $direction = 'NW';
            } elseif ($dx == -1 && $dy == -1) {
                $direction = 'SW';
            }

            if ($x == $centerX && $y == $centerY) {
                $board .= '<div class="cell red"><span class="coordinates">' . $coordinates . '</span></div>';
            } elseif (abs($dx) <= 1 && abs($dy) <= 1) {
                $board .= '<div class="cell yellow"><span class="coordinates">' . $coordinates . '<br>' . $direction . '</span></div>';
            } elseif ($x >= $minX && $x <= $maxX && $y >= $minY && $y <= $maxY) {
                $board .= '<div class="cell green"><span class="coordinates">' . $coordinates . '</span></div>';
            } else {
                $board .= '<div class="cell grey"><span class="coordinates">' . $coordinates . '</span></div>';
               }
           }
       }
   
       $board .= '</div>';
       return $board;
   }

   $centerX = 5;
   $centerY = 5;
   $width = 7;
   $height = 7;
   $minX = -15;
   $maxX = 15;
   $minY = -15;
   $maxY = 15;

   echo '<div class="board-container">';
   echo drawBoard($centerX, $centerY, $width, $height, $minX, $maxX, $minY, $maxY);
   
   // Affichage des coordonnées y à droite du damier
   echo '<div class="coord-y" style="display: flex; flex-direction: column; justify-content: space-between; height: ' . $height * 50 . 'px; margin-left: 4px;">';
   for ($y = $centerY + (int)($height / 2); $y >= $centerY - (int)($height / 2); $y--) {
       echo '<div style="height: 50px; text-align: center;">' . $y . '</div>';
   }
   echo '</div>';
   echo '</div>';
   
   // Affichage des coordonnées x en bas du damier
   echo '<div class="coord-x" style="display: flex; justify-content: space-between; width: ' . $width * 64 . 'px;">';
   for ($x = $centerX - (int)($width / 2); $x <= $centerX + (int)($width / 2); $x++) {
       echo '<div style="width: 64px; text-align: center;">' . $x . '</div>';
   }
   echo '</div>';
   
   ?>
</body>
</html>