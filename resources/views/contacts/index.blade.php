@extends('layouts.app')

@section('content')

    <div class='m-auto w-100 pb-8'>
        
        <div class='text-center'>
            <h1 class='text-5xl uppercase bold'>Contacts list</h1>
        </div>
        
        <form action="{{ route('contacts.index', request()->query()) }}">
            <div class="flex my-3">
                <input type='hidden' name='sortf' value="{{ request()->get('sortf') }}" />
                <input type='hidden' name='sord' value="{{ request()->get('sord') }}" />
                <!-- <input type='hidden' name='page' value="{{ request()->get('page') }}" />  -->
                
                <input type="text" name="q" placeholder="{{ __('Search') }}" class="py-2 px-2 text-sm border border-gray-200 rounded-l focus:outline-none" value="{{ $searchParam }}" />
            
                <button type="submit" class="w-10 flex items-center justify-center border-t border-r border-b border-gray-200 rounded-r text-gray-100 bg-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
        </div>
        </form>

        <!-- use Table/Table component -->
        <x-table.table 
            :headers="$headers"
            :class="'table-striped table-bordered w-full'"
        >
            @foreach($contacts as $theContact)
                <tr>
                   <x-table.td>{{ $theContact->id }}</x-table.td>
                   <x-table.td>{{ $theContact->firstName }}</x-table.td>
                   <x-table.td>{{ $theContact->lastName }}</x-table.td>
                   <x-table.td>{{ $theContact->address }}</x-table.td>
                   <x-table.td>{{ $theContact->city }}</x-table.td>
                   <x-table.td>{{ $theContact->country_name }}</x-table.td>
                   <x-table.td align='left'>{{ $theContact->phone }}</x-table.td>
                   
                   <x-table.td align='right'>
                       <a href='/contacts/{{ $theContact->id }}/edit'><img src='images/edit_icon_32.png' /></a>
                   </x-table.td>
                   
                   <x-table.td align='center'>
                       <form action='/contacts/{{ $theContact->id }}' method='POST'>
                            @csrf
                            @method("DELETE")
                            <button type='submit'><img src='images/delete_icon_32.png' /></button>
                       </form>
                   </x-table.td>
                </tr> 
            @endforeach
        </x-table.table>
        
        <!-- pagination -->
        <div class='mt-2'>
            {{ $contacts->appends( request()->except('page') )->links() }}
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
                <a href='{{ route('contacts.create') }}'>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                    {{ __('New contact') }}
                </a>
                <span class='footer-btn-tooltip group-hover:scale-100'>{{ __('Create a new contact') }}</span>
            </div>
        </div>

    </div>   
@endsection