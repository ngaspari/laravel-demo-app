@extends('layouts.app')

@section('content')

    <script>
    $(document).ready(function() {
        $("input[name='firstName']").focus();
    });
    </script>

    <h1>Create new contact</h1>
         
    <div class='new_contact'>       
        <form action='/contacts' method='post'>
            @csrf
        
            <input
                class='block input-xl mb-10 w-50'
                type='text'
                name='firstName'
                placeholder='First name...'
                tabindex = '0'
            />
            
            <input
                class='block input-xl mb-10 w-50'
                type='text'
                name='lastName'
                placeholder='Last name...'
            />
            
            <input
                class='block input-xl mb-10 w-50'
                type='text'
                name='address'
                placeholder='Address...'
            />
            
            <input
                class='block input-xl mb-10 w-50'
                type='text'
                name='city'
                placeholder='City...'
            />
            
            <input
                class='block input-xl mb-10 w-50'
                type='text'
                name='country'
                placeholder='Country...'
            />
            
            <input
                class='block input-xl mb-10 w-50'
                type='text'
                name='email'
                placeholder='Email...'
            />
            
            <input
                class='block input-xl mb-10 w-50'
                type='tel'
                name='phone'
                placeholder='Phone'
            />
            
            <button type='submit' class='block btn-xl mb-10 w-50'>
                Spremi
            </button>
            
            
        </form>
    </div>
@endsection