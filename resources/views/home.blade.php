@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if($list->count() > 0)
                        <div class="row">
                            <div class="col-sm">
                                {{__('Date')}}
                            </div>
                            <div class="col-sm">
                                {{__('Amount')}}
                            </div>
                        </div>
                        @foreach($list as $item)
                            <div class="row">
                                <div class="col-sm">
                                    {{$item->year}}y {{$item->month}}m
                                </div>
                                <div class="col-sm">
                                    {{$item->amount}}
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
