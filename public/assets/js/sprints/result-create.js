document.getElementById('status_checkbox').addEventListener('change', function() {
    const reviewSection = document.getElementById('review_section');
    const retrospectiveSection = document.getElementById('retrospective_section');
    
    if (this.checked) {
        reviewSection.style.display = 'block';
        retrospectiveSection.style.display = 'block';
    } else {
        reviewSection.style.display = 'none';
        retrospectiveSection.style.display = 'none';
    }
});

