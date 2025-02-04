<?php
// Hook to add the admin menu for the Riester Development Tools
add_action('admin_menu', 'riester_dev_admin_menu');

// Add a new top-level menu for Riester Dev Tools
function riester_dev_admin_menu() {
    add_menu_page(
        'Riester Dev Tools', // Page title
        'Riester Dev',       // Menu title
        'manage_options',    // Capability
        'riester-dev-tools', // Menu slug
        'riester_dev_admin_page', // Function to display the page content
        'dashicons-hammer',  // Icon
        80                   // Position in menu
    );
}

// Display the admin page content
function riester_dev_admin_page() {
    ?>
    <div class="wrap" style="display: flex;">
        <!-- Sidebar (1/3) with checkboxes for available functions -->
        <div style="width: 30%; padding-right: 20px; border-right: 1px solid #ddd;">
            <h2><?php esc_html_e('Available Functions', 'your-theme-textdomain'); ?></h2>
            <p><?php esc_html_e('Select functions to execute:', 'your-theme-textdomain'); ?></p>
            <form id="riester-dev-tools-form" method="post" action="">
                <!-- List of functions with checkboxes -->
                <label>
                    <input type="checkbox" name="functions[]" value="create_pages" checked>
                    <?php esc_html_e('Create Pages', 'your-theme-textdomain'); ?>
                </label>
                <!-- Future checkboxes for additional functions will go here -->
            </form>
        </div>
        
        <!-- Main content area (2/3) with button and progress bar -->
        <div style="width: 70%; padding-left: 20px;">
            <h2><?php esc_html_e('Execution', 'your-theme-textdomain'); ?></h2>
            <p><?php esc_html_e('Click "Run Selected" to execute the selected functions.', 'your-theme-textdomain'); ?></p>
            <button type="submit" id="run-selected" class="button button-primary"><?php esc_html_e('Run Selected', 'your-theme-textdomain'); ?></button>
            
            <div id="progress-bar" style="width: 100%; background: #f3f3f3; margin-top: 20px; height: 20px;">
                <div id="progress" style="width: 0%; height: 100%; background: #4CAF50;"></div>
            </div>
            <div id="result-message" style="margin-top: 20px;"></div>
        </div>
    </div>

    <script type="text/javascript">
        document.getElementById('run-selected').addEventListener('click', function(event) {
            event.preventDefault();
            
            const checkboxes = document.querySelectorAll('#riester-dev-tools-form input[type="checkbox"]:checked');
            const functions = Array.from(checkboxes).map(checkbox => checkbox.value);
            const progressBar = document.getElementById('progress');
            const resultMessage = document.getElementById('result-message');
            let width = 0;

            if (functions.length === 0) {
                resultMessage.textContent = 'Please select at least one function to run.';
                return;
            }

            const interval = setInterval(function() {
                if (width >= 100) {
                    clearInterval(interval);
                } else {
                    width += 10;
                    progressBar.style.width = width + '%';
                }
            }, 100);

            // AJAX request to execute the selected functions
            fetch(ajaxurl, {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `action=run_riester_dev_tool&functions=${JSON.stringify(functions)}`,
            })
            .then(response => response.json())
            .then(data => {
                resultMessage.textContent = data.success ? data.data : data.data;
                progressBar.style.width = '100%';
            });
        });
    </script>
    <?php
}

// Add AJAX handler to process the selected functions
add_action('wp_ajax_run_riester_dev_tool', 'run_riester_dev_tool');

// Handle AJAX request to execute selected functions
function run_riester_dev_tool() {
    $functions = isset($_POST['functions']) ? json_decode(stripslashes($_POST['functions']), true) : [];

    $responses = [];
    foreach ($functions as $function_name) {
        if ($function_name === 'create_pages') {
            create_riester_pages();
            $responses[] = 'Pages created successfully.';
        }
        // Future functions can be added here
    }

    if (!empty($responses)) {
        wp_send_json_success(implode(' ', $responses));
    } else {
        wp_send_json_error('No valid functions selected.');
    }
    wp_die(); // Required to terminate AJAX requests properly
}