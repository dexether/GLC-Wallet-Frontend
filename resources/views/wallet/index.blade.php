@extends('layouts.master')
@section('title')
   Wallet
@endsection
@section('content')
   <section>
      <div class="pageContent wallets">
        <div class="container">
    <div class="row">
       
        <div class="col-md-12">
            <div class="panel panel-white with_drw">
                <div class="panel-heading">
                    <h6 class="panel-title"> Create Wallet</h6>

                    <div class="heading-elements">

                    </div>
                </div>

                  <div class="panel-body">
                 <!--  {!! Form::open(array('url' => url('create_wallet'), 'method' => 'post', 'id' => 'withdraw-form',"enctype"=>"multipart/form-data")) !!} -->
                  <form action="{{ url('wallet/create_wallet') }}" method="post" >
                     {{ csrf_field() }}
                     <div class="form-group">
                        {!! Form::label('label_name1','Wallet Label',array('class'=>'')) !!}
                        {!! Form::text('label_name',null, array('class' => 'form-control cust_fld', 'required'=>"required",'id'=>'label_name1')) !!}
                    </div>

                      <div class="form-group">
                        {!! Form::label('ac_pwd','Account Password',array('class'=>'')) !!}
                        {!! Form::text('ac_password',null, array('class' => 'form-control cust_fld', 'required'=>"required",'id'=>'ac_pwd')) !!}
                    </div>
                     
                </div>

                   <div class="act_btns withdrw_btc">        
                        <button type="submit" class="btn btn-default  btn-xs send_rec pull-left"
                                id="submit_form"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="14" height="14" viewBox="0 0 14 14"><defs>
    <style>
      .cls-1 {
        fill: #839cb8;
        fill-rule: evenodd;
      }
    </style>
  </defs>
  <path d="M13.562,7.000 L10.144,7.000 C9.982,7.354 9.795,7.720 9.561,8.103 C7.607,11.310 8.648,13.266 8.694,13.347 C8.768,13.483 8.767,13.650 8.689,13.783 C8.610,13.916 8.467,14.000 8.312,14.000 L2.187,14.000 C2.031,14.000 1.886,13.916 1.808,13.780 C1.752,13.682 0.446,11.326 2.689,7.648 C2.824,7.426 2.943,7.210 3.051,7.000 L0.437,7.000 C0.196,7.000 -0.000,6.804 -0.000,6.563 L-0.000,0.438 C-0.000,0.196 0.196,-0.000 0.437,-0.000 L13.562,-0.000 C13.804,-0.000 14.000,0.196 14.000,0.438 L14.000,6.563 C14.000,6.804 13.804,7.000 13.562,7.000 ZM2.470,13.125 L7.680,13.125 C7.416,12.173 7.235,10.238 8.814,7.649 C9.083,7.207 9.291,6.791 9.457,6.398 C9.458,6.395 9.459,6.392 9.460,6.389 C10.279,4.445 9.966,3.124 9.779,2.625 L4.569,2.625 C4.704,3.111 4.813,3.855 4.681,4.812 C4.681,4.813 4.681,4.813 4.681,4.813 C4.681,4.814 4.680,4.815 4.680,4.816 C4.554,5.732 4.208,6.837 3.436,8.103 C1.833,10.733 2.245,12.522 2.470,13.125 ZM3.654,2.625 L3.062,2.625 C2.821,2.625 2.625,2.822 2.625,3.063 L2.625,3.938 C2.625,4.178 2.821,4.375 3.062,4.375 L3.853,4.375 C3.922,3.524 3.766,2.925 3.654,2.625 ZM13.125,0.875 L0.875,0.875 L0.875,6.125 L3.440,6.125 C3.558,5.816 3.647,5.525 3.712,5.250 L3.062,5.250 C2.339,5.250 1.750,4.661 1.750,3.938 L1.750,3.063 C1.750,2.339 2.339,1.750 3.062,1.750 L10.937,1.750 C11.661,1.750 12.250,2.339 12.250,3.063 L12.250,3.938 C12.250,4.661 11.661,5.250 10.937,5.250 L10.730,5.250 C10.673,5.528 10.599,5.818 10.496,6.125 L13.125,6.125 L13.125,0.875 ZM10.694,2.625 C10.808,3.035 10.902,3.626 10.852,4.375 L10.937,4.375 C11.179,4.375 11.375,4.178 11.375,3.938 L11.375,3.063 C11.375,2.822 11.179,2.625 10.937,2.625 L10.694,2.625 ZM6.125,6.344 C6.849,6.344 7.437,7.031 7.437,7.875 C7.437,8.720 6.849,9.407 6.125,9.407 C5.401,9.407 4.812,8.720 4.812,7.875 C4.812,7.031 5.401,6.344 6.125,6.344 ZM6.125,8.532 C6.359,8.532 6.562,8.225 6.562,7.875 C6.562,7.526 6.359,7.219 6.125,7.219 C5.891,7.219 5.687,7.526 5.687,7.875 C5.687,8.225 5.891,8.532 6.125,8.532 ZM6.562,10.501 C6.804,10.501 7.000,10.697 7.000,10.938 L7.000,11.813 C7.000,12.055 6.804,12.251 6.562,12.251 C6.321,12.251 6.125,12.055 6.125,11.813 L6.125,10.938 C6.125,10.697 6.321,10.501 6.562,10.501 ZM5.687,5.250 C5.446,5.250 5.250,5.054 5.250,4.813 L5.250,3.938 C5.250,3.696 5.446,3.500 5.687,3.500 C5.929,3.500 6.125,3.696 6.125,3.938 L6.125,4.813 C6.125,5.054 5.929,5.250 5.687,5.250 Z" class="cls-1"/>
</svg>Create Wallet</button>
                         </div>
                         </form>
                        <!--  {!! Form::close() !!} -->
            
            </div>
            <!-- /.box -->
        </div>
    </div>
</div>
</div>
</section>
@endsection
@section('footer-scripts')
    <script>
     
    </script>
@endsection
