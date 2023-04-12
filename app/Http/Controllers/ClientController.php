<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function home(){
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
                ->where(['clientId'=>Auth::user()->id , 'status'=>'pending'])
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
                    'item_requests.created_at as created',
                ])
                ->where(['clientId'=>Auth::user()->id , 'status'=>'approved'])
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
                    'item_requests.created_at as created',
                ])
                ->where(['clientId'=>Auth::user()->id , 'status'=>'rejected'])
                ->join('items','item_requests.itemId', '=', 'items.id')
                ->join('users', 'item_requests.clientId', '=', 'users.id')
                ->get();
        return view('client.index', compact('items', 'pendings', 'approves', 'rejects'));
    }

    public function request(Item $item){
        return view('client.request', compact('item'));
    }

    public function requestPost(Item $item, Request $request){
        $validated = $request->validate([
            'quantity'=> ['required', 'numeric' ,'min:0'],
        ]);
        if($request->quantity > $item->quantity){
            return back()->with('error', 'Items request is above current inventory.');
        }
        $requesting = new ItemRequest;
        $requesting->itemId = $item->id;
        $requesting->clientId = Auth::user()->id;
        $requesting->quantity = $request->quantity;
        $requesting->status = 'pending';
        if($requesting->save()){
            return back()->with('success', 'Request successfully added.');
        }
        else{
            return back()->with('error', 'something went wrong.');
        }
    }
}
