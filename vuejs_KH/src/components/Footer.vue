<template>
  <section class="footer">
    <h3>Thông tin nhà hàng</h3>
    <div class="icons-container">

      <div class="icons">
        <i class="fas fa-clock"></i>
        <h3>Giờ mở cửa</h3>
        <p>7am đến 10pm</p>
      </div>

      <div class="icons">
        <i class="fas fa-phone"></i>
        <h3>Điện thoại</h3>
        <p>123456789</p>
        <p>987654321</p>
      </div>

      <div class="icons">
        <i class="fas fa-envelope"></i>
        <h3>Email</h3>
        <p>nhahang@gmail.com</p>
        <p>long@gmail.com</p>
      </div>

      <div class="icons">
        <i class="fas fa-map"></i>
        <h3>Địa chỉ</h3>
        <p>105B-Nguyễn Thị Minh Khai-Nha Trang</p>
      </div>

    </div>

    <div class="credit"> Được tạo bởi <span>Lê Minh Long</span> </div>

  </section>

</template>

<script>
export default {
  // computed: {
  //   bagItemscount() {
  //     return this.$store.getters.itemsNumber
  //   }
  // },
}
</script>

<style scoped>
.footer {
  text-align: center;
  /* padding-bottom: 10rem; */
  background: #f7f7f7;
}

.footer .icons-container {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(25rem, 1fr));
  gap: 2rem;
}

.footer h3 {
  font-size: 3rem;
  color: #130f40;
}

.footer .icons-container .icons {
  text-align: center;
  padding: 3rem 2rem;
}

.footer .icons-container .icons i {
  height: 6rem;
  width: 6rem;
  border-radius: 50%;
  background: var(--peru);
  color: var(--white);
  margin-bottom: .5rem;
  line-height: 5.8rem;
  font-size: 2rem;
}

.footer .icons-container .icons h3 {
  font-size: 2rem;
  color: var(--black);
  padding: 1rem 0;
}

.footer .icons-container .icons p {
  line-height: 1.5;
  font-size: 1.7rem;
  color: var(--light-black);
  text-transform: none;
}

.footer .share {
  margin: 2rem 0;
}

.footer .share a {
  height: 6rem;
  width: 6rem;
  line-height: 5.8rem;
  color: var(--white);
  background: var(--black);
  margin: 0 .3rem;
  font-size: 2.5rem;
}

.footer .share a:hover {
  background: var(--peru);
}

.footer .credit {
  padding-top: 2.5rem;
  margin-top: 3rem;
  border-top: var(--border);
  font-size: 2rem;
  color: var(--light-black);
}

.footer .credit span {
  color: var(--peru);
}
</style>