@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">ReclamaSubCategory {{ $reclamasubcategory->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/reclama-sub-category') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/reclama-sub-category/' . $reclamasubcategory->id . '/edit') }}" title="Edit ReclamaSubCategory"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/reclamasubcategory', $reclamasubcategory->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete ReclamaSubCategory',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $reclamasubcategory->id }}</td>
                                    </tr>
                                    <tr><th> Name </th><td> {{ $reclamasubcategory->name }} </td></tr><tr><th> Reclama Category Id </th><td> {{ $reclamasubcategory->reclama_category_id }} </td></tr><tr><th> Status </th><td> {{ $reclamasubcategory->status }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
