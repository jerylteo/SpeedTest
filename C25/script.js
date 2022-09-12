$(()=> {
    $("body").mousemove((e) => {
        $('.shape').css("top", `${e.pageY - 50}px`)
        $('.shape').css("left", `${e.pageX - 50}px`)
    });
});