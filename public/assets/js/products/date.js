window.onload = function () {
    const parseIndonesianDate = (dateStr) => {
        const months = {
            "Januari": "01",
            "Februari": "02",
            "Maret": "03",
            "April": "04",
            "Mei": "05",
            "Juni": "06",
            "Juli": "07",
            "Agustus": "08",
            "September": "09",
            "Oktober": "10",
            "November": "11",
            "Desember": "12"
        };

        const [datePart, timePart] = dateStr.split(', ');
        const [day, monthName, year] = datePart.split(' ');
        const [hours, minutes] = timePart.split(':');

        const month = months[monthName];
        return new Date(`${year}-${month}-${day}T${hours}:${minutes}:00`);
    };

    const formatDateForView = (date) => {
        const options = {
            day: '2-digit',
            month: 'long',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
        };
        return new Date(date).toLocaleDateString('id-ID', options);
    };

    const formatDateForDB = (date) => {
        const d = new Date(date);
        const year = d.getFullYear();
        const month = ('0' + (d.getMonth() + 1)).slice(-2);
        const day = ('0' + d.getDate()).slice(-2);
        const hours = ('0' + d.getHours()).slice(-2);
        const minutes = ('0' + d.getMinutes()).slice(-2);
        const seconds = ('0' + d.getSeconds()).slice(-2);
        return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
    };

    const startDateInput = document.getElementById('start_date');
    const endDateInput = document.getElementById('end_date');

    // Pastikan datepicker sudah terinisialisasi, jika ada
    if (typeof $('#start_date').datepicker === 'function') {
        $('#start_date').datepicker({
            format: 'dd MM yyyy',
            language: 'id',
            autoclose: true
        }).on('changeDate', function (e) {
            startDateInput.value = formatDateForView(e.date);
        });
    }

    if (typeof $('#end_date').datepicker === 'function') {
        $('#end_date').datepicker({
            format: 'dd MM yyyy',
            language: 'id',
            autoclose: true
        }).on('changeDate', function (e) {
            endDateInput.value = formatDateForView(e.date);
        });
    }

    // Format input saat halaman dimuat
    if (startDateInput.value) {
        startDateInput.value = formatDateForView(startDateInput.value);
    }

    if (endDateInput.value) {
        endDateInput.value = formatDateForView(endDateInput.value);
    }

    // Saat form disubmit, format tanggal ke format DB
    const updateProductForm = document.getElementById('updateProductForm');
    updateProductForm.addEventListener('submit', function (e) {
        const startDateDB = formatDateForDB(parseIndonesianDate(startDateInput.value));
        const endDateDB = formatDateForDB(parseIndonesianDate(endDateInput.value));

        document.getElementById('formatted_start_date').value = startDateDB;
        document.getElementById('formatted_end_date').value = endDateDB;
    });
};
