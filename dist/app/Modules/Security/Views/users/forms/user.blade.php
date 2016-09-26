<div class="row">
    <div class="col s12 m12 l12">
        <div class="card-panel">
            <div class="row">
                <form class="col s12" id="form">
                    <div class="row">
                        <h5>Account Login</h5>
                    </div>
                    <div class="row">
                        <div class="input-field col s4">
                            <select id="role" name="role">
                                <option value="" disabled selected>Choose Role</option>
                                <option value="1">Manager</option>
                                <option value="2">Developer</option>
                                <option value="3">Business</option>
                            </select>
                            <label for="role">Role</label>
                        </div>
                        <div class="input-field col s4">
                            <input id="user_id" name="user_id" type="text" data-ng-model="user_id">
                            <label for="user_id">User ID</label>
                        </div>
                        <div class="input-field col s4">
                            <input id="email" name="email" type="email" data-ng-model="email">
                            <label for="email">Email</label>
                        </div>
                    </div>
                    <div class="row" data-ng-if="status == add">
                        <div class="input-field col s6">
                            <input id="password" name="password" type="password">
                            <label for="password">Password</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="cpassword" name="cpassword" type="password">
                            <label for="cpassword">Retype Password</label>
                        </div>
                    </div>
                    <div class="row">
                        <h5>Account Information</h5>
                    </div>
                    <div class="row">
                        <div class="input-field col s4">
                            <input id="first_name" name="first_name" type="text" data-ng-model="first_name">
                            <label for="first_name">First Name</label>
                        </div>
            
                        <div class="input-field col s4">
                            <input id="last_name" name="last_name" type="text" data-ng-model="last_name">
                            <label for="last_name">Last Name</label>
                        </div>

                        <div class="input-field col s4">
                            <input id="middle_name" name="middle_name" type="text" data-ng-model="middle_name">
                            <label for="middle_name">Middile Name</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s3">
                            <select name="sex" id="sex">
                                <option value="" disabled selected>Choose Sex</option>
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                            </select>
                            <label>Select Sex</label>
                        </div>
                        
                        <div class="input-field col s3">
                            <input id="mobile_no" name="mobile_no" type="text" data-ng-model="mobile_no">
                            <label for="mobile_no">Mobile No.</label>
                        </div>

                        <div class="input-field col s3">
                            <input id="tel_no" name="tel_no" type="text" data-ng-model="tel_no">
                            <label for="tel_no">Telephone No.</label>
                        </div>

                        <div class="input-field col s3">
                            <input id="office_no" name="office_no" type="text" data-ng-model="office_no">
                            <label for="office_no">Office No.</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s4">
                            <select name="position" id="position">
                              <option value="" disabled selected>Choose Position</option>
                              <option value="1">Manager</option>
                              <option value="2">Developer</option>
                              <option value="3">Business</option>
                            </select>
                            <label>Select Position</label>
                        </div>   
                        <div class="input-field col s4">
                            <select name="department" id="department">
                              <option value="" disabled selected>Choose Department</option>
                              <option value="1">Manager</option>
                              <option value="2">Developer</option>
                              <option value="3">Business</option>
                            </select>
                            <label>Select Department</label>
                        </div>                      
                        <div class="input-field col s4">
                            <select name="level" id="level">
                              <option value="" disabled selected>Choose Level</option>
                              <option value="1">Manager</option>
                              <option value="2">Developer</option>
                              <option value="3">Business</option>
                            </select>
                            <label>Select Level</label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>