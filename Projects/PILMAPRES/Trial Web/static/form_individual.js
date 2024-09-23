$(document).ready(function() {
    $('#rubric').change(function() {
        var selectedRubric = $(this).val();

        // Reset status and level dropdowns
        $('#status').empty().append('<option value="">Select a Status</option>');
        $('#level').empty().append('<option value="">Select a Level</option>');
    });

    $('#loadRubric').click(function() {
        var selectedRubric = $('#rubric').val();

        if (selectedRubric) {
            // Send an AJAX request to load the rubric data
            $.ajax({
                url: '/get-rubric-data',
                method: 'GET',
                data: { rubric: selectedRubric },
                success: function(data) {
                    // Sort status and level arrays
                    data.status.sort();
                    data.level.sort();

                    // Populate dropdowns with sorted data (status and level)
                    $('#status').empty().append('<option value="">Select a Status</option>');
                    data.status.forEach(function(item) {
                        $('#status').append('<option value="' + item + '">' + item + '</option>');
                    });
                    $('#level').empty().append('<option value="">Select a Level</option>');
                    data.level.forEach(function(item) {
                        $('#level').append('<option value="' + item + '">' + item + '</option>');
                    });
                    
                    // Update status text
                    $('#rubricStatus').text('Rubric loaded successfully: ' + selectedRubric);
                },
                error: function() {
                    // Update status text on error
                    $('#rubricStatus').text('Error loading rubric. Please try again.');
                }
            });
        } else {
            $('#rubricStatus').text('Please select a rubric first.');
        }
    });
});
