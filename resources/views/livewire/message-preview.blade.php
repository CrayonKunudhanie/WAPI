<div class="flex" x-data="{ 
    message: @entangle('message').defer, 
    error: '', 
    showButton: @entangle('showButton').defer,
    buttonText: @entangle('buttonText').defer,
    buttonUrl: @entangle('buttonUrl').defer,
    getPreviewMessage() {
        return this.message ? this.message.replace(/\{\{\s*nama\s*\}\}/g, 'Jennie') : '';
    },
    insertTag(tag) {
        let textarea = this.$refs.messageTextarea;
        let cursorPosStart = textarea.selectionStart;
        let cursorPosEnd = textarea.selectionEnd;
        let textBefore = textarea.value.substring(0, cursorPosStart);
        let selectedText = textarea.value.substring(cursorPosStart, cursorPosEnd);
        let textAfter = textarea.value.substring(cursorPosEnd);

        // Wrap the selected text with the tag
        if (Array.isArray(tag)) {
            this.message = textBefore + tag[0] + selectedText + tag[1] + textAfter;
            this.$nextTick(() => {
                textarea.setSelectionRange(cursorPosStart + tag[0].length, cursorPosEnd + tag[0].length);
            });
        } else {
            this.message = textBefore + tag + textAfter;
            this.$nextTick(() => {
                textarea.setSelectionRange(cursorPosStart + tag.length, cursorPosEnd + tag.length);
            });
        }
        
        textarea.focus();
    },
    convertToBoolean(value) {
        return value === 'true';
    }
}" @insert-tag.window="insertTag($event.detail.tag)">
    <div class="w-1/2 p-4">
        <form wire:submit.prevent="save">
            <div class="mb-4">
                <label for="nama_broadcast" class="block text-gray-700 font-bold mb-2">Nama Broadcast</label>
                <input type="text" id="nama_broadcast" name="nama_broadcast" wire:model="bcname" placeholder="Nama broadcast" class="border border-gray-300 shadow-md rounded py-2 px-3 w-1/3 text-gray-700 leading-tight focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="template" class="block text-gray-700 font-bold mb-2">Template</label>
                <select id="template" name="template" wire:model="template_id" class="border border-gray-300 shadow-md rounded py-2 px-3 w-1/3 text-gray-700 leading-tight focus:shadow-outline">
                    <option value="">Pilih Template</option>
                </select>
            </div>

            <div class="mb-4 mt-8">
                <label for="kontak" class="block text-gray-700 font-bold mb-2">Kontak</label>
                <select id="kontak" name="kontak" wire:model="kontak_id" class="border border-gray-300 shadow-md rounded py-2 px-3 w-1/3 text-gray-700 leading-tight focus:shadow-outline">
                    <option value="">Pilih kontak</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="schedule" class="block text-gray-700 font-bold mb-2">Schedule</label>
                <div class="flex space-x-2">
                    <input type="date" id="schedule" name="schedule" wire:model="waktu" class="shadow appearance-none border rounded w-45 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <input type="number" id="hour" name="hour" placeholder="00" min="0" max="23" wire:model.lazy="hour" class="shadow appearance-none border rounded w-16 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <input type="number" id="minute" name="minute" placeholder="00" min="0" max="59" wire:model.lazy="minute" class="shadow appearance-none border rounded w-16 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
            </div>

            <div class="mb-4">
                <label for="message" class="block text-gray-700 text-sm font-bold mb-2">Pesan:</label>
                <button type="button" @click.prevent="$dispatch('insert-tag', { tag: '\{\{ nama \}\}' })" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2">Jennie</button>
                <button type="button" @click.prevent="$dispatch('insert-tag', { tag: ['<b>', '</b>'] })" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2">Bold</button>
                <textarea id="message" name="message" x-ref="messageTextarea" x-model="message" wire:model="message" rows="6" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
            </div>

            <div class="mb-4">
                <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Gambar:</label>
                <input type="file" id="image" name="image" wire:model="image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <div x-show="error" class="text-red-500 mt-2" x-text="error"></div>
                @if ($customError)
                <span class="text-red-500">{{ $customError }}</span>
                @else
                @error('image') <span class="text-red-500">{{ $message }}</span> @enderror
                @endif
            </div>

            <div class="mb-4">
                <label for="interaction" class="block text-gray-700 text-sm font-bold mb-2">Tombol Interaksi:</label>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center">
                        <input type="radio" id="ada" name="showButton" value="true" x-model="showButton" class="mr-2 leading-tight">
                        <label for="ada" class="text-gray-700">Ada</label>
                    </div>
                    <div class="flex items-center">
                        <input type="radio" id="tidak" name="showButton" value="false" x-model="showButton" class="mr-2 leading-tight">
                        <label for="tidak" class="text-gray-700">Tidak</label>
                    </div>
                </div>
            </div>

            <div x-show="convertToBoolean(showButton)" class="mb-4">
                <label for="buttonUrl" class="block text-gray-700 font-bold mb-2">Alamat URL:</label>
                <input type="text" id="buttonUrl" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Masukkan Alamat URL" x-model="buttonUrl">
            </div>

            <div x-show="convertToBoolean(showButton)" class="mb-4">
                <label for="buttonText" class="block text-gray-700 font-bold mb-2">Isi Tombol:</label>
                <input type="text" id="buttonText" x-model="buttonText" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2">Simpan</button>
            </div>
        </form>
    </div>
    <div class="w-1/2 p-4">
        <div class="max-w-lg mx-auto bg-white shadow-lg rounded-lg overflow-hidden mb-4">
            <div class="bg-cover h-96" style="background-image: url('{{ $image ? $image->temporaryUrl() : asset('assets/default.jpg') }}')"></div>
            <div class="p-4">
                <h1 class="text-gray-900 font-bold text-2xl break-words whitespace-normal" x-html="getPreviewMessage()"></h1>
                <p class="mt-2 text-gray-600">Your Preview</p>
            </div>
        </div>
        <div x-show="convertToBoolean(showButton)" class="max-w-lg mx-auto bg-white shadow-lg rounded-lg p-4">
            <a :href="buttonUrl" target="_blank" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full text-center block" x-text="buttonText || 'CEK SEKARANG'"></a>
        </div>
    </div>
</div>
