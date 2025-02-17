class PartnersSlider {
  constructor(containerId) {
    this.container = document.getElementById(containerId);
    this.currentIndex = 0;
    this.totalSlides = 0;
  }

  init() {
    if (!this.container) return;

    this.slider = this.container.querySelector(".aim__partners__slider");
    this.slides = this.container.querySelectorAll(".aim__partners__slide");
    this.media_wrapper = this.container.querySelector(
      ".aim__partners__media-wrapper",
    );
    this.tabs = this.container.querySelectorAll(".aim__partners__tabs__tab");
    this.prevBtn = this.container.querySelector(".aim__partners__prev-button");
    this.nextBtn = this.container.querySelector(".aim__partners__next-button");
    this.currentIndexElement = this.container.querySelector(
      "#current-slide-index",
    );
    this.totalSlidesElement = this.container.querySelector("#total-slides");

    if (!this.slider || !this.slides.length) return;

    this.totalSlides = this.slides.length;

    this.tabs.forEach((tab) => {
      const idx = Number(tab.getAttribute("idx"));
      if (idx === this.currentIndex) {
        tab.classList.add("aim__partners__tabs__tab--selected");
      }
      tab.addEventListener("click", (e) => {
        this.showSlideByIndex(idx);
      });
    });

    if (this.prevBtn)
      this.prevBtn.addEventListener("click", () => this.showPrevSlide());
    if (this.nextBtn)
      this.nextBtn.addEventListener("click", () => this.showNextSlide());

    this.updateSliderPosition();
  }

  updateTabs() {
    this.tabs.forEach((tab) => {
      tab.classList.remove("aim__partners__tabs__tab--selected");
      const idx = tab.getAttribute("idx");
      if (Number(idx) === this.currentIndex) {
        tab.classList.add("aim__partners__tabs__tab--selected");
      }
    });
  }
  updateDisplay() {
    if (this.currentIndexElement) {
      // this.container.getElementById(''); //$id.'_'.$index
      this.currentIndexElement.textContent = this.currentIndex + 1;
    }
    if (this.totalSlidesElement) {
      this.totalSlidesElement.textContent = this.totalSlides;
    }
  }

  updateSliderPosition() {
    const res = this.currentIndex * 100;
    this.slider.style.transform = `translateX(-${res}%)`;
    this.media_wrapper.style.transform = `translateX(-${res}%)`;
    this.updateDisplay();
    this.updateTabs();
  }

  showPrevSlide() {
    this.currentIndex =
      this.currentIndex > 0 ? this.currentIndex - 1 : this.totalSlides - 1;
    this.updateSliderPosition();
  }

  showNextSlide() {
    this.currentIndex =
      this.currentIndex < this.totalSlides - 1 ? this.currentIndex + 1 : 0;
    this.updateSliderPosition();
  }

  showSlideByIndex(index) {
    this.currentIndex = index;
    this.updateSliderPosition();
  }
}

class PartnersMobileAccordion {
  constructor(containerId) {
    this.container = document.getElementById(containerId);
    this.opened = [];
  }

  toggleTab(index) {
    const idx = this.opened.indexOf(index);
    if (idx === -1) {
      this.opened.push(index);
    } else {
      this.opened.splice(idx, 1);
    }

    const body = this.container.querySelector(`#tab_content_` + index);

    if (this.opened.includes(index)) {
      body.classList.add("aim__partners--mobile__tabs__content--opened");
    } else {
      body.classList.remove("aim__partners--mobile__tabs__content--opened");
    }
  }

  init() {
    if (!this.container) return;
    const buttons = this.container.querySelectorAll(
      ".aim__partners--mobile__tabs__tab",
    );
    buttons.forEach((partnerButton) => {
      partnerButton.addEventListener("click", (e) => {
        const idx = Number(partnerButton.getAttribute("idx"));
        partnerButton.classList.toggle(
          "aim__partners--mobile__tabs__tab--open",
        );
        this.toggleTab(idx);
      });
    });
  }
}

document.addEventListener("DOMContentLoaded", () => {
  // DESKTOP
  const partnersContainers = document.querySelectorAll(".aim__partners");
  partnersContainers.forEach((container) => {
    const containerId = container.getAttribute("id");
    const sliderInstance = new PartnersSlider(containerId);
    sliderInstance.init();
  });

  // MOBILE
  const partnersMobileContainers = document.querySelectorAll(
    ".aim__partners--mobile",
  );
  partnersMobileContainers.forEach((container) => {
    const containerMobileId = container.getAttribute("id");
    const accordionInstance = new PartnersMobileAccordion(containerMobileId);
    accordionInstance.init();
  });
});
