@extends('layouts.app')
@section('content')



<!-- Add Expenses Modal -->
<div class="modal fade" id="add_receipt" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add Expenses</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

       <form method="post" action="{{route('expenses.add')}}">
       @csrf
          <div class="modal-body">
            <div class="row">
                <div class="col-6 col-md-6" >
                      <input type="hidden" class="form-control" name="id" value="{{$date->id}}">
                      Date:<input type="date" class="form-control" name="date">
                </div>
                <div class="col-6 col-md-6">
                      Description:<input type="text" class="form-control" name="description">
                </div>
            </div><!--row-->

             <div class="row">
                 <div class="col-6 col-md-6">
                      Care of:<input type="text" class="form-control" name="care_of">
                  </div>
                  <div class="col-6 col-md-6">
                      Amount:<input type="number" class="form-control" name="amount">
                  </div>
             </div><!--row-->
          </div><!--modal-body-->

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Add</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
     </form>
    </div>
  </div>
</div>




<!-- Add Petty Cash -->
<div class="modal fade" id="cash_in" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add Petty Cash</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
 
      <form method="post" action="{{route('cash.in')}}">
     @csrf
      <div class="modal-body">
          <div class="row">
              <div class="col-6 col-md-6">
                Given by:<input type="text" class="form-control" name="given_by">
              </div>
              <div class="col-6 col-md-6">
                 <input type="hidden" name="id" value="{{$date->id}}">
                Amount:<input type="number" class="form-control" name="amount">
              </div>
          </div>
      </div><!--modal-body-->

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Add</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>

     </form>
    </div>
  </div>
</div>





<div class="container mt-2" >
    <div class="card">
        <div class="card-header">
              <btn class="btn btn-success"data-bs-toggle="modal" data-bs-target="#cash_in" >Add Petty Cash</btn>
              <btn class="btn btn-success " data-bs-toggle="modal" data-bs-target="#add_receipt" style="float:right;">Add Expenses</btn>
         </div> 

          <div class="card-body table-responsive">
        			<table id="example" class="table table-bordered table-striped" width="100%">
        				  <thead>
        				  	<tr>
        				  		<th>Date</th>
                      <th>Desciption</th>
        				  		<th>Care of</th>
        				  		<th>Amount</th>
        				  		<th>Action</th>
        				  	</tr>
        				  </thead>
        				  <tbody >
          				  	@foreach($alldata as $data)
          				  	<tr>
          				  		<td>{{$data->receipt_date}}</td>
                        <td>{{$data->description}}</td>
          				  		<td>{{$data->name}}</td>
          				  		<td>{{number_format($data->amount)}}</td>
          				  		<td>
          				        	<a href="{{ route('expenses.delete', $data->id)}}" class="btn btn-danger btn-sm">Delete</a>
          				  		</td>
          				  	</tr>
        				  	@endforeach
        				  </tbody>		
        			</table>

        			<div class="row">
        					<div class="d-flex justify-content-end table-responsive"style="">
                      <table class="table table-bordered border-secondary d-flex justify-content-end" id="for_desktop">
                          <tbody>
                              <small>
                               @foreach($cash_in as $cash)
                                  <tr>
                                      <td class="col-12 d-flex justify-content-end">
                                          {{$cash->created_at->format('m/d/Y')}}
                                          from {{$cash->given_by}}:
                                          {{number_format($cash->cash_in)}}
                                      </td>
                                      <td>
                                        <a href="{{ route('cash.in.delete', $cash->id)}}" class="btn btn-danger justify-content-end btn-sm ">x</a>
                                      </td>
                                  </tr>
                                 @endforeach
                               </small>
                           </tbody>
                      </table>
        					</div><!---d-flex justify content-end-->
        	

        					<div class=" d-flex justify-content-end">
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
        				  			<a href="{{ route('generate.pettycash',$date->id)}}" class="btn btn-success">
        				  				Generate Payroll
        				  			</a>
        					</div>   				

        			</div><!--row-->

          </div><!--card body-->
    </div><!--card-->

</div><!--container-->

<script>
    $(document).ready(function() {

    $('#example').DataTable({
      'responsive': true,
    'pageLength': 5,
   	 'lengthMenu': [[5, 25, 50, -1], [5, 25, 50, "All"]],
      'ordering'    : false,
      	});
} );


</script>


@endsection