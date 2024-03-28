<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Flasher\Toastr\Prime\ToastrFactory;

use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function index()
    {
        $categories = Category::where('parent_id', 0)->with('children.children')->get();

        return view('admin.page.prices.index', compact('categories'));
    }

    public function updatebaseprice(Request $request, ToastrFactory $flasher)
    {
        $request->validate([
            'type' => 'required|string|max:100',
            'category' => 'required',
            'amount' => 'required|integer',
        ]);
        $category = Category::findOrFail($request->category);
        if ($request->amount > 0) {
            foreach ($category->products as $productvalue) {
                foreach ($productvalue->variations as $productvariations) {
                    if ($productvariations->base_price) {

                        $base = $productvariations->base_price + (($request->amount / 100) * $productvariations->base_price);


                        $price = ($base * ($productvariations->percent_price / 100)) + $base;
                        $price_2 = $price - ($price % 1000);

                        $sale_price = $productvariations->sale_price ? $productvariations->sale_price + (($request->amount / 100) * $productvariations->sale_price) : null;
                        if ($sale_price) {
                            $sale_price = $sale_price - ($sale_price % 1000);
                        }

                        $productvariations->update([
                            'base_price' => $base,
                            'price' => floor($price_2),
                            'sale_price' => floor($sale_price),

                        ]);
                    }
                }
            }
        } elseif ($request->amount < 0) {
            foreach ($category->products as $productvalue) {

                foreach ($productvalue->variations as $productvariations) {

                    $base = ($productvariations->base_price * 100) / (100 + abs($request->amount));

                    $price = ($base * ($productvariations->percent_price / 100)) + $base;
                    $price_2 = $price - ($price % 1000);
                    $sale_price = $productvariations->sale_price ? $productvariations->sale_price + (($request->amount / 100) * $productvariations->sale_price) : null;
                    if ($sale_price) {
                        $sale_price = $sale_price - ($sale_price % 1000);
                    }

                    $productvariations->update([
                        'base_price' => $base,
                        'price' => floor($price_2),
                        'sale_price' => floor($sale_price),
                    ]);
                }
            }
        }
        alert()->success('قیمت ها بروز گردید');
        return redirect()->back();
    }


    // گارانتی و مدت

    public function updateGuarantee(Request $request, ToastrFactory $flasher)
    {
        $request->validate([
            'guarantee' => 'required|string|max:100',
            'category' => 'required',
            'time_guarantee' => 'required|string|max:100',
        ]);
        $category = Category::findOrFail($request->category);
        foreach ($category->products as $productvalue) {
            foreach ($productvalue->variations as $productvariations) {
                $productvariations->update([
                    'guarantee' => $request->guarantee,
                    'time_guarantee' => $request->time_guarantee,
                ]);
            }
        }
        alert()->success(' گارانتی ها  بروز گردید');
        return redirect()->back();
    }

    //هزینه ارسال
    public function updateDelivery(Request $request, ToastrFactory $flasher)
    {
        $request->validate([
            'category' => 'required',
            'delivery_amount' => 'required|integer',
            'delivery_amount_per_product' => 'required|integer',
        ]);
        $category = Category::findOrFail($request->category);
        foreach ($category->products as $productvalue) {
            $productvalue->update([
                'delivery_amount' => $request->delivery_amount,
                'delivery_amount_per_product' => $request->delivery_amount_per_product,
            ]);
        }
        alert()->success('  هزینه های حمل و نقل  بروز گردید');
        return redirect()->back();
    }
}
