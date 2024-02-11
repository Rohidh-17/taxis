@extends('layouts.shared')
@section('shared')
<div class="page-wrapper">
    <div class="page-content">
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
           <div class="col">
             <div class="card radius-10 border-start border-0 border-4 border-info">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Total Successful Rides</p>
                            <h4 class="my-1 text-info">{{$countSuccessful}}</h4>
                            <p class="mb-0 font-13"></p>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i class='bx bxs-cart'></i>
                        </div>
                    </div>
                </div>
             </div>
           </div>
           <div class="col">
            <div class="card radius-10 border-start border-0 border-4 border-danger">
               <div class="card-body">
                   <div class="d-flex align-items-center">
                       <div>
                           <p class="mb-0 text-secondary">Pending Rides</p>
                           <h4 class="my-1 text-danger">{{$pending}}</h4>
                           <p class="mb-0 font-13"></p>
                       </div>
                       <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto"><i class='bx bxs-wallet'></i>
                       </div>
                   </div>
               </div>
            </div>
          </div>
          <div class="col">
            <div class="card radius-10 border-start border-0 border-4 border-success">
               <div class="card-body">
                   <div class="d-flex align-items-center">
                       <div>
                           <p class="mb-0 text-secondary">Total Amount Paid</p>
                           <h4 class="my-1 text-success">{{$amount}}</h4>
                           <p class="mb-0 font-13"></p>
                       </div>
                       <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class='bx bxs-bar-chart-alt-2' ></i>
                       </div>
                   </div>
               </div>
            </div>
          </div>
          <div class="col">
            <div class="card radius-10 border-start border-0 border-4 border-warning">
               <div class="card-body">
                   <div class="d-flex align-items-center">
                       <div>
                           <p class="mb-0 text-secondary">Customer Rating to Driver</p>
                           <h4 class="my-1 text-warning">4.5 Stars</h4>
                           <p class="mb-0 font-13"></p>
                       </div>
                       <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto"><i class='bx bxs-group'></i>
                       </div>
                   </div>
               </div>
            </div>
          </div> 
        </div><!--end row-->

        <div class="card radius-10">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0">Today Rides</h6>
                    </div>
                    <div class="dropdown ms-auto">
                        <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                        </a>
                    </div>
                </div>
            </div>
                 <div class="card-body">
                 <div class="table-responsive">
                   <table class="table align-middle mb-0">
                    <thead class="table-light">
                     <tr>
                       <th>Product</th>
                       <th>Photo</th>
                       <th>Product ID</th>
                       <th>Status</th>
                       
                     </tr>
                     </thead>
                     <tbody>
                        @foreach($ridenow as $key => $ridesnow)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$ridesnow->pickup}}</td>
                      <td>{{$ridesnow->destination}}</td>
                      <td>
                            @if($ridesnow->status == 'pending')
                                <div class="badge rounded-pill text-warning bg-light-warning p-2 text-uppercase px-3">
                                    <i class='bx bxs-circle me-1'></i>{{$ridesnow->status}}
                                </div>
                            @else
                                <div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3">
                                    <i class='bx bxs-circle me-1'></i>{{$ridesnow->status}}
                                </div>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                  </div>
                 </div>
            </div>
@endsection