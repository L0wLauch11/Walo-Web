function toggleVisibility(className, cssDisplay) {
    let elements = document.getElementsByClassName(className);

    for (let i = 0; i < elements.length; i++) {
        let element = elements[i];
        element.style.display = cssDisplay;
    }
}

function copyServerAddress() {
    let copyText = document.getElementById("server-address-input");
    navigator.clipboard.writeText(copyText.textContent).then(r => function (r) {
        toggleVisibility("tooltip-clicked", "block");
        toggleVisibility("tooltip-unclicked", "none");

        // Schedule going back
        setTimeout(function() {
            toggleVisibility("tooltip-clicked", "none");
            toggleVisibility("tooltip-unclicked", "block");
        }.bind(this), 1000);
    });
}

document.addEventListener('mousemove', tooltipPosition);

let tooltips = document.getElementsByClassName("tooltip");

function tooltipPosition(e) {
    for (let i = 0; i < tooltips.length; i++) {
        let element = tooltips[i];

        let parentLeft = element.parentElement.getBoundingClientRect().left;
        let parentTop = element.parentElement.getBoundingClientRect().top;

        let padding = 32;

        let newX = Math.min(e.pageX, window.innerWidth - element.clientWidth - padding);
        let newY = Math.min(e.pageY, window.innerHeight - element.clientHeight - padding);

        newX -= parentLeft;
        newY -= parentTop;

        element.style.left = newX + 'px';
        element.style.top = newY + 'px';
    }
}