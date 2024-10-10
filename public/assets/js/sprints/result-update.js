document.addEventListener('DOMContentLoaded', function() {
    const statusCheckbox = document.getElementById('status');
    const reviewSection = document.getElementById('review_section');
    const retrospectiveSection = document.getElementById('retrospective_section');

    const toggleSections = () => {
        if (statusCheckbox.checked) {
            reviewSection.style.display = 'block';
            retrospectiveSection.style.display = 'block';
        } else {
            reviewSection.style.display = 'none';
            retrospectiveSection.style.display = 'none';
        }
    };

    toggleSections();

    statusCheckbox.addEventListener('change', toggleSections);
});