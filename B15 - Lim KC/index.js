let interval, centiInterval;
let seconds = 0;
let centiseconds = 0;
$(document).ready(() => {
    $("#start").click(() => {
        start();
    })

    $("#stop").click(() => {
        clearInterval(interval);
        clearInterval(centiInterval);
    })

    $("#reset").click(() => {
        reset();
    })
})

function showSeconds() {
    seconds++;
    if (seconds == 1000) {
        clearInterval(interval);
    }
    else {
        let temp = seconds + "";
        if (temp.length == 1) {
            display(3, +temp.charAt(0));
        } else if (temp.length == 2) {
            display(2, +temp.charAt(0));
            display(3, +temp.charAt(1));
        } else {
            display(1, +temp.charAt(0))
            display(2, +temp.charAt(1));
            display(3, +temp.charAt(2));
        }
    }
}

function showCentiseconds() {
    centiseconds++;
    if(centiseconds>=99 && seconds>=999) {
        clearInterval(centiInterval);
    }
    let temp = centiseconds + "";
    
    if (temp.length == 1) {
        display(4,0);
        display(5, +temp.charAt(0));
    } else {
        display(4, +temp.charAt(0));
        display(5, +temp.charAt(1));
    }

    if(centiseconds == 99) {
        centiseconds = 0;      
    }
}

function start() {
    interval = setInterval(showSeconds, 1000);
    centiInterval = setInterval(showCentiseconds,10);
}

function reset() {
    seconds = 0;
    centiseconds = 0;
    clearInterval(interval);
    clearInterval(centiInterval);
    $(".bar").css("opacity", "1");
    $(".bar7").css("opacity", "0.1");
}

function display(digit, number) {
    $(".d" + digit + " .bar").css("opacity", "0.1");
    let bars = getBars(number);
    bars.forEach(barNum => {
        $(`.d${digit} .bar${barNum}`).css("opacity", "1");
    })
}

function getBars(number) {
    switch (number) {
        case 0:
            return [1, 2, 3, 4, 5, 6];
        case 1:
            return [2, 3];
        case 2:
            return [1, 2, 7, 5, 4];
        case 3:
            return [1, 2, 3, 4, 7];
        case 4:
            return [6, 7, 2, 3];
        case 5:
            return [1, 6, 7, 3, 4];
        case 6:
            return [1, 3, 4, 5, 6, 7];
        case 7:
            return [1, 2, 3];
        case 8:
            return [1, 2, 3, 4, 5, 6, 7, 8];
        case 9:
            return [1, 2, 3, 4, 6, 7];
    }
    return [];
}