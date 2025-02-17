function adjustAccordionState() {
  const detailsElements = document.querySelectorAll(
    "details.aim__footer__nav-group",
  );
  const isDesktop = window.innerWidth >= 992; // laptop breakpoint

  detailsElements.forEach((details) => {
    if (isDesktop) {
      details.setAttribute("open", "true");
    } else {
      details.removeAttribute("open");
    }
  });
}

window.addEventListener("load", adjustAccordionState);
window.addEventListener("resize", adjustAccordionState);
