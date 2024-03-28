<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Setting;
use Flasher\Toastr\Prime\ToastrFactory;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::withCount('products')->with('children')->get();
        //        dd($categories);
        return view('admin.page.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentCategories = Category::where('parent_id', 0)->with('children')->get();
        $attributes = Attribute::all();
        return view('admin.page.categories.create', compact('parentCategories', 'attributes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ToastrFactory $flasher)
    {
        //categories that can select as parent
        $categories_id = [0];
        $pCategories = Category::where('parent_id', 0)->with('children')->get();
        $categories_id = array_merge($categories_id, $pCategories->pluck('id')->toArray());
        foreach ($pCategories as $pCategory) {
            if ($pCategory->children->isNotEmpty()) {
                $categories_id = array_merge($categories_id, $pCategory->children->pluck('id')->toArray());
            }
        }

        $data = $request->validate([
            'name' => ['required', Rule::unique('categories')->where(function ($query) use ($request) {
                $query->where('parent_id', $request->input('parent_id'));
            })],
            'parent_id' => ['required', Rule::in($categories_id)],
            'is_active' => 'nullable',
            'is_show' => 'nullable',
            'description' => 'nullable|string',
            'title' => 'nullable|string',
            'icon' => 'nullable|string',
            'attribute_ids' => 'required|array|min:2',
            'attribute_ids.*' => 'exists:attributes,id',
            'attribute_is_filter_ids' => 'required|array',
            'attribute_is_filter_ids.*' => 'exists:attributes,id',
            'attribute_is_main_ids' => 'nullable|array',
            'attribute_is_main_ids.*' => 'exists:attributes,id',
            'variation_id' => [Rule::requiredIf($request['parent_id'] != 0), 'exists:attributes,id', Rule::notIn($request->attribute_is_main_ids)],
        ]);
        $request->whenHas('is_active', function ($input) use ($request) {
            $data['is_active'] = false;
        }, function () use ($request) {
            $data['is_active'] = true;
        });
        if (isset($request->is_show)) {
            $data['is_show'] = true;
        } else {
            $data['is_show'] = false;
        };
        $filtered = Arr::except($data, ['attribute_ids', 'variation_id', 'attribute_is_main_ids', 'attribute_is_filter_ids']);
        if ($request->missing('attribute_is_main_ids') || $request['parent_id'] == 0) {
            $data['attribute_is_main_ids'] = [];
        }
        if ($request['parent_id'] == 0) {
            $data['variation_id'] = null;
        }

        try {
            DB::beginTransaction();

            $category = Category::create($filtered);

            foreach ($data['attribute_ids'] as $attribute_id) {
                $array[$attribute_id] = [
                    'is_filter' => in_array($attribute_id, $data['attribute_is_filter_ids']) ? 1 : 0,
                    'is_variation' => $attribute_id == $data['variation_id'] ? 1 : 0,
                    'is_main' => in_array($attribute_id, $data['attribute_is_main_ids'])
                ];
            }
            $category->attributes()->attach($array);

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            $flasher->addError($ex->getMessage());
            return redirect()->route('admin.categories.index');
        }

        $flasher->addSuccess('دسته بندی جدید ایجاد شد');
        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $parentCategories = Category::where('parent_id', 0)->get();
        $attributes = Attribute::all();
        return view('admin.page.categories.edit', compact('category', 'parentCategories', 'attributes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category, ToastrFactory $flasher)
    {
        $request->whenHas('is_active', function ($input) use ($request) {
            $request['is_active'] = false;
        }, function () use ($request) {
            $request['is_active'] = true;
        });
        if (isset($request->is_show)) {
            $request['is_show'] = true;
        } else {
            $request['is_show'] = false;
        };
        //categories that can select as parent
        $categories_id = [0];
        $pCategories = Category::where('parent_id', 0)->with('children')->get();
        $categories_id = array_merge($categories_id, $pCategories->pluck('id')->toArray());
        foreach ($pCategories as $pCategory) {
            if ($pCategory->children->isNotEmpty()) {
                $categories_id = array_merge($categories_id, $pCategory->children->pluck('id')->toArray());
            }
        }

        $data = $request->validate([
            'name' => ['required', Rule::unique('categories')->ignore($category)->where(function ($query) use ($request) {
                $query->where('parent_id', $request->input('parent_id'));
            })],
            'is_active' => 'nullable',
            'is_show' => 'nullable',
            'parent_id' => [Rule::in($categories_id), Rule::excludeIf($category->products->isNotEmpty() && $category->children->isNotEmpty())],
            'description' => 'nullable|string',
            'title' => 'nullable|string',
            'icon' => 'nullable|string',
            'attribute_ids' => 'required|array|min:2',
            'attribute_ids.*' => 'exists:attributes,id',
            'attribute_is_filter_ids' => 'required|array',
            'attribute_is_filter_ids.*' => 'exists:attributes,id',
            'attribute_is_main_ids' => 'nullable|array',
            'attribute_is_main_ids.*' => 'exists:attributes,id',
            'variation_id' => [Rule::requiredIf(function () use ($request, $category) {
                if ($request->has('parent_id')) {
                    return $request['parent_id'] != 0;
                } else {
                    return $category->parent_id != 0;
                }
            }), 'exists:attributes,id', Rule::notIn($request->attribute_is_main_ids)],
        ]);
        $filtered = Arr::except($data, ['attribute_ids', 'variation_id', 'attribute_is_main_ids', 'attribute_is_filter_ids']);
        if ($request->missing('attribute_is_main_ids') || $request->has('parent_id') && $request['parent_id'] == 0) {
            $data['attribute_is_main_ids'] = [];
        }
        if ($request->has('parent_id') && $request['parent_id'] == 0) {
            $data['variation_id'] = null;
        }
        try {
            DB::beginTransaction();

            $category->update($filtered);
            foreach ($data['attribute_ids'] as $attribute_id) {
                $array[$attribute_id] = [
                    'is_filter' => in_array($attribute_id, $data['attribute_is_filter_ids']) ? 1 : 0,
                    'is_variation' => $attribute_id == $data['variation_id'] ? 1 : 0,
                    'is_main' => in_array($attribute_id, $data['attribute_is_main_ids'])
                ];
            }
            $category->attributes()->sync($array);

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            $flasher->addError($ex->getMessage());
            return redirect()->route('admin.categories.index');
        }

        $flasher->addSuccess('تغییرات با موفقیت ذخیره شد');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }

    public function getCategoryAttributes(Category $category)
    {
        $attributes = $category->attributes()->wherePivot('is_variation', 0)->get();
        $variation = $category->attributes()->wherePivot('is_variation', 1)->first();

        return ['attrubtes' => $attributes, 'variation' => $variation];
    }

    public function saveOrder(Request $request)
    {
        if ($request->wantsJson()) {
            $categories = Category::all();
            $categories_order = json_decode($request->data, 'true');
            foreach ($categories_order as $index => $item) {
                if (array_key_exists('id', $item)) {
                    $p_category = $categories->find($item['id']);
                    if ($p_category && $p_category->order != $index) {
                        $p_category->update(['order' => $index]);
                    }
                }
            }
            // dd($categories_order);
            // Setting::updateOrCreate(['id' => 1], ['categories_order' => $request->data]);
            return response()->json('success');
        }
        return abort(404);
    }
}
