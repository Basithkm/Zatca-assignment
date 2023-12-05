<?php

namespace App\Http\Controllers;

use PDF;

use Illuminate\Http\Request;
use App\Models\InvoiceDetailed;
use App\Models\InvoiceMaster;
use App\Mail\UserCreatedMail;
use DB;

use Illuminate\Support\Facades\Mail;
class InvoiceController extends Controller
{
    public function index()
    {
    $master=InvoiceMaster::with('detail')->get();
        return view('invoice.index',['master'=>$master]);
    }
    public function create()
    {
        return view('invoice.create');
    }
  
    public function store(Request $request)
    {
        //   return $request->all();
        $data = request()->validate([
            'invoice_date' => 'required',
            'amount.*' => 'required|numeric|min:0',
            'quantity.*' => 'required|numeric|min:0',
            'customer_name' => 'required|regex:/^[\pL\s\-]+$/',
            'customer_email' => 'required',

           
        ]);
        try
            {

                    
                DB::transaction(function () use($request,&$master)
                {
                    $master=New InvoiceMaster;
                    $master->customer_name=$request->customer_name;
                    $master->customer_email=$request->customer_email;
                    $invoice_date = date('Y-m-d', strtotime($request->invoice_date));;
                    $master->invoice_date = $invoice_date;
                    $master->invoice_amount=$request->sub_total;
                    $master->save();
                    foreach($request->input('product_name') as $key=>$val)
                    {
                        $invoice=new InvoiceDetailed;
                        $invoice->master_id=$master->id;
                        $invoice->product_name=$request->input('product_name')[$key];
                        $invoice->quantity = $request->input('quantity')[$key];
                        $invoice->amount = $request->input('amount')[$key];
                        $invoice->total_amount =$request->input('total_amount')[$key];
                        $invoice->tax_percentage =$request->input('gst')[$key];
                        $invoice->tax_amount =$request->input('tax_amount')[$key];
                        $invoice->net_amount =$request->input('net_amount')[$key] ;
                        $invoice->save();
                    }
                });    
               return redirect('invoice/index')->with('message','Invoice Created Successfully');
            }
        catch(Exception $e)
            {
                return $e->getMassage();
            }
    }
    public function edit($id){
        $goods_out=InvoiceMaster::with('detail')->find($id);
        return view('invoice.edit',['goods_out'=>$goods_out]);
        }
        public function update(Request $request)
        {
            //   return $request->all();
            $data = request()->validate([
                'invoice_date' => 'required',
                'amount.*' => 'required|numeric|min:0',
                'quantity.*' => 'required|numeric|min:0',
                'customer_name' => 'required|regex:/^[\pL\s\-]+$/',
                'customer_email' => 'required',
               
    
               
            ]);
            try
                {

                        
                    DB::transaction(function () use($request)
                    {
                        $goods_out_detail = InvoiceDetailed::where('master_id',$request->id)->get();
                        $goods_out_detail->each->delete();

                        $master= InvoiceMaster::find($request->id);
                        $master->customer_name=$request->customer_name;
                        $master->customer_email=$request->customer_email;
                        $invoice_date = date('Y-m-d', strtotime($request->invoice_date));;
                        $master->invoice_date = $invoice_date;
                        $master->invoice_amount=$request->sub_total;
                        $master->save();
                        
                        foreach($request->input('product_name') as $key=>$val)
                        {
                            $detailed=new InvoiceDetailed;
                            $detailed->master_id=$master->id;
                            $detailed->product_name=$request->input('product_name')[$key];
                            $detailed->quantity = $request->input('quantity')[$key];
                            $detailed->amount = $request->input('amount')[$key];
                            $detailed->total_amount =$request->input('total_amount')[$key];

                            $detailed->tax_percentage = isset($request->input('gst')[$key]) ? $request->input('gst')[$key] : null;
                            $detailed->tax_amount =$request->input('tax_amount')[$key];
                            $detailed->net_amount =$request->input('net_amount')[$key] ;
                            $detailed->save();
                        }
                       
                       
                        
                    });
                    return redirect('invoice/index');
    
                }
            catch(Exception $e)
                {
                    return $e->getMassage();
                }
        }
    public function delete($id)
    {
        $master=InvoiceMaster::find($id);
        $goods_out_detail = InvoiceDetailed::where('master_id',$id)->get();
        $goods_out_detail->each->delete();

        $master->delete();
        return redirect('invoice/index');
    }



    public function invoice_download(Request $request,$id)
    {
        $details=InvoiceDetailed::where('master_id',$id)->get();
        $master=InvoiceMaster::find($id);
    
        return PDF::loadView('invoice.downloads.invoive_details', [
            'details' => $details,
            'master'=>$master
        ])->download('details_report_pdf.pdf');
    }




    public function all_data_download(Request $request)
    {
        
        $master=InvoiceMaster::with('detail')->get();


        // return view('invoice.downloads.all_invoive_details',['master'=>$master]);
        return PDF::loadView('invoice.downloads.all_invoive_details', [
            
            'master'=>$master
        ])->download('all_report_pdf.pdf');
    }




    





}
