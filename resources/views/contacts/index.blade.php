@extends('layouts.app')

@section('content')

    <div class='m-auto w-100'>
        
        <div class='text-center'>
            <h1 class='text-5xl uppercase bold'>Contacts list</h1>
        </div>
        
        <div class='py-5'>
            <a href='/contacts/create'>Add a new contact &rarr;</a>
        </div>
        
        <!-- use Table/Table component -->
        <x-table.table 
            :headers="$headers"
            :class="'table-striped table-bordered p-5 w-full'"
        >
            @foreach($contacts as $theContact)
                <tr>
                   <x-table.td>{{ $theContact->id }}</x-table.td>
                   <x-table.td>{{ $theContact->firstName }}</x-table.td>
                   <x-table.td>{{ $theContact->lastName }}</x-table.td>
                   <x-table.td>{{ $theContact->address }}</x-table.td>
                   <x-table.td>{{ $theContact->city }}</x-table.td>
                   <x-table.td align='right'>{{ $theContact->phone }}</x-table.td>
                   
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
        <div class='p-10'>
            {{ $contacts->links() }}
        </div>
        
    </div>   
@endsection