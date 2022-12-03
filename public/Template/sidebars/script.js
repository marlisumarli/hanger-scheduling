const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

const avatars = document.querySelectorAll(".avatar");
avatars.forEach(a => {
    const charCodeRed = a.dataset.label.charCodeAt(0);
    const charCodeGreen = a.dataset.label.charCodeAt(1) || charCodeRed;

    const red = Math.pow(charCodeRed, 7) % 200;
    const green = Math.pow(charCodeGreen, 7) % 200;
    const blue = (red + green) % 200;

    a.style.background = `rgb(${red}, ${green}, ${blue})`;
});

const sidebar = document.querySelector("#sidebar");
const page = document.querySelector("#page");
const toggleSidebar = document.querySelector("#sidebarToggle");
const toggleSidebarNav = document.querySelector("#sidebarToggle-nav");
const iconToggle = document.querySelector("#icon-toggle");
const sidebarAssistance = document.querySelector("#sidebarAssistance");

toggleSidebar.addEventListener("click", () => {
    page.classList.toggle('hide');
    sidebar.classList.toggle('hide');
    iconToggle.classList.toggle('fa-arrow-left');
});

toggleSidebarNav.addEventListener("click", () => {
    page.classList.toggle('hide');
    sidebar.classList.toggle('hide');
    iconToggle.classList.toggle('fa-arrow-left');
});
sidebarAssistance.addEventListener("click", () => {
    page.classList.toggle('hide');
    sidebar.classList.toggle('hide');
});

