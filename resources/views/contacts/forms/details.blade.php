<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="ngaspari">

        <title>Contact details</title>
        
        <link href="{{ asset('css/contacts.css') }}" media="screen" rel="stylesheet" type="text/css">
    </head>
<body>
<h1>Contact details</h1>

<div class='contact-detail'>
{!! Form::model($contact, ['route' => ['contacts.edit', ['id' => $contact->getId()]], 'method' => 'put']) !!}

    {{ Form::token() }}
    
    {{ Form::hidden('from_form', '1') }}
    
    <div class='form-group'>
    {{ Form::label('firstName', 'Ime:') }}
	{{ Form::text('firstName', $contact->getFirstName(), ['class' => 'c-det-input']) }}
    </div>
    
    <div class='form-group'>
    {{ Form::label('lastName', 'Prezime:') }}
	{{ Form::text('lastName', $contact->getLastName(), ['class' => 'c-det-input']) }}
    </div>
    
    <div class='form-group'>
    {{ Form::label('address', 'Adresa:') }}
	{{ Form::text('address', $contact->getAddress(), ['class' => 'c-det-input']) }}
    </div>
    
    <div class='form-group'>
    {{ Form::label('city', 'Grad:') }}
	{{ Form::text('city', $contact->getCity(), ['class' => 'c-det-input']) }}
    </div>
    
    <div class='form-group'>
    {{ Form::label('country', 'Država:') }}
	{{ Form::text('country', $contact->getCountry(), ['class' => 'c-det-input']) }}
    </div>
    
    <div class='form-group'>
    {{ Form::label('email', 'Email:') }}
	{{ Form::text('email', $contact->getEmail(), ['class' => 'c-det-input']) }}
    </div>
    
    <div class='form-group'>
    {{ Form::label('phoneNumber', 'Telefon:') }}
	{{ Form::text('phoneNumber', $contact->getPhoneNumber(), ['class' => 'c-det-input']) }}
    </div>
    
    <br/>
    
    {{ Form::submit('Spremi promjene', ['class' => 'btn-save']) }}

{!! Form::close() !!}

</div>

<br/><br/>
<a href="{{ url('/contacts/list/') }}">Natrag</a>

</body>
</html>