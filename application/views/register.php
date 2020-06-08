<style>
  img{
    max-width:180px;
  }
  input[type=file]{
    padding:10px;
  }
</style>
<!--  -->
<div class="main" style="background-color: #FAC3AB ">
  <div class="container"  >
    <div class="content" >
      <div class="subscribe">
        <div class="text-center" >
          <h1  style="font-family: 'Grand Hotel',cursive;">
            Wilddog Bankaccount 
          </h1>
          <h3 style="font-family: 'Grand Hotel',cursive;">(Register)
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
            <form class="form-inline" role="form" id="myform" action="<?=base_url('Main/signup');?>" method="post" enctype="multipart/form-data">
              <img id="blah" style = "width: 180px; height: 180px;  background-color: white"/>
              <input type='file' name='userFile' onchange="readURL(this);" required/>
              <label for="fname">
              </label>
              <input type="text" class="form-control " id="fname" name="fname" placeholder="ชื่อ"  >
              <label for="lname">
              </label>
              <input type="text"  class="form-control " id="lname" name="lname" placeholder="นามสกุล" >
              <br>
              <br>
              <label for="phone">
              </label>
              <input type="text" class="form-control " id="phone" name="phone" placeholder="เบอร์โทร"   >
              <label for="email">
              </label>
              <input type="text" class="form-control " id="email" name="email" placeholder="อีเมล์" >
              <br>
              <br>
              <label for="address">
              </label>
              <textarea  name="address" class="form-control "  rows="8" cols="40" placeholder="ที่อยู่" >
              </textarea>
              <br>
              <h5>ตั้งค่ารหัสผ่าน
              </h5>
              <label for="password">
              </label>
              <input type="password" class="form-control " id="password" name="password" placeholder="password" >
              <label for="confirmpassword">
              </label>
              <input type="password" class="form-control " id="confirmpassword" name="confirmpassword" placeholder="confirmpassword" >
              <br>
              <br>
              <input type="submit"  class="btn btn-success btn-fill btn-sm"  value="ยืนยัน">
              <a type="button"  class="btn btn-danger btn-fill btn-sm"  href="<?=base_url('Main');?>">ยกเลิก
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
