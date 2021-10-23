@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">
        <section class='content-header'>
            <h1>الجلسات</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li class="active">كل الجلسات </li>
            </ol>
        </section>
        <section class="content">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="margin-bottom: 15px">الجلسات<small
                            style="color: #f03">{{-- ' ' .$locals->total() --}}</small></h3>

                    <form action="{{ route('sessions.index') }}" method="GET">
                        <div class="row">

                        </div>
                        <div class="col-md-4">

                            <a href="{{ route('sessions.create') }}" class="btn btn-primary"><i
                                    class="fa fa-plus"></i>@lang('site.add')</a>
                        </div>
                </div>
                </form>
            </div>
            <div class="box-body">
                @if (isset($sessions) && $sessions->count() > 0)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                {{-- <th>إسم الدعوى</th> --}}
                                <th>تاريخ الدعوى</th>
                                {{-- <th>رقم الجلسه</th> --}}
                                <th>تاريخ الجلسه</th>
                                <th>زمن الجلسه</th>
                                <th>رقم المحكمة </th>
                                <th>إسم محامي المدعي </th>
                                <th>إسم محامي المدعي علية</th>
                                <th>إسم القاضى</th>
                                <th>قرار الجلسة</th>
                                <th>القرار نهائي ام لا</th>
                                <th>إسم مدخل البيانات</th>
                                <th>تاريخ ادخال البيانات</th>
                                <th>@lang('site.command')</th>
                                <th>@lang('site.action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sessions as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    {{-- <td>{{ $item->prose_date }}</td> --}}
                                    <td>{{ $item->Prosecutions->prose_date }}</td>
                                    <td>{{ $item->session_date}}</td>
                                    <td>{{ $item->session_time}}</td>
                                    <td>{{ $item->Courts->court_name}}</td>
                                    <td>{{ $item->Lawyers->lawyer_name}}</td>
                                    <td>{{ $lawyerTo['lawyer_name']}}</td>
                                    <td>{{ $item->Judge->name }}</td>
                                    <td>{{$item->session_decision}}</td>
                                    <td>{{$item->endDecision()}}</td>
                                    <td>{{ $item->User->name}}</td>
                                    <td>{{ $item->created_at}}</td>
                                    <td>{{ $item->command }}</td>
                                    <td>
                                        <a href="{{ route('sessions.edit', $item->id) }}" class="btn btn-info btn-sm"><i
                                                class="fa fa-edit"></i>@lang('site.edit')</a>

                                        <form method="post" action="{{ route('sessions.destroy', $item->id) }}"
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
