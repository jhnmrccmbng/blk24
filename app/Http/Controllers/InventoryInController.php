<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
Use DataTables;
use App\InventoryIn;
use Illuminate\Http\Request;

class InventoryInController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $categories = \App\Inventory_category::pluck('inv_categoryname', 'id');
        
        $items = \App\InventoryIn::whereIn('inventory_statusID', [11])->select('id', 'inventory_name', 'inventory_itemID')->get()->toArray();
        
        $releasedItems = \App\Inventory_out::latest()->simplePaginate(15);

        if(\request()->ajax()){
            $data = InventoryIn::with(['categoryInventory', 'statusInventory', 'releasedItems'])->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '
                    <div class="btn-group" role="group" aria-label="Basic example">
                      <a href="'.url('/inventory/edit/'.encrypt($row->id)).'" class="btn-sm btn btn-success">Edit</a>
                    </div>';
                    return $actionBtn;
                })
                ->addColumn('itemID', function($row){
                    $itemID = $row['inventory_itemID'];
                    return $itemID;
                })
                ->addColumn('name', function($row){
                    $name = $row['inventory_name'];
                    return $name;
                })
                ->addColumn('category', function($row){
                    $category = $row['categoryInventory']['inv_categoryname'];
                    return $category;
                })
                ->addColumn('qty', function($row){
                    
                    $qty = $row['inventory_quantity'];
                    
                    $releasedItems = $row['releasedItems'];

                    $mapItems = $releasedItems->map(function($item){
                        return [
                            'id' => $item->id,
                            'qty' => $item->quantity, 
                        ];
                    })->sum('qty');

                    $sign = $mapItems >= $qty ? 'out of stock' : '';

                    return $mapItems.'/'.$qty.'<br><i class="badge badge-danger">'.$sign.'</i>';
                })
                ->addColumn('price', function($row){
                    $price = $row['inventory_unitprice'];
                    return $price;
                })
                ->addColumn('value', function($row){
                    $value = $row['inventory_unitprice'] * $row['inventory_quantity'];
                    return $value;
                })
                ->addColumn('purchasedate', function($row){
                    $purchasedate = Carbon::createfromFormat('Y-m-d', $row['inventory_purchasedate'])->format('F j, Y');
                    return $purchasedate;
                })
                ->addColumn('expirydate', function($row){
                    $expirydate = Carbon::createfromFormat('Y-m-d', $row['inventory_expirydate'])->format('F j, Y');

                    return $row['inventory_expirydate'] >= Carbon::now() ? $expirydate : $expirydate.'<br><span class="badge badge-secondary small"> Expired </span>';
                })
                ->addColumn('createdat', function($row){
                    $createdat = Carbon::createfromFormat('Y-m-d H:i:s', $row['created_at'])->format('F j, Y | G:i:A');
                    return $createdat;
                })
                ->addColumn('status', function($row){
                    $status = $row['statusInventory']['status_name'];
                    return $status;
                })

                ->rawColumns(['action', 'itemID', 'name', 'category', 'qty', 'price', 'value', 'purchasedate', 'expirydate', 'status', 'createdat'])
                ->make(true);
        }

        return view('inventory.index', compact('categories', 'items', 'releasedItems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
        $items = InventoryIn::with(['releasedItems'])->find($request->itemid);
        
        $map = $items->releasedItems->map(function($item){

            return [
                'id' => $item->id, 
                'qty' => $item->quantity,
            ];

        })->sum('qty');

        $subtract = $items->inventory_quantity - $map;

        if($map == $items->inventory_quantity){

             return redirect()->back()->withSuccess2('Item is out of stock');
        
        }elseif($request->itemqty > $subtract){

            return redirect()->back()->withSuccess2('Add Failed. Only '.$subtract.' item left in the storage for '.$items->inventory_name.'('.$items->inventory_itemID.')');

        }else{

             $createItem = \App\Inventory_out::create([
                'inventory_id' => $request->itemid,
                'quantity' => $request->itemqty,
                'remarks' => $request->remarks,
                'user_id' => Auth::user()->id,
            ]);
        
            return redirect()->back()->withSuccess1('Item successfully added to outgoing items!');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inventory = InventoryIn::create([
            'inventory_itemID' => 'blk-'.str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT),
            'inventory_categoryID' => $request->category,
            'inventory_name' => $request->itemname,
            'inventory_desc' => $request->itemdescription,
            'inventory_purchasedate' => $request->itempurchasedate,
            'inventory_expirydate' => $request->itemexpirydate,
            'inventory_quantity' => $request->itemqty,
            'inventory_unitprice' => $request->itemprice,
            'inventory_value' => $request->itemqty * $request->itemprice,
            'inventory_remarks' => $request->remarks,
            'inventory_statusID' => 11,
            'user_id' => Auth::user()->id,
        ]);

         return redirect()->back()->withSuccess('Item Successfully Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InventoryIn  $inventoryIn
     * @return \Illuminate\Http\Response
     */
    public function show(InventoryIn $inventoryIn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InventoryIn  $inventoryIn
     * @return \Illuminate\Http\Response
     */
    public function edit($inventoryIn)
    {   
        $categories = \App\Inventory_category::pluck('inv_categoryname', 'id');
        $item = InventoryIn::find(decrypt($inventoryIn));
        $statuses = \App\Status::whereIn('id', [11, 12, 13, 14, 15])->pluck('status_name', 'id');

        return view('inventory.edit', compact('item', 'categories', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InventoryIn  $inventoryIn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {  
       $item = InventoryIn::find($id);
       
       $item->update([
            'inventory_categoryID' => $request->category,
            'inventory_name' => $request->itemname,
            'inventory_desc' => $request->itemdescription,
            'inventory_purchasedate' => $request->itempurchasedate,
            'inventory_expirydate' => $request->itemexpirydate,
            'inventory_quantity' => $request->itemqty,
            'inventory_unitprice' => $request->itemprice,
            'inventory_value' => $request->itemqty * $request->itemprice,
            'inventory_remarks' => $request->remarks,
            'inventory_statusID' => $request->status,
       ]);

       return redirect()->back()->withSuccess('Item Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InventoryIn  $inventoryIn
     * @return \Illuminate\Http\Response
     */
    public function destroy($inventoryIn)
    {
        $item = InventoryIn::find($inventoryIn);

        if($item->releasedItems->count() == 0){
            
            $item->delete();

            return redirect()->route('inventory.index')->withSuccess('Item Successfully Deleted!');

        }else{

             return redirect()->route('inventory.index')->withSuccess('Item cannot be deleted due to plotted items below. Thank you.');
        }

    }

    public function deleteInventory($id){

        $item = \App\Inventory_out::find($id);
        $item->delete();

        return redirect()->route('inventory.index')->withSuccess2('Item Successfully Deleted!');
    }
}
