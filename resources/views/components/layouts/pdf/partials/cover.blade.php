@props(['requestQuote' => $requestQuote])
<div class="relative bg-black">
    <img src="{{ Vite::asset('resources/images/eboldal-arajanlat-borito.jpg') }}" alt="Cégem 360" class=""
        style="width: 843px; height: 990px;" />
    <!-- Felső sáv -->
    <div class="absolute top-0 left-0 flex justify-between w-full px-8 pt-8">
        <span class="text-base font-bold tracking-wide text-white">CÉGEM 360</span>
        <span class="text-base font-light tracking-wide text-white">PRÉMIUM WEBOLDAL KÉSZÍTÉS</span>
    </div>
    <!-- Középső cím -->
    <div class="absolute left-0 right-0 flex flex-col items-start justify-center" style="top: 600px; padding-left: 60px;">
        <span class="mb-2 text-5xl font-bold text-white">Árajánlat</span>
        <span class="text-4xl font-normal text-white">{{ $requestQuote->name }}</span>
    </div>
</div>
