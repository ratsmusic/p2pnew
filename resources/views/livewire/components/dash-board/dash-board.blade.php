<div>
    <x-app-layout>
        <x-slot name="scripts">
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        </x-slot>
        <div class="breadcrumb mb-4">
            <p class="text-sm text-gray-500"><span class="mr-2">Pages</span> / <span class="text-white ml-2">Dashboard</span></p>
            <h1 class="text-xl font-semibold my-2">Dashboard</h1>
        </div>
        <!-- Dynamic Content -->
        <div class="content">
            <!-- Opportunity Card -->
            <div class="custom-gradient text-[#1A2232] p-6 rounded-lg shadow-lg max-w-4xl mx-auto my-8">
                <div class="text-center mb-6">
                    <h2 class="text-2xl font-bold text-[#1A2232]">Cuadro de oportunidades</h2>
                </div>
                <div class="flex flex-col sm:flex-row justify-between items-center">
                    <!-- Moneda más barata -->
                    <div class="flex-1 text-center mx-4 p-4">
                        <h3 class="text-xl font-semibold mb-4 text-[#1A2232]">Moneda más barata</h3>
                        <div class="flex items-center justify-center mb-4">
                            <img src="{{ asset('img/coin/exchange/' . strtolower($bestBuyExchange) . '.png') }}" alt="Binance Logo" class="h-8 mr-2" style="height: 20px !important;">-------
                        </div>
                        <div class="flex flex-col items-center text-[#1A2232]">
                            <div class="flex justify-between w-full px-6 mb-2">
                                <span class="font-[600]">Compra</span>
                                <span class="text-[#30FFC5] font-[700]">{{ number_format($bestBuyPrice, 2) }}</span>
                            </div>
                            <div class="flex justify-between w-full px-6 mb-2">
                                <span class="font-[600]">Precio Moneda Fiat</span>
                                <span class="text-[#30FFC5] font-[700]">{{ number_format($webodii, 2) }}</span>
                            </div>
                          
                        </div>
                    </div>
                    <hr class="w-[161px] h-[1px] bg-[#C8FFF0] sm:w-[1px] sm:h-[161px]" />
                    <!-- Moneda más cara -->
                    <div class="flex-1 text-center mx-4 p-4">
                        <h3 class="text-xl font-semibold mb-4 text-[#1A2232]">Moneda más cara</h3>
                        <div class="flex items-center justify-center mb-4">
                            <img src="{{ asset('assets/images/kucoinB.png') }}" alt="Kucoin Logo" class="h-8 mr-2">
                        </div>
                        <div class="flex flex-col items-center text-[#1A2232]">
                            <div class="flex justify-between w-full px-6 mb-2">
                                <span class="font-[600]">Venta</span>
                                <span class="text-[#FF0000] font-[700]">{{ number_format($bestSellPrice, 2) }}</span>
                            </div>
                            <div class="flex justify-between w-full px-6 mb-2">
                                <span class="font-[600]">Precio Moneda Fiat</span>
                                <span class="text-[#FF0000] font-[700]">{{ number_format($webodii2, 2) }}</span>
                            </div>
                          
                        </div>
                    </div>
                </div>
                <div class="flex gap-1 justify-center w-full px-6">
                    <span class="font-[600]">Profit</span>
                    <span class="font-[600]">{{ number_format($potentialProfit, 2) }}%</span>
                </div>
            </div>
            
            <!-- Exchange Cards -->
            <div class="flex flex-col md:flex-row gap-4 max-w-4xl mx-auto my-8">
                <div class="bg-secondaryBg text-white p-6 rounded-lg shadow-lg w-full">
                    <div class="text-center mb-4">
                        <img src="{{ asset('assets/images/binance.png') }}" alt="Binance Logo" class="h-8 mx-auto mb-2" />
                    </div>
                    <div class="flex justify-between w-full px-2 mb-2">
                        <span class="font-[600]">Compra</span>
                        <span class="text-[#30FFC5] font-[700] flex items-center">USDT 1000 <img src="{{ asset('assets/images/usdt.png') }}" alt="usdt" class="inline h-5 ml-2" /></span>
                    </div>
                    <div class="flex justify-between w-full px-2 mb-2">
                        <span class="font-[600]">Venta</span>
                        <span class="text-[#FF0000] font-[700] flex items-center">BNB 3000 <img src="{{ asset('assets/images/bnb.png') }}" alt="bnb" class="inline h-5 ml-2"/></span>
                    </div>
                </div>
                <div class="bg-secondaryBg text-white p-6 rounded-lg shadow-lg w-full">
                    <div class="text-center mb-4">
                        <img src="{{ asset('assets/images/kucoin.png') }}" alt="Binance Logo" class="h-8 mx-auto mb-2" />
                    </div>
                    <div class="flex justify-between w-full px-2 mb-2">
                        <span class="font-[600]">Compra</span>
                        <span class="text-[#30FFC5] font-[700] flex items-center">USDT 1000 <img src="{{ asset('assets/images/usdt.png') }}" alt="usdt" class="inline h-5 ml-2" /></span>
                    </div>
                    <div class="flex justify-between w-full px-2 mb-2">
                        <span class="font-[600]">Venta</span>
                        <span class="text-[#FF0000] font-[700] flex items-center">BNB 3000 <img src="{{ asset('assets/images/bnb.png') }}" alt="bnb" class="inline h-5 ml-2"/></span>
                    </div>
                </div>
                <div class="bg-secondaryBg text-white p-6 rounded-lg shadow-lg w-full">
                    <div class="text-center mb-4">
                        <img src="{{ asset('assets/images/okx.png') }}" alt="Binance Logo" class="h-8 mx-auto mb-2" />
                    </div>
                    <div class="flex justify-between w-full px-2 mb-2">
                        <span class="font-[600]">Compra</span>
                        <span class="text-[#30FFC5] font-[700] flex items-center">USDT 1000 <img src="{{ asset('assets/images/usdt.png') }}" alt="usdt" class="inline h-5 ml-2" /></span>
                    </div>
                    <div class="flex justify-between w-full px-2 mb-2">
                        <span class="font-[600]">Venta</span>
                        <span class="text-[#FF0000] font-[700] flex items-center">BNB 3000 <img src="{{ asset('assets/images/bnb.png') }}" alt="bnb" class="inline h-5 ml-2"/></span>
                    </div>
                </div>
            </div>
            <!-- survey card -->
            <div class="flex flex-col md:flex-row gap-5 my-8">
                <div class="bg-secondaryBg text-white p-6 rounded-lg shadow-lg w-full flex flex-col justify-between items-center">
                    <div class="text-center">
                        <h2 class="text-lg font-semibold mb-1">Cripto más comprada</h2>
                        <p class="text-sm text-gray-400 mb-4">Binance, KuCoin y OkEx</p>
                    </div>
                    <div class="space-y-2 w-full">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-2">
                                <img src="{{ asset('assets/images/usdt.png') }}" alt="usdt">
                                <span class="font-[600]">USDT</span>
                            </div>
                            <span class="font-[600]">20%</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-2">
                                <img src="{{ asset('assets/images/bnb.png') }}" alt="bnb">
                                <span class="font-[600]">BNB</span>
                            </div>
                            <span class="font-[600]">18%</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-2">
                                <img src="{{ asset('assets/images/eth.png') }}" alt="eth">
                                <span class="font-[600]">ETH</span>
                            </div>
                            <span class="font-[600]">15%</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-2">
                                <img src="{{ asset('assets/images/btc.png') }}" alt="btc">
                                <span class="font-[600]">BTC</span>
                            </div>
                            <span class="font-[600]">10%</span>
                        </div>
                    </div>
                    <button class="mt-4 w-full bg-transparent border border-[#31AF36] hover:bg-[#31AF36] text-white py-2 rounded-lg transition-all">
                        Select exchange
                    </button>
                </div>
                <div class="bg-secondaryBg text-white p-6 rounded-lg shadow-lg w-full flex flex-col justify-between items-center">
                    <div class="text-center">
                        <h2 class="text-lg font-semibold mb-1">Cripto más comprada</h2>
                        <p class="text-sm text-gray-400 mb-4">Binance, KuCoin y OkEx</p>
                    </div>
                    <div class="space-y-2 w-full">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-2">
                                <img src="{{ asset('assets/images/usdt.png') }}" alt="usdt">
                                <span class="font-[600]">USDT</span>
                            </div>
                            <span class="font-[600]">20%</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-2">
                                <img src="{{ asset('assets/images/bnb.png') }}" alt="bnb">
                                <span class="font-[600]">BNB</span>
                            </div>
                            <span class="font-[600]">18%</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-2">
                                <img src="{{ asset('assets/images/eth.png') }}" alt="eth">
                                <span class="font-[600]">ETH</span>
                            </div>
                            <span class="font-[600]">15%</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-2">
                                <img src="{{ asset('assets/images/btc.png') }}" alt="btc">
                                <span class="font-[600]">BTC</span>
                            </div>
                            <span class="font-[600]">10%</span>
                        </div>
                    </div>
                    <button class="mt-4 w-full bg-transparent border border-[#31AF36] hover:bg-[#31AF36] text-white py-2 rounded-lg transition-all">
                        Select exchange
                    </button>
                </div>
                <div class="bg-secondaryBg text-white p-6 rounded-lg shadow-lg w-full flex flex-col justify-between items-center">
                    <div class="graph pie-gradient rounded-lg p-3">
                        <canvas id="daily-sales-donut-chart"></canvas>
                    </div>
                    <div class="flex justify-between items-center w-full">
                        <div>
                            <h3 class="text-lg font-medium">Exchange más usado</h3>
                            <p class="text-sm text-gray-400">Binance, KuCoin y OkEx</p>
                        </div>
                        <div class="flex gap-2">
                            <button>
                                <img src="{{ asset('assets/images/share.png') }}" alt="share">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- graph card -->
            <div class="flex flex-col md:flex-row gap-5 my-8">
                <!-- Website views card -->
                <div class="w-full p-4 bg-secondaryBg rounded-lg shadow-md">
                    <div class="graph bg-[#195B46] rounded-lg p-3">
                        <canvas id="website-view-chart"></canvas>
                    </div>
                    <div class="flex justify-between items-center pb-4 border-b border-[#09BE8B]">
                        <div>
                            <h3 class="text-lg font-medium">Website views</h3>
                            <p class="text-sm text-gray-400">Last campaign performance</p>
                        </div>
                        <div class="flex gap-2">
                            <button class="flex-grow px-3 py-1 mr-2 text-sm text-white border border-[#31AF36] rounded hover:bg-[#31AF36]">Compra</button>
                            <button class="flex-grow px-3 py-1 text-sm text-white border border-[#FF0000] rounded hover:bg-[#FF0000]">Venta</button>
                        </div>
                    </div>
                    <div class="flex items-center text-gray-400 pt-4">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill="#26922A" d="M13.098 10.634L11 9.423V5C11 4.73478 10.8946 4.48043 10.7071 4.29289C10.5196 4.10536 10.2652 4 10 4C9.73479 4 9.48043 4.10536 9.2929 4.29289C9.10536 4.48043 9 4.73478 9 5V10C9.00001 10.1755 9.04622 10.348 9.13399 10.5C9.22175 10.652 9.34799 10.7782 9.5 10.866L12.098 12.366C12.2118 12.4327 12.3376 12.4762 12.4683 12.4941C12.5989 12.512 12.7319 12.5038 12.8594 12.4701C12.9869 12.4364 13.1064 12.3778 13.2112 12.2977C13.3159 12.2176 13.4038 12.1175 13.4698 12.0033C13.5357 11.8891 13.5784 11.763 13.5954 11.6322C13.6124 11.5014 13.6034 11.3686 13.5688 11.2413C13.5343 11.114 13.4749 10.9949 13.3941 10.8906C13.3133 10.7864 13.2126 10.6992 13.098 10.634ZM10 0C8.02219 0 6.08879 0.58649 4.4443 1.6853C2.79981 2.78412 1.51809 4.3459 0.761209 6.17317C0.00433284 8.00043 -0.193701 10.0111 0.192152 11.9509C0.578004 13.8907 1.53041 15.6725 2.92894 17.0711C4.32746 18.4696 6.10929 19.422 8.0491 19.8079C9.98891 20.1937 11.9996 19.9957 13.8268 19.2388C15.6541 18.4819 17.2159 17.2002 18.3147 15.5557C19.4135 13.9112 20 11.9778 20 10C19.9971 7.34873 18.9426 4.80688 17.0679 2.93215C15.1931 1.05742 12.6513 0.0029116 10 0ZM10 18C8.41775 18 6.87104 17.5308 5.55544 16.6518C4.23985 15.7727 3.21447 14.5233 2.60897 13.0615C2.00347 11.5997 1.84504 9.99113 2.15372 8.43928C2.4624 6.88743 3.22433 5.46197 4.34315 4.34315C5.46197 3.22433 6.88743 2.4624 8.43928 2.15372C9.99113 1.84504 11.5997 2.00346 13.0615 2.60896C14.5233 3.21447 15.7727 4.23984 16.6518 5.55544C17.5308 6.87103 18 8.41775 18 10C17.9974 12.1209 17.1537 14.1542 15.6539 15.6539C14.1542 17.1536 12.1209 17.9974 10 18Z"/>
                        </svg>                            
                        <span class="ml-2 text-xs">Campaign sent 2 days ago</span>
                    </div>
                </div>
                <!-- Daily sales card -->
                <div class="w-full p-4 bg-secondaryBg rounded-lg shadow-md">
                    <div class="graph bg-[#25324A] rounded-lg p-3">
                        <canvas id="daily-sales-chart"></canvas>
                    </div>
                    <div class="flex justify-between items-center pb-4 border-b border-[#09BE8B]">
                        <div>
                            <h3 class="text-lg font-medium">Daily sales</h3>
                            <p class="text-sm text-gray-400">(+15%) increase in today sales.</p>
                        </div>
                        <div class="flex gap-2">
                            <button class="flex-grow px-3 py-1 mr-2 text-sm text-white border border-[#31AF36] rounded hover:bg-[#31AF36]">Compra</button>
                            <button class="flex-grow px-3 py-1 text-sm text-white border border-[#FF0000] rounded hover:bg-[#FF0000]">Venta</button>
                        </div>
                    </div>
                    <div class="flex items-center text-gray-400 pt-4">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill="#26922A" d="M13.098 10.634L11 9.423V5C11 4.73478 10.8946 4.48043 10.7071 4.29289C10.5196 4.10536 10.2652 4 10 4C9.73479 4 9.48043 4.10536 9.2929 4.29289C9.10536 4.48043 9 4.73478 9 5V10C9.00001 10.1755 9.04622 10.348 9.13399 10.5C9.22175 10.652 9.34799 10.7782 9.5 10.866L12.098 12.366C12.2118 12.4327 12.3376 12.4762 12.4683 12.4941C12.5989 12.512 12.7319 12.5038 12.8594 12.4701C12.9869 12.4364 13.1064 12.3778 13.2112 12.2977C13.3159 12.2176 13.4038 12.1175 13.4698 12.0033C13.5357 11.8891 13.5784 11.763 13.5954 11.6322C13.6124 11.5014 13.6034 11.3686 13.5688 11.2413C13.5343 11.114 13.4749 10.9949 13.3941 10.8906C13.3133 10.7864 13.2126 10.6992 13.098 10.634ZM10 0C8.02219 0 6.08879 0.58649 4.4443 1.6853C2.79981 2.78412 1.51809 4.3459 0.761209 6.17317C0.00433284 8.00043 -0.193701 10.0111 0.192152 11.9509C0.578004 13.8907 1.53041 15.6725 2.92894 17.0711C4.32746 18.4696 6.10929 19.422 8.0491 19.8079C9.98891 20.1937 11.9996 19.9957 13.8268 19.2388C15.6541 18.4819 17.2159 17.2002 18.3147 15.5557C19.4135 13.9112 20 11.9778 20 10C19.9971 7.34873 18.9426 4.80688 17.0679 2.93215C15.1931 1.05742 12.6513 0.0029116 10 0ZM10 18C8.41775 18 6.87104 17.5308 5.55544 16.6518C4.23985 15.7727 3.21447 14.5233 2.60897 13.0615C2.00347 11.5997 1.84504 9.99113 2.15372 8.43928C2.4624 6.88743 3.22433 5.46197 4.34315 4.34315C5.46197 3.22433 6.88743 2.4624 8.43928 2.15372C9.99113 1.84504 11.5997 2.00346 13.0615 2.60896C14.5233 3.21447 15.7727 4.23984 16.6518 5.55544C17.5308 6.87103 18 8.41775 18 10C17.9974 12.1209 17.1537 14.1542 15.6539 15.6539C14.1542 17.1536 12.1209 17.9974 10 18Z"/>
                        </svg>
                        <span class="ml-2 text-xs">Updated 4 min ago</span>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var ctx_daily_sales_donut_chart = document.getElementById('daily-sales-donut-chart').getContext('2d');
                new Chart(ctx_daily_sales_donut_chart, {
                    type: 'doughnut',
                    data: {
                        labels: ['Binance', 'KuCoin', 'OkEx'],
                        datasets: [{
                            label: 'Usage of Exchange',
                            data: [15, 30, 60],
                            backgroundColor: [
                                '#E5B00C',
                                '#23A98C',
                                '#00072D',
                            ],
                            borderColor: [
                                '#E5B00C',
                                '#23A98C',
                                '#00072D'
                            ],
                            borderJoinStyle: 'round',
                            spacing: 10,
                            borderRadius: 10,
                            borderWidth: 1
                        }],
                    },
                    options: {
                        radius: '100%',
                        plugins: {
                            legend: {
                                display: true,
                                labels: {
                                    color: 'rgb(255, 255, 255)'
                                }
                            },
                            customCanvasBackgroundColor: {
                                color: 'white',
                            }
                        }
                    }
                });
                var ctx_website_view = document.getElementById('website-view-chart').getContext('2d');
                new Chart(ctx_website_view, {
                    type: 'bar',
                    data: {
                        labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
                        datasets: [{
                            label: 'Views',
                            data: [42, 19, 23, 35, 22, 48, 35],
                            backgroundColor: [
                                '#09BE8B',
                                '#09BE8B',
                                '#09BE8B',
                                '#09BE8B',
                                '#09BE8B',
                                '#09BE8B',
                                '#09BE8B'
                            ],
                            borderRadius: 10,
                            barThickness: 10,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            x: {
                                grid: {
                                    color: '#09BE8B',
                                    borderDash: [5, 5],
                                },
                                ticks: {
                                    color: 'white',
                                },
                            },
                            y: {
                                beginAtZero: true,
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    callback: function(value, index, values) {
                                        if (index === 0 || index === values.length - 1) {
                                            return value;
                                        } else {
                                            return '';
                                        }
                                    },
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
                var ctx_daily_sales = document.getElementById('daily-sales-chart').getContext('2d');
                new Chart(ctx_daily_sales, {
                    type: 'line',
                    data: {
                        labels: ['Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        datasets: [{
                            label: 'Sales',
                            backgroundColor: '#58D764',
                            data: [125, 250, 175, 225, 320, 350, 250, 200, 300],
                            fill: false,
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
                                    borderDash: [1, 1],
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
    
</div>
