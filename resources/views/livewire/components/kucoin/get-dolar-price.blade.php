<div>
    @if($fiat == 'ARS')
    <div class="row mt-2" >
        <div class="col-sm-4" >
            <div class="card">
                <div class="card-header p-3 pt-2"></div>
                <div class="text-center">
                    <div class="text-2xl text-bolder" style="color: black;">DOLAR OFICIAL</div>
                    <div class="" style="color: black;">{{$official}} {{$fiat}}</div>
                </div>
                <div class="card-footer p-3"></div>
            </div>
        </div>
        <div class="col-sm-4" >
            <div class="card">
                <div class="card-header p-3 pt-2"></div>
                <div class="text-center">
                    <div class="text-2xl text-bolder" style="color: black;">DOLAR MEP</div>
                    <div class="" style="color: black;">{{$mep}} {{$fiat}}</div>
                </div>
                <div class="card-footer p-3"></div>
            </div>
        </div>
        <div class="col-sm-4" >
            <div class="card">
                <div class="card-header p-3 pt-2"></div>
                <div class="text-center">
                    <div class="text-2xl text-bolder" style="color: black;">DOLAR BLUE</div>
                    <div class="" style="color: black;">{{$blue}} {{$fiat}}</div>
                </div>
                <div class="card-footer p-3"></div>
            </div>
        </div>
    </div>
    @endif
</div>