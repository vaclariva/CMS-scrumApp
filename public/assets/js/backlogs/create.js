document.addEventListener('DOMContentLoaded', function() {

    document.getElementById('createBacklog').addEventListener('click', function() {
        document.getElementById('productId').value = productId;

        var form = document.getElementById('Form');

        form.submit();
    });
});