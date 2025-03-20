// function ensureLivewireLoaded(callback) {
//     if (typeof Livewire !== 'undefined' && Livewire.hookComponentsBooted) {
//         Livewire.hookComponentsBooted(() => {
//             callback();
//         });
//     } else {
//         console.warn("⏳ Livewire belum ter-load, mencoba lagi...");
//         setTimeout(() => ensureLivewireLoaded(callback), 500);
//     }
// }

// ensureLivewireLoaded(() => {
//     console.log("🟢 Livewire siap, mengirim event...");
//     Livewire.emit('updateOrder', positions);
// });
//----------------------------------------------------------------------------
//     $(document).ready(function () {
 
//     $(document).on('click', '.triggermodal', function () {
//         var target = $(this).data('target');
//         $('#' + target).css('display', 'flex');
//     });

//     $(document).on('click', '.closemodal', function () {
//         $(this).closest('.sec_modal ').css('display', 'none');
//     });
//     $(document).on('click', '.closemodal', function () {
//         $(this).closest('.sec_content ').css('display', 'none');
//     });
//     $(document).on('click', function (event) {
//         // event.preventDefault();
//         var target = $(event.target);
//         if (!target.closest('.modalcontainer').length && !target.closest('.triggermodal').length) {
//             $('.sec_modal').css('display', 'none');
//         }
//         if (!target.closest('.modalcontainer').length && !target.closest('.triggermodal').length) {
//             $('.sec_content').css('display', 'none');
//         }
//     });
// });
//--------------------------------------------
    $(document).ready(function () {
        $(document).on('click', '.triggermodal', function () {
            var target = $(this).data('target');
            $('#' + target).css('display', 'flex');
        });
    
        $(document).on('click', '.closemodal', function () {
            $(this).closest('.sec_modal ').css('display', 'none');
        });
        $(document).on('click', '.closemodal', function () {
            $(this).closest('.sec_content ').css('display', 'none');
        });
        $(document).on('click', function (event) {
            var target = $(event.target);
        
            if (
                !target.closest('.modalcontainer').length &&
                !target.closest('.triggermodal').length &&
                !target.closest('.delete-label').length
            ) {
                $('.sec_modal, .sec_content').css('display', 'none');
            }
        });
        
    });

// $(document).on('click', function (event) {
//     var target = $(event.target);
//     if (!target.closest('.modalcontainer').length && !target.closest('.triggermodal').length) {
//         $('.sec_modal').css('display', 'none');
//     }
//     if (!target.closest('.modalcontainer').length && !target.closest('.triggermodal').length) {
//         $('.sec_content').css('display', 'none');
//     }
// });
// $(document).on('click', function (event) {
//     var target = $(event.target);

//     if (
//         !target.closest('.modalcontainer').length &&
//         !target.closest('.triggermodal').length &&
//         !target.closest('.delete-label').length
//     ) {
//         $('.sec_modal, .sec_content').css('display', 'none');
//     }
// });

function closeModal() {
    document.querySelectorAll(".sec_modal").forEach(modal => {
        modal.style.display = "none";
    });

    const targetModal = event.target.getAttribute("data-target");
    if (targetModal) {
        document.getElementById(targetModal).style.display = "block";
    }
}
document.addEventListener('DOMContentLoaded', () => {
    const successModal = document.getElementById('shownotifsuccess');
    const errorModal = document.getElementById('shownotifwrong');
    const contentModal = document.getElementById('showcontent');
        if (successModal) {
            setTimeout(() => {
                successModal.style.display = 'none';
            }, 2000);
        }
        else if (errorModal) {
            setTimeout(() => {
                errorModal.style.display = 'none';
            }, 3000);
        }
        else if (contentModal) {
            setTimeout(() => {
                contentModal.style.display = 'none';
            }, 6000);
        }
});

//-----------------------------------------------------------------------------------------
function showErrorMessage(message, errorElement) {
    if (!errorElement) {
        console.error("❌ Error: Elemen pesan error tidak ditemukan.");
        return;
    }
    errorElement.textContent = message;
    errorElement.style.display = "block";

    setTimeout(() => {
        errorElement.style.display = "none";
    }, 2000);
}
document.addEventListener("DOMContentLoaded", function () {
    
    document.getElementById("submitFormlink").addEventListener("click", function (event) {
        event.preventDefault(); // Mencegah reload halaman

        const form = document.getElementById("linkForm");
        const formData = new FormData(form);
        const errorElement  = form.querySelector(".error-message");
        // const formData = new FormData(document.getElementById("linkForm"));
        // const errorMessage = document.getElementById("Error");
        const csrfToken = document.querySelector('input[name="_token"]').value;
        // // ✅ 1. Validasi di JavaScript sebelum mengirim ke server
        // console.log("CSRF Token:", csrfToken);
        // console.log("CS3123123123123n:");
        const idlink = formData.get("idlink")?.trim();
        // ✅ Pastikan nilai embed diperbarui sebelum submit
        const switchSocials = document.getElementById("switch-embed");
        const embedInput = document.getElementById("hiddenStatus");
        embedInput.value = switchSocials.checked ? "on" : "off";

          // ✅ Tambahkan nilai embed ke FormData (pastikan masuk ke backend)
        formData.set("embed", embedInput.value);

        const title = formData.get("title").trim();
        const url = formData.get("url").trim();
        const image = formData.get("profile-img-upload");
       
       
        console.log(idlink);
        // const image = document.getElementById("profile-img-upload").files[0]; // Ambil file dari input
        // if (title.length < 1) {
        //     showErrorMessage("Nama link wajib diisi.");
        //     return;
        // }
        // if (title.length > 20) {
        //     showErrorMessage("Nama link maksimal 20 karakter.");
        //     return;
        // }
        // if (url.length < 1) {
        //     showErrorMessage("URL wajib diisi.");
        //     return;
        // }
        // if (!isValidUrl(url)) {
        //     showErrorMessage("Format URL tidak valid.");
        //     return;
        // }

        // if (image && image.size > 10240 * 1024) {
        //     showErrorMessage("Ukuran file maksimal 10MB.");
        //     return;
        // }
        if (!title || title.length < 1) return showErrorMessage("Nama link wajib diisi.", errorElement);
        if (title.length > 20) return showErrorMessage("Nama link maksimal 20 karakter.", errorElement);
        if (!url || url.length < 1) return showErrorMessage("URL wajib diisi.", errorElement);
        if (!isValidUrl(url)) return showErrorMessage("Format URL tidak valid.", errorElement);
        if (image && image.size > 10 * 1024 * 1024) return showErrorMessage("Ukuran file maksimal 10MB.", errorElement);
        const urlEndpoint = idlink ? "updatelink" : "createlink";
        console.log("✅ Form lolos validasi, mengirim ke backend...");
        // form.submit();
        // ✅ 2. Kirim data ke Laravel menggunakan Fetch API
        console.log("✅ Form lolos validasi, mengirim ke backend...");
        console.log("📌 Embed Status:", formData.get("embed")); // Debugging
        fetch(urlEndpoint, {
            method: "POST",
            body: formData,
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = "/links"; // Redirect setelah sukses
            } else {
                showErrorMessage(data.message || "Terjadi kesalahan.", errorElement);
            }
        })
        .catch(error => {
            console.error("Error:", error);
            showErrorMessage("Terjadi kesalahan saat menyimpan data.", errorElement);
        });
        });
            document.getElementById("submitFormsocials").addEventListener("click", function (event) {
            event.preventDefault(); // Mencegah reload halaman

            const form = document.getElementById("socialsForm");
            const formData = new FormData(form);
            const errorElement  = form.querySelector(".error-message");
            const csrfToken = document.querySelector('input[name="_token"]').value;

            const idsocial = formData.get("idsocial")?.trim();
            const url = formData.get("url").trim();
            if (!url || url.length < 1) return showErrorMessage("URL wajib diisi.", errorElement);
            if (!isValidUrl(url)) return showErrorMessage("Format URL tidak valid.", errorElement);
            const urlEndpoint = idsocial ? "updatesocials" : "createsocials";
            // if (url.length < 1) {
            //     showErrorMessage("Nama link wajib diisi.");
            //     return;
            // }
            // if (!isValidUrl(url)) {
            //     showErrorMessage("Format URL tidak valid.");
            //     return;
            // }
            // form.submit();
            fetch(urlEndpoint, {
                method: "POST",
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = "/links"; // Redirect setelah sukses
                } else {
                    showErrorMessage(data.message || "Terjadi kesalahan.", errorElement);
                }
            })
            .catch(error => {
                console.error("Error:", error);
                showErrorMessage("Terjadi kesalahan saat menyimpan data.", errorElement);
            });
    });  
        document.getElementById("submitFormheader").addEventListener("click", function (event) {
        event.preventDefault(); // Mencegah reload halaman

        const form = document.getElementById("headerForm");
        const formData = new FormData(form);
        const errorElement  = form.querySelector(".error-message");
        const csrfToken = document.querySelector('input[name="_token"]').value;
        const title = formData.get("title").trim();
        const idheader = formData.get("idheader")?.trim();
        // if (title.length < 1) {
        //     showErrorMessage("Nama link wajib diisi.");
        //     return;
        // }
        if (!title || title.length < 1) return showErrorMessage("Nama header wajib diisi.", errorElement);
        // form.submit();
        const urlEndpoint = idheader ? "updateheader" : "createheader";
        fetch(urlEndpoint, {
            method: "POST",
            body: formData,
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = "/links"; // Redirect setelah sukses
            } else {
                showErrorMessage(data.message || "Terjadi kesalahan.", errorElement);
            }
        })
        .catch(error => {
            console.error("Error:", error);
            showErrorMessage("Terjadi kesalahan saat menyimpan data.", errorElement);
        });
    });
});   

// function showErrorMessage(message) {
//     const errorMessage = document.getElementById("Error");
//     errorMessage.textContent = message;
//     errorMessage.style.display = "block";
//     setTimeout(() => {
//         errorMessage.style.display = "none";
//     }, 2000);
// }

// ✅ Fungsi untuk validasi URL
function isValidUrl(string) {
    try {
        new URL(string);
        return true;
    } catch (_) {
        return false;
    }
}


function showErrorMessage(message, errorElement) {
    if (!errorElement) {
        console.error("❌ Error: Elemen pesan error tidak ditemukan.");
        return;
    }
    errorElement.textContent = message;
    errorElement.style.display = "block";

    setTimeout(() => {
        errorElement.style.display = "none";
    }, 2000);
}

// document.addEventListener("DOMContentLoaded", function () {
    
//     document.getElementById("submitFormlink").addEventListener("click", function (event) {
//         event.preventDefault(); // Mencegah reload halaman

//         const form = document.getElementById("linkForm");
//         const formData = new FormData(form);
//         const errorElement = form.querySelector(".error-message"); // ✅ Ambil elemen error dalam form ini

//         const title = formData.get("title")?.trim();
//         const url = formData.get("url")?.trim();
//         const image = formData.get("profile-img-upload");

//         if (!title || title.length < 1) return showErrorMessage("Nama link wajib diisi.", errorElement);
//         if (title.length > 20) return showErrorMessage("Nama link maksimal 20 karakter.", errorElement);
//         if (!url || url.length < 1) return showErrorMessage("URL wajib diisi.", errorElement);
//         if (!isValidUrl(url)) return showErrorMessage("Format URL tidak valid.", errorElement);
//         if (image && image.size > 10 * 1024 * 1024) return showErrorMessage("Ukuran file maksimal 10MB.", errorElement);

//         console.log("✅ Form lolos validasi, mengirim ke backend...");
//         form.submit();
//     });

//     document.getElementById("submitFormsocials").addEventListener("click", function (event) {
//         event.preventDefault(); // Mencegah reload halaman

//         const form = document.getElementById("socialsForm");
//         const formData = new FormData(form);
//         const errorElement = form.querySelector(".error-message");

//         const url = formData.get("url")?.trim();
//         if (!url || url.length < 1) return showErrorMessage("URL wajib diisi.", errorElement);
//         if (!isValidUrl(url)) return showErrorMessage("Format URL tidak valid.", errorElement);

//         form.submit();
//     });

//     document.getElementById("submitFormheader").addEventListener("click", function (event) {
//         event.preventDefault(); // Mencegah reload halaman

//         const form = document.getElementById("headerForm");
//         const formData = new FormData(form);
//         const errorElement = form.querySelector(".error-message");

//         const title = formData.get("title")?.trim();
//         if (!title || title.length < 1) return showErrorMessage("Nama header wajib diisi.", errorElement);

//         form.submit();
//     });
// });

// // ✅ Fungsi untuk validasi URL
// function isValidUrl(string) {
//     try {
//         new URL(string);
//         return true;
//     } catch (_) {
//         return false;
//     }
// }

//------------------------------------------------------------------------------------------
// document.addEventListener("DOMContentLoaded", function () {
//     let headersList = document.getElementById("headersList");
//     let linksList = document.getElementById("linksList");

//     let sortableHeaders = new Sortable(headersList, {
//         group: "shared", // Memungkinkan draggable antara tabel
//         animation: 150,
//         onEnd: function (evt) {
//             updatePositions(); // 🔥 Update posisi saat elemen dipindahkan
//         }
//     });

//     let sortableLinks = new Sortable(linksList, {
//         group: "shared",
//         animation: 150,
//         onEnd: function (evt) {
//             updatePositions();
//         }
//     });

//     function updatePositions() {
//         let allItems = document.querySelectorAll(".sortable-item");
//         let positions = [];

//         allItems.forEach((item, index) => {
//             positions.push({
//                 id: item.dataset.id,
//                 type: item.dataset.type, // Menentukan apakah ini dari `headers` atau `links`
//                 position: index + 1
//             });
//         });

//         // Kirim data ke backend via AJAX
//         fetch("/update-position", {
//             method: "POST",
//             headers: {
//                 "Content-Type": "application/json",
//                 "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
//             },
//             body: JSON.stringify({ positions })
//         })
//         .then(response => response.json())
//         .then(data => {
//             console.log("Posisi diperbarui!", data);
//         })
//         .catch(error => console.error("Error:", error));
//     }
// });


//------------------------------------------------------------------------------
// document.addEventListener("DOMContentLoaded", function () {
//     const containers = document.querySelectorAll(".profil-addlink, .profil-canvas");

//     containers.forEach(container => {
//         const fileInput = container.querySelector(".profile-img-upload");
//         const deleteIcon = container.querySelector(".delete-icon");

//         if (deleteIcon) {
//             deleteIcon.addEventListener("click", function (event) {
//                 event.stopPropagation();
//                 removeImage(container);
//             });
//         }

//         if (fileInput) {
//             fileInput.addEventListener("change", function () {
//                 previewImage(container, this);
//             });
//         }
//     });
// });

// function previewImage(container, fileInput) {
//     const file = fileInput.files[0];
//     if (!file) return;

//     const validTypes = ["image/jpeg", "image/png", "image/gif", "image/webp", "image/svg+xml"];
//     if (!validTypes.includes(file.type)) {
//         alert("Hanya file gambar yang diperbolehkan (JPEG, PNG, GIF, WEBP, SVG)");
//         fileInput.value = "";
//         return;
//     }

//     const reader = new FileReader();
//     reader.onload = function (e) {
//         removeImage(container);

//         const profilImgDiv = document.createElement("div");
//         profilImgDiv.classList.add(container.classList.contains("profil-addlink") ? "img-addlink" : "profil-img");

//         const deleteIcon = document.createElement("div");
//         deleteIcon.classList.add("delete-icon");
//         deleteIcon.innerHTML = `<svg><circle cx="12" cy="12" r="11" fill="#0D0C22" stroke="white" stroke-width="2"></circle></svg>`;

//         deleteIcon.addEventListener("click", function (event) {
//             event.stopPropagation();
//             removeImage(container);
//         });

//         const imgElement = document.createElement("img");
//         imgElement.src = e.target.result;
//         imgElement.alt = "Preview";
//         imgElement.name = "img";

//         profilImgDiv.appendChild(deleteIcon);
//         profilImgDiv.appendChild(imgElement);
//         container.appendChild(profilImgDiv);
//     };

//     reader.readAsDataURL(file);
// }

// function removeImage(container) {
//     const existingPreview = container.querySelector(".img-addlink, .profil-img");
//     if (existingPreview) existingPreview.remove();

//     const newFileInput = document.createElement("input");
//     newFileInput.type = "file";
//     newFileInput.classList.add("profile-img-upload", "p-b-wrap", "absolute", "opacity-0", "cursor-pointer");
//     newFileInput.accept = "image/*";
//     newFileInput.name = "images";
//     newFileInput.addEventListener("change", function () {
//         previewImage(container, this);
//     });

//     container.appendChild(newFileInput);
// }
