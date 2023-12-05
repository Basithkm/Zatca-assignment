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
                
                <td style="font-size: 1.5rem;" class="text-right strong">Complete Invoie Report</td>
			</tr>
            <tr>
            
		</table>

	</div>
	<div style="border-bottom:1px solid #eceff4;margin: 0 1.5rem;"></div>

    <div style="padding: 1.5rem;">
		<table class="padding text-left small border-bottom">
			<thead>
                <tr class="gry-color" style="background: #eceff4;">
                <th scope="col"> SN</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Customer Email</th>
                <th scope="col">Invoice Amount</th>
                <th scope="col">Invoice Date</th>
                <th scope="col">Product name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Amount</th>
                <th scope="col">Total Amount</th>
                <th scope="col">Tax Percentage</th>
                <th scope="col">Tax Amount</th>
                <th scope="col">Net Amount</th>
                <th scope="col">Grand Total</th>
                    
                </tr>
			</thead>
			<tbody class="strong">
            @php
                    $serialNumber = 1;
                @endphp
                @foreach($master as $master)

                <tr>
                <td>{{ $serialNumber++ }}</td>
      <td>{{$master->customer_name}}</td>
      <td>{{$master->customer_email}}</td>
      <td>{{$master->invoice_amount}}</td>
      <td>{{$master->invoice_date}}</td>
      <td>
            @php
                $productNames = [];
                foreach($master->detail as $detailed) {
                    $productNames[] = $detailed->product_name;
                }
                echo implode(', ', $productNames);
            @endphp
        </td>

        <td>
            @php
                $quantity = [];
                foreach($master->detail as $detailed) {
                    $quantity[] = $detailed->quantity;
                }
                echo implode(', ', $quantity);
            @endphp
        </td>

        <td>
            @php
                $amount = [];
                foreach($master->detail as $detailed) {
                    $amount[] = $detailed->amount;
                }
                echo implode(', ', $amount);
            @endphp
        </td>

        <td>
            @php
                $total_amount = [];
                foreach($master->detail as $detailed) {
                    $total_amount[] = $detailed->total_amount;
                }
                echo implode(', ', $total_amount);
            @endphp
        </td>

        <td>
            @php
                $tax_percentage = [];
                foreach($master->detail as $detailed) {
                    $tax_percentage[] = $detailed->tax_percentage;
                }
                echo implode(', ', $tax_percentage);
            @endphp
        </td>
    
        <td>
            @php
                $tax_amount = [];
                foreach($master->detail as $detailed) {
                    $tax_amount[] = $detailed->tax_amount;
                }
                echo implode(', ', $tax_amount);
            @endphp
        </td>

        <td>
            @php
                $net_amount = [];
                foreach($master->detail as $detailed) {
                    $net_amount[] = $detailed->net_amount;
                }
                echo implode(', ', $net_amount);
            @endphp
        </td>
        <td>{{$master->invoice_amount}}</td>
                  
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
