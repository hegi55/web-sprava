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
                      <div class="panel-heading">Administrácia skupín: </div>


                      <div class="panel-body">
                        <p>Vytvorenie Skupiny:</p>
                          <form method="POST" action="/admin">
                              <label for="group_name" >Meno Skupiny:</label>
                              <input type="text" name="group_name" placeholder="Meno Skupiny" required>

                              <label for="group_ip" >IP Skupiny:</label>
                              <input type="text" name="group_ip" placeholder="IP Skupiny" pattern="^(?:[0-9]{1,3}\.){3}[0-9]{1,3}$" required>

                              <label for="group_description" >Popis Skupiny:</label>
                              <input type="text" name="group_description"  placeholder="Popis Skupiny" required>

                              <input type="hidden" name="_method" value="POST">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <input type="submit" value="Odoslať">
                        </form>
                      </div>


                      <div class="panel panel-default">
                        <div class="panel-heading">Aktívne Skupiny: </div>
                        <div class="panel-body">
                          <p>Aktívne Skupiny (spoločnosti)</p>
                        </div>

                        <!-- Table -->
                        <table class="table">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>Meno</th>
                              <th>IP Skupiny</th>
                              <th>Popis Spoločnosti</th>
                              <th>Úprava</th>
                            </tr>                            
                          </thead>
                          <tbody>
                            @if(isset($groups))
                              @foreach($groups as $group)
                                <tr>
                                  <td>{{ $group->id }}</td>
                                  <td>{{ $group->group_name }}</td>
                                  <td>{{ $group->group_ip }}</td>
                                  <td>{{ $group->group_description }}</td>
                                  <td><a href="/admin/group/{{ $group->id }}">Upraviť</a></td>
                                </tr>  
                              @endforeach
                            @endif
                          </tbody>
                        </table>
                      </div>
                    </div>

                    <div class="panel panel-default">
                      <div class="panel-heading">Aktívny užívatelia: </div>
                      <div class="panel-body">
                        <p>Aktívný užívatelia ktorý môžu upravovať klientov spoločností</p>
                      </div>

                      <!-- Table -->
                      <table class="table">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Meno</th>
                            <th>E-mail</th>
                            <th>ID Spoločnosti</th>
                            <th>Názov spoločnosti</th>
                            <th>Validovaný</th>
                            <th>Úprava</th>
                            <th>Zmazanie</th>
                          </tr>                            
                        </thead>
                        <tbody>
                          @if(isset($users))
                            @foreach($users as $users)
                              <tr>
                                <td>{{ $users->id }}</td>
                                <td>{{ $users->name }}</td>
                                <td>{{ $users->email }}</td>
                                <td>{{ $users->group_id }}</td>
                                <td>{{ $users->group->group_name }}</td>
                                <td>
                                  @if($users->is_valid)
                                    <p style="color:green">Áno</p>
                                  @else
                                    <p style="color:red">Nie</p>
                                  @endif
                                </td>
                                <td><a href="/admin/user/{{ $users->id }}">Upraviť</a></td>
                                <td><a href="/admin/user/{{ $users->id }}/delete">Zmazať</a></td>
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
