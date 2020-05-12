@extends('pages.page')

@include('pages.debts.title')

@section('page')
    <a class="btn btn-primary" href="{{route('debts.create')}}" role="button">{{__('Create')}}</a>
    @if($list->count() > 0)
        <div class="row">
            <div class="col-sm">
                {{__('Title')}}
            </div>
            <div class="col-sm">
                {{__('Amount')}}
            </div>
            <div class="col-sm">
                {{__('Recipient')}}
            </div>
            <div class="col-sm">
                {{__('Action')}}
            </div>
        </div>
        @foreach($list as $item)
            <div class="row">
                <div class="col-sm">
                    {{$item->name}}
                </div>
                <div class="col-sm">
                    <span @if($item->amount < 0) class="text-danger" @endif>{{$item->amount}}</span>
                </div>
                <div class="col-sm">
                    {{$item->recipient}}
                </div>
                <div class="col-sm">
                    <form action="{{ route('debts.destroy', ['debt' => $item->id]) }}" method="post">
                        <input class="btn btn-primary" type="submit" value="Delete" />
                        <input type="hidden" name="_method" value="delete" />
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                </div>
            </div>
        @endforeach
    @endif
@endsection

