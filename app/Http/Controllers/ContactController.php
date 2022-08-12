<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Country;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    
    private function getLinkForContactsSorting($field, $currentSortf, $currentSord, $page = 1, $q = '') {
        $sord = 'asc';
        if ($field == $currentSortf) {
            // the same collumn/field
            $sord = ($currentSord == 'asc') ? 'desc' : 'asc';
        }
        
        return route('contacts.index', ['sortf' => $field, 'sord' => $sord, 'page' => $page, 'q' => $q]);
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
        $sortf = $request->query('sortf', 'contacts.id');
        $sord = $request->query('sord', 'asc');
        
        // default
        $sortf = $sortf ? $sortf : 'contacts.id';
        $sord = $sord ? $sord : 'asc';
        
        $searchParam = $request->query('q', '');
        $page = $request->query('page', 1);
        
        // $contactsQuery = Contact::orderBy($sortf, $sord);
        
        $contactsQuery = Contact::leftJoin('countries', 'contacts.country_id', '=', 'countries.id')->orderBy($sortf, $sord)
        ->select('contacts.id', 'contacts.firstName', 'contacts.lastName', 'contacts.address', 'contacts.city', 'contacts.phone', 'contacts.country_id', 'countries.name AS country_name');
        
        
        if ($searchParam) {
            $contactsQuery = $contactsQuery->where( function($query) use ($searchParam) {
                $query
                    ->orWhere('firstName', 'like', "%$searchParam%")
                    ->orWhere('lastName', 'like', "%$searchParam%")
                    ->orWhere('address', 'like', "%$searchParam%")
                    ->orWhere('city', 'like', "%$searchParam%")
                    ->orWhere('countries.name', 'like', "%$searchParam%")
                    ->orWhere('phone', 'like', "%$searchParam%");
            });
        }
        
        $contacts = $contactsQuery->paginate(15);
        
        $headers = [
            ['name' => '#', 'class' => 'text-left', 'link' => $this->getLinkForContactsSorting('id', $sortf, $sord, $page, $searchParam), 'sord' => $this->getSordForTheCollumn('id', $sortf, $sord) ],
            ['name' => 'First name', 'class' => 'text-left', 'link' => $this->getLinkForContactsSorting('firstName', $sortf, $sord, $page, $searchParam), 'sord' => $this->getSordForTheCollumn('firstName', $sortf, $sord)],
            ['name' => 'Last name', 'class' => 'text-left', 'link' => $this->getLinkForContactsSorting('lastName', $sortf, $sord, $page, $searchParam), 'sord' => $this->getSordForTheCollumn('lastName', $sortf, $sord)],
            ['name' => 'Address', 'class' => 'text-left', 'link' => $this->getLinkForContactsSorting('address', $sortf, $sord, $page, $searchParam), 'sord' => $this->getSordForTheCollumn('address', $sortf, $sord)],
            ['name' => 'City', 'class' => 'text-left', 'link' => $this->getLinkForContactsSorting('city', $sortf, $sord, $page, $searchParam), 'sord' => $this->getSordForTheCollumn('city', $sortf, $sord)],
            ['name' => 'Country', 'class' => 'text-left', 'link' => $this->getLinkForContactsSorting('countries.name', $sortf, $sord, $page, $searchParam), 'sord' => $this->getSordForTheCollumn('countries.name', $sortf, $sord)],
            ['name' => 'Phone', 'class' => 'text-right', 'link' => $this->getLinkForContactsSorting('phone', $sortf, $sord, $page, $searchParam), 'sord' => $this->getSordForTheCollumn('phone', $sortf, $sord)],
            ['name' => 'Edit', 'class' => 'text-center'],
            ['name' => 'Delete', 'class' => 'text-center'],
        ];
        
        return view('contacts.index', compact('contacts', 'headers', 'sortf', 'sord', 'searchParam'));
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
        
        $country = Country::where('id', $request->input('country'))->first();

        if (empty($request->input('firstName'))){ return back()->withErrors('Enter first name')->withInput(); };
        if (empty($request->input('lastName'))){ return back()->withErrors('Enter last name')->withInput(); };
        if (empty($request->input('address'))){ return back()->withErrors('Enter address')->withInput(); };
        if (empty($request->input('city'))){ return back()->withErrors('Enter city')->withInput(); };

        $contact = Contact::create( [
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ]);

        if ($country) {
            $country->contacts()->save( $contact );
        }        
        
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
                
        $country = Country::where('id', $request->input('country'))->first();
        
        $contact->update( [
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ]);
        
        if ($country) {
            $country->contacts()->save( $contact );
        }
        
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
