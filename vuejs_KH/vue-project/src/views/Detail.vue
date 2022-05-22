<template>
    <div>
        <!-- <section class="mod mod-details-product py-10">
            <div class="container mx-auto">
                <div class="row flex flex-wrap">
                    <div class="col w-1/2 pl-3 pr-5">
                        <div class="img-left">
                            <img src="" alt="">
                        </div>
                    </div>
                    <div class="col w-1/2 details-right pl-5 pr-3">
                        <h1 class="title-product text-2xl font-medium pb-4">
                            tên SP
                        </h1>
                        <div class="detail-line"></div>
                        <div class="pt-4">
                            <span class="detail-price text-3xl">10000đ</span><span class="text-2xl"> / phần</span>
                        </div>
                        <div>
                            <table>
                                <tbody>
                                    <tr class="block mb-2">
                                        <td class="font-medium inline">Danh mục: </td>
                                        <td class="inline"><a href="#" class="text-blue-500">tên danh mục</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="detail-quantity flex mt-5">
                            <p class="font-medium">Chọn số lượng</p>
                            <div class="flex ml-4">
                                <button id="botSL" class="input-group-addon input-minus">
                                    <span class="fas fa-minus" style="margin-top: 7px" aria-hidden="true"></span>
                                </button>
                                <input type="text" class="input-quantity text-center text-base font-bold"
                                    name="quantity" id="quantity" value="1">
                            </div>
                            <button id="themSL" class="input-group-addon input-plus">
                                <span class="fas fa-plus" style="margin-top: 7px" aria-hidden="true"></span>
                            </button>
                        </div>

                        <div class="add-to-cart mt-5">
                            <a href="#" class="btn text-xl">Thêm vào giỏ hàng</a>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->

        <section class="food-preview-container" :class="{ show: active }" @click="$emit('close-monan')">
            <div class="food-preview" v-if="detailmonan">
                <img src="images/food-img-1.png" alt="">
                <h3>{{ detailmonan.tenmonan }}</h3>
                <p>{{ detailmonan.mota }}</p>
                <div class="price">{{ detailmonan.gia }}</div>
                <a href="#" class="btn">buy now</a>
            </div>
        </section>

        <!-- <section class="food-preview-container">
            <div id="close-preview" class="fas fa-times"></div>
            <div class="food-preview" >
                <img src="images/food-img-1.png" alt="">
                <h3>delicious food</h3>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus, hic!</p>
                <div class="price">$49.99</div>
                <a href="#" class="btn">buy now</a>
            </div>
        </section> -->
    </div>
</template>

<script>
export default {
    props: ['detailmonan', 'active'],
    data() {
        return {
            monans: {},
        }
    },
    methods: {
    },


}
</script>
<style>
/* .food-preview-container {
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    z-index: 1100;
    display: none;
    align-items: center;
    justify-content: center;
    background-color: aqua;
} */

.show {
    display: inline-block;
    animation: fadeIn 0.4s cubic-bezier(.54, 1.3, .63, 1.34) backwards;
}

/* .food-preview-container .food-preview.active {
    display: inline-block;
    animation: fadeIn 0.4s cubic-bezier(.54, 1.3, .63, 1.34) backwards;
} */
</style>