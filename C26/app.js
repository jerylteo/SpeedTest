let circles = [];
$(document).ready(() => {
    let totalWidth = $(document).innerWidth();
    let totalHeight = $(document).innerHeight();


    for (let i = 1; i <= 5; i++) {
        let newDiameter = getRandom(300, 400);
        let newX = getRandom(0, totalWidth - newDiameter);
        let newY = getRandom(0, totalHeight - newDiameter);
        let newCircle = { left: newX, top: newY, radius: newDiameter/2 };

        let conflicted = false;
        for (let c in circles) {
            let x1 = circles[c].left;
            let y1 = circles[c].top;
            let r1 = circles[c].radius;
            if(hasConflict(x1,y1,r1,newCircle.left,newCircle.top,newCircle.radius)) 
            {
                i--;    //generate a new circle again!
                conflicted = true;
                break;
            }
        }
        if(!conflicted) {
            circles.push(newCircle);
        }
    }

    for (let i in circles) {
        let c = circles[i]
        let index = (parseInt(i) + 1);
        $(".c" + index).css("width", c.radius + "px");
        $(".c" + index).css("height", c.radius + "px");
        $(".c" + index).css("left", c.left + "px");
        $(".c" + index).css("top", c.top + "px");
    }
})

function hasConflict(x1, y1, r1, x2, y2, r2) {
    let dist = Math.sqrt(Math.pow(x2 - x1, 2) + Math.pow(y2 - y1, 2));
    return dist < (r1 + r2);
}

function getRandom(min, max) {
    return Math.floor(Math.random() * (max - min + 1) + min);
}