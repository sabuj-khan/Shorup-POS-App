<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Create Category</h6>
                </div>
                <div class="modal-body">
                    <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Category Name *</label>
                                <input type="text" class="form-control" id="categoryName">
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button onclick="SaveCategory()" id="save-btn" class="btn btn-sm  btn-success" >Save</button>
                </div>
            </div>
    </div>
</div>


<script>

    async function SaveCategory(){
        let catName = document.getElementById('categoryName'). value;

        if(catName.length == 0){
            errorToast("Category must not be empty");
        }else{
            document.getElementById("modal-close").click();

            showLoader();
            let response = await axios.post('category-create', {"name":catName})
            hideLoader();

            if(response.status == 201 && response.data['status'] == 'success'){
                successToast(response.data['message']);
                document.getElementById("save-form").reset();
                getCategoryList();
            }else{
                errorToast('Request fail to create category');
            }
        }

    }


</script>