<div class="flex flex-col justify-center rounded-xl shadow-xs shadow-black/50 p-4 bg-white">
    <div class="w-full flex justify-center">
        <img
            src="{{ $property->preview_image_src }}"
            class="h-60 w-[450px] xl:h-80 xl:w-[500px] rounded-md object-cover"
        />
    </div>

    <div class="mt-2">
        <dl>
            <div class="flex justify-between">
                <div>
                    <dt class="sr-only">Prix</dt>

                    <dd class="text-sm lg:text-lg text-gray-500">€{{ $property->price_in_euros }}</dd>
                </div>

                @if ($property->available)
                    <p class="text-sm lg:text-lg text-green-500">Disponbile</p>
                @else
                    <p class="text-sm lg:text-lg text-red-500">Plus disponible</p>
                @endif
            </div>

            <div>
                <dt class="sr-only">Adresse</dt>

                <dd class="font-medium lg:text-lg">{{ $property->address }}</dd>
            </div>
        </dl>

        <div class="mt-6 flex items-center gap-8 text-xs">
            <div class="sm:inline-flex sm:shrink-0 sm:items-center sm:gap-2">
                <svg
                    class="size-4 lg:size-8 text-indigo-700"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"
                    />
                </svg>

                <div class="mt-1.5 sm:mt-0">
                    <p class="text-gray-500 lg:text-[15px]">Parking</p>

                    <p class="font-medium lg:text-[15px]">{{ $property->parking_spaces }} espaces</p>
                </div>
            </div>

            <div class="sm:inline-flex sm:shrink-0 sm:items-center sm:gap-2">
                <svg
                    class="size-4 lg:size-8 text-indigo-700"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"
                    />
                </svg>

                <div class="mt-1.5 sm:mt-0">
                    <p class="text-gray-500 lg:text-[15px]">Salle de bain</p>

                    <p class="font-medium lg:text-[15px]">{{ $property->bathrooms }} salles</p>
                </div>
            </div>

            <div class="sm:inline-flex sm:shrink-0 sm:items-center sm:gap-2">
                <svg
                    class="size-4 lg:size-8 text-indigo-700"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"
                    />
                </svg>

                <div class="mt-1.5 sm:mt-0">
                    <p class="text-gray-500 lg:text-[15px]">Chambres à coucher</p>

                    <p class="font-medium lg:text-[15px]">{{ $property->living_rooms }} chambres</p>
                </div>
            </div>
        </div>

        @if ($property->available)
            <div class="mt-5">
                @guest
                    <form action="{{ route('reservation-login') }}" method="GET">
                        <button class="cursor-pointer hover:text-white hover:bg-black text-black border border-black px-4 py-2 rounded-xs" type="submit">Réserver maintenant</button>
                    </form>
                @endguest

                @auth
                    <button data-property-id="{{ $property->id }}" class="reserve-btn cursor-pointer hover:text-white hover:bg-black text-black border border-black px-4 py-2 rounded-xs">Réserver maintenant</button>
                @endauth
            </div>
        @endif
    </div>

    <!-- If I try to render reservation modal component outside of the root of this component it will throw an error -->
    @if ($property->available)
        @livewire('reservation-modal', ['property' => $property])
    @endif
</div>

