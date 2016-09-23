@extends('app')

@section('content')
    <h1>Criar chamado</h1>
    <hr>

    {!! Form::open(['url' => 'chamados/store']) !!}
        <div class="form-group">
            {!! Form::label('pedido', 'Número do pedido:') !!}
            {!! Form::text('pedido', $pedido->id, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('nome', 'Nome do cliente:') !!}
            {!! Form::text('nome', $pedido->cliente->nome, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('email', 'E-mail:') !!}
            {!! Form::text('email', $pedido->cliente->email, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('titulo', 'Título:') !!}
            {!! Form::text('titulo', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('observacao', 'Observação:') !!}
            {!! Form::textarea('observacao', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-lg-offset-10 col-lg-1">
            {!! Form::submit('Salvar', ['class' => 'btn btn-primary form-control']) !!}
        </div>
        <div class="form-group col-lg-1">
            {!! Html::link('pedidos/buscar', 'Cancelar', ['class' => 'btn btn-default']) !!}
        </div>
    {!! Form::close() !!}
@endsection