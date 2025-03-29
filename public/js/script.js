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

    function togglePassword(event, inputId) {
        event.stopPropagation();
        const passwordInput = document.getElementById(inputId);
        const toggleIcon = document.querySelector(`[data-toggle-id="${inputId}"]`);
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleIcon.innerHTML = ` <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32"><g fill="none">
                <path fill="#9b9b9b" d="M9.528 7a8.5 8.5 0 0 0-8.5 8.5v7a8.5 8.5 0 0 0 15 5.477a8.5 8.5 0 0 0 15-5.477v-7a8.5 8.5 0 0 0-15-5.477A8.48 8.48 0 0 0 9.528 7"/><path fill="#fff" d="M9.528 8a7.5 7.5 0 0 0-7.5 7.5v7a7.5 7.5 0 0 0 14 3.744a7.5 7.5 0 0 0 14-3.744v-7a7.5 7.5 0 0 0-14-3.744A7.5 7.5 0 0 0 9.528 8"/>
                <path fill="#d3d3d3" d="M15.028 15.5c0-1.364.364-2.642 1-3.744A7.53 7.53 0 0 0 12.226 8.5h-.167c1.094.656 1.938 3.25 1.938 4.5v12.125c0 1.375-.157 3.093-1.937 4.437a7.53 7.53 0 0 0 3.968-3.318a7.47 7.47 0 0 1-1-3.744zm15 0a7.5 7.5 0 0 0-4.802-7h-.167c1.656 1.094 2.906 3.063 2.906 4.531V25c0 1.375-1.124 3.218-2.905 4.562a7.5 7.5 0 0 0 4.968-7.062z"/>
                <path fill="#321b41" d="M6.59 13a3.5 3.5 0 0 0-3.5 3.5v5a3.5 3.5 0 1 0 7 0v-5a3.5 3.5 0 0 0-3.5-3.5m12.938 0a3.5 3.5 0 0 0-3.5 3.5v5a3.5 3.5 0 1 0 7 0v-5a3.5 3.5 0 0 0-3.5-3.5"/><path fill="#f4f4f4" d="M8.766 16.861c.372-.31.355-.942-.038-1.414s-1.012-.603-1.384-.294s-.354.942.039 1.414c.392.471 1.012.603 1.383.294m12.997 0c.371-.31.354-.942-.039-1.414s-1.012-.603-1.383-.294c-.372.309-.354.942.038 1.414c.393.471 1.012.603 1.384.294"/></g>
                </svg> `;
        } else {
            passwordInput.type = "password";
            toggleIcon.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32">
            <path fill="currentColor" d="M9.5 7A8.5 8.5 0 0 0 1 15.5v7a8.5 8.5 0 0 0 15 5.477A8.5 8.5 0 0 0 31 22.5v-7a8.5 8.5 0 0 0-15-5.477A8.48 8.48 0 0 0 9.5 7m5.345 4.8A8.5 8.5 0 0 0 14 15.5v7c0 1.326.304 2.581.845 3.7A6.5 6.5 0 0 1 3 22.5v-1a3.5 3.5 0 1 0 7 0v-5a3.5 3.5 0 1 0-7 0v-1a6.5 6.5 0 0 1 11.845-3.7M16 15.5a6.5 6.5 0 1 1 13 0v7a6.5 6.5 0 1 1-13 0v-1a3.5 3.5 0 1 0 7 0v-5a3.5 3.5 0 1 0-7 0zm-7.324 1.361c-.371.31-.99.177-1.383-.294c-.393-.472-.41-1.105-.039-1.414c.372-.31.991-.178 1.384.294s.41 1.105.038 1.414m13.02-1.414c.393.472.41 1.105.04 1.414c-.372.31-.992.177-1.384-.294c-.393-.472-.41-1.105-.039-1.414c.372-.31.991-.178 1.384.294"/>
            </svg>
            `;
        }
    }


function closeModal() {
    document.querySelectorAll(".sec_modal").forEach(modal => {
        modal.style.display = "none";
    });

    const targetModal = event.target.getAttribute("data-target");
    if (targetModal) {
        document.getElementById(targetModal).style.display = "block";
    }
}
document.querySelectorAll(".deletelink, .deleteheader, .deletesocials, .deletepostimage, .deletepostblog").forEach(function (deleteButton) {
    deleteButton.addEventListener("click", function () {
        let id = this.getAttribute("data-id");

        let typedata;
        let route;

        if (this.classList.contains("deletesocials")) {
            route = `/deletesocial/${id}`;
            typedata = "social";
        } else if (this.classList.contains("deleteheader")) {
            route = `/deleteheader/${id}`;
            typedata = "header";
        } else if (this.classList.contains("deletelink")) {
            route = `/deletelink/${id}`;
            typedata = "link";
        } else if (this.classList.contains("deletepostimage")) {
            route = `/deletepostimage/${id}`;
            typedata = "postimage";
        } else if (this.classList.contains("deletepostblog")) {
            route = `/deletepostblog/${id}`;
            typedata = "postblog";
        }
        
        fetch(route, {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            },

        })
        .then(response => response.json())

        .then(data => {

            let parentElement = this.closest(".data-item");
            if (parentElement) {
                parentElement.remove();
            }

            const iframe = document.querySelector('iframe');
            if (iframe && iframe.contentWindow) {
                iframe.contentWindow.postMessage({
                    action: 'deleteposition',
                    id: id,
                    typedata: typedata 
                }, '*'); 
            }

        })
   
        .catch(error => console.error(`❌ ERROR: Fetch gagal (${route}):`, error));
    });
});

document.querySelectorAll(".switch-link, .switch-header, .switch-socials, .switch-postimage, .switch-postblog").forEach(function (switchInput) {
    switchInput.addEventListener("change", function () {
        let id = this.getAttribute("data-id");
        let status = this.checked ? "on" : "off";
        let typedata;
        let route;

        if (this.classList.contains("switch-socials")) {
            route = `/hidesocial/${id}`;
            typedata = "social";
        } else if (this.classList.contains("switch-header")) {
            route = `/hideheader/${id}`;
            typedata = "header";
        } else if (this.classList.contains("switch-link")) {
            route = `/hidelink/${id}`;
            typedata = "link";
        } else if (this.classList.contains("switch-postimage")) {
            route = `/hidepostimage/${id}`;
            typedata = "postimage";
        } else if (this.classList.contains("switch-postblog")) {
            route = `/hidepostblog/${id}`;
            typedata = "postblog";
        }

        fetch(route, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            },
            body: JSON.stringify({ hide: status })
        })
        .then(response => response.json())
        .then(data => {
            const iframe = document.querySelector('iframe');
            if (iframe && iframe.contentWindow) {
                iframe.contentWindow.postMessage({
                    action: 'hidestatus',
                    id: id,
                    status: status,
                    typedata: typedata
                }, '*'); 
            }

        })
        .catch(error => console.error(`❌ ERROR: Fetch gagal (${route}):`, error));
    });
});

$(document).ready(function () {
    $(document).on('click', '.dot_action', function () {
        var actionCrud = $(this).next('.action_crud');
        $('.action_crud').not(actionCrud).slideUp('fast');
        if (actionCrud.is(':hidden')) {
            actionCrud.slideDown('fast');
        } else {
            actionCrud.slideUp('fast');
        }
    });
    $(document).on('click', function (event) {
        if (!$(event.target).closest('.dot_action, .action_crud').length) {
            $('.action_crud').slideUp('fast');
        }
    });
});
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
        event.preventDefault();

        const form = document.getElementById("linkForm");
        const formData = new FormData(form);
        const errorElement  = form.querySelector(".error-message");
        const csrfToken = document.querySelector('input[name="_token"]').value;
        const idlink = formData.get("idlink")?.trim();
        const switchSocials = document.getElementById("switch-embed");
        const embedInput = document.getElementById("hiddenStatus");
        embedInput.value = switchSocials.checked ? "on" : "off";
        formData.set("embed", embedInput.value);

        const title = formData.get("title").trim();
        const url = formData.get("url").trim();
        const image = formData.get("profile-img-upload");
    
        if (!title || title.length < 1) return showErrorMessage("Nama link wajib diisi.", errorElement);
        if (title.length > 20) return showErrorMessage("Nama link maksimal 20 karakter.", errorElement);
        if (!url || url.length < 1) return showErrorMessage("URL wajib diisi.", errorElement);
        if (!isValidUrl(url)) return showErrorMessage("Format URL tidak valid.", errorElement);
        if (image && image.size > 10 * 1024 * 1024) return showErrorMessage("Ukuran file maksimal 10MB.", errorElement);
        const urlEndpoint = idlink ? "updatelink" : "createlink";

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
                window.location.href = "/links";
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
            event.preventDefault();

            const form = document.getElementById("socialsForm");
            const formData = new FormData(form);
            const errorElement  = form.querySelector(".error-message");
            const csrfToken = document.querySelector('input[name="_token"]').value;
            const idsocial = formData.get("idsocial")?.trim();
            const url = formData.get("url")?.trim();
            const socialName = formData.get("title")?.trim(); 
            const specialEmailTypes = ["Email", "Github", "Linkedin"];
            const specialPhoneTypes = ["Whatsapp", "Telegram"];
        
            if (specialEmailTypes.includes(socialName)) {
                if (!url || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(url)) {
                    return showErrorMessage("Format email tidak valid.", errorElement);
                }
            } else if (specialPhoneTypes.includes(socialName)) {
                if (!url || !/^\+62\d{9,15}$/.test(url)) {
                    return showErrorMessage("Nomor harus diawali dengan +62 dan minimal 9 digit.", errorElement);
                }
            } else {
                if (!url || url.length < 1) return showErrorMessage("URL wajib diisi.", errorElement);
                if (!isValidUrl(url)) return showErrorMessage("Format URL tidak valid.", errorElement);
            }
            const urlEndpoint = idsocial ? "updatesocials" : "createsocials";
  
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
                    window.location.href = "/links";
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
        event.preventDefault();

        const form = document.getElementById("headerForm");
        const formData = new FormData(form);
        const errorElement  = form.querySelector(".error-message");
        const csrfToken = document.querySelector('input[name="_token"]').value;
        const title = formData.get("title").trim();
        const idheader = formData.get("idheader")?.trim();

        if (!title || title.length < 1) return showErrorMessage("Nama header wajib diisi.", errorElement);

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
                window.location.href = "/links";
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

const passwordInput = document.getElementById('password');
const rules = {
    length: document.getElementById('length-rule'),
    number: document.getElementById('number-rule'),
    lowercase: document.getElementById('lowercase-rule'),
    uppercase: document.getElementById('uppercase-rule')
};
const confirmContainer = document.querySelector('.konfirmasi-password');

passwordInput.addEventListener('input', function () {
    const value = passwordInput.value;
    const isLengthValid = value.length >= 8;
    const hasNumber = /\d/.test(value);
    const hasLower = /[a-z]/.test(value);
    const hasUpper = /[A-Z]/.test(value);

    if (value.length > 0) {
        Object.values(rules).forEach(rule => rule.style.display = 'list-item');
    } else {
        Object.values(rules).forEach(rule => rule.style.display = 'none');
    }

    rules.length.style.color    = isLengthValid ? 'green' : 'red';
    rules.number.style.color    = hasNumber     ? 'green' : 'red';
    rules.lowercase.style.color = hasLower      ? 'green' : 'red';
    rules.uppercase.style.color = hasUpper      ? 'green' : 'red';

    if (isLengthValid && hasNumber && hasLower && hasUpper) {
        confirmContainer.style.display = 'block';
        rules.length.style.display = 'none';
        rules.number.style.display = 'none';
        rules.lowercase.style.display = 'none';
        rules.uppercase.style.display = 'none';
    } else {
        confirmContainer.style.display = 'none';
        // rules.length.style.display = 'block';
        // rules.number.style.display = 'block';
        // rules.lowercase.style.display = 'block';
        // rules.uppercase.style.display = 'block';
    }
});


document.addEventListener("DOMContentLoaded", function () {
    const flashModals = [
        { key: 'success', targetId: 'shownotifsuccess' },
        { key: 'error', targetId: 'shownotiferror' },
        { key: 'successwithcontent', targetId: 'shownotifwithcontent' }
    ];

    flashModals.forEach(flash => {
        const message = sessionStorage.getItem(flash.key);
        if (message) {
            const targetModal = document.getElementById(flash.targetId);
            if (targetModal) {
                targetModal.style.display = 'flex'; 
                const span = targetModal.querySelector('.formsubnotif span');
                if (span) {
                    span.textContent = message;
                }
            }
            sessionStorage.removeItem(flash.key);
        }
    });
});