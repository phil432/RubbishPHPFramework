var fadeButtons = document.getElementsByClassName("fade_button");
for (var button = 0; button < fadeButtons.length; button++) {
    fadeButtons[button].addEventListener("mouseover", function() {
        this.style.opacity = "1";
        document.body.style.cursor= "pointer";
    })

    fadeButtons[button].addEventListener("mouseout", function() {
        this.style.opacity = "0.5";
    })
}
