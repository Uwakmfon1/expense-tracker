<x-app-layout>
    <div class="container mx-auto">
            @if(session()->has('message'))
                <div class="bg-green-500 text-white p-4 rounded-md mt-5 flex justify-between">
                    {{ session()->get('message') }}
                    <button type="button" class="text-white text-lg" aria-hidden="true" onclick="this.parentElement.remove()">
                        &times;
                    </button>
                </div>
            @endif

        <form action="{{ url('/categories/store') }}" method="POST" class="mt-5 max-w-sm mx-auto border-white">
            @csrf
            <h2 class="font-bold text-white">Create a new Category</h2>
            <br>
            <div>
                    <label for="parent_category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category Type:</label>
                    <select id="parent_category_id" name="parent_category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        <option value="" disabled selected> Select a type </option>
                        @foreach($parent_category as $parent_category_item)
                        <option value="{{ $parent_category_item->id }}">
                            {{$parent_category_item->name}}
                        </option>
                        @endforeach
                    </select>
                        <input type="hidden" value="{{ $user_id }}" name="user_id">
            </div>

            <div class="mb-5">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category Name</label>
                <input type="text" id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required />
            </div>

            <div class="mb-5">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                <input type="text" id="description" name="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required />
            </div>

            <input type="submit" value="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        </form>

    </div>
</x-app-layout>

