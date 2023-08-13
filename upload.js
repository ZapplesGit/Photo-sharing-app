// upload.js
// Use the DOMContentLoaded event to ensure the page is fully loaded before attaching event listeners
document.addEventListener("DOMContentLoaded", function () {
    const uploadForm = document.getElementById("uploadForm");
    const titleInput = document.getElementById("title");
    const descriptionInput = document.getElementById("description");

    // Add an event listener to the form submission
    uploadForm.addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent the default form submission behavior

        // Create a new FormData object to collect form data
        const formData = new FormData(uploadForm);

        // Create a new XMLHttpRequest object
        const xhr = new XMLHttpRequest();

        // Configure the request
        xhr.open("POST", "upload.php", true);

        // Handle the response from the server
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Display the server response in the status div
                    document.getElementById("status").innerHTML = xhr.responseText;
                    // Clear the form after successful upload (optional)
                    uploadForm.reset();
                } else {
                    // Handle errors if necessary
                    document.getElementById("status").innerHTML = "Error occurred during upload.";
                }
            }
        };

        xhr.send(formData);
    });

    // Add an event listener to the description textarea to count the characters
    descriptionInput.addEventListener("input", function () {
        const maxDescriptionChars = 200; // Replace with your desired maximum character count
        const description = this.value;

        if (description.length > maxDescriptionChars) {
            this.value = description.substring(0, maxDescriptionChars);
        }
    });

    // Add an event listener to the title input to count the characters
    titleInput.addEventListener("input", function () {
        const maxTitleChars = 50; // Replace with your desired maximum character count
        const title = this.value;

        if (title.length > maxTitleChars) {
            this.value = title.substring(0, maxTitleChars);
        }
    });
});
