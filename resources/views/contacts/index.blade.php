@extends('layouts.app')

@section('content')

    <div class='m-auto w-4/5 py-24'>
        
        <div class='text-center'>
            <h1 class='text-5xl uppercase bold'>Contacts list</h1>
        </div>
        
        <!-- use Table/Table component -->
        <x-table.table 
            :headers="['#','First name','Last name','Address','City','Phone']"
            :class="'table-striped table-bordered p-5'"
        >
            @foreach($contacts as $theContact)
                <tr>
                    <td>{{ $theContact->id }}</td>
                    <td>{{ $theContact->firstName }}</td>
                    <td>{{ $theContact->lastName }}</td>
                    <td>{{ $theContact->address }}</td>
                    <td>{{ $theContact->city }}</td>
                    <td>{{ $theContact->phone }}</td>
                </tr> 
            @endforeach
        </x-table.table>
        
        <div>
            <a href='/contacts/create'>Add a new contact &rarr;</a>
        </div>
        
    </div>   
@endsection