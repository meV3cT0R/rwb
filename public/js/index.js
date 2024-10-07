document.body.onload = function () {
    const headerButtons = document.querySelectorAll(".header .buttons div button");
    const toggleButton = document.querySelector("#toggleSidebarNormal")
    const header = document.querySelector(".header");

    for (const button of headerButtons) {
        button.style.transition = ".3s";
    }

    let open = true;

    header.style.transition = ".5s";
    toggleButton.addEventListener("click", function () {
        if (open) {
            header.style.transform = "translateX(-100%)";
        } else {
            header.style.transform = "translateX(0%)";
        }
        open = !open;
    })
    const dropdown = document.getElementById("dropdownButton");
    dropdown.addEventListener("click", () => {
        const dropdownMenu = document.getElementById("dropdownMenu");
        dropdownMenu.style.display =
            dropdownMenu.style.display === "block" ? "none" : "block";
    });

}