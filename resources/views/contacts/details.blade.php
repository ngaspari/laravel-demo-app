<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="ngaspari">

        <title>Contact details</title>
        
        <link href="{{ asset('css/contacts.css') }}" media="screen" rel="stylesheet" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        
        <script>
        function approveDeletion( id ) {
            if (confirm('Jeste li sigurni da želite obrisati kontakt?\n(Obrisani podaci ne mogu biti vraćeni) ')) {
            	var baseUrl = "{{ url('/contacts/delete') }}";
                $(location).attr('href', baseUrl + '/' + id);
	        }
        }
        </script>
    </head>
<body>

<div class="main">
    <h1>Contact details</h1>
    
    <table class='details'>
        <tr>
            <td>Ime</td>
            <td>{{ $firstName }}</td>
        </tr>
        
        <tr>
            <td>Prezime</td>
            <td>{{ $lastName }}</td>
        </tr>
        
        <tr>
            <td>Adresa</td>
            <td>{{ $address }}</td>
        </tr>
        
        <tr>
            <td>Grad</td>
            <td>{{ $city }}</td>
        </tr>
        
        <tr>
            <td>Država</td>
            <td>{{ $country }}</td>
        </tr>
        
        <tr>
            <td>Email</td>
            <td>{{ $email }}</td>
        </tr>
        
        <tr>
            <td>Telefon</td>
            <td>{{ $phoneNumber }}</td>
        </tr>
        
        <tr>
            <td>Relatives</td>
            <td>
                @forelse($relativesList as $type => $relatives)
                    <b>{{ $type }}(s):</b><br/>
                    @foreach($relatives as $theRelative)
                    &nbsp; - <a href="{{ url('/contacts/details/' . $theRelative['id']) }}">{{ $theRelative['firstName']. ' ' . $theRelative['lastName'] }}</a><br/>                
                    @endforeach
                    <br/>
                @empty
                    <em>N/A</em>
                @endforelse
             </td>
        </tr>
        
        <tr>
            <td colspan='2' align='right'>
                <a href="{{ url()->current() }}?editForm=1"><img src='/images/edit_icon_32.png' title='Uredi' /></a>
                &nbsp;&nbsp;&nbsp;
                <button onclick='approveDeletion({{ $id }})'>
                    <img src='/images/delete_icon_32.png' title='Obriši' />
                 </button>
            </td>
        </tr>
    </table>
    
    <br/><br/>
    <a href="{{ url('/contacts/list/') }}" class='home_link'>Natrag</a>

</div>
</body>
</html>