@extends('layouts.app')

@section('content')

    <script>
    $(document).ready(function() {
        $("input[name='firstName']").focus();
    });
    </script>

    <h1>{{ $pageTitle }}</h1>
         
    <div class='new_contact' class='m-auto w-50 text-center'>       
        <form action='/contacts/{{ $contact->id }}' method='POST'>
            @csrf
            
            <!-- only GET|POST is possible via standard HTML form .... this is Laravels's way of "fixing" this  -->
            @method("PUT")
        
            <input
                class="mb-10 appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                type='text'
                name='firstName'
                placeholder='First name...'
                tabindex = '0'
                value = '{{ $contact?->firstName }}'
            />
            
            <input
                class="mb-10 appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                type='text'
                name='lastName'
                placeholder='Last name...'
                value = '{{ $contact?->lastName }}'
            />
            
            <input
                class="mb-10 appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                type='text'
                name='address'
                placeholder='Address...'
                value = '{{ $contact?->address }}'
            />
            
            <input
                class="mb-10 appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                type='text'
                name='city'
                placeholder='City...'
                value = '{{ $contact?->city }}'
            />
            
            <input
                class="mb-10 appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                type='text'
                name='country'
                placeholder='Country...'
                value = '{{ $contact?->country }}'
            />
            
            <input
                class="mb-10 appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                type='text'
                name='email'
                placeholder='Email...'
                value = '{{ $contact?->email }}'
            />
            
            <input
                class="mb-10 appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                type='tel'
                name='phone'
                placeholder='Phone'
                value = '{{ $contact?->phone }}'
            />
            
            <button type='submit' class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
                Spremi
            </button>
                        
        </form>
        
    </div>
    
    <a class="nav-link" href="{{ route('contacts.index') }}">&larr; {{ __('Back to contacts') }}</a>
    
@endsection