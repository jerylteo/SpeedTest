
function draggable(el) {
    // TODO

    // REFERENCE: https: //gist.github.com/remarkablemark/5002d27442600510d454a5aeba370579
    let mouseX;
    let mouseY;

    let elementX = 0;
    let elementY = 0;

    let isMouseDown = false;

    el.addEventListener("mousedown", (e) => {
        e.preventDefault();

        //get position of element
        mouseX = e.clientX;
        mouseY = e.clientY;
        isMouseDown = true;
    });

    el.addEventListener("mouseup", (e) => {
        e.preventDefault();

        isMouseDown = false;
        elementX = parseInt(el.style.left) || 0;
        elementY = parseInt(el.style.top) || 0;
    });

    document.addEventListener("mousemove", (e) => {
        e.preventDefault();

        if (!isMouseDown) {
            return;
        }

        let deltaX = e.clientX - mouseX;
        let deltaY = e.clientY - mouseY;

        el.style.left = elementX + deltaX + 'px';
        el.style.top = elementY + deltaY + 'px';
    })
}



draggable(document.getElementById('draggable'));