<style>
  img{
    max-width:180px;
  }
  input[type=file]{
    padding:10px;
  }
</style>
<div class="text-center text-danger">
  <?php echo validation_errors('<div class="error">', '</div>'); 
if(isset($error)){
echo $error; 
}?>
</div>
<?php if(isset($_SESSION['admin'])){ ?>
<form id="myform" action="<?=base_url('Admin/addCustomer');?>" method="post" enctype="multipart/form-data" >
  <?php }elseif(isset($_SESSION['user'])){ ?>
  <form action="<?=base_url('Customer/update');?>" method="post" enctype="multipart/form-data" >
    <?php } ?>
    <img id="blah" style = "width: 180px; height: 180px; padding:10px;"/>
    <br>
    <input type='file' name='userFile' onchange="readURL(this);" required/>
    <br>
    <label for="fname">ชื่อ :
    </label>
    <br>
    <input type="text" id="fname" name="fname" required>
    <br>
    <label for="lname">นามสกุล :
    </label>
    <br>
    <input type="text" id="lname" name="lname" required>
    <br>
    <label for="phone">เบอร์โทร :
    </label>
    <br>
    <input type="text" id="phone" name="phone" required>
    <br>
    <label for="email">อีเมล :
    </label>
    <br>
    <input type="text" id="email" name="email"  required>
    <br>
    <label for="address">ที่อยู่ :
    </label>
    <br>
    <textarea  name="address" placeholder="..." rows="8" cols="40" required>
    </textarea>
    <br>
    <hr>
    <h4>ตั้งค่ารหัสผ่าน
    </h4>
    <label for="password">
    </label>
    <input type="password" id="password" name="password" required>
    <br>
    <label for="confirmpassword">
    </label>
    <br>
    <input type="password" id="password" name="confirmpassword" required>
    <br>
    <br>
    <input type="submit" value="ยืนยัน">
    <?php if(isset($_SESSION['admin'])){ ?>
    <a type="button" href="<?=base_url('/Admin');?>">ยกเลิก
    </a>
    <?php }
elseif(isset($_SESSION['user'])){ ?>
    <a type="button" href="<?=base_url('/Customer');?>">ยกเลิก
    </a>
    <?php }else{ ?>
    <a type="button" href="<?=base_url('/');?>">ยกเลิก
    </a>
    <?php } ?>
  </form>
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
