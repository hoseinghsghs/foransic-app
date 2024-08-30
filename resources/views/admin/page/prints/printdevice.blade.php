 <!doctype html>

 <html class="no-js " lang="fa" dir="rtl">

 <head>
     @include('admin.partial.Head')
     <link rel="stylesheet" href="{{ mix('css/admin.css') }}">
     <style>
         * {
             margin: 0;
             padding: 0;
             border: 0;
             outline: 0;
             font-size: 100%;
             vertical-align: baseline;
             background: transparent;
         }

         .table-bordered thead td,
         .table-bordered thead th {
             border: 3px solid #000000 !important;
             border-bottom-width: 2px !important;
         }

         .table thead th {
             vertical-align: bottom !important;
             border-bottom: 3px solid #000000 !important;
         }

         .table-bordered td,
         .table-bordered th {

             border: 3px solid #000000 !important;
         }

         .table-bordered {
             border: 3x solid #000000;
         }
     </style>
 </head>

 <body class="theme-blush" id="cheack_collapsed" style="width: 50% ; margin: auto;font-size: 1.5rem">
     <div class="container-xl mt-4" style="margin-top: 100px ">
         <div class="row mt-4">
             <div class="col-3 text-center"><img src="{{ $setting->logo ? asset('storage/logo/' . $setting->logo) : '/images/logo.png' }}" alt="logo" height="130rem" width="260rem" /></div>
             <div class="col-6 text-center">
                 <h5 class="font-weight-bold">رسید پذیرش آزمایشگاه
                     </br>
                     جرم یابی دیجیتال</h5>
             </div>
             <div class="col-3 text-right">
                 <h5 class="font-weight-bold">تاریخ : {{ Hekmatinasser\Verta\Verta::instance($device->created_at)->format('Y/n/j') }}</h6>
             </div>
         </div>
         <div class="row m-3">
             <table class="table table-bordered">
                 <thead>
                     <tr>
                         <th class="text-center" colspan="11">
                             <h5 class="font-weight-bold">مشخصات تحویل دهنده</h5>
                         </th>
                     </tr>
                 </thead>
                 <tbody>
                     <tr>
                         <td colspan="11" class="text-right">
                             <div class="row">

                                 <div class="col-12">
                                     <p>
                                     <h5 class="font-weight-bold">رده:
                                         @if($device->dossier()->exists())
                                         {{ $device->dossier->company->name }}
                                         @else
                                         ندارد
                                         @endif
                                     </h5>
                                     </p>
                                 </div>

                                 <div class="col-6">
                                     <p>
                                     <h5 class="font-weight-bold">نام : {{ $device->delivery_name }} </h5>
                                     </p>
                                 </div>
                                 <div class="col-6">
                                     <p>
                                     <h5 class="font-weight-bold">کد پرسنلی : {{ $device->delivery_code }} </h5>
                                     </p>
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
                         <th class="text-center" colspan="11">
                             <h5 class="font-weight-bold"> مشخصات تحویل گیرنده </h5>
                         </th>
                     </tr>
                 </thead>
                 <tbody>
                     <tr>
                         <td colspan="11" class="text-right">
                             <div class="row">
                                 <div class="col-12">
                                     <p>
                                     <h5 class="font-weight-bold">
                                         آزمایشگاه :
                                         {{ $device->laboratory->name }}
                                     </h5>
                                     </p>
                                 </div>
                                 <div class="col-12">
                                     <p>
                                     <h5 class="font-weight-bold">
                                         پرسنل تحویل گیرنده :
                                         @if ($receiver_staff_id->exists())
                                          پرسنل تحویل گیرنده :
                                         {{ $receiver_staff_id->name }}
                                        @endif
                                     </h5>
                                     </p>
                                 </div>
                             </div>
                         </td>
                     </tr>
                 </tbody>
                 <thead>
                     <tr>
                         <th class="text-center" colspan="11">
                             <h5 class="font-weight-bold">
                                 شواهد دیجیتال
                             </h5>
                         </th>
                     </tr>
                 </thead>
                 <tr class="text-center">
                     <th>
                         <h5 class="font-weight-bold">عنوان شاهد</h5>
                     </th>
                     <th>
                         <h5 class="font-weight-bold">مدل</h5>
                     </th>
                     <th>
                         <h5 class="font-weight-bold">کد یکتا</h5>
                     </th>

                 </tr>

                 <tbody>
                     <tr class="text-center">
                         <td>
                             <h2 class="font-weight-bold"> {{ $device->category->title }}</h2>
                         </td>
                         <td>
                             <h2 class="font-weight-bold"> {{ $device->code }}</h2>
                         </td>
                         <td>
                             <h2 class="font-weight-bold"> {{ $device->id }}</h2>
                         </td>

                     </tr>

                     <tr>
                         <th colspan="6" class="text-right" style="padding-bottom:5rem ">
                             <h5 class="font-weight-bold">لوازم جانبی:
                                 {!! $device->accessories !!}
                             </h5>
                         </th>
                     </tr>
                     <tr>

                         <th colspan="6" class="text-right">
                             <h5 class="font-weight-bold">
                                 توضیحات
                                 : {!! $device->trait !!}
                             </h5>
                         </th>
                     </tr>
                 </tbody>

                 </tbody>
             </table>

         </div>
         <div class="row" dir="rtl" style="width: 100%;margin-bottom: 6rem ; margin-top: 2rem ; border-bottom: 3px dashed #000000 ;">
             <div class="col-6" style="text-align: center; margin-bottom: 7rem;">
                 <h5 class="font-weight-bold">
                     مهر و امضا تحویل گیرنده
                 </h5>
             </div>
             <div class="col-6" style="text-align: center; margin-bottom:7rem;">
                 <h5 class="font-weight-bold">
                     مهر و امضا تحویل دهنده
                 </h5>
             </div>

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
