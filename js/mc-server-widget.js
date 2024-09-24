function toggleVisibility(className, cssDisplay) {
    let elements = document.getElementsByClassName(className);

    for (let i = 0; i < elements.length; i++) {
        let element = elements[i];
        element.style.display = cssDisplay;
    }
}

function copyServerAddress(clickedElement) {
    let copyText = document.getElementById("server-address-input");
    navigator.clipboard.writeText(copyText.textContent);

    toggleVisibility("tooltip-clicked", "block");
    toggleVisibility("tooltip-unclicked", "none");

    // Schedule going back
    setTimeout(function() {
        toggleVisibility("tooltip-clicked", "none");
        toggleVisibility("tooltip-unclicked", "block");
    }.bind(this), 1000);
}

document.addEventListener('mousemove', tooltipPosition);

let tooltips = document.getElementsByClassName("tooltip");

function tooltipPosition(e) {
    for (let i = 0; i < tooltips.length; i++) {
        let element = tooltips[i];

        let parentLeft = element.parentElement.getBoundingClientRect().left;
        let parentTop = element.parentElement.getBoundingClientRect().top;

        element.style.left = e.pageX - parentLeft + 'px';
        element.style.top = e.pageY - parentTop + 'px';
    }
}