@extends('layouts.app')
@section('content')



<!-- Cash Out -->
<div class="modal fade" id="cash_out" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Cash Out</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form method="post" action="{{route('cash.out')}}">
	 		@csrf
      <div class="modal-body">
		 				<div class="row">
						    <div class="col-6 col-md-6">
						        Description:<input type="text" name="description">
						    </div>
				    </div>
			    	<div class="row">
					    	<div class="col-6 col-md-6">
					     	   Care of:<input type="text" class="form-control "name="care_of">
					    	</div>
					    	<div class="col-6 col-md-6">
					      	  Amount:<input type="number" class="form-control" name="amount">
					   	  </div>
			    	</div>
      </div><!--modal body-->

      <div class="modal-footer">
      	<button type="submit" class="btn btn-primary">Add</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div><!--modal footer-->

     </form>

    </div>
  </div>
</div>


@if(Session::has('message'))
<div class="alert alert-danger text-center">
  {{Session('message')}}
</div>
@endif


<div class="container justify-content-start d-flex mt-2" id="for_desktop" >
	<div class="left flex-fill">

			<div class="row">
				<div class="col-md-10">

						<div class="card">
							  <div class="card-header">
							    	@if(empty($alldata[0]->status))
							  				<a href="{{ route('petty.cash.add')}}" class="btn btn-success" style="float:right;">New Petty Cash</a>
							    	@endif
							  </div>
							  <div class="card-body table-responsive">
							  	  <h3><b><u> Created Petty Cash:</u></b></h3>
										<table id="example" class="table table-bordered table-hover">
											  <thead>
												  	<tr>
												  		<th>Date</th>
												  		<th>Action</th>
												  	</tr>
											  </thead>
											  <tbody>
												  @foreach($alldata as $data)
												  	<tr>
												  		<td>{{$data->petty_cash_date}}</td>
												  		<td>
												   			<a href="{{ route('expenses.view',$data->id)}}" class="btn btn-primary">View</a>
												   			@if($data->status == 1)
												  				<a href="{{ route('expenses.edit',$data->id)}}" class="btn btn-primary">Edit</a>
																@endif				  		
												  		</td>
												  	</tr>
												   @endforeach	
											  </tbody>		
										</table>
							  </div><!--card-body-->
						</div>

				</div><!--col-md-10-->
			</div><!--row-->
	</div><!--left-->


	<div class="right flex-fill" >
			<div class="row" style="background: ">			
					<div class="col-md-12">
							<div class="card" id="for_margin">

									 <div class="card-header">	    	
								  			<btn class="btn btn-success" style="float:right"data-bs-toggle="modal" data-bs-target="#cash_out">Cash Out</btn>
									 </div>
									  <div class="card-body table-responsive">
												  <h3><b><u>Follow Up Receipt:</u></b></h3>
													<table class="table table-bordered table-hover">
														  <thread>
														  	<tr>
														  		<th>Date</th>
														  		<th>Description</th>
														  		<th>Name</th>
														  		<th>Amount</th>
														  		<th>Action</th>
														  	</tr>
														  </thread>
														  <tbody >
														  	@foreach($cash_out as $cash)
															  	<tr>	
															  		<td>{{$cash->date}}</td>
															  		<td>{{$cash->description}}</td>
															  		<td>{{$cash->name}}</td>
															  		<td>{{number_format($cash->amount)}}</td>
																		<td>
															  			<a href="{{ route('cash.out.close', $cash->id)}}" class="btn btn-danger">x</a>
															  		</td>
															  	</tr>	
														  	@endforeach
														  </tbody>		
													</table>
									 	 </div>

									</div><!--card-->
							</div><!--col-md-12-->	
				</div><!--row-->
	</div>	<!--right-->

</div><!--container-->


<script>
    $(document).ready(function() {

    // This will fire when document is ready:
    $(window).resize(function() {
        // This will fire each time the window is resized:
        if($(window).width() >= 1024) {
            // if larger or equal
            $("#for_desktop").attr('class', 'container justify-content-start d-flex mt-2');
            $("#for_margin").attr('class', 'card');
        } else {
            // if smaller
            $("#for_desktop").attr('class', '');
            $("#for_margin").attr('class', 'card mt-5 mb-5');
        }
    }).resize(); // This will simulate a resize to trigger the initial run.



    $('#example').DataTable({
    	responsive: true,
    'pageLength': 5,
   	 'lengthMenu': [[5, 25, 50, -1], [5, 25, 50, "All"]],
      'ordering'    : false,
      "autoWidth": true,
      	});
} );
</script>


@endsection