document.addEventListener('DOMContentLoaded', function() {
    const toolbars = document.querySelectorAll('.card-toolbar');
    const cardBodies = document.querySelectorAll('.card-body-vision');

    if (cardBodies.length > 0) {
        cardBodies[0].classList.add('show');
        toolbars[0].classList.add('rotate-180');
    }

    toolbars.forEach(function(toolbar, index) {
        toolbar.addEventListener('click', function() {
            const cardBody = this.closest('.card').querySelector('.card-body-vision');

            cardBodies.forEach(function(body, bodyIndex) {
                if (bodyIndex !== index) {
                    body.classList.remove('show');
                    toolbars[bodyIndex].classList.remove('rotate-180');
                }
            });

            cardBody.classList.toggle('show');
            this.classList.toggle('rotate-180');
        });
    });
});
