@extends('layouts.admin')
@section('render')
<div class="container-fluid pt-5">
    @include('common.alert')
<div class="row">
    <div class="mx-auto">
        <h1>Memo's</h1>
    </div>
    <div class="row">
        <div class="ml-auto mx-5">
            @include('memo.form')
        </div>
    </div>

   
</div>




  <div class="row pt-4">
    <div class="col-2">
      <div class="list-group" id="list-tab" role="tablist">
      <div class="row">    
          <a class="list-group-item list-group-item-action active h4" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Sent  <span class="ml-5"></span> <span class="badge badge-primary badge-pill">{{$sent->count()}}</span></a>
        
</div>
<div class="row">   
     <a class="list-group-item list-group-item-action h4" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Received  <span class="ml-4"></span> <span class="badge badge-warning badge-pill">{{$recieved->count()}}</span></a>

</div>
      
      </div>
    </div>
    <div class="col-10">
      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
            <table id="table_id1" style="font-size: small!important; ">
                <thead>
                <tr>
                    <th> Sent To</th>
                    <th>Memo</th>
                    <th>Date and Time</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($sent as $item)
                        <tr>
                            @foreach ($users as $user)
                            @if ($item->reciever ==  (string)$user->id) 
                            <td> {{$user->name}} <span class="mx-1">({{$user->email}})</span></td>
                            @endif
                          
                            @endforeach
                           
                            <td><a href="{{Storage::url($item->path)}}">Open Memo</a></td>
                            <td>{{$item->created_at}}</td>
                        </tr>
                    @endforeach
              
                <hr>
                </tbody>
            </table>
            
        </div>
        <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
            <table id="table_id" style="font-size: small!important; ">
                <thead>
                <tr>
                    <th> Sent By</th>
                    <th>Memo</th>
                    <th>Date and Time</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($recieved as $item)
                  <tr>
                    @foreach ($users as $user)
                    @if ($item->sender ==  (string)$user->id) 
                    <td> {{$user->name}} <span class="mx-1">({{$user->email}})</span></td>
                    @endif
                  
                    @endforeach
                   
                    <td><a href="{{Storage::url($item->path)}}">Open Memo</a></td>
                    <td>{{$item->created_at}}</td>
                </tr>
              @endforeach
                <hr>
                </tbody>
            </table>
            
        </div>
       
      </div>
    </div>
  </div>
    
</div>
    
@endsection