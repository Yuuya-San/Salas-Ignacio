<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Form</title>
</head>
<body>

    <form>
        <div class="form-group">
            <label for="start_date">Booking Start Date:</label>
            <input type="date" id="start_date" name="start_date" required>
        </div>
        <div class="form-group">
            <label for="end_date">Booking End Date:</label>
            <input type="date" id="end_date" name="end_date" required>
        </div>
    </form>

    <script>
        // Get the current date in the format YYYY-MM-DD
        function getCurrentDate() {
            const today = new Date();
            const year = today.getFullYear();
            const month = (today.getMonth() + 1).toString().padStart(2, '0');
            const day = today.getDate().toString().padStart(2, '0');
            return `${year}-${month}-${day}`;
        }

        // Set the min attribute of the date inputs
        document.getElementById('start_date').setAttribute('min', getCurrentDate());
        document.getElementById('end_date').setAttribute('min', getCurrentDate());

        // Add event listener for the start date input
        document.getElementById('start_date').addEventListener('change', function () {
            const selectedStartDate = this.value;

            // Set the min attribute of the end date input based on the selected start date
            document.getElementById('end_date').setAttribute('min', selectedStartDate);

            // Reset the end date value if it is earlier than the selected start date
            if (document.getElementById('end_date').value < selectedStartDate) {
                document.getElementById('end_date').value = selectedStartDate;
            }
        });

        // Add event listener for the end date input
        document.getElementById('end_date').addEventListener('change', function () {
            const selectedEndDate = this.value;

            // Reset the start date value if it is later than the selected end date
            if (document.getElementById('start_date').value > selectedEndDate) {
                document.getElementById('start_date').value = selectedEndDate;
            }
        });
    </script>

</body>
</html>
