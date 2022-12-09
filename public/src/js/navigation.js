const sidebar = document.querySelector("#sidebar");
const page = document.querySelector("#page");
const toggleSidebar = document.querySelector("#sidebarToggle");
const toggleSidebarNav = document.querySelector("#sidebarToggle-nav");
const iconToggle = document.querySelector("#icon-toggle");
const sidebarAssistance = document.querySelector("#sidebarAssistance");

toggleSidebar.addEventListener("click", () => {
    page.classList.toggle('hide');
    sidebar.classList.toggle('hide');
    iconToggle.classList.toggle('fa-outdent');
});

toggleSidebarNav.addEventListener("click", () => {
    page.classList.toggle('hide');
    sidebar.classList.toggle('hide');
    iconToggle.classList.toggle('fa-outdent');
});
sidebarAssistance.addEventListener("click", () => {
    page.classList.toggle('hide');
    sidebar.classList.toggle('hide');
});