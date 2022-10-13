<h2><span style="color:black;">Personal Information</span></h2>

@for ($i = 0; $i < $number_of_childrens; $i++)
    <label style="font-weight:bold;"># {{ $i + 1 }}</label>

    <div class="row">
        <div class="col-md-3">
            {{-- <img id="img_{{ $i }}" src="{{ asset('carmen_images/default_image.jpg') }}" class="img img-thumbnail"
                alt="your image" /> --}}

            <div id="img_{{ $i }}"></div>
           
            <input accept="image/*" name="resident_image[]" class="form-control" type='file' set-to="img_{{ $i }}" />
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <label for="">Position</label>
            <select name="position[]" class="form-control rounded-0" required>
                <option value="" default>Set</option>
                <option value="Father">Father</option>
                <option value="Mother">Mother</option>
                <option value="Member">Member</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="">First Name</label>
            <input type="text" name="first_name[]" placeholder="First Name" class="form-control rounded-0" required>
        </div>
        <div class="col-md-3">
            <label for="">Middle Name</label>
            <input type="text" name="middle_name[]" placeholder="Middle Name" class="form-control rounded-0"
                required>
        </div>
        <div class="col-md-3">
            <label for="">Last Name</label>
            <input type="text" name="last_name[]" placeholder="Last Name" class="form-control rounded-0" required>
        </div>

        <div class="col-md-3">
            <label for="">Nick Name</label>
            <input type="text" placeholder="Nickname" id="nickname" name="nickname[]" class="form-control rounded-0"
                required>
        </div>
        <div class="col-md-4">
            <label>Date of birth</label>
            <input type="date" name="dob[]" class="form-control rounded-0" required>
        </div>
        <div class="col-md-4">
            <label>Place of birth</label>
            <input type="text" id="place_of_birth" name="place_of_birth[]" class="form-control rounded-0" required>
        </div>
        <div class="col-md-4">
            <label>Sex</label>
            <select name="sex[]" class="form-control rounded-0" required>
                <option value="" default>Select</option>
                <option value="Male" selected>Male</option>
                <option value="Female" selected>Female</option>
            </select>
        </div>
        <div class="col-md-4">
            <label>Nationality</label>
            <input type="text" name="nationality[]" class="form-control rounded-0" required>
        </div>
        <div class="col-md-4">
            <label>Civil Status</label>
            <select name="civil_status[]" class="form-control rounded-0" required>
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
            <select name="pwd[]" id="pwd" class="form-control rounded-0" required>
                <option value="" default>Select</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </div>

        <div class="col-md-12">
            <label>PWD Description</label>
            <textarea name="pwd_description[]" id="pwd_description" class="form-control rounded-0" required></textarea>
        </div>

    </div>
@endfor
