const active = "active";
const lsKey = "sidebar";
const body = document.querySelector("body");
const toggleSidebar = document.querySelector("#sidebarToggle");
if (localStorage.getItem(lsKey) === "true") {
    body.classList.add(active);
    toggleSidebar.classList.add(active);
}
toggleSidebar.addEventListener("click", () => {
    body.classList.toggle(active);
    toggleSidebar.classList.toggle(active);
    localStorage.setItem(lsKey, body.classList.contains(active));
});

const collapse = document.querySelector("#collapseList");
const navCollapse = document.querySelector("#collapse-link");

if (localStorage.getItem('collapsedList') === "true") {
    navCollapse.classList.add('show');
    collapse.classList.add('show');
}
navCollapse.addEventListener("click", () => {
    navCollapse.classList.toggle('show');
    localStorage.setItem('collapsedList', navCollapse.classList.contains('show'));
});

const avatars = document.querySelectorAll(".avatar");
avatars.forEach(a => {
    const charCodeRed = a.dataset.label.charCodeAt(0);
    const charCodeGreen = a.dataset.label.charCodeAt(1) || charCodeRed;

    const red = Math.pow(charCodeRed, 7) % 200;
    const green = Math.pow(charCodeGreen, 7) % 200;
    const blue = (red + green) % 200;

    a.style.background = `rgb(${red}, ${green}, ${blue})`;
});