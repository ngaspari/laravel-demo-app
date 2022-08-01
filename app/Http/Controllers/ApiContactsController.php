<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App\Domain\Services\Contacts\ViewContactsPaginatedService;
use Illuminate\Http\Request;
use App\Domain\Services\Contacts\ViewContactsPaginatedRequest;
use App\Domain\Services\Contacts\CreateContactService;
use App\Domain\Services\Contacts\EditContactService;
use App\Domain\Services\Contacts\DeleteContactService;

class ApiContactsController extends BaseController
{
    public function listContactsAction( Request $request, ViewContactsPaginatedService $service ) {
        
        $req = new ViewContactsPaginatedRequest(
            $request->get('page', 1),
            $request->get('rows', 20),
            $request->get('_search', false),
            $request->get('filters', null),
            $request->get('sidx', null),
            $request->get('sord', null)
        );
              
        $response = $service->execute( $req );

        return response()->json( $response );
    }
    
    public function deleteContactAction( Request $request, DeleteContactService $deleteContactService ) {
        
        $id = $request->get('id');
        
        try {
            $deleteContactService->execute($id);
            return response()->json( ['success' => sprintf('User with ID %1$s successfully deleted!', $id)] );
        } catch (\Exception $e) {
            return response()->json( ['error' => $e->getMessage()] );
        }
        
    }
    
    public function updateContactAction( Request $request, EditContactService $editContactService ) {
        
        try {
            
            $id = $request->get('id', null);
            
            $editContactService->execute(
                $id,
                $request->has('firstName') ? $request->get('firstName', '') : null,
                $request->has('lastName') ? $request->get('lastName', '') : null,
                $request->has('address') ? $request->get('address', '') : null,
                $request->has('city') ? $request->get('city', '') : null,
                $request->has('country') ? $request->get('country', '') : null,
                $request->has('email') ? $request->get('email', '') : null,
                $request->has('phoneNumber') ? $request->get('phoneNumber', '') : null
            );
        } catch (\Exception $e) {
            return response()->json( ['error' => $e->getMessage()] );
        }
        
        if ($request->has('from_form')) {
            // if from form - redirect
            return redirect()->back();
            //return redirect()->route('contacts.details', ['id' => $id]);
        }
        else {
            // from AJAX
            return response()->json( ['success' => sprintf('User with ID %1$s successfully saved!', $id)] );
        }
        
    }
    
    public function createContactAction( Request $request, CreateContactService $createContactService ) {
        
        $createContactService->execute(
            $request->get('firstName', ''), 
            $request->get('lastName', ''), 
            $request->get('address', ''), 
            $request->get('city', ''), 
            $request->get('country', ''), 
            $request->get('email', ''), 
            $request->get('phoneNumber', '')
        );
        
        return response()->json( ['success' => sprintf('New user saved!')] );
        
    }
    
}
