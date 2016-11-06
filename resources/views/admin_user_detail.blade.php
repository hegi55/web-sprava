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
                      <div class="panel-heading">Upravenie užívatela: </div>
                      <div class="panel-body">
                        <p>Upravte údaje pre nasledovného užívateľa:</p>
                            <form method="POST" action="/admin/user/{{$user->id}}/update" class="form-horizontal">

                              <div class="form-group">
                                <label for="name" class="control-label col-sm-2">Meno:</label>
                                <div class="col-sm-8">
                                  <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
                                </div>
                              </div>

                              <div class="form-group">
                                <label for="email" class="control-label col-sm-2">Email:</label>
                                <div class="col-sm-8">
                                  <input type="text" name="email" value="{{ $user->email }}" class="form-control" required>
                                </div> 
                              </div>

                              <div class="form-group">
                                <label for="is_valid" class="control-label col-sm-2">Validovaný:</label>
                                <div class="col-sm-8">
                                  <input type="text" name="is_valid" value="{{ $user->is_valid }}" class="form-control" required>
                                </div>
                              </div>

                              <div class="form-group">
                                <label for="is_admin" class="control-label col-sm-2">Je Admin:</label>
                                <div class="col-sm-8">
                                  <input type="text" name="is_admin" value="{{ $user->is_admin }}" class="form-control" required>
                                </div>
                              </div>

                              <div class="form-group">
                                <label for="group" class="control-label col-sm-2">Skupina:</label>
                                <div class="col-sm-8">
                                  <select name="group" class="form-control" required>
                                    @foreach($groups as $group)
                                      @if ($group->id == $user->group_id)
                                        <option value="{{ $group->id }}" selected>{{ $group->group_name }}</option>
                                      @else
                                        <option value="{{ $group->id }}">{{ $group->group_name }}</option>
                                      @endif
                                    @endforeach
                                  </select>
                                </div>
                              </div>

                              <input type="hidden" name="id" value="{{ $user->id }}">
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
