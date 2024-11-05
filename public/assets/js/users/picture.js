$(document).ready(function() {
    $('#user-form').on('submit', function(e) {
        e.preventDefault();

        var form = $(this);
        var formData = new FormData(form[0]);

        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    toastr.success(response.success, 'Berhasil');
                    location.reload();
                }
            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors || {};

                if (errors.email) {
                    $('#email-error').removeClass('d-none').text(errors.email[0]);
                }
                toastr.error(xhr.responseJSON.error || 'Terjadi kesalahan', 'Gagal');
            }
        });
    });

    $("#parent-upload").on('click', function() {
        $("#image-upload").trigger('click');
    })
});

$("#image-upload").on('change', function(e) {
    const reader = new FileReader();
    reader.onload = e => $('.image-input-preview').css('background-image', `url(${e.target.result})`);
    reader.readAsDataURL(this.files[0]);
});

function removeImagePreview(event) {
    event.preventDefault();
    event.stopPropagation();

    const imageInput = event.currentTarget.closest('.image-input');

    if (imageInput) {
        const imagePreview = imageInput.querySelector('.image-input-preview');

        if (imagePreview) {
            imagePreview.style.backgroundImage = "url('metronic/dist/assets/media/avatars/blank.png')";
        } else {
            console.error('Image preview element not found');
        }
    } else {
        console.error('Image input element not found');
    }
}