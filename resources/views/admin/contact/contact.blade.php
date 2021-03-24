@extends('admin.master')
@section('title', 'Quản lý Liên Hệ')
@section('PageContent')
	<h1 class="ui header centered page-title">Quản Lý Liên Hệ</h1>
  @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
  @endif
  <table id="data-table" class="cell-border hover order-column" style="width:100%">
      <thead>
        <tr>
          <th class="title-column-table">Họ Tên</th>
          <th class="title-column-table">Nguồn Liên Hệ</th>
          <th class="email-column-table">Điện Thoại</th>
          <th class="email-column-table">Email</th>
          <th class="title-column-table">Chủ Đề</th>
          <th class="action-column-table">Ngày</th>
          <th class="action-column-table">Hành Động</th>
        </tr>
      </thead>
      <tbody>
        @foreach($contacts as $contact)
        <tr @if($contact->status == 1) class="bold-contact" @endif>
          <td class="title-column"><a href="{{url('admin-dashboard/contacts/' . $contact->id . '/edit')}}" title="xem chi tiết">{{$contact->full_name}}</a></td>
          <td>{{$contact->source}}</td>
          <td>{{$contact->telephone}}</td>
          <td>{{$contact->email}}</td>
          <td>{{$contact->subject}}</td>
          <td>{{$contact->updated_at->format('d/m/Y')}}</td>
          <td>
            <a href="{{url('admin-dashboard/contacts/' . $contact->id . '/edit')}}" class="mini ui icon blue button" title="Xem chi tiết"><i class="eye icon"></i></a>
            <button type="button" class="mini ui icon red button btn-delete" data-tag-id="{{$contact->id}}" data-tag-name="{{$contact->full_name}} - {{$contact->subject}}"><i class="window close icon" title="Xóa"></i></button>
          </td>
        </tr>
        @endforeach
      </tbody>
  </table>
  <div class="ui tiny del-modal modal">
    <div class="content"></div>
    <div class="actions">
      <div class="ui negative button">
        No
      </div>
      <div class="ui positive right labeled icon button">
        Yes
        <i class="checkmark icon"></i>
      </div>
    </div>
  </div>

@endsection
@section('JsLibraries')
  <script src="{{url('js/admin/contact/contact.js')}}"></script>
@endsection