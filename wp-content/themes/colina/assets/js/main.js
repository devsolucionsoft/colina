function setupNewsCardOverlay() {
  const isTouch = window.matchMedia(
    "(hover: none) and (pointer: coarse)"
  ).matches;
  const newsCards = document.querySelectorAll(".news-card");
  if (!newsCards.length) return;

  newsCards.forEach((card) => {
    if (!isTouch) return;
    card.addEventListener("click", function (e) {
      if (card.classList.contains("show-overlay")) {
        const btn = e.target.closest(".news-overlay-btn");
        if (btn) return;
        card.classList.remove("show-overlay");
        e.preventDefault();
        return;
      }
      document
        .querySelectorAll(".news-card.show-overlay")
        .forEach((c) => c.classList.remove("show-overlay"));
      card.classList.add("show-overlay");
      e.preventDefault();
    });
  });
  document.addEventListener("touchstart", function (e) {
    const open = document.querySelector(".news-card.show-overlay");
    if (open && !e.target.closest(".news-card")) {
      open.classList.remove("show-overlay");
    }
  });
  window.addEventListener("scroll", function () {
    document
      .querySelectorAll(".news-card.show-overlay")
      .forEach((c) => c.classList.remove("show-overlay"));
  });
}

setupNewsCardOverlay();

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

              if (currentSlide) {
                currentSlide.classList.add("slide-exit");
                currentSlide.classList.remove(
                  "slide-enter",
                  "slide-enter-active"
                );
              }

              if (nextSlide) {
                nextSlide.classList.add("slide-enter");
                nextSlide.classList.remove("slide-exit", "slide-enter-active");
              }

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

              setTimeout(() => {
                if (activeSlide) {
                  activeSlide.classList.add("slide-enter-active");
                  activeSlide.classList.remove("slide-enter");
                }
              }, 400);
            },
            slideChangeTransitionEnd: function () {
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

  let documentsSwiper = null;
  const documentsSwiperContainer = document.querySelector(".documents-swiper");

  function updateVisibleCards(swiper) {
    const currentSlidesPerView = swiper.params.slidesPerView;
    swiper.slides.forEach((slide) => {
      const card = slide.querySelector(".document-card");
      if (card) {
        card.classList.remove("first-visible", "last-visible");
      }
    });
    for (
      let i = 0;
      i < currentSlidesPerView && i + swiper.activeIndex < swiper.slides.length;
      i++
    ) {
      const slide = swiper.slides[swiper.activeIndex + i];
      const card = slide.querySelector(".document-card");
      if (card) {
        if (i === 0) card.classList.add("first-visible");
        if (
          i === currentSlidesPerView - 1 ||
          swiper.activeIndex + i === swiper.slides.length - 1
        ) {
          card.classList.add("last-visible");
        }
      }
    }
  }

  if (documentsSwiperContainer) {
    const initDocumentsSwiper = () => {
      const slidesCount = document.querySelectorAll(
        ".documents-swiper .swiper-slide"
      ).length;

      if (slidesCount > 1) {
        if (documentsSwiper) {
          documentsSwiper.destroy(true, true);
        }

        documentsSwiper = new Swiper(".documents-swiper", {
          slidesPerView: 1,
          spaceBetween: 0,
          loop: false, // Desactivar loop para mejor control
          autoplay: {
            delay: 5000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
          },
          navigation: {
            nextEl: ".documents-next",
            prevEl: ".documents-prev",
          },
          breakpoints: {
            640: {
              slidesPerView: 2,
              spaceBetween: 0,
            },
            1024: {
              slidesPerView: 3,
              spaceBetween: 0,
            },
            1400: {
              slidesPerView: 3,
              spaceBetween: 0,
            },
          },
          on: {
            init: function () {
              const nextBtn = document.querySelector(".documents-next");
              const prevBtn = document.querySelector(".documents-prev");
              if (slidesCount <= 3) {
                if (nextBtn) nextBtn.style.display = "none";
                if (prevBtn) prevBtn.style.display = "none";
              } else {
                if (nextBtn) nextBtn.style.display = "flex";
                if (prevBtn) prevBtn.style.display = "flex";
              }
              updateVisibleCards(this);
            },
            slideChange: function () {
              updateVisibleCards(this);
            },
          },
        });
      } else if (slidesCount === 1) {
        const nextBtn = document.querySelector(".documents-next");
        const prevBtn = document.querySelector(".documents-prev");

        if (nextBtn) nextBtn.style.display = "none";
        if (prevBtn) prevBtn.style.display = "none";
      }
    };

    initDocumentsSwiper();
  }

  const newsSwiperContainer = document.querySelector(".news-swiper");
  if (newsSwiperContainer) {
    new Swiper(".news-swiper", {
      slidesPerView: 1,
      spaceBetween: 24,
      navigation: {
        nextEl: ".news-next",
        prevEl: ".news-prev",
      },
      breakpoints: {
        1024: {
          slidesPerView: 2,
          spaceBetween: 32,
        },
      },
    });
  }

  window.addEventListener("resize", () => {
    if (reviewsSwiper) {
      reviewsSwiper.update();
    }
    if (companiesSwiper) {
      companiesSwiper.update();
    }
    if (documentsSwiper) {
      documentsSwiper.update();
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

  initContactForm();

  function initContactForm() {
    const contactForm = document.getElementById("contact-form");
    if (!contactForm) return;

    const submitBtn = contactForm.querySelector(".submit-btn");
    const formMessages = document.getElementById("form-messages");
    const successMessage = document.getElementById("success-message");
    const errorMessage = document.getElementById("error-message");

    const validationPatterns = {
      name: /^[a-zA-ZÀ-ÿ\s]{2,50}$/,
      email: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
      message: /^.{10,500}$/,
    };

    const errorMessages = {
      name: "El nombre debe tener entre 2 y 50 caracteres y solo contener letras",
      email: "Por favor, ingresa un email válido",
      subject: "Por favor, selecciona un tema",
      message: "El mensaje debe tener entre 10 y 500 caracteres",
    };

    initFormEnhancements();
    initFormValidation();
    initFormSubmission();

    function initFormEnhancements() {
      const inputs = contactForm.querySelectorAll("input, textarea");
      inputs.forEach((input) => {
        input.addEventListener("focus", handleInputFocus);
        input.addEventListener("blur", handleInputBlur);
        input.addEventListener("input", handleInputChange);

        if (input.value.trim() !== "") {
          input.classList.add("has-value");
        }
      });

      const select = contactForm.querySelector("select");
      if (select) {
        select.addEventListener("change", handleSelectChange);
        select.addEventListener("focus", handleSelectFocus);
        select.addEventListener("blur", handleSelectBlur);
      }
    }

    function handleInputFocus(event) {
      const container = event.target.closest(
        ".input-container, .textarea-container"
      );
      if (container) {
        container.classList.add("focused");
      }
    }

    function handleInputBlur(event) {
      const container = event.target.closest(
        ".input-container, .textarea-container"
      );
      if (container) {
        container.classList.remove("focused");
      }

      validateField(event.target);
    }

    function handleInputChange(event) {
      const input = event.target;

      if (input.value.trim() !== "") {
        input.classList.add("has-value");
      } else {
        input.classList.remove("has-value");
      }

      clearFieldError(input);
    }

    function handleSelectFocus(event) {
      const container = event.target.closest(".select-container");
      if (container) {
        container.classList.add("focused");
      }
    }

    function handleSelectBlur(event) {
      const container = event.target.closest(".select-container");
      if (container) {
        container.classList.remove("focused");
      }

      validateField(event.target);
    }

    function handleSelectChange(event) {
      const select = event.target;

      if (select.value !== "") {
        select.classList.add("has-value");
      } else {
        select.classList.remove("has-value");
      }

      clearFieldError(select);
    }

    function initFormValidation() {
      const fields = contactForm.querySelectorAll("input, select, textarea");
      fields.forEach((field) => {
        field.addEventListener("blur", () => validateField(field));
        field.addEventListener("input", () => {
          if (field.classList.contains("error")) {
            validateField(field);
          }
        });
      });
    }

    function validateField(field) {
      const fieldName = field.name;
      const fieldValue = field.value.trim();
      let isValid = true;
      let errorMessage = "";

      switch (fieldName) {
        case "name":
          if (!fieldValue) {
            isValid = false;
            errorMessage = "El nombre es requerido";
          } else if (!validationPatterns.name.test(fieldValue)) {
            isValid = false;
            errorMessage = errorMessages.name;
          }
          break;

        case "email":
          if (!fieldValue) {
            isValid = false;
            errorMessage = "El email es requerido";
          } else if (!validationPatterns.email.test(fieldValue)) {
            isValid = false;
            errorMessage = errorMessages.email;
          }
          break;

        case "subject":
          if (!fieldValue) {
            isValid = false;
            errorMessage = errorMessages.subject;
          }
          break;

        case "message":
          if (!fieldValue) {
            isValid = false;
            errorMessage = "El mensaje es requerido";
          } else if (!validationPatterns.message.test(fieldValue)) {
            isValid = false;
            errorMessage = errorMessages.message;
          }
          break;
      }

      if (isValid) {
        clearFieldError(field);
      } else {
        showFieldError(field, errorMessage);
      }

      return isValid;
    }

    function showFieldError(field, message) {
      const formGroup = field.closest(".form-group");
      const errorElement = formGroup.querySelector(".error-message");

      field.classList.add("error");
      if (errorElement) {
        errorElement.textContent = message;
        errorElement.classList.add("show");
      }
    }

    function clearFieldError(field) {
      const formGroup = field.closest(".form-group");
      const errorElement = formGroup.querySelector(".error-message");

      field.classList.remove("error");
      if (errorElement) {
        errorElement.textContent = "";
        errorElement.classList.remove("show");
      }
    }

    function validateForm() {
      const fields = contactForm.querySelectorAll("input, select, textarea");
      let isFormValid = true;

      fields.forEach((field) => {
        if (!validateField(field)) {
          isFormValid = false;
        }
      });

      return isFormValid;
    }

    function initFormSubmission() {
      let isSubmitting = false;

      contactForm.addEventListener("submit", async function (event) {
        if (isSubmitting) {
          event.preventDefault();
          return;
        }

        isSubmitting = true;
        try {
          await handleFormSubmit(event);
        } finally {
          isSubmitting = false;
        }
      });
    }

    async function handleFormSubmit(event) {
      event.preventDefault();

      if (!validateForm()) {
        const firstError = contactForm.querySelector(".error");
        if (firstError) {
          firstError.scrollIntoView({ behavior: "smooth", block: "center" });
          firstError.focus();
        }
        return;
      }

      setLoadingState(true);

      try {
        const formData = new FormData(contactForm);
        formData.append("action", "send_contact_email");

        if (typeof contactFormAjax !== "undefined" && contactFormAjax.nonce) {
          formData.append("nonce", contactFormAjax.nonce);
        }

        let ajaxUrl;
        if (typeof contactFormAjax !== "undefined" && contactFormAjax.ajaxurl) {
          ajaxUrl = contactFormAjax.ajaxurl;
        } else if (window.contactFormAjax && window.contactFormAjax.ajaxurl) {
          ajaxUrl = window.contactFormAjax.ajaxurl;
        } else {
          const currentLocation = window.location;
          const pathParts = currentLocation.pathname
            .split("/")
            .filter((part) => part);
          let basePath = "";

          if (pathParts[0] === "colina") {
            basePath = "/colina";
          }

          ajaxUrl = `${currentLocation.protocol}//${currentLocation.host}${basePath}/wp-admin/admin-ajax.php`;
        }

        const response = await fetch(ajaxUrl, {
          method: "POST",
          body: formData,
        });

        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();

        if (data.success) {
          showSuccessMessage();
          resetForm();
        } else {
          if (data.data && data.data.includes("Token de seguridad")) {
            const newNonce = await renewNonce();
            if (newNonce) {
              if (typeof contactFormAjax !== "undefined") {
                contactFormAjax.nonce = newNonce;
              }
              setTimeout(() => handleFormSubmit(event), 1000);
              return;
            }
          }
          showErrorMessage(data.data || "Error al enviar el mensaje");
        }
      } catch (error) {
        console.error("Error completo:", error);
        if (error.message.includes("404")) {
          showErrorMessage(
            "Error 404: No se pudo encontrar el endpoint. Verifica la configuración de WordPress."
          );
        } else if (error.message.includes("Failed to fetch")) {
          showErrorMessage(
            "Error de conexión. Verifica que el servidor esté funcionando."
          );
        } else {
          showErrorMessage(`Error: ${error.message}`);
        }
      } finally {
        setLoadingState(false);
      }
    }

    function setLoadingState(loading) {
      if (loading) {
        submitBtn.classList.add("loading");
        submitBtn.disabled = true;
      } else {
        submitBtn.classList.remove("loading");
        submitBtn.disabled = false;
      }
    }

    function showSuccessMessage() {
      formMessages.classList.add("show");
      successMessage.style.display = "flex";
      errorMessage.style.display = "none";

      setTimeout(() => {
        hideMessages();
      }, 5000);
    }

    function showErrorMessage(message = "Error al enviar el mensaje") {
      const errorText = errorMessage.querySelector("p");
      if (errorText) {
        errorText.textContent = message;
      }

      formMessages.classList.add("show");
      errorMessage.style.display = "flex";
      successMessage.style.display = "none";

      setTimeout(() => {
        hideMessages();
      }, 5000);
    }

    function hideMessages() {
      formMessages.classList.remove("show");
    }

    function resetForm() {
      contactForm.reset();

      const inputs = contactForm.querySelectorAll("input, textarea, select");
      inputs.forEach((input) => {
        input.classList.remove("has-value", "error");
        clearFieldError(input);
      });

      const containers = contactForm.querySelectorAll(
        ".input-container, .textarea-container, .select-container"
      );
      containers.forEach((container) => {
        container.classList.remove("focused");
      });
    }

    document.addEventListener("click", function (event) {
      if (
        formMessages &&
        formMessages.classList.contains("show") &&
        !formMessages.contains(event.target)
      ) {
        hideMessages();
      }
    });

    document.addEventListener("keydown", function (event) {
      if (
        event.key === "Escape" &&
        formMessages &&
        formMessages.classList.contains("show")
      ) {
        hideMessages();
      }
    });

    function addLoadingAnimations() {
      const formGroups = contactForm.querySelectorAll(".form-group");
      formGroups.forEach((group, index) => {
        group.style.animationDelay = `${index * 100}ms`;
        group.classList.add("fade-in");
      });
    }

    addLoadingAnimations();

    if (typeof contactFormAjax !== "undefined") {
      console.log("Testing AJAX connection...");
      testAjaxConnection();
    }

    async function testAjaxConnection() {
      try {
        const formData = new FormData();
        formData.append("action", "test_ajax");

        const response = await fetch(contactFormAjax.ajaxurl, {
          method: "POST",
          body: formData,
        });

        const data = await response.json();
        console.log("AJAX Test Result:", data);
      } catch (error) {
        console.error("AJAX Test Error:", error);
      }
    }

    async function renewNonce() {
      try {
        if (typeof contactFormAjax === "undefined") return null;

        const formData = new FormData();
        formData.append("action", "get_contact_nonce");

        const response = await fetch(contactFormAjax.ajaxurl, {
          method: "POST",
          body: formData,
        });

        const data = await response.json();
        if (data.success && data.nonce) {
          return data.nonce;
        }
        return null;
      } catch (error) {
        return null;
      }
    }
  }
});
