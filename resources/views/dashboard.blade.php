<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="text-center font-semibold text-3xl text-gray-800 leading-tight">
            Vos réservations
        </h2>
    </x-slot>

    @if ($reservations->count() > 0)
        <div class="bg-white flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <table
                            class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                            <thead
                                class="border-b border-neutral-200 font-medium dark:border-white/10">
                                <tr>
                                    <th scope="col" class="px-6 py-4">#</th>
                                    <th scope="col" class="px-6 py-4">Adresse de la propriété</th>
                                    <th scope="col" class="px-6 py-4">À partir de</th>
                                    <th scope="col" class="px-6 py-4">Jusqu'à</th>
                                    <th scope="col" class="px-6 py-4">Un imprévu?</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for($i = 1; $i <= $reservations->count(); $i++)
                                @php
                                $property_address = $properties[$i - 1]->address;
                                $reservation_start_date = date_create($reservations[$i - 1]->start)->format('d-m-Y');
                                $reservation_end_date = date_create($reservations[$i - 1]->end)->format('d-m-Y');
                                @endphp
                                <tr class="border-b border-neutral-200 dark:border-white/10">
                                    <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $i }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ $property_address }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ $reservation_start_date }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ $reservation_end_date }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <form action="{{ route('cancel-reservation', ['id' => $reservations[$i - 1]->id])}}" method="GET">
                                            <button class="text-red-600" type="submit">Annuler la réservation</button>
                                        </form>
                                    </td>
                                </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @else
      <p class="text-2xl text-center font-dmsans mt-5">Pas de réservation pour l'instant</p>
    @endif

    @error('error')
       <p class="text-red-500 p-4 text-xl text-center">{{ $message }}</p>
    @enderror
</x-dashboard-layout>
