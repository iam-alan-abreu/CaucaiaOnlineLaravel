@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">ReclamacaoAbuso {{ $reclamacaoabuso->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/reclamacao-abuso') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/reclamacao-abuso/' . $reclamacaoabuso->id . '/edit') }}" title="Edit ReclamacaoAbuso"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/reclamacaoabuso', $reclamacaoabuso->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete ReclamacaoAbuso',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $reclamacaoabuso->id }}</td>
                                    </tr>
                                    <tr><th> User Id </th><td> {{ $reclamacaoabuso->user_id }} </td></tr><tr><th> Reclamacao Id </th><td> {{ $reclamacaoabuso->reclamacao_id }} </td></tr><tr><th> Status </th><td> {{ $reclamacaoabuso->status }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
