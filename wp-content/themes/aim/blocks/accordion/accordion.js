document.addEventListener("DOMContentLoaded", function () {
  const accordionBlocks = document.querySelectorAll(".accordion-block");

  accordionBlocks.forEach(block => {
    const questions = block.querySelectorAll(".accordion-block__question");

    questions.forEach(question => {
      question.addEventListener("click", () => {
        const answer = question.nextElementSibling;
        const isExpanded = question.getAttribute("aria-expanded") === "true";

        // Close all other answers in this block
        questions.forEach(q => {
          if (q !== question) {
            q.setAttribute("aria-expanded", "false");
            const otherAnswer = q.nextElementSibling;
            otherAnswer.style.height = "0";
            setTimeout(() => {
              otherAnswer.hidden = true;
            }, 300); // Match transition duration
          }
        });

        // Toggle current answer
        question.setAttribute("aria-expanded", !isExpanded);

        if (!isExpanded) {
          // Opening
          answer.hidden = false;
          answer.style.height = "0";
          requestAnimationFrame(() => {
            answer.style.height = answer.scrollHeight + "px";
          });
        } else {
          // Closing
          answer.style.height = "0";
          setTimeout(() => {
            answer.hidden = true;
          }, 300); // Match transition duration
        }
      });
    });
  });
});
