<div class="p-5 mt-12 w-full max-w-xl flex flex-col items-center inter">
    <h1 class="text-4xl text-black mb-5 font-semibold text-center">Customize your booking</h1>
    <h2 class="text-gray-500 text-center text-xl mb-10">Book for 3 hours or more and get a discounted hourly rate!</h2>

    <label class="relative w-full mb-5">
        @php 
            $today = \Carbon\Carbon::today()->format("m-d-Y");
        @endphp
        
        <svg
        class="pointer-events-none w-6 h-6 absolute top-[.7rem] transform left-4 fill-green-custom"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 448 512"
        ><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path
            d="M112 368h96c8.8 0 16-7.2 16-16v-96c0-8.8-7.2-16-16-16h-96c-8.8 0-16 7.2-16 16v96c0 8.8 7.2 16 16 16zM400 64h-48V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H160V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48zm0 394c0 3.3-2.7 6-6 6H54c-3.3 0-6-2.7-6-6V160h352v298z"
        /></svg>
        
        <input id="date" wire:ignore required type="date" wire:model="date" class="appearance-none pl-14 p-3 rounded block w-full border-gray-300 outline-none border-2 border-gray-200 focus:border-green-custom text-normal"  placeholder="Choose a moving date">
        
    </label>

    <span class="font-semibold text-4xl my-8">${{number_format((($this->checkRate($movers, $hours, $truck, $mileage) / $hours) + $this->getSurchargeValue()), 2)}} /hr</span>

    <div class='grid grid-cols-2 w-full'>
        <div class="p-8 flex flex-col justify-center rounded border-2 border-gray-200 mr-3">
            <span class="font-semibold text-center text-xl w-full pb-4">Movers</span>
            <div class="grid grid-cols-3 w-full pb-3">
                <button class="text-3xl flex justify-center items-center h-full pr-2" wire:click="subtractMover">-</button>
                <span class="text-6xl flex justify-center items-center h-full">{{$movers}}</span>
                <button class="text-3xl flex justify-center items-center h-full pl-2" wire:click="addMover">+</button>
            </div>
        </div>
        
        <div class="p-8 flex flex-col justify-center rounded border-2 border-gray-200 ml-3">
            <span class="font-semibold text-center text-xl w-full pb-4">Hours</span>
            <div class="grid grid-cols-3 w-full pb-3">
                <button class="text-3xl flex justify-center items-center h-full pr-2" wire:click="subtractHour">-</button>
                <span class="text-6xl flex justify-center items-center h-full">{{$hours}}</span>
                <button class="text-3xl flex justify-center items-center h-full pl-2" wire:click="addHour">+</button>
            </div>
        </div>
    </div>

    <div class='grid grid-cols-2 gap-x-[1.5rem] w-full mb-4'>
        @foreach(["8:00 am", "10:00 am", "12:00 pm", "2:00 pm", "4:00 pm", "6:00 pm"] as $possibleTime)
            <button 

            @if(!$this->checkLeadTime($possibleTime))
                disabled
            @endif
            
            
            wire:click="setTime(@js($possibleTime))" class="border-2 border-solid @if($time == $possibleTime) border-green-custom bg-green-custom @else border-gray-100 @endif px-10 py-3 my-3 rounded-md disabled:text-gray-300 focus:outline-none">
                {{$possibleTime}}
            </button>
        @endforeach
    </div>
<!--
    @if($this->hours == 1)
    <span class="text-gray-600 text-xs py-2 w-full">
        * 2 hours minimum is required for truck reservations
    </span>
    @endif


    <label class="relative w-full mb-5">
        <svg class="pointer-events-none w-6 h-6 absolute top-[.8rem] transform left-4 fill-green-custom" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 1200">
            <path fill-rule="evenodd" d="M784.91 633.55h383.51v-73.605l-202.96-202.88H784.92zm383.51 49.488v213.35h-62.602c-7.7852-41.969-34.824-77.844-73.023-96.887-38.203-19.043-83.129-19.043-121.33 0s-65.238 54.918-73.023 96.887h-403.25c-7.7812-41.965-34.82-77.836-73.016-96.879-38.195-19.039-83.117-19.039-121.31 0-38.199 19.043-65.234 54.914-73.02 96.879h-123.9c-6.8164-.039063-12.332-5.5625-12.367-12.379v-679.21c.035156-6.8203 5.5508-12.34 12.367-12.379h679.2c6.8086.054687 12.309 5.5703 12.34 12.379v682.11h49.426l.003906-203.86zm-135.16 176.84h-.003906c-18.988-19.031-45.75-28.152-72.406-24.676-26.66 3.4766-50.188 19.152-63.66 42.418-13.473 23.266-15.363 51.477-5.1094 76.328 10.254 24.855 31.48 43.527 57.438 50.523 25.961 7 53.695 1.5273 75.055-14.805 21.355-16.332 33.902-41.668 33.949-68.551.085937-22.969-9.0078-45.016-25.266-61.238zm-670.64 0c-19.008-18.996-45.766-28.07-72.402-24.562-26.641 3.5078-50.133 19.207-63.574 42.473-13.438 23.27-15.293 51.461-5.0195 76.289 10.273 24.828 31.508 43.469 57.457 50.441 25.953 6.9688 53.668 1.4766 74.996-14.863 21.332-16.34 33.852-41.672 33.879-68.539.078125-22.965-9.0273-45.008-25.285-61.227z"/>
          </svg>

        <select @if($this->hours == 1) disabled @endif class="disabled:text-gray-600 p-3 pl-12 rounded block w-full border-grey outline-none border-2 border-gray-200 focus:border-green-custom appearance-none" id="truck" required wire:model="truck">
            @foreach(App\Enums\TruckSize::toOptionsArray() as $option)
                <option>{{$option}}</option>
            @endforeach
        </select>
    </label> 

    @error('mileage') <span class="text-red-500 py-2 text-xs w-full text-left"> {{$message}} </span> @enderror
    
    @if($mileage > 40)
        <span class="text-red-500 text-xs mb-2 w-full">
            * for moves over 40 miles please call us: 855-585-1839
        </span>
    @endif
        
    <label class="relative w-full mb-5">
        <svg class="pointer-events-none w-6 absolute top-[.9rem] transform left-4 fill-green-custom" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 1200">
        <path d="M670.98 726.44c-64.703 96.449-215.29-27.895-129.96-113.23 69.973-63.496 145.93-125.36 217.91-187.13 43.016-36.793 102.9 19.699 69.691 64.742zM352.52 328.61l39.684 39.684c44.633 44.633-23.23 112.49-67.863 67.863l-39.672-39.672c-44.191 56.254-73.672 124.67-82.59 199.39h56.098c63.141 0 63.141 96.012 0 96.012h-56.141c8.6602 73.191 37.008 141.51 82.629 199.39l39.672-39.672c44.633-44.633 112.49 23.23 67.863 67.863l-75.602 75.602c-18.738 18.738-49.125 18.738-67.863 0-93.09-93.09-145.52-219.55-145.52-351.19 0-274.31 222.46-496.78 496.78-496.78s496.78 222.46 496.78 496.78c0 131.9-52.414 257.94-145.66 351.19-18.738 18.738-49.125 18.738-67.863 0l-75.602-75.602c-44.633-44.633 23.23-112.49 67.863-67.863l39.656 39.656c45.512-57.77 74.086-126.33 82.758-199.38h-56.254c-63.141 0-63.141-96.012 0-96.012h56.238c-21.828-183.02-166.98-328.1-349.98-349.93v56.184c0 63.141-96.012 63.141-96.012 0v-56.156c-74.723 8.9453-143.14 38.426-199.41 82.629z"/>
        </svg>

        <span class="pointer-events-none w-6 absolute top-[.85rem] transform left-[5rem] text-gray-600">Mile{{$mileage > 1 ? "s" : ""}}</span>

        <input x-mask="99" @if($this->truck == App\Enums\TruckSize::NoTruck->value) min="0" @else min="1" @endif max="40" type="number" class="p-3 pl-[3.2rem] rounded block w-full border-grey outline-none border-2 border-gray-200 focus:border-green-custom" id="mileage" required wire:model="mileage">
    </label>
-->
    <textarea wire:model="notes" class="p-3 rounded block w-full border-grey mb-5 outline-none border-2 border-gray-200 focus:border-green-custom" placeholder="Move details, parking instructions, or special requests for your team."></textarea>

    <button wire:loading.delay.attr="disabled" @if(!$time || !$date) disabled @endif  wire:click="next()" class="active:opacity-30 duration-150 transition disabled:opacity-30 disabled:cursor-not-allowed bg-green-custom text-white font-bold py-2 px-4 rounded w-full">Next</button>

    <button wire:click="previousStep()" class="mt-3 cursor-pointer text-blue-400 hover:text-blue-600 mb-12">Go Back</button>

    <script>
        window.dateSelector = flatpickr("#date", {
            disableMobile: true,
            dateFormat: 'm-d-Y',
            onChange(selectedDates, dateStr) {                
                window.Livewire.emit("setDate", selectedDates[0]);
            },
            minDate: (() => {
                return new Date();
            })(),
        });
    </script>
</div>
