class LQIP {
    constructor(container) {
        this.container = container;
        this.image = container.querySelector('img');
        
        if (this.image) {
            this.setupImage();
        } else {
            console.warn('No image found within LQIP container');
        }
    }

    setupImage() {
        // Create new image to preload
        const hiresImage = new Image();
        
        // Get base URL and remove existing dimensions
        const dataSrc = this.image.dataset.src;
        const baseUrl = dataSrc.split('?')[0];
        
        // Get image dimensions from the width/height attributes
        const width = parseInt(this.image.width, 10);
        const height = parseInt(this.image.height, 10);

        // Get device pixel ratio
        const dpi = window.devicePixelRatio || 1;
        
        // Calculate final dimensions
        const targetWidth = Math.round(width * dpi);
        const targetHeight = Math.round(height * dpi);
        
        // Construct new URL with calculated dimensions
        const quality = this.image.dataset.quality || 90;
        const format = this.image.dataset.format || 'jpg';
        const finalUrl = `${baseUrl}w=${targetWidth},h=${targetHeight},type=${format},q=${quality}/`;
        
        hiresImage.src = finalUrl;
        
        hiresImage.onload = () => {
            this.image.src = hiresImage.src;
            this.container.classList.add('lqip-image-loaded');
        };
    }
}

// Initialize all LQIP images on page load
document.addEventListener('DOMContentLoaded', () => {
    const lqipContainers = document.querySelectorAll('.lqip-image:not(.lqip-image-loaded)');
    
    lqipContainers.forEach((container) => {
        new LQIP(container);
    });
});
