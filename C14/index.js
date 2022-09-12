let keysNorm = "` 0 1 2 3 4 5 6 7 8 9 a b c d e f g h i j k l m n o p q r s t u v w x y z [ ] ; \' &leftarrow; TAB CAPS SHIFT , . / SPACEBAR";
let keysCap = "~ ) ! @ # $ % ^ & * ) A B C D E F G H I J K L M N O P Q R S T U V W X Y Z { } : \" &leftarrow; TAB CAPS SHIFT < > ? SPACEBAR";
let keyCodes = [];

let rows = [
    "` 1 2 3 4 5 6 7 8 9 0 &leftarrow;",
    "TAB q w e r t y u i o p [ ]",
    "CAPS a s d f g h j k l ; \'",
    "SHIFT z x c v b n m , . /",
    "SPACEBAR"
]

let isShift = false;
let isCap = false;

$(document).ready(() => {
    $("textarea").val("");
    keyCodes.push(192); // `

    for (let key = 48; key <= 57; key++) {
        keyCodes.push(key);
    }
    for (let key = 65; key <= 90; key++) {
        keyCodes.push(key);
    }
    keyCodes.push(219); // [
    keyCodes.push(221); // ]
    keyCodes.push(59);  // ;
    keyCodes.push(222);  // '
    keyCodes.push(8);   //backspace
    keyCodes.push(9);   //tab
    keyCodes.push(20);  //caps
    keyCodes.push(16);  //shift
    keyCodes.push(188); //comma
    keyCodes.push(190); // full stop
    keyCodes.push(191); // /
    keyCodes.push(32);  //spacebar


    keysNorm = keysNorm.split(" ");
    keysCap = keysCap.split(" ");

    let r = 1;
    rows.forEach(row => {
        row = row.split(" ");
        row.forEach(key => {
            let code = keyCodes[keysNorm.indexOf(key)];
            $(".keyrow" + r).append(`<div class='key' id='${code}'>${key}</div>`);
        })
        r++;
    })

    $("textarea").keydown((e) => {
        let code = e.originalEvent.keyCode;
        
        //tab key not working well for keydown. don't know why it remains "down"

        //haven't consider if cap & shift active at the same time. some boolean thing toggling needs to think carefully.

        if (code == 16) {   //shift
            isShift = !isShift;
            if (isShift) {
                handleShift();
            } else {
                handleUnshift();
            }
        }
        //if the current key is not the shift key and the previous key was shift key, then change back to non-cap keys
        if (isShift && code != 16) {
            handleUnshift();
            isShift = false;
        }

        if(code==20) {  //caps
            isCap = !isCap;
            if (isCap) {
                handleCap();
            } else {
                handleUncap();
            }
        }
        highlightKey(code);
    })

    $("textarea").keyup((e) => {
        let code = e.originalEvent.keyCode;
        checkKeyMouseUp(code);
    })

    $(".key").mousedown((e) => {

        //haven't consider if cap & shift active at the same time. some boolean thing toggling needs to think carefully.
        
        let code = $(e.target).attr("id");
        let currentText = $("textarea").val();

        if (code == 8) {   //backspace
            currentText = currentText.substring(0, currentText.length - 2);
        } else if (code == 9) {    //tab
            currentText += "\t";
        } else if (code == 16) {   //shift
            isShift = !isShift;
            if (isShift) {
                handleShift();
            } else {
                handleUnshift();
            }
        } else if (code == 20) {   //caps
            // slightly different handling because caps only change the alphabets
            isCap = !isCap;
            if (isCap) {
                handleCap();
            } else {
                handleUncap();
            }
        } else if (code == 32) {   //spacebar
            currentText += " ";
        } else {
            currentText += $(e.target).text();
        }
        $("textarea").val(currentText);
        //if the current key is not the shift key and the previous key was shift key, then change back to non-cap keys
        if (isShift && code != 16) {
            handleUnshift();
            isShift = false;
        }
        highlightKey(code);
    })

    $(".key").mouseup((e) => {
        let code = $(e.target).attr("id");
        checkKeyMouseUp(code);
    })
})

function checkKeyMouseUp(code) {
    //if not cap & not shift, then just unhighlight
    if (code!=20 && code!=16) {
        unhighlightKey(code);
    } else if(code==20 && !isCap) { //if i press the cap key one more time, then unhighlight the cap key
        unhighlightKey(code);
    }

    //if already come out from shift mode, then unhighlight the shift key
    if(!isShift) {
        unhighlightKey(16);
    }
}
function handleShift() {
    let elements = $(".key");
    for (let i = 0; i < elements.length; i++) {
        $(elements[i]).text(keysCap[keysNorm.indexOf($(elements[i]).text())]);
    }
}

function handleUnshift() {
    let elements = $(".key");
    for (let i = 0; i < elements.length; i++) {
        $(elements[i]).text(keysNorm[keysCap.indexOf($(elements[i]).text())]);
    }
}

function handleCap() {
    for (let key = 65; key <= 90; key++) {
        $("#"+key).text($("#"+key).text().toUpperCase());
    }
}

function handleUncap() {
    for (let key = 65; key <= 90; key++) {
        $("#"+key).text($("#"+key).text().toLowerCase());
    }
}

function highlightKey(code) {
    $("#" + code).css("background-color", "rgba(0,0,0,0.5)");
}

function unhighlightKey(code) {
    $("#" + code).css("background-color", "black");
}