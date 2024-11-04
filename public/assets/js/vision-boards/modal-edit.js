let debounceTimeout;

function openEditModalVision(data) {
    console.log(data);
    $('#updateVisionBoardForm').attr('action', data.url_update); 
    
    document.getElementById('name').value = data.name || '';
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
    console.log(dropdownToggle);

    if (dropdownToggle.length) {
        if (data.name || data.vision || data.target_group || data.needs || data.product || data.business_goals || data.competitors) {
            console.log('Menampilkan dropdown-toggle');
            dropdownToggle.show(); 
        } else {
            console.log('Menyembunyikan dropdown-toggle');
            dropdownToggle.hide();
        }
        } else {
            console.error('Tombol dropdown-toggle tidak ditemukan!');
        }
        

        let visionElement = visionBoard.find(`#item-vision-${data.id}`);
        if (data.vision && data.vision.trim() !== '') {
            visionElement.html(`
                <div class="mb-5">
                    <span class="px-2.5" style="font-weight: 500;"> • Vision (Visi) </span><br>
                    <div class="board-sub vision text-gray-600">${data.vision}</div>
                </div>
            `);
            visionElement.show();
        } else {
            visionElement.hide();
        }
          

        // Update target group
        let targetGroupElement = visionBoard.find(`#item-target-group-${data.id}`);
        if (data.target_group && data.target_group.trim() !== '') {
            targetGroupElement.html(`
                <div class="mb-5">
                    <span class="px-2.5" style="font-weight: 500;"> • Target Group (Kelompok Sasaran) </span><br>
                    <div class="board-sub target-group text-gray-600" >${data.target_group}</div>
                </div>
            `);
            targetGroupElement.show(); 
        } else {
            targetGroupElement.hide();
        }

        // Update needs
        let needsElement = visionBoard.find(`#item-needs-${data.id}`);
        if (data.needs && data.needs.trim() !== '') {
            needsElement.html(`
                <div class="mb-5">
                    <span class="px-2.5" style="font-weight: 500;"> • Needs (Kebutuhan) </span><br>
                    <div class="board-sub needs text-gray-600">${data.needs}</div>
                </div>
            `);
            needsElement.show(); 
        }  else {
            needsElement.hide();
        }

        // Update product
        let productElement = visionBoard.find(`#item-product-${data.id}`);
        if (data.product && data.product.trim() !== '') {
            productElement.html(`
                <div class="mb-5">
                    <span class="px-2.5" style="font-weight: 500;"> • Product (Product) </span><br>
                    <div class="board-sub product text-gray-600">${data.product}</div>
                </div>
            `);
            productElement.show(); 
        }  else {
            productElement.hide();
        }

        // Update business goals
        let businessGoalsElement = visionBoard.find(`#item-business-goals-${data.id}`);
        if (data.business_goals && data.business_goals.trim() !== '') {
            businessGoalsElement.html(`
                <div class="mb-5">
                    <span class="px-2.5" style="font-weight: 500;"> • Business Goals (Tujuan Bisnis) </span><br>
                    <div class="board-sub business-goals text-gray-600">${data.business_goals}</div>
                </div>
            `);
            businessGoalsElement.show(); 
        }  else {
            businessGoalsElement.hide();
        }

        // Update competitors
        let competitorsElement = visionBoard.find(`#item-competitors-${data.id}`);
        if (data.competitors && data.competitors.trim() !== '') {
            competitorsElement.html(`
                 <div class="mb-5">
                    <span class="px-2.5" style="font-weight: 500;"> • Competitors (Pesaing) </span><br>
                    <div class="board-sub competitors text-gray-600">${data.competitors}</div>
                </div>
            `);
            competitorsElement.show(); 
        }  else {
            competitorsElement.hide();
        }

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
    console.log(visionBoard);
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

$(document).ready(function () {
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