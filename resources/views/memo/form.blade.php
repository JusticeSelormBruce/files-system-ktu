<!-- Button trigger modal -->
<button type="button" class="btn text-primary  btn-sm " data-toggle="modal" data-target="#exampleModalLong">
    <span>Send Memo</span>
    </button>
    
    <!-- Modal -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-lg">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"> Dispatch Index Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="font-size: small!important;">
                    <div class="jumbotron">
                        <form action="/save-memo" method="post" enctype="multipart/form-data">
                            @csrf
                               <div class="row">
                               
                                   <input type="hidden" name="sender" value="{{Auth::user()->id}}" readonly class="form-control" placeholder="{{Auth::user()->name}}">
                               </div>
                               <div class="row">
                                <label for="">Recievers</label>
                                <select name="reciever[]" class="form-control py-3" required multiple>
                                    <option value="1">All</option>
                                    <option value="2">VC</option>
                                    <option value="3">Pro VC</option>
                                    <option value="4">All Deans</option>
                                    <option value="5"> All HOD'S</option>
                                    <option value="6"> All Staff</option>
                                    @foreach($users as  $office)
                                        <option value="{{$office->email}}">{{$office->name}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="row pt-3">
                                <input type="file" name="path" required multiple>
                               </div>
                            <div class="row">
                                <div class="mx-auto">
                                    <button type="submit" class="btn btn-outline-dark btn-sm"><span>Send</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
    
            </div>
        </div>
    </div>
    
    