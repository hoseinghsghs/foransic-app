<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Validation\Rule;
use Artesaos\SEOTools\Facades\SEOMeta;
use Flasher\Toastr\Prime\ToastrFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.page.shops.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('admin.page.shops.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ToastrFactory $flasher)
    {
        $date = $request->validate([
            'name' => 'required|string|max:100',
            'shopname' => 'required|string|max:100',
            'address' => 'required|string',
            'priority' => 'required|string|max:3',
            'cart_number' => 'required|string|max:16',
            'shaba_number' => 'required|string|max:24',
            'image' => 'required|mimes:jpg,jpeg,png,svg',
            'description' => 'required|string',
            'cellphone' => 'required|ir_mobile:zero',
        ]);

        try {
            DB::beginTransaction();
            if (isset($request->image)) {
                $ImageController = new ImageController();
                $image_name = $ImageController->UploadeImage($request->image, "shops", 420, 660);
            } else {
                $image_name = null;
            }

            $user = User::find($request->user_id);
            $user->update([
                "name" => $request->name,
            ]);
            if (isset($request->is_active)) {
                $request->is_active = true;
            } else {
                $request->is_active = false;
            };
            if (isset($request->is_home)) {
                $request->is_home = true;
            } else {
                $request->is_home = false;
            };
            Shop::create([
                "user_id" => $request->user_id,
                "name" => $request->name,
                "shopname" => $request->shopname,
                "address" => $request->address,
                "priority" => $request->priority,
                "cart_number" => $request->cart_number,
                "shaba_number" => $request->shaba_number,
                "image" => $image_name,
                "description" => $request->description,
                "cellphone" => $request->cellphone,
                'is_active' => $request->is_active,
                'is_home' => $request->is_home,
            ]);
            DB::commit();
        } catch (\Exception $ex) {
            alert()->error('خطا', $ex->getMessage())->showConfirmButton('تایید');
            DB::rollBack();
            return redirect()->back();
        }
        $flasher->addSuccess('فروشگاه جدید ایجاد شد');
        return redirect()->route('admin.shop.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop)
    {
        $users = User::all();
        return view('admin.page.shops.edit',  compact('shop', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop, ToastrFactory $flasher)
    {
        $date = $request->validate([
            'name' => 'required|string|max:100',
            'shopname' => 'required|string|max:100',
            'address' => 'required|string',
            'priority' => 'required|string|max:3',
            'cart_number' => 'required|string|max:16',
            'shaba_number' => 'required|string|max:24',
            'image' => 'mimes:jpg,jpeg,png,svg',
            'description' => 'required|string',
            'cellphone' => 'required|ir_mobile:zero',
        ]);
        try {
            DB::beginTransaction();
            if (isset($request->image)) {
                if (Storage::exists('banners/' . $shop->image)) {
                    Storage::delete('banners/' . $shop->image);
                }
                $ImageController = new ImageController();
                $image_name = $ImageController->UploadeImage($request->image, "shops", 420, 660);
            } else {
                $image_name = $shop->image;
            }

            $user = User::find($request->user_id);
            $user->update([
                "name" => $request->name,
            ]);

            if (isset($request->is_active)) {
                $request->is_active = true;
            } else {
                $request->is_active = false;
            };
            if (isset($request->is_home)) {
                $request->is_home = true;
            } else {
                $request->is_home = false;
            };

            $shop->update([
                "user_id" => $request->user_id,
                "name" => $request->name,
                "shopname" => $request->shopname,
                "address" => $request->address,
                "priority" => $request->priority,
                "cart_number" => $request->cart_number,
                "shaba_number" => $request->shaba_number,
                "image" => $image_name,
                "description" => $request->description,
                "cellphone" => $request->cellphone,
                'is_active' => $request->is_active,
                'is_home' => $request->is_home,
            ]);
            DB::commit();
        } catch (\Exception $ex) {
            alert()->error('خطا', $ex->getMessage())->showConfirmButton('تایید');
            DB::rollBack();
            return redirect()->back();
        }
        $flasher->addSuccess('فروشگاه ویرایش شد');
        return redirect()->route('admin.shop.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
