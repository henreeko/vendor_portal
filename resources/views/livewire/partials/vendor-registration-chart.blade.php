<div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
    <div class="flex justify-between items-center mb-4">
        <div>
            <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white">{{ array_sum($data) }}</h5>
            <p class="text-base font-normal text-gray-500 dark:text-gray-400">Vendor Registrations</p>
        </div>
    </div>
    <canvas id="vendorRegistrationChart" class="w-full"></canvas>
</div>


<script>
document.addEventListener('livewire:load', function () {
    var ctx = document.getElementById('vendorRegistrationChart').getContext('2d');
    var gradientFill = ctx.createLinearGradient(0, 0, 0, 300);
    // Red gradient from more opaque to more transparent
    gradientFill.addColorStop(0, "rgba(255, 99, 132, 0.8)"); // Brighter red at the top
    gradientFill.addColorStop(1, "rgba(255, 99, 132, 0)");   // Transparent red at the bottom

    var myChart = new Chart(ctx, {
        type: 'line', 
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Vendor Registrations',
                data: @json($data),
                backgroundColor: gradientFill,
                borderColor: '#ff6384', // Lighter red for the line
                borderWidth: 2,
                pointBackgroundColor: '#ffffff', // White points
                pointBorderColor: '#ff6384', // Red borders for points
                pointHoverBackgroundColor: '#ff6384', // Red background on hover
                pointHoverBorderColor: '#ffffff', // White border on hover
                tension: 0.4 // Smooth the line
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    mode: 'index',
                    intersect: false
                }
            }
        }
    });
});
</script>

    
<style>
    #vendorRegistrationChart {
    max-height: 300px; /* Example fixed max-height */
    max-width: 500px; /* Example fixed max-height */
    }
</style>
    