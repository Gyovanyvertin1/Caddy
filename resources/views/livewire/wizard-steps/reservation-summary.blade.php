<div class="p-5 mt-12 w-screen max-w-5xl flex flex-col items-center inter">
    <h1 class="text-4xl text-black mb-5 font-semibold text-center">Reservation Summary</h1>
   
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 w-full">
        <form id="payment-form" class="order-2 sm:order-1 flex flex-col w-full p-[40px] border-2 rounded-md border-gray-200 space-y-4">
            <span class="text-md font-medium text-gray-600 text-center"><span class="font-bold text-black text-3xl mb-2">Let's Get Moving!</span><br> Hitting confirm reserves your rate and time. Our team will be in touch as soon as possible to confirm and finalize the details of your move!</span>

            <span class="text-sm font-bold text-center p-2 rounded-lg bg-yellow-300 text-gray-900 mb-2">Important: Caddy is a moving labor company. <br>We do not provide nor operate moving trucks!</span>

            <div class="flex items-center w-full space-x-4">
                <input wire:model="firstName" type="text" id="name" required placeholder="Enter First Name" class="w-full p-3 rounded block w-full border-gray-300 outline-none border-2 border-gray-200 focus:border-green-custom text-normal">
                <input wire:model="lastName" type="text" id="name" required placeholder="Last Name" class="w-full p-3 rounded block w-full border-gray-300 outline-none border-2 border-gray-200 focus:border-green-custom text-normal">
            </div>
            <input wire:model="email" type="email" id="email" required placeholder="Enter email address" class="w-full p-3 rounded block w-full border-gray-300 outline-none border-2 border-gray-200 focus:border-green-custom text-normal">
            <input wire:model="phone" x-mask="999999999999999" type="phone" id="phone" required placeholder="Enter phone number" class="w-full p-3 rounded block w-full border-gray-300 outline-none border-2 border-gray-200 focus:border-green-custom text-normal">
        
            <label class="border-b-2 border-gray-200 pb-5">
                <input class="w-auto inline mr-3 p-0 accent-green-custom" type="checkbox" required name="terms" id="terms">
                I agree to the <a class="text-green-custom" target="_BLANK" href="https://caddymoving.com/policies/terms-of-service">terms</a> &
                <a class="text-green-custom" target="_BLANK" href="https://caddymoving.com/policies/refund-policy">refund policy</a>
            </label>


            <button wire:click.prevent="submit" wire:loading.delay.attr="disabled" type="submit" class="active:opacity-30 transition duration-150 disabled:opacity-30 disabled:cursor-not-allowed bg-green-custom text-white font-bold py-2 px-4 rounded w-full">Confirm</button>
        </form>

        <div class="order-1 sm:order-2 flex flex-col text-left p-5 rounded block w-full border-grey outline-none border-2 border-gray-200">
            <span class="font-bold">Reservation Date & Time:</span>

            <div class="flex items-center py-5 border-b-2 border-gray-200">
                <svg class="inline-block w-6 h-6 mr-3" fill="#4EC4A0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M112 368h96c8.8 0 16-7.2 16-16v-96c0-8.8-7.2-16-16-16h-96c-8.8 0-16 7.2-16 16v96c0 8.8 7.2 16 16 16zM400 64h-48V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H160V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48zm0 394c0 3.3-2.7 6-6 6H54c-3.3 0-6-2.7-6-6V160h352v298z"></path></svg>
                <span class="inline-block">{{$this->state()->all()["custom-booking"]["date"]}} {{$this->state()->all()["custom-booking"]["time"]}}</span>
            </div>

            <div class="flex items-center py-5 border-b-2 border-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-6 h-6 mr-3" fill="#4EC4A0" viewBox="0 0 512 512"><path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200z"></path></svg>
                <div class="flex flex-col">
                    <span class="text-sm">Starting Point</span>
                    <span>{{$this->state()->all()["select-places"]["startingPlace"]}}</span>
                </div>
            </div>

            @php 
                $endingPlace = $this->state()->all()["select-places"]["endingPlace"];
            @endphp 

            @if($endingPlace)
            <div class="flex items-center py-5 border-b-2 border-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-6 h-6 mr-3" fill="#4EC4A0" viewBox="0 0 512 512"><path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200z"></path></svg>
                <div class="flex flex-col">
                    <span class="text-sm">Ending Point</span>
                    <span>{{$endingPlace}}</span>
                </div>
            </div>
            @endif

            <div class="mt-5 flex flex-col border-b-2 border-gray-200 pb-5">
                <div>
                    <span>Movers</span>
                    <span class="float-right">{{$movers}}</span>
                </div>
                <div>
                    <span>Hours</span>
                    <span class="float-right">{{$hours}}</span>
                </div>
                <div>

            <div class="mt-5">
                <span>Hourly Rate</span>
                <span class="float-right">${{number_format($rate, 2)}}/hr</span>
            </div>

            <div class="mt-1">
                <span>Estimated Total</span>
                <span class="float-right">${{number_format($charge, 2)}}</span>
            </div>

            <p class="text-md mt-8 flex flex-col items-center">
                <span class='text-lg font-bold'>What else is included?</span>
                <div class="flex flex-col gap-[1rem] mt-[1rem]">
                    <div class="flex items-center gap-[1rem]">
                        <svg class="stroke-[#4EC4A0] w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                          
                        <span>Insurance and damage protection</span>
                    </div>

                    <div class="flex items-center gap-[1rem]">
                        <svg class="stroke-[#4EC4A0] w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>

                        <span>Gas and travel charges</span>
                    </div>

                    <div class="flex items-center gap-[1rem]">
                        <svg class="stroke-[#4EC4A0] w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                          
                        <span>Assembly and disassembly of any furniture</span>
                    </div>

                    <div class="flex items-center gap-[1rem]">
                        <svg class="stroke-[#4EC4A0] w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                          
                        <span>Packing and unpacking assistance</span>
                    </div>

                    <div class="flex items-center gap-[1rem]">
                        <svg class="stroke-[#4EC4A0] w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                          
                        <span>NO hidden or additional fees</span>
                    </div>

                    <div class="flex items-center gap-[1rem]">
                        <svg class="stroke-[#4EC4A0] w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                          
                        <span>On-time arrival guarantee</span>
                    </div>
                </div>
            </p>
        </div>
    </div>

    <button wire:click="previousStep()" class="cursor-pointer text-blue-400 hover:text-blue-600 mt-6 mb-12">Go Back</button>
</div>
