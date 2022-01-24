<div>
    <div>
        <ul x-data="{ talks: {{$talks}}}">
            <template x-for="talk in talks" :key="talk.id">
                <li class="border hover:bg-gray-200 p-2">
                    <a x-bind:href="'/' + talk.id">
                        <div class="flex flex-row justify-between align-center">
                            <h2 class="text-2xl font-bold" x-text="talk.subject + ' - ' + talk.messages.length + ' message(s)'"></h2>
                            <p class="text-sm" x-text="'crée le '+(new Date(talk.created_at).toLocaleString())"></p>
                        </div>
                        <hr class="my-1">
                        <p class="">Dernier message:</p>
                        <div class="flex flex-row justify-between" x-data="{ lastMessage : talk.messages.slice(-1)[0]}">
                            <template x-if="lastMessage != null">
                            <p x-text="lastMessage.text"></p>
                            <p x-text="(new Date(lastMessage.created_at)).toLocaleString()"></p>
                            </template>
                        </div>
                    </a>
                </li>
            </template>
        </ul>
    </div>
    <div x-ignore class="border p-4 flex flex-col">
        <form wire:submit.prevent="newTalk">
            <h2>Créer une conversation</h2>
            <div class="flex flex-col mb-3">
                <label for="subject">sujet de conversation</label>
                <input class="border" type="text" name="subject" wire:model="talk.subject">
                @error('talk.subject') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
            </div>
            <input class="bg-lime-500 py-2 text-white px-2 border rounded-md" type="submit" value="nouvelle conversation">
        </form>
    </div>
</div>
