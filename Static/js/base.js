var fadeButtons = document.getElementsByClassName("fade_button");
for (var button = 0; button < fadeButtons.length; button++) {
    fadeButtons[button].addEventListener("mouseover", function() {
        this.style.opacity = "1";
        document.body.style.cursor= "pointer";
    })

    fadeButtons[button].addEventListener("mouseout", function() {
        this.style.opacity = "0.5";
        document.body.style.cursor= "auto";
    })
}

var pointyThing = document.getElementsByClassName("pointy_thing");
for (var button = 0; button < pointyThing.length; button++) {
    pointyThing[button].addEventListener("mouseover", function() {
        document.body.style.cursor= "pointer";
    })

    pointyThing[button].addEventListener("mouseout", function() {
        document.body.style.cursor= "auto";
    })

}

document.getElementById("welcome").addEventListener("click", function() {
    window.location.href = "/";
})

document.getElementById("articles").addEventListener("click", function() {
    window.location.href = "/home";
})

document.getElementById("contact").addEventListener("click", function() {
    window.location.href = "/home";
})
