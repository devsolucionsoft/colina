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

  // Contact Form Functionality
  initContactForm();

  function initContactForm() {
    const contactForm = document.getElementById("contact-form");
    if (!contactForm) return;

    const submitBtn = contactForm.querySelector(".submit-btn");
    const formMessages = document.getElementById("form-messages");
    const successMessage = document.getElementById("success-message");
    const errorMessage = document.getElementById("error-message");

    // Form validation patterns
    const validationPatterns = {
      name: /^[a-zA-ZÀ-ÿ\s]{2,50}$/,
      email: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
      message: /^.{10,500}$/,
    };

    // Error messages
    const errorMessages = {
      name: "El nombre debe tener entre 2 y 50 caracteres y solo contener letras",
      email: "Por favor, ingresa un email válido",
      subject: "Por favor, selecciona un tema",
      message: "El mensaje debe tener entre 10 y 500 caracteres",
    };

    // Initialize form enhancements
    initFormEnhancements();
    initFormValidation();
    initFormSubmission();

    function initFormEnhancements() {
      // Enhanced input/textarea behavior
      const inputs = contactForm.querySelectorAll("input, textarea");
      inputs.forEach((input) => {
        // Handle focus and blur for better UX
        input.addEventListener("focus", handleInputFocus);
        input.addEventListener("blur", handleInputBlur);
        input.addEventListener("input", handleInputChange);

        // Check if input has value on load
        if (input.value.trim() !== "") {
          input.classList.add("has-value");
        }
      });

      // Enhanced select behavior
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

      // Validate field on blur
      validateField(event.target);
    }

    function handleInputChange(event) {
      const input = event.target;

      // Update has-value class
      if (input.value.trim() !== "") {
        input.classList.add("has-value");
      } else {
        input.classList.remove("has-value");
      }

      // Clear error if user is typing
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

      // Update has-value class
      if (select.value !== "") {
        select.classList.add("has-value");
      } else {
        select.classList.remove("has-value");
      }

      clearFieldError(select);
    }

    function initFormValidation() {
      // Real-time validation
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

      // Validate form
      if (!validateForm()) {
        // Scroll to first error
        const firstError = contactForm.querySelector(".error");
        if (firstError) {
          firstError.scrollIntoView({ behavior: "smooth", block: "center" });
          firstError.focus();
        }
        return;
      }

      // Show loading state
      setLoadingState(true);

      try {
        // Prepare form data
        const formData = new FormData(contactForm);
        formData.append("action", "send_contact_email");

        // Get nonce from WordPress if available
        if (typeof contactFormAjax !== "undefined" && contactFormAjax.nonce) {
          formData.append("nonce", contactFormAjax.nonce);
        }

        // Determine AJAX URL
        let ajaxUrl;
        if (typeof contactFormAjax !== "undefined" && contactFormAjax.ajaxurl) {
          ajaxUrl = contactFormAjax.ajaxurl;
        } else if (window.contactFormAjax && window.contactFormAjax.ajaxurl) {
          ajaxUrl = window.contactFormAjax.ajaxurl;
        } else {
          // Fallback: construir URL basada en la ubicación actual
          const currentLocation = window.location;
          // Detectar si estamos en una subcarpeta
          const pathParts = currentLocation.pathname
            .split("/")
            .filter((part) => part);
          let basePath = "";

          // Si el primer elemento del path es 'colina', incluirlo en la base
          if (pathParts[0] === "colina") {
            basePath = "/colina";
          }

          ajaxUrl = `${currentLocation.protocol}//${currentLocation.host}${basePath}/wp-admin/admin-ajax.php`;
        }

        // Send AJAX request
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
          // Si el error es de token, intentar renovar el nonce
          if (data.data && data.data.includes("Token de seguridad")) {
            const newNonce = await renewNonce();
            if (newNonce) {
              // Actualizar el nonce y reintentar
              if (typeof contactFormAjax !== "undefined") {
                contactFormAjax.nonce = newNonce;
              }
              // Reintentar el envío una vez
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

      // Auto hide after 5 seconds
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

      // Auto hide after 5 seconds
      setTimeout(() => {
        hideMessages();
      }, 5000);
    }

    function hideMessages() {
      formMessages.classList.remove("show");
    }

    function resetForm() {
      contactForm.reset();

      // Clear all enhancements
      const inputs = contactForm.querySelectorAll("input, textarea, select");
      inputs.forEach((input) => {
        input.classList.remove("has-value", "error");
        clearFieldError(input);
      });

      // Clear containers
      const containers = contactForm.querySelectorAll(
        ".input-container, .textarea-container, .select-container"
      );
      containers.forEach((container) => {
        container.classList.remove("focused");
      });
    }

    // Click outside to hide messages
    document.addEventListener("click", function (event) {
      if (
        formMessages &&
        formMessages.classList.contains("show") &&
        !formMessages.contains(event.target)
      ) {
        hideMessages();
      }
    });

    // Escape key to hide messages
    document.addEventListener("keydown", function (event) {
      if (
        event.key === "Escape" &&
        formMessages &&
        formMessages.classList.contains("show")
      ) {
        hideMessages();
      }
    });

    // Enhanced animations
    function addLoadingAnimations() {
      const formGroups = contactForm.querySelectorAll(".form-group");
      formGroups.forEach((group, index) => {
        group.style.animationDelay = `${index * 100}ms`;
        group.classList.add("fade-in");
      });
    }

    // Initialize loading animations
    addLoadingAnimations();

    // Test AJAX connection (temporal)
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
