<x-app-layout>
    <div class="container mx-auto mt-5">

        @if(session()->has('status'))
            <div id="flash-message" class="bg-green-500 text-white p-4 w-1/4 rounded-md mt-5 flex justify-between">
                {{ session()->get('status') }}
                <button type="button" class="text-white text-lg" aria-hidden="true" onclick="this.parentElement.remove()">
                    &times;
                </button>
            </div>
        @endif
        <br>


        @if($budget->count() > 0 )
            <div class="container">

                <div class="flex space-x-8">
                    @foreach($budget as $budget_item)
                        <div  class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <svg class="w-7 h-7 text-gray-500 dark:text-gray-400 mb-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M18 5h-.7c.229-.467.349-.98.351-1.5a3.5 3.5 0 0 0-3.5-3.5c-1.717 0-3.215 1.2-4.331 2.481C8.4.842 6.949 0 5.5 0A3.5 3.5 0 0 0 2 3.5c.003.52.123 1.033.351 1.5H2a2 2 0 0 0-2 2v3a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V7a2 2 0 0 0-2-2ZM8.058 5H5.5a1.5 1.5 0 0 1 0-3c.9 0 2 .754 3.092 2.122-.219.337-.392.635-.534.878Zm6.1 0h-3.742c.933-1.368 2.371-3 3.739-3a1.5 1.5 0 0 1 0 3h.003ZM11 13H9v7h2v-7Zm-4 0H2v5a2 2 0 0 0 2 2h3v-7Zm6 0v7h3a2 2 0 0 0 2-2v-5h-5Z"/>
                            </svg>
                            <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ $budget_item->name }}</h5>

                            <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">{{ $budget_item->description }}</p>
                            <p  class="inline-flex font-medium items-center text-white">
                                ₦{{   number_format($budget_item->amount, 0, '', ',')}}
                                <svg class="w-3 h-3 ms-2.5 rtl:rotate-[270deg]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11v4.833A1.166 1.166 0 0 1 13.833 17H2.167A1.167 1.167 0 0 1 1 15.833V4.167A1.166 1.166 0 0 1 2.167 3h4.618m4.447-2H17v5.768M9.111 8.889l7.778-7.778"/>
                                </svg>
                            </p>
                            <div class="flex space-x-8">
                                <a href="{{ url('budget/edit',$budget_item->id) }}" class="bg-gray-500 text-white p-2 rounded-md hover:bg-gray-600">Edit Amount </a>
                                <form action="{{ url('budget/delete',$budget_item->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$budget_item->id}}">
                                    <input type="submit" name="deleteItem" id="deleteItem" value="Delete Amount" onclick="return confirm('Are You Sure Want to Delete?')" class="bg-red-400 text-white p-2 rounded-md hover:bg-red-600">
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
                <br><br>
                <div>
                    <a class="bg-green-500 text-white p-4 rounded-md mt-5 hover:bg-gray-700" href="{{ route('budget.create') }}">Add a new budget</a>
                </div>
                @else
                    <div class="mt-10">


                        <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <svg class="w-7 h-7 text-gray-500 dark:text-gray-400 mb-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M18 5h-.7c.229-.467.349-.98.351-1.5a3.5 3.5 0 0 0-3.5-3.5c-1.717 0-3.215 1.2-4.331 2.481C8.4.842 6.949 0 5.5 0A3.5 3.5 0 0 0 2 3.5c.003.52.123 1.033.351 1.5H2a2 2 0 0 0-2 2v3a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V7a2 2 0 0 0-2-2ZM8.058 5H5.5a1.5 1.5 0 0 1 0-3c.9 0 2 .754 3.092 2.122-.219.337-.392.635-.534.878Zm6.1 0h-3.742c.933-1.368 2.371-3 3.739-3a1.5 1.5 0 0 1 0 3h.003ZM11 13H9v7h2v-7Zm-4 0H2v5a2 2 0 0 0 2 2h3v-7Zm6 0v7h3a2 2 0 0 0 2-2v-5h-5Z"/>
                            </svg>
                            <a href="#">
                                <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">No Records of budget Found</h5>
                            </a>
                            <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">To create budget, go to the create budget page:</p>
                            <a href="{{ route('budget.create') }}" class="inline-flex font-medium items-center text-blue-600 hover:underline">
                                Create new budget
                                <svg class="w-3 h-3 ms-2.5 rtl:rotate-[270deg]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11v4.833A1.166 1.166 0 0 1 13.833 17H2.167A1.167 1.167 0 0 1 1 15.833V4.167A1.166 1.166 0 0 1 2.167 3h4.618m4.447-2H17v5.768M9.111 8.889l7.778-7.778"/>
                                </svg>
                            </a>
                        </div>

                    </div>
                @endif
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const flashMessage = document.getElementById('flash-message');
                    if (flashMessage) {
                        setTimeout(() => {
                            flashMessage.style.display = 'none';
                        }, 3000); // 3 seconds
                    }
                });
            </script>
    </div>
</x-app-layout>
