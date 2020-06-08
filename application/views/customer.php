<style>
  img{
    max-width:180px;
  }
  input[type=file]{
    padding:10px;
  }
</style>
<div class="main" style="background-image: url('public/images/2992342.jpg')">
  <div class="container">
    <div class="content">
      <div class="subscribe">
        <div class="text-center" >
          <h1  style="font-family: 'Grand Hotel',cursive;">
            Wilddog Bankaccount 
          </h1>
          <h3 style="font-family: 'Grand Hotel',cursive;">(User information)
          </h3>
        </div>
        <div class="row">
          <div class="col-sm6-6 col-sm-offset-3 ">
            <div class="text-danger">
              <?php echo validation_errors('<div class="error">', '</div>'); 
if(isset($error)){
echo $error; 
}?>
            </div>      
            <?php
echo '<div class="text-danger">';
echo $this->session->flashdata('err_message');
echo "</div>"; ?>
            <table class="table" style="text-color: white">
              <tbody>
                <tr>
                  <?php if(isset($userinfo)){ 
foreach($userinfo as $data) : ?>
                  <td class="text-center"> 
                    <img id="blah" src="<?=  base_url('uploads/'.$data['picture']) ?>" style = "width: 180px; height: 180px;  background-color: white"/>
                  </td>
                  <td>
                    <b>ชื่อ-นามสกุล :
                    </b>  
                    <?=  $data['firstname'].' '.$data['lastname']; ?>
                    <br>
                    <b>เบอร์โทร 
                    </b> : 
                    <?=  $data['phone']; ?>
                    <br>
                    <b>อีเมล์ :
                    </b>  
                    <?= $data['email'];?>
                    <br>
                    <b>ที่อยู่ :
                    </b>  
                    <?=  $data['address']; ?>
                    <br>
                  </td>
                  <?php $filename = $data['picture'];
$firstname = $data['firstname'];
$lastname = $data['lastname'];
$phone =$data['phone'];
$email = $data['email'];
$address = $data['address']; ?>
                  <?php endforeach ?>
                  <?php } ?>
                  <br>
                </tr>
                <tr>
                  <td>
                    <a href="" data-toggle="modal" data-target="#myModal">แก้ไขข้อมูลผู้ใช้&nbsp;
                      <i class="far fa-edit" title="แก้ไข">
                      </i>
                    </a>
                    <br>
                    <a onclick="return confirm('ต้องการออกจากระบบ')" href="<?=  base_url('/Main/Logout') ?>" style="text-decoration: none;">ออกจากระบบ&nbsp;
                      <i class="fas fa-sign-out-alt">
                      </i>
                    </a>
                  </td> 
                </tr>
              </tbody>
            </table>
            <!--  -->
          </div>
        </div>
      </div>
    </div>
    <!-- The Modal -->
    <div class="modal fade" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">แก้ไขข้อมูลลูกค้า
            </h4>
            <button type="button" class="close" data-dismiss="modal">&times;
            </button>
          </div>
          <!-- Modal body -->
          <div class="modal-body">
            <form  class="form-inline" id="myform" role="form" action="<?=  base_url('Customer/update') ?>" method="post" enctype="multipart/form-data" >
              <img id="blah"   style = "width: 180px; height: 180px;  background-color: white"/>
              <input type='file' name='userFile' onchange="readURL(this);"  required/>
              <label for="fname">ชื่อ :
              </label>
              <br>
              <input type="text" class="form-control " id="fname" name="fname" value="<?=$firstname; ?>" required >
              <br>
              <label for="lname">นามสกุล :
              </label>
              <br>
              <input type="text" class="form-control " id="lname" name="lname" value="<?=$lastname; ?>" required >
              <br>
              <label for="phone">เบอร์โทร :
              </label>
              <br>
              <input type="text" class="form-control " id="phone" name="phone" value="<?=$phone; ?>" required >
              <br>
              <label for="email">อีเมล :
              </label>
              <br>
              <input type="text" class="form-control " id="email" name="email" value="<?=$email; ?>" required>
              <br>
              <label for="address">ที่อยู่ :
              </label>
              <br>
              <textarea  name="address" class="form-control " rows="8" cols="40" required >
                <?= $address; ?>
              </textarea>
              </div>
            <!-- Modal footer -->
            <div class="modal-footer">
              <input type="submit"   class="btn btn-success" value="ยืนยัน">
              </form>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close
            </button>
          </div>
        </div>
      </div>
    </div>
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
