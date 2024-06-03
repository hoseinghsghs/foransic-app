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
         <div class="row m-3">
             <table class="table table-bordered">
                 <thead>
                     <th class="text-center" colspan="11">
                         <div class="row mt-1">

                             <div class="col-5 text-right mr-4">
                                 <p style="font-family: Titr; font-size: 1rem"> شاهد دیجیتال : {{ $device->id }} -
                                     {{ $device->category->title }}</p>
                                 <p style="font-family: Titr; font-size: 1rem"> سریال شاهد دیجیتال:
                                     {{ $device->code }}</p>

                                       <p style="font-family: Titr; font-size: 1rem">  نام آزمایشگاه:
                                     {{$device->laboratory()->exists()? $device->laboratory->name :'-'}}</p>
                             </div>
                             <div class="col-6 text-right" style="float: right;">
                                 <p style="font-family: Titr; font-size: 1rem">توضیحات تجزیه و تحلیل</p>
                             </div>

                         </div>
                     </th>
                 </thead>
                 <tr>
                     <th class="text-center" colspan="11" style="font-size: ">{!! $device->report !!}</th>
                 </tr>
             </table>
         </div>
     </div>

     <script src="{{ asset('js/admin.js') }}"></script>
 </body>

 </html>
