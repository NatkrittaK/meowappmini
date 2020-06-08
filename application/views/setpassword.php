<script type="text/javascript">
  $(function(){
    $("#myform").on("submit",function(){
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
<div class="main" style="background-color: #FAC3AB ">
  <div class="container">
    <div class="content">
      <div class="subscribe">
        <div class="text-center" >
          <h1  style="font-family: 'Grand Hotel',cursive;">
            Wilddog Bankaccount 
          </h1>
          <h3 style="font-family: 'Grand Hotel',cursive;">(Setting Password)
          </h3>
        </div>
        <div class="row">
          <div class="col-md-4 col-md-offset-4 col-sm6-6 col-sm-offset-3 text-center ">
            <!--  -->
            <form class="form-inline" role="form" id="myform" action="<?=base_url('Main/updatepassword');?> " class="form-group col-5" method="post" novalidate>
              <?php
echo '<div class="text-center text-danger">';
echo $this->session->flashdata('err_message');
echo "</div>"; ?>
              <br>
              <label for="pass">พิมพ์รหัสผ่านที่ต้องการ
              </label>
              <br>
              <input type="text" class="form-control "  name="pass" placeholder="Password " >
              <br>
              <label for="passconf">พิมพ์รหัสผ่านใหม่ที่ต้องการอีกครั้งหนึ่ง
              </label>
              <br>
              <input type="text" class="form-control "  name="passconf" placeholder="Confirmpassword"   >
              <br>
              <br>
              <div class="text-center ">
                &nbsp;&nbsp;
                <button  type="submit"  name="sm"  class="btn btn-success btn-fill  btn-sm" >
                  <i class="now-ui-icons ui-1_simple-add">
                  </i>&nbsp;ยืนยัน
                </button>
              </div>
            </form>
            <!--  -->
          </div>
        </div>
      </div>
    </div>
  </div>
