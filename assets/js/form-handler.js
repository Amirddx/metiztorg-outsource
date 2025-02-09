document.addEventListener("DOMContentLoaded", function () {
    const citizenshipSelect = document.getElementById("citizenship");
    const docRussia = document.querySelector(".doc-russia");
    const docForeign = document.querySelector(".doc-foreign");

    function toggleDocuments() {
        if (citizenshipSelect.value === "Россия") {
            docRussia.classList.remove("d-none");
            docForeign.classList.add("d-none");
        } else {
            docRussia.classList.add("d-none");
            docForeign.classList.remove("d-none");
        }
    }

    citizenshipSelect.addEventListener("change", toggleDocuments);
    toggleDocuments();

    document.querySelectorAll(".file-upload").forEach(upload => {
        const input = upload.querySelector(".file-input");
        const previewContainer = upload.querySelector(".file-preview-container");
        const button = upload.querySelector(".file-btn");

        button.addEventListener("click", function () {
            input.click();
        });

        input.addEventListener("change", function () {
            previewContainer.innerHTML = "";

            if (this.files.length > 0) {
                Array.from(this.files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        let preview = document.createElement("div");
                        preview.classList.add("file-preview");

                        if (file.type.startsWith("image/")) {
                            preview.innerHTML = `<img src="${e.target.result}" class="file-preview-img">`;
                        } else {
                            preview.innerHTML = `<i class="bi bi-file-earmark-pdf file-preview-icon"></i>`;
                        }

                        let removeBtn = document.createElement("button");
                        removeBtn.classList.add("file-remove");
                        removeBtn.innerHTML = `<i class="bi bi-x-circle"></i>`;
                        removeBtn.addEventListener("click", () => previewContainer.innerHTML = "");

                        preview.appendChild(removeBtn);
                        previewContainer.appendChild(preview);
                    };
                    reader.readAsDataURL(file);
                });
            }
        });
    });
});
