{{--@push('scripts')--}}
{{--    <script>--}}
{{--        const myChart = new Chart(--}}
{{--            document.getElementById('myChart'),--}}
{{--            config // We'll add the configuration details later.--}}
{{--        );--}}
{{--    </script>--}}
{{--@endpush--}}

<x-app-layout>

    <div class="container mx-auto">
        <h2 class="text-white text-xl font-bold">Welcome to the app</h2>
    </div>


    <canvas id="expenseChart" style="width:100%;max-width:700px;margin-top:3em;"> </canvas>


    <script>
        function percentagesRelativeToSum(arr) {
            // Calculate the total sum of the array
            const totalSum = arr.reduce((sum, num) => sum + num, 0);

            // Calculate the percentage of each number relative to the total sum
            const percentages = arr.map(num => (num / totalSum) * 100);

            return percentages;
        }

        const array = [500, 5000, 3000, 5000];
        const percentages = percentagesRelativeToSum(array);


        const ctx = document.getElementById('expenseChart').getContext('2d');
       const yValues = percentages;
        const expenseChart = new Chart(ctx, {
            type: 'pie', // or 'bar'
            data: {
                labels: {!! json_encode($category_name) !!} , // {!!  json_encode($totals) !!},

                datasets: [{
                    label: 'Spending by Category',
                    data: yValues,//{!! json_encode($totals) !!},
                    backgroundColor: [
                        '#b91d47',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        // Add more colors as needed
                    ],
                    borderColor: [
                        '#b91d47',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        // Add more border colors as needed
                    ],
                    color: ['#fff'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
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
                }
            },

        });


        // $('#dateRange').on('change', function() {
        //     let dateRange = $(this).val();
        //
        //     $.ajax({
        //         url: '/get-spending-data',
        //         type: 'GET',
        //         data: { dateRange: dateRange },
        //         success: function(response) {
        //             // Update chart data
        //             expenseChart.data.labels = response.category_name;
        //             expenseChart.data.datasets[0].data = response.totals;
        //             expenseChart.update();
        //         }
        //     });
        // });

    </script>
</x-app-layout>

