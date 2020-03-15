<!DOCTYPE html>
<html>
<head>
<title> Log in
</title>
</head>
<body>
<form>
<br />Roll Number:<br />
<input type="text" name="id" maxlength=10 /><br />

<br />Name:<br />
<input type="text" name="name" maxlength=25 /><br />
<div> </div>

<br />Department:<br />
<select name="dept" type="text">
  <option value="AG">Aerospace Engineering</option>
  <option value="AG">Agricultural and Food Engineering</option>
  <option value="AH">Architecture and Regional Planning</option>
  <option value="BS">Bio Science</option>
  <option value="BT">Biotechnology</option>
  <option value="CH">Chemical Engineering</option>
  <option value="CY">Chemistry</option>
  <option value="CE">Civil Engineering</option>
  <option value="CS">Computer Science and Engineering</option>
  <option value="EE">Electrical Engineering</option>
  <option value="EC">Electronics and Electrical Communication Engineering</option>
  <option value="GG">Geology and Geophysics</option>
  <option value="HS">Humanities and Social Sciences</option>
  <option value="IM">Industrial and Systems Engineering</option>
  <option value="MA">Mathematics</option>
  <option value="ME">Mechanical Engineering</option>
  <option value="MT">Metallurgical and Materials Engineering</option>
  <option value="MI">Mining Engineering</option>
  <option value="NA">Ocean Engineering and Naval Architecture</option>
  <option value="PH">Physics</option>
</select>
<div> </div>

<br />Date of Birth:<br />
<input type="date" name="dob" min="1990-01-01" max="2010-12-31">
<div></div>

<br />Contact Number:<br />
<input type="text" name="contact" maxlength=15 /><br />
<div> </div>

<br />Email Id:<br />
<input type="text" name="email" maxlength=10 /><br />
<div> </div>

<br />Password:<br />
<input type="password" name="pword" /><br />
<div> </div>

<br />Re-enter Password:<br />
<input type="password" name="rpword" /><br />
<div> </div>

<br /><button type="submit" >Log in</button><br /><br />
<small>
Already have an account? <a href="login.php" class="fLink">Log in</a>
</small>
</form>
</body>
</html>
