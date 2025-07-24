<div class="max-w-md p-6 mx-auto bg-white rounded-lg shadow-md">
    <h2 class="mb-6 text-2xl font-bold text-gray-800">Adatok feltöltése Notion-ba</h2>

    <form wire:submit="submit" class="space-y-4">
        <div>
            <label for="név" class="block mb-1 text-sm font-medium text-gray-700">
                Név <span class="text-red-500">*</span>
            </label>
            <input type="text" id="név" wire:model="név"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('név') border-red-500 @enderror"
                placeholder="Teljes név">
            @error('név')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block mb-1 text-sm font-medium text-gray-700">
                Email cím
            </label>
            <input type="email" id="email" wire:model="email"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror"
                placeholder="pelda@email.com">
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="telefon" class="block mb-1 text-sm font-medium text-gray-700">
                Telefonszám
            </label>
            <input type="text" id="telefon" wire:model="telefon"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('telefon') border-red-500 @enderror"
                placeholder="+36 30 123 4567">
            @error('telefon')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="ár" class="block mb-1 text-sm font-medium text-gray-700">
                Ár (Ft)
            </label>
            <input type="number" id="ár" wire:model="ár"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('ár') border-red-500 @enderror"
                placeholder="150000">
            @error('ár')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="megjegyzés" class="block mb-1 text-sm font-medium text-gray-700">
                Megjegyzés
            </label>
            <textarea id="megjegyzés" wire:model="megjegyzés" rows="3"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('megjegyzés') border-red-500 @enderror"
                placeholder="Opcionális megjegyzés..."></textarea>
            @error('megjegyzés')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
            class="w-full px-4 py-2 text-white transition duration-200 bg-blue-600 rounded-md hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            Feltöltés Notion-ba
        </button>
    </form>

    @if ($message)
        <div
            class="mt-4 p-4 rounded-md {{ $success ? 'bg-green-100 border border-green-400 text-green-700' : 'bg-red-100 border border-red-400 text-red-700' }}">
            {{ $message }}
        </div>
    @endif
</div>
