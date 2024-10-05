document.body.onload = function() {
    const headerButtons = document.querySelectorAll(".header .buttons div button");

    for(const button of headerButtons) {
        button.style.transition = ".3s";
    }
}