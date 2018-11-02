<?php

use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Site::truncate();
        // 默认设置
        \Illuminate\Support\Facades\DB::table('sites')->insert(
            [
                'key' => 'system_name',
                'value' => '后台管理系统',
            ]);
        \Illuminate\Support\Facades\DB::table('sites')->insert(
            [
                'key' => 'system_remarks',
                'value' => '系统备注.....',
            ]);
        \Illuminate\Support\Facades\DB::table('sites')->insert(
            [
                'key' => 'captcha',
                'value' => '1',
            ]);
        \Illuminate\Support\Facades\DB::table('sites')->insert(
            [
                'key' => 'title',
                'value' => '前台站点名称',
                'type' => 'home',
            ]);
        \Illuminate\Support\Facades\DB::table('sites')->insert(
            [
                'key' => 'keyword',
                'value' => '前台站点描述',
                'type' => 'home',
            ]);
    }
}
