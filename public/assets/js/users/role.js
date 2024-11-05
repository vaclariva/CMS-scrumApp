$('#modal-add').on('click', function() {
    $.get(urlIndex, function(roles) {
        const $selectRole = $('#role_id');
        $selectRole.empty();
        $.each(roles, function(index, roles) {
            $selectRole.append(
                $('<option>', {
                    value: roles.id,
                    text: roles.name
                })
            );
        });
    });
});
