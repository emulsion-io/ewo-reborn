<!DOCTYPE html>
<html>
<head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

<style>
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
    .pink {
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

    $startX = $centerX - (int)($width / 2);
    $endX = $centerX + (int)($width / 2);
    $startY = $centerY - (int)($height / 2);
    $endY = $centerY + (int)($height / 2);
    
    $zindex = 0;
    for ($y = $startY; $y <= $endY; $y++) {
        for ($x = $startX; $x <= $endX; $x++) {
            $dx = $x - $centerX;
            $dy = $y - $centerY;
    
            $isoX = ($dy - $dx) * 32;
            $isoY = ($dx + $dy) * 20;

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
            } elseif ($x >= $minX && $x <= $maxX && $y >= $minY && $y <= $maxY) {
                if (abs($dx) <= 1 && abs($dy) <= 1) {
                    $board .= '<div class="cell yellow" style="left:' . $isoX . 'px; top:' . $isoY . 'px;z-index: '. $zindex .'"><div class="cardinal">' . $cardinal . '</div></div>';
                } elseif ($dx < $minX - $centerX || $dx > $maxX - $centerX || $dy < $minY - $centerY || $dy > $maxY - $centerY) {
                    $board .= '<div class="cell pink" style="left:' . $isoX . 'px; top:' . $isoY . 'px;z-index: '. $zindex .'"><div class="cardinal">' . $cardinal . '</div></div>';
                } else {
                    $board .= '<div class="cell green" style="left:' . $isoX . 'px; top:' . $isoY . 'px;z-index: '. $zindex .'"><div class="cardinal">x' . $x . '/y' . $y . '</div></div>';
                }
            } else {
                $board .= '<div class="cell grey" style="left:' . $isoX . 'px; top:' . $isoY . 'px;"></div>';
            }
        }
        $zindex++;
    }

    $board .= '</div>';
    return $board;
}

$centerX = 9;
$centerY = 8;
$width = 11;
$height = 11;
$minX = 0;
$maxX = 10;
$minY = 0;
$maxY = 10;
?>

<div class="container-fluid text-center">
  <div class="row">
    <div class="col-2">
      Menu de gauche
    </div>
    <div class="col-10">
        <?php 
            echo '<div class="board-container">';
            echo drawBoard($centerX, $centerY, $width, $height, $minX, $maxX, $minY, $maxY);
            echo '</div>';
        ?>
    </div>
  </div>
</div>

</body>
</html>



