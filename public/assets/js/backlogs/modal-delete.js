function openDeleteBacklog(data) {
    $('#delete-form').attr('action', data.url_delete);
    $('#delete_name').text(data.name);

    console.log('Data:', data);
    console.log('Form action set to:', $('#delete-form').attr('action'));

    showModal('delete');
}

function closeDeleteModal() {
    hideModal('delete');
}

function showModal(modalId) {
    var modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.add('open');
        modal.classList.remove('hidden');
    } else {
        console.error('Modal with id ' + modalId + ' not found');
    }
}

function hideModal(modalId) {
    var modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.add('hidden');
        modal.classList.remove('open');
    } else {
        console.error('Modal with id ' + modalId + ' not found');
    }
}

document.querySelectorAll('[data-modal-dismiss]').forEach(function(btn) {
    btn.addEventListener('click', closeDeleteModal);
});