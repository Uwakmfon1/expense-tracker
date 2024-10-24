<x-app-layout>
    <div class="container mx-auto">
        <h2 class="text-white text-xl font-bold">Want to create a new transaction</h2>
{{--        @dd($expenses)--}}
        @if($expenses->count() > 0)

        <ul>
        @foreach($expenses as $expense)
                <li> {{ $expense }}</li>
        @endforeach
        </ul>
        @else
            <h2>There are no current Expenses</h2>
        @endif
    </div>
</x-app-layout>

