<x-app-layout>
    <div class="container mx-auto">
        @if(session()->has('status'))
            <div id="flash-message" class="bg-green-500 text-white p-4 w-1/4 rounded-md mt-5 flex justify-between">
                {{ session()->get('status') }}
                <button type="button" class="text-white text-lg" aria-hidden="true" onclick="this.parentElement.remove()">
                    &times;
                </button>
            </div>
        @endif

        <div class="mt-5">
            <h2 class="text-lg font-bold mb-5">A list of your recently added categories is given below:</h2>
            <ol class="list-decimal">
            @foreach($categories as $category)
               <li>{{ $category->name }}</li>
            @endforeach
            </ol>

        </div>
    </div>
</x-app-layout>


