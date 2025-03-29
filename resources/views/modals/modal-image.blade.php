<div id="showuserimage" class="sec_modal" >
    <div class="modalcontainer ">

            {{-- <div class="group-post p-32 rounded-sm mt-32 bg-white "> --}}
            <div class="formpriviewpostimage bg-white ">
                <div class="judul_modal flex-h-between">
                    
                    <h1>Image</h1>
                    <span class="closemodal" onclick="closeModal()">X</span>
                    {{-- <button class="lihat closemodal" onclick="closeModal()">X</button> --}}
                </div>
                <hr class="garis">
                <div class="img_form overflow-scroll mt-8">
                    <div id="image-preview-container" class="preview-file-upload">
                    </div>
                </div>
            </div>
    </div>
</div>

<script>
function registerModalClickEvents() {
    const modal = document.getElementById('showImg');
    const imgElement = modal.querySelector('img[name="img"]');

    document.querySelectorAll('.preview-file-upload .triggermodal').forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();

            const index = parseInt(this.getAttribute('data-index'), 10);
            if (window.images && window.images[index]) {
                window.currentIndex = index;
                imgElement.src = `${window.location.origin}/storage/img/${window.images[window.currentIndex]}`;


                modal.style.display = 'block';
            } else {
                console.error('❌ Index tidak valid.');
            }
        });
    });
}
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('showImg');
    const imgElement = modal.querySelector('img[name="img"]');

   document.getElementById('nextImg').addEventListener('click', function (event) {
        event.preventDefault();
        if (window.images && window.images.length > 0) {
            window.currentIndex = (window.currentIndex + 1) % window.images.length;
            imgElement.src = `${window.location.origin}/storage/img/${window.images[window.currentIndex]}`;

        }
    });

    document.getElementById('prevImg').addEventListener('click', function (event) {
        event.preventDefault();
        if (window.images && window.images.length > 0) {
            window.currentIndex = (window.currentIndex - 1 + window.images.length) % window.images.length;
            imgElement.src = `${window.location.origin}/storage/img/${window.images[window.currentIndex]}`;

        }
    });

});

</script>
