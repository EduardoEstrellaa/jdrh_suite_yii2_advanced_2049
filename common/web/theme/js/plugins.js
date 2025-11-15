document.addEventListener("DOMContentLoaded", function () {
  const hasToast = document.querySelector("[toast-list]");
  const hasChoices = document.querySelector("[data-choices]");
  const hasFlatpickr = document.querySelector("[data-provider]");

  // Utilidad para cargar scripts dinámicamente
  function loadScript(src) {
    const script = document.createElement('script');
    script.src = src;
    script.type = 'text/javascript';
    script.defer = true;
    document.head.appendChild(script);
  }

  if (hasToast) {
    loadScript("https://cdn.jsdelivr.net/npm/toastify-js");
  }

  if (hasChoices) {
    loadScript("theme/libs/choices.js/public/assets/scripts/choices.min.js");
  }

  if (hasFlatpickr) {
    loadScript("theme/libs/flatpickr/flatpickr.min.js");
  }
});
