<label style="font-weight: bold;">Children Information</label>
<br />


@for ($i = 0; $i < $number_of_childrens; $i++)
    <hr style="font-weight:bold;">
    <label style="font-weight:bold;">Child # {{ $i + 1 }}</label>
    <div class="row">
        <div class="col-md-3">
            <label for="">First Name</label>
            <input type="text" name="child_first_name[]" placeholder="First Name" class="form-control rounded-0"
                required>
        </div>
        <div class="col-md-3">
            <label for="">Middle Name</label>
            <input type="text" name="child_middle_name[]" placeholder="Middle Name" class="form-control rounded-0"
                required>
        </div>
        <div class="col-md-3">
            <label for="">Last Name</label>
            <input type="text" name="child_last_name[]" placeholder="Last Name" class="form-control rounded-0"
                required>
        </div>

        <div class="col-md-3">
            <label for="">Nick Name</label>
            <input type="text" placeholder="Nickname" id="child_nickname" name="child_nickname[]"
                class="form-control rounded-0" required>
        </div>
        <div class="col-md-4">
            <label>Date of birth</label>
            <input type="date" name="child_dob[]" class="form-control rounded-0" required>
        </div>
        <div class="col-md-4">
            <label>Place of birth</label>
            <input type="text" id="child_place_of_birth" name="child_place_of_birth[]" class="form-control rounded-0"
                required>
        </div>
        <div class="col-md-4">
            <label>Sex</label>
            <select name="child_sex[]" class="form-control rounded-0" required>
                <option value="" default>Select</option>
                <option value="Male" selected>Male</option>
                <option value="Female" selected>Female</option>
            </select>
        </div>
        <div class="col-md-4">
            <label>Nationality</label>
            <input type="text" name="child_nationality[]" class="form-control rounded-0" required>
        </div>
        <div class="col-md-4">
            <label>Civil Status</label>
            <select name="child_civil_status[]" class="form-control rounded-0" required>
                <option value="" default>Select</option>
                <option value="Single">Single</option>
                <option value="Married">Married</option>
                <option value="Widowed">Widowed</option>
                <option value="Divorced">Divorced</option>
                <option value="Separated">Separated</option>
            </select>
        </div>

        <div class="col-md-4">
            <label>PWD</label>
            <select name="child_pwd[]" id="child_pwd" class="form-control rounded-0" required>
                <option value="" default>Select</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </div>

        <div class="col-md-12">
            <label>PWD Description</label>
            <textarea name="child_pwd_description[]" id="child_pwd_description" class="form-control rounded-0" required></textarea>
        </div>

    </div>
@endfor
