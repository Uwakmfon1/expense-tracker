
<x-app-layout>

    <div class="container mx-auto">
                    <h2 class="text-2xl font-bold">Filter Chart By</h2>

{{--    </div>--}}


    <div>
        <form action="#" method="POST" >
            @csrf
            <div class="flex space-between">
                <div>
                    <label for="from">From</label>
                    <input type="date" id="from" name="from" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required >
                </div>
                <div>
                    <label for="to">To</label>
                    <input type="date" id="to" name="to" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required >
                </div>
            </div>

        </form>
    </div>

    <canvas id="expenseChart" width="800" height="400" > </canvas>




    <script>
        function getData(){
        $.ajax({
            url:'/dashboard',
            method:'GET',
            dataType:'json',
            data:{
                'category':$("#category").val(),
                'from':$("#from").val(),
                'to':$("#to").val(),
            },
            success: function(data){
                const category = data.category;
                const categoryData = data.categoryData;

                const ctx = document.getElementById('expenseChart').getContext('2d');
                const expenseChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: <?= json_encode($data['labels']) ?>,
                        datasets: <?= json_encode($data['datasets']) ?>,

                        // borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(75, 192, 192, 1)'],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio:false,
                        scales:{
                            y:{
                                beginAtZero:true,
                            }
                        },

                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            tooltip: {
                                enabled: true
                            }
                        },
                        title:{
                            display:true,
                            text:"Testing the app",
                            color:'#fff'
                        },
                    },
                });
            },
            error: function(error){
                console.log(error);
            }
        })
        }

    $(function(){
        getData();
    })



    </script>
</x-app-layout>

