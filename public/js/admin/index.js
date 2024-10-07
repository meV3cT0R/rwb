document.body.onload = function () {
  const toggleSidebar = document.querySelector("#toggleSidebar");
  const sidebar = document.querySelector("#sidebar");
  const body = document.querySelector("#body");
  const links = document.querySelectorAll("#sidebar ul li a");
  const logoutButton = document.querySelector(".logoutDiv button");

  for (const link of links) {
    link.style.transition = ".3s";
  }
  let open = true;
  if (open) {
    body.classList.add("open");
  }

  sidebar.style.transition = ".5s";
  body.style.transition = ".5s";
  logoutButton.style.transition = ".5s";

  toggleSidebar.addEventListener("click", function () {
    if (open) {
      sidebar.style.transform = "translateX(-100%)";
      body.classList.add("close");
      body.classList.remove("open");
    } else {
      sidebar.style.transform = "translateX(0%)";
      body.classList.add("open");
      body.classList.remove("close");
    }
    open = !open;
  });
};

//   admin header
const dropdown = document.getElementById("dropdownButton");
dropdown.addEventListener("click", () => {
  const dropdownMenu = document.getElementById("dropdownMenu");
  dropdownMenu.style.display =
    dropdownMenu.style.display === "block" ? "none" : "block";
});
