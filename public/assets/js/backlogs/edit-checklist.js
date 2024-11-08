function openDrawer({ url, backlogId }) {
    // console.log('Opening drawer with URL:', url, 'and backlog ID:', backlogId);
    
    $.ajax({
        url: url,
        type: 'GET',
        data: { backlog_id: backlogId },
        success: function(response) {
            if (response.success) {
                console.log('Data loaded successfully:', response);
                $(`#percentage-${backlogId}`).text(`${response.completedChecklists}/${response.totalChecklists}`);

                $('#editBacklogForm').attr('action', `/products/${response.backlog.product_id}/backlogs/${response.backlog.id}`);

                $('#backlog_id').val(response.backlog.id);
                $('#BacklogName').val(response.backlog.name);
                $('#BacklogDescription').val(response.backlog.description);
                $('#backlogPriority').val(response.backlog.priority).change();
                $('#backlogHours').val(response.backlog.hours);
                $('#backlogApplicant').val(response.backlog.applicant);
                $('#backlogStatus').prop('checked', response.backlog.status === '1');
                $('#backlogSprint').val(response.backlog.sprint_id).trigger('change');

                let sprintOptions = `
                    <option value="" ${response.backlog.sprint_id ? '' : 'selected'}>Pilih Sprint</option>
                    ${response.sprints.map(sprint => `
                        <option value="${sprint.id}" ${sprint.id == response.backlog.sprint_id ? 'selected' : ''}>
                            ${sprint.name}
                        </option>
                    `).join('')}
                `;
                $('#backlogSprint').html(sprintOptions); 

                const checklistItems = response.checklists.map(checklist => `
                    <li class="mb-3" id="checklist-${checklist.id}">
                        <label class="form-label flex items-center gap-2.5">
                            <input class="checkbox checklist-checkbox" name="status" type="checkbox" data-id="${checklist.id}" value="${checklist.id}" ${checklist.status === '1' ? 'checked' : ''} />
                            <span class="w-full">
                                <textarea class="custom-textarea w-full ${checklist.status === '1' ? 'line-through text-gray-500' : ''}" data-id="${checklist.id}" name="description">${checklist.description}</textarea>
                            </span>
                        </label>
                    </li>
                `).join('');

                $('#checklistItems').html(checklistItems);


                $('#drawer_4').addClass('open');
                $('#backdrop').css('display', 'block');
                

                $(document).on('change', '.checkbox', function() {
                    const checklistId = $(this).data('id');
                    const isChecked = $(this).is(':checked');
                    const status = isChecked ? '1' : '0';
                    updateChecklistStatus(checklistId, status);

                    const textarea = $(this).closest('label').find('textarea');
                    if (isChecked) {
                        textarea.addClass('line-through text-gray-500');
                    } else {
                        textarea.removeClass('line-through text-gray-500');
                    }
                });

                $(document).on('keyup', '.custom-textarea', debounce(function() {
                    const checklistId = $(this).closest('li').attr('id').split('-')[1]; 
                    const description = $(this).val(); 
                    updateChecklistDescription(checklistId, description); 
                }, 1000));

                updateChecklistSummary(response.checklists);

                $(document).on('click', '.delete-checklist-button', function() {
                    const checklistId = $(this).data('id');
                    const backlogId = $('#backlog_id').val(); 
                    deleteChecklist(checklistId, backlogId);
                });
                
            } else {
                console.error('Failed to load data:', response);
                alert('Failed to load data.');
            }
        },
        error: function(xhr) {
            console.error('Error fetching data:', xhr);
            alert('Error fetching data.');
        }
    });
}

function updateChecklistSummary(checklists) {
    const totalChecklists = checklists.length;
    const completedChecklists = checklists.filter(checklist => checklist.status === '1').length;
    const percentage = (completedChecklists / totalChecklists) * 100 || 0; 

    $('#checklistCount').text(`Checklist ${completedChecklists}/${totalChecklists}`);
    $('#progressBar').css('width', `${percentage}%`);
    $('#progressPercentage').text(`${Math.round(percentage)}%`); 
}

function debounce(func, delay) {
    let timeoutId;
    return function(...args) {
        if (timeoutId) {
            clearTimeout(timeoutId); 
        }
        timeoutId = setTimeout(() => {
            func.apply(this, args); 
        }, delay);
    };
}

function updateChecklistStatus(checklistId, status) {
    console.log(`Updating status for checklist ${checklistId} to ${status}`);
    $.ajax({
        url: `/checklists/${checklistId}`,
        type: 'PUT',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            status: status,
            _method: 'PUT'
        },
        success: function(response) {
            const backlog = response.backlog; // This should be defined in the server response
            const completedChecklists = response.completedChecklists; 
            const totalChecklists = response.totalChecklists;

            console.log('Response dari server:', response);

            $('#checklistCount').text(`Checklist ${completedChecklists}/${totalChecklists}`);
            $('#progressBar').css('width', `${response.persentase}%`);
            $('#progressPercentage').text(`${Math.round(response.persentase)}%`);

            // Pass the backlog object along with checklist counts
            updateBacklogChecklistDisplay(backlog, completedChecklists, totalChecklists);
        },
        error: function(xhr) {
            console.error('Error updating checklist status:', xhr.responseText);
        }
    });
}

function updateChecklistDescription(checklistId, description) {
    const status = $(`#checklist-${checklistId} .checklist-checkbox`).is(':checked') ? '1' : '0';

    if (description === null || description.trim() === '') {
        deleteChecklist(checklistId);
        return; 
    }

    $.ajax({
        url: `/checklists/${checklistId}`,
        type: 'PUT',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            description: description,
            status: status 
        },
        success: function(response) {
            var checklist = response.checklist;
            console.log(`Checklist ${checklistId} description updated.`, response);
        },
        error: function(xhr) {
            console.error('Error updating checklist description:', xhr.responseText);
            alert('Failed to update checklist description.');
        }
    });
}


function deleteChecklist(checklistId, backlogId) {
    console.log(`Deleting checklist ${checklistId}`);
    $.ajax({
        url: `/checklists/${checklistId}/${backlogId}`, 
        type: 'DELETE',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            
            $(`#checklist-${checklistId}`).remove(); 
            console.log(`Checklist ${checklistId} deleted.`, response);
            $('#checklistCount').text(`Checklist ${response.completedChecklists}/${response.totalChecklists}`);
            $('#progressBar').css('width', `${response.persentase}%`);
            $('#progressPercentage').text(`${Math.round(response.persentase)}%`);
            updateBacklogChecklistDisplay(response.backlog, response.completedChecklists, response.totalChecklists);
        },
        error: function(xhr) {
            console.error('Error deleting checklist:', xhr);
        }
    });
}


function updateBacklogChecklistDisplay(backlog, completedChecklists, totalChecklists) {
    const checklistDisplay = $(`#checklist-${backlog.id}`);
    checklistDisplay.removeClass('hidden');
    if(completedChecklists === totalChecklists) {
        checklistDisplay.addClass('text-success');
        checklistDisplay.removeClass('text-gray-500');
    } else {
        checklistDisplay.removeClass('text-success');
        checklistDisplay.addClass('text-gray-500');
    }
    checklistDisplay.empty();
    checklistDisplay.html(`
        <i class="ki-duotone ki-check-squared text-lg me-2"></i>
        ${completedChecklists}/${totalChecklists}
    `);
}


function closeDrawer() {
    $('#drawer_4').removeClass('open');
    $('#backdrop').css('display', 'none'); 
}

$('#drawerDismissButton').on('click', closeDrawer);

function autoResize(textarea) {
    textarea.style.height = 'auto';
    textarea.style.height = textarea.scrollHeight + 'px';
}

$('#backdrop').on('click', closeDrawer);
