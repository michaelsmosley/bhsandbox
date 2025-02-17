function toggleClassOnHover(elementId, toggleClass, dropdownSelector) {
  const element = document.getElementById(elementId);
  const dropdown = document.querySelector(dropdownSelector);

  if (!element || !dropdown) {
    return;
  }

  // Add mouseenter to add the class and adjust height
  element.addEventListener("mouseenter", () => {
    element.classList.add(toggleClass);
    // Adjust dropdown height
    dropdown.style.overflow = "hidden"; // Optional: Ensure no content spills over
  });

  // Add mouseleave to remove the class and reset height
  element.addEventListener("mouseleave", () => {
    element.classList.remove(toggleClass);
    const dropdown = document.querySelector(".aim__header__dropdown");
    if (dropdown) {
      dropdown.style.height = 0;
    }
  });
}

toggleClassOnHover("aim-header", "aim__header--open", ".aim__header__dropdown");
document.querySelectorAll(".parent-menu li").forEach((parentItem, index) => {
  const spanElement = parentItem.querySelector(
    "span > .aim__header__underline",
  );

  if (!spanElement) return; // Skip if there's no span inside the parent item

  // Add mouseenter event to handle submenu, underline activation, and dynamic dropdown height
  parentItem.addEventListener("mouseenter", function () {
    const parentId = this.dataset.parentId;
    document.querySelectorAll(".child-menu li").forEach((childItem) => {
      if (childItem.dataset.childOf === parentId) {
        childItem.style.opacity = "1";
        childItem.style.visibility = "visible";
        childItem.style.display = "block";
      } else {
        childItem.style.opacity = "0";
        childItem.style.visibility = "hidden";
        childItem.style.display = "none";
      }

      const dropdownNavHeight =
        document.getElementsByClassName("aim__header__dropdown__nav")[0]
          .offsetHeight + 160;
      document.querySelector(".aim__header__dropdown").style.height =
        `${dropdownNavHeight}px`;
    });

    document.querySelectorAll(".parent-menu li span div").forEach((span) => {
      span.classList.remove("aim__header__active__underline");
    });
    spanElement.classList.add("aim__header__active__underline");
    spanElement.classList.add("aim__header__hover__underline");
  });

  parentItem.addEventListener("mouseleave", function () {
    spanElement.classList.remove("aim__header__hover__underline");
  });

  // Set default selection for the first parent item
  if (index === 0) {
    const parentId = parentItem.dataset.parentId;
    document.querySelectorAll(".child-menu li").forEach((childItem) => {
      if (childItem.dataset.childOf === parentId) {
        childItem.style.opacity = "1";
        childItem.style.visibility = "visible";
        childItem.style.display = "block";
      } else {
        childItem.style.opacity = "0";
        childItem.style.visibility = "hidden";
        childItem.style.display = "none";
      }
    });
    spanElement.classList.add("aim__header__active__underline");
  }
});

// Scroll behavior remains largely unchanged, but ensure it doesn't conflict with hover behavior
let lastScrollY = window.scrollY;
window.addEventListener("scroll", () => {
  const aimHeader = document.getElementById("aim-header");
  const currentScrollY = window.scrollY;
  const isScrollingUp = currentScrollY < lastScrollY;

  if (currentScrollY < 144) {
    // scrolled down
    // Default state
    aimHeader.style.position = "absolute";
    aimHeader.style.transform = "translateY(0)";
    toggleClassOnHover(
      "aim-header",
      "aim__header--open",
      ".aim__header__dropdown",
    );
    document
      .querySelectorAll(".parent-menu li span div.aim__header__underline")
      .forEach((span) => {
        span.classList.remove("aim__header__active__underline");
        span.classList.remove("aim__header__hover__underline");
      });
  } else if (currentScrollY >= 144 && isScrollingUp) {
    // SHOW
    aimHeader.style.transform = "translateY(0)";
    aimHeader.style.position = "fixed";
    aimHeader.style.top = "0";
    toggleClassOnHover(
      "aim-header",
      "aim__header--open",
      ".aim__header__dropdown",
    );
  } else {
    // HIDE
    aimHeader.style.position = "absolute";
    aimHeader.style.transform = "translateY(-144px)";
    toggleClassOnHover(
      "aim-header",
      "aim__header--open",
      ".aim__header__dropdown",
    );
    document
      .querySelectorAll(".parent-menu li span div.aim__header__underline")
      .forEach((span) => {
        span.classList.remove("aim__header__active__underline");
        span.classList.remove("aim__header__hover__underline");
      });
  }

  const page = document.getElementsByClassName("aim__header__logo--page")[0];
  const homepage = document.getElementsByClassName(
    "aim__header__logo--homepage",
  )[0];
  if (homepage) {
    if (currentScrollY > 700) {
      homepage?.classList.add("aim__header__logo--homepage--scrolled");
    } else {
      homepage?.classList.remove("aim__header__logo--homepage--scrolled");
    }
  } else if (page) {
    if (currentScrollY > 400) {
      page?.classList.add("aim__header__logo--page--scrolled");
    } else {
      page?.classList.remove("aim__header__logo--page--scrolled");
    }
  }
  lastScrollY = currentScrollY;
});
