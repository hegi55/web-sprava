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

                            <p style="color:red;">{{ $message }}</p>
                          </div>
                      </div>
                    </div>
                  @endif

                  @if(count($errors))
                    <div class="panel-body">
                      <div class="panel panel-default">
                        <div class="panel-heading">Správa: </div>
                          <div class="panel-body">
                            @foreach($errors->all() as $error)
                              <p style="color:red;">{{ $error }}</p>
                            @endforeach
                          </div>
                      </div>
                    </div>
                  @endif

                <div class="panel-body">
                    <div class="panel panel-default">
                      <!-- Default panel contents -->
                      <div class="panel-heading">Pridanie užívateľa: </div>
                      <div class="panel-body">
                        <p>Prosím zadajte nasledovné údaje pre vytvorenie nového užívateľa:</p>
                            <form method="POST" action="/" class="form-horizontal">
                              <div class="form-group">
                                <label for="name" class="control-label col-sm-2">Meno:</label>
                                <div class="col-sm-8">
                                  <input type="text" name="name" placeholder="Meno" class="form-control" required>
                                </div>
                              </div>

                              <div class="form-group">
                                <label for="doorway" class="control-label col-sm-2">Vchod:</label>
                                <div class="col-sm-8">
                                  <input type="text" name="doorway" placeholder="Vchod" class="form-control" required>
                                </div>
                              </div>

                              <div class="form-group">
                                <label for="note" class="control-label col-sm-2">Poznámka:</label>
                                <div class="col-sm-8">
                                  <input type="text" name="note" placeholder="Poznámka" class="form-control" required> 
                                </div>
                              </div>

                              <div class="form-group">
                                <label for="mac" class="control-label col-sm-2">Mac Adresa:</label>
                                <div class="col-sm-8">
                                  <input type="text" name="mac" pattern="^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$" placeholder="Mac Adresa" class="form-control" required>
                                </div>
                              </div>

                              <input type="hidden" name="_method" value="POST">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">

                               <div class="form-group"> 
                                <div class="col-sm-offset-2 col-sm-8">                             
                                  <input type="submit" value="Odoslať">
                                </div>
                              </div>
                        </form>
                      </div>
                    </div>



                    <div class="panel panel-default">
                      <!-- Default panel contents -->
                      <div class="panel-heading">Tabuľka užívateľov spoločnosti: </div>
                      <div class="panel-body">
                        <p>Užívatelia nachádzajúci sa v tejto databáze majú prístup k internetu v sieti Westcom, pokiaľ má užívateľ uvedení v tejto databáze problémi s pripojením ujistite sa že máte správne zadanú MAC adresu, pripojenie na internet sa novým užívateľom aktivuje až na daľší deň ! v prípade problémov : Kontakt</p>
                      </div>

                      <!-- Table -->
                      <table class="table">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Meno</th>
                            <th>Vchod</th>
                            <th>MAC adresa</th>
                            <th>Poznámka</th>
                            <th>Úprava</th>
                            <th>Zmazanie</th>
                          </tr>                            
                        </thead>
                        <tbody>

                          @if(isset($data))
                            @foreach($data as $data)
                              <tr>
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->doorway }}</td>
                                <td>{{ $data->mac }}</td>
                                <td>{{ $data->note }}</td>
                                <td><a href="/edit/{{ $data->id }}">Upraviť</a></td>
                                <td><a href="/delete/{{ $data->id }}">Zmazať</a></td>
                              </tr>  
                            @endforeach
                          @endif
                        </tbody>
                      </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
