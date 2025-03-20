<div>

    <div class="group-settings p-32 rounded-sm mt-32 bg-white">
        <div class="child-profil radius-4 pb-24">
            <span>Themes</span>
        </div>
        <div class="grid gap-y-24 gap-x-32 grid-cols-3">
            {{-- <div data-v-248aa77f="" class="ring-0"> --}}
                <div class="group-theme {{ $selectedTheme === 'Basics' ? 'btn-selected' : '' }}">
                    <div class="child-theme theme-style br-grey cursor-pointer" style="--theme-background: #FFFFFF; --theme-btn-radius: 30px; --theme-btn-bg: #FFFFFF; --theme-btn-border: 0px solid #FFFFFF; --theme-font-family: 'Inter', sans-serif;"  wire:click="changeThema('Basics')"><!----> 
                        <div class="pt-40 px-16 pb-0 w-full relative z-10">
                            <div class="btn-theme bg-white" style="box-shadow: rgba(24, 39, 75, 0.12) 0px 6px 14px -6px, rgba(24, 39, 75, 0.1) 0px 10px 32px -4px, rgba(24, 39, 75, 0.05) 0px 0px 2px 1px inset;"></div>
                            <div class="btn-theme bg-white" style="box-shadow: rgba(24, 39, 75, 0.12) 0px 6px 14px -6px, rgba(24, 39, 75, 0.1) 0px 10px 32px -4px, rgba(24, 39, 75, 0.05) 0px 0px 2px 1px inset;"></div>
                            <div class="btn-theme bg-white" style="box-shadow: rgba(24, 39, 75, 0.12) 0px 6px 14px -6px, rgba(24, 39, 75, 0.1) 0px 10px 32px -4px, rgba(24, 39, 75, 0.05) 0px 0px 2px 1px inset;"></div>
                            <div class="btn-theme bg-white" style="box-shadow: rgba(24, 39, 75, 0.12) 0px 6px 14px -6px, rgba(24, 39, 75, 0.1) 0px 10px 32px -4px, rgba(24, 39, 75, 0.05) 0px 0px 2px 1px inset;"></div>
                        </div>
                    </div> 
                    <div class="text-14 text-black font-inter font-normal text-center mt-6">Basics</div>                                                     
                </div>   
            {{-- </div> --}}
            {{-- <div data-v-248aa77f="" class="ring-0"> --}}
                <div class="group-theme {{ $selectedTheme === 'Carbon' ? 'btn-selected' : '' }}">
                    <div class="child-theme theme-style br-grey cursor-pointer" style="--theme-background: #131212; --theme-btn-radius: 8px; --theme-btn-bg: #212121; --theme-btn-border: 0px solid transparent; --theme-font-family: 'Inter', sans-serif;" wire:click="changeThema('Carbon')"><!----> 
                        <div class="pt-40 px-16 pb-0 w-full relative z-10">
                            <div class="btn-theme bg-white" style="box-shadow: rgba(24, 39, 75, 0.12) 0px 6px 14px -6px, rgba(24, 39, 75, 0.1) 0px 10px 32px -4px, rgba(24, 39, 75, 0.05) 0px 0px 2px 1px inset;"></div>
                            <div class="btn-theme bg-white" style="box-shadow: rgba(24, 39, 75, 0.12) 0px 6px 14px -6px, rgba(24, 39, 75, 0.1) 0px 10px 32px -4px, rgba(24, 39, 75, 0.05) 0px 0px 2px 1px inset;"></div>
                            <div class="btn-theme bg-white" style="box-shadow: rgba(24, 39, 75, 0.12) 0px 6px 14px -6px, rgba(24, 39, 75, 0.1) 0px 10px 32px -4px, rgba(24, 39, 75, 0.05) 0px 0px 2px 1px inset;"></div>
                            <div class="btn-theme bg-white" style="box-shadow: rgba(24, 39, 75, 0.12) 0px 6px 14px -6px, rgba(24, 39, 75, 0.1) 0px 10px 32px -4px, rgba(24, 39, 75, 0.05) 0px 0px 2px 1px inset;"></div>
                        </div>
                    </div> 
                    <div class="text-14 text-black font-inter font-normal text-center mt-6">Carbon</div>                                                     
                </div>   
            {{-- </div> --}}
            {{-- <div data-v-248aa77f="" class="ring-0"> --}}
                <div class="group-theme {{ $selectedTheme === 'Autumn' ? 'btn-selected' : '' }}">
                    <div class="child-theme theme-style br-grey cursor-pointer" style="--theme-background: #fff4f1; --theme-btn-radius: 30px; --theme-btn-bg: #FF9877; --theme-btn-border: 0px solid #FF9877; --theme-font-family: 'DM Sans', sans-serif;" wire:click="changeThema('Autumn')">
                        <div class="pt-40 px-16 pb-0 w-full relative z-10">
                            <div class="btn-theme bg-white" style="box-shadow: rgba(24, 39, 75, 0.12) 0px 6px 14px -6px, rgba(24, 39, 75, 0.1) 0px 10px 32px -4px, rgba(24, 39, 75, 0.05) 0px 0px 2px 1px inset;"></div>
                            <div class="btn-theme bg-white" style="box-shadow: rgba(24, 39, 75, 0.12) 0px 6px 14px -6px, rgba(24, 39, 75, 0.1) 0px 10px 32px -4px, rgba(24, 39, 75, 0.05) 0px 0px 2px 1px inset;"></div>
                            <div class="btn-theme bg-white" style="box-shadow: rgba(24, 39, 75, 0.12) 0px 6px 14px -6px, rgba(24, 39, 75, 0.1) 0px 10px 32px -4px, rgba(24, 39, 75, 0.05) 0px 0px 2px 1px inset;"></div>
                            <div class="btn-theme bg-white" style="box-shadow: rgba(24, 39, 75, 0.12) 0px 6px 14px -6px, rgba(24, 39, 75, 0.1) 0px 10px 32px -4px, rgba(24, 39, 75, 0.05) 0px 0px 2px 1px inset;"></div>
                        </div>
                    </div> 
                    <div class="text-14 text-black font-inter font-normal text-center mt-6">Autumn</div>                                                     
                </div>   
            {{-- </div> --}}
            {{-- <div data-v-248aa77f="" class="ring-0"> --}}
                <div class="group-theme {{ $selectedTheme === 'Blush' ? 'btn-selected' : '' }}">
                    <div class="child-theme theme-style br-grey cursor-pointer" style="--theme-background: #f5fdf4; --theme-btn-radius: 30px; --theme-btn-bg: #A6EB99; --theme-btn-border: 0px solid #FF9877; --theme-font-family: 'DM Sans', sans-serif;" wire:click="changeThema('Blush')">
                        <div class="pt-40 px-16 pb-0 w-full relative z-10">
                            <div class="btn-theme bg-white" style="box-shadow: rgba(24, 39, 75, 0.12) 0px 6px 14px -6px, rgba(24, 39, 75, 0.1) 0px 10px 32px -4px, rgba(24, 39, 75, 0.05) 0px 0px 2px 1px inset;"></div>
                            <div class="btn-theme bg-white" style="box-shadow: rgba(24, 39, 75, 0.12) 0px 6px 14px -6px, rgba(24, 39, 75, 0.1) 0px 10px 32px -4px, rgba(24, 39, 75, 0.05) 0px 0px 2px 1px inset;"></div>
                            <div class="btn-theme bg-white" style="box-shadow: rgba(24, 39, 75, 0.12) 0px 6px 14px -6px, rgba(24, 39, 75, 0.1) 0px 10px 32px -4px, rgba(24, 39, 75, 0.05) 0px 0px 2px 1px inset;"></div>
                            <div class="btn-theme bg-white" style="box-shadow: rgba(24, 39, 75, 0.12) 0px 6px 14px -6px, rgba(24, 39, 75, 0.1) 0px 10px 32px -4px, rgba(24, 39, 75, 0.05) 0px 0px 2px 1px inset;"></div>
                        </div>
                    </div> 
                    <div class="text-14 text-black font-inter font-normal text-center mt-6">Blush</div>                                                     
                </div>   
            {{-- </div> --}}
            {{-- <div data-v-248aa77f="" class="ring-0"> --}}
                <div class="group-theme {{ $selectedTheme === 'Leaf' ? 'btn-selected' : '' }}">
                    <div  class="child-theme theme-style br-grey cursor-pointer" style="--theme-background: #fff3fc; --theme-btn-radius: 12px; --theme-btn-bg: #FF90E8; --theme-btn-border: 0px solid #FF9877; --theme-font-family: 'DM Sans', sans-serif;" wire:click="changeThema('Leaf')">
                        <div  class="pt-40 px-16 pb-0 w-full relative z-10">
                            <div class="btn-theme bg-white" style="box-shadow: rgba(24, 39, 75, 0.12) 0px 6px 14px -6px, rgba(24, 39, 75, 0.1) 0px 10px 32px -4px, rgba(24, 39, 75, 0.05) 0px 0px 2px 1px inset;"></div>
                            <div class="btn-theme bg-white" style="box-shadow: rgba(24, 39, 75, 0.12) 0px 6px 14px -6px, rgba(24, 39, 75, 0.1) 0px 10px 32px -4px, rgba(24, 39, 75, 0.05) 0px 0px 2px 1px inset;"></div>
                            <div class="btn-theme bg-white" style="box-shadow: rgba(24, 39, 75, 0.12) 0px 6px 14px -6px, rgba(24, 39, 75, 0.1) 0px 10px 32px -4px, rgba(24, 39, 75, 0.05) 0px 0px 2px 1px inset;"></div>
                            <div class="btn-theme bg-white" style="box-shadow: rgba(24, 39, 75, 0.12) 0px 6px 14px -6px, rgba(24, 39, 75, 0.1) 0px 10px 32px -4px, rgba(24, 39, 75, 0.05) 0px 0px 2px 1px inset;"></div>
                        </div>
                    </div> 
                    <div class="text-14 text-black font-inter font-normal text-center mt-6">Leaf</div>                                           
                </div>   
            {{-- </div> --}}
            <div class="h-200 relative radius-4 cursor-pointer align-center select-custom-theme {{ $selectedTheme === 'Custom' ? 'btn-selected' : '' }}" wire:click="changeThema('Custom')">      
                <div class="text-14 text-black  mt-6 px-16 font-bold flexcenter">Create your own</div>             
            </div>
        </div>
    </div>

    @if ($selectedTheme === 'Custom')
    <div class="group-settings p-32 rounded-sm mt-32 bg-white">
        <div class="child-profil">
            <span>Background</span>
        </div>
        <div class="pb-32 mt-24 br-bottom-grey" wire:ignore.self wire:listen="refresh">
            <div class="background" >
                <div class="cursor-pointer">
                    
                <div class="child-background flexcenter h-200 {{ isColorOrImage($backgroundpage) ? 'btn-selected' : '' }}" wire:click="changeColorBackground('rgb(255, 255, 255)')" >
                    <svg data-v-1e82527a="" width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg"><rect data-v-1e82527a="" width="39.5833" height="40" rx="4" fill="#3D3D3D"></rect> <mask data-v-1e82527a="" id="mask0_1_36" maskUnits="userSpaceOnUse" x="8" y="8" width="24" height="24" style="mask-type: alpha;"><rect data-v-1e82527a="" x="8" y="8" width="24" height="24" fill="#D9D9D9"></rect></mask> <g data-v-1e82527a="" mask="url(#mask0_1_36)"><path data-v-1e82527a="" d="M14.525 9.75078L15.325 8.92578L23.775 17.3508C24.125 17.7174 24.3 18.1508 24.3 18.6508C24.3 19.1508 24.125 19.5758 23.775 19.9258L19.675 24.0508C19.325 24.4008 18.9167 24.5758 18.45 24.5758C17.9833 24.5758 17.575 24.4008 17.225 24.0508L13.125 19.9258C12.775 19.5758 12.6 19.1508 12.6 18.6508C12.6 18.1508 12.775 17.7258 13.125 17.3758L17.65 12.8508L14.525 9.75078ZM18.45 13.6758L13.725 18.3758C13.6917 18.4091 13.6708 18.4424 13.6625 18.4758C13.6542 18.5091 13.65 18.5508 13.65 18.6008H23.25C23.25 18.5508 23.2417 18.5091 23.225 18.4758C23.2083 18.4424 23.1917 18.4091 23.175 18.3758L18.45 13.6758ZM26.65 25.3258C26.2 25.3258 25.8208 25.1716 25.5125 24.8633C25.2042 24.5549 25.05 24.1758 25.05 23.7258C25.05 23.4424 25.1125 23.1549 25.2375 22.8633C25.3625 22.5716 25.525 22.2758 25.725 21.9758C25.8417 21.7758 25.9833 21.5674 26.15 21.3508C26.3167 21.1341 26.4833 20.9258 26.65 20.7258C26.8 20.9258 26.9583 21.1341 27.125 21.3508C27.2917 21.5674 27.4333 21.7758 27.55 21.9758C27.7667 22.2758 27.9375 22.5716 28.0625 22.8633C28.1875 23.1549 28.25 23.4424 28.25 23.7258C28.25 24.1758 28.0917 24.5549 27.775 24.8633C27.4583 25.1716 27.0833 25.3258 26.65 25.3258ZM10 32.0258V29.7258H30V32.0258H10Z" fill="white"></path></g></svg>
                </div> <span class="text-14 block mt-12 text-center">Color</span>
                </div>
                <div class=" relative" wire:ignore.self wire:listen="refresh">
                    <div class="child-background flexcenter h-200 relative {{ isColorOrImage($backgroundpage) ? '' : 'btn-selected' }}" >
                        <div data-v-1e82527a="" class="w-40 h-40 z-40 flexcenter icon-container">
                            <svg data-v-1e82527a="" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"><mask data-v-1e82527a="" id="mask0_1_186" maskUnits="userSpaceOnUse" x="0" y="0" width="32" height="32" style="mask-type: alpha;"><rect data-v-1e82527a="" width="32" height="32" fill="#D9D9D9"></rect></mask> <g data-v-1e82527a="" mask="url(#mask0_1_186)"><path data-v-1e82527a="" d="M8.90033 22.4003H23.2337L18.9003 16.667L14.867 21.8003L12.1337 18.2003L8.90033 22.4003ZM6.60033 27.3337C6.06699 27.3337 5.61144 27.1448 5.23366 26.767C4.85588 26.3892 4.66699 25.9337 4.66699 25.4003V6.60033C4.66699 6.06699 4.85588 5.61144 5.23366 5.23366C5.61144 4.85588 6.06699 4.66699 6.60033 4.66699H25.4003C25.9337 4.66699 26.3892 4.85588 26.767 5.23366C27.1448 5.61144 27.3337 6.06699 27.3337 6.60033V25.4003C27.3337 25.9337 27.1448 26.3892 26.767 26.767C26.3892 27.1448 25.9337 27.3337 25.4003 27.3337H6.60033ZM6.60033 25.8337H25.4003C25.5114 25.8337 25.6114 25.7892 25.7003 25.7003C25.7892 25.6114 25.8337 25.5114 25.8337 25.4003V6.60033C25.8337 6.48921 25.7892 6.38921 25.7003 6.30033C25.6114 6.21144 25.5114 6.16699 25.4003 6.16699H6.60033C6.48921 6.16699 6.38921 6.21144 6.30033 6.30033C6.21144 6.38921 6.16699 6.48921 6.16699 6.60033V25.4003C6.16699 25.5114 6.21144 25.6114 6.30033 25.7003C6.38921 25.7892 6.48921 25.8337 6.60033 25.8337Z" fill="white"></path></g></svg>
                        </div>
                        @if ($image)
                        <div class="img-addlink">
                            <img src="{{ $image->temporaryUrl() }}" class=" z-20  absolute p-b-wrap object-cover">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="cursor-pointer" wire:click="changeColorBackground('rgb(255, 255, 255)')">
                                <circle cx="12" cy="12" r="11" fill="#0D0C22" stroke="white" stroke-width="2"></circle> 
                                <g clip-path="url(#clip0)">
                                    <path d="M15.7766 8.21582L8.86487 15.1275" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M15.7823 15.1347L8.86487 8.21582" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </g> 
                                <defs><clipPath id="clip0"><rect width="10.3784" height="10.3784" fill="white" transform="translate(7.13513 6.48633)"></rect></clipPath></defs>
                            </svg>
                        </div>
                        @endif

                        @if ($backgroundpage && !isColorOrImage($backgroundpage))
                        <div class="img-addlink">
                            <img src="{{ env('API_URL') .'/storage/backgrounds/'. $backgroundpage }}" class=" z-20  absolute p-b-wrap object-cover">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="cursor-pointer" wire:click="changeColorBackground('rgb(255, 255, 255)')">
                                <circle cx="12" cy="12" r="11" fill="#0D0C22" stroke="white" stroke-width="2"></circle> 
                                <g clip-path="url(#clip0)">
                                    <path d="M15.7766 8.21582L8.86487 15.1275" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M15.7823 15.1347L8.86487 8.21582" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </g> 
                                <defs><clipPath id="clip0"><rect width="10.3784" height="10.3784" fill="white" transform="translate(7.13513 6.48633)"></rect></clipPath></defs>
                            </svg>
                        </div>
                        @endif
                        <input type="file" id="profile-img-upload" accept="image/*" 
                        class="z-50 p-b-wrap absolute opacity-0 cursor-pointer" 
                        name="images" wire:model="image"> 
                    </div> <span class="text-14 block mt-12 text-center">Image</span>
                </div>
                {{-- {{ !in_array($selectedColor, ['rgb(133, 107, 255)', 'rgb(255, 46, 150)','rgb(0, 136, 115)', 'rgb(255, 31, 84)','rgb(0, 0, 0)']) ? 'btn-selected' : '' }} --}}
            </div>
            <div class="color {{ isColorOrImage($backgroundpage) ? '' : 'hidden' }}">
                <div class="section-color flexcenter {{ in_array(strtolower($backgroundpage), ['rgb(133, 107, 255)', 'rgb(255, 46, 150)', 'rgb(0, 136, 115)', 'rgb(255, 31, 84)', 'rgb(0, 0, 0)']) ? '' : 'btn-selected' }}">
                    <div class="sub-color br-grey overflow-hidden custom-color-picker" style="">
                        <div class="flexcenter absolute p-b-wrap dark-low-op-bg">
                            <svg width="25" height="27" viewBox="0 0 25 27" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20.0678 8.38654C19.3238 9.04108 19.2464 10.1734 19.9009 10.9218L18.5493 12.1033L12.6409 5.34181L13.9926 4.16145C14.646 4.90763 15.7795 4.9829 16.5235 4.32945L20.0646 1.30108C20.5773 0.857082 21.2078 0.636719 21.8373 0.636719C23.3427 0.636719 24.5449 1.86726 24.5449 3.33235C24.5449 4.12872 24.1936 4.85199 23.6133 5.35926L20.0678 8.38654ZM12.4936 12.6367H9.76638L13.6522 9.22981L12.4686 7.87708L4.46238 14.8447C3.16529 15.9716 4.06092 16.8422 2.99183 18.3302C2.84674 18.5331 2.76274 18.736 2.73983 18.9302C2.66783 19.5193 3.09438 20.0156 3.6311 20.0822C3.84274 20.1073 4.07838 20.0658 4.3031 19.9327C5.99401 18.9378 6.6791 20.0604 8.00783 18.8996L16.0151 11.9353L14.8358 10.5814L12.4936 12.6367ZM2.55983 20.8185C1.97619 23.0582 0.544922 23.3658 0.544922 24.8374C0.544922 25.9316 1.45474 26.8185 2.55983 26.8185C3.66492 26.8185 4.56056 25.9316 4.56056 24.8374C4.56056 23.3658 3.14347 23.0582 2.55983 20.8185Z" fill="white"></path></svg>
                        </div>
                        <input type="color" class="absolute p-b-wrap opacity-0 cursor-pointer" 
                        wire:model="selectedColor" 
                        {{-- wire:click="changeBackground" --}}
                        wire:change="changeBackground"
                        id="colorBackground">
                    </div>
                </div>
                {{-- @dd($selectedColor); --}}
                <div class="section-color cursor-pointer flexcenter {{ strtolower($backgroundpage)  === 'rgb(133, 107, 255)' ? 'btn-selected' : '' }}" wire:click="changeColorBackground('rgb(133, 107, 255)')">
                    <div class="sub-color br-grey"  style="background-color: rgb(133, 107, 255);"></div>
                </div>
                <div class="section-color cursor-pointer flexcenter {{ strtolower($backgroundpage)  === 'rgb(255, 46, 150)' ? 'btn-selected' : '' }}" wire:click="changeColorBackground('rgb(255, 46, 150)')">
                    <div class="sub-color br-grey"  style="background-color: rgb(255, 46, 150);"></div>
                </div>
                <div class="section-color cursor-pointer flexcenter {{ strtolower($backgroundpage)  === 'rgb(0, 136, 115)' ? 'btn-selected' : '' }}" wire:click="changeColorBackground('rgb(0, 136, 115)')">
                    <div class="sub-color br-grey" style="background-color: rgb(0, 136, 115);"></div>
                </div>
                <div class="section-color cursor-pointer flexcenter {{ strtolower($backgroundpage)  === 'rgb(255, 31, 84)' ? 'btn-selected' : '' }}" wire:click="changeColorBackground('rgb(255, 31, 84)')">
                    <div class="sub-color br-grey" style="background-color: rgb(255, 31, 84);"></div>
                </div>
                <div class="section-color cursor-pointer flexcenter {{ strtolower($backgroundpage)  === 'rgb(0, 0, 0)' ? 'btn-selected' : '' }}" wire:click="changeColorBackground('rgb(0, 0, 0)')">
                    <div class="sub-color br-grey" style="background-color: rgb(0, 0, 0);"></div>
                </div>
            </div>
        </div>
        <div class=".br-bottom-grey pb-32 mt-48">
            <div class="child-profil">
                <span>Button</span>
            </div>
            <div class="button">
                <div class="section-button cursor-pointer flexcenter px-2 theme-btn-each {{ ($border === '0px solid transparent' && $background === '' && $border_radius === '30px') ? 'btn-selected' : '' }}" style="border-radius: 30px;" wire:click="changeButton('0px solid transparent', '','30px')">
                   <div class=" w-full sub-button bg-black" style="border-radius: 30px;"></div>
                </div>
                <div class="section-button cursor-pointer flexcenter px-2 theme-btn-each {{ ($border === '0px solid transparent' && $background === '' && $border_radius === '8px') ? 'btn-selected' : '' }}" style="border-radius: 8px;" wire:click="changeButton('0px solid transparent', '','8px')">
                    <div class="w-full sub-button bg-black" style="border-radius: 8px;"></div>
                 </div>
                 <div class="section-button cursor-pointer flexcenter px-2 theme-btn-each {{ ($border === '0px solid transparent' && $background === '' && $border_radius === '0px') ? 'btn-selected' : '' }}" style="border-radius: 0px; " wire:click="changeButton('0px solid transparent', '','0px')">
                    <div class="w-full sub-button bg-black" style="border-radius: 0px;"></div>
                 </div>
                 <div class="section-button cursor-pointer flexcenter px-2 {{ ($border === '2px solid' && $background === 'transparent' && $border_radius === '30px') ? 'btn-selected' : '' }}" style="border-radius: 30px;" wire:click="changeButton('2px solid','transparent','30px')">
                    <div class="w-full sub-button theme-bordered-btn" style="border-radius: 30px;"></div>
                 </div>
                 <div class="section-button cursor-pointer flexcenter px-2 {{ ($border === '2px solid' && $background === 'transparent' && $border_radius === '8px') ? 'btn-selected' : '' }}" style="border-radius: 8px;" wire:click="changeButton('2px solid','transparent','8px')">
                    <div class="w-full sub-button theme-bordered-btn" style="border-radius: 8px;"></div>
                 </div>
                 <div class="section-button cursor-pointer flexcenter px-2 {{ ($border === '2px solid' && $background === 'transparent' && $border_radius === '0px') ? 'btn-selected' : '' }}" style="border-radius: 0px;" wire:click="changeButton('2px solid','transparent','0px')">
                    <div class="w-full sub-button theme-bordered-btn" style="border-radius: 0px;"></div>
                 </div>
            </div>
            <div class="section-color flexcenter">
                <div class="sub-color br-grey overflow-hidden custom-color-picker" style="">
                    <div class="flexcenter absolute p-b-wrap dark-low-op-bg">
                        <svg width="25" height="27" viewBox="0 0 25 27" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20.0678 8.38654C19.3238 9.04108 19.2464 10.1734 19.9009 10.9218L18.5493 12.1033L12.6409 5.34181L13.9926 4.16145C14.646 4.90763 15.7795 4.9829 16.5235 4.32945L20.0646 1.30108C20.5773 0.857082 21.2078 0.636719 21.8373 0.636719C23.3427 0.636719 24.5449 1.86726 24.5449 3.33235C24.5449 4.12872 24.1936 4.85199 23.6133 5.35926L20.0678 8.38654ZM12.4936 12.6367H9.76638L13.6522 9.22981L12.4686 7.87708L4.46238 14.8447C3.16529 15.9716 4.06092 16.8422 2.99183 18.3302C2.84674 18.5331 2.76274 18.736 2.73983 18.9302C2.66783 19.5193 3.09438 20.0156 3.6311 20.0822C3.84274 20.1073 4.07838 20.0658 4.3031 19.9327C5.99401 18.9378 6.6791 20.0604 8.00783 18.8996L16.0151 11.9353L14.8358 10.5814L12.4936 12.6367ZM2.55983 20.8185C1.97619 23.0582 0.544922 23.3658 0.544922 24.8374C0.544922 25.9316 1.45474 26.8185 2.55983 26.8185C3.66492 26.8185 4.56056 25.9316 4.56056 24.8374C4.56056 23.3658 3.14347 23.0582 2.55983 20.8185Z" fill="white"></path></svg>
                    </div>
                    <input type="color" class="absolute p-b-wrap opacity-0 cursor-pointer" 
                    wire:model="selectedColor" 
                    {{-- wire:click="changeColorButton" --}}
                    wire:change="changeColorButton"
                    id="colorButton">
                </div>
            </div>

        </div>  

        <div class=".br-bottom-grey pb-32 mt-48">
            <div class="child-profil">
                <span>Font</span>
            </div>
            <div class="font">
                <div class="sub-font cursor-pointer flexcenter px-2 {{ $fontFamily === 'Inter' ? 'btn-selected' : '' }}" wire:click="changeFont('Inter')">
                    <div class="flexcenter rounded-md btn-h-48  xxs-h-32 overflow-hidden relative br-grey w-full">
                        <span class="font-option" style="font-family: &quot;Inter&quot;, sans-serif;">Inter</span>
                    </div>
                </div>

                <div class="sub-font cursor-pointer flexcenter px-2 {{ $fontFamily === 'Poppins' ? 'btn-selected' : '' }}" wire:click="changeFont('Poppins')">
                    <div class="flexcenter rounded-md btn-h-48  xxs-h-32 overflow-hidden relative br-grey w-full">
                        <span class="font-option"  style="font-family: &quot;Poppins&quot;, sans-serif;">Poppins</span>
                    </div>
                </div>
                {{-- <div class="sub-font cursor-pointer flexcenter px-2 bl-btn-primary-2" onclick="saveFont(this)"> wire:model="fontFamily" --}}
                <div class="sub-font cursor-pointer flexcenter px-2 {{ $fontFamily === 'EB Garamond' ? 'btn-selected' : '' }}" wire:click="changeFont('EB Garamond')">
                    <div class="flexcenter rounded-md btn-h-48  xxs-h-32 overflow-hidden relative br-grey w-full">
                        <span class="font-option" style="font-family: &quot;EB Garamond&quot;, sans-serif;">EB Garamond</span>
                    </div>
                </div>

                <div class="sub-font cursor-pointer flexcenter px-2 {{ $fontFamily === 'Teko' ? 'btn-selected' : '' }}" wire:click="changeFont('Teko')">
                    <div class="flexcenter rounded-md btn-h-48  xxs-h-32 overflow-hidden relative br-grey w-full">
                        <span class="font-option" style="font-family: &quot;Teko&quot;, sans-serif;">TEKO</span>
                    </div>
                </div>

                <div class="sub-font cursor-pointer flexcenter px-2 {{ $fontFamily === 'Balsamiq Sans' ? 'btn-selected' : '' }}" wire:click="changeFont('Balsamiq Sans')">
                    <div class="flexcenter rounded-md btn-h-48  xxs-h-32 overflow-hidden relative br-grey w-full">
                        <span class="font-option" style="font-family: &quot;Balsamiq Sans&quot;, cursive;">BALSAMIQ SANS</span>
                    </div>
                </div>

                <div class="sub-font cursor-pointer flexcenter px-2 {{ $fontFamily === 'Kite One' ? 'btn-selected' : '' }}" wire:click="changeFont('Kite One')">
                    <div class="flexcenter rounded-md btn-h-48  xxs-h-32 overflow-hidden relative br-grey w-full">
                        <span class="font-option" style="font-family: &quot;Kite One&quot;, cursive;">Kite One</span>
                    </div>
                </div>

                <div class="sub-font cursor-pointer flexcenter px-2 {{ $fontFamily === 'PT Sans' ? 'btn-selected' : '' }}" wire:click="changeFont('PT Sans')">
                    <div class="flexcenter rounded-md btn-h-48  xxs-h-32 overflow-hidden relative br-grey w-full">
                        <span class="font-option" style="font-family: &quot;PT Sans&quot;, cursive;">PT Sans</span>
                    </div>
                </div>

                <div class="sub-font cursor-pointer flexcenter px-2 {{ $fontFamily === 'Quicksand' ? 'btn-selected' : '' }}" wire:click="changeFont('Quicksand')">
                    <div class="flexcenter rounded-md btn-h-48  xxs-h-32 overflow-hidden relative br-grey w-full">
                        <span class="font-option" style="font-family: &quot;Quicksand&quot;, cursive;">Quicksand</span>
                    </div>
                </div>

                <div class="sub-font cursor-pointer flexcenter px-2 {{ $fontFamily === 'DM Sans' ? 'btn-selected' : '' }}" wire:click="changeFont('DM Sans')">
                    <div class="flexcenter rounded-md btn-h-48  xxs-h-32 overflow-hidden relative br-grey w-full">
                        <span class="font-option" style="font-family: &quot;DM Sans&quot;, cursive;">DM Sans</span>
                    </div>
                </div>
            </div>
            <div class="section-color flexcenter">
                <div class="sub-color br-grey overflow-hidden custom-color-picker" style="">
                    <div class="flexcenter absolute p-b-wrap dark-low-op-bg">
                        <svg width="25" height="27" viewBox="0 0 25 27" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20.0678 8.38654C19.3238 9.04108 19.2464 10.1734 19.9009 10.9218L18.5493 12.1033L12.6409 5.34181L13.9926 4.16145C14.646 4.90763 15.7795 4.9829 16.5235 4.32945L20.0646 1.30108C20.5773 0.857082 21.2078 0.636719 21.8373 0.636719C23.3427 0.636719 24.5449 1.86726 24.5449 3.33235C24.5449 4.12872 24.1936 4.85199 23.6133 5.35926L20.0678 8.38654ZM12.4936 12.6367H9.76638L13.6522 9.22981L12.4686 7.87708L4.46238 14.8447C3.16529 15.9716 4.06092 16.8422 2.99183 18.3302C2.84674 18.5331 2.76274 18.736 2.73983 18.9302C2.66783 19.5193 3.09438 20.0156 3.6311 20.0822C3.84274 20.1073 4.07838 20.0658 4.3031 19.9327C5.99401 18.9378 6.6791 20.0604 8.00783 18.8996L16.0151 11.9353L14.8358 10.5814L12.4936 12.6367ZM2.55983 20.8185C1.97619 23.0582 0.544922 23.3658 0.544922 24.8374C0.544922 25.9316 1.45474 26.8185 2.55983 26.8185C3.66492 26.8185 4.56056 25.9316 4.56056 24.8374C4.56056 23.3658 3.14347 23.0582 2.55983 20.8185Z" fill="white"></path></svg>
                    </div>
                    <input type="color" class="absolute p-b-wrap opacity-0 cursor-pointer" 
                    wire:model="selectedColor" 
                    {{-- wire:click="changeColorButton" --}}
                    wire:change="changeColorFont"
                    id="colorFont">
                </div>
            </div>
        </div>
    </div> 
</div>
@endif
<script>


// Pilih semua elemen dengan kelas .group-theme
// document.addEventListener('DOMContentLoaded', function () {
//     const themes = document.querySelectorAll('.group-theme');

//     themes.forEach(theme => {
//         theme.addEventListener('click', function () {
//             // Hapus btn-selected dari semua elemen
//             themes.forEach(t => t.classList.remove('btn-selected'));

//             // Tambahkan btn-selected ke elemen yang diklik
//             this.classList.add('btn-selected');
//         });
//     });
// });

    // document.addEventListener("DOMContentLoaded", function() {
    //     Livewire.hook('message.processed', () => {
    //         document.getElementById('colorPicker').addEventListener('input', function() {
    //             let selectedColor = this.value; // Ambil nilai warna yang dipilih
    //             Livewire.emit('updateColorLive', selectedColor); // Kirim event ke Livewire
    //         });
    //     });

</script>