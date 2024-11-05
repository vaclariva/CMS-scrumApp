document.addEventListener('DOMContentLoaded', function () {
    fetch('/icons')
        .then(response => response.json())
        .then(data => {
            const iconGrid = document.getElementById('icon-grid-container');

            data.forEach(icon => {
                const iconElement = document.createElement('span');
                iconElement.className = icon.class + ' cursor-pointer p-2 hover:bg-gray-200 rounded';
                iconElement.dataset.class = icon.class; 
                iconGrid.appendChild(iconElement);
            });

            document.querySelectorAll('#icon-grid-container span').forEach(icon => {
                icon.addEventListener('click', function () {
                    const selectedIcon = document.getElementById('current-icon');
                    selectedIcon.className = this.dataset.class; 
                    document.getElementById('icon').value = this.dataset.class; 
                    document.getElementById('icon-picker-menu').classList.add('hidden');
                });
            });
        });

    document.getElementById('icon-picker-btn').addEventListener('click', function () {
        const picker = document.getElementById('icon-picker-menu');
        picker.classList.toggle('hidden');
    });

    document.getElementById('icon-search-input').addEventListener('input', function () {
        const query = this.value.toLowerCase();
        const icons = document.querySelectorAll('#icon-grid-container span');
        icons.forEach(icon => {
            if (icon.dataset.class.includes(query)) {
                icon.classList.remove('hidden');
            } else {
                icon.classList.add('hidden');
            }
        });
    });
});
