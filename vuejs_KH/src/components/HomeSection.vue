<template>
  <!-- home section starts  -->

  <section class="home" id="home">

    <div class="content">
      <span>Chào mừng</span>
      <h3>quý khách đã đến với nhà hàng Majestic 😋</h3>
      <p>được xây dựng theo phong cách kiến trúc hiện đại, không gian thoáng mát, luôn gần gũi với thiên nhiên và môi
        trường.</p>
      <!-- <a href="#" class="btn">order now</a> -->
      <router-link to="/menu" class="btn">Menu</router-link>

      <!-- <router-link>hi</router-link> -->
    </div>

    <div class="image">
      <img src="../assets/home-img.png" alt="" class="home-img">
      <!-- <img src="../assets/home-parallax-img.png" alt="" class="home-parallax-img"> -->
    </div>

  </section>

  <!-- home section ends  -->
</template>

<style scoped>
.home {
  display: flex;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  -ms-flex-wrap: wrap-reverse;
  flex-wrap: wrap-reverse;
  gap: 2rem;
  position: relative;
  overflow: hidden;
}

.home .content {
  -webkit-box-flex: 1;
  -ms-flex: 1 1 41rem;
  flex: 1 1 41rem;
}

.home .content span {
  font-size: 3rem;
  color: #fdd117;
}

.home .content h3 {
  font-size: 4rem;
  color: #130f40;
  padding-top: 1rem;
}

.home .content p {
  font-size: 1.9rem;
  color: #666;
  line-height: 2;
  padding: 1rem 0;
}

.home .image {
  -webkit-box-flex: 1;
  -ms-flex: 1 1 41rem;
  flex: 1 1 41rem;
  margin: 2rem 0;
  pointer-events: none;
}

.home .image .home-img {
  width: 100%;
  margin-top: 5rem;
}

.home .home-parallax-img {
  position: absolute;
  top: -10rem;
  right: -10rem;
  width: 80vw;
}
</style>