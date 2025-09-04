<template>
    <div class="graphChart">
        <v-chart class="chart" :autoresize="true" :option="options" />
    </div>
</template>

<script>
import { use } from "echarts/core";
import { CanvasRenderer } from "echarts/renderers";
import { PieChart } from "echarts/charts";
import {
    TitleComponent,
    TooltipComponent,
    LegendComponent,
} from "echarts/components";
import VChart, { THEME_KEY } from "vue-echarts";

use([
    CanvasRenderer,
    PieChart,
    TitleComponent,
    TooltipComponent,
    LegendComponent,
]);

export default {
    name: "HelloWorld",
    components: {
        VChart,
    },
    provide: {
        [THEME_KEY]: "light",
    },
    autoresize: true,
    data() {
        return {};
    },
    computed: {
        options() {
            return {
                autoresize: true,
                title: {
                    text: "Gender",
                    left: "center",
                },
                tooltip: {
                    trigger: "item",
                    formatter: "{a} <br/>{b} : {c} ({d}%)",
                },
                legend: {
                    orient: "vertical",
                    left: "left",
                    data: ["Male", "Female"],
                },
                series: [
                    {
                        name: "Traffic Sources",
                        type: "pie",
                        radius: "55%",
                        center: ["50%", "60%"],
                        data: [
                            {
                                value: this.gender_data.maleErrorCount,
                                name: "Male",
                            },
                            {
                                value: this.gender_data.femaleErrorCount,
                                name: "Female",
                            },
                        ],
                        emphasis: {
                            itemStyle: {
                                shadowBlur: 10,
                                shadowOffsetX: 0,
                                shadowColor: "rgba(0, 0, 0, 0.5)",
                            },
                        },
                    },
                ],
            };
        },
    },
    props: {
        gender_data: Object,
    },
};
</script>

<style scoped>
.chart {
    height: 400px;
}
</style>
