<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card animated fadeIn w-100 p-3">
                <div class="card-body">
                    <h4>My Profile</h4>
                    <hr/>
                    <div class="container-fluid m-0 p-0">
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <label>Email Address</label>
                                <input readonly id="email" placeholder="User Email" class="form-control" type="email" value=""/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>First Name</label>
                                <input id="firstName" placeholder="First Name" class="form-control" type="text"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Last Name</label>
                                <input id="lastName" placeholder="Last Name" class="form-control" type="text"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Mobile Number</label>
                                <input id="phone" placeholder="Mobile" class="form-control" type="mobile"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Password</label>
                                <input id="password" placeholder="User Password" class="form-control" type="password"/>
                            </div>
                        </div>
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <button onclick="onUpdate()" class="btn mt-3 w-100  btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

    getProfileInfo();

    async function getProfileInfo(){
        showLoader();
        let response = await axios.get('/user-profile')
        hideLoader();

        document.getElementById('email').value = response.data['data']['email'];
        document.getElementById('firstName').value = response.data['data']['first_name'];
        document.getElementById('lastName').value = response.data['data']['last_name'];
        document.getElementById('phone').value = response.data['data']['mobile'];
        document.getElementById('password').value = response.data['data']['password'];

    }



    async function onUpdate(){
        let email = document.getElementById('email').value;
        let firstName = document.getElementById('firstName').value;
        let lastName = document.getElementById('lastName').value;
        let phone = document.getElementById('phone').value;
        let password = document.getElementById('password').value;

        if(firstName.length == 0){
            errorToast("First name is required");
        }else if(lastName.length == 0){
            errorToast("Last name is required");
        }else if(phone.length == 0){
            errorToast("Phone number is required");
        }else if(password.length == 0){
            errorToast("Password must not vbe empty");
        }else{
            let formData = {
                "first_name":firstName,
                "last_name":lastName,
                "mobile":phone,
                "password":password,
            }

            showLoader()
            let response = await axios.post('/user-profile-update', formData);
            hideLoader()

            if(response.status == 201 && response.data['status']){
                successToast(response.data['message']);
                await getProfileInfo();
            }else{
                errorToast (response.data['message']);
            }

        }
    }


</script>