<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $items = Item::all();
        $pendings = DB::table('item_requests')
                ->select([
                    'item_requests.id as id',
                    'item_requests.itemId as itemId',
                    'users.username as clientName',
                    'items.itemName as itemName',
                    'item_requests.quantity as quantity',
                    'item_requests.created_at as created',
                ])
                ->where(['status'=>'pending'])
                ->join('items','item_requests.itemId', '=', 'items.id')
                ->join('users', 'item_requests.clientId', '=', 'users.id')
                ->get();
        $approves = DB::table('item_requests')
                ->select([
                    'item_requests.id as id',
                    'item_requests.itemId as itemId',
                    'users.username as clientName',
                    'items.itemName as itemName',
                    'item_requests.quantity as quantity',
                    'item_requests.updated_at as updated',
                ])
                ->where(['adminId'=>Auth::user()->id , 'status'=>'approved'])
                ->join('items','item_requests.itemId', '=', 'items.id')
                ->join('users', 'item_requests.clientId', '=', 'users.id')
                ->get();
        $rejects = DB::table('item_requests')
                ->select([
                    'item_requests.id as id',
                    'item_requests.itemId as itemId',
                    'users.username as clientName',
                    'items.itemName as itemName',
                    'item_requests.quantity as quantity',
                    'item_requests.updated_at as updated',
                ])
                ->where(['adminId'=>Auth::user()->id , 'status'=>'rejected'])
                ->join('items','item_requests.itemId', '=', 'items.id')
                ->join('users', 'item_requests.clientId', '=', 'users.id')
                ->get();
        return view('admin.index', compact('items', 'pendings', 'approves', 'rejects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'itemName'=> ['required'],
            'quantity'=> ['required', 'numeric' ,'min:0'],
        ]);

        $item = New Item;
        $item->itemName = $request->itemName;
        $item->quantity = $request->quantity;
        if($item->save()){
            return back()->with('success', 'Item Registered.');
        }
        else{
            return back()->with('error', 'something went wrong.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Item::findOrFail($id);
        return view('admin.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'itemName'=> ['required'],
            'quantity'=> ['required', 'numeric' ,'min:0'],
        ]);
        $item = Item::findOrFail($id);
        $item->itemName = $request->itemName;
        $item->quantity = $request->quantity;
        if($item->save()){
            return back()->with('success', 'Item Updated.');
        }
        else{
            return back()->with('error', 'something went wrong.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Item::findOrFail($id);
        if($item->delete()){
            return back()->with('success', 'Item deleted.');
        }
        else{
            return back()->with('error', 'something went wrong.');
        }
    }

    public function approve(Request $request){
        $itemRequest = ItemRequest::findOrFail($request->id);
        $item = Item::findOrFail($itemRequest->itemId);
        if($item->quantity < $itemRequest->quantity){
            return back()->with('error', 'Not enough quantity on inventory.');
        }
        else{
            $itemRequest->status = 'approved';
            $itemRequest->adminId = Auth::user()->id;
            $item->quantity = $item->quantity - $itemRequest->quantity;
            $item->save();
            if($itemRequest->save()){
                return back()->with('success', 'Approval successful.');
            }
            else{
                return back()->with('error', 'something went wrong.');
            }
        }
    }

    public function reject(Request $request){
        $itemRequest = ItemRequest::findOrFail($request->id);
        $itemRequest->status = 'rejected';
            $itemRequest->adminId = Auth::user()->id;
            if($itemRequest->save()){
                return back()->with('success', 'Rejected.');
            }
            else{
                return back()->with('error', 'something went wrong.');
            }
    }
}

