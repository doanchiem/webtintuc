<div id="column">
  <ul id="latestnews" class="sidebar">
    <?php
    $list = getListPostType(9);
    foreach ($list as $key) { ?>

      <li>
        <a class="text-white " style="color: white;" href=<?php echo 'index.php?main=tokyo&postsId=' . $key['ID_baiviet'] ?>>
          <div class="card_">
            <img class="food" src=<?php echo $key["img"] ?> alt="" />
            <div class='titel'> <b><?php echo $key["title"] ?>
              </b></div>
          </div>
          <div class="text-white content"><?php echo $key["content"] ?></div>
        </a>
      </li>
    <?php
    };

    ?>
    <!-- 
    <li><img class="food" src="../images\photo-1-16752475789721648294046.webp" alt="" />
      <p><strong><a href="#">các món ăn chỉ có tại việt nam</a></strong> 10 món ăn Việt Nam nổi tiếng thế giới.mà mỗi khi đến Việt Nam các du khách nhất định nên thử </p>
    </li>
    <li><img class="tokyo" src="../images\shutterstockRF_257639824.jpg" alt="" />
      <p><strong><a href="#">một ngày ở tokyo</a></strong>Đối với những du khách lần đầu tiên đến Nhật Bản chắc chắn sẽ rất muốn khám phá Tokyo. vậy tokyo Nên đi đâu, ăn gì và làm gì ???...</p>
    </li>
    <li><img class="seuol" src="../images\seoul_giang_sinh_1.jpg" alt="" />
      <p><strong><a href="#">đi seoul nên đi đâu ?</a></strong> seoul nổi tiếng là thành phố của ẩm thực đường phố và thời trang, hãy cùng khám phá đất nước xinh đẹp này nhé </p>
    </li>
    <li><img class="nhatban" src="../images\img11-2.jpg" alt="" />
      <p><strong><a href="#">văn hóa xếp hàng ở Nhật Bản</a></strong> Văn hóa xếp hàng ở Nhật Bản là văn hóa cực kì đáng học hỏi . Hãy cùng xem tìm hiểu chi tiết nhé </p>
    </li>
    <li class="last"><img class="hanoi" src="../images\thu-ha-noi-.webp" alt="" />
      <p><strong><a href="#">Hà Nội đẹp nhất vào Thu</a></strong> Mỗi khi thu về , gió nhè nhẹ ...thời tiết khiến cho hà nội khoắc lên mình một vẻ thơ mộng , xao xuyến</p>
    </li> -->
  </ul>
</div>
<br class="clear" />
</div>
<br class="clear" />