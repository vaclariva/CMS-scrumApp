const textareas = document.querySelectorAll('.textarea');

textareas.forEach(textarea => {
    ClassicEditor
        .create(textarea, {
            rows: 10,
            toolbar: [
                'undo',
                'redo',
                'heading',
                '|',
                'alignment',
                '|',
                'bold',
                'italic',
                'underline',
                'link',
                '|',
                'bulletedList',
                'numberedList',
                '|',
                'insertTable',
                'blockQuote',
            ],
        })
        .then(editor => {
            console.log('Editor was initialized', editor);
        })
        .catch(error => {
            console.error('Error during initialization of the editor', error);
        });
});