@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>后台配置</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.config.update')}}" method="post">
                {{csrf_field()}}
                {{method_field('put')}}
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">后台名称</label>
                    <div class="layui-input-block">
                        <input type="text" name="system_name" value="{{ $config['system_name']??'' }}" lay-verify="required"  class="layui-input" >
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">系统描述</label>
                    <div class="layui-input-block">
                        <input type="text" name="system_remarks" value="{{ $config['system_remarks']??'' }}"   class="layui-input" >
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">登录验证码</label>
                    <div class="layui-input-block">
                        <input type="checkbox" name="captcha" lay-skin="switch" lay-text="ON|OFF" @if( isset($config['captcha']) && $config['captcha'] )  checked @endif>

                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确 认</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection