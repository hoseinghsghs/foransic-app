<?php

namespace App\Http\Controllers\Admin;

use App\Exports\OrdersExport;
use App\Exports\ProductExport;
use App\Exports\ProductsExport;
use App\Exports\TransactionExport;
use App\Exports\UserAddressExport;
use App\Exports\UserExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BackupController extends Controller
{
    public function ExportProducts()
    {
        return Excel::download(new ProductsExport, 'Products-data.xlsx');
    }
    public function ExportProducts2()
    {
        return Excel::download(new ProductExport, 'Products2-data.xlsx');
    }

    public function ExportOrders()
    {
        return Excel::download(new OrdersExport, 'Orders-data.xlsx');
    }

    public function ExportUsers()
    {
        return Excel::download(new UserExport, 'Users-data.xlsx');
    }

    public function TransactionExport()
    {
        return Excel::download(new TransactionExport, 'Transactions-data.xlsx');
    }

    public function ExportUserAddresses()
    {
        return Excel::download(new UserAddressExport, 'UserAddress-data.xlsx');
    }
}
