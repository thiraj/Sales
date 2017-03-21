
<div class="row clearfix">
<form name="edit_agent_form" id="edit_agent_form">

        @foreach($agents as $agent)
        <div class="col-sm-12 col-md-6">
            <div class="form-group">

                <label class="form-label">Agent Name</label>
                <div class="form-line">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <input name="agent_id" id="agent_id"  type="hidden" value="{{$agent->agent_id}}">
                    <input name="name" id="name" value="{{$agent->agent_name}}" placeholder="{{$agent->agent_name}}" class="form-control">
                </div>
            </div>
        </div>


        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label class="form-label">Contact Name</label>
                <div class="form-line">
                    <input name="contact_name" type="text" class="form-control" placeholder="{{$agent->contact_name}}" value="{{$agent->contact_name}}" />
                </div>
            </div>
        </div>


        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label class="form-label">Agent Address</label>
                <div class="form-line">
                    <input name="address" type="text"  class="form-control" placeholder="{{$agent->agent_address}}" value="{{$agent->agent_address}}" />
                </div>
            </div>
        </div>


        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label class="form-label">Designation</label>
                <div class="form-line">
                    <input name="designation" type="text" class="form-control" placeholder="{{$agent->designation}}" value="{{$agent->designation}}"/>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label class="form-label">Email</label>
                <div class="form-line">
                    <input name="email" type="email"  class="form-control" placeholder="{{$agent->email}}" value="{{$agent->email}}">
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label class="form-label">Contact</label>
                <div class="form-line">
                    <input name="contact" type="text" class="form-control" placeholder="{{$agent->telephone}}" value="{{$agent->telephone}}">
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label class="form-label">Remarks</label>
                <div class="form-line">
                    <input name="remarks" class="form-control" type="text" placeholder="{{$agent->remarks}}" value="{{$agent->remarks}}" />
                </div>
            </div>
        </div>



        
@endforeach
    
    {{--</div>--}}
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <button type="submit" id="editAgentSubmit" class="btn btn-link waves-effect">UPDATE</button>
                    <a type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</a>
                </div>
            </div>

</form>

</div>
</div>

<script>
    // Edit Agent Form Submission
    $( "#editAgentSubmit" ).click(function(e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });



        var datastring = $('#edit_agent_form').serialize();

        $.ajax({
            type: "get",
            url: '/edit_agent',
            data:datastring,

        }).done(function( result ) {

            var result = result;

            if(result == 1){

                $('#edit_agent').modal('hide');
                $('#success').modal('show');

            }else{

                $('#edit_agent').modal('hide');
                $('#error').modal('show');
            }

        });

    });

</script>