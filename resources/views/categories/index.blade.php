<x-app-layout>
    <div class="container mx-auto">
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


