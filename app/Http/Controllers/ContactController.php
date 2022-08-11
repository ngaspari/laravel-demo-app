<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    
    private function getLinkForContactsSorting($field, $currentSortf, $currentSord) {
        $sord = 'asc';
        if ($field == $currentSortf) {
            // the same collumn/field
            $sord = ($currentSord == 'asc') ? 'desc' : 'asc';
        }
        
        return route('contacts.index', ['sortf' => $field, 'sord' => $sord]);
    }
    
    private function getSordForTheCollumn($field, $currentSortf, $currentSord) {
        $sord = '';
        if ($field == $currentSortf) {
            // the same collumn/field
            $sord = ($currentSord == 'asc') ? 'desc' : 'asc';
        }
        
        return $sord;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        
        // get query parameters
        $sortBy = $request->query('sortf', 'id');
        $sortOrder = $request->query('sord', 'asc');
        
        $contacts = Contact::orderBy($sortBy, $sortOrder)->paginate(25);
        
        $headers = [
            ['name' => '#', 'class' => 'text-left', 'link' => $this->getLinkForContactsSorting('id', $sortBy, $sortOrder), 'sord' => $this->getSordForTheCollumn('id', $sortBy, $sortOrder) ],
            ['name' => 'First name', 'class' => 'text-left', 'link' => $this->getLinkForContactsSorting('firstName', $sortBy, $sortOrder), 'sord' => $this->getSordForTheCollumn('firstName', $sortBy, $sortOrder)],
            ['name' => 'Last name', 'class' => 'text-left', 'link' => $this->getLinkForContactsSorting('lastName', $sortBy, $sortOrder), 'sord' => $this->getSordForTheCollumn('lastName', $sortBy, $sortOrder)],
            ['name' => 'Address', 'class' => 'text-left', 'link' => $this->getLinkForContactsSorting('address', $sortBy, $sortOrder), 'sord' => $this->getSordForTheCollumn('address', $sortBy, $sortOrder)],
            ['name' => 'City', 'class' => 'text-left', 'link' => $this->getLinkForContactsSorting('city', $sortBy, $sortOrder), 'sord' => $this->getSordForTheCollumn('city', $sortBy, $sortOrder)],
            ['name' => 'Phone', 'class' => 'text-right', 'link' => $this->getLinkForContactsSorting('phone', $sortBy, $sortOrder), 'sord' => $this->getSordForTheCollumn('phone', $sortBy, $sortOrder)],
            ['name' => 'Edit', 'class' => 'text-center'],
            ['name' => 'Delete', 'class' => 'text-center'],
        ];
        
        //return view('contacts.index', ['contacts' => $contacts, 'headers' => $headers]);
        return view('contacts.index', compact('contacts', 'headers'));
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
