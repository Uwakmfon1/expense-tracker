
<x-app-layout>

    <div class="container mx-auto">
        <h2 class="text-white text-xl font-bold">Welcome to the app</h2>
    </div>



    <canvas id="expenseChart" > </canvas>




    <script>
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
        },});
    </script>
</x-app-layout>

