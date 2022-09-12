<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="calendar.css">
</head>

<body>
<?php 

$current_y = isset($_GET['y']) ? $_GET['y'] : date('Y');
$current_m = isset($_GET['m']) ? $_GET['m'] : date('n');
$current_ym = $current_y . '-' . $current_m;

$today_ym = date('Y-n');
$today_d = date('d');
$is_today_ym = $current_ym == $today_ym;

$first_day = mktime(0, 0, 0, $current_m, 1, $current_y);
$first_dow = date('w', $first_day);
$last_day = date('t', $first_day);

$prev_m = date('n', strtotime('-1 month', $first_day));
$prev_y = date('Y', strtotime('-1 month', $first_day));
$next_m = date('n', strtotime('+1 month', $first_day));
$next_y = date('Y', strtotime('+1 month', $first_day));

$prev_string = "?y=$prev_y&m=$prev_m";
$next_string = "?y=$next_y&m=$next_m";

$num_rows = ceil(($last_day + $first_dow)/7);
$day = 1;

?>

    <div class="custom-calendar-wrap">
        <div class="custom-inner">
            <div class="custom-header clearfix">
                <nav>
                    <a href="<?php echo $prev_string; ?>" class="custom-btn custom-prev"></a>
                    <a href="<?php echo $next_string; ?>" class="custom-btn custom-next"></a>
                </nav>
                <h2 id="custom-month" class="custom-month"><?php echo date('F', $first_day) ?></h2>
                <h3 id="custom-year" class="custom-year"><?php echo $current_y; ?></h3>
            </div>
            <div id="calendar" class="fc-calendar-container">
                <div class="fc-calendar fc-five-rows">
                    <div class="fc-head">
                        <div>Sun</div>
                        <div>Mon</div>
                        <div>Tue</div>
                        <div>Wed</div>
                        <div>Thu</div>
                        <div>Fri</div>
                        <div>Sat</div>
                    </div>
                    <div class="fc-body">
                        <?php for($row = 0; $row < $num_rows; $row++): ?>
                        <div class="fc-row">
                            
                            <?php 
                            for($col = 0; $col < 7; $col++): 
                                if(($row == 0 && $col < $first_dow)
                                || $day > $last_day)
                                    echo '<div><span class="fc-date"></span></div>';
                                else {
                                    $class = ($is_today_ym && $day == $today_d) 
                                        ? "class='fc-today'" : '';

                                    echo "<div $class><span class='fc-date'>$day</span></div>";

                                    $day++;
                                }
                            endfor;?>
                        </div>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
        </div>


</body>

</html>