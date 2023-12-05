<div style="margin-left:auto;margin-right:auto;">
<style media="all">
    @page {
		margin: 0;
		padding:0;
	}
	*{
		margin: 0;
		padding: 0;
	}
	body{
		line-height: 1.5;
		font-family: 'DejaVuSans', 'sans-serif';
		color: #333542;
	}
	div{
		font-size: 1rem;
	}
	.gry-color *,
	.gry-color{
		color:#878f9c;
	}
	table{
		width: 100%;
	}
	table th{
		font-weight: normal;
	}
	table.padding th{
		padding: .5rem .7rem;
	}
	table.padding td{
		padding: .7rem;
	}
	table.sm-padding td{
		padding: .2rem .7rem;
	}
	.border-bottom td,
	.border-bottom th{
		border-bottom:1px solid #eceff4;
	}
	.text-left{
		text-align:left;
	}
	.text-right{
		text-align:right;
	}
	.small{
		font-size: .85rem;
	}
	.strong{
		font-weight: bold;
	}
</style>



	<div style="background: #eceff4;padding: 1.5rem;">
		<table>
			<tr>
                <td><b>Name</b>  : {{$master->customer_name}} </td>
                <td style="font-size: 1.5rem;" class="text-right strong">Invoie Report</td>
			</tr>
            <tr>
            <td><b>Email</b>  : {{$master->customer_email}} </td>
            </tr>
            <tr>
            <td><b>Date</b> : {{$master->invoice_date}} </td>
            </tr>
            <tr>
            <td><b>Total Amount</b> : {{$master->invoice_amount}} </td>
            </tr>
		</table>

	</div>
	<div style="border-bottom:1px solid #eceff4;margin: 0 1.5rem;"></div>

    <div style="padding: 1.5rem;">
		<table class="padding text-left small border-bottom">
			<thead>
                <tr class="gry-color" style="background: #eceff4;">
                    <th width="3%">SN</th>
                    <th width="30%">Product Name</th>
                    <th width="30%">Quantity</th>
                    <th width="3%">Amount</th>
                    <th width="30%">Total Amount</th>
                    <th width="30%">Tax Percentage</th>
                    <th width="30%">Tax Amount</th>
                    <th width="30%">Net Amount</th>
                    
                </tr>
			</thead>
			<tbody class="strong">
            @php
                    $serialNumber = 1;
                @endphp
                     @foreach($details as $detail)

                <tr>
                <td>{{ $serialNumber++ }}</td>
                <td>{{ $detail->product_name }}</td>
                <td>{{ $detail->quantity }}</td>
                <td>{{ $detail->amount }}</td>
                <td>{{ $detail->total_amount }}</td>
                <td>{{ $detail->tax_percentage }}%</td>
                <td>{{ $detail->tax_amount }}</td>
                <td>{{ $detail->net_amount }}</td>
                  
                </tr>
                @endforeach
            <tr>
                <td></td>
            </tr>
                <tr>
                <td colspan="4"></td>
                <td><b>Total Amount</b></td>
                <td></td>
                <td></td>
                <td><b> {{$master->invoice_amount}}</b></td>
            </tr>
            </tbody>
		</table>
	</div>

</div>
