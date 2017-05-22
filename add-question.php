<!-- Modal            -->
<link rel="stylesheet" type="text/css" href="css/city-style.css">
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add new place</h4>
        </div>
        <div class="modal-body">
            <form method="POST" action="add.php" accept-charset="UTF-8" class="form" enctype="multipart/form-data">
            <div class="right-modal">
            <div class="form-group main">
                <label for="Name" class="mylabel">Name</label>
                <input placeholder="" name="name" type="text">
            </div>

            <div class="form-group main">
                <label for="Address" class="mylabel">Address</label>
                <input placeholder="" name="address" type="text" class="addr-input">
                 <select name="city">
                  <option value="Đà Nẵng">Đà Nẵng</option>
                  <option value="Quảng Nam">Quảng Nam</option>
                  <option value="Hà Nội">Hà Nội</option>
                  <option value="Huế">Huế</option>
                  <option value="Hồ Chí Minh">Hồ Chí Minh</option>
                </select>
            </div>

            <div class="form-group main">
                <label for="Open time" class="mylabel">Open time</label>
                <input placeholder="00:00 - 00:00" name="time_open" type="text">
            </div>

            <div class="form-group main">
                <label for="Quality" class="mylabel">Description</label>
                <textarea name="des"  rows="2" class="des-input"></textarea> 
            </div>
            </div>

            <div class="left-modal">
            <div class="form-group">
            	<img id="blah" src="image/insert_image_here.png" alt="your image" />
                <input class="filestyle" type="file" name="image" data-input="false" id="imgInp">
            </div>
            </div>
         </div>
            <div class="modal-footer">
                <label for="Quality" class="mylabel">Quality</label>
                <input type="text" name="quality" placeholder="? / 10" class="quality-input">
                <label for="Quality" class="phone-label"><span class="glyphicon glyphicon-earphone"></span></label>
                <input placeholder="" name="phone" type="text" class="phone-input">
                <select name="category">
                  <option value="Khu nghỉ dưỡng">Khu nghỉ dưỡng</option>
                  <option value="Công viên vui chơi">Công viên vui chơi</option>
                  <option value="Du lịch sinh thái">Du lịch sinh thái</option>
                  <option value="Chùa và Nhà thờ">Chùa và Nhà thờ</option>
                  <option value="Thăm quan và Chụp ảnh">Thăm quan và Chụp ảnh</option>
                </select>
                <input type="submit" value="Create!" class="submit">
           
           </form>
        </div>
      </div>
    </div>
</div>