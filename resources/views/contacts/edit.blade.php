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

    <div class='text-green-700 absolute bottom-0 left-0 pl-4'>
        <div class='footer-btn group'>
            <a href='{{ route('index') }}'>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                {{ __('Home') }}</a>
            <span class='footer-btn-tooltip group-hover:scale-100'>{{ __('Go to the start page') }}</span>
         </div>
        
         <div class='footer-btn group'>
            <a href='{{ route('contacts.index') }}'>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                {{ __('Back') }}
            </a>
            <span class='footer-btn-tooltip group-hover:scale-100'>{{ __('Back to contacts') }}</span>
        </div>
    </div>
    
@endsection