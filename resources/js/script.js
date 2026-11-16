
// ========== CURRENT YEAR ==========

const footer = document.querySelector(".footer p");

if (footer) {
    footer.textContent = `© ${new Date().getFullYear()} Your Name. All Rights Reserved.`;
}


// ========== NAVIGATION ACTIVE LINK ==========

const navLinks = document.querySelectorAll(".nav-menu a");

navLinks.forEach((link) => {

    link.addEventListener("click", function () {

        navLinks.forEach((item) => {
            item.classList.remove("active");
        });

        this.classList.add("active");

    });

});


// ========== CONTACT FORM DEMO ==========

const contactForm = document.querySelector(".contact-form");

if (contactForm) {

    contactForm.addEventListener("submit", function (event) {

        event.preventDefault();

        alert("Thank you! Your message form is ready for backend integration.");

        contactForm.reset();

    });

}
