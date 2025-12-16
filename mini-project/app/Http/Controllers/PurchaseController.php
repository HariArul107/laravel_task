<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;


use Illuminate\Http\Request;
use App\Models\loginuser;
use App\Models\category;
use App\Models\item;
use App\Models\Purchase;
use App\Models\sale;


class PurchaseController extends Controller
{
    //
    public function showpurchase()
    {
        $Purchase = Purchase::where('user_id', session('user_id'))->get();
        return view('Purchase', compact('Purchase'));
    }

    public function showaformpurchase()
    {
        // $items = item::all();
        $userId = session('user_id');

        $items = item::where('user_id', $userId)->get();
        return view('purchase_form', compact('items'));
    }

    public function addpurchase(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,item_id',
            'quantity' => 'required|integer|min:1',
        ]);

        $item = item::findOrFail($request->item_id); // item is a model name

        $purchase = Purchase::create([
            'item_id' => $item->item_id,
            'user_id' => Session::get('user_id'), // take from session
            'quantity' => $request->quantity,
            'total_price' => $item->prize * $request->quantity,
        ]);

        return redirect('/purchase')->with('success', 'Category Added Successfully!');
    }


    public function edit(Request $request, $id)
    {
        $userId = session('user_id');

        $editable = $request->has('edit');

        $purchase = Purchase::where('purchase_id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        $items = item::where('user_id', $userId)->get();

        return view('edit_purchase', compact('purchase', 'items', 'editable'));
    }

    public function update(Request $request, $id)
    {
        $userId = session('user_id');

        $request->validate([
            'item_id' => 'required',
            'quantity' => 'required|integer|min:1'
        ]);

        $purchase = Purchase::where('purchase_id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        $item = Item::findOrFail($request->item_id);
        $total = $item->prize * $request->quantity;

        $purchase->update([
            'item_id' => $request->item_id,
            'quantity' => $request->quantity,
            'total_price' => $total
        ]);

        return redirect('/purchase')->with('success', 'Purchase updated successfully');
    }

    public function delete($id)
    {
        $userId = session('user_id');

        $purchase = Purchase::where('purchase_id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        $saleCount = sale::where('purchase_id', $id)->count();

        if ($saleCount > 0) {
            return redirect()->back()
                ->with('success', 'Cannot delete this purchase because sales are associated with it.');
        }

        $purchase->delete();

        return redirect('/purchase')->with('success', 'Purchase deleted successfully');
    }

    // sales
    public function showsale()
    {
        $sale = sale::where('user_id', session('user_id'))->get();
        return view('sale', compact('sale'));
    }

    public function showaformsale()
    {
        // $items = item::all();
        $userId = session('user_id');

        $purchases = Purchase::where('user_id', $userId)->get();
        return view('sale_form', compact('purchases'));
    }

    public function addsale(Request $request)
    {
        $userId = session('user_id');

        // Validate request
        $request->validate([
            'purchase_id' => 'required|exists:purchase,purchase_id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Get the purchase record for this user
        $purchase = Purchase::where('user_id', $userId)
            ->where('purchase_id', $request->purchase_id)
            ->firstOrFail();

        // Check if requested quantity is available
        if ($purchase->quantity < $request->quantity) {
            return back()->with('error', 'Not enough quantity in your purchase.');
        }

        // Get item details
        $item = $purchase->item; // Assuming Purchase model has 'item' relationship

        // Calculate total price with 10% discount
        $totalPrice = $item->prize * $request->quantity;
        $discountedPrice = $totalPrice * 0.9; // 10% discount

        // Create sale
        Sale::create([
            'purchase_id' => $request->purchase_id,
            'user_id' => $userId,
            'quantity' => $request->quantity,
            'total_price' => $discountedPrice,
        ]);

        // Reduce quantity in purchase table
        $purchase->quantity -= $request->quantity;
        $purchase->save();

        return redirect('/sales')->with('success', 'Sale added successfully with 10% discount!');
    }



    public function editsale(Request $request, $id)
    {
        $userId = session('user_id');

        $editable = $request->has('edit');


        // $purchase = Purchase::where('purchase_id', $id)
        //     ->where('user_id', $userId)
        //     ->firstOrFail();

        // $items = item::where('user_id', $userId)->get();



        $sale = sale::where('sales_id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        $purchases = Purchase::where('user_id', $userId)->get();

        return view('edit_sale', compact('sale', 'purchases', 'editable'));
    }

    public function updatesale(Request $request, $id)
    {
        $userId = session('user_id');

        $request->validate([
            'purchase_id' => 'required|exists:purchase,purchase_id',
            'quantity' => 'required|integer|min:1',
        ]);

        $sale = Sale::where('sales_id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        // OLD purchase (before edit)
        $oldPurchase = Purchase::where('purchase_id', $sale->purchase_id)
            ->where('user_id', $userId)
            ->firstOrFail();

        // Restore old quantity
        $oldPurchase->quantity += $sale->quantity;
        $oldPurchase->save();

        // NEW purchase (after edit)
        $newPurchase = Purchase::where('purchase_id', $request->purchase_id)
            ->where('user_id', $userId)
            ->firstOrFail();

        // Check stock for new purchase
        if ($request->quantity > $newPurchase->quantity) {
            return back()->withErrors([
                'quantity' => 'Not enough stock available'
            ]);
        }

        // Reduce new purchase quantity
        $newPurchase->quantity -= $request->quantity;
        $newPurchase->save();

        // Price & discount
        $price = $newPurchase->item->prize;
        $total = $price * $request->quantity;
        $discountedTotal = $total * 0.90;

        // Update sale
        $sale->update([
            'purchase_id' => $newPurchase->purchase_id,
            'quantity' => $request->quantity,
            'total_price' => $discountedTotal,
        ]);

        return redirect('/sales')->with('success', 'Sale updated successfully');
    }
    public function deletesale($id)
{
    $userId = session('user_id');

    // Get sale
    $sale = Sale::where('sales_id', $id)
        ->where('user_id', $userId)
        ->firstOrFail();

    // Get related purchase
    $purchase = Purchase::where('purchase_id', $sale->purchase_id)
        ->where('user_id', $userId)
        ->firstOrFail();

    // Restore quantity
    $purchase->quantity += $sale->quantity;
    $purchase->save();

    // Delete sale
    $sale->delete();

    return redirect('/sales')->with('success', 'Sale deleted and stock restored successfully');
}

}
