<div x-data="{ talk : {{ $talk }}}">
    <p></p>
    <h1 class="text-center my-3 text-4xl font-bold" x-text="talk.subject"></h1>
    <ul x-data="{ messages : talk.messages}">
        <template x-for="message in messages">
            <li class="border rounded border-zinc-300 p-2" x-data="{ author : message.author }">
                <div class="flex flex-row justify-between align-items-start mb-3">
                    <h2 class="font-bold text-lg" x-text="author.name"></h2>
                    <p class="text-sm" x-text="(new Date(message.created_at)).toLocaleString()"></p>
                </div>
                <p x-text="message.text"></p>
            </li>
        </template>
    </ul>
    <form class="border p-4 flex flex-col justify-between" wire:submit.prevent="postMessage">
        <div class="mb-3 w-full flex flex-col">
            <label for="name">Nom</label>
            <input class="border" type="text" wire:model="user.name">
        </div>
        <div class="mb-3 flex flex-col">
            <label for="email">email</label>
            <input class="border" type="email" wire:model="user.email">
        </div>
        <div class="mb-3 flex flex-col">  
            <label for="text">Message</label>
            <textarea class="border" wire:model="message.text"></textarea>
        </div>
        <input class="bg-lime-500 py-2 text-white px-2 border rounded-md" type="submit" value="send">
    </form>
</div>
