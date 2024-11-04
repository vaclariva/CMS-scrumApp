document.addEventListener("DOMContentLoaded", function() {
    const backlogToggles = document.querySelectorAll(".backlog-toggle");
    const backlogCardBodies = document.querySelectorAll(".card-body-backlog");

    // Open the first card by default and close others
    backlogCardBodies.forEach((body, index) => {
        if (index === 0) {
            body.style.display = "block"; // Open the first card
            backlogToggles[index].classList.add("rotate-180"); // Rotate the toggle icon
        } else {
            body.style.display = "none"; // Close all other cards
        }
    });

    backlogToggles.forEach((toggle, index) => {
        toggle.addEventListener("click", function() {
            const currentBacklogCard = toggle.closest(".card");
            const backlogCardBody = currentBacklogCard.querySelector(".card-body-backlog");

            // Close other cards
            backlogCardBodies.forEach((body, bodyIndex) => {
                if (bodyIndex !== index) {
                    body.style.display = "none";
                    backlogToggles[bodyIndex].classList.remove("rotate-180"); // Remove rotation
                }
            });

            // Toggle the selected card
            if (backlogCardBody.style.display === "none" || backlogCardBody.style.display === "") {
                backlogCardBody.style.display = "block";
                toggle.classList.add("rotate-180");
            } else {
                backlogCardBody.style.display = "none";
                toggle.classList.remove("rotate-180");
            }
        });
    });
});