<style>
  img{
    max-width:180px;
  }
  input[type=file]{
    padding:10px;
  }
</style>
<!--  -->
<script type="text/javascript">
  $(function() {
    $("#myform").on("submit", function() {
      var form = $(this)[0];
      if (form.checkValidity() === false) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add('was-validated');
    }
                   );
  }
   );
</script>
<div class="main" style="background-color: #F7D0BF	">
  <div class="container"> 
    <div class="content">
      <div class="subscribe">
        <div class="text-center" >
          <h1  style="font-family: 'Grand Hotel',cursive;">
            Wilddog Bankaccount 
          </h1>
          <h3 style="font-family: 'Grand Hotel',cursive;">(Add info)
          </h3>
        </div>
        <div class="row">
          <div class="col-sm6-6 col-sm-offset-3 ">
            <div class="text-center text-danger">
              <?php echo validation_errors('<div class="error">', '</div>'); 
if(isset($error)){
echo $error; 
}?>
            </div>
            <!--  -->
            <form class="form-inline" role="form" id="myform" action="<?=base_url('Admin/addCustomer');?>" method="post" enctype="multipart/form-data">
              <img id="blah" style = "width: 180px; height: 180px;  background-color: white"/>
              <input type='file' name='userFile' onchange="readURL(this);" required/>
              <label for="fname">
              </label>
              <input type="text" class="form-control " id="fname" name="fname" placeholder="ชื่อ" required >
              <label for="lname">
              </label>
              <input type="text"  class="form-control " id="lname" name="lname" placeholder="นามสกุล" required>
              <br>
              <br>
              <label for="phone">
              </label>
              <input type="text" class="form-control " id="phone" name="phone" placeholder="เบอร์โทร"  required>
              <label for="email">
              </label>
              <input type="text" class="form-control " id="email" name="email" placeholder="อีเมล์"  required>
              <br>
              <br>
              <label for="address">
              </label>
              <textarea  name="address" class="form-control "  rows="8" cols="40" placeholder="ที่อยู่" required>
              </textarea>
              <br>
              <h5>ตั้งค่ารหัสผ่าน
              </h5>
              <label for="password">
              </label>
              <input type="password" class="form-control " id="password" name="password" placeholder="password" required>
              <label for="confirmpassword">
              </label>
              <input type="password" class="form-control " id="password" name="confirmpassword" placeholder="confirmpassword" required>
              <br>
              <br>
              <input type="submit"  class="btn btn-success btn-fill btn-sm"  value="ยืนยัน">
              <a type="button"  class="btn btn-danger btn-fill btn-sm"  href="<?=base_url('/Admin');?>">ยกเลิก
              </a>
            </form>
            <br>
            <!--  -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--  -->
  <script>
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
          $('#blah')
            .attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
