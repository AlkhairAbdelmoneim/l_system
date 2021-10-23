@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">
        <section class='content-header'>
            <h1>عمل المدعين</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li><a href="{{ route('claimants.index') }}">عمل المدعين</a></li>
                <li class="active">@lang('site.add')</li>
            </ol>
        </section>
        <section class="content">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="margin-bottom: 15px">@lang('site.add') {{-- <small>Quick Exapm</small> --}}</h3>
                </div>
                <!----End box of header----->
                <div class="box-body">

                    @include('partials._errors')

                    <form action="{{ route('claimants.store') }}" method="POST">
                        @csrf
                        {{ method_field('post') }}

                        <div class="form-group">
                            <label for="projectinput2">رقم العميل</label>
                            <select name="customer_no" class="form-control" style="height: 40px">
                                @foreach ($customers as $key => $value)
                                    <option value="{{ $value->id }}">{{ $value->customer_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>تاريخ العمل</label>
                            <input type="date" name="work_date" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="projectinput2">رقم العمل</label>
                            <select name="work_no" class="form-control" style="height: 40px">
                                @foreach ($works as $key => $value)
                                    <option value="{{ $value->id }}">{{ $value->work_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>ملاحظات</label>
                            <textarea name="command" id="" class="form-control" cols="4" rows="4"></textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i
                                    class=" fa fa-plus">@lang('site.add')</i></button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
