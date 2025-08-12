<section class="bg-[#fff2ff] py-14">
    <div class="flex flex-col items-center">
        <h2 class="font-maharlika text-xl xs:text-2xl sm:text-3xl md:text-4xl lg:mb-10">Nos propriètés disponibles</h2>

        <div class="lg:grid lg:grid-cols-2 lg:gap-y-10 lg:gap-x-14">
            @foreach($properties as $property)
                <div class="mt-10 lg:mt-0">
                    @livewire('property-card', ['property' => $property])
                </div>
            @endforeach
        </div>
    </div>
</section>
