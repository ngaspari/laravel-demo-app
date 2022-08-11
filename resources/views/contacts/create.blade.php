@extends('layouts.app')

@section('content')

    <script>
    $(document).ready(function() {
        $("input[name='firstName']").focus();
    });
    </script>

    <h1>{{ $pageTitle }}</h1>
         
    <div class='new_contact'>       
        <form action='/contacts' method='POST'>
            @csrf
        
            <input
                class="mb-10 appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                type='text'
                name='firstName'
                placeholder='First name...'
                tabindex = '0'
            />
            
            <input
                class="mb-10 appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                type='text'
                name='lastName'
                placeholder='Last name...'
            />
            
            <input
                class="mb-10 appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                type='text'
                name='address'
                placeholder='Address...'
            />
            
            <input
                class="mb-10 appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                type='text'
                name='city'
                placeholder='City...'
            />
            
            <input
                class="mb-10 appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                type='text'
                name='country'
                placeholder='Country...'
            />
            
            <input
                class="mb-10 appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                type='text'
                name='email'
                placeholder='Email...'
            />
            
            <input
                class="mb-10 appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                type='tel'
                name='phone'
                placeholder='Phone'
            />
            
            <button type='submit' class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
                Spremi
            </button>
            
        </form>
        
    </div>
    
    <a class="nav-link" href="{{ route('contacts.index') }}">&larr; {{ __('Back to contacts') }}</a>
    
@endsection