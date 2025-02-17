function toggleTopNavMobileState() {
  const detailsElements = document.querySelectorAll(
    "details.aim__header-mobile__nav-group",
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

function toggleHamburgerState() {
  const dropdown = document.getElementById("aim-header-mobile-top-navigation");
  dropdown.classList.toggle("aim__header-mobile__dropdown--open");
  const hamburger = document.getElementById("aim-header-mobile-top-hamburger");
  hamburger.classList.toggle("aim__header-mobile__hamburger--open");
}

window.addEventListener("load", toggleTopNavMobileState);
window.addEventListener("resize", toggleTopNavMobileState);
