$(document).ready(function() {
    
    $('#backlogStatus').on('change', function() {
        const isChecked = $(this).is(':checked');
        $('#backlogStatus').val(isChecked ? 1 : 0);
        saveBacklogChanges();
    });

    $('#backlogSprint, #backlogPriority').on('change', function() {
        saveBacklogChanges();
    });

    $(document).on('change keyup', '#BacklogName, #BacklogDescription, #backlogPriority, #backlogHours, #backlogApplicant', debounce(function() {
        saveBacklogChanges();
    }, 1000));

    function saveBacklogChanges() {
        const formData = $('#editBacklogForm').serialize();
    
        $.ajax({
            url: $('#editBacklogForm').attr('action'),
            type: 'PUT',
            data: formData,
            success: function(response) {
                if (response.success) {
                    console.log('Response data:', response);
                    
                    if (response.isNew) {
                        console.log('Entering isNew block');
                        console.log('Response:', response);
                        const newBacklogHtml = 
                        `
                        <div class="card mb-3 backlog-edit" data-backlog-id="${response.backlog.id}">
                            <div class="BacklogNameDisplay card-body title-backlog mb-0" data-backlog-id="${response.backlog.id}">
                                ${response.backlog.name}
                            </div>
                            <div class="flex justify-between">
                                <div class="px-7 pb-4 flex items-center gap-3">
                                    <!-- Badge Priority -->
                                    <div class="BacklogPriorityDisplay" data-backlog-id="${response.backlog.id}">
                                        ${response.backlog.priority ? `
                                            <span class="badge badge-pill badge-outline gap-1.5 
                                                ${response.backlog.priority === 'Tinggi' ? 'badge-danger' : 
                                                response.backlog.priority === 'Sedang' ? 'badge-warning' : 
                                                'badge-success'}">
                                                <span class="badge badge-dot 
                                                    ${response.backlog.priority === 'Tinggi' ? 'badge-danger' : 
                                                    response.backlog.priority === 'Sedang' ? 'badge-warning' : 
                                                    'badge-success'} size-1.5" data-backlog-id="${response.backlog.id}"></span>
                                                ${response.backlog.priority}
                                            </span>
                                        ` : ''}
                                    </div>                                        

                                    <!-- Icon Description -->
                                    <div class="BacklogDescriptionDisplay" data-backlog-id="${response.backlog.id}">
                                        ${response.backlog.description ? `<i class="ki-duotone ki-textalign-left"></i>` : ''}
                                    </div>

                                    <!-- Checklist -->
                                    <div class="BacklogChecklistDisplay flex items-center text-xs 
                                        ${response.checklists && response.checklists.completed === response.checklists.total ? 'text-success' : 'text-gray-500'}" 
                                        data-backlog-id="${response.backlog.id}">
                                        <i class="ki-duotone ki-check-squared text-lg"></i>
                                        ${response.checklists ? `${response.checklists.completed}/${response.checklists.total}` : ''}
                                    </div> 

                                    <!-- Hours -->
                                    <div class="BacklogHoursDisplay flex items-center" data-backlog-id="${response.backlog.id}">
                                        ${response.backlog.hours ? `
                                            <div class="flex items-center text-xs">
                                                <i class="ki-duotone ki-timer text-lg"></i>
                                                <span class="ml-1 text-xs">${response.backlog.hours} Jam</span>
                                            </div>
                                        ` : ''}
                                    </div>

                                    <!-- Status Check -->
                                    <div class="BacklogStatusDisplay" data-backlog-id="${response.backlog.id}">
                                        ${response.backlog.status === 1 ? `
                                            <div class="flex items-center text-xs text-success">
                                                <i class="ki-duotone ki-flag text-lg"></i>
                                                <span class="ml-1">Selesai</span>
                                            </div>
                                        ` : ''}
                                    </div>

                                    <!-- Product Owner Image -->
                                    <div class="flex items-center">
                                        <div class="menu-toggle btn btn-icon rounded-full" data-backlog-id="${response.backlog.id}">
                                            ${response.productOwner.image ? `
                                                <img src="${response.productOwner.image}" alt="${response.productOwner.name}" class="w-5 h-5 rounded-full object-cover">
                                            ` : `
                                                <img src="/metronic/dist/assets/media/avatars/blank.png" alt="Default Image" class="w-5 h-5 rounded-full object-cover">
                                            `}
                                        </div>
                                        <span class="text-xs">${response.productOwner.name}</span>
                                    </div>
                                </div>

                                <!-- Dropdown Menu -->
                                <div>
                                <div class="dropdown relative" data-dropdown="true" data-dropdown-placement="bottom-end" data-dropdown-trigger="click">
                                    <button class="dropdown-toggle btn hover:text-gray-50">
                                        <i class="ki-filled ki-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-content absolute left-0 mt-2 w-full max-w-56 py-2 bg-white shadow-lg z-10">
                                        <div class="menu menu-default flex flex-col w-full">
                                            <div class="menu-item">
                                                <a class="menu-link editBtn" data-product-id="${response.product.id}" data-backlog-id="${response.backlog.id}" 
                                                    onclick="openDrawer({url: '/backlogs/edit/' + ${response.product.id} + '/' + ${response.backlog.id}})">
                                                    <span class="menu-icon">
                                                        <i class="ki-duotone ki-notepad-edit"></i>
                                                    </span>
                                                    <span class="menu-title">Edit</span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <form action="/backlogs/duplicate/${response.product.id}/${response.backlog.id}" method="POST" class="mb-1">
                                                    <button type="submit" class="text-xs w-full">
                                                        <div class="flex items-center pl-5 menu-link">
                                                            <span class="menu-icon">
                                                                <i class="ki-duotone ki-copy"></i>
                                                            </span>
                                                            <span class="menu-title">Duplikat</span>
                                                        </div>
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link" href="/backlogs/download/${response.backlog.id}">
                                                    <span class="menu-icon">
                                                        <i class="ki-duotone ki-file-down"></i>
                                                    </span>
                                                    <span class="menu-title">Unduh PDF</span>
                                                </a>
                                            </div>                                                           
                                            <div class="menu-item">
                                                <a class="menu-link deleteBtn" onclick="openDeleteBacklog({
                                                    id: ${response.backlog.id},
                                                    name: '${response.backlog.name}',
                                                    url_delete: '/backlogs/destroy/' + ${response.product.id} + '/' + ${response.backlog.id}})">
                                                    <span class="menu-icon">
                                                        <i class="ki-duotone ki-trash"></i>
                                                    </span>
                                                    <span class="menu-title">Hapus</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        `;
                    
                    $('.backlogContainer').append(newBacklogHtml);
                    
                    } else {
                        updateDisplay(response.backlog);
                    }

                    const backlogId = response.backlog.id;
                    const backlogDiv = $('.filter-backlog[data-backlog-id="' + backlogId + '"]');
    
                    if (response.backlog.sprint_id) {
                        backlogDiv.show();
                    } else {
                        backlogDiv.hide();
                    }

                } else {
                    console.error('Autosave failed:', response);
                    alert('Failed to save changes.');
                }
            },
            error: function(xhr) {
                console.error('Error during autosave:', xhr);
            }
        });
    }

    function updateDisplay(backlog) {

        // Update Backlog Name
        $(`.BacklogNameDisplay[data-backlog-id="${backlog.id}"]`).text(backlog.name).show();
    
        // Update Backlog Description
        const backlogDescriptionDiv = $(`.BacklogDescriptionDisplay[data-backlog-id="${backlog.id}"]`);
        backlogDescriptionDiv.empty(); 
        
        if (backlog.description) {
            backlogDescriptionDiv.append('<i class="ki-duotone ki-textalign-left"></i>').show();
        } else {
            backlogDescriptionDiv.hide();
        }
    
        // Update Backlog Hours
        const backlogHoursDisplay = $(`.BacklogHoursDisplay[data-backlog-id="${backlog.id}"]`);
        backlogHoursDisplay.empty();
        if (backlog.hours) {
            backlogHoursDisplay.append(
                '<i class="ki-duotone ki-timer text-lg"></i>' +
                '<span class="ml-1 text-xs">' + backlog.hours + ' Jam</span>'
            ).show();
        } else {
            backlogHoursDisplay.hide();
        }
    
        // Update Backlog Status
        const backlogStatusDisplay = $(`.BacklogStatusDisplay[data-backlog-id="${backlog.id}"]`);
        backlogStatusDisplay.empty();
        if (backlog.status == 1) {
            backlogStatusDisplay.append(
                '<div class="flex items-center text-xs text-success">' +
                    '<i class="ki-duotone ki-flag text-lg"></i>' +
                    '<span class="ml-1">Selesai</span>' +
                '</div>'
            ).show();
        } else {
            backlogStatusDisplay.hide();
        }
    
        // Update Backlog Priority
        const priorityDisplay = $(`.BacklogPriorityDisplay[data-backlog-id="${backlog.id}"]`);
    
        if (priorityDisplay.text() !== backlog.priority) {
            priorityDisplay.html('');
            
            if (backlog.priority === 'Tinggi') {
                priorityDisplay.append(
                    '<span class="badge badge-danger badge-pill badge-outline gap-1.5">' +
                        '<span class="badge badge-dot badge-danger size-1.5"></span>' +
                        'Tinggi' +
                    '</span>'
                ).show();
            } else if (backlog.priority === 'Sedang') {
                priorityDisplay.append(
                    '<span class="badge badge-warning badge-pill badge-outline gap-1.5">' +
                        '<span class="badge badge-dot badge-warning size-1.5"></span>' +
                        'Sedang' +
                    '</span>'
                ).show();
            } else if (backlog.priority === 'Rendah') {
                priorityDisplay.append(
                    '<span class="badge badge-success badge-pill badge-outline gap-1.5">' +
                        '<span class="badge badge-dot badge-success size-1.5"></span>' +
                        'Rendah' +
                    '</span>'
                ).show();
            } else {
                priorityDisplay.hide();
            }
        }
    }
    
});
