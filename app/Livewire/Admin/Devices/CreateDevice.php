<?php

namespace App\Livewire\Admin\Devices;

use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\ProductAttributeController;
use App\Http\Controllers\Admin\ProductVariationController;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Keyword;
use App\Models\Device;
use App\Models\ProductImage;
use App\Models\Shop;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;


class CreateDevice extends Component
{
    use WithFileUploads;

    public string $device_name = '';
    public string $position = 'پیش فرض';
    public bool $status = false;
    public bool $contact = false;
    public int|null $brand_id = null;
    public array $tags_id = [];
    public array $keywords_id = [];
    public string $description = '';
    public string $seo_description = '';
    public string $seo_title = '';
    public int|null $category_id = null;
    public $category_attributes;
    public $category_variation;
    public array $attribute_values = [];
    public array $variations = [['name' => '', 'price' => null, 'user_id' => null, 'percent_price' => null, 'base_price' => null, 'quantity' => null, 'sku' => '', 'guarantee' => '', 'time_guarantee' => '']];
    public string|null $delivery_amount = null;
    public string|null $delivery_amount_per_product = null;
    public $primary_image;

    protected $validationAttributes = [
        'variations.*.time_guarantee' => 'زمان گارانتی',
        'variations.*.guarantee' => 'گارانتی',
        'variations.*.sku' => 'شناسه انبار',
        'variations.*.price' => 'قیمت',
        'variations.*.user_id' => 'اقدام کننده',
        'variations.*.percent_price' => 'افزایش درصدی',
        'variations.*.base_price' => 'قیمت پایه',
        'variations.*.device_name' => 'نام دیوایس',
        'variations.*.quantity' => 'تعداد',
        'delivery_amount_per_product' => 'هزینه ارسال به ازای محصول'
    ];

    public function rules(): array
    {
        return [
            'device_name' => 'required|string|max:100',
            'brand_id' => 'nullable|exists:brands,id',
            'position' => ['required', Rule::in(['پیش فرض', 'فروش ویژه', 'پیشنهاد ما', 'تک محصول'])],
            'tags_id' => 'nullable|array',
            'tags_id.*' => 'nullable|exists:tags,id',
            'keywords_id' => 'nullable|array',
            //'keywords_id.*' => 'nullable|exists:KeyWords,id',
            'description' => 'required|string',
            'seo_description' => 'required|string',
            'seo_title' => 'required|string',
            'primary_image' => 'required|image|mimes:jpg,jpeg,png,svg|max:2000',
            'category_id' => 'required|exists:categories,id',
            'attribute_values' => 'required|array',
            'attribute_values.*' => 'required|string',
            'variations' => 'required|array|min:1',
            'variations.*' => 'required|array',
            'variations.*.name' => 'required|string|distinct',
            'variations.*.base_price' => 'required|integer',
            'variations.*.percent_price' => 'required|integer',
            'variations.*.user_id' => 'nullable|integer',
            'variations.*.price' => 'required|integer',
            'variations.*.quantity' => 'required|integer',
            'variations.*.sku' => 'nullable|string|distinct|unique:product_variations,sku',
            'variations.*.guarantee' => 'nullable|string',
            'variations.*.time_guarantee' => 'nullable|string',
            'delivery_amount' => 'required|integer',
            'delivery_amount_per_product' => 'required|integer',
        ];
    }

    public function mount()
    {
        Session::forget('images');
    }

    public function addVariation()
    {
        $this->variations[] = [];
    }

    public function updateFinalPrice($id)
    {
        if ($this->variations[$id]['base_price'] && $this->variations[$id]['percent_price']) {
            $result = $this->variations[$id]['base_price'] + (($this->variations[$id]['base_price'] * $this->variations[$id]['percent_price']) / 100);
            // round the final price
            $this->variations[$id]['price'] = $result - ($result % 1000);
        }
    }

    public function removeVariation($index)
    {
        array_splice($this->variations, $index, 1);
    }

    public function updatedUserId()
    {
        $users = User::findOrFail($this->user_id);
        $this->category_attributes = $category->attributes()->wherePivot('is_variation', 0)->get();
        foreach ($this->category_attributes as $attribute) {
            $this->attribute_values[$attribute->id] = '';
        }
        $this->category_variation = $category->attributes()->wherePivot('is_variation', 1)->first();
    }

    public function updatedVariations()
    {
        $this->validateOnly("variations.*.sku");
    }

    public function create()
    {

        $this->validate();
        try {

            DB::beginTransaction();
            if ($this->primary_image) {
                $ImageController = new ImageController();
                $image_name = $ImageController->UploadeImage($this->primary_image, "primary_image", 900, 800);
                $small_image_name = $ImageController->UploadeImage($this->primary_image, "small_primary_image", 320, 284);
            } else {
                $image_name = null;
                $small_image_name = null;
                $this->addError('primary_image', 'مشکل در ذخیره سازی عکس');
            }
            $device = Device::create([
                'device_name' => $this->device_name,
                'position' => $this->position,
                'brand_id' => $this->brand_id,
                'category_id' => $this->category_id,
                'primary_image' => $image_name,
                'small_primary_image' => $small_image_name,
                'description' => $this->description,
                'seo_description' => $this->seo_description,
                'seo_title' => $this->seo_title,
                'is_active' => !$this->status,
                'contact' => !$this->contact,
                'delivery_amount' => $this->delivery_amount,
                'delivery_amount_per_product' => $this->delivery_amount_per_product,
            ]);

            $imagesStore = Session::pull('images', []);
            foreach ($imagesStore as $imageStore) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $imageStore
                ]);
            }

            $productAttributeController = new ProductAttributeController();
            $productAttributeController->store($this->attribute_values, $product);

            $productVariationController = new ProductVariationController();
            $productVariationController->store($this->variations, $this->category_variation->id, $product);
            if (count($this->tags_id) > 0) {
                $device->tags()->attach($this->tags_id);
            }
            if (count($this->keywords_id) > 0) {
                $device->keywords()->attach($this->keywords_id);
            }
            DB::commit();
        } catch (\Exception $ex) {
            alert()->error('خطا', $ex->getMessage())->showConfirmButton('تایید');
            DB::rollBack();
            return redirect()->back();
        }
        Session::forget('images');
        alert()->success('دیوایس مورد نظر دریافت شد')->toToast();
        return redirect()->route('admin.products.index');
    }


    public function render()
    {
        $users = User::all();
        // dd($users->hasRole('super-admin'));
        return view('livewire.admin.devices.create-device', compact('users'))->extends('admin.layout.MasterAdmin')->section('Content');
    }
}
