document.addEventListener('DOMContentLoaded', function() {

    document.getElementById('createVisionBoardBtn').addEventListener('click', function() {
        document.getElementById('productIdField').value = productId;

        var form = document.getElementById('hiddenForm');

        form.submit();
    });
});

