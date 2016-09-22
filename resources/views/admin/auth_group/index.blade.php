@extends('admin.public.master')

@section('title', '用户组管理')

@section('nav', '用户组管理')

@section('body')

    <ul id="myTab" class="nav nav-tabs">
        <li class="active">
            <a href="#home" data-toggle="tab">用户组列表</a>
        </li>
        <li>
            <a href="javascript:;" onclick="add()">添加用户组</a>
        </li>
    </ul>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade in active" id="home">
            <table class="table table-striped table-bordered table-hover table-condensed">
                <tr>
                    <th>用户组名</th>
                    <th>操作</th>
                </tr>
                @foreach($data as $v)
                    <tr>
                        <td>{{ $v['title'] }}</td>
                        <td>
                            <a href="javascript:;" ruleId="{{ $v['id'] }}" ruleTitle="{{ $v['title'] }}" onclick="edit(this)">修改</a> |
                            <a href="javascript:if(confirm('确定删除？'))location='{{ url('admin/auth_group/destroy', ['id'=>$v['id']]) }}'">删除</a> |
                            <a href="{{ url('admin/auth_group/rule_group_show',['id'=>$v['id']]) }}">分配权限</a> |
                            <a href="{{ url('admin/auth_group_access/search_user', ['group_id'=>$v['id']]) }}">添加成员</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

    <!-- 添加菜单模态框开始 -->
    <div class="modal fade" id="bjy-add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        添加用户组
                    </h4>
                </div>
                <div class="modal-body">
                    <form id="bjy-form" class="form-inline" action="{{ url('admin/auth_group/store') }}" method="post">
                        {{ csrf_field() }}
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <tr>
                                <th width="15%">用户组名：</th>
                                <td>
                                    <input class="form-control" type="text" name="title">
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>
                                    <input class="btn btn-success" type="submit" value="添加">
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- 添加菜单模态框结束 -->

    <!-- 修改菜单模态框开始 -->
    <div class="modal fade" id="bjy-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        修改规则
                    </h4>
                </div>
                <div class="modal-body">
                    <form id="bjy-form" class="form-inline" action="{{ url('admin/auth_group/update') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="id">
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <tr>
                                <th width="12%">规则名：</th>
                                <td>
                                    <input class="form-control" type="text" name="title">
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>
                                    <input class="btn btn-success" type="submit" value="修改">
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- 修改菜单模态框结束 -->

@endsection

@section('js')

    <script>
        // 添加菜单
        function add(){
            $("input[name='title']").val('');
            $('#bjy-add').modal('show');
        }

        // 修改菜单
        function edit(obj){
            var ruleId=$(obj).attr('ruleId');
            var ruleTitle=$(obj).attr('ruleTitle');
            $("input[name='id']").val(ruleId);
            $("input[name='title']").val(ruleTitle);
            $('#bjy-edit').modal('show');
        }
    </script>

@endsection