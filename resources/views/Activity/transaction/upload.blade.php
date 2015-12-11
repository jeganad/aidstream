@extends('app')
@section('content')
    <div class="container main-container">
        <div class="row">
        @include('includes.side_bar_menu')
            <div class="col-xs-9 col-md-9 col-lg-9 content-wrapper">
                <div class="panel-content-heading">Default Flow type</div>
                <div class="col-xs-8 col-md-8 col-lg-8 element-content-wrapper">
                <a href="{{ route('activity.transaction.index', $id) }}" class="btn btn-primary">Back to Transaction List</a>
                @if(count($errors)>0)
                    @foreach($errors->all() as $error)
                        <ul>
                        <li style="color:red;">{{$error}}</li>
                        </ul>
                    @endforeach
                @endif
                <div class="panel panel-default">
                    <div class="panel-content-heading panel-title-heading">Upload Transaction for <span>{{$activity->IdentifierTitle}}</span></div>
                    <div class="panel-body">
                        {!! form($form) !!}
                    </div>
                </div>
                <a href="/download-detailed-transaction" class="btn btn-primary">Download Detailed Transaction Template</a>
                <div>Contains all information about transaction. Ideal if you download your existing transaction from Download My Data page and want to update the transactions in bulk. Manual filling can be difficult as you have to ensure you use proper code values while filling certain fields. The first three fields (Activity_Identifier, Activity_Title, Default_currency) are ignored during uploading. This is done to make it consistent with transaction download via Download My Data.</div>
            </div>
            @include('includes.activity.element_menu')
            </div>
        </div>
    </div>
@stop