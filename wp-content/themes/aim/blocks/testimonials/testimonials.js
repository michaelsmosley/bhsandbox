class TestimonialsSlider {
  constructor(containerid) {
    this.container = document.getElementById(containerid);
    this.currentIndex = 0;
    this.totalSlides = 0;
  }

  init() {
    if (!this.container) return;

    this.slider = this.container.querySelector(".aim__testimonials__slider");
    this.slides = this.container.querySelectorAll(".aim__testimonials__slide");
    this.prevBtn = this.container.querySelector(
      ".aim__testimonials__prev-button",
    );
    this.nextBtn = this.container.querySelector(
      ".aim__testimonials__next-button",
    );
    this.currentIndexElement = this.container.querySelector(
      "#current-slide-index",
    );
    this.totalSlidesElement = this.container.querySelector("#total-slides");

    if (!this.slider || !this.slides.length) return;

    this.totalSlides = this.slides.length;

    if (this.prevBtn)
      this.prevBtn.addEventListener("click", () => this.showPrevSlide());
    if (this.nextBtn)
      this.nextBtn.addEventListener("click", () => this.showNextSlide());

    this.updateSliderPosition();
  }

  updateDisplay() {
    if (this.currentIndexElement) {
      this.currentIndexElement.textContent = this.currentIndex + 1;
    }
    if (this.totalSlidesElement) {
      this.totalSlidesElement.textContent = this.totalSlides;
    }
  }

  updateSliderPosition() {
    this.slider.style.transform = `translateX(-${this.currentIndex * 100}%)`;
    this.updateDisplay();
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

  getCurrentSlideIndex() {
    return this.currentIndex;
  }

  getTotalSlides() {
    return this.totalSlides;
  }
}

document.addEventListener("DOMContentLoaded", () => {
  const testimonialContainers = document.querySelectorAll(".aim__testimonials");
  testimonialContainers.forEach((container) => {
    const containerId = container.getAttribute("id");
    const sliderInstance = new TestimonialsSlider(containerId);
    sliderInstance.init();
  });
});
