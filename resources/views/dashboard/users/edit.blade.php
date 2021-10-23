@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">
        <section class='content-header'>

            <h1>@lang('site.users')</h1>

            <ol class="breadcrumb">
            <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li><a href="{{route('users.index')}}">@lang('site.users')</a></li>
                <li class="active">@lang('site.edit')</li>
            </ol>

        </section>
        <section class="content">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="margin-bottom: 15px">@lang('site.edit') {{--<small>Quick Exapm</small>--}}</h3>
                </div> <!----End box of header----->
                <div class="box-body">
                    @include('partials._errors')

                <form action="{{route('users.update',$user->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{method_field('put')}}

                        <div class="form-group">
                            <label>@lang('site.name')</label>
                            <input type="text" name="name" class="form-control" value="{{$user->name}}">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.email')</label>
                            <input type="email" name="email" class="form-control" value="{{$user->email}}">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.permissions')</label>

                            @php
                                $models = ['users' ,'categories' ,'products','clients','orders'];
                                $maps = ['create' ,'read' ,'update','delete'];
                            @endphp

                            <div class="card card-primary card-tabs">
                                <div class="card-header p-0 pt-1">
                                  <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                  
                                   
                                    @foreach ($models as $index=>$model)
                                    <li class="nav-item">    
                                    <a class="nav-link {{$index == 0 ? 'active' : ''}}" id="custom-tabs-one-home-tab" data-toggle="pill" href="#{{$model}}" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">@lang('site.'.$model)</a>
                                        </li>
                                         @endforeach
                                  </ul>
                                </div>
                                <div class="card-body">
                                  <div class="tab-content" id="custom-tabs-one-tabContent">

                                      @foreach ($models as $index=> $model)
                                        <div class="tab-pane fade show {{$index == 0 ? 'active' : ''}}" id="{{$model}}" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                            
                                            @foreach ($maps as $map)

                                                <label><input type="checkbox" name="permissions[]" {{$user->hasPermission($model.'_'.$map) ? 'checked' : ''}} value="{{$model. '_' .$map}}" id="">@lang('site.' .$map)</label>
                                            
                                            @endforeach
                                        </div>
                                      @endforeach
                                  </div>
                                </div>
                                <!-- /.card -->
                              </div>
    
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><i class=" fa fa-edit">@lang('site.edit')</i></button>
                            </div>
                        </div>

                      

                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection