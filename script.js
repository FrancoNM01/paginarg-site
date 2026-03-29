const siteHeader = document.querySelector(".site-header");
const navToggle = document.querySelector("[data-nav-toggle]");
const navLinks = document.querySelectorAll(".main-nav a");

if (siteHeader && navToggle) {
  navToggle.addEventListener("click", () => {
    const isOpen = siteHeader.classList.toggle("nav-open");
    navToggle.setAttribute("aria-expanded", String(isOpen));
  });

  navLinks.forEach((link) => {
    link.addEventListener("click", () => {
      siteHeader.classList.remove("nav-open");
      navToggle.setAttribute("aria-expanded", "false");
    });
  });

  document.addEventListener("click", (event) => {
    if (!siteHeader.contains(event.target)) {
      siteHeader.classList.remove("nav-open");
      navToggle.setAttribute("aria-expanded", "false");
    }
  });
}

const filters = document.querySelectorAll(".filter");
const demoCards = document.querySelectorAll(".demo-card");
const visibleCount = document.getElementById("visibleCount");
const catalogContext = document.getElementById("catalogContext");
const resetRubroFilter = document.getElementById("resetRubroFilter");
const rubroButtons = document.querySelectorAll("[data-filter-rubro]");
const rubroLabels = {
  restaurante: "Restaurante",
  gimnasio: "Gimnasio",
  "estudio-juridico": "Estudio jurídico",
  inmobiliaria: "Inmobiliaria",
  "tienda-online": "Tienda online",
};
const defaultCatalogContext = "con rubro, plan, precio estimado y acceso directo a cada ejemplo.";

const setActiveRubroButtons = (activeRubro = "all") => {
  rubroButtons.forEach((button) => {
    button.classList.toggle("active", activeRubro !== "all" && button.dataset.filterRubro === activeRubro);
  });
};

const updateCatalogContext = (count, rubroFilter = "all") => {
  if (visibleCount) {
    visibleCount.textContent = String(count);
  }

  if (catalogContext) {
    if (rubroFilter === "all") {
      catalogContext.textContent = defaultCatalogContext;
    } else {
      const label = rubroLabels[rubroFilter] || "este rubro";
      catalogContext.textContent = `para ${label}, con plan, precio estimado y acceso directo a cada ejemplo.`;
    }
  }

  if (resetRubroFilter) {
    resetRubroFilter.hidden = rubroFilter === "all";
  }
};

const applyFilters = (planFilter = "all", rubroFilter = "all") => {
  let count = 0;

  demoCards.forEach((card) => {
    const plan = card.dataset.plan;
    const rubro = card.dataset.rubro;
    const matchesPlan = planFilter === "all" || plan === planFilter;
    const matchesRubro = rubroFilter === "all" || rubro === rubroFilter;
    const isVisible = matchesPlan && matchesRubro;

    card.hidden = !isVisible;

    if (isVisible) {
      count += 1;
    }
  });

  updateCatalogContext(count, rubroFilter);
  setActiveRubroButtons(rubroFilter);
};

if (filters.length) {
  let activePlan = "all";
  let activeRubro = "all";

  filters.forEach((button) => {
    button.addEventListener("click", () => {
      activePlan = button.dataset.filterGroup;

      if (activePlan === "all") {
        activeRubro = "all";
      }

      filters.forEach((item) => item.classList.remove("active"));
      button.classList.add("active");

      applyFilters(activePlan, activeRubro);
    });
  });

  rubroButtons.forEach((button) => {
    button.addEventListener("click", () => {
      activeRubro = activeRubro === button.dataset.filterRubro ? "all" : button.dataset.filterRubro;
      document.getElementById("catalogo")?.scrollIntoView({ behavior: "smooth", block: "start" });
      applyFilters(activePlan, activeRubro);
    });
  });

  resetRubroFilter?.addEventListener("click", () => {
    activeRubro = "all";
    applyFilters(activePlan, activeRubro);
  });

  applyFilters(activePlan, activeRubro);
}

const closeCustomSelects = (except = null) => {
  document.querySelectorAll(".custom-select.is-open").forEach((instance) => {
    if (instance === except) {
      return;
    }

    instance.classList.remove("is-open");
    instance.querySelector(".custom-select-trigger")?.setAttribute("aria-expanded", "false");
  });
};

const enhanceSelect = (select) => {
  if (!select || select.dataset.customized === "true") {
    return;
  }

  select.dataset.customized = "true";
  select.classList.add("native-select-hidden");
  select.closest(".field-group")?.classList.add("field-group--select");

  const wrapper = document.createElement("div");
  wrapper.className = "custom-select";

  const trigger = document.createElement("button");
  trigger.type = "button";
  trigger.className = "custom-select-trigger";
  trigger.setAttribute("aria-haspopup", "listbox");
  trigger.setAttribute("aria-expanded", "false");

  const value = document.createElement("span");
  value.className = "custom-select-value";

  const icon = document.createElement("span");
  icon.className = "custom-select-icon";
  icon.setAttribute("aria-hidden", "true");
  icon.textContent = "v";

  trigger.append(value, icon);

  const menu = document.createElement("div");
  menu.className = "custom-select-menu";
  menu.setAttribute("role", "listbox");
  menu.setAttribute("aria-label", select.id);

  wrapper.append(trigger, menu);
  select.insertAdjacentElement("afterend", wrapper);

  const updateState = () => {
    const selectedOption = select.options[select.selectedIndex];
    const selectedText = selectedOption?.textContent.trim() || "Seleccionar";
    const hasValue = Boolean(select.value);

    value.textContent = selectedText;
    trigger.classList.toggle("is-placeholder", !hasValue);
    wrapper.classList.toggle("has-value", hasValue);

    menu.querySelectorAll(".custom-select-option").forEach((optionButton) => {
      const isSelected = optionButton.dataset.value === select.value;
      optionButton.classList.toggle("is-selected", isSelected);
      optionButton.setAttribute("aria-selected", String(isSelected));
    });
  };

  Array.from(select.options).forEach((option) => {
    const optionButton = document.createElement("button");
    optionButton.type = "button";
    optionButton.className = "custom-select-option";
    optionButton.dataset.value = option.value;
    optionButton.setAttribute("role", "option");
    optionButton.textContent = option.textContent.trim();

    if (!option.value) {
      optionButton.classList.add("is-placeholder-option");
    }

    optionButton.addEventListener("click", () => {
      select.value = option.value;
      select.dispatchEvent(new Event("change", { bubbles: true }));
      closeCustomSelects();
      trigger.focus();
    });

    menu.appendChild(optionButton);
  });

  trigger.addEventListener("click", () => {
    const shouldOpen = !wrapper.classList.contains("is-open");
    closeCustomSelects(wrapper);
    wrapper.classList.toggle("is-open", shouldOpen);
    trigger.setAttribute("aria-expanded", String(shouldOpen));
  });

  select.addEventListener("change", updateState);
  updateState();
};

document.addEventListener("click", (event) => {
  const activeSelect = event.target.closest(".custom-select");
  closeCustomSelects(activeSelect);
});

document.addEventListener("keydown", (event) => {
  if (event.key === "Escape") {
    closeCustomSelects();
  }
});

const heroCarousel = document.querySelector("[data-hero-carousel]");

if (heroCarousel) {
  const slides = Array.from(heroCarousel.querySelectorAll("[data-hero-slide]"));
  const dots = Array.from(heroCarousel.querySelectorAll("[data-hero-dot]"));
  let activeIndex = slides.findIndex((slide) => slide.classList.contains("is-active"));
  let autoRotateId = null;
  const rotationDelay = 4200;

  if (activeIndex < 0) {
    activeIndex = 0;
  }

  const setActiveSlide = (index) => {
    activeIndex = (index + slides.length) % slides.length;

    slides.forEach((slide, slideIndex) => {
      slide.classList.toggle("is-active", slideIndex === activeIndex);
    });

    dots.forEach((dot, dotIndex) => {
      dot.classList.toggle("is-active", dotIndex === activeIndex);
      dot.setAttribute("aria-pressed", String(dotIndex === activeIndex));
    });
  };

  const stopAutoRotate = () => {
    if (autoRotateId) {
      window.clearInterval(autoRotateId);
      autoRotateId = null;
    }
  };

  const restartAutoRotate = () => {
    stopAutoRotate();

    if (slides.length <= 1 || document.hidden) {
      return;
    }

    autoRotateId = window.setInterval(() => {
      setActiveSlide(activeIndex + 1);
    }, rotationDelay);
  };

  dots.forEach((dot) => {
    dot.addEventListener("click", () => {
      setActiveSlide(Number(dot.dataset.heroDot || 0));
      restartAutoRotate();
    });
  });

  heroCarousel.addEventListener("mouseenter", stopAutoRotate);
  heroCarousel.addEventListener("mouseleave", restartAutoRotate);
  heroCarousel.addEventListener("focusin", stopAutoRotate);
  heroCarousel.addEventListener("focusout", restartAutoRotate);

  document.addEventListener("visibilitychange", () => {
    if (document.hidden) {
      stopAutoRotate();
    } else {
      restartAutoRotate();
    }
  });

  setActiveSlide(activeIndex);
  restartAutoRotate();
}const orderForm = document.getElementById("orderForm");

if (orderForm) {
  const params = new URLSearchParams(window.location.search);
  const prefills = {
    rubro: params.get("rubro") || "",
    plan: params.get("plan") || "",
    demo: params.get("demo") || "",
  };

  const fields = {
    rubro: document.getElementById("rubro"),
    plan: document.getElementById("plan"),
    demo: document.getElementById("demo"),
    businessName: document.getElementById("businessName"),
    city: document.getElementById("city"),
    contactName: document.getElementById("contactName"),
    whatsapp: document.getElementById("whatsapp"),
    services: document.getElementById("services"),
    colors: document.getElementById("colors"),
    references: document.getElementById("references"),
    extras: document.getElementById("extras"),
  };

  const summaryPlan = document.getElementById("summaryPlan");
  const summaryRubro = document.getElementById("summaryRubro");
  const summaryDemo = document.getElementById("summaryDemo");
  const summaryPrice = document.getElementById("summaryPrice");
  const summaryTime = document.getElementById("summaryTime");

  const planMeta = {
    Basico: { price: "USD 220", time: "3 a 5 días" },
    Profesional: { price: "USD 420", time: "5 a 7 días" },
    Premium: { price: "USD 760", time: "7 a 10 días" },
    WooCommerce: { price: "USD 980", time: "10 a 14 días" },
  };

  const getFieldText = (field) => {
    if (!field) {
      return "Sin definir";
    }

    if (field.tagName === "SELECT") {
      return field.options[field.selectedIndex]?.textContent.trim() || "Sin definir";
    }

    return field.value.trim() || "Sin definir";
  };

  Object.entries(prefills).forEach(([key, value]) => {
    if (value && fields[key]) {
      fields[key].value = value;
    }
  });

  [fields.plan, fields.rubro].forEach((field) => enhanceSelect(field));

  const updateSummary = () => {
    const selectedPlanValue = fields.plan.value || "";
    const meta = planMeta[selectedPlanValue] || { price: "A definir", time: "A definir" };

    summaryPlan.textContent = getFieldText(fields.plan);
    summaryRubro.textContent = getFieldText(fields.rubro);
    summaryDemo.textContent = getFieldText(fields.demo);
    summaryPrice.textContent = meta.price;
    summaryTime.textContent = meta.time;
  };

  [fields.plan, fields.rubro, fields.demo].forEach((field) => {
    field?.addEventListener("change", updateSummary);
    field?.addEventListener("input", updateSummary);
  });

  updateSummary();

  orderForm.addEventListener("submit", (event) => {
    event.preventDefault();

    const messageLines = [
      "Hola, quiero pedir una página web.",
      `Plan: ${getFieldText(fields.plan)}`,
      `Rubro: ${getFieldText(fields.rubro)}`,
      `Demo elegida: ${getFieldText(fields.demo)}`,
      `Negocio: ${getFieldText(fields.businessName)}`,
      `Ciudad: ${getFieldText(fields.city)}`,
      `Nombre de contacto: ${getFieldText(fields.contactName)}`,
      `WhatsApp: ${getFieldText(fields.whatsapp)}`,
      `Servicios: ${getFieldText(fields.services)}`,
      `Colores o estilo: ${getFieldText(fields.colors)}`,
      `Referencias: ${getFieldText(fields.references)}`,
      `Extras de interés: ${getFieldText(fields.extras)}`,
    ];

    const whatsappUrl = `https://wa.me/543517714398?text=${encodeURIComponent(messageLines.join("\n"))}`;
    window.open(whatsappUrl, "_blank", "noopener");
  });
}
