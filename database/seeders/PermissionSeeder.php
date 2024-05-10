<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['name' => 'users-list', 'display_name' => 'لیست کاربران', 'guard_name' => 'web'],
            ['name' => 'users-create', 'display_name' => 'ایجاد کاربر', 'guard_name' => 'web'],
            ['name' => 'users-edit', 'display_name' => 'ویرایش کاربر', 'guard_name' => 'web'],
            ['name' => 'users-export', 'display_name' => 'خروجی اکسل کاربران', 'guard_name' => 'web'],

            ['name' => 'actions-list', 'display_name' => 'لیست عنوان اقدامات', 'guard_name' => 'web'],
            ['name' => 'actions-create', 'display_name' => 'ایجاد  عنوان اقدام', 'guard_name' => 'web'],
            ['name' => 'actions-edit', 'display_name' => 'ویرایش عنوان اقدام', 'guard_name' => 'web'],
            ['name' => 'actions-delete', 'display_name' => 'حذف  عنوان اقدام', 'guard_name' => 'web'],
            ['name' => 'actions-export', 'display_name' => 'خروجی اکسل اقدامات', 'guard_name' => 'web'],

            ['name' => 'actions-category-list', 'display_name' => 'لیست اقدامات', 'guard_name' => 'web'],
            ['name' => 'actions-category-create', 'display_name' => 'ایجاد اقدام', 'guard_name' => 'web'],
            ['name' => 'actions-category-edit', 'display_name' => 'ویرایش اقدام', 'guard_name' => 'web'],
            ['name' => 'actions-category-delete', 'display_name' => 'حذف اقدام', 'guard_name' => 'web'],

            ['name' => 'attributes-list', 'display_name' => 'لیست ویژگی های دسته بندی', 'guard_name' => 'web'],
            ['name' => 'attributes-create', 'display_name' => 'ایجاد ویژگی های دسته بندی', 'guard_name' => 'web'],
            ['name' => 'attributes-edit', 'display_name' => 'ویرایش ویژگی های دسته بندی', 'guard_name' => 'web'],
            ['name' => 'attributes-delete', 'display_name' => 'حذف ویژگی های دسته بندی', 'guard_name' => 'web'],

            ['name' => 'categories-list', 'display_name' => 'لیست دسته بندی', 'guard_name' => 'web'],
            ['name' => 'categories-create', 'display_name' => 'ایجاد دسته بندی', 'guard_name' => 'web'],
            ['name' => 'categories-edit', 'display_name' => 'ویرایش دسته بندی', 'guard_name' => 'web'],
            ['name' => 'categories-delete', 'display_name' => 'حذف دسته بندی', 'guard_name' => 'web'],

            ['name' => 'laboratories-list', 'display_name' => 'لیست آزمایشگاه', 'guard_name' => 'web'],
            ['name' => 'laboratories-create', 'display_name' => 'ایجاد آزمایشگاه', 'guard_name' => 'web'],
            ['name' => 'laboratories-edit', 'display_name' => 'ویرایش آزمایشگاه', 'guard_name' => 'web'],
            ['name' => 'laboratories-delete', 'display_name' => 'حذف آزمایشگاه', 'guard_name' => 'web'],

            ['name' => 'dossiers-list', 'display_name' => 'لیست پرونده ها', 'guard_name' => 'web'],
            ['name' => 'dossiers-archive-list', 'display_name' => 'لیست پرونده ها آرشیوی', 'guard_name' => 'web'],
            ['name' => 'dossiers-create', 'display_name' => 'ایجاد پرونده', 'guard_name' => 'web'],
            ['name' => 'dossiers-edit', 'display_name' => 'ویرایش پرونده', 'guard_name' => 'web'],
            ['name' => 'dossiers-show', 'display_name' => 'مشاهده پرونده', 'guard_name' => 'web'],
            ['name' => 'dossiers-delete', 'display_name' => 'حذف پرونده', 'guard_name' => 'web'],
            ['name' => 'dossiers-export', 'display_name' => 'خروجی اکسل پرونده', 'guard_name' => 'web'],

            ['name' => 'devices-list', 'display_name' => 'لیست شواهد دیجیتال', 'guard_name' => 'web'],
            ['name' => 'devices-archive-list', 'display_name' => 'لیست شواهد بایگانی دیجیتال', 'guard_name' => 'web'],
            ['name' => 'devices-create', 'display_name' => 'ایجاد شواهد دیجیتال', 'guard_name' => 'web'],
            ['name' => 'devices-edit', 'display_name' => 'ویرایش شواهد دیجیتال', 'guard_name' => 'web'],
            ['name' => 'devices-show', 'display_name' => 'مشاهده شواهد دیجیتال', 'guard_name' => 'web'],
            ['name' => 'devices-delete', 'display_name' => 'حذف شواهد دیجیتال', 'guard_name' => 'web'],
            ['name' => 'devices-export', 'display_name' => 'خروجی اکسل شواهد دیجیتال', 'guard_name' => 'web'],

            ['name' => 'roles', 'display_name' => 'نقش ها', 'guard_name' => 'web'],
            ['name' => 'permissions', 'display_name' => 'مجوزها', 'guard_name' => 'web'],
            ['name' => 'settings', 'display_name' => 'تنظیمات', 'guard_name' => 'web'],
            ['name' => 'events', 'display_name' => 'رویدادها', 'guard_name' => 'web'],
            ['name' => 'galleries', 'display_name' => 'گالری', 'guard_name' => 'web'],
        ];

        foreach ($permissions as $permission) {
            Permission::upsert($permission, ['name'], ['display_name']);
        }

        $roles = [
            ['name' => 'Super Admin', 'display_name' => 'مدیر سیستم', 'guard_name' => 'web'],
            ['name' => 'company', 'display_name' => 'رده', 'guard_name' => 'web'],
            ['name' => 'personnel', 'display_name' => 'پرسنل', 'guard_name' => 'web'],
            ['name' => 'viewer', 'display_name' => 'ناظر', 'guard_name' => 'web'],
        ];

        foreach ($roles as $role) {
            Role::upsert($role, ['name'], ['display_name']);
        }

//        Role::where('name','company')->syncPermissions([]);
    }
}
