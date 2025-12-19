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
        $userId = session('user_id');

        $request->validate([
            'item_id' => 'required|exists:items,item_id',
            'quantity' => 'required|integer|min:1',
            'supplier_name' => 'required|string|max:255',
            'purchase_date' => 'required|date',
            'address' => 'required|string',
        ]);

        $item = item::findOrFail($request->item_id); // item is a model name

        $exists = Purchase::where('item_id', $request->item_id)
            ->where('user_id', $userId)
            ->exists();

        if ($exists) {
            return redirect('/purchase')
                ->with('error', 'This item is already added. You cannot add it twice.');
        }

        $purchase = Purchase::create([
            'item_id' => $item->item_id,
            'user_id' => Session::get('user_id'), // take from session
            'total_quantity' => $request->quantity, // total quantity
            'quantity' => $request->quantity, // balance quantity
            'supplier_name' => $request->supplier_name,
            'purchase_date' => $request->purchase_date,
            'address' => $request->address,
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
            'quantity' => 'required|integer|min:1',
            'supplier_name' => 'required|string|max:255',
            'purchase_date' => 'required|date',
            'address' => 'required|string',
        ]);

        $purchase = Purchase::where('purchase_id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        $item = Item::findOrFail($request->item_id);
        $total = $item->prize * $request->quantity;

        $soldQuantity = $purchase->total_quantity - $purchase->quantity;

        // prevent invalid edit
        if ($request->quantity < $soldQuantity) {
            return back()->with('error', 'Quantity cannot be less than already sold quantity.');
        }
        $remainingQuantity = $request->quantity - $soldQuantity;

        $purchase->update([
            'item_id' => $request->item_id,
            'total_quantity' => $request->quantity, // total quantity
            'quantity' => $remainingQuantity, //remaining quantity
            'supplier_name' => $request->supplier_name,
            'purchase_date'  => $request->purchase_date,
            'address'        => $request->address,
            'total_price' => $total,
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
                ->with('error', 'Cannot delete this purchase because sales are associated with it.');
        }

        $purchase->delete();

        return redirect('/purchase')->with('error', 'Purchase deleted successfully');
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
            'customer_name' => 'required|string|max:255',
            'sale_date' => 'required|date',
            'address' => 'required|string|max:500',
            'discount' => 'numeric|min:0|max:100',
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

        // Calculate total price with discount
        $totalPrice = $item->prize * $request->quantity;
        $discount = $request->discount ?? 0; // default 0%
        $discountedPrice = $totalPrice * (1 - ($discount / 100));
        $billNo = "";
        // **Create the sale first without bill_no**
        $sale = sale::create([
            'bill_no' => $billNo,
            'purchase_id' => $request->purchase_id,
            'user_id' => $userId,
            'quantity' => $request->quantity,
            'total_price' => $discountedPrice,
            'customer_name' => $request->customer_name,
            'sale_date' => $request->sale_date,
            'address' => $request->address,
            'discount' => $request->discount,
        ]);

        // **Generate bill_no using the sale_id**
        $billNo = 'BILL-' . date('Y') . '-' . str_pad($sale->sales_id, 6, '0', STR_PAD_LEFT);

        // Update the sale with bill_no
        $sale->update(['bill_no' => $billNo]);
        $sale->save();

        // Reduce quantity in purchase table
        $purchase->quantity -= $request->quantity;
        $purchase->save();

        return redirect('/sales')->with('success', 'Sale added successfully with discount!');
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
            'sale_date' => 'required|date',
            'address' => 'required|string|max:500',
            'discount' => 'nullable|numeric|min:0|max:100',
        ]);

        $sale = Sale::where('sales_id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        $oldPurchase = Purchase::where('purchase_id', $sale->purchase_id)
            ->where('user_id', $userId)
            ->firstOrFail();

        $newPurchase = Purchase::where('purchase_id', $request->purchase_id)
            ->where('user_id', $userId)
            ->firstOrFail();

        if ($sale->purchase_id == $request->purchase_id) {
            // Same purchase → adjust by difference
            $difference = $request->quantity - $sale->quantity;

            if ($difference > 0) {
                if ($difference > $oldPurchase->quantity) {
                    return back()->withErrors(['quantity' => 'Not enough stock available']);
                }
                $oldPurchase->quantity -= $difference;
            } else {
                $oldPurchase->quantity += abs($difference);
            }

            $oldPurchase->save();
        } else {
            // Different purchase → restore old, deduct new
            $oldPurchase->quantity += $sale->quantity;
            $oldPurchase->save();

            if ($request->quantity > $newPurchase->quantity) {
                return back()->withErrors(['quantity' => 'Not enough stock available']);
            }

            $newPurchase->quantity -= $request->quantity;
            $newPurchase->save();
        }

        // Price & discount
        $price = $newPurchase->item->prize;
        $totalPrice = $price * $request->quantity;

        $discount = $request->discount ?? 0;
        $discountedPrice = $totalPrice * (1 - ($discount / 100));

        $sale->update([
            'purchase_id' => $newPurchase->purchase_id,
            'quantity' => $request->quantity,
            'total_price' => $discountedPrice,
            'customer_name' => $request->customer_name,
            'sale_date' => $request->sale_date,
            'address' => $request->address,
            'discount' => $discount,
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

        return redirect('/sales')->with('error', 'Sale deleted  successfully');
    }


    public function showreport(Request $request)
    {
        $userId = session('user_id');   // logged-in user id

        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        $purchaseQty = Purchase::where('user_id', $userId)
            ->sum('total_quantity');

        $saleQty = sale::where('user_id', $userId)
            ->sum('quantity');

        $totalStock = $purchaseQty -   $saleQty;

        $sale = sale::where('user_id', session('user_id'))->get();


        $purchases = Purchase::where('user_id', session('user_id'))->get();

        $categories = category::where('user_id', session('user_id'))->get();




        return view('showreport', compact(
            'sale',
            'saleQty',
            'purchaseQty',
            'totalStock',
            'fromDate',
            'toDate',
            'purchases',
            'categories',
        ));
    }
}
