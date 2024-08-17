<div class="container-fluid">
    <div class="row">

        <div class="col-md-4 col-lg-4 p-2">
            <div class="shadow-sm h-100 bg-white rounded-3 p-3">
                <div class="row">
                    <div class="col-8">
                        <span class="text-bold text-dark">BILLED TO </span>
                        <p class="text-xs mx-0 my-1">Name:  <span id="CName"></span> </p>
                        <p class="text-xs mx-0 my-1">Email:  <span id="CEmail"></span></p>
                        <p class="text-xs mx-0 my-1">Customer ID:  <span id="CId"></span> </p>
                    </div>
                    <div class="col-4">
                        <img class="w-50" src="{{"assets/images/logo.png"}}">
                        <p class="text-bold mx-0 my-1 text-dark">Invoice  </p>
                        <p class="text-xs mx-0 my-1">Date: {{ date('Y-m-d') }} </p>
                    </div>
                </div>
                <hr class="mx-0 my-2 p-0 bg-secondary"/>
                <div class="row">
                    <div class="col-12">
                        <table class="table w-100" id="invoiceTable">
                            <thead class="w-100">
                            <tr class="text-xs">
                                <td>Name</td>
                                <td>Qty</td>
                                <td>Total</td>
                                <td>Remove</td>
                            </tr>
                            </thead>
                            <tbody  class="w-100" id="invoiceList">

                            </tbody>
                        </table>
                    </div>
                </div>
                <hr class="mx-0 my-2 p-0 bg-secondary"/>
                <div class="row">
                   <div class="col-12">
                       <p class="text-bold text-xs my-1 text-dark"> TOTAL: <i class="bi bi-currency-dollar"></i> <span id="total"></span></p>
                       <p class="text-bold text-xs my-2 text-dark"> PAYABLE: <i class="bi bi-currency-dollar"></i>  <span id="payable"></span></p>
                       <p class="text-bold text-xs my-1 text-dark"> VAT(5%): <i class="bi bi-currency-dollar"></i>  <span id="vat"></span></p>
                       <p class="text-bold text-xs my-1 text-dark"> Discount: <i class="bi bi-currency-dollar"></i>  <span id="discount"></span></p>
                       <span class="text-xxs">Discount(%):</span>
                       <input onkeydown="return false" value="0" min="0" type="number" step="0.25" onchange="DiscountChange()" class="form-control w-40 " id="discountP"/>
                       <p>
                          <button onclick="createInvoice()" class="btn  my-3 bg-gradient-primary w-40">Confirm</button>
                       </p>
                   </div>
                    <div class="col-12 p-2">

                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-4 col-lg-4 p-2">
            <div class="shadow-sm h-100 bg-white rounded-3 p-3">
                <table class="table  w-100" id="productTable">
                    <thead class="w-100">
                    <tr class="text-xs text-bold">
                        <td>Product</td>
                        <td>Pick</td>
                    </tr>
                    </thead>
                    <tbody  class="w-100" id="productList">

                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-4 col-lg-4 p-2">
            <div class="shadow-sm h-100 bg-white rounded-3 p-3">
                <table class="table table-sm w-100" id="customerTable">
                    <thead class="w-100">
                    <tr class="text-xs text-bold">
                        <td>Customer</td>
                        <td>Pick</td>
                    </tr>
                    </thead>
                    <tbody  class="w-100" id="customerList">

                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>


<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Add Product</h6>
            </div>
            <div class="modal-body">
                <form id="add-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label d-none">Product ID *</label>
                                <input type="text" class=" d-none form-control" id="PId">
                                <label class="form-label mt-2">Product Name *</label>
                                <input readonly type="text" class="form-control" id="PName">
                                <label class="form-label mt-2">Product Price *</label>
                                <input readonly type="text" class="form-control" id="PPrice">
                                <label class="form-label mt-2">Product Qty *</label>
                                <input type="number" class="form-control" id="PQty">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="add()" id="save-btn" class="btn bg-gradient-success" >Add</button>
            </div>
        </div>
    </div>
</div>


<script>

    getCustomersList();
    getProductList();

    let invoiceProductList = [];

    async function getCustomersList(){
        showLoader();
        let response = await axios.get('/customers-list');
        hideLoader();

        let customerTable = $("#customerTable")
        let customerList = $("#customerList")

        customerTable.DataTable().destroy();
        customerList.empty();

        response.data['data'].forEach(function(item, index){
            let row = `<tr>
                        <td>${item['name']}</td>
                        <td><a data-name="${item['name']}" data-email="${item['email']}" data-id="${item['id']}" class="btn btn-outline-dark addCustomer  text-xxs px-2 py-1  btn-sm m-0">Add</a></td>
                    </tr>`

                    customerList.append(row);
        });

        new DataTable('#customerTable',{
            order:[[0,'desc']],
            scrollCollapse: false,
            info: false,
            //lengthMenu:[5,10,15,20,30]
            lengthChange: false
        });

        $(".addCustomer").on('click', function(){
            let name = $(this).data('name');
            let email = $(this).data('email');
            let id = $(this).data('id');

            $("#CName").text(name);
            $("#CEmail").text(email);
            $("#CId").text(id);

        });


        let name = $(this).data('name');
            let email = $(this).data('email');
            let id = $(this).data('id');

    }

    async function getProductList(){
        showLoader();
        let response = await axios.get('/product-list');
        hideLoader();

        let productTable = $("#productTable")
        let productList  = $("#productList")

        productTable.DataTable().destroy();
        productList.empty();

        response.data['data'].forEach(function(item, index){
            let row = `<tr class="text-xs">
                        <td> <img class="w-10" src="${item['img']}"/> ${item['name']} ($ ${item['price']})</td>
                        <td><a data-name="${item['name']}" data-price="${item['price']}" data-id="${item['id']}" class="btn btn-outline-dark text-xxs px-2 py-1 addProduct  btn-sm m-0">Add</a></td>
                     </tr>`
                     productList.append(row);
        });

        $(".addProduct").on('click', function(){
            let pID = $(this).data('id');
            let pPrice = $(this).data('price');
            let pName = $(this).data('name');

            $("#PId").val(pID);
            $("#PName").val(pName);
            $("#PPrice").val(pPrice);

            $('#create-modal').modal('show')
        });


        new DataTable('#productTable',{
            order:[[0,'desc']],
            scrollCollapse: false,
            info: false,
            //lengthMenu:[5,10,15,20,30]
            lengthChange: false
        });


        


    }

    function add(){
        let ProdId    = document.getElementById('PId').value;
        let ProdName  = document.getElementById('PName').value;
        let ProdPrice = document.getElementById('PPrice').value;
        let ProdQty   = document.getElementById('PQty').value;

        let ProdTotalPrice = (parseFloat(ProdPrice)*parseFloat(ProdQty)).toFixed(2);

        if(ProdName.length == 0){
            errorToast('Product name is required');
        }else if(ProdPrice.length == 0){
            errorToast('Product price is required');
        }else if(ProdQty.length == 0){
            errorToast('Product quantity is required');
        }else{
            let item = {product_name:ProdName, product_id:ProdId, qty:ProdQty, sale_price:ProdTotalPrice}
            invoiceProductList.push(item);
            $('#create-modal').modal('hide');

            showInvoiceList();
        }

    }



    function showInvoiceList(){
            let invoiceList = $("#invoiceList");

            invoiceList.empty();

            invoiceProductList.forEach(function(item, index){
                let row = `<tr class="text-xs">
                                <td>${item['product_name']}</td>
                                <td>${item['qty']}</td>
                                <td>${item['sale_price']}</td>
                                <td><a data-index="${index}" class="btn remove text-xxs px-2 py-1  btn-sm m-0">Remove</a></td>
                            </tr>`

                        invoiceList.append(row);
            })

             grandTotalCalculate();

            $(".remove").on('click', async function(){
                let index = $(this).data('index');
                removeItem(index);
            })


        }



    function removeItem(index){
        invoiceProductList.splice(index,1);
        showInvoiceList();

    }


    function grandTotalCalculate(){
        let total = 0;
        let payable = 0;
        let vat = 0;
        let discount = 0;

        let discountPercentage = parseFloat(document.getElementById('discountP').value);

        invoiceProductList.forEach(function(item, index){
             total = total + parseFloat(item['sale_price'])
        })

        if(discountPercentage == 0){
             vat = ((total*5)/100).toFixed(2);
        }else{
            discount = (total*discountPercentage)/100;
            total    = (total - (total*discountPercentage)/100).toFixed(2);
            vat      = ((total*5)/100).toFixed(2);
        }

        payable = (parseFloat(total)+parseFloat(vat)).toFixed(2);

        document.getElementById('total').innerText = total;
        document.getElementById('payable').innerText = payable;
        document.getElementById('vat').innerText = vat;
        document.getElementById('discount').innerText = discount;
    }

    function DiscountChange() {
        grandTotalCalculate();
    }


    async function createInvoice(){
        let total    = document.getElementById('total').innerText;
        let payable  = document.getElementById('payable').innerText;
        let vat      = document.getElementById('vat').innerText;
        let discount = document.getElementById('discount').innerText;
        let custId   = document.getElementById('CId').innerText;

        let data = {
            "total":total,
            "discount":discount,
            "vat":vat,
            "payable":payable,
            "customer_id":custId,
            "products":invoiceProductList
        }

        if(custId.length == 0){
            errorToast('Customer is required');
        }else if(invoiceProductList.length == 0){
            errorToast('Products are required')
        }else{
            showLoader();
            let response = await axios.post('/invoice-create', data);
            hideLoader();

            if(response.status == 201 && response.data['status'] == 'success'){
                successToast(response.data['message']);
                setTimeout(function (){
                    window.location.href='/invoicePage'
                },500)
            }else{
                errorToast('Something went wrong');
            }



        }

    }

</script>