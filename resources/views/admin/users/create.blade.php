@extends('layouts.admin')
@section('title', 'Add New Account')
@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default form-wrapper">
                <div class="panel-heading">Add New Account</div>
                <div class="panel-body">
                    {!! Form::open(['route' => 'admin.users.store']) !!}
                        <div class="form-group">
                            {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                            {!! error_text($errors, 'name') !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
                            {!! Form::email('email', null, ['class' => 'form-control',
                                'placeholder' => 'username@example.com']) !!}
                            {!! error_text($errors, 'email') !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('password', 'Password', ['class' => 'control-label']) !!}
                            {!! Form::password('password', ['class' => 'form-control']) !!}
                            {!! error_text($errors, 'password') !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('password_confirmation', 'Password Confirmation', ['class' => 'control-label']) !!}
                            {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group form-submit">
                            {!! Form::submit('Add Account', ['class' => 'btn btn-primary']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop