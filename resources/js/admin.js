
const sidebar = document.getElementById("sidebar");

const menuToggle = document.getElementById("menuToggle");

const closeSidebar = document.getElementById("closeSidebar");


// Open sidebar on mobile
menuToggle.addEventListener("click", function () {
    sidebar.classList.add("show");
});


// Close sidebar
closeSidebar.addEventListener("click", function () {
    sidebar.classList.remove("show");
});


// Active sidebar menu
const menuLinks = document.querySelectorAll(".menu-link");

menuLinks.forEach(function (link) {

    link.addEventListener("click", function () {

        menuLinks.forEach(function (item) {
            item.classList.remove("active");
        });

        this.classList.add("active");

        // Close sidebar on mobile
        sidebar.classList.remove("show");

    });

});


// Close sidebar when clicking outside
document.addEventListener("click", function (event) {

    if (
        window.innerWidth <= 850 &&
        !sidebar.contains(event.target) &&
        !menuToggle.contains(event.target)
    ) {
        sidebar.classList.remove("show");
    }

});
