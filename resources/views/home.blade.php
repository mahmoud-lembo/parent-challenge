<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <!-- Required meta tags-->
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Parent.cloud Challenge">
        <meta name="author" content="Mahmoud Mohamed">
        <meta name="keywords" content="Challenge">
    <head>

    <!--Page Title-->
    <title>Parent Challenge</title>

    <!-- Main CSS-->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.0/bootstrap-table.min.css" rel="stylesheet">
    <link href="https://rawgit.com/vitalets/x-editable/master/dist/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet">
</head>

<body class="animsition">
<div class="container">
<h1>Parent Challenge</h1>

<p>A table with third party integration Filter control and Data export</a></p>
<div id="toolbar">
		<select class="form-control">
				<option value="">Export Basic</option>
				<option value="all">Export All</option>
				<option value="selected">Export Selected</option>
		</select>
</div>

<table id="table" 
data-toggle="table"
data-search="false"
data-filter-control="true" 
data-show-export="true"
data-click-to-select="true"
data-toolbar="#toolbar"
class="table-responsive">
	<thead>
		<tr>
			<th data-field="state" data-checkbox="true"></th>
			<th data-field="id" data-filter-control="input" data-sortable="true">Transaction ID</th>
			<th data-field="provider" data-filter-control="select" data-sortable="true">Provider</th>
			<th data-field="amount" data-filter-control="input" data-sortable="true">Amount</th>
			<th data-field="currency" data-filter-control="select" data-sortable="true">Currency</th>
			<th data-field="email" data-filter-control="input" data-sortable="true">Email</th>
			<th data-field="status" data-filter-control="select" data-sortable="true">Status</th>
			<th data-field="date" data-filter-control="select" data-sortable="false">Date</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($transactions as $transaction)
		<tr>
			<td class="bs-checkbox "><input data-index="0" name="btSelectItem" type="checkbox"></td>
			<td>{{ $transaction[$providerSchema[$transaction["Provider"]]["id"]] }}</td>
			<td>{{ $transaction["Provider"] }}</td>
			<td>{{ $transaction[$providerSchema[$transaction["Provider"]]["amount"]] }}</td>
			<td>{{ $transaction[$providerSchema[$transaction["Provider"]]["currency"]] }}</td>
			<td>{{ $transaction[$providerSchema[$transaction["Provider"]]["email"]] }}</td>
			<!-- For Example $providerStatus[X][1] -->
			<td>{{ $providerStatus [$transaction["Provider"]] [$transaction[$providerSchema[$transaction["Provider"]]["status"]]] }}</td>
			<td>{{ date('d-m-Y', strtotime(str_replace('/', '-', $transaction[$providerSchema[$transaction["Provider"]]["date"]]))) }}</td>
			</tr>
		@endforeach
	</tbody>
</table>
</div>

		<!-- Jquery JS-->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<!-- Bootstrap JS-->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.0/bootstrap-table.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.9.1/extensions/editable/bootstrap-table-editable.js">
		</script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.9.1/extensions/export/bootstrap-table-export.js"></script>
		<script src="https://rawgit.com/hhurz/tableExport.jquery.plugin/master/tableExport.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.9.1/extensions/filter-control/bootstrap-table-filter-control.js">
		</script>

</body>

</html>