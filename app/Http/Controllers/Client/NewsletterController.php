<?php

namespace App\Http\Controllers\Client;

use App\Models\Newsletter;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Request as RequestFacade;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class NewsletterController extends DefaultController
{
    public function __construct(private readonly Newsletter $newsletterModel = new Newsletter())
    {
        parent::__construct();
        $this->middleware('IsAdmin')->except('store');
    }
    public function index() : \Illuminate\View\View
    {
        $data = [
            'title' => 'Newsletters',
            'entityName' => 'Newsletter',
            'route' => 'admin.newsletters',
            'columns' => Schema::getColumnListing('newsletters'),
            'values' => Newsletter::all()
        ];
        $currentRoute = RequestFacade::route()->getName();
        return view('pages.admin.index')->with('active', $currentRoute)
            ->with('data', $data);
    }
    public function store(Request $request) : \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'email' => 'required|email'
        ]);
        try {
            return $this->newsletterModel->insert($request->email);
        } catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return response()->json(['error' => 'An error occurred.'], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function destroy(string $id) : RedirectResponse
    {
        try {
            $this->newsletterModel::destroy($id);
            return redirect()->route('admin.newsletters.index')->with('success', 'Newsletter deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.newsletters.index')->with('error', 'An error occurred while deleting newsletter.');
        }
    }

}
