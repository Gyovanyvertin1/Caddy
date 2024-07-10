
<div class="p-5 mt-12 w-full max-w-xl flex flex-col items-center inter">
    <h1 class="text-4xl text-black mb-10 font-semibold text-center">Add your location information</h1>

    @error('startingPlace') <span class="text-red-500 py-2">{{$message}}</span> @enderror
    <label class="relative w-full mb-5">
        <svg xmlns="http://www.w3.org/2000/svg" class="pointer-events-none w-6 h-6 absolute top-[.9rem] transform left-4" fill="#4EC4A0" viewBox="0 0 512 512"><path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200z"></path></svg>
        <input wire:ignore id="starting-place" class="pl-14 p-3 rounded block w-full border-gray-300 outline-none border-2 border-gray-200 focus:border-green-custom text-normal" type="text" placeholder="Starting address" autocomplete="off">
    </label>

    @error('endingPlace') <span class="text-red-500 py-2">{{$message}}</span> @enderror
    <label class="relative w-full mb-5">
        <svg xmlns="http://www.w3.org/2000/svg" class="pointer-events-none w-6 h-6 absolute top-[.9rem] transform left-4" fill="#4EC4A0" viewBox="0 0 384 512"><path d="M172.268 501.67C26.97 291.031 0 269.413 0 192 0 85.961 85.961 0 192 0s192 85.961 192 192c0 77.413-26.97 99.031-172.268 309.67-9.535 13.774-29.93 13.773-39.464 0zM192 272c44.183 0 80-35.817 80-80s-35.817-80-80-80-80 35.817-80 80 35.817 80 80 80z"></path></svg>
        <input wire:ignore id="ending-place" class="pl-14 p-3 rounded block w-full border-gray-300 outline-none border-2 border-gray-200 focus:border-green-custom text-normal" type="text" placeholder="Ending address (optional)" autocomplete="off">
    </label>

    <button wire:loading.delay.attr="disabled" @if(!$startingPlace) disabled @endif wire:click="next()" class="active:opacity-30 transition duration-150 disabled:opacity-30 disabled:cursor-not-allowed bg-green-custom text-white font-bold py-2 px-4 rounded w-full">Next</button>

    {{-- <div class="mt-10 border-t-2 border-gray-100">
        <h2 class="mt-3 text-xl font-medium">What if I need help at more than two locations?</h2>
        <p class="mt-1">We only ask for the starting and ending address for your move, even if you need help at more than two locations.</p>
    </div> --}}

    <script>
        let startingPlaceInput = document.getElementById("starting-place");
        let endingPlaceInput = document.getElementById("ending-place");

        startingPlace = new google.maps.places.Autocomplete(startingPlaceInput, {
            types: ["geocode"], // or '(cities)' if that's what you want?
            componentRestrictions: { country: "us" },
        });

        endingPlace = new google.maps.places.Autocomplete(endingPlaceInput, {
            types: ["geocode"], // or '(cities)' if that's what you want?
            componentRestrictions: { country: "us" },
        });

        startingPlace.addListener(
            "place_changed",
            function () {
                place = startingPlace.getPlace();
                Livewire.emit('setStartingPlace', place["formatted_address"]);
            }
        );

        endingPlace.addListener(
            "place_changed",
            function () {
                place = endingPlace.getPlace();
                Livewire.emit('setEndingPlace', place["formatted_address"]);
            }
        );
    </script>

</div>

