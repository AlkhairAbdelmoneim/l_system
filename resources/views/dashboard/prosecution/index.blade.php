@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">
        <section class='content-header'>
            <h1>الدعاوي</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li class="active">كل الدعاوي </li>
            </ol>
        </section>
        <section class="content">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="margin-bottom: 15px">الدعاوي<small
                            style="color: #f03">{{-- ' ' .$locals->total() --}}</small></h3>

                    <form action="{{ route('prosecution.index') }}" method="GET">
                        <div class="row">

                        </div>
                        <div class="col-md-4">

                            <a href="{{ route('prosecution.create') }}" class="btn btn-primary"><i
                                    class="fa fa-plus"></i>@lang('site.add')</a>
                        </div>
                </div>
                </form>
            </div>
            <div class="box-body">
                @if (isset($prosecution) && $prosecution->count() > 0)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>تاريخ الدعوه</th>
                                <th> المدعى</th>
                                <th> المدعى عليه</th>
                                <th>موضوع الدعوى</th>
                                <th>تصنيف الدعوه </th>
                                <th>سبب الدعوى</th>
                                <th>مدخل البيانات</th>
                                <th>تاريخ ادخال البيانات</th>
                                <th>@lang('site.command')</th>
                                <th>@lang('site.action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($prosecution as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->prose_date }}</td>
                                    <td>{{ $item->Customer->customer_name}}</td>
                                    <td>{{ $item->CustomerTo->customerTo_name}}</td>
                                    <td>{{ $item->ProseText->prose_text_name}}</td>
                                    <td>{{ $item->proseType()}}</td>
                                    <td>{{ $item->CauseLawsuit->cause_law_name }}</td>
                                    <td>{{ $item->User->name}}</td>
                                    <td>{{ $item->created_at}}</td>
                                    <td>{{ $item->command }}</td>
                                    <td>
                                        <a href="{{ route('prosecution.edit', $item->id) }}" class="btn btn-info btn-sm"><i
                                                class="fa fa-edit"></i>@lang('site.edit')</a>

                                        <form method="post" action="{{ route('prosecution.destroy', $item->id) }}"
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
