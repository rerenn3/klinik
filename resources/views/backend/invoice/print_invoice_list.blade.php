@extends('admin.admin_master')
@section('admin')


<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Print Sales All</h4>



                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        @role('admin')
                        <a href="{{ route('invoice.add') }}" class="btn btn-dark btn-rounded waves-effect waves-light"
                            style="float:right;"><i class="fas fa-plus-circle"> Add Sales </i></a> <br> <br>
                        @endrole

                        <h4 class="card-title">Sales All Data </h4>


                        <table id="datatable" class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Customer Name</th>
                                    <th>Invoice No </th>
                                    <th>Date </th>
                                    <th>Desctipion</th>
                                    <th>Amount</th>
                                    <th>Due Date</th> 
                                    <th>Action</th>

                            </thead>


                            <tbody>
                            @foreach($allData as $key => $item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item['payment']['customer']['name'] ?? '-' }}</td>
                                <td>#{{ $item->invoice_no }}</td>
                                <td>{{ date('d-m-Y', strtotime($item->date)) }}</td>
                                <td>{{ $item->description }}</td>
                                <td>Rp {{ $item['payment']['total_amount'] }}</td>
                                <td>
                                    {{-- Tampilkan Due Date jika ada --}}
                                    {{ $item['payment']['due_date'] ?? '-' }}
                                    {{-- Jika overdue (opsional) --}}
                                    @if(!empty($item['payment']['due_date']) && \Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($item['payment']['due_date'])))
                                        <span class="badge bg-danger">Overdue!</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('print.invoice', $item->id) }}" class="btn btn-danger sm"
                                        title="Print Invoice"> <i class="fa fa-print"></i> </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->



    </div> <!-- container-fluid -->
</div>


@endsection
