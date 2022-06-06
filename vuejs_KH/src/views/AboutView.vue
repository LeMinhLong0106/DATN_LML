<template>
  <section class="about" id="about">

    <div class="image">
      <img src="../assets/about-img.png" alt="">
    </div>

    <div class="content">
      <span>Thông tin nhà hàng</span>
      <h3 class="title text-justify">Nhà hàng Majestic Tọa lạc tại số 105 đường Nguyễn Thị Minh Khai, phường Phước Hoà,
        thuộc trung
        tâm thành phố biển Nha Trang !</h3>
      <p class="text-justify">Nhà hàng Majestic chính thức khai trương vào ngày 30 tháng 9 năm 2011 đạt tiêu chuẩn nhà
        hàng cao cấp với khu
        vườn rộng có sức chứa khoảng 300 khách, được trang trí bằng những ánh đèn đủ màu lung linh, huyền ảo chiếu sáng
        lấp lánh như những ánh sao trên bầu trời đêm, mang đến cho khách hàng một bầu không khí trong lành và mát mẻ.
        Với không gian rộng rãi Nhà hàng rất phù hợp cho việc tổ chức các buổi tiệc cưới, tiệc hỏi, sinh nhật, liên hoan
      </p>
      <!-- <a href="#" class="btn">read more</a> -->
      <!-- <router-link to="/test" class="btn">read more</router-link> -->
      <div class="icons-container">
        <div class="icons">
          <img src="../assets/serv-1.png" alt="">
          <h3>Chuyển phát nhanh</h3>
        </div>
        <div class="icons">
          <img src="../assets/serv-2.png" alt="">
          <h3>Thực phẩm sạch</h3>
        </div>
        <div class="icons">
          <img src="../assets/serv-3.png" alt="">
          <h3>Chất lượng bảo đảm</h3>
        </div>
        <div class="icons">
          <img src="../assets/serv-4.png" alt="">
          <h3>Hỗ trợ 24/7</h3>
        </div>
      </div>
    </div>

  </section>
</template>

<style scoped>
.about {
  margin-top: 90px;
  display: flex;
  -ms-flex-wrap: wrap;
  flex-wrap: wrap;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  gap: 2rem;
  background: center;
}

.about .image {
  -webkit-box-flex: 1;
  -ms-flex: 1 1 40rem;
  flex: 1 1 40rem;
}

.about .image img {
  width: 100%;
}

.about .content {
  -webkit-box-flex: 1;
  -ms-flex: 1 1 40rem;
  flex: 1 1 40rem;
}

.about .content span {
  font-family: 'Satisfy', cursive;
  font-size: 3rem;
  color: #fdd117;
}

.about .content .title {
  font-size: 3rem;
  padding-top: .5rem;
  color: #130f40;
}

.about .content p {
  padding: 1rem 0;
  line-height: 2;
  font-size: 1.4rem;
  color: #666;
}

.about .content .icons-container {
  margin-top: 2rem;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -ms-flex-wrap: wrap;
  flex-wrap: wrap;
  gap: 1.5rem;
}

.about .content .icons-container .icons {
  -webkit-box-flex: 1;
  -ms-flex: 1 1 20rem;
  flex: 1 1 20rem;
  border-radius: .5rem;
  background: #fff;
  -webkit-box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.05);
  box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.05);
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  gap: 2rem;
  padding: 2rem;
}

.about .content .icons-container .icons h3 {
  font-size: 1.7rem;
  color: #130f40;
}
</style>