<?php
session_start();
$month = array("January", "February", "March", "May","April", "June", "July", "August", "September", "October", "November", "December");
$days = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
$length = count($month);
$dayslength = count($days);
$m = date("m");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}


if (isset($id)) {
    if ($id == 1) {
        $currentNo = $_SESSION['time']+1;
        if ($currentNo == 13) {
            $currentNo = 1;
            $current = $month[$currentNo];
        }
    }else {
        $currentNo = $_SESSION['time']-1;
        if ($currentNo == 0) {
            $currentNo = 11;
            $current = $month[$currentNo];
        }
    }
}else {
    $currentNo = $m;
}

$firstDay = gregoriantojd($currentNo,1,2020);
$firstDay = jddayofweek($firstDay,1);
// echo $firstDay;

// for ($a = 0; $a<$dayslength; $a++) {
//     if ($firstDay == $days[$a]) {
//         echo $days[$a];
//         echo $a;
//     }
// }

// echo $month[$currentNo-1];
$d=cal_days_in_month(CAL_GREGORIAN,$currentNo,2020);
$l=cal_days_in_month(CAL_GREGORIAN,$currentNo,2020);
// echo $d;
// echo "There was $d days in January 2020";
// echo $currentNo;

$_SESSION['time'] = $currentNo;
// echo "Today is " . date("Y/m/d") . "<br>";
$t = date('d');
// echo $t;
$y = date('m');
// echo $y;
$M = date('M');
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="calendar.css">
</head>

<body>


    <div class="custom-calendar-wrap">
        <div class="custom-inner">
            <div class="custom-header clearfix">
                <nav>
                    <a href="index.php?id=-1" class="custom-btn custom-prev"></a>
                    <a href="index.php?id=1" class="custom-btn custom-next"></a>
                </nav>
                <h2 id="custom-month" class="custom-month"><?php if (!$_SESSION['time']) {
                    echo $M;
                }
                else {
                    echo $month[$currentNo-1];
                }; ?></h2>
                <h3 id="custom-year" class="custom-year">2019</h3>  
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
                    <?php for ($i = 1; $i <= $d; $i+=7) {
                        echo "<div class='fc-row'>";
                        for ($a = 0; $a<$dayslength; $a++) {
                            if ($firstDay == $days[$a]) {
                                for ($z = 0; $z < $a+1; $z++) {
                                    if ($z < 6 ){
                                        echo "<div><span class='fc-date'></span></div>";
                                    }else if ($z == 6 ) {
                                        echo "<div><span class='fc-date'></span></div>";
                                        echo "</div><div class = 'fc-row'>";
                                    }
                                      
                                }
                            }
                        }
                        for ($i = $i;$i < $d+1;$i++) {
                            if ($i == $t && $currentNo == $y) {
                                if ($i % 7 != 0 ) {
                                    echo "<div class='fc-today'><span class='fc-date'>$i</span></div></div><div class = 'fc-row'>";
                                }else {
                                    echo "<div class='fc-today'><span class='fc-date'>$i</span></div>";
                                }
                            }else {
                                echo "<div><span class='fc-date'>$i</span></div>";
                                $s = $i + $z;
                                if ($s % 7 == 0) {
                                    echo "</div><div class = 'fc-row'>";
                                }if ($s - $z == $l) {
                                    echo "<div><span class='fc-date'></span></div></div>";
                                }
                            }   
                        }
                    }
                    
                    ?>
                        <!-- <div class="fc-row">
                            <div><span class="fc-date"></span></div>
                            <div><span class="fc-date"></span></div>
                            <div><span class="fc-date"></span></div>
                            <div><span class="fc-date"></span></div>
                            <div><span class="fc-date"></span></div>
                            <div><span class="fc-date">1</span></div>
                            <div><span class="fc-date">2</span></div>
                        </div>
                        <div class="fc-row">
                            <div><span class="fc-date">3</span></div>
                            <div><span class="fc-date">4</span></div>
                            <div><span class="fc-date">5</span></div>
                            <div><span class="fc-date">6</span></div>
                            <div><span class="fc-date">7</span></div>
                            <div><span class="fc-date">8</span></div>
                            <div><span class="fc-date">9</span></div>
                        </div>
                        <div class="fc-row">
                            <div><span class="fc-date">10</span></div>
                            <div><span class="fc-date">11</span></div>
                            <div><span class="fc-date">12</span></div>
                            <div><span class="fc-date">13</span></div>
                            <div><span class="fc-date">14</span></div>
                            <div><span class="fc-date">15</span></div>
                            <div><span class="fc-date">16</span></div>
                        </div>
                        <div class="fc-row">
                            <div><span class="fc-date">17</span></div>
                            <div><span class="fc-date">18</span></div>
                            <div><span class="fc-date">19</span></div>
                            <div><span class="fc-date">20</span></div>
                            <div><span class="fc-date">21</span></div>
                            <div><span class="fc-date">22</span></div>
                            <div><span class="fc-date">23</span></div>
                        </div>
                        <div class="fc-row">
                            <div><span class="fc-date">24</span></div>
                            <div class="fc-today"><span class="fc-date">25</span></div>
                            <div><span class="fc-date">26</span></div>
                            <div><span class="fc-date">27</span></div>
                            <div><span class="fc-date">28</span></div>
                            <div><span class="fc-date"></span></div>
                            <div><span class="fc-date"></span></div>
                        </div>
                        -->
                    </div>
                </div>
            </div>
        </div>

<script>
    window.addEventListener("keydown",function(e) {
        console.log(e);
    });
    
<script>
</body>

</html>