document.addEventListener('DOMContentLoaded', () => {
    class ContactFormModal {
        constructor(modal) {
            this.modal = modal;
            this.closeBtn = this.modal.querySelector('.modal-close');
            this.clickHandler = this.handleClick.bind(this);
            this.keyHandler = this.handleKeydown.bind(this);
            this.url = this.modal.getAttribute('modal_url');
            this.init();
        }

        init() {
            // Check if URL has #contact-us on page load
            if (window.location.hash === this.url) {
                this.openModal();
            }

            // Listen for hash changes
            window.addEventListener('hashchange', () => {
                if (window.location.hash === this.url) {
                    this.openModal();
                }
            });
        }

        handleClick(e) {
            const closeBtn = this.modal.querySelector('.modal-close');

            // Check if click is on SVG or path inside close button
            const isCloseButtonChild = closeBtn?.contains(e.target);

            if (e.target === this.modal || e.target === closeBtn || isCloseButtonChild) {
                this.closeModal();
            }
        }

        handleKeydown(e) {
            if (e.key === 'Escape') {
                this.closeModal();
            }
        }

        openModal() {
            this.modal.classList.add('active');
            document.body.style.overflow = 'hidden';
            this.modal.style.display = 'flex';
            // Add event listeners specifically to modal and close button
            this.modal.addEventListener('click', this.clickHandler);
            this.closeBtn.addEventListener('click', this.clickHandler);
            document.addEventListener('keydown', this.keyHandler);
            history.pushState('', document.title, window.location.pathname + window.location.search + this.url);
        }

        closeModal() {
            this.modal.classList.remove('active');
            this.modal.style.display = 'none';
            document.body.style.overflow = '';
            // Remove specific event listeners
            this.modal.removeEventListener('click', this.clickHandler);
            this.closeBtn.removeEventListener('click', this.clickHandler);
            document.removeEventListener('keydown', this.keyHandler);
            history.pushState('', document.title, window.location.pathname + window.location.search);
        }
    }

    const allModals = document.getElementsByClassName('modals');

    if (allModals.length) {
        Array.from(allModals).forEach((modal) => new ContactFormModal(modal));
    }
});