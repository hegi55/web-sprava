@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Nástenka</div>
                  
                  @if(isset($message) && !empty($message))
                    <div class="panel-body">
                      <div class="panel panel-default">
                        <div class="panel-heading">Správa: </div>
                          <div class="panel-body">

                            <p style="color:red;"><b>{{ $message }}</b></p>
                            
                            <img src="/media/sad.png" alt="Sorry" class="img-responsive center-block" />
                          </div>
                      </div>
                    </div>
                  @endif


        </div>
    </div>
</div>
@endsection
