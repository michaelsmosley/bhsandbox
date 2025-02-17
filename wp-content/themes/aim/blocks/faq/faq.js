document.addEventListener('DOMContentLoaded', function() {
    const faqBlocks = document.querySelectorAll('.faq-block');

    faqBlocks.forEach(block => {
        const questions = block.querySelectorAll('.faq-block__question');

        questions.forEach(question => {
            question.addEventListener('click', () => {
                const answer = question.nextElementSibling;
                const isExpanded = question.getAttribute('aria-expanded') === 'true';

                // Close all other answers in this block
                questions.forEach(q => {
                    if (q !== question) {
                        q.setAttribute('aria-expanded', 'false');
                        const otherAnswer = q.nextElementSibling;
                        otherAnswer.classList.remove('is-visible');
                        setTimeout(() => {
                            otherAnswer.hidden = true;
                        }, 300); // Match transition duration
                    }
                });

                // Toggle current answer
                question.setAttribute('aria-expanded', !isExpanded);
                
                if (!isExpanded) {
                    // Opening
                    answer.hidden = false;
                    requestAnimationFrame(() => {
                        answer.classList.add('is-visible');
                    });
                } else {
                    // Closing
                    answer.classList.remove('is-visible');
                    setTimeout(() => {
                        answer.hidden = true;
                    }, 300); // Match transition duration
                }
            });
        });
    });
}); 