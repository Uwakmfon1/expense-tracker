<x-app-layout>
   <div class="container mx-auto mt-5">
       <h1 class="fs-4 text-lg fw-bolder">Welcome here</h1>
       <div>
       <ol class="list-decimal">
           @foreach($income as $income_item)
               <li>{{ $income_item->name }} -- ₦{{$income_item->amount}}</li>
           @endforeach
       </ol>

       </div>
   </div>
</x-app-layout>
