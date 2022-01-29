<!DOCTYPE html>
<html>
<head>
	<title></title>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}
#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}
#customers tr:nth-child(even){background-color: #f2f2f2;}
#customers tr:hover {background-color: #ddd;}
#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}	
div.petty-cash, div.total{
	text-align: right;
}
</style>

</head>
<body>

<table id="customers">
  <tr>
    <th>Date</th>
    <th>Description</th>
    <th>Care of</th>
    <th>Amount</th>
  </tr>
   @foreach($alldata as $data) 
  <tr>	
	<td>{{$data->receipt_date}}</td>
	<td>{{$data->description}}</td>
	<td>{{$data->name}}</td>
	<td>{{number_format($data->amount)}}</td>
  </tr>
  @endforeach
</table>
@foreach($cash_in as $cash)
<div class="petty-cash">
{{$cash->created_at->format('m/d/Y')}} from {{$cash->given_by}}: {{number_format($cash->cash_in)}}
</div>
@endforeach
<br>
<div class="total">
Total Petty Cash: {{number_format($total_cash_in)}}
<br>
Total Expenses: {{number_format($expenses_total_amount)}}
<br>
Change: {{number_format($total_cash_in - $expenses_total_amount)}}
</div>

</body>
</html>