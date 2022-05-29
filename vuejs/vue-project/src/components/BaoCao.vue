<template>
    <div>
        <!-- <ChartBar /> -->
        <ChartDoughnut />
        <!-- <ChartLine /> -->
        <ChartPie />
    </div>
</template>

<script>
import ChartBar from './Chart/ChartBar.vue'
import ChartDoughnut from './Chart/ChartDoughnut.vue'
import ChartLine from './Chart/ChartLine.vue'
import ChartPie from './Chart/ChartPie.vue'

export default {
    components: {
        ChartBar,
        ChartDoughnut,
        ChartLine,
        ChartPie
    },
}
</script>