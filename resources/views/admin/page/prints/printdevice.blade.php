 <!doctype html>

 <html class="no-js " lang="fa" dir="rtl">

 <head>
     @include('admin.partial.Head')
     <link rel="stylesheet" href="{{ mix('css/admin.css') }}">
     <style>
         .table-bordered thead td,
         .table-bordered thead th {
             border-bottom-width: 2px !important;
         }

         .table thead th {
             vertical-align: bottom !important;
             border-bottom: 3px solid #000000 !important;
         }

         .table-bordered td,
         .table-bordered th {
             border: 1px solid #000000 !important;
         }

         .table-bordered {
             border: 1px solid #000000;
         }
     </style>
 </head>

 <body class="theme-blush" id="cheack_collapsed" style="width: 80% ; margin: auto;font-size: 1.5rem">
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

                                 <div class="col-12">
                                     <p> رده:
                                         {{ $user_category_id->name }}
                                     </p>
                                 </div>

                                 <div class="col-12">
                                     <p>نام شخص حقیقی / حقوقی تحویل دهنده : {{ $device->delivery_name }} </p>

                                 </div>
                                 <div class="col-12">
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
                                 <div class="col-12">
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
                         <th class="text-center" colspan="11">مشخصات دیوایس</th>
                     </tr>
                 </thead>
                 <tr class="text-center">
                     <th>id</th>
                     <th>کد دیوایس</th>
                     <th>عنوان کالا</th>
                 </tr>

                 <tbody>
                     <tr class="text-center">
                         <td>{{ $device->id }}</td>
                         <td>{{ $device->code }}</td>
                         <td>{{ $device->name }}</td>
                     </tr>

                     <tr>
                         <th colspan="6" class="text-right" style="padding-bottom:5rem ">اکسسوری ها:
                             {!! $device->accessories !!} </th>
                     </tr>
                     <tr>

                         <th colspan="6" class="text-right">توضیحات: {!! $device->description !!} </th>
                     </tr>

                     <tr style="padding: 60px 0;">

                         <td colspan="5" class="text-right " style="padding-bottom:7rem ">مهر و امضا تحویل گیرنده
                         </td>
                         <td colspan="5" class="text-right ">مهر و امضا تحویل دهنده</td>
                 </tbody>
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
