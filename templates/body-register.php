<div class="jumbotron slim">
  <div class="container">
    <h2>New User Registration</h2>
  </div>
</div>

<div class="container">
  <form class="form-horizontal" id="registration-form">
  <fieldset>

  <!-- Form Name -->
  <legend>Please enter your information below to register a new MusicNet user account.</legend>

  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="user_id">User ID</label>
    <div class="col-md-3">
    <input id="user_id" name="user_id" type="text" placeholder="john_doe" class="form-control input-md" required="">

    </div>
  </div>

  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="username">Name</label>
    <div class="col-md-3">
    <input id="username" name="username" type="text" placeholder="John Doe" class="form-control input-md" required="">

    </div>
  </div>

  <!-- Password input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="password">Password</label>
    <div class="col-md-3">
      <input id="password" name="password" type="password" placeholder="" class="form-control input-md" required="">

    </div>
  </div>

  <!-- Password input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="password_confirm">Confirm Password</label>
    <div class="col-md-3">
      <input id="password_confirm" name="password_confirm" type="password" placeholder="" class="form-control input-md" required="">

    </div>
  </div>

  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="age">Age</label>
    <div class="col-md-1">
    <input id="age" name="age" type="text" placeholder="" class="form-control input-md">

    </div>
  </div>

  <!-- Select Basic -->
  <div class="form-group">
    <label class="col-md-4 control-label" for="gender">Gender</label>
    <div class="col-md-2">
      <select id="gender" name="gender" class="form-control">
        <option value="Male">Male</option>
        <option value="Female">Female</option>
      </select>
    </div>
  </div>

  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="location">Location</label>
    <div class="col-md-3">
    <input id="location" name="location" type="text" placeholder="" class="form-control input-md">

    </div>
  </div>

  <!-- Button (Double) -->
  <div class="form-group">
    <label class="col-md-4 control-label" for="submit"></label>
    <div class="col-md-8">
      <button id="register-submit" name="submit" class="btn btn-success">Complete Registration</button>
      <button id="register-cancel" name="cancel" class="btn btn-danger">Cancel</button>
    </div>
  </div>

  </fieldset>
  </form>

</div> <!-- /container -->
