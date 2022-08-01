<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Repositiories\DoctrineContactRepository;
use App\Domain\Services\Contacts\DeleteContactService;

class ContactsController extends BaseController
{
    public function listContactsAction( ) {       
        return View::make('contacts.list', []);
    }    
    
    public function contactDetailsAction( Request $request, DoctrineContactRepository $repo ) {
        
        $id = $request->route('id');
        
        $editForm = $request->has('editForm');
        
        if (empty($id)) {
            return View::make('error', ['msg' => 'ID is empty!']);
        }
        
        $contact = $repo->findById( $id );
        if (empty($contact)) {
            return View::make('error', ['msg' => sprintf('User with ID %1$s does not exist!', $id)]);
        }
        
        if ($editForm) {
            return View::make('contacts.forms.details', ['contact' => $contact]);
        }
        else {
            return View::make('contacts.details', $contact->toArray());
        }
    }
    
    public function contactDeleteAction( Request $request, DeleteContactService $deleteContactService ) {
        $id = $request->route('id');
        
        try {
            $deleteContactService->execute($id);
            return redirect()->route('contacts.list');
        } catch (\Exception $e) {
            return View::make('error', ['msg' => $e->getMessage()]);
        }
        
    }
}
