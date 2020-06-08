<div class="main" style="background-image: url('public/images/3563458.jpg') ">
  <div class="container">
    <h1 class="logo cursive">
      Wilddog Bank Account
    </h1>
    <!--  H1 can have 2 designs: "logo" and "logo cursive"           -->
    <div class="content">
      <!-- <h4 class="motto">Find the best Bootstrap 3 freebies and themes on the web.</h4> -->
      <div class="subscribe">
        <h5 class="info-text">
          เข้าสู่ระบบธนาคาร 
        </h5>
        <div class="row">
          <div class="col-md-4 col-md-offset-4 col-sm6-6 col-sm-offset-3 ">
            <div class="text-danger">
              <?php echo validation_errors('<div class="error">', '</div>'); ?>
              <?php
echo $this->session->flashdata('message');
?>
            </div>
            <div class="text-success">
              <?php
echo $this->session->flashdata('success_message');
?>
            </div>
            <form class="form-inline" role="form" id="myform" action="<?=base_url('Main/login');?>" method="post" enctype="multipart/form-data">
              <label class="sr-only" for="email">ชื่อผู้ใช้
              </label>
              <br>
              <input type="text" class="form-control " id="email" name="email" type="email" id="email"  placeholder="Your email here..."  >
              <br>
              <label class="sr-only" for="pwd">
              </label>
              <br>
              <input type="password" class="form-control " id="pwd" name="pwd" placeholder="Your password here..." required>
              <br>
              <br>
              <div class="text-center">
                <input type="submit" class="btn btn-success btn-fill btn-sm" value="ยืนยัน">
              </div>
            </form>
            <br>
            <div class ="text-center">
              <a href="<?=base_url('Main/register');?>">ลงทะเบียน
              </a>&nbsp;&nbsp;
              <a href="<?=base_url('Main/forgetpassword');?>">ลืมรหัสผ่าน
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
