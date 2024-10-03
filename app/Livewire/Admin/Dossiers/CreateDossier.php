<?php

namespace App\Livewire\Admin\Dossiers;

use App\Http\Controllers\Admin\ImageController;
use App\Models\Dossier;
use App\Models\Event;
use App\Models\Section;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateDossier extends Component
{
    use WithFileUploads;

    public Dossier $dossier;
    public string $name = '';
    public string $number_dossier = '';
    public string $subject = '';
    public string $section_id = '';
    public string $zone_id = '';
    public string $expert = '';
    public string $country = '';
    public $user_category_id;
    public array $laboratory_id = [];
    public bool $is_active = false;
    public string $summary_description = '';
    public string $Judicial_number = '';
    public $Judicial_image = '';
    public string $Judicial_date = '';
    public string $dossier_type = '0';
    public string $dossier_case = '';
    public string $expert_phone = '';
    public string $expert_cellphone = '';

    public function rules(): array
    {
        // get users from same laboratory that has company role
        $users = User::role('company')->get()->pluck('id')->toArray();
        $auth_user=auth()->user();
        return [
            'name' => 'required|string|max:100',
            'user_category_id' => ['nullable', 'integer', Rule::in($users), Rule::requiredIf(!$auth_user->hasRole('company'))],
            'laboratory_id' => ['array', Rule::requiredIf(is_null($auth_user->laboratory_id)), Rule::when(is_null($auth_user->laboratory_id) && !$auth_user->can('dossier-select-multiple-laboratory'), 'size:1')],
            'laboratory_id.*' => ['exists:laboratories,id', Rule::requiredIf(is_null($auth_user->laboratory_id))],
            'subject' => 'required|string',
            'expert' => 'required|string',
            'country' => 'required|string',
            'section_id' => 'required|string',
            'zone_id' => 'required|string',
            'number_dossier' => 'required|string|unique:dossiers,number_dossier',
            'summary_description' => 'required|string',
            'Judicial_date' => 'nullable|string',
            'Judicial_number' => 'nullable|string',
            'dossier_case' => 'required|string',
            'dossier_type' => 'required|string',
            'expert_phone' => 'required|string',
            'expert_cellphone' => 'required|string',
        ];
    }

    public function create($type_redirect)
    {
        $this->validate();
        try {

            DB::beginTransaction();
            if ($this->Judicial_image) {
                $ImageController = new ImageController();

                $image_name = $ImageController->UploadeImage($this->Judicial_image, "Judicial-image", 900, 800);
                if (!$image_name)
                    $this->addError('Judicial_image', 'مشکل در ذخیره سازی عکس');
            } else {
                $image_name = null;
            }
            $dossier = Dossier::create([
                'name' => $this->name,
                'user_category_id' => auth()->user()->hasRole('company') ? auth()->user()->id : $this->user_category_id,
                'personal_creator_id' => auth()->user()->id,
//                'laboratory_id' => is_null(auth()->user()->laboratory_id) ? $this->laboratory_id : auth()->user()->laboratory_id,
                'section_id' => $this->section_id,
                'zone_id' => $this->zone_id,
                'subject' => $this->subject,
                'expert' => $this->expert,
                'country' => $this->country,
                'number_dossier' => $this->number_dossier,
                'summary_description' => $this->summary_description,
                'Judicial_date' => $this->Judicial_date,
                'dossier_type' => $this->dossier_type,
                'dossier_case' => $this->dossier_case,
                'expert_phone' => $this->expert_phone,
                'expert_cellphone' => $this->expert_cellphone,
                'Judicial_number' => $this->Judicial_number,
                'Judicial_image' => $image_name,
                'is_active' => !$this->is_active,
                'is_archive' => 0,
            ]);
            if (is_null(auth()->user()->laboratory_id))
                $dossier->laboratories()->attach($this->laboratory_id);
            else
                $dossier->laboratories()->attach(auth()->user()->laboratory_id);

            Event::create(['title' => ' پرونده ایجاد شد' . ' ' . ' | ' . ' ' . ' آزمایشگاه : ' . implode(' , ', $dossier->laboratories()->pluck('name')->toArray()),
                'body' => 'ID پرونده ' . " : " . $dossier->id . " | " . 'آیدی کاربر' . " : " . auth()->user()->id . "-" . auth()->user()->name . " | " . 'عنوان پرونده  : ' . $dossier->name,
                'user_id' => auth()->user()->id,
                'eventable_id' => $dossier->id,
                'eventable_type' => Dossier::class,
            ]);

            DB::commit();
        } catch (\Exception $ex) {
            flash()->addError($ex->getMessage());
            DB::rollBack();
            return redirect()->back();
        }
        flash()->addSuccess('پرونده مورد نظر دریافت شد');
        if ($type_redirect == 1) {
            return redirect()->route('admin.dossiers.index');
        } else {
            return redirect()->route('admin.dossiers.show', $dossier->id);
        }
    }

    public function render()
    {
        // get users from same laboratory that has company role
        if (auth()->user()->hasRole('company'))
            $users = collect([auth()->user()]);
        else
            $users = User::role('company')->get();

        $sections = Section::all();
        $zones = Zone::all();
        $lists_country = [
            ["Afghanistan", "AF", "افغانستان"],
            ["land Islands", "AX", "جزایر الند"],
            ["Albania", "AL", "آلبانی"],
            ["Algeria", "DZ", "الجزایر"],
            [
                "American Samoa", "AS", "ساموآی آمریکا"
            ],
            ["AndorrA", "AD", "آندورا"],
            ["Angola", "AO", "آنگولا"],
            ["Anguilla", "AI", "آنگویلا"],
            ["Antigua and Barbuda", "AG", "آنتیگوآ و باربودا"],
            ["Argentina", "AR", "آرژانتین"],
            ["Armenia", "AM", "ارمنستان"],
            ["Aruba", "AW", "آروبا"],
            ["Australia", "AU", "استرالیا"],
            ["Austria", "AT", "اتریش"],
            [
                "Azerbaijan", "AZ", "آذربایجان"
            ],
            ["Bahamas", "BS", "باهاما"],
            ["Bahrain", "BH", "بحرین"],
            [
                "Bangladesh", "BD", "بنگلادش"
            ],
            ["Barbados", "BB", "باربادوس"],
            ["Belarus", "BY", "بلاروس"],
            ["Belgium", "BE", "بلژیک"],
            ["Belize", "BZ", "بلیز"],
            ["Benin", "BJ", "بنین"],
            ["Bermuda", "BM", "برمودا"],
            ["Bhutan", "BT", "بوتان"],
            ["Bolivia", "BO", "بولیوی"],
            [
                "Bosnia and Herzegovina", "BA", "بوسنی و هرزگوین"
            ],
            ["Botswana", "BW", "بوتسوانا"],
            ["Bouvet Island", "BV", "جزیره بووه"],
            ["Brazil", "BR", "برزیل"],

            ["Brunei Darussalam", "BN", "برونئی"],
            ["Bulgaria", "BG", "بلغارستان"],
            ["Burkina Faso", "BF", "بورکینافاسو"],
            ["Burundi", "BI", "بوروندی"],
            [
                "Cambodia", "KH", "کامبوج"
            ],
            [
                "Cameroon", "CM", "کامرون"
            ],
            ["Canada", "CA", "کانادا"],
            [
                "Cape Verde", "CV", "کیپ ورد"
            ],
            ["Cayman Islands", "KY", "جزایر کیمن"],
            [
                "Central African Republic",
                "CF",
                "جمهوری آفریقای مرکزی",
            ],
            [
                "Chad", "TD", "چاد"
            ],
            [
                "Chile", "CL", "شیلی"
            ],
            [
                "China", "CN", "چین"
            ],
            ["Christmas Island", "CX", "جزایر کریسمس"],
            ["Colombia", "CO", "کلمبیا"],
            ["Comoros", "KM", "اتحاد قمر"],
            ["Congo", "CG", "کنگو"],
            [
                "Congo, The Democratic Republic of the",
                "CD",
                "جمهوری دموکراتیک کنگو",
            ],
            ["Cook Islands", "CK", "جزایر کوک"],
            ["Costa Rica", "CR", "کاستاریکا"],
            ["Croatia", "HR", "کرواسی"],
            ["Cuba", "CU", "کوبا"],
            ["Cyprus", "CY", "قبرس"],
            ["Czech Republic", "CZ", "جمهوری چک"],
            ["Denmark", "DK", "دانمارک"],
            [
                "Djibouti", "DJ", "جیبوتی"
            ],
            [
                "Dominica", "DM", "دومینیکا"
            ],
            ["Dominican Republic", "DO", "جمهوری دومینیکن"],
            ["Ecuador", "EC", "اکوادور"],
            ["Egypt", "EG", "مصر"],
            ["El Salvador", "SV", "السالوادور"],
            ["Equatorial Guinea", "GQ", "گینه استوایی"],
            ["Eritrea", "ER", "اریتره"],
            ["Estonia", "EE", "استونی"],
            ["Ethiopia", "ET", "اتیوپی"],
            [
                "Falkland Islands (Malvinas)",
                "FK",
                "جزایر فالکلند",
            ],
            ["Faroe Islands", "FO", "جزایر فارو"],
            ["Fiji", "FJ", "فیجی"],
            ["Finland", "FI", "فنلاند"],
            ["France", "FR", "فرانسه"],
            ["French Guiana", "GF", "گویان فرانسه"],
            [
                "French Polynesia", "PF", "پولینزی فرانسوی"
            ],
            ["Gabon", "GA", "گابن"],
            ["Gambia", "GM", "گامیا"],
            ["Georgia", "GE", "گرجستان"],
            ["Germany", "DE", "آلمان"],
            ["Ghana", "GH", "غنا"],
            ["Greece", "GR", "یونان"],
            ["Greenland", "GL", "گرینلند"],
            ["Grenada", "GD", "گرانادا"],
            ["Guam", "GU", "گوام"],
            ["Guatemala", "GT", "گواتمالا"],
            ["Guinea", "GN", "گینه"],
            ["Guinea-Bissau", "GW", "گینه بیسائو"],
            ["Guyana", "GY", "گویان"],
            ["Haiti", "HT", "هاییتی"],
            ["Honduras", "HN", "هندوراس"],
            ["Hong Kong", "HK", "هنگ‌کنگ"],
            ["Hungary", "HU", "مجارستان"],
            [
                "Iceland", "IS", "ایسلند"
            ],
            ["India", "IN", "هند"],
            ["Indonesia", "ID", "اندونزی"],
            ["Iran", "IR", "ایران"],
            ["Iraq", "IQ", "عراق"],
            ["Ireland", "IE", "ایرلند"],
            ["Israel", "IL", "اسراییل"],
            ["Italy", "IT", "ایتالیا"],
            ["Jamaica", "JM", "جاماییکا"],
            ["Japan", "JP", "ژاپن"],
            ["Jordan", "JO", "اردن"],
            ["Kazakhstan", "KZ", "قزاقستان"],
            ["Kenya", "KE", "کنیا"],
            [
                "Korea, Democratic People'S Republic of",
                "KP",
                "کره شمالی",
            ],
            ["Korea, Republic of", "KR", "کره جنوبی"],
            ["Kuwait", "KW", "کویت"],
            ["Kyrgyzstan", "KG", "قرقیزستان"],
            ["Lao People'S Democratic Republic", "LA", " لائوس"],
            ["Latvia", "LV", "لاتویا"],
            ["Lebanon", "LB", "لبنان"],
            ["Lesotho", "LS", "لسوتو"],
            ["Liberia", "LR", "لیبریا"],
            [
                "Libyan Arab Jamahiriya", "LY", "لیبی"
            ],
            ["Liechtenstein", "LI", "لیختنشتاین"],
            ["Lithuania", "LT", "لیتوانی"],
            ["Luxembourg", "LU", "لوگزامبورگ"],
            ["Macao", "MO", "ماکائو"],
            [
                "Macedonia, The Former Yugoslav Republic of",
                "MK",
                "مقدونیه",
            ],
            ["Madagascar", "MG", "ماداگاسکار"],
            ["Malawi", "MW", "مالاوی"],
            ["Malaysia", "MY", "مالزی"],
            ["Maldives", "MV", "مالدیو"],
            ["Mali", "ML", "مالی"],
            ["Malta", "MT", "مالت"],
            ["Marshall Islands", "MH", "جزایر مارشال"],
            ["Mauritania", "MR", "موریتانی"],
            ["Mauritius", "MU", "موریس"],
            ["Mexico", "MX", "مکزیک"],
            [
                "Micronesia, Federated States of",
                "FM",
                "میکرونزی",
            ],
            ["Moldova, Republic of", "MD", "مولداوی"],
            ["Monaco", "MC", "موناکو"],
            ["Mongolia", "MN", "مغولستان"],
            ["Montenegro", "ME", "مونتنگرو"],

            ["Morocco", "MA", "مراکش"],
            [
                "Mozambique", "MZ", "موزامبیک"
            ],
            ["Myanmar", "MM", "میانمار"],
            ["Namibia", "NA", "نامیبیا"],
            ["Nauru", "NR", "نائورو"],
            ["Nepal", "NP", "نپال"],
            ["Netherlands", "NL", "هلند"],
            [
                "Netherlands Antilles", "AN", "آنتیل هلند"
            ],
            ["New Zealand", "NZ", "نیوزیلند"],
            [
                "Nicaragua", "NI", "نیکاراگوئه"
            ],
            ["Niger", "NE", "نیجر"],
            ["Nigeria", "NG", "نیجریه"],
            [
                "Northern Mariana Islands",
                "MP",
                "جزایر ماریان شمالی",
            ],
            [
                "Norway", "NO", "نروژ"
            ],
            ["Oman", "OM", "عمان"],
            ["Pakistan", "PK", "پاکستان"],
            [
                "Palau", "PW", "پالائو"
            ],
            ["Palestinian Territory, Occupied", "PS", "فلسطین"],
            ["Panama", "PA", "پاناما"],
            [
                "Papua New Guinea", "PG", "پاپوا گینه نو"
            ],
            ["Paraguay", "PY", "پاراگوئه"],
            ["Peru", "PE", "پرو"],
            [
                "Philippines", "PH", "فیلیپین"
            ],
            ["Poland", "PL", "لهستان"],
            ["Portugal", "PT", "پرتغال"],
            ["Puerto Rico", "PR", "پورتو ریکو"],
            ["Qatar", "QA", "قطر"],
            ["Romania", "RO", "رومانی"],
            ["Russian Federation", "RU", "روسیه"],
            ["RWANDA", "RW", "رواندا"],
            ["Saint Kitts and Nevis", "KN", "سنت کیتس و نویس"],
            ["Samoa", "WS", "ساموآ"],
            ["San Marino", "SM", "سن مارینو"],
            ["Saudi Arabia", "SA", "عربستان"],
            ["Senegal", "SN", "سنگال"],
            ["Serbia", "RS", "صربستان"],
            ["Seychelles", "SC", "سیشل"],
            ["Sierra Leone", "SL", "سیرالئون"],
            ["Singapore", "SG", "سنگاپور"],
            ["Slovakia", "SK", "اسلوواکی"],
            ["Slovenia", "SI", "اسلوونی"],
            ["Solomon Islands", "SB", "جزایر سلیمان"],
            ["Somalia", "SO", "سومالی"],
            ["South Africa", "ZA", "آفریقای جنوبی"],

            ["Spain", "ES", "اسپانیا"],
            [
                "Sri Lanka", "LK", "سریلانکا"
            ],
            ["Sudan", "SD", "سودان"],
            ["Suriname", "SR", "سورینام"],
            ["Swaziland", "SZ", "سوازیلند"],
            ["Sweden", "SE", "سوئد"],
            ["Switzerland", "CH", "سوییس"],
            ["Syrian Arab Republic", "SY", "سوریه"],
            ["Taiwan, Province of China", "TW", "تایوان"],
            [
                "Tajikistan", "TJ", "تاجیکستان"
            ],
            ["Tanzania, United Republic of", "TZ", "تانزانیا"],
            ["Thailand", "TH", "تایلند"],
            ["Timor-Leste", "TL", "تیمور شرقی"],
            ["Togo", "TG", "توگو"],
            ["Tonga", "TO", "تونگا"],
            ["Trinidad and Tobago", "TT", "ترینیداد"],
            ["Tunisia", "TN", "تونس"],
            ["Turkey", "TR", "ترکیه"],
            ["Turkmenistan", "TM", "ترکمنستان"],
            ["Tuvalu", "TV", "تووالو"],
            ["Uganda", "UG", "اوگاندا"],
            ["Ukraine", "UA", "اوکراین"],
            ["United Arab Emirates", "AE", "امارات متحده"],
            ["United Kingdom", "GB", "انگلیس"],
            ["United States", "US", "آمریکا"],
            ["Uruguay", "UY", "اروگوئه"],
            ["Uzbekistan", "UZ", "ازبسکتان"],
            ["Vanuatu", "VU", "وانواتو"],
            ["Venezuela", "VE", "ونزوئلا"],
            ["Viet Nam", "VN", "ویتنام"],
            ["Wallis and Futuna", "WF", "والیس و فوتونا"],
            ["Western Sahara", "EH", "صحرای غربی"],
            ["Yemen", "YE", "یمن"],
            ["Zambia", "ZM", "زامبیا"],
            ["Zimbabw", "Z", "زیمباوه"],
        ];

        return view('livewire.admin.dossiers.create-dossier', compact('users', 'sections', 'zones', 'lists_country'))->extends('admin.layout.MasterAdmin')->section('Content');
    }
}
