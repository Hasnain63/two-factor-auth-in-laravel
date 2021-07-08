@include('inc.config')
@php 
date_default_timezone_set("Asia/Karachi");
$todaydate  = date("m/d/Y"); 
$currenttime = date("h:i:sa");
$currentmonthalph = date('M');

$timestamp = strtotime($todaydate);
$daysRemaining = (int)date('t', $timestamp) - (int)date('j', $timestamp);

@endphp
											
<!DOCTYPE html>
<html lang="en">
    <head>
      
      @yield('head_content')

    </head>
	
    <body>
		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
			@yield('header_content')
			
			@yield('sidebar_content')
			
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
				<!-- Page Content -->
                <div class="content container-fluid">
				  <form method="post" action="ledgeraction">
				  						 	 {{ csrf_field() }}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row">

								 @yield('breadcrumbs_content')

								<div class="col-md-2">
									<div class="stats-info" style="margin-bottom: 0px;">
										<h4 style="font-size: 32px;">{{ $currentmonthalph }} <span>({{ $daysRemaining }})</span></h4>
									</div>
								</div>
							 	<div class="col-sm-6 col-md-2"> 
									<div class="form-group form-focus select-focus">
										<input type="text" name="date" value="{{ $todaydate }}" class="form-control floating" readonly>
										<label class="focus-label">date</label>
									</div>
								</div>
								<div class="col-sm-6 col-md-2"> 
									<div class="form-group form-focus select-focus">
										<input type="text" name="time" value="{{ $currenttime }}" class="form-control floating" readonly>
										<label class="focus-label">Time</label>
									</div>
								</div>


							
						</div>
					</div>
					<!-- /Page Header -->
					<!-- Search Filter -->
						<div class="row filter-row">
						<div class="col-sm-6 col-md-2">  
							<div class="form-group form-focus">
								<input type="text" name="amount" value="0" class="form-control floating" required>
								<label class="focus-label">Amount</label>
							</div>
						</div>
						
						<div class="col-sm-6 col-md-2"> 
							<div class="form-group form-focus select-focus">
								<select class="select floating" name="type"> 
									<option value="Received">Received</option>
									<option value="Pay">Pay</option>
								</select>
								<label class="focus-label">Transaction Type</label>
							</div>
						</div>
						<div class="col-sm-6 col-md-2"> 
							<div class="form-group form-focus select-focus">
								<select class="select floating" name="paymentmethod"> 
									<option value="Cash">Cash</option>
									<option value="BankMeezan">Meezan Bank</option>
									<option value="BankFaisal">Faisal Bank</option>
									<option value="Cheque">Cheque</option>
								</select>
								<label class="focus-label">Payment Method</label>
							</div>
						</div>
						<div class="col-sm-6 col-md-4"> 
							<div class="form-group form-focus select-focus">
								<input type="text" name="comment" value="" class="form-control floating" required>
								<label class="focus-label">Comment</label>
							</div>
						</div>
						<div class="col-sm-6 col-md-2">  
							<input type="submit" name="Add" value="Add" class="btn btn-success btn-block"> 
						</div>
                    </div>
				</form>     
					<!-- /Search Filter -->
					
                    <div class="row">
                        <div class="col-lg-12">
							<div class="table-responsive" style="margin-bottom: 100px;">
								<table class="datatable table table-striped custom-table table-nowrap mb-0">
									<thead>
										<tr>
											<th>Sr#</th>
											<th>Date</th>
											<th>Time</th>
											<th>Amount</th>
											<th>Transaction</th>
											<th>Pay Method</th>
											<th>Comment</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>

										@foreach ($records as $record)
										<tr>
											<td>{{ ($records->count()+1) - $loop->iteration  }}</td>
											<td>{{ $record->date}}</td>
											<td>{{ $record->time}}</td>
											<td>{{ $record->amount}}</td>
											<td>{{ $record->transaction_type}}</td>
											<td>{{ $record->payment_method	}}</td>
											<td>{{ $record->comment}}</td>

											<td>
											
												<!-- <form method="POST" action="">
												    <button type="submit"><i class="fa fa-edit text-success"></i></button>
												</form>   -->
												<form method="POST" action="{{ route('destroyurl', [$record->id]) }}">
												    {{ csrf_field() }}
												    {{ method_field('DELETE') }}
												    <button type="submit"><i class="fa fa-trash text-danger"></i></button>
												</form>  
												
										</tr>
										@endforeach
										
										
									
									</tbody>
								</table>
								@php 

									$sumofreceived=0;
									$sumofpay=0;
									$cashin = 0;
									$cashout = 0;
									$bankin= 0;
									$bankout = 0;
								

								@endphp

								@foreach ($records as $received)

									@if($received->payment_method == 'Cash' && $received->transaction_type == 'Pay')
										
										@php 
											$cashout = $cashout+$received->amount;
										@endphp 

									@elseif($received->payment_method == 'Cash' && $received->transaction_type == 'Received')

										@php 
											$cashin = $cashin+$received->amount;
										@endphp 

									@endif

									@if(Str::limit($received->payment_method, 4,'') == 'Bank' && $received->transaction_type == 'Pay')

										@php 
											$bankout = $bankout+$received->amount;
										@endphp 

									@elseif(Str::limit($received->payment_method, 4,'') == 'Bank' && $received->transaction_type == 'Received')

										@php 
											$bankin = $bankin+$received->amount;
										@endphp 

									@endif

									@if($received->transaction_type == 'Pay')

										@php 
											$sumofpay = $sumofpay+$received->amount;
										@endphp 

									@else 

										@php 
											$sumofreceived = $sumofreceived+$received->amount;
										@endphp 

									@endif

								@endforeach
								<div class="footer-sticky">
									<div class="container">
										<div class="row">
											
											<div class="col-md-4">
												<div class="stats-info bcgreen">
													<h6>Total Received</h6>
													
													
													<h4><span>Rs</span> {{ $sumofreceived }} </h4>
													
													
												</div>
											</div>
											<div class="col-md-4">
												<div class="stats-info bcred">
													<h6>Total Pay</h6>
													<h4><span>Rs</span> {{ $sumofpay }}</span></h4>
												</div>
											</div>
													@php 

														$balance = 0;
														$balance = $sumofreceived-$sumofpay;

													@endphp
											<div class="col-md-4">
												
												<div class="stats-info">
													<h6>Total</h6>
													<h4><span><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i class="fa fa-clock-o"></i></a> Rs</span> {{ $balance }}<span>
														@if($balance>=150000)
														<i class="fa fa-arrow-up"></i>
														@else
														<span><i class="fa fa-arrow-down"></i>
														@endif
													</span></h4>
												</div>

											</div>
										</div>
									</div>
								</div>
							</div>
                        </div>
                    </div>
                </div>
				<!-- /Page Content -->
				
				
        	
				</div>
				<!-- /Page Content -->
<!-- Attendance Modal -->
				<div class="modal custom-modal fade" id="attendance_info" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-md" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Report Info</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="row">
									<div class="col-md-12">
										<div class="card punch-status">
											<div class="card-body">
												<h5 class="card-title">Cash <small class="text-muted">Detail</small></h5>
												<div class="statistics">
													<div class="row">
														<div class="col-md-4 col-4 text-center">
															<div class="stats-box">
																<p>CashIn</p>
																<h6><span>Rs </span>{{$cashin}}</h6>
															</div>
														</div>
														<div class="col-md-4 col-4 text-center">
															<div class="stats-box">
																<p>CashOut</p>
																<h6><span>Rs </span>{{$cashout}}</h6>
															</div>
														</div>
														<div class="col-md-4 col-4 text-center">
															<div class="stats-box">
																<p>Total Cash</p>
																<h6><span>Rs </span>{{$cashin - $cashout}}</h6>
															</div>
														</div>
													</div>
												</div>
												<h5 class="card-title"></h5>
												<h5 class="card-title">Bank <small class="text-muted">Detail</small></h5>
												<div class="statistics">
													<div class="row">
														<div class="col-md-4 col-4 text-center">
															<div class="stats-box">
																<p>BankIn</p>
																<h6><span>Rs </span>{{$bankin}}</h6>
															</div>
														</div>
														<div class="col-md-4 col-4 text-center">
															<div class="stats-box">
																<p>BankOut</p>
																<h6><span>Rs </span>{{$bankout}}</h6>
															</div>
														</div>
														<div class="col-md-4 col-4 text-center">
															<div class="stats-box">
																<p>Total Bank</p>
																<h6><span>Rs </span>{{$bankin - $bankout}}</h6>
															</div>
														</div>
													</div>
												</div>
												
													<h5 class="card-title"></h5>
												<h5 class="card-title">Total </h5>
												<div class="statistics">
													<div class="row">
														<div class="col-md-4 col-4 text-center">
															<div class="stats-box">
																<p>Total Received</p>
																<h6><span>Rs </span>{{$cashin + $bankin}}</h6>
															</div>
														</div>
														<div class="col-md-4 col-4 text-center">
															<div class="stats-box">
																<p>Total Pay</p>
																<h6><span>Rs </span>{{$cashout + $bankout}}</h6>
															</div>
														</div>
														<div class="col-md-4 col-4 text-center">
															<div class="stats-box">
																<p>Balance</p>
																<h6><span>Rs </span>{{($cashin + $bankin)-($cashout + $bankout)}}</h6>
															</div>
														</div>
													</div>
												</div>
											
												
											</div>
										</div>
									</div>
									
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Attendance Modal -->
            </div>
			<!-- /Page Wrapper -->
			
        </div>
		<!-- /Main Wrapper -->
		
		@yield('footer_content')
		
    </body>
</html>