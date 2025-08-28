document.addEventListener("DOMContentLoaded", () => {
  const hamburgerMenu = document.querySelector(".hamburger-menu");
  const sideMenu = document.getElementById("side-menu");
  const menuLinksSide = document.querySelectorAll('#side-menu a[href^="#"]');
  const menuLinksNav = document.querySelectorAll('.nav-menu a[href^="#"]');

  AOS.init({
    duration: 1000,
    once: true,
  });

  window.addEventListener("resize", () => {
    if (swiper) {
      swiper.update();
    }
    if (reviewsSwiper) {
      reviewsSwiper.update();
    }
  });

  const closeMenu = () => {
    if (sideMenu) {
      sideMenu.classList.remove("active");
    }
  };

  const smoothScroll = (link, headerHeight) => {
    link.addEventListener("click", (event) => {
      event.preventDefault();
      const targetId = link.getAttribute("href").substring(1);
      const targetElement = document.getElementById(targetId);

      if (targetElement) {
        const targetPosition = targetElement.offsetTop - headerHeight;

        window.scrollTo({
          top: targetPosition,
          behavior: "smooth",
        });

        if (sideMenu?.contains(link)) {
          closeMenu();
        }
      }
    });
  };

  hamburgerMenu?.addEventListener("click", () => {
    if (sideMenu.classList.contains("active")) {
      sideMenu.classList.remove("active");
    } else {
      sideMenu.classList.add("active");
    }
  });

  menuLinksSide.forEach((link) => smoothScroll(link, 72));
  menuLinksNav.forEach((link) => smoothScroll(link, 108));
});
