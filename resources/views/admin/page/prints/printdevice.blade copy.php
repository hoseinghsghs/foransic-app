 <!doctype html>

 <html class="no-js " lang="fa" dir="rtl">

 <head>
     @include('admin.partial.Head')
     <link rel="stylesheet" href="{{ mix('css/admin.css') }}">
 </head>

 <body class="theme-blush" id="cheack_collapsed" style="width: 80% ; margin: auto">
     <div class="container-xl mt-4" style="margin-top: 100px ">
         <div class="row mt-4">
             <div class="col-3 text-center"><img
                     src="{{ $setting->logo ? asset('storage/logo/' . $setting->logo) : '/images/logo.png' }}"
                     alt="logo" height="45px" /></div>
             <div class="col-6 text-center">
                 <h5 class="font-weight-bold">رسید دیوایس</h5>
             </div>
             <div class="col-3 text-right">
                 <h6>شماره رسید: {{ $device->id }}</h6>
                 <h6>تاریخ : {{ Hekmatinasser\Verta\Verta::instance($device->created_at)->format('Y/n/j') }}</h6>
             </div>
         </div>
         <div class="row m-3">
             <table class="table table-bordered">
                 <thead>
                     <tr>
                         <th class="text-center" colspan="11">مشخصات تحویل دهنده</th>
                     </tr>
                 </thead>
                 <tbody>
                     <tr>
                         <td colspan="11" class="text-right">
                             <div class="row">

                                 <div class="col-4">
                                     <p> رده:
                                         {{ $user_category_id->name }}
                                     </p>
                                 </div>

                                 <div class="col-4">
                                     <p>نام شخص حقیقی / حقوقی تحویل دهنده : {{ $device->delivery_name }} </p>

                                 </div>
                                 <div class="col-4">
                                     <p>کد پرسنلی : {{ $device->delivery_code }} </p>

                                 </div>

                             </div>
                             <div class="row">
                                 <div class="col-12">

                                 </div>
                             </div>
                         </td>
                     </tr>
                 </tbody>
                 <thead>
                     <tr>
                         <th class="text-center" colspan="11">مشخصات تحویل گیرنده</th>
                     </tr>
                 </thead>
                 <tbody>
                     <tr>
                         <td colspan="11" class="text-right">
                             <div class="row">
                                 <div class="col-4">
                                     <p>پرسنل تحویل گیرنده :
                                         {{ $receiver_staff_id->name }}
                                     </p>
                                 </div>
                                 {{-- <div class="col-4">
                                     <p>کد پستی:{{ $device->delivery_code }}</p>
                                 </div>
                                 <div class="col-4">
                                     <p>تلفن / نمابر:{{ $device->delivery_name }} ,
                                         {{ $device->receiver_staff_id }}
                                     </p>
                                 </div> --}}
                             </div>
                         </td>
                     </tr>
                 </tbody>
                 <thead>
                     <tr>
                         <th class="text-center" colspan="11">مشخصات کالا یا خدمات مورد معامله</th>
                     </tr>
                 </thead>
                 <thead>
                     <tr class="text-center">
                         <th>id</th>
                         <th>کد دیوایس</th>
                         <th>عنوان کالا</th>
                         <th>شرح کالا یا خدمات</th>
                         <th>اکسسوری های همراه دیوایس</th>
                         <th>واحد انداز گیری</th>
                         <th>مبلغ واحد (تومان)</th>
                         <th>مبلغ کل (تومان)</th>

                     </tr>
                 </thead>
                 <tbody>
                     @foreach ($device->orderItems as $item)
                        @php
                            $sku = App\Models\ProductVariation::find($item->product_variation_id);
                        @endphp
                        <tr class="text-center">
                            <td>۱</td>
                            <td>{{ $sku->sku }}</td>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>عدد</td>
                            <td class="text-center">{{ number_format($item->price) }}</td>
                            <td class="text-center">{{ number_format($item->subtotal) }}</td>

                        </tr>
                    @endforeach

                     <tr>
                         <th colspan="6" class="text-center">هزینه ارسال</th>

                         <th class="text-center" colspan="2">{{ $device->delivery_date }}</th>

                     </tr>

                     <tr>
                         <th colspan="5" class="text-right">شرایط و نحوه فروش: {{ $device->accessories }} </th>
                         <th colspan="6" class="text-right">توضیحات: {{ $device->description }} </th>
                     </tr>
                     <tr style="padding: 60px 0;">
                         <td colspan="5" class="text-right">مهر و امضا فروشنده</td>

                     </tr>
                 </tbody>
             </table>
         </div>
     </div>

     <script src="{{ asset('js/admin.js') }}"></script>

     {{-- <script>
         function printDiv() {

             var divContents = $(".container-xl").html();
             let url = window.location.origin + "/css/home.css";
             var a = window.open('', '', 'height=768px, width=1366px');
             a.document.write('<html><body style="background-color: white !important">');
             a.document.write('<head><title></title>');
             a.document.write('<link rel="stylesheet" href="' + url + '" type="text/css" />');
             a.document.write('</head>');
             a.document.write(divContents);
             a.document.write('</body></html>');
             a.document.close();
             a.focus();
             setTimeout(function() {
                 a.print();
             }, 1000);
             return true;
         }
     </script> --}}
 </body>

 </html>
