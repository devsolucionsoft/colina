document.addEventListener("DOMContentLoaded", () => {
  const hamburgerMenu = document.querySelector(".hamburger-menu");
  const sideMenu = document.getElementById("side-menu");
  const menuLinksSide = document.querySelectorAll('#side-menu a[href^="#"]');
  const menuLinksNav = document.querySelectorAll('.nav-menu a[href^="#"]');

  AOS.init({
    duration: 1000,
    once: true,
  });

  let heroBannerSwiper = null;
  const heroBannerContainer = document.querySelector(".hero-swiper");

  if (heroBannerContainer) {
    const initHeroBannerSwiper = () => {
      const slidesCount = document.querySelectorAll(
        ".hero-swiper .swiper-slide"
      ).length;

      if (slidesCount > 0) {
        if (heroBannerSwiper) {
          heroBannerSwiper.destroy(true, true);
        }

        heroBannerSwiper = new Swiper(".hero-swiper", {
          slidesPerView: 1,
          spaceBetween: 0,
          loop: slidesCount > 1,
          autoplay:
            slidesCount > 1
              ? {
                  delay: 6000,
                  disableOnInteraction: false,
                  pauseOnMouseEnter: true,
                }
              : false,
          speed: 1500,
          effect: "slide",
          navigation: {
            nextEl: ".hero-next",
            prevEl: ".hero-prev",
          },
          on: {
            slideChangeTransitionStart: function () {
              const currentSlide = this.slides[this.previousIndex];
              const nextSlide = this.slides[this.activeIndex];

              // Aplicar animación de salida al slide actual
              if (currentSlide) {
                currentSlide.classList.add("slide-exit");
                currentSlide.classList.remove(
                  "slide-enter",
                  "slide-enter-active"
                );
              }

              // Preparar el slide entrante
              if (nextSlide) {
                nextSlide.classList.add("slide-enter");
                nextSlide.classList.remove("slide-exit", "slide-enter-active");
              }

              // Limpiar otros slides
              this.slides.forEach((slide, index) => {
                if (
                  index !== this.activeIndex &&
                  index !== this.previousIndex
                ) {
                  slide.classList.remove(
                    "slide-exit",
                    "slide-enter",
                    "slide-enter-active"
                  );
                }
              });
            },
            slideChange: function () {
              const activeSlide = this.slides[this.activeIndex];

              // Después de 400ms, comenzar la animación de entrada
              setTimeout(() => {
                if (activeSlide) {
                  activeSlide.classList.add("slide-enter-active");
                  activeSlide.classList.remove("slide-enter");
                }
              }, 400);
            },
            slideChangeTransitionEnd: function () {
              // Limpiar todas las clases después de la transición completa
              setTimeout(() => {
                this.slides.forEach((slide, index) => {
                  if (index !== this.activeIndex) {
                    slide.classList.remove(
                      "slide-exit",
                      "slide-enter",
                      "slide-enter-active"
                    );
                  }
                });
              }, 100);
            },
          },
        });
      }
    };

    initHeroBannerSwiper();
  }

  AOS.init({
    duration: 1000,
    once: true,
  });

  // Initialize Companies Swiper
  let companiesSwiper = null;
  const companiesSwiperContainer = document.querySelector(".companies-swiper");

  if (companiesSwiperContainer) {
    const initCompaniesSwiper = () => {
      const slidesCount = document.querySelectorAll(
        ".companies-swiper .swiper-slide"
      ).length;

      if (slidesCount > 1) {
        if (companiesSwiper) {
          companiesSwiper.destroy(true, true);
        }

        companiesSwiper = new Swiper(".companies-swiper", {
          slidesPerView: 1,
          spaceBetween: 20,
          loop: slidesCount > 5,
          autoplay: {
            delay: 4000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
          },
          navigation: {
            nextEl: ".companies-next",
            prevEl: ".companies-prev",
          },
          breakpoints: {
            480: {
              slidesPerView: 2,
              spaceBetween: 20,
            },
            640: {
              slidesPerView: 3,
              spaceBetween: 24,
            },
            768: {
              slidesPerView: 3,
              spaceBetween: 30,
            },
            1024: {
              slidesPerView: 4,
              spaceBetween: 30,
            },
            1200: {
              slidesPerView: Math.min(5, slidesCount),
              spaceBetween: 30,
            },
            1400: {
              slidesPerView: Math.min(6, slidesCount),
              spaceBetween: 30,
            },
          },
          on: {
            init: function () {
              const nextBtn = document.querySelector(".companies-next");
              const prevBtn = document.querySelector(".companies-prev");

              if (slidesCount <= this.params.slidesPerView) {
                if (nextBtn) nextBtn.style.display = "none";
                if (prevBtn) prevBtn.style.display = "none";
              }
            },
          },
        });
      }
    };

    initCompaniesSwiper();
  }

  window.addEventListener("resize", () => {
    if (swiper) {
      swiper.update();
    }
    if (reviewsSwiper) {
      reviewsSwiper.update();
    }
    if (companiesSwiper) {
      companiesSwiper.update();
    }
    if (heroBannerSwiper) {
      heroBannerSwiper.update();
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

  const principleCards = document.querySelectorAll(".principle-card");
  function isMobilePrinciples() {
    return window.innerWidth <= 768;
  }
  function closeAllPrincipleCards() {
    principleCards.forEach((card) => card.classList.remove("expanded"));
  }
  principleCards.forEach((card) => {
    card.addEventListener("click", function () {
      if (isMobilePrinciples()) {
        if (card.classList.contains("expanded")) {
          card.classList.remove("expanded");
        } else {
          closeAllPrincipleCards();
          card.classList.add("expanded");
        }
      }
    });
  });
  window.addEventListener("resize", function () {
    if (!isMobilePrinciples()) {
      closeAllPrincipleCards();
    }
  });
});
