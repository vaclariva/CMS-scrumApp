<div class="relative">
    <button id="iconPickerButton" type="button" class="p-2 rounded border">
        <span id="selectedIcon" class="ki-duotone ki-abstract-33"></span> 
    </button>
    <div id="iconPicker" class="hidden absolute top-full mt-2 bg-white border rounded shadow-lg dropdownicon">
        <input type="text" id="iconSearch" class="w-full p-2 border-b" placeholder="Search icons..." />
        <div id="iconGrid" class="flex flex-wrap p-2 max-h-60 overflow-y-auto">
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    fetch('/icons')
        .then(response => response.json())
        .then(data => {
            const iconGrid = document.getElementById('iconGrid');

            data.forEach(icon => {
                const iconElement = document.createElement('span');
                iconElement.className = icon.class + ' cursor-pointer p-2 hover:bg-gray-200 rounded';
                iconElement.dataset.class = icon.class; 
                iconGrid.appendChild(iconElement);
            });

            document.querySelectorAll('#iconGrid span').forEach(icon => {
                icon.addEventListener('click', function () {
                    const selectedIcon = document.getElementById('selectedIcon');
                    selectedIcon.className = this.dataset.class; 
                    document.getElementById('icon').value = this.dataset.class; 
                    document.getElementById('iconPicker').classList.add('hidden');
                });
            });
        });

    document.getElementById('iconPickerButton').addEventListener('click', function () {
        const picker = document.getElementById('iconPicker');
        picker.classList.toggle('hidden');
    });

    document.getElementById('iconSearch').addEventListener('input', function () {
        const query = this.value.toLowerCase();
        const icons = document.querySelectorAll('#iconGrid span');
        icons.forEach(icon => {
            if (icon.dataset.class.includes(query)) {
                icon.classList.remove('hidden');
            } else {
                icon.classList.add('hidden');
            }
        });
    });
});
</script>