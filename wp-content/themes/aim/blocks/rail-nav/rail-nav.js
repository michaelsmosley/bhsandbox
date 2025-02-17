document.addEventListener("DOMContentLoaded", function () {
  const HEADER_OFFSET = 176;

  function scrollToElement(element) {
    if (!element) return;

    const targetPosition =
      element.getBoundingClientRect().top + window.scrollY - HEADER_OFFSET;

    window.scrollTo({
      top: targetPosition,
      behavior: "smooth",
    });
  }

  function handleDropdownChange(event) {
    const currentValue = event.target.value;
    if (
      currentValue.startsWith("http") ||
      currentValue.startsWith("/") ||
      currentValue.startsWith("./")
    ) {
      window.location.href = currentValue;
    } else {
      // otherwise, scroll to the element
      const targetElement = document.getElementById(currentValue);
      scrollToElement(targetElement);
      document.querySelector(".rail-nav__select").selectedIndex = 0;
    }
  }

  function handleSmoothScroll(event) {
    event.preventDefault();
    const targetElement = document.querySelector(
      event.target.getAttribute("href"),
    );
    scrollToElement(targetElement);
  }

  // Handle mobile dropdown navigation
  const mobileNavs = document.querySelectorAll(".rail-nav__select");
  mobileNavs.forEach((nav) => {
    nav.addEventListener("change", handleDropdownChange);
  });

  // query only the links that start with #
  const navLinks = document.querySelectorAll(
    '.rail-nav__nav a[href^="#"].rail-nav__link',
  );
  navLinks.forEach((link) => {
    link.addEventListener("click", handleSmoothScroll);
  });
});
