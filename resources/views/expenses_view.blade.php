@extends('layouts.app')
@section('content')


<div class="container mt-2" style="background: ">

		<div class="card">
			 	 <div class="card-header">
						Expenses
					</div>

				  <div class="card-body table-responsive">

							<table id="example" class="table table-bordered table-striped" style="width:100%" >
								  <thead>
								  	<tr>
								  		<th>Date</th>
				              <th>Description</th>
								  		<th>Care of</th>
								  		<th>Amount</th>
								  	</tr>
								  </thead>
								  <tbody >
								  	@foreach($alldata as $data)
									  	<tr>
									  		<td>{{$data->receipt_date}}</td>
					              <td>{{$data->description}}</td>
									  		<td>{{$data->name}}</td>
									  		<td>{{number_format($data->amount)}}</td>
									  	</tr>
								  	@endforeach
								  </tbody>		
							</table>

							<div class="row">

									@foreach($cash_in as $cash)
									
										<div class=" d-flex justify-content-end"style="">
												<small>
													{{$cash->created_at->format('m/d/Y')}} from {{$cash->given_by}}: {{number_format($cash->cash_in)}}
												</small>
										</div>
									@endforeach

				            <br>

										<div class=" d-flex justify-content-end mt-2">
											Total Petty Cash: {{number_format($total_cash_in)}}
										</div>

										<div class=" d-flex justify-content-end">
											Total Expenses: {{number_format($expenses_total_amount)}}
										</div>

										<div class=" d-flex justify-content-end">
											Change: {{number_format($total_cash_in - $expenses_total_amount)}}
										</div class=" d-flex justify-content-end">	

										<div class=" d-flex justify-content-end">
								  			<a href="{{ route('export.excel',$date->id)}}" class="btn btn-primary">
								  				Download to Excel
								  			</a>
										</div>

										<div class=" d-flex justify-content-end mt-2">
											@if($date->status == 0)
								  			<a href="{{ route('generate.pettycash',$date->id)}}" class="btn btn-success">
								  				Generate Payroll
								  			</a>
								  			@endif
										</div>			

							</div><!--row-->

				  </div><!--card body-->
		</div><!--card-->

</div><!--container-->

<script>
    $(document).ready(function() {
    $('#example').DataTable({
    'pageLength': 5,
   	 'lengthMenu': [[5, 25, 50, -1], [5, 25, 50, "All"]],
      'ordering'    : false,
      	});
} );
</script>

@endsection