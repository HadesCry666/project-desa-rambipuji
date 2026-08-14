document
    .getElementById("toggle-description")
    ?.addEventListener("click", function (e) {
        e.preventDefault();
        var moreText = document.getElementById("more-text");
        var btn = document.getElementById("toggle-description");

        if (moreText.style.display === "none") {
            moreText.style.display = "inline";
            btn.textContent = "View Less";
        } else {
            moreText.style.display = "none";
            btn.textContent = "View More";
        }
    });

// When the DOM is fully loaded
document.addEventListener("DOMContentLoaded", function () {
    const desktopLinks = document.querySelectorAll(".desktop-nav ul li a:not(.nav-login)");

    // Smooth scroll and active class toggle on click
    desktopLinks.forEach((link) => {
        link.addEventListener("click", function (e) {
            const href = this.getAttribute("href");
            if (href && href.startsWith("#")) {
                e.preventDefault();
                desktopLinks.forEach((nav) => nav.classList.remove("active"));
                this.classList.add("active");

                const targetElement = document.querySelector(href);
                if (targetElement) {
                    const offset = 80;
                    const bodyRect = document.body.getBoundingClientRect().top;
                    const elementRect = targetElement.getBoundingClientRect().top;
                    const elementPosition = elementRect - bodyRect;
                    const offsetPosition = elementPosition - offset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: "smooth"
                    });
                }
            }
        });
    });

    // ScrollSpy to update active menu item on scroll
    window.addEventListener("scroll", function () {
        const scrollPosition = window.pageYOffset + 150;

        const heroSection = document.getElementById("hero-section");
        const serviceSection = document.getElementById("service-section") || document.getElementById("section-1-first");
        const footerSection = document.getElementById("footer-section");

        let currentId = "hero-section";

        if (footerSection && (window.innerHeight + window.scrollY >= document.body.offsetHeight - 120)) {
            currentId = "footer-section";
        } else if (serviceSection && scrollPosition >= serviceSection.offsetTop) {
            if (footerSection && scrollPosition >= footerSection.offsetTop - 250) {
                currentId = "footer-section";
            } else {
                currentId = "section-1-first";
            }
        } else {
            currentId = "hero-section";
        }

        desktopLinks.forEach((link) => {
            const href = link.getAttribute("href");
            if (href === "#" + currentId || (currentId === "section-1-first" && (href === "#section-1-first" || href === "#service-section"))) {
                link.classList.add("active");
            } else {
                link.classList.remove("active");
            }
        });
    });
});
