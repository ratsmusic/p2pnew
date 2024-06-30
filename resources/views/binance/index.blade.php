<x-app-layout>
    <x-slot name="scripts">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </x-slot>
    <div class="breadcrumb mb-4">
        <p class="text-sm text-gray-500"><span class="mr-2">Pages</span> / <span class="text-white ml-2">Exchange Binance</span></p>
        <h1 class="text-xl font-semibold my-2">Exchange Binance</h1>
    </div>
    <!-- Dynamic Content -->
    <div class="content">  
        <div class="container mx-auto p-6">
            <!-- Header -->

            <livewire:components.binance.getfiat />

            <livewire:components.binance.getcoins />
           

            <!-- Exchange Rates -->
            <livewire:components.binance.get-dolar-price />


            <livewire:components.binance.arbitraje />
            <!-- Graph -->
            <div class="grid grid-cols-responsive-fit sm:grid-cols-custom-fit gap-4 mb-6">
           @livewire('components.binance.gracompra')
           @livewire('components.binance.graventa')
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx_buys_chart = document.getElementById('buys-chart').getContext('2d');
            const greenGradient = ctx_buys_chart.createLinearGradient(0, 0, 0, ctx_buys_chart.canvas.height);
            greenGradient.addColorStop(0, '#31AF36');
            greenGradient.addColorStop(1, 'rgba(38, 146, 42, 0.2)');
            new Chart(ctx_buys_chart, {
                type: 'line',
                data: {
                    labels: ['USDT', 'BTC', 'BNB', 'ETH', 'FDUSD', 'DAI', 'XRP', 'DOGE', 'ADA'],
                    datasets: [{
                        label: 'Buy',
                        backgroundColor: greenGradient,
                        data: [925, 510, 480, 460, 450, 440, 430, 420, 415],
                        fill: true,
                        borderColor: '#58D764',
                        tension: 0.1
                    }]
                },
                options: {
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: 'white',
                            },
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                borderDash: [5, 5],
                            },
                            ticks: {
                                callback: function(value, index, values) {
                                    // Display only the first, middle, and last ticks
                                    if (index === 0 || index === Math.floor(values.length / 2) || index === values.length - 1) {
                                        return value;
                                    } else {
                                        return '';
                                    }
                                },
                                maxTicksLimit: 6,
                                color: 'white',
                            },
                        }
                    },
                    plugins: {
                        legend: {
                            display: false,
                        },
                        customCanvasBackgroundColor: {
                            color: 'white',
                        }
                    }
                }
            });
            var ctx_sales_chart = document.getElementById('sales-chart').getContext('2d');
            const redGradient = ctx_sales_chart.createLinearGradient(0, 0, 0, ctx_sales_chart.canvas.height);
            redGradient.addColorStop(0, '#FF0000');
            redGradient.addColorStop(1, 'rgb(228, 142, 142, 0.2)');
            new Chart(ctx_sales_chart, {
                type: 'line',
                data: {
                    labels: ['USDT', 'BTC', 'BNB', 'ETH', 'FDUSD', 'DAI', 'XRP', 'DOGE', 'ADA'],
                    datasets: [{
                        label: 'Sell',
                        backgroundColor: redGradient,
                        data: [925, 510, 480, 460, 450, 440, 430, 420, 415],
                        fill: true,
                        borderColor: '#FA0707',
                        tension: 0.1
                    }]
                },
                options: {
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: 'white',
                            },
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                borderDash: [5, 5],
                            },
                            ticks: {
                                callback: function(value, index, values) {
                                    // Display only the first, middle, and last ticks
                                    if (index === 0 || index === Math.floor(values.length / 2) || index === values.length - 1) {
                                        return value;
                                    } else {
                                        return '';
                                    }
                                },
                                maxTicksLimit: 6,
                                color: 'white'
                            },
                        }
                    },
                    plugins: {
                        legend: {
                            display: false,
                        },
                        customCanvasBackgroundColor: {
                            color: 'white',
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>