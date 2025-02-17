document.addEventListener("DOMContentLoaded", function () {
  const items = document.querySelectorAll(".benefits-text-list__checkbox");

  items.forEach(checkbox => {
    checkbox.addEventListener("change", () => {
      const isDesktop = window.innerWidth >= 1024;

      if (!isDesktop) {
        // Close all other checkboxes
        items.forEach(otherCheckbox => {
          if (otherCheckbox !== checkbox) {
            otherCheckbox.checked = false;
          }
        });
      }
    });
  });
});
