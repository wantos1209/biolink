
<div id="showcontent" class="sec_content" >
    <div class="modalcontainer">

    <div class="formcontent bg-white ">
        <div class="judul_login align-center">
            <h1>Your Bio link</h1>
        </div>

        <div class="">    
            <div class="list_input align-center">
                <span>{{ session('successwithcontent') }}</span>
                <span>Add it to your Instagram bio, Twitter, TikTok, YouTube, and wherever your audience are.</span>
            </div>
        </div>

        <div class="mt-26 text-32 text-gradient align-center" >
            <span id="copyText" class="hover:underline">{{ config('app.APP_URL') .  '/' . Auth::user()->username }}</span>
        </div>
        <div class="h-60">
            <button class="h-60 bl-btn bl-btn-md btn_submit text-white flexcenter" onclick="copyToClipboard()">
                <svg data-v-4dc33573="" width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg" class="inline mr-8"><path data-v-4dc33573="" fill-rule="evenodd" clip-rule="evenodd" d="M5.50946 2.8488L7.29007 1.1116C8.85933 -0.373699 11.3169 -0.37009 12.8817 1.11981C14.4239 2.66745 14.4239 5.17088 12.8817 6.71852L11.1516 8.49209C10.9331 8.72153 10.6082 8.81581 10.3009 8.73893C9.9936 8.66206 9.75135 8.42589 9.66667 8.12064C9.582 7.81538 9.66798 7.48817 9.89178 7.26397L11.629 5.48218C12.2065 4.93247 12.4412 4.11328 12.2426 3.34113C12.0439 2.56899 11.4429 1.96483 10.6718 1.76209C9.90076 1.55935 9.08034 1.78978 8.52758 2.36436L6.73641 4.10978C6.38724 4.44232 5.83544 4.43181 5.49918 4.08622C5.16291 3.74063 5.1675 3.18876 5.50946 2.8488ZM5.47796 11.6337L7.26913 9.88708C7.61831 9.55454 8.1701 9.56505 8.50636 9.91064C8.84263 10.2562 8.83805 10.8081 8.49609 11.1481L6.71548 12.8829C5.16171 14.3903 2.68529 14.3701 1.1563 12.8376C-0.372686 11.3051 -0.387165 8.82863 1.1238 7.27834L2.85397 5.50477C3.19436 5.16377 3.74571 5.16001 4.09071 5.49634C4.43571 5.83267 4.44599 6.38394 4.11377 6.73289L2.37656 8.51468C1.80986 9.06672 1.58332 9.8806 1.7833 10.646C1.98328 11.4115 2.57896 12.0106 3.34327 12.2149C4.10758 12.4192 4.92272 12.1972 5.47796 11.6337Z" fill="#222222"></path> <path data-v-4dc33573="" d="M4.03912 9.96655C4.20377 10.1319 4.42748 10.2248 4.66081 10.2248C4.89414 10.2248 5.11785 10.1319 5.2825 9.96655L9.97449 5.27456C10.2033 5.05379 10.2952 4.72674 10.2148 4.41912C10.1344 4.1115 9.89433 3.87117 9.58678 3.79052C9.27924 3.70986 8.9521 3.80143 8.73111 4.03001L4.03912 8.722C3.87401 8.887 3.78125 9.11086 3.78125 9.34428C3.78125 9.5777 3.87401 9.80155 4.03912 9.96655Z" fill="#222222"></path></svg> 
                <span>Copy Link</span>
            </button>
            <p id="copySuccess" style="display:none; color:green; margin-top:10px; text-align:center;">Link berhasil disalin!</p> 
        </div>
    </div>

</div>
</div>

<script>

function copyToClipboard() {
    const textToCopy = document.getElementById('copyText').innerText;

    // Cek apakah navigator.clipboard didukung
    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(textToCopy).then(() => {
            showSuccessMessage();
        }).catch(err => {
            console.error('Gagal menyalin teks: ', err);
        });
    } else {
        // Fallback untuk browser lama
        const tempInput = document.createElement('input');
        tempInput.value = textToCopy;
        document.body.appendChild(tempInput);
        tempInput.select();
        try {
            document.execCommand('copy');
            showSuccessMessage();
        } catch (err) {
            console.error('Fallback: Gagal menyalin teks', err);
        }
        document.body.removeChild(tempInput);
    }
}

// Fungsi untuk menampilkan notifikasi sukses
function showSuccessMessage() {
    const successMessage = document.getElementById('copySuccess');
    successMessage.style.display = 'block';
    setTimeout(() => {
        successMessage.style.display = 'none';
    }, 2000);
}
</script>
