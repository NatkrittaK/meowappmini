<div class="main" style="background-color: #FAC3AB ">
  <div class="container" >
    <div class="content" >
      <div class="subscribe">
        <div class="text-center" >
          <h1  style="font-family: 'Grand Hotel',cursive;">
            Wilddog Bankaccount 
          </h1>
          <h3 style="font-family: 'Grand Hotel',cursive;">(Forgetpassword)
          </h3>
        </div>
        <div class="row">
          <div class="col-md-4 col-md-offset-4 col-sm6-6 col-sm-offset-3 ">
            <div class="text-center text-danger">
              <?php echo validation_errors('<div class="error">', '</div>'); ?>
              <?php
echo $this->session->flashdata('message');
?>
            </div>
            <form class="form-inline" role="form" id="myform" action="<?=base_url('Main/forgetpassword');?>" method="post" enctype="multipart/form-data">
              <label for="email">อีเมล
              </label>
              <br>
              <input type="text" class="form-control " id="email" name="email"  >
              <br>
              <br>
              <div class="text-center">
                <input type="submit" class="btn btn-success btn-fill btn-sm" value="ยืนยัน">
                <a type="button" class="btn btn-danger btn-fill btn-sm" href="<?=base_url('/');?>">ยกเลิก
                </a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
