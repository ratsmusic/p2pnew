<div>
    <div class="card z-index-2 bg-dark rounded-3" wire:poll.2000ms>
        <div class="card-body " wire:ignore>
            <div class="text-center text-white text-2xl mb-1" style="margin-top: -15px;">Volumen de Compra</div>
            <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                <div class="chart">
                    <canvas id="chart-line" class="chart-canvas" height="170"></canvas>
                </div>
            </div>
        </div>
    </div>


   
</div>

@push("js")
    

<script>
    var ctx2 = document.getElementById("chart-line").getContext("2d");

var chartcompra = new Chart(ctx2, {
type: "line",
data: {
    labels: [],
    datasets: [{
        label: "Volumen",
        tension: 0,
        borderWidth: 0,
        pointRadius: 5,
        pointBackgroundColor: "rgba(255, 255, 255, .8)",
        pointBorderColor: "transparent",
        borderColor: "rgba(255, 255, 255, .8)",
        borderColor: "rgba(255, 255, 255, .8)",
        borderWidth: 4,
        backgroundColor: "transparent",
        fill: true,
        data: [],
        maxBarThickness: 6

    }],
},
options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        legend: {
            display: false,
        }
    },
    interaction: {
        intersect: false,
        mode: 'index',
    },
    scales: {
        y: {
            grid: {
                drawBorder: false,
                display: true,
                drawOnChartArea: true,
                drawTicks: false,
                borderDash: [5, 5],
                color: 'rgba(255, 255, 255, .2)'
            },
            ticks: {
                display: true,
                color: '#f8f9fa',
                padding: 10,
                font: {
                    size: 14,
                    weight: 300,
                    family: "Roboto",
                    style: 'normal',
                    lineHeight: 2
                },
            }
        },
        x: {
            grid: {
                drawBorder: false,
                display: false,
                drawOnChartArea: false,
                drawTicks: false,
                borderDash: [5, 5]
            },
            ticks: {
                display: true,
                color: '#f8f9fa',
                padding: 10,
                font: {
                    size: 14,
                    weight: 300,
                    family: "Roboto",
                    style: 'normal',
                    lineHeight: 2
                },
            }
        },
    },
},
});

Livewire.on('updateChart', data => {
    chartcompra.data.labels = data[0].labels;
    chartcompra.data.datasets[0].data = data[0].datos;
    chartcompra.update();
});
</script>
@endpush