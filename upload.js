document.addEventListener("DOMContentLoaded", function () {
  const uploadForm = document.getElementById("uploadForm");
  const titleInput = document.getElementById("title");
  const descriptionInput = document.getElementById("description");

  uploadForm.addEventListener("submit", function (event) {
    event.preventDefault();

    const formData = new FormData(uploadForm);

    const xhr = new XMLHttpRequest();

    xhr.open("POST", "upload.php", true);

    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          document.getElementById("status").textContent = xhr.responseText;
          uploadForm.reset();
        } else {
          // Handle errors if necessary
          document.getElementById("status").textContent = "Error occurred during upload.";
        }
      }
    };

    xhr.send(formData);
  });

  descriptionInput.addEventListener("input", function () {
    const maxDescriptionChars = 300; 
    const description = this.value;

    if (description.length > maxDescriptionChars) {
      this.value = description.substring(0, maxDescriptionChars);
    }
  });

  titleInput.addEventListener("input", function () {
    const maxTitleChars = 50; 
    const title = this.value;

    if (title.length > maxTitleChars) {
      this.value = title.substring(0, maxTitleChars);
    }
  });
});
