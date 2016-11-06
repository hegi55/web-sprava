@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <div class="panel panel-default">
                      <!-- Default panel contents -->
                      <div class="panel-heading">Upravenie užívateľa: </div>
                      <div class="panel-body">
                        <p>Upravte údaje pre nasledovného užívateľa:</p>
                            <form method="POST" action="/" class="form-horizontal">
                              <div class="form-group">
                                <label for="name" class="control-label col-sm-2">Meno:</label>
                                <div class="col-sm-8">  
                                  <input type="text" name="name" value="{{ $data->name }}" class="form-control" required>
                                </div>
                              </div>

                              <div class="form-group">
                                <label for="doorway" class="control-label col-sm-2">Vchod:</label>
                                <div class="col-sm-8"> 
                                  <input type="text" name="doorway" value="{{ $data->doorway }}" class="form-control" required> 
                                </div>
                              </div>

                              <div class="form-group">
                                <label for="note" class="control-label col-sm-2">Poznámka:</label>
                                <div class="col-sm-8">
                                  <input type="text" name="note" value="{{ $data->note }}" class="form-control" required> 
                                </div>
                              </div>

                              <div class="form-group">
                                <label for="mac" class="control-label col-sm-2">Mac Adresa:</label>
                                <div class="col-sm-8">
                                  <input type="text" name="mac" pattern="^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$" placeholder="Mac Adresa" value="{{ $data->mac }}" class="form-control" required>
                                </div>
                              </div>

                              <input type="hidden" name="id" value="{{ $data->id }}">
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
