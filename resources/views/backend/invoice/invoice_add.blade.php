
@extends('admin.admin_master')
@section('admin')
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
<div class="container-fluid">

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body"> 

            @role('admin')
            <h4 class="card-title">Add Sales  </h4><br><br>
            @endrole
             

    <div class="row">

         <div class="col-md-1">
            <div class="md-3">
                <label for="example-text-input" class="form-label">Inv No</label>
                 <input class="form-control example-date-input" name="invoice_no" type="text" value="{{ $invoice_no }}"  id="invoice_no" readonly style="background-color:#ddd" >
            </div>
        </div>


        <div class="col-md-2">
            <div class="md-3">
                <label for="example-text-input" class="form-label">Date</label>
                 <input class="form-control example-date-input" value="{{ $date }}" name="date" type="date"  id="date">
            </div>
        </div>

        <div class="col-md-3">
            <div class="md-3">
                <label for="example-text-input" class="form-label">Product Name </label>
                <select name="product_id" id="product_id" class="form-select select2" aria-label="Default select example">
                    <option selected="">Open this select menu</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" data-category-id="{{ $product->category_id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="md-3">
                <label for="example-text-input" class="form-label">Category Name</label>
                <input type="text" id="category_name" class="form-control" readonly >
                <input type="hidden" name="category_id" id="category_id">
            </div>
        </div>


           <div class="col-md-1">
            <div class="md-3">
                <label for="example-text-input" class="form-label">Stock</label>
                 <input class="form-control example-date-input" name="current_stock_qty" type="text"  id="current_stock_qty" readonly style="background-color:#ddd" >
            </div>
        </div>


<div class="col-md-2">
    <div class="md-3">
        <label for="example-text-input" class="form-label" style="margin-top:43px;">  </label>
        

        <i class="btn btn-secondary btn-rounded waves-effect waves-light fas fa-plus-circle addeventmore"> Add More</i>
    </div>
</div>





    </div> <!-- // end row  --> 
           
        </div> <!-- End card-body -->
<!--  ---------------------------------- -->

        <div class="card-body">
        <form method="post" action="{{ route('invoice.store') }}">
            @csrf
            <table class="table-sm table-bordered" width="100%" style="border-color: #ddd;">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Product Name </th>
                        <th width="7%">Quantity</th>
                        <th width="10%">Unit Price </th> 
                        <th width="15%">Total Price</th>
                        <th width="7%">Action</th> 

                    </tr>
                </thead>

                <tbody id="addRow" class="addRow">
                    
                </tbody>

                <tbody>
        <tr>
            <td colspan="4"> Discount</td>
            <td>
            <input type="text" name="discount_amount" id="discount_amount" class="form-control estimated_amount" placeholder="Discount Amount"  >
            </td>
        </tr>


                    <tr>
                        <td colspan="4"> Grand Total</td>
                        <td>
                            <input type="text" name="estimated_amount" value="0" id="estimated_amount" class="form-control estimated_amount" readonly style="background-color: #ddd;" >
                        </td>
                        <td></td>
                    </tr>

                </tbody>                
            </table><br>


            <div class="form-row">
                <div class="form-group col-md-12">
                    <textarea name="description" class="form-control" id="description" placeholder="Write Description Here"></textarea>
                </div>
            </div><br>

            <div class="row">
                <div class="form-group col-md-3">
                    <label> Paid Status </label>
                    <select name="paid_status" id="paid_status" class="form-select">
                        <option value="">Select Status </option>
                        <option value="full_paid">Full Paid </option>
                        <option value="full_due">Full Due </option>
                         <option value="partial_paid">Partial Paid </option>
                        
                    </select>
        <input type="text" name="paid_amount" class="form-control paid_amount" placeholder="Enter Paid Amount" style="display:none;">
                </div>


            <div class="form-group col-md-9">
                <label> Customer Name  </label>
                    <select name="customer_id" id="customer_id" class="form-select">
                        <option value="">Select Customer </option>
                        @foreach($costomer as $cust)
                        <option value="{{ $cust->id }}">{{ $cust->name }} - {{ $cust->mobile_no }}</option>
                        @endforeach
                         <option value="0">New Customer </option>
                    </select>
            </div> 
            </div> <!-- // end row --> <br>

        <!-- Due Date, hidden by default -->
        <div class="form-group col-md-3" id="due_date_container" style="display:none;">
            <label>Due Date (Tanggal Jatuh Tempo)</label>
            <input type="date" name="due_date" id="due_date" class="form-control" value="{{ date('Y-m-d') }}">
        </div>

<!-- Hide Add Customer Form -->
<div class="row new_customer" style="display:none">
    <div class="form-group col-md-4">
        <input type="text" name="name" id="name" class="form-control" placeholder="Write Customer Name">
    </div>

    <div class="form-group col-md-4">
        <input type="text" name="mobile_no" id="mobile_no" class="form-control" placeholder="Write Customer Mobile No">
    </div>

    <div class="form-group col-md-4">
        <input type="email" name="email" id="email" class="form-control" placeholder="Write Customer Email">
    </div>
</div>
<!-- End Hide Add Customer Form -->

 <br>
            <div class="form-group">
                <button type="submit" class="btn btn-info" id="storeButton"> Submit</button>
                
            </div>
            
        </form>






        </div> <!-- End card-body -->


 




    </div>
</div> <!-- end col -->
</div>
 


</div>
</div>

 

<script id="document-template" type="text/x-handlebars-template">
     
<tr class="delete_add_more_item" id="delete_add_more_item">
        <input type="hidden" name="date" value="@{{date}}">
        <input type="hidden" name="invoice_no" value="@{{invoice_no}}">
        
   
    <td>
        <input type="hidden" name="category_id[]" value="@{{category_id}}">
        @{{ category_name }}
    </td>

     <td>
        <input type="hidden" name="product_id[]" value="@{{product_id}}">
        @{{ product_name }}
    </td>

    <td>
        <input type="number" min="1" class="form-control selling_qty text-right" name="selling_qty[]" value="" max="@{{stock}}">
        <small class="text-danger qty-error" style="display:none;"></small>
    </td>


    <td>
        <input type="number" class="form-control unit_price text-right" name="unit_price[]" value="@{{unit_price}}" readonly>

    </td>

  

     <td>
        <input type="number" class="form-control selling_price text-right" name="selling_price[]" value="0" readonly> 
    </td>

     <td>
        <i class="btn btn-danger btn-sm fas fa-window-close removeeventmore"></i>
    </td>

    </tr>

</script>


<script type="text/javascript">
    $(document).on("click",".addeventmore", function(){
    var date = $('#date').val();
    var invoice_no = $('#invoice_no').val(); 
    var category_id  = $('#category_id').val();
    var category_name = $('#category_name').val();
    var product_id = $('#product_id').val();
    var product_name = $('#product_id').find('option:selected').text();

    if(date == ''){
        $.notify("Date is Required" ,  {globalPosition: 'top right', className:'error' });
        return false;
    }
    if(category_id == ''){
        $.notify("Category is Required" ,  {globalPosition: 'top right', className:'error' });
        return false;
    }
    if(product_id == ''){
        $.notify("Product Field is Required" ,  {globalPosition: 'top right', className:'error' });
        return false;
    }

    // Ambil harga produk dari database lewat AJAX
    $.ajax({
        url: "{{ route('get-product-harga') }}",
        type: "GET",
        data: { product_id: product_id },
        success: function(harga){
            // Setelah dapat harga, tambahkan row baru dengan harga otomatis
            var stock = $('#current_stock_qty').val();
            var source = $("#document-template").html();
            var template = Handlebars.compile(source);
            var data = {
                date: date,
                invoice_no: invoice_no, 
                category_id: category_id,
                category_name: category_name,
                product_id: product_id,
                product_name: product_name,
                unit_price: harga, 
                stock: stock 
                
            };
            var html = template(data);
            $("#addRow").append(html); 
        }
    });



        $(document).on("click",".removeeventmore",function(event){
            $(this).closest(".delete_add_more_item").remove();
            totalAmountPrice();
        });

        $(document).on('keyup click','.unit_price,.selling_qty', function(){
            var unit_price = $(this).closest("tr").find("input.unit_price").val();
            var qty = $(this).closest("tr").find("input.selling_qty").val();
            var total = unit_price * qty;
            $(this).closest("tr").find("input.selling_price").val(total);
            $('#discount_amount').trigger('keyup');
        });

        $(document).on('keyup change', '.selling_qty', function() {
            var $row = $(this).closest('tr');
            var qty = parseInt($(this).val()) || 0;
            var maxStock = parseInt($(this).attr('max')) || 0;
            var $errorMsg = $row.find('.qty-error');

            if (qty > maxStock) {
                $errorMsg.text('Melebihi Stok saat ini (' + maxStock + ')!').show();
                $(this).addClass('is-invalid');
            } else if (qty < 1) {
                $errorMsg.text('Minimal quantity 1!').show();
                $(this).addClass('is-invalid');
            } else {
                $errorMsg.hide().text('');
                $(this).removeClass('is-invalid');
            }
        });



        $(document).on('keyup','#discount_amount',function(){
            totalAmountPrice();
        });

        // Calculate sum of amout in invoice 

        function totalAmountPrice(){
            var sum = 0;
            $(".selling_price").each(function(){
                var value = $(this).val();
                if(!isNaN(value) && value.length != 0){
                    sum += parseFloat(value);
                }
            });

            var discount_amount = parseFloat($('#discount_amount').val());
            if(!isNaN(discount_amount) && discount_amount.length != 0){
                    sum -= parseFloat(discount_amount);
                }

            $('#estimated_amount').val(sum);
        }  

    });


</script>
 

<script type="text/javascript">
    $(function(){
        $(document).on('change','#category_id',function(){
            var category_id = $(this).val();
            $.ajax({
                url:"{{ route('get-product') }}",
                type: "GET",
                data:{category_id:category_id},
                success:function(data){
                    var html = '<option value="">Select Category</option>';
                    $.each(data,function(key,v){
                        html += '<option value=" '+v.id+' "> '+v.name+'</option>';
                    });
                    $('#product_id').html(html);
                }
            })
        });
    });

</script>
 
 <script type="text/javascript">
    $(function(){
        $(document).on('change','#product_id',function(){
            var product_id = $(this).val();
            $.ajax({
                url:"{{ route('check-product-stock') }}",
                type: "GET",
                data:{product_id:product_id},
                success:function(data){                   
                    $('#current_stock_qty').val(data);
                    
                }
            });
        });
    });

</script>


<script type="text/javascript">
    $(document).ready(function(){
        $('#paid_status').on('change', function(){
            let status = $(this).val();
            if (status === 'full_due' || status === 'partial_paid') {
                $('#due_date_container').show();
            } else {
                $('#due_date_container').hide();
                $('#due_date').val('');
            }

            // Paid amount show/hide (existing logic)
            if (status === 'partial_paid') {
                $('.paid_amount').show();
            } else {
                $('.paid_amount').hide();
            }
        });
    });


</script>

<script>
    // Ambil mapping kategori dari backend
    var categories = @json($category->pluck('name', 'id'));

    $(document).ready(function() {
        // Pastikan select2 sudah aktif
        $('#product_id').select2();

        // Event ganti produk (event paling aman)
        $('#product_id').on('change', function() {
            var productId = $(this).val();
            var option = $('#product_id option[value="' + productId + '"]');
            var categoryId = option.data('category-id');
            // Debug log biar yakin
            console.log('ProductId:', productId, 'CategoryId:', categoryId, 'Categories:', categories);
            if (categoryId) {
                $('#category_id').val(categoryId);
                $('#category_name').val(categories[categoryId]);
            } else {
                $('#category_id').val('');
                $('#category_name').val('');
            }
        });

        // Optional: saat reload langsung trigger (misal edit form)
        $('#product_id').trigger('change');
    });
</script>

<script>
$(document).ready(function(){

    function checkStockBeforeAddMore() {
        var stock = parseInt($('#current_stock_qty').val());
        if (isNaN(stock)) stock = 0;

        if(stock <= 0){
            $('.addeventmore')
                .addClass('disabled btn-secondary')
                .removeClass('btn-primary')
                .css('pointer-events','none');
        } else {
            $('.addeventmore')
                .removeClass('disabled btn-secondary')
                .addClass('btn-primary')
                .css('pointer-events','auto');
        }
    }

    // Saat halaman di-load
    checkStockBeforeAddMore();

    // Saat produk diubah
    $('#product_id').on('change', function(){
        var product_id = $(this).val();
        $.ajax({
            url:"{{ route('check-product-stock') }}",
            type: "GET",
            data:{product_id:product_id},
            success:function(data){
                $('#current_stock_qty').val(data);
                checkStockBeforeAddMore(); // <--- PENTING! Panggil di sini!
            }
        });
    });

    // Kalau ada input manual (jarang terjadi)
    $('#current_stock_qty').on('input change', function(){
        checkStockBeforeAddMore();
    });

    $(document).on('click', '.addeventmore.disabled', function(e){
        e.preventDefault();
        alert('Stok produk ini sudah habis! Tidak bisa ditambahkan ke invoice.');
    });

});

</script>

<script>
$('#storeButton').on('click', function(e) {
    var isValid = true;
    $('.selling_qty').each(function(){
        var qty = parseInt($(this).val()) || 0;
        var maxStock = parseInt($(this).attr('max')) || 0;
        if (qty > maxStock || qty < 1) {
            isValid = false;
            // Trigger error inline jika belum tampil
            $(this).trigger('change');
        }
    });
    if (!isValid) {
        e.preventDefault();
        
        toastr.error('Tidak dapat memproses karena jumlah melebihi batas stok. Mohon periksa kembali');
    }
});



</script>

<script>
$(document).ready(function(){
    $('#customer_id').on('change', function(){
        var customer_id = $(this).val();
        if (customer_id == '0') {
            $('.new_customer').show();
        } else {
            $('.new_customer').hide();
        }
    });

    // Optional: trigger saat reload untuk keadaan edit
    $('#customer_id').trigger('change');
});
</script>


@endsection


