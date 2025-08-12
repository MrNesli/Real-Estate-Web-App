<div
    data-property-id="{{ $property->id }}"
    class="reservation-modal hidden fixed inset-0 z-[999] grid h-screen w-screen place-items-center bg-black/20 backdrop-blur-sm transition-opacity duration-300"
>
    <div
        class="reservation-form relative mx-auto w-full max-w-[24rem] rounded-lg overflow-hidden shadow-sm"
    >
        <div class="relative flex flex-col bg-white">
            <form action="{{ route('reserve-property', ['id' => $property->id]) }}" method="POST">
                @csrf
                <input class="hidden" type="text" name="" value="">
                <div class="relative items-center flex justify-center text-white h-16 rounded-md bg-slate-800">
                    <h3 class="text-2xl">
                        Réservation
                    </h3>
                </div>
                <div class="flex flex-col gap-4 p-6">
                    <div class="w-full max-w-sm min-w-[200px]">
                        <p class="block text-sm text-slate-600">
                            Adresse de la propriété: <span class="font-bold">{{ $property->address }} </span>
                        </p>
                    </div>
                    <div class="w-full max-w-sm min-w-[200px]">
                        <p class="block mb-2 text-sm text-slate-600">
                            Prix/jour de la propriété: <span class="font-bold">€{{ $property->price_in_euros }}</span>
                        </p>
                    </div>

                    <div class="w-full max-w-sm min-w-[200px]">
                        <label class="block mb-2 text-sm text-slate-600">
                            À partir de
                        </label>
                        @php
                        $from = date_create($property->available_from)->format('Y-m-d');
                        $from = str_replace(' ', 'T', $from);
                        $to = date_create($property->available_to)->format('Y-m-d');
                        $to = str_replace(' ', 'T', $to);
                        @endphp
                        <input type="date" min="{{ $from }}" max="{{ $to }}" name="start-date" class="reserve-start-date w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" required />
                    </div>

                    <div class="w-full max-w-sm min-w-[200px]">
                        <label class="block mb-2 text-sm text-slate-600">
                            Jusqu'à
                        </label>
                        <input type="date" min="{{ $from }}" max="{{ $to }}" name="end-date" class="reserve-end-date w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" required />
                    </div>
                </div>
                <div class="p-6 pt-0">
                    <button class="w-full rounded-md bg-slate-800 py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="submit">
                        Réserver
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
