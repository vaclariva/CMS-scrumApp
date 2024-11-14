$(document).ready(function() {
    let cardTitle = $('.title-card-backlog');
    
    $(cardTitle).on('keyup',this,debounce(function() {
        let backlogId = $(this).data('id');
        let productId = $(this).data('product-id');
        let value = $(this).val();
        console.log(value);
        updateBacklog(value, backlogId, productId);
    }, 1000));

    $('#backlogStatus').on('change', function() {
        console.log('masuk 1');
        const isChecked = $(this).is(':checked');
        $('#backlogStatus').val(isChecked ? 1 : 0);
        saveBacklogChanges();
    });

    $('#backlogSprint, #backlogPriority').on('change', function() {
        console.log('masuk 2');
        saveBacklogChanges();
    });

    $(document).on('keyup', '#BacklogName, #BacklogDescription, #backlogPriority, #backlogHours, #backlogApplicant', debounce(function() {
        console.log('masuk 3');
        saveBacklogChanges();
    }, 1000));

    function saveBacklogChanges() {
        const formData = $('#editBacklogForm').serialize();
        console.log(formData);
        
        $.ajax({
            url: $('#editBacklogForm').attr('action'),
            type: 'PUT',
            data: formData,
            success: function(response) {
                console.log("Respon e: ",response);
                if (response.success) {
                    $(`#name-backlog-${response.id}`).val(response.name);
                    if(response.backlog.created_at === response.backlog.updated_at) {
                        $(`#backlog-action-${response.id}`).removeClass('hidden');
                        $(`#backlog-footer-${response.id}`).addClass('hidden');
                    } else {
                        $(`#backlog-action-${response.id}`).addClass('hidden');
                        $(`#backlog-footer-${response.id}`).removeClass('hidden');
                    }
                    updateDisplay(response);
                    
                    const backlogId = response.backlog.id;
                    const backlogDiv = $('.filter-backlog[data-backlog-id="' + backlogId + '"]');
                    const groupedBacklogList = $('#groupedBacklogList'); // ambil elemen seluruh div backlog list
                    
                    if (response.backlog.sprint_id) {
                        backlogDiv.show();
                        // Jika ada sprint_id, pastikan seluruh div backlog list ditampilkan
                        groupedBacklogList.show();
                    } else {
                        backlogDiv.hide();
                        // Jika tidak ada sprint_id, sembunyikan seluruh div backlog list
                        groupedBacklogList.hide();
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

    function updateDisplay(response) {
        const backlog = response.backlog;

        let checklistDiv = $(`#checklist-${backlog.id}`);

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
                '<div class="flex items-center text-xs"> <i class="ki-duotone ki-timer text-lg"></i>' +
                '<span class="ml-1 text-xs">' + backlog.hours + ' Jam</span></div>'
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

    function updateBacklog(value, backlogId, product_id) {
        $.ajax({
            url: `/products/${product_id}/backlogs/${backlogId}/title`,
            type: 'PUT',
            data: { _token: $('meta[name="csrf-token"]').attr('content'), name: value },
            success: function(response) {
                $(`#backlog-action-${backlogId}`).toggleClass('hidden', response.status === 'success');
                $(`#backlog-footer-${backlogId}`).toggleClass('hidden', response.status !== 'success');
            },
            error: function(xhr) {
                console.error('Error:', xhr);
            }
        });
    }
});
