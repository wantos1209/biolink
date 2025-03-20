
<div id="showchangepass" class="sec_content" style="display: none">
    <div class="modalcontainer">
        <form action="{{ route('changepassword') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <div class="formaddlink pb-80 bg-white ">
                    <div class="judul_modal flex-h-between">
                        
                        <h1>Change Password</h1>
                        <span class="closemodal" onclick="closeModal()">X</span>
                        
                    </div>
                    <hr class="garis">

                    <div class="child-profiltext radius-4">
                        
                        <div class="profiltext ">
                            <input type="password" name="old" placeholder="Old Password">
                            <input class="mt-10"type="password" name="new" placeholder="New Password">
                            <input class="mt-10"type="password" name="confirm" placeholder="Confirm Password">
                        </div>
                
                    </div>

                    <button class="btnsave saveadd bl-btn text-white absolute flexcenter" type="submit">
                        <span>Save</span></span> <span class="bl-circle-loader absolute hidden"></span>
                    </button>
                </div>
        </form>
    </div>
</div>
