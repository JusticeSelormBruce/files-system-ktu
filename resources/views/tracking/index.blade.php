@extends('layouts.admin')
@section('render')
    <div class="container-fluid pt-5">

        <table  id="table_id" style="font-size: small!important; ">
                <thead>
                <tr>
                    <th> Sent To</th>
                    <th>File</th>
                    <th>Status</th>
                    <th>Date and Time</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($sent as $item)
                 
                        <tr>
                      
                    
                            <td @foreach ($users as $user) @if ($item->reciever ==  (string)$user->id)  ?? selected : "" @endif @endforeach> {{$user->name}} <span class="mx-1">({{$user->email}})</span></td>
                               <td>
                               <div>
                           <div class="row">
                           <div class="mx-3">  
                               @if (Auth::id() == $item->sender )
                               @else
                               <a href="/read/{{$item->id}}">Read</a>
                               @endif
                             
                            </div>
                           <a href="{{Storage::url($item->path)}}">Open File</a>
                           </div>
                              
                               </div>
                             </td>
                         
                            <td>@if($item->status == 0) <span class="text-primary h5">Recieved</span> @else <span class="text-danger h5 ">Read</span> @endif</td>
                            <td>{{$item->created_at}}</td>
                          
                        </tr>
                     
                    @endforeach
              
                <hr>
                </tbody>
            </table>
    </div>
@endsection
