$(document).ready(function() {
    $('#rubric').change(function() {
        var selectedRubric = $(this).val();

        // Reset status and level dropdowns
        $('#status').empty().append('<option value="">Select a Status</option>');
        $('#level').empty().append('<option value="">Select a Level</option>');

        if (selectedRubric) {
            // Populate options based on selected rubric
            $.ajax({
                url: '/load_rubric', // Adjust this URL based on your backend setup
                method: 'POST', // Change to POST to match the backend
                data: { rubric: selectedRubric },
                success: function(data) {
                    // Assuming data.status and data.level are arrays of options
                    data.status.forEach(function(item) {
                        $('#status').append('<option value="' + item + '">' + item + '</option>');
                    });
                    data.level.forEach(function(item) {
                        $('#level').append('<option value="' + item + '">' + item + '</option>');
                    });
                },
                error: function(error) {
                    console.error("Error loading rubric data:", error);
                }
            });
        }
    });
});
