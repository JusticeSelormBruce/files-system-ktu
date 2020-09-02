<section class="w-100">
    <div class="row py-1 no-gutters">
        <div class="col-4">Reg No.</div>
        <div class="col-8 input-group-sm">
            <input type="text" name="reg_no" required class="form-control" value="{{$code}}" readonly>
        </div>
    </div>
    <div class="row py-1 no-gutters">
        <div class="col-4">Receiver</div>
        <div class="col-8 input-group-sm">
            <select name="to_whom_receive"   required class="form-control">
                <option value="">Select User</option>
                @foreach($getOfficeMembers as $member)
                    <option value="{{$member->name}}">{{$member->name}}</option>
                    @endforeach
            </select>
        </div>
    </div>
   
    <div class="row py-1 no-gutters">
        <div class="col-4">Number Of Letters</div>
        <div class="col-8 input-group-sm">
            <input type="number" name="no_of_letter" required class="form-control">
        </div>
    </div>
    <div class="row py-1 no-gutters">
        <div class="col-4">Subject</div>
        <div class="col-8 input-group-sm">
            <textarea name="subject" id="" cols="30" rows="10" required class="form-control"></textarea>
        </div>
    </div>
    <div class="row py-1 no-gutters">
        <div class="col-4">Remark</div>
        <div class="col-8 input-group-sm">
            <select name="remarks" class="form-control" required>
                <option value="">Select Remarks</option>
                <option value="signed">Signed</option>
            </select>
        </div>
    </div>
    <div class="row py-1 no-gutters ">
        <div class="col-4">Office</div>
        <div class="col-8 input-group-sm">
            <select name="office_id" class="form-control" required>
                <option value="">Select Office</option>
                @foreach($offices as $office)
                    <option value="{{$office->id}}">{{$office->name}}</option>
                    @endforeach
            </select>
        </div>
    </div>

</section>
<script>
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();


    todayDate = mm + '/' + dd + '/' + yyyy;
    document.getElementById('date').setAttribute('value',todayDate);
</script>

