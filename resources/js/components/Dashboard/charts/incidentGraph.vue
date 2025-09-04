<template>
    <div class="graphChart">
        <v-chart class="chart" :autoresize="true" :option="options" />
    </div>
</template>

<script>
import { use } from "echarts/core";
import { CanvasRenderer } from "echarts/renderers";
import { BarChart, PieChart } from "echarts/charts";
import {
    TitleComponent,
    TooltipComponent,
    LegendComponent,
    GridComponent,
} from "echarts/components";
import VChart, { THEME_KEY } from "vue-echarts";

use([
    CanvasRenderer,
    PieChart,
    BarChart,
    TitleComponent,
    TooltipComponent,
    LegendComponent,
    GridComponent,
]);

export default {
    name: "HelloWorld",
    components: {
        VChart,
    },

    autoresize: true,
    data() {
        return {};
    },
    computed: {
        options() {
            let my_incident_data = [];
            let incident_labels = [];
            if (this.incident_data) {
                my_incident_data = this.incident_data;
            }
            incident_labels = my_incident_data.map(
                (item) => item.incident.toLowerCase().substring(0, 9) + "..."
            );
            let incident_info = my_incident_data.map((item) => item.errorCount);
            // return my_incident_data;
            return {
                title: {
                    text: "Incident",
                    left: "center",
                },
                tooltip: {
                    trigger: "item",
                    formatter: " {b} : {c}",
                },
                xAxis: {
                    type: "category",
                    data: incident_labels,
                    axisLabel: {
                        rotate: 45,
                    },
                },
                yAxis: {
                    type: "value",
                },
                series: [
                    {
                        data: incident_info,
                        type: "bar",
                    },
                ],
            };
        },
    },
    props: {
        incident_data: Array,
    },
};
</script>

<style scoped>
.chart {
    height: 400px;
    /* background: #fff; */
}
</style>
