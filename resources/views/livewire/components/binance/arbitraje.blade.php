<div class="mt-4">
    <nav>
        <div class="nav nav-tabs justify-content-center" id="nav-tab" role="tablist" wire:ignore>
            <button class="nav-link {{$tab == 0 ? 'active' : ''}} btn btn-lg col-6" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true" wire:click="$set('tab',0)" @click="tab = 0">Tabla de Arbitraje Avanzada</button>
            <button class="nav-link btn btn-lg col-6 {{$tab == 1 ? 'active' : ''}}" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false" wire:click="$set('tab',1)" @click="tab = 1">Tabla de Arbitraje Principiantes</button>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade {{$tab == 0 ? 'show active' : ''}}" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" wire:ignore.self>
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card mt-2">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-center text-white text-capitalize ps-3">TABLA PARA COMERCIANTES</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table table-striped table-hover align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th colspan="3" class="text-center text-uppercase font-weight-bolder opacity-7">Criptomonedas</th>
                                            @foreach($monedas_buy as $coin)
                                                <th colspan="3" class="text-center text-uppercase text-white bg-danger">
                                                    <img src="{{ asset('img/coin/' . strtolower ($coin['coin']) . '.svg') }}" alt="{{ $coin['coin'] }}" style="height: 20px; margin-right: 5px;">
                                                    {{$coin['coin']}}
                                                    <select wire:change="actualizarPos2('{{$coin['coin']}}',$event.target.value)" wire:model='coinpos2.{{$coin['coin']}}' class="form-select form-select-sm d-inline-block ms-2" style="width: auto;" wire:key="{{$coin['coin']}}">
                                                        @foreach($posiciones[$coin['coin']] as $pos)
                                                            <option value="{{ $pos }}" >{{ $pos }}</option>
                                                        @endforeach
                                                    </select>
                                                </th>
                                                @if ($loop->index == 1)
                                                    @break
                                                @endif
                                            @endforeach
                                            <th colspan="3" class="text-center text-uppercase text-white bg-danger">
                                                <img src="{{ asset('img/coin/' . strtolower($selectedCoin) . '.svg') }}" alt="{{$selectedCoin }}" style="height: 20px; margin-right: 5px;">
                                                <select wire:model="selectedCoin">
                                                    <option value="">Seleccione</option>
                                                    @foreach ($monedas_buy as $coin)
                                                        @if ($loop->index == 0 || $loop->index == 1)
                                                            @continue
                                                        @endif
                                                        <option>{{$coin['coin']}}</option>
                                                    @endforeach
                                                </select>
                                                @if($selectedCoin)
                                               
                                                    <select class="form-select form-select-sm d-inline-block ms-2" style="width: auto;" wire:model="selectedPos">
                                                        @foreach($posiciones[$selectedCoin] as $pos)
                                                            <option value="{{ $pos }}">{{ $pos }}</option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($monedas_sell as $index => $row)
                                            <tr>
                                                <td class="text-center {{$index == 0 ? 'text-center text-uppercase text-white bg-info' : ''}}" style="white-space: nowrap;">
                                                    <img src="{{ asset('img/coin/' .strtolower ($row['coin']) . '.svg') }}" alt="{{ $row['coin'] }}" style="height: 20px; margin-right: 5px;">
                                                    {{$row['coin']}}
                                                    <select class="form-select form-select-sm d-inline-block ms-2" style="width: auto;" wire:model='coinpos.{{$row['coin']}}' wire:change="actualizarPos('{{$row['coin']}}',$event.target.value)" wire:key="{{$row['coin']}}">
                                                        @foreach($posiciones2[$row['coin']] as $pos)
                                                            <option value="{{ $pos }}" {{$pos == 3 ? 'selected' : ''}}>{{ $pos }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="text-center bg-info bg-opacity-10 text-white">{{auth()->user()->fnumber($row['price_sell'])}}</td>
                                                <td class="text-center">{{$row['val_sell']}}</td>
                                                @foreach($monedas_buy as $coin)
                                                    <td class="text-center {{$index == 0 ? 'text-center text-uppercase text-white bg-danger' : ''}}">
                                                        {{$index == 0 ? auth()->user()->fnumber($monedas_buy[$loop->index]['price_buy']) : ''}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{$index == 0 ? auth()->user()->fnumber($monedas_buy[$loop->index]['val_buy']) : ''}}
                                                    </td>
                                                    <td class="text-center bg-success bg-opacity-10 text-white">
                                                        {{number_format(($monedas_buy[$loop->index]['val_buy'] / $row['val_sell'] * 100) - 100, 2, ",")}}%
                                                    </td>
                                                    @if ($loop->index == 1)
                                                        @break
                                                    @endif
                                                @endforeach

                                                {{-- Codigo X --}}
                                                @php
                                                    $monedaData = $todotodo[$selectedCoin]['buy'][$selectedPos] ?? null;
                                                @endphp
                                                @if($monedaData)
                                                    <td class="text-center {{$index == 0 ? 'text-center text-uppercase text-white bg-danger' : ''}}">
                                                        {{$index == 0 ? auth()->user()->fnumber($monedaData['price_buy']) : ''}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{$index == 0 ? auth()->user()->fnumber($monedaData['val_buy']): ''}}
                                                    </td>
                                                    <td class="text-center bg-success bg-opacity-10 text-white">
                                                        {{number_format(($monedaData['val_buy'] / $row['val_sell'] * 100) - 100, 2, ",")}}%
                                                    </td>
                                                @else
                                                    <td class="text-center">N/A</td>
                                                    <td class="text-center">N/A</td>
                                                    <td class="text-center bg-success bg-opacity-10 text-white">N/A</td>
                                                @endif
                                                {{-- Codigo X --}}
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade {{$tab == 1 ? 'show active' : ''}}" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" wire:ignore.self>
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card mt-2">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-center text-white text-capitalize ps-3">TABLA PARA NO COMERCIANTES</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="row">
                                <div class="col-6">
                                    <div class="table-responsive p-0">
                                        <table class="table table-striped table-hover align-items-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th colspan="4" class="bg-success text-center text-uppercase text-white">Compra Directa / Moneda más barata</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($principiante_buy as $index => $row)
                                                    <tr>
                                                        <td class="text-center" style="white-space: nowrap;">
                                                            <img src="{{ asset('img/coin/' . strtolower ($row['coin']). '.svg') }}" alt="{{ $row['coin'] }}" style="height: 20px; margin-right: 5px;">
                                                            {{$row['coin']}}
                                                            <select class="form-select form-select-sm d-inline-block ms-2" style="width: auto;" wire:change="actualizarPos2('{{$row['coin']}}',$event.target.value)" wire:model='coinpos2.{{$row['coin']}}' wire:key="{{$row['coin']}}">
                                                                @foreach($posiciones2[$row['coin']] as $pos)
                                                                    <option value="{{ $pos }}" {{$pos == 3 ? 'selected' : ''}}>{{ $pos }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td class="text-center">{{$row['val_buy']}}</td>
                                                        <td class="text-center bg-success bg-opacity-10 text-white">{{auth()->user()->fnumber($row['price_buy'])}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="table-responsive p-0">
                                        <table class="table table-striped table-hover align-items-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th colspan="4" class="bg-danger text-center text-uppercase text-white">Venta Directa / Moneda más cara</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($principiante_sell as $index => $row)
                                                    <tr>
                                                        <td class="text-center" style="white-space: nowrap;">
                                                            <img src="{{ asset('img/coin/' . strtolower ($row['coin']) . '.svg') }}" alt="{{ $row['coin'] }}" style="height: 20px; margin-right: 5px;">
                                                            {{$row['coin']}}
                                                            <select class="form-select form-select-sm d-inline-block ms-2" style="width: auto;" wire:model='coinpos.{{$row['coin']}}' wire:change="actualizarPos('{{$row['coin']}}',$event.target.value)" wire:key="{{$row['coin']}}--berns">
                                                                @foreach($posiciones[$row['coin']] as $pos)
                                                                    <option value="{{ $pos }}" {{$pos == 3 ? 'selected' : ''}}>{{ $pos }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td class="text-center">{{$row['val_sell']}}</td>
                                                        <td class="text-center bg-danger bg-opacity-10 text-white">{{auth()->user()->fnumber($row['price_sell'])}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
