@extends('layouts.app')

@section('content')

    <script>
    $(document).ready(function() {
        $("input[name='firstName']").focus();
    });
    </script>

    <h1>{{ $pageTitle }}</h1>
         
    <div class='new_contact'>       
        <form action='/contacts/{{ $contact->id }}' method='POST'>
            @csrf
            
            <!-- only GET|POST is possible via standard HTML form .... this is Laravels's way of "fixing" this  -->
            @method("PUT")
        
            <input
                class='block input-xl mb-10 w-50'
                type='text'
                name='firstName'
                placeholder='First name...'
                tabindex = '0'
                value = '{{ $contact?->firstName }}'
            />
            
            <input
                class='block input-xl mb-10 w-50'
                type='text'
                name='lastName'
                placeholder='Last name...'
                value = '{{ $contact?->lastName }}'
            />
            
            <input
                class='block input-xl mb-10 w-50'
                type='text'
                name='address'
                placeholder='Address...'
                value = '{{ $contact?->address }}'
            />
            
            <input
                class='block input-xl mb-10 w-50'
                type='text'
                name='city'
                placeholder='City...'
                value = '{{ $contact?->city }}'
            />
            
            <input
                class='block input-xl mb-10 w-50'
                type='text'
                name='country'
                placeholder='Country...'
                value = '{{ $contact?->country }}'
            />
            
            <input
                class='block input-xl mb-10 w-50'
                type='text'
                name='email'
                placeholder='Email...'
                value = '{{ $contact?->email }}'
            />
            
            <input
                class='block input-xl mb-10 w-50'
                type='tel'
                name='phone'
                placeholder='Phone'
                value = '{{ $contact?->phone }}'
            />
            
            <button type='submit' class='block btn-xl mb-10 w-50'>
                Spremi
            </button>
            
            
        </form>
    </div>
@endsection