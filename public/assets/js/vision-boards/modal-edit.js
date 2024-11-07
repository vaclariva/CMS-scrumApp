let debounceTimeout;

function openEditModalVision(data) {
    $('#updateVisionBoardForm').attr('action', data.url_update); 
    let name =  $('.title-card-vision').val();
    
    document.getElementById('name-vision').value = name;
    document.getElementById('vision').value = data.vision || '';
    editors[0].setData(data.target_group); 
    editors[1].setData(data.needs);
    editors[2].setData(data.product); 
    editors[3].setData(data.business_goals);
    editors[4].setData(data.competitors); 

    showModal('modal_draggable');
}

document.getElementById('updateVisionBoardForm').addEventListener('submit', function (e) {
    e.preventDefault();
    saveData();
});

function saveData() {
    const formData = new FormData(document.getElementById('updateVisionBoardForm'));
    const url = document.getElementById('updateVisionBoardForm').getAttribute('action');

    $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            console.log('Auto-save response:', response);
            if (response.success) {
                updateVisionBoard(response.data, url); 
            } else {
                console.error('Auto-save gagal: ', response.message);
            }
        },
        error: function (err) {
            console.error('Error during auto-save:', err);
        }
    });
}

function updateVisionBoard(data, url_update) {
    let visionBoard = $(`#vision-board-${data.id}`);

    visionBoard.find('.card-title.custom-').text(data.name);
    visionBoard.find('.board-sub.vision').text(data.vision);
    visionBoard.find('.board-sub.target-group').html(data.target_group);
    visionBoard.find('.board-sub.needs').html(data.needs);
    visionBoard.find('.board-sub.product').html(data.product);
    visionBoard.find('.board-sub.business-goals').html(data.business_goals);
    visionBoard.find('.board-sub.competitors').html(data.competitors);

    let dropdownToggle = visionBoard.find(`#dropdown-toggle-${data.id}`);

        visionBoard.find(`#vision-board-btn-${data.id}`).attr('onclick',
            `openEditModalVision({
                id: '${data.id}',
                name: '${data.name || ''}',
                vision: '${data.vision || ''}',
                target_group: '${data.target_group || ''}',
                needs: '${data.needs || ''}',
                product: '${data.product || ''}',
                business_goals: '${data.business_goals || ''}',
                competitors: '${data.competitors || ''}',
                url_update: '${url_update}'
            })`
        );
}

document.querySelectorAll('[data-modal-dismiss="true"]').forEach(button => {
    button.addEventListener('click', closeEditModal);
});

function closeEditModal() {
    hideModal('modal_draggable');
}

function showModal(modalId) {
    var modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.add('open');
        modal.classList.remove('hidden');
        modal.setAttribute('aria-hidden', 'false');
    } else {
        console.error('Modal with id ' + modalId + ' not found');
    }
}

function hideModal(modalId) {
    var modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.add('hidden');
        modal.classList.remove('open');
        modal.setAttribute('aria-hidden', 'true');
    } else {
        console.error('Modal with id ' + modalId + ' not found');
    }
}

document.getElementById('modal_draggable').addEventListener('click', function(event) {
    if (event.target === this) {
        closeEditModal(); 
    }
});


function debounceSaveData() {
    clearTimeout(debounceTimeout);
    debounceTimeout = setTimeout(() => {
        saveData();
    }, 1000); 
}

function updateTitleVision(value, visionId, productId) {
    $.ajax({
        url: `/product/${productId}/vision_board/${visionId}/title`,
        type: 'PUT',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            name: value
        },
        success: function(response) {
            console.log(response.message);
        },
        error: function(xhr) {
            console.error('Error:', xhr);
        }
    });
}

$(document).ready(function () {
    let cardTitleVision = $('.title-card-vision');

    $(cardTitleVision).on('keyup',this,debounce(function() {
        let visionId = $(this).data('id');
        let productId = $(this).data('product-id');
        let value = $(this).val();
        
        updateTitleVision(value, visionId, productId);
    }, 1000));

    $('#updateVisionBoardForm').on('keyup', 'textarea, input', function () {
        debounceSaveData(); 
    });

    editors.forEach(editor => {
        editor.model.document.on('change:data', () => {
            let editorElement = editor.sourceElement;
            $(editorElement).val(editor.getData());
            debounceSaveData(); 
        });
    });
});