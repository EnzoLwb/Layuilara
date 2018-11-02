<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Site;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    // 每页显示记录条数
    const PERPAGE = 15;

    public function __construct()
    {
        // 取出系统基本信息
        $setting = Site::where('type','admin')->pluck('value','key');
        view()->share('system_name', $setting['system_name'] ?? '后台管理系统');
        view()->share('system_remarks', $setting['system_remarks'] ?? '系统备注.....');
        //是否含有前台
        if (isset($setting['home_url'])) view()->share('home_url', $setting['home_url']);
        // 设置默认Guard
//        Auth::setDefaultDriver('admin');
    }
    /**
     * 处理权限分类
     */
    public function tree($list=[], $pk='id', $pid = 'parent_id', $child = '_child', $root = 0)
    {
        if (empty($list)){
            $list = Permission::get()->toArray();
        }
        // 创建Tree
        $tree = array();
        if(is_array($list)) {
            // 创建基于主键的数组引用
            $refer = array();
            foreach ($list as $key => $data) {
                $refer[$data[$pk]] =& $list[$key];
            }
            foreach ($list as $key => $data) {
                // 判断是否存在parent
                $parentId =  $data[$pid];
                if ($root == $parentId) {
                    $tree[] =& $list[$key];
                }else{
                    if (isset($refer[$parentId])) {
                        $parent =& $refer[$parentId];
                        $parent[$child][] =& $list[$key];
                    }
                }
            }
        }
        return $tree;
    }

}
