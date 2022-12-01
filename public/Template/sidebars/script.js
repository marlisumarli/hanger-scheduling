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
const header = document.querySelector("#header");
const sidebarAssistance = document.querySelector("#sidebarAssistance");

// media query header event listener
const mediaQuery = window.matchMedia("(max-width: 768px)");
mediaQuery.addListener(handleMediaQueryChange);
const mediaQuery2 = window.matchMedia("(min-width: 768px)");
mediaQuery2.addListener(handleMediaQueryChange2);

function handleMediaQueryChange(e) {
    if (e.matches) {
        header.classList.remove("sticky-top");
    }
}

function handleMediaQueryChange2(e) {
    if (e.matches) {
        header.classList.add("sticky-top");
    }
}

toggleSidebar.addEventListener("click", () => {
    page.classList.toggle('hide');
    sidebar.classList.toggle('hide');
    iconToggle.classList.toggle('fa-arrow-left');
});

toggleSidebarNav.addEventListener("click", () => {
    header.classList.toggle('sticky-top');
    page.classList.toggle('hide');
    sidebar.classList.toggle('hide');
    iconToggle.classList.toggle('fa-arrow-left');
});
sidebarAssistance.addEventListener("click", () => {
    page.classList.toggle('hide');
    sidebar.classList.toggle('hide');
    header.classList.toggle('sticky-top');
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

