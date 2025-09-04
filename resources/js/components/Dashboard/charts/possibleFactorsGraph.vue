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
  provide: {
    [THEME_KEY]: "light",
  },
  autoresize: true,
  data() {
    return {};
  },
  computed: {
    options() {
      let possible_factors = null;

      if (this.possible_factors_data) {
        possible_factors = this.possible_factors_data;
      }
      let possible_factors_labels = possible_factors.map(
        (item) => item.possibleFactor.toLowerCase().substring(0, 9) + "..."
      );
      let possible_factors_info = possible_factors.map(
        (item) => item.errorCount
      );
      return {
        title: {
          text: "Possible factors",
          left: "center",
        },
        tooltip: {
          trigger: "item",
          formatter: " {b} : {c}",
        },
        xAxis: {
          type: "category",
          data: possible_factors_labels,
          axisLabel: {
            rotate: 45,
          },
        },
        yAxis: {
          type: "value",
        },
        series: [
          {
            data: possible_factors_info,
            type: "bar",
          },
        ],
      };
    },
  },
  props: {
    possible_factors_data: Array,
  },
};
</script>

<style scoped>
.chart {
  height: 400px;
}
</style>
