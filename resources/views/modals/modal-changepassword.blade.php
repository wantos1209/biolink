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

                    <div class="child-profiltext flex-col radius-4">
                        
                        <div class="profiltext password-container">
                            <input type="password" name="old" id="oldpassword"  placeholder="Old Password">
                            <i class="toggle-password" data-toggle-id="oldpassword" onclick="togglePassword(event, 'oldpassword')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32">
                                    <path fill="currentColor" d="M9.5 7A8.5 8.5 0 0 0 1 15.5v7a8.5 8.5 0 0 0 15 5.477A8.5 8.5 0 0 0 31 22.5v-7a8.5 8.5 0 0 0-15-5.477A8.48 8.48 0 0 0 9.5 7m5.345 4.8A8.5 8.5 0 0 0 14 15.5v7c0 1.326.304 2.581.845 3.7A6.5 6.5 0 0 1 3 22.5v-1a3.5 3.5 0 1 0 7 0v-5a3.5 3.5 0 1 0-7 0v-1a6.5 6.5 0 0 1 11.845-3.7M16 15.5a6.5 6.5 0 1 1 13 0v7a6.5 6.5 0 1 1-13 0v-1a3.5 3.5 0 1 0 7 0v-5a3.5 3.5 0 1 0-7 0zm-7.324 1.361c-.371.31-.99.177-1.383-.294c-.393-.472-.41-1.105-.039-1.414c.372-.31.991-.178 1.384.294s.41 1.105.038 1.414m13.02-1.414c.393.472.41 1.105.04 1.414c-.372.31-.992.177-1.384-.294c-.393-.472-.41-1.105-.039-1.414c.372-.31.991-.178 1.384.294"/>
                                </svg>
                            </i>
                        </div>
                        <div class="profiltext password-container">
                            <input class=""type="password" name="new" id="password" placeholder="New Password">
                            {{-- <i class="toggle-password" data-toggle-id="newpassword" onclick="togglePassword(event, 'newpassword')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32">
                                    <path fill="currentColor" d="M9.5 7A8.5 8.5 0 0 0 1 15.5v7a8.5 8.5 0 0 0 15 5.477A8.5 8.5 0 0 0 31 22.5v-7a8.5 8.5 0 0 0-15-5.477A8.48 8.48 0 0 0 9.5 7m5.345 4.8A8.5 8.5 0 0 0 14 15.5v7c0 1.326.304 2.581.845 3.7A6.5 6.5 0 0 1 3 22.5v-1a3.5 3.5 0 1 0 7 0v-5a3.5 3.5 0 1 0-7 0v-1a6.5 6.5 0 0 1 11.845-3.7M16 15.5a6.5 6.5 0 1 1 13 0v7a6.5 6.5 0 1 1-13 0v-1a3.5 3.5 0 1 0 7 0v-5a3.5 3.5 0 1 0-7 0zm-7.324 1.361c-.371.31-.99.177-1.383-.294c-.393-.472-.41-1.105-.039-1.414c.372-.31.991-.178 1.384.294s.41 1.105.038 1.414m13.02-1.414c.393.472.41 1.105.04 1.414c-.372.31-.992.177-1.384-.294c-.393-.472-.41-1.105-.039-1.414c.372-.31.991-.178 1.384.294"/>
                                </svg>
                            </i> --}}
                        </div>
                        <ul id="password-rules" style="font-size: 14px; margin-top: 5px;">
                            <li id="length-rule" style="display: none;">🔴 Minimal 8 karakter</li>
                            <li id="number-rule" style="display: none;">🔴 Mengandung angka</li>
                            <li id="lowercase-rule" style="display: none;">🔴 Mengandung huruf kecil</li>
                            <li id="uppercase-rule" style="display: none;">🔴 Mengandung huruf besar</li>
                        </ul>

                        <div class="profiltext password-container konfirmasi-password" style="display: none;" >
                            <input class=""type="password" name="confirm" id="confirmnew" placeholder="Confirm Password">
                            <i class="toggle-password" data-toggle-id="confirmnew" onclick="togglePassword(event, 'confirmnew')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32">
                                    <path fill="currentColor" d="M9.5 7A8.5 8.5 0 0 0 1 15.5v7a8.5 8.5 0 0 0 15 5.477A8.5 8.5 0 0 0 31 22.5v-7a8.5 8.5 0 0 0-15-5.477A8.48 8.48 0 0 0 9.5 7m5.345 4.8A8.5 8.5 0 0 0 14 15.5v7c0 1.326.304 2.581.845 3.7A6.5 6.5 0 0 1 3 22.5v-1a3.5 3.5 0 1 0 7 0v-5a3.5 3.5 0 1 0-7 0v-1a6.5 6.5 0 0 1 11.845-3.7M16 15.5a6.5 6.5 0 1 1 13 0v7a6.5 6.5 0 1 1-13 0v-1a3.5 3.5 0 1 0 7 0v-5a3.5 3.5 0 1 0-7 0zm-7.324 1.361c-.371.31-.99.177-1.383-.294c-.393-.472-.41-1.105-.039-1.414c.372-.31.991-.178 1.384.294s.41 1.105.038 1.414m13.02-1.414c.393.472.41 1.105.04 1.414c-.372.31-.992.177-1.384-.294c-.393-.472-.41-1.105-.039-1.414c.372-.31.991-.178 1.384.294"/>
                                </svg>
                            </i>
                        </div>
                        
                
                    </div>

                    <button class="btnsave saveadd bl-btn text-white absolute flexcenter" type="submit">
                        <span>Save</span></span> <span class="bl-circle-loader absolute hidden"></span>
                    </button>
                </div>
        </form>
    </div>
</div>
