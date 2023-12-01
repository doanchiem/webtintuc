<div id="content">
  <div id="featured_post"><img src="../images\vietnam-1.jpg" alt="" />
    <p>Trước tiên chúng ta cùng xem qua các địa danh du lịch nổi tiếng tại <a href="https://vemaybayvietnam.com/nhung-dia-diem-du-lich-chau-a-noi-tieng.html">trang này </a>.</p>
    <p>để có cái nhìn bao quát hơn , chúng ta cùng tham khảo trang <a href="https://vi.alongwalker.co/cam-nang-du-lich-chau-a-cho-nhung-thanh-me-phuot-s103263.html">Website này</a>để tìm hiểu cẩm nang du lịch châu á cho những người yêu thích khám phá ,và để phục vụ cho các chuyến đi sắp tới của bạn hãy tham khảo giá vé máy bay đến các nước châu á ở <a href="https://www.vietnamairlines.com/">trang này nhé </a>.</p>
  </div>
  <div id="hpage_latest">
    <ul>
      <?php
      $list = getListPostType(14);
      foreach ($list as $key) { ?>
        <li>
          <a class="text-white " style="color: white;" href=<?php echo 'index.php?main=trainghiemcanhan&postsId=' . $key['ID_baiviet'] ?>>
            <div class="card_">
              <img class="anh1" src="<?php echo '/webtintuc/images/' . $key["img"] ?>" alt="" />
              <div class='titel'>
                <b>
                  <?php echo $key["title"] ?></b>

              </div>
            </div>
            <div class="text-white content"> <?php echo $key["content"] ?></div>

        </li>
      <?php
      };

      ?>
      <!--     
          <li><img class="anh1" src="../images\vtv9922_01.jpg" alt="" />
            <p>Mùa lá vàng, lá đỏ ở Nhật Bản năm nay muộn hơn so với mọi năm, do đó khách Việt vẫn còn thời gian để cân nhắc kế hoạch du lịch.

                 hàng cây bắt đầu mùa thay lá.</p>
            <p>Mùa thu là thời gian lý tưởng để khách du lịch có thể thưởng thức bầu không khí mát mẻ cùng cảnh sắc non nước tuyệt đẹp khi những khu rừng,</p>
            <p class="readmore"><a href="#">next&raquo;</a></p>
          </li>
          <li><img class="anh2" src="../images\qd3slyfinkqip5kanb32.jpg" alt="" />
            <p>Ngành Du lịch Việt Nam ghi nhận nhiều tín hiệu tích cực ngay từ đầu năm 2023 khi lượng khách nội địa tăng trưởng mạnh, </p>
            <p>khách quốc tế quay trở lại Việt Nam ngày càng đông.</p>
            <p class="readmore"><a href="#">next&raquo;</a></p>
          </li>
          <li class="last"><img class="anh3" src="../images\thanh-pho-seoul-han-quoc-xinvisaquocte.jpg" alt="" />
            <p>Seoul là một ngọn hải đăng của sự tăng trưởng kinh tế </p>
            <p>và là một thành phố được mệnh danh không bao giờ ngủ vì những lý do rất giản dị.</p>
            <p class="readmore"><a href="#">next &raquo;</a></p>
          </li> -->
    </ul>
    <br class="clear" />
  </div>
</div>