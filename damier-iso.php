<!DOCTYPE html>
<html>
<head>
<style>
    body, html {
        height: 100%;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .board-container {
        position: relative;
        width: calc(11 * 64px);
        height: calc(11 * 40px);
    }
    .board {
        position: absolute;
        left: 20px;
        top: 20px;
        width: calc(11 * 64px);
        height: calc(11 * 40px + 20px);
        
    }
    .cell {
        position: absolute;
        width: 64px;
        height: 40px;
        background-repeat: no-repeat;
        transform:translateX(-5px);
    }
    .green {
        background-image: url('static/damier/sable-1.png');
    }
    .red {
        background-image: url('static/damier/sable-1.png');
    }
    .yellow {
        background-image: url('static/damier/sable-1.png');
    }
    .grey {
        background-image: url('static/damier/eau-1.png');
    }
    .cardinal {
        font-size: 10px;
        text-align: center;
        margin-top: 10px;
    }
</style>
</head>
<body>
<?php

function drawBoard($centerX, $centerY, $width, $height, $minX, $maxX, $minY, $maxY) {
        $board = '<div class="board">';
    
        $startY = $centerY - (int)($height / 2);
        $endY = $centerY + (int)($height / 2);
        $startX = $centerX - (int)($width / 2);
        $endX = $centerX + (int)($width / 2);
    
        $zindex = 9999999;
        for ($y = $startY; $y <= $endY; $y++) {
            for ($x = $startX; $x <= $endX; $x++) {
                $dx = $x - $centerX;
                $dy = -$y + $centerY;
    
                $isoX = ($x + $y) * 32;
                $isoY = ($x - $y) * 20;

            $cardinal = "";
            if ($dx == -1 && $dy == 0) {
                $cardinal = "W";
            } elseif ($dx == 1 && $dy == 0) {
                $cardinal = "E";
            } elseif ($dx == 0 && $dy == 1) {
                $cardinal = "S";
            } elseif ($dx == 0 && $dy == -1) {
                $cardinal = "N";
            } elseif ($dx == -1 && $dy == 1) {
                $cardinal = "NW";
            } elseif ($dx == 1 && $dy == 1) {
                $cardinal = "NE";
            } elseif ($dx == -1 && $dy == -1) {
                $cardinal = "SW";
            } elseif ($dx == 1 && $dy == -1) {
                $cardinal = "SE";
            }

            if ($x == $centerX && $y == $centerY) {
                $board .= '<div class="cell red" style="left:' . $isoX . 'px; top:' . $isoY . 'px;z-index: '. $zindex .'">Perso</div>';
            } elseif (abs($dx) <= 1 && abs($dy) <= 1) {
                $board .= '<div class="cell yellow" style="left:' . $isoX . 'px; top:' . $isoY . 'px;z-index: '. $zindex .'"><div class="cardinal">' . $cardinal . '</div></div>';
            } elseif ($x >= $minX && $x <= $maxX && $y >= $minY && $y <= $maxY) {
                $board .= '<div class="cell green" style="left:' . $isoX . 'px; top:' . $isoY . 'px;z-index: '. $zindex .'"><div class="cardinal">x' . $x . '/y' . $y . '</div></div>';
            } else {
                $board .= '<div class="cell grey" style="left:' . $isoX . 'px; top:' . $isoY . 'px;"></div>';
            }

        }
        $zindex--;
    }


    $board .= '</div>';
    return $board;
}

$centerX = 4;
$centerY = 0;
$width = 11;
$height = 11;
$minX = -5;
$maxX = 5;
$minY = -5;
$maxY = 5;


echo '<div class="board-container">';
echo drawBoard($centerX, $centerY, $width, $height, $minX, $maxX, $minY, $maxY);
echo '</div>';
?>
</body>
</html>



