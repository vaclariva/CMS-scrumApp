<div class="modal" data-modal="true" id="modal_user_{{ $user->id }}">
    <div class="modal-content modal-center max-w-[500px] p-6">
        <div class="modal-header">
            <h2 class="modal-title">
                Detail Pengguna
            </h2>
            <button class="btn btn-xs btn-icon btn-light" data-modal-dismiss="true">
                <i class="ki-outline ki-cross"></i>
            </button>
        </div>

        <div class="modal-body">
            <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group p-2">
                    <label class="text-sm" for="image-{{ $user->id }}"><strong>Foto</strong></label>
                    <input id="image-{{ $user->id }}" name="image" type="file" accept=".png, .jpg, .jpeg" hidden onchange="previewImage(event, {{ $user->id }})" />
                    <div class="flex justify-start items-center">
                        <div class="image-input size-16" data-image-input="false" id="parent-edit-{{ $user->id }}" onclick="triggerFileInput({{ $user->id }})">
                            <input name="avatar_remove" id="remove-{{ $user->id }}" type="hidden" />
                            <div class="btn btn-icon btn-icon-xs btn-light shadow-default absolute z-1 size-5 -top-0.5 -right-0.5 rounded-full"
                                data-image-input-remove=""
                                data-tooltip="#image_input_tooltip-{{ $user->id }}"
                                data-tooltip-trigger="hover"
                                onclick="deleteImage(event, {{ $user->id }})">
                                <i class="ki-outline ki-cross"></i>
                            </div>
                            <span class="tooltip" id="image_input_tooltip-{{ $user->id }}">
                                Click to remove or revert
                            </span>
                            <div class="image-input-placeholder rounded-full border-2 border-success image-input-empty:border-gray-300" id="image-preview-{{ $user->id }}" style="background-image: url('{{ $user->image_path ? asset($user->image_path) : 'metronic/dist/assets/media/avatars/blank.png'}}');">
                                <div class="image-input-preview" style="background-image:url('{{ $user->image ? asset('/storage/'.$user->image) : 'metronic/dist/assets/media/avatars/blank.png'}}')">
                                </div>
                                <div class="flex items-center justify-center cursor-pointer h-5 left-0 right-0 bottom-0 bg-dark-clarity absolute">
                                    <svg class="fill-light opacity-80" height="12" viewbox="0 0 14 12" width="14" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.6665 2.64585H11.2232C11.0873 2.64749 10.9538 2.61053 10.8382 2.53928C10.7225 2.46803 10.6295 2.36541 10.5698 2.24335L10.0448 1.19918C9.91266 0.931853 9.70808 0.707007 9.45438 0.550249C9.20068 0.393491 8.90806 0.311121 8.60984 0.312517H5.38984C5.09162 0.311121 4.799 0.393491 4.5453 0.550249C4.2916 0.707007 4.08701 0.931853 3.95484 1.19918L3.42984 2.24335C3.37021 2.36541 3.27716 2.46803 3.1615 2.53928C3.04584 2.61053 2.91234 2.64749 2.7765 2.64585H2.33317C1.90772 2.64585 1.49969 2.81486 1.19885 3.1157C0.898014 3.41654 0.729004 3.82457 0.729004 4.25002V10.0834C0.729004 10.5088 0.898014 10.9168 1.19885 11.2177C1.49969 11.5185 1.90772 11.6875 2.33317 11.6875H11.6665C12.092 11.6875 12.5 11.5185 12.8008 11.2177C13.1017 10.9168 13.2707 10.5088 13.2707 10.0834V4.25002C13.2707 3.82457 13.1017 3.41654 12.8008 3.1157C12.5 2.81486 12.092 2.64585 11.6665 2.64585ZM6.99984 9.64585C6.39413 9.64585 5.80203 9.46624 5.2984 9.12973C4.79478 8.79321 4.40225 8.31492 4.17046 7.75532C3.93866 7.19572 3.87802 6.57995 3.99618 5.98589C4.11435 5.39182 4.40602 4.84613 4.83432 4.41784C5.26262 3.98954 5.80831 3.69786 6.40237 3.5797C6.99644 3.46153 7.61221 3.52218 8.1718 3.75397C8.7314 3.98576 9.2097 4.37829 9.54621 4.88192C9.88272 5.38554 10.0623 5.97765 10.0623 6.58335C10.0608 7.3951 9.73765 8.17317 9.16365 8.74716C8.58965 9.32116 7.81159 9.64431 6.99984 9.64585Z" fill=""></path>
                                        <path d="M7 8.77087C8.20812 8.77087 9.1875 7.7915 9.1875 6.58337C9.1875 5.37525 8.20812 4.39587 7 4.39587C5.79188 4.39587 4.8125 5.37525 4.8125 6.58337C4.8125 7.7915 5.79188 8.77087 7 8.77087Z" fill=""></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <small class="form-text text-muted flex justify-center p-3">150x150px JPEG, PNG</small>
                    </div>
                </div>

                <div class="form-group p-2">
                    <label class="text-sm" for="name"><strong>Nama</strong></label>
                    <input class="input" name="name" placeholder="Masukkan Nama Pengguna" type="text" value="{{ $user->name }}" required />
                </div>

                <div class="form-group p-2">
                    <label class="text-sm" for="email"><strong>Email</strong></label>
                    <div class="input-group" type="email">
                        <span class="btn btn-icon btn-icon-lg btn-input">
                            <i class="ki-filled ki-sms"></i>
                        </span>
                        <input class="input" name="email" placeholder="Masukkan Email Pengguna" type="email" value="{{ $user->email }}" readonly />
                        @if ($user->is_password_null)
                        <button
                            class="btn btn-light md"
                            type="button"
                            onclick="resendEmail({el: this, url: '{{ route('users.resend-email', ['user' => $user->id]) }}'})"
                            data-toggle="tooltip" data-placement="top" title="Mengirim ulang tautan"
                        >
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 13C3.24 13 1 15.23 1 18C1 20.77 3.24 23 6 23C8.76 23 11 20.76 11 18C11 15.24 8.77 13 6 13ZM3.95999 15.96H6C6.38 15.96 6.67999 16.27 6.67999 16.64C6.67999 17.01 6.37 17.32 6 17.32H3.95999C3.57999 17.32 3.28 17.01 3.28 16.64C3.28 16.27 3.57999 15.96 3.95999 15.96ZM8.04001 20.04H3.95001C3.57001 20.04 3.26999 19.73 3.26999 19.36C3.26999 18.99 3.58001 18.68 3.95001 18.68H8.04001C8.42001 18.68 8.72 18.99 8.72 19.36C8.72 19.73 8.42001 20.04 8.04001 20.04Z" fill="#3498DB"/>
                            <path opacity="0.4" d="M17 3H7C4 3 2 4.5 2 8V11.14C2 11.87 2.75001 12.33 3.42001 12.04C4.52001 11.56 5.76999 11.38 7.07999 11.59C9.69999 12.02 11.84 14.09 12.37 16.69C12.52 17.45 12.54 18.19 12.44 18.9C12.36 19.49 12.84 20.01 13.43 20.01H17C20 20.01 22 18.51 22 15.01V8.00999C22 4.49999 20 3 17 3Z" fill="#3498DB"/>
                            <path d="M12.0027 11.868C11.1627 11.868 10.3127 11.608 9.66271 11.078L6.53271 8.57802C6.21271 8.31802 6.15271 7.84802 6.41271 7.52802C6.67271 7.20802 7.1427 7.14802 7.4627 7.40802L10.5927 9.90802C11.3527 10.518 12.6427 10.518 13.4027 9.90802L16.5327 7.40802C16.8527 7.14802 17.3327 7.19802 17.5827 7.52802C17.8427 7.84802 17.7927 8.32802 17.4627 8.57802L14.3327 11.078C13.6927 11.608 12.8427 11.868 12.0027 11.868Z" fill="#3498DB"/>
                        </svg>
                        </button>    
                        @endif
                    </div>
                </div>

                <div class="form-group p-2">
                    <label class="text-sm" for="role"><strong>Peran</strong></label>
                    <select class="select" name="role" required>
                        <option value="Product Owner" {{ $user->role === 'Product Owner' ? 'selected' : '' }}>Product Owner</option>
                    </select>
                </div>

                <div class="modal-footer">
                    <div class="flex gap-4 justify-end p-5">
                        <button class="btn btn-light rounded-full" data-modal-dismiss="true" type="button">
                            Batal
                        </button>
                        <button class="btn btn-primary ms-3 rounded-full" type="submit">
                            Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function triggerFileInput(userId) {
        document.getElementById(`image-${userId}`).click();
    }

    function previewImage(event, userId) {
        const file = event.target.files[0];
        const previewElement = document.getElementById('image-preview-' + userId);

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                previewElement.style.backgroundImage = `url('${e.target.result}')`;
                previewElement.querySelector('.image-input-preview').style.backgroundImage = `url('${e.target.result}')`;
            };

            reader.readAsDataURL(file);
            let inputRemove = $(`#remove-${userId}`);
            inputRemove.val(null);
        }
    }

    function deleteImage(event, userId) {
        event.preventDefault();
        event.stopPropagation();

        let inputRemove = $(`#remove-${userId}`);
        inputRemove.val(1);

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

    function resendEmail({ el, url }) {
        let btnOri = $(el).html();
        let loader = "<span class='spinner'></span>";
        
        $.ajax({
            url: url,
            type: "POST",
            beforeSend: function () {
                $(el).attr("disabled", true);
                $(el).html(loader);
            },
            success: function (res) {
                showSuccessToast({ message: res?.message ?? "Success" });
                // toastr.success(message: res?.message, 'Berhasil');
            },
            error: function (xhr, status, error) {
                if (typeof xhr.responseJSON?.errors === "object") {
                    showErrorToast({
                        message: xhr.responseJSON?.errors,
                        isMessageObject: true,
                    });
                } else {
                    showErrorToast({
                        message: xhr.responseJSON?.message,
                        isMessageObject: false,
                    });
                }
            },
            complete: function () {
                $(el).html(btnOri);
                $(el).attr("disabled", false);
            },
    });
}

</script>