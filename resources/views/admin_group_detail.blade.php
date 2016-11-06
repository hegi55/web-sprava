@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Úprava</div>

                <div class="panel-body">
                    <div class="panel panel-default">
                      <!-- Default panel contents -->
                      <div class="panel-heading">Upravenie skupiny: </div>
                      <div class="panel-body">
                        <p>Upravte údaje pre nasledovnú skupinu:</p>
                            <form method="POST" action="/admin/group/{{$group->id}}/update" class="form-horizontal">

                              <div class="form-group">
                                <label for="group_name" class="control-label col-sm-2">Meno Skupiny:</label>
                                <div class="col-sm-8">
                                  <input type="text" name="group_name" value="{{ $group->group_name }}" class="form-control" required>
                                </div>
                              </div>

                              <div class="form-group">
                                <label for="group_ip" class="control-label col-sm-2">IP Adresa:</label>
                                <div class="col-sm-8">
                                  <input type="text" name="group_ip" pattern="^(?:[0-9]{1,3}\.){3}[0-9]{1,3}$" value="{{ $group->group_ip }}" class="form-control" required>
                                </div> 
                              </div>

                              <div class="form-group">
                                <label for="group_description" class="control-label col-sm-2">Popis Skupiny:</label>
                                <div class="col-sm-8">
                                  <input type="text" name="group_description" value="{{ $group->group_description }}" class="form-control" required>
                                </div>
                              </div>

                              <input type="hidden" name="id" value="{{ $group->id }}">
                              <input type="hidden" name="_method" value="PUT">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">

                               <div class="form-group"> 
                                <div class="col-sm-offset-2 col-sm-8">   
                                  <input type="submit" value="Odoslať">
                                </div>
                              </div>
                        </form>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
