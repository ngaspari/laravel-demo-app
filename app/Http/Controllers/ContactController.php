<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $contacts = Contact::all()->paginate(2);
        // $contacts = DB::table('new_contacts')->paginate(2);
        
        $contacts = Contact::orderBy('id', 'asc')->paginate(25);
        
        //dd($contacts);
                
        $headers = [
            ['name' => '#', 'class' => 'text-left'],
            ['name' => 'First name', 'class' => 'text-left'],
            ['name' => 'Last name', 'class' => 'text-left'],
            ['name' => 'Address', 'class' => 'text-left'],
            ['name' => 'City', 'class' => 'text-left'],
            ['name' => 'Phone', 'class' => 'text-right'],
            ['name' => 'Edit', 'class' => 'text-center'],
            ['name' => 'Delete', 'class' => 'text-center'],
        ];
        
        return view('contacts.index', ['contacts' => $contacts, 'headers' => $headers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contacts.create', ['pageTitle' => 'Create new contact']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        /*
        $contact = new Contact();
        $contact->firstName = $request->input('firstName');
        $contact->lastName = $request->input('lastName');
        $contact->address = $request->input('address');
        $contact->city = $request->input('city');
        $contact->country = $request->input('country');
        $contact->email = $request->input('email');
        $contact->phone = $request->input('phone');
        $contact->save();
        */
        
        Contact::create( [
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'country' => $request->input('country'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ]);
        
        return redirect('/contacts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact = Contact::findOrFail( $id );
        return view('contacts.edit', ['pageTitle' => 'Edit contact: ' . $contact->getDisplayName(), 'editForm' => true, 'contact' => $contact]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail( $id );
        
        $contact->update( [
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'country' => $request->input('country'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ]);
        
        return redirect('/contacts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail( $id );
        
        $contact->delete();
        
        return redirect('/contacts');
    }
}
