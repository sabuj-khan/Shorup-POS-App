<div class="container-fluid">
    <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="card px-5 py-5">
            <div class="row justify-content-between ">
                <div class="align-items-center col">
                    <h4>Product</h4>
                </div>
                <div class="align-items-center col">
                    <button data-bs-toggle="modal" data-bs-target="#create-modal" class="float-end btn m-0 btn-sm bg-gradient-primary">Create</button>
                </div>
            </div>
            <hr class="bg-dark "/>
            <table class="table" id="tableData">
                <thead>
                <tr class="bg-light">
                    <th>No</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Unit</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="tableList">

                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

<script>

    getProductList();

    async function getProductList(){
        let tableData = $("#tableData");
        let tableList = $("#tableList");

        tableData.DataTable().destroy();
        tableList.empty();

        showLoader();
        let response = await axios.get('/product-list');
        hideLoader();

        response.data['data'].forEach(function(item, index){
            let row = `<tr>
                            <td>${index+1}</td>
                            <td><img class="w-35 h-auto" alt="" src="${item['img']}"></td>
                            <td>${item['name']}</td>
                            <td>${item['price']}</td>
                            <td>${item['unit']}</td>
                            <td>
                                <button data-path="${item['img']}" data-id="${item['id']}" class="btn editBtn btn-sm btn-success">Edit</button>
                                <button data-path="${item['img']}" data-id="${item['id']}" class="btn deleteBtn btn-sm btn-danger">Delete</button>
                            </td>
                       </tr>`;

                       tableList.append(row);
        });


        $(".editBtn").on('click', async function(){
            let id = $(this).data('id');
            let path = $(this).data('path');
            $("#updateID").val(id);
            $("#filePath").val(path);
            await fillupUpdatedForm(id, path);
            $("#update-modal").modal('show');

            
        });

        $(".deleteBtn").on('click', async function(){
            let id = $(this).data('id');
            let path = $(this).data('path');
            $("#deleteID").val(id);
            $("#deleteFilePath").val(path);
            $("#delete-modal").modal('show');

            
        });



        new DataTable('#tableData',{
            order:[[0,'desc']],
            lengthMenu:[5,10,15,20,30]
        });




    }





</script>