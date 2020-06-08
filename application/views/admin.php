<script type="text/javascript">
  $(document).ready( function () {
    $('#table_id').DataTable();
  }
                   );
</script>
<style>
  img{
    max-width:180px;
  }
  input[type=file]{
    padding:10px;
  }
  .center {
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 50%;
  }
</style>
<div class="main" style="background-image: url('public/images/632532-PO9GJG-427.jpg')">
  <div class="container">
    <h1 style="font-family: 'Grand Hotel',cursive;" >
      Wilddog Bank Account
    </h1>
    <h4 style="font-family: ''Mitr', sans-serif;" >ข้อมูลลูกค้าธนาคาร Wilddog
    </h4>
    <hr>
    <?php if(isset($data_customer)) { ?>
    <div class="text-center text-danger">
      <?php if(isset($err_message)){
echo $err_message; 
}?>
      <?php if(isset($error)){
echo $error; 
}?>
    </div>
    <table class="display" id="table_id">
      <thead>
        <tr>
          <th>ลำดับที่
          </th>
          <th>ชื่อ
          </th>
          <th>นามสกุล
          </th>
          <th>เบอร์โทรศัพท์
          </th>
          <th>อีเมล์
          </th>
          <th>ที่อยู่
          </th>
          <th>รูป
          </th>
          <th>แก้ไข/ลบ
          </th>
        </tr>
      </thead>
      <tbody>
        <?php
if(!empty($data_customer)){
$i=1; $j=1; foreach($data_customer as $data) : ?>
        <tr>
          <td>
            <?= $i++; ?>
          </td>
          <td>
            <?= $data['firstname']; ?>
          </td>
          <td>
            <?= $data['lastname']; ?>
          </td>
          <td>
            <?= $data['phone']; ?>
          </td>
          <td>
            <?= $data['email']; ?>
          </td>
          <td>
            <?= $data['address']; ?>
          </td>
          <td >
            <a href="" data-toggle="modal" data-target="#myModalB<?=$i?>">&nbsp;&nbsp;
              <i class="fas fa-portrait" title="คลิกเพื่อดูรูป">
              </i>
            </a>
          </td>
          <?php $ID = $data['ID'];
$encryptid = urlencode($this->encryption->encrypt($ID));
?>
          <?php $filename = $data['picture'];
$firstname = $data['firstname'];
$lastname = $data['lastname'];
$phone =$data['phone'];
$email = $data['email'];
$address = $data['address']; ?>
          <td>
            <a href="" data-toggle="modal" data-target="#myModal<?=$i?>">
              <i class="far fa-edit" title="แก้ไข">
              </i>
            </a>&nbsp;
            <a onclick="return confirm('ยืนยันการลบ')" href="<?= base_url('Admin/delete/?q='.$encryptid) ?>">
              <i class="far fa-trash-alt" title="ลบ">
              </i>
            </a>
          </td>
          <!-- The Modal -->
          <div class="modal fade" id="myModalB<?=$i?>">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;
                  </button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                  <img id="blah" class="center"  src="<?=  base_url('uploads/'. $data['picture']) ?>" style = "width: 180px; height: 180px;  background-color: white;"/>
                </div>
              </div>
            </div>
          </div>
          <!-- The Modal -->
          <div class="modal fade" id="myModal<?=$i?>">
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
                  <form class ="form" id="myform" action="<?=  base_url('Admin/update/?q='.$encryptid) ?>"  method="post" enctype="multipart/form-data" >
                    <img id="blah"   style = "width: 180px; height: 180px;  background-color: white"/>
                    <input type='file' name='userFile' onchange="readURL(this);"  required/>
                    <label for="fname">ชื่อ :
                    </label>
                    <input type="text" class="form-control " id="fname" name="fname" value="<?=$firstname?>" required>&nbsp;
                    <label for="lname">นามสกุล :
                    </label>
                    <input type="text" class="form-control " id="lname" name="lname" value="<?=$lastname ?>" required>
                    <br>
                    <label for="phone">เบอร์โทร :
                    </label>
                    <input type="text" class="form-control " id="phone" name="phone" value="<?=$phone ?>"  required>&nbsp;
                    <label for="email">อีเมล :
                    </label>
                    <input type="text" class="form-control " id="email" name="email" value="<?=$email ?>" required >
                    <br>
                    <label for="address">ที่อยู่ :
                    </label>
                    <textarea  name="address" class="form-control " rows="8" cols="40" required>
                      <?= $address ?>
                    </textarea>
                    </div>
                  <!-- Modal footer -->
                  <div class="modal-footer">
                    <input type="submit"  class="btn btn-success" value="ยืนยัน">
                    </form>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close
                  </button>
                </div>
              </div>
            </div>
          </div>
        </tr>
        <?php endforeach ?>
        <?php } ?>
      </tbody>
    </table>
    <?php } ?>
    <br>
    <a href="<?=  base_url('/Admin/addCustomer') ?>" class="btn btn-default btn-fill btn-sm ">เพิ่มข้อมูลลูกค้า
    </a>&nbsp;&nbsp;
    <a href="<?=  base_url('/ExportCSV/export') ?>" class="btn btn-success btn-fill  btn-sm" >exportCSV
    </a>
    <hr>
    <a onclick="return confirm('ต้องการออกจากระบบ')" href="<?=  base_url('/Main/Logout') ?>" style="text-decoration: none;">ออกจากระบบ&nbsp;
      <i class="fas fa-sign-out-alt">
      </i>
    </a>
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
