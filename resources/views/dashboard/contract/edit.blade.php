@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">
        <section class='content-header'>
            <h1>العقد</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li><a href="{{ route('contract.index') }}">العقد</a></li>
                <li class="active">@lang('site.edit')</li>
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

                    <form action="{{ route('contract.update', $contract->id) }}" method="POST">
                        @csrf
                        {{ method_field('put') }}

                        <div class="form-group">
                            <label> تاريخ العقد</label>
                            <input type="date" name="contract_date" class="form-control"
                                value="{{ $contract->contract_date }}">
                        </div>

                        <div class="form-group">
                            <label for="projectinput2">موضوع العقد</label>
                            <select name="contract_subject" class="form-control" style="height: 40px">
                                @foreach ($contractSubject as $key => $value)
                                    <option value="{{ $value->id }}" @if ($contract->contract_subject == $value->id)
                                        selected
                                @endif>{{ $value->contract_subject_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="projectinput2">إسم الطرف الاول</label>
                            <select name="first_side_no" class="form-control" style="height: 40px">
                                @foreach ($customers as $key => $value)
                                    <option value="{{ $value->id }}" @if ($contract->first_side_no == $value->id)
                                        selected
                                @endif>{{ $value->customer_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="projectinput2">إسم الطرف الثاني</label>
                            <select name="second_side_no" class="form-control" style="height: 40px">
                                @foreach ($customerTo as $key => $value)
                                    <option value="{{ $value->id }}" @if ($contract->second_side_no == $value->id)
                                        selected
                                @endif>{{ $value->customerTo_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="projectinput2">إسم الشاهد الاول</label>
                            <select name="first_witness_no" class="form-control" style="height: 40px">
                                @foreach ($witness as $key => $value)
                                    <option value="{{ $value->id }}" @if ($contract->first_witness_no == $value->id)
                                        selected
                                @endif>{{ $value->witness_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="projectinput2">إسم الشاهد الثاني</label>
                            <select name="second_witness_no" class="form-control" style="height: 40px">
                                @foreach ($witness as $key => $value)
                                    <option value="{{ $value->id }}" @if ($contract->second_witness_no == $value->id)
                                        selected
                                @endif>{{ $value->witness_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>ملاحظات</label>
                            <textarea name="command" id="" class="form-control" cols="4"
                                rows="4">{{ $contract->command }}</textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i
                                    class=" fa fa-plus">@lang('site.edit')</i></button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
