function toggleCompetitorsForm(show) {
    const competitorsSection = document.getElementById('competitors-section');
    const addBtn = document.getElementById('addCompetitorsBtn');
    const removeBtn = document.getElementById('removeCompetitorsBtn');

    if (show) {
        competitorsSection.removeAttribute('hidden'); 
        addBtn.classList.add('hidden'); 
        removeBtn.classList.remove('hidden'); 
    } else {
        competitorsSection.setAttribute('hidden', true);
        addBtn.classList.remove('hidden'); 
        removeBtn.classList.add('hidden'); 
    }
}