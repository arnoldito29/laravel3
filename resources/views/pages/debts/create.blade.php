@extends('pages.page')

@include('pages.debts.title')

@section('page')
    <div>
        <form method="post" action="{{route('debts.store')}}">
            @csrf
            <div class="form-group">
                <label for="title">{{__('Title')}}</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Debt">
            </div>
            <div class="form-group">
                <label for="amount">{{__('Amount')}}</label>
                <input type="text" class="form-control" id="Amount" name="amount" placeholder="10">
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" name="debt" class="custom-control-input" id="debt">
                <label class="custom-control-label" for="debt">{{__('Debt')}}</label>
            </div>
            <div class="form-group">
                <label for="recipient">{{__('Recipient')}}</label>
                <input type="text" class="form-control" id="recipient" name="recipient" placeholder="Tom">
                @if($users->count() > 0)
                    @foreach($users as $user)
                        <a href="#" onclick="changeText('{{$user->recipient}}')">{{$user->recipient}}</a>,
                    @endforeach
                @endif
            </div>
            <div class="form-group" id="recipient_list_block">
                <label for="recipient_list">{{__('Recipient')}}</label>
                <select class="form-control" id="recipient_list" name="recipient_list">
                    @if($users->count() > 0)
                        <option>{{__('Select')}}</option>
                        @foreach($users as $user)
                            <option>{{$user->recipient}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
        </form>
    </div>
@endsection
