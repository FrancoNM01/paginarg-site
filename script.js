const filters = document.querySelectorAll(".filter");
const demoCards = document.querySelectorAll(".demo-card");
const visibleCount = document.getElementById("visibleCount");
const rubroButtons = document.querySelectorAll("[data-filter-rubro]");

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

  if (visibleCount) {
    visibleCount.textContent = String(count);
  }
};

if (filters.length) {
  let activePlan = "all";
  let activeRubro = "all";

  filters.forEach((button) => {
    button.addEventListener("click", () => {
      activePlan = button.dataset.filterGroup;

      filters.forEach((item) => item.classList.remove("active"));
      button.classList.add("active");

      applyFilters(activePlan, activeRubro);
    });
  });

  rubroButtons.forEach((button) => {
    button.addEventListener("click", () => {
      activeRubro = button.dataset.filterRubro;
      document.getElementById("catalogo")?.scrollIntoView({ behavior: "smooth", block: "start" });
      applyFilters(activePlan, activeRubro);
    });
  });

  applyFilters(activePlan, activeRubro);
}

const orderForm = document.getElementById("orderForm");

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
    Basico: { price: "USD 220", time: "3 a 5 dias" },
    Profesional: { price: "USD 420", time: "5 a 7 dias" },
    Premium: { price: "USD 760", time: "7 a 10 dias" },
  };

  Object.entries(prefills).forEach(([key, value]) => {
    if (value && fields[key]) {
      fields[key].value = value;
    }
  });

  const updateSummary = () => {
    const selectedPlan = fields.plan.value || "Sin definir";
    const selectedRubro = fields.rubro.value || "Sin definir";
    const selectedDemo = fields.demo.value || "Sin definir";
    const meta = planMeta[selectedPlan] || { price: "A definir", time: "A definir" };

    summaryPlan.textContent = selectedPlan;
    summaryRubro.textContent = selectedRubro;
    summaryDemo.textContent = selectedDemo;
    summaryPrice.textContent = meta.price;
    summaryTime.textContent = meta.time;
  };

  [fields.plan, fields.rubro, fields.demo].forEach((field) => {
    field?.addEventListener("change", updateSummary);
  });

  updateSummary();

  orderForm.addEventListener("submit", (event) => {
    event.preventDefault();

    const messageLines = [
      "Hola, quiero pedir una pagina web.",
      `Plan: ${fields.plan.value || "Sin definir"}`,
      `Rubro: ${fields.rubro.value || "Sin definir"}`,
      `Demo elegida: ${fields.demo.value || "Sin definir"}`,
      `Negocio: ${fields.businessName.value || "Sin definir"}`,
      `Ciudad: ${fields.city.value || "Sin definir"}`,
      `Nombre de contacto: ${fields.contactName.value || "Sin definir"}`,
      `WhatsApp: ${fields.whatsapp.value || "Sin definir"}`,
      `Servicios: ${fields.services.value || "Sin definir"}`,
      `Colores o estilo: ${fields.colors.value || "Sin definir"}`,
      `Referencias: ${fields.references.value || "Sin definir"}`,
      `Extras de interes: ${fields.extras.value || "Sin definir"}`,
    ];

    const whatsappUrl = `https://wa.me/543517714398?text=${encodeURIComponent(messageLines.join("\n"))}`;
    window.open(whatsappUrl, "_blank", "noopener");
  });
}

