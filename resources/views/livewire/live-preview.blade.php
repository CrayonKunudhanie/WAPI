

<div class="flex">
    <div class="w-1/2 p-4">
        <form>
            <div class="mb-4">
                <label for="message" class="block text-gray-700 text-sm font-bold mb-2">Pesan:</label>
                <textarea id="message" wire:model.lazy="message" rows="6" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
            </div>
            <div class="mb-4">
                <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Gambar:</label>
                <input type="file" id="image" wire:model="image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
        </form>
    </div>
    <div class="w-1/2 p-4">
        <div class="max-w-sm mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="bg-cover h-56" style="background-image: url('{{ $image ? $image->temporaryUrl() : 'default.jpg' }}')">
            </div>
            <div class="p-4">
                <h1 class="text-gray-900 font-bold text-2xl" style="white-space: pre-wrap;">{{ $message }}</h1>
                <p class="mt-2 text-gray-600">Your Preview</p>
            </div>
        </div>
    </div>
</div>