@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">
        <section class='content-header'>
            <h1>التوكيلات</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li class="active">كل التوكيلات</li>
            </ol>
        </section>
        <section class="content">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="margin-bottom: 15px">التوكيلات<small
                            style="color: #f03">{{-- ' ' .$locals->total() --}}</small></h3>

                    <form action="{{ route('authorization.index') }}" method="GET">
                        <div class="row">
                            {{-- <div class="col-md-4">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" value="{{ request()->search }}"
                                        placeholder="@lang('site.search')">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-primary btn-flat">@lang('site.search')</button>
                                    </span>
                                </div> --}}
                        </div>
                        <div class="col-md-4">

                            <a href="{{ route('authorization.create') }}" class="btn btn-primary"><i
                                    class="fa fa-plus"></i>@lang('site.add')</a>
                        </div>
                </div>
                </form>
            </div>
            <div class="box-body">
                @if (isset($authorization) && $authorization->count() > 0)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>تاريخ التوكيل</th>
                                <th>نوع التوكيل</th>
                                <th>إسم الموكل</th>
                                <th>إسم الموكل له</th>
                                <th>رقم موضوع التوكيل</th>
                                <th>رقم الشاهد الاول</th>
                                <th>رقم الشاهد الثاني</th>
                                <th>إسم مدخل البيانات</th>
                                <th>تاريخ الادخال</th>
                                <th>@lang('site.command')</th>
                                <th>@lang('site.action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($authorization as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->authorization_date }}</td>
                                    <td>{{ $item->authorization_type }}</td>
                                    <td>{{ $item->Clients->name }}</td>
                                    <td>{{ $item->ClientTo->name }}</td>
                                    <td>{{ $item->authorization_subject_no }}</td>
                                    <td>{{ $witness['witness_name']}}</td>
                                    <td>{{ $witnessTo['witness_name']}}</td>
                                    {{-- <td> {{ $witness['witness_name'] }}</td>
                                    <td>{{ $witnessTo['witness_name'] }}</td> --}}
                                    <td>{{ $item->User->name }}</td>
                                    <td>{{ $item->created_at }}</td>

                                    <td>{{ $item->command }}</td>
                                    <td>
                                        <a href="{{ route('authorization.edit', $item->id) }}"
                                            class="btn btn-info btn-sm"><i class="fa fa-edit"></i>@lang('site.edit')</a>

                                        <form method="post" action="{{ route('authorization.destroy', $item->id) }}"
                                            style="display: inline-block">
                                            @csrf
                                            {{ method_field('delete') }}
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-danger delete btn-sm"><i
                                                        class="fa fa-trash"></i>@lang('site.delete')</button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="content-center">
                        {{-- $locals->appends(request()->query())->links() --}}
                    </div>
                @else
                    <h2> @lang('site.no_data_found')</h2>
                @endif
            </div>
    </div>
    </section>
    </div>
@endsection
